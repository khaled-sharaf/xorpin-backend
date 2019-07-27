<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ProductController extends Controller
{

    public function products_id()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return response($products);
    }

    public function index(Request $request)
    {
        $columns = ['index', 'id', 'name', 'photo', 'price', 'description', 'manufacture_company', 'count_rates', 'product_count', 'count_selling', 'execute', 'display', 'type_id', 'user_id', 'company_id', 'updated_at', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); // Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $execute = $request->execute;
        $type_id = $request->type_id;
        $display = $request->display;
        $trashed = $request->trashed;
        $discount = $request->discount;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Product::select('*');
        if ($discount == '1') {
            if ($columns[$column] == 'price') {
                $query->orderBy('new_price', $dir);
            }
        } else {
            $query->orderBy($columns[$column], $dir);
        }

        if (auth()->user()->rule == 2) {
            $query->where('company_id', auth()->user()->company_id);
        } else {
            if ($request->companyId != null) {
                $query->where('company_id', $request->companyId);
            }
        }


        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($execute != '') {
            $query->where('execute', $execute);
        }
        if ($type_id != '') {
            $query->where('type_id', $type_id);
        }
        if ($display != '') {
            $query->where('display', $display);
        }
        if ($discount == '1') {
            $query->where('discount', '!=', null);
        } else if ($discount == '0') {
            $query->where('discount', null);
        }
        if ($from_date != '') {
            $query->whereDate('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->whereDate('created_at', '<=', $to_date);
        }
        if ($searchValue) {
            if (strpos($searchValue,  ':') != false) {
                $columnSearch = explode(':', $searchValue)[0];
                $valueColumn = explode(':', $searchValue)[1];
                if ($columnSearch != 'id') {
                    $query->where($columnSearch, 'like', '%' . $valueColumn . '%');
                } else {
                    $query->where($columnSearch, $valueColumn);
                }
            } else {
                $query->where(function($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', $searchValue)
                    ->orWhere('manufacture_company', 'like', '%' . $searchValue . '%');
                });
            }
        }

        $products = $query->paginate($length);
        return response(['data' => $products, 'draw' => $request->input('draw'), 'column' => $columns[$column], 'dir' => $dir]);
    }





    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'percent' => 'nullable|boolean',
            'product_count' => 'required|integer',
            'manufacture_company' => 'required|string|between:2,180',
            'description' => 'required|string|between:5,5000',
            'display' => 'required|in:0,1',
            'execute' => 'required|in:0,1',
            'type_id' => 'required|exists:product_types,id',
            'company_id' => (auth()->user()->rule == 1 ? 'required' : 'nullable') . '|exists:companies,id',
            'photo' => 'required|string',
            'gallery' => 'nullable|array',
            'details' => 'nullable|array'
        ]);
        $data = $request->except('details');
        if (auth()->user()->rule == 2) {
            $data['company_id'] = auth()->user()->company_id;
        }

        /****************************************************************************/
        // handel price and discount
        if ($request->price > 0 && $request->discount > 0) {
            if ($request->percent === true) {
                $newPrice = $request->price - ($request->price * ($request->discount / 100));
            } else {
                $newPrice = $request->price - $request->discount;
            }
            $data['new_price'] = $newPrice;
        }
        /****************************************************************************/

        // handel details
        $details_no_null = collect($request->details)->filter(function ($value) {
            return $value['name'] !== null && $value['value'] !== null;
        });
        $details = [];
        foreach ($details_no_null as $row) {
            $row['user_id'] = auth()->id();
            $details[] = $row;
        }
        /****************************************************************************/

        // handel photo
        $directory = 'images/products/' . uniqid('product-');
        if (strpos($data['photo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $data['photo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName =  uniqid('product-default-image-') . '.' . $ext;
            $imagePath = $directory . '/' . $imageNewName;
            if (!is_dir(public_path($directory))) {
                \File::makeDirectory(public_path($directory));
            }
            Image::make($data['photo'])->save(public_path($imagePath));
            $data['photo'] = $imagePath;
        }
        /****************************************************************************/

        // handel gallery
        if (count($data['gallery']) > 0) {
            $galleryDB = [];
            foreach ($data['gallery'] as $image) {
                $get_ext = explode(';', explode('/', $image['url'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('product-image-') . '.' . $ext;
                $imagePath = $directory . '/' . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['url'])->save(public_path($imagePath));
                    $galleryDB[] = $imagePath;
                }
            }
            $data['gallery'] = implode(',', $galleryDB);
        } else {
            $data['gallery'] = null;
        }
        /****************************************************************************/

        // add to DB

        $data['user_id'] = auth()->id();
        $product = Product::create($data);
        if (count($details) > 0) {
            $product->details()->createMany($details);
        }
        $createdProduct = Product::find($product->id);
        return response(['message' => 'Product has been created.', 'data' => $createdProduct]);
    }

    public function show(Request $request)
    {
        if (auth()->user()->rule == 2) {
            $product = Product::where('id', $request->id)->where('company_id', auth()->user()->company_id)->first();
        } else {
            $product = Product::find($request->id);
        }
        return response(['product' => $product]);
    }


    public function update(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|between:2,180',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'percent' => 'nullable|boolean',
            'product_count' => 'required|integer',
            'manufacture_company' => 'required|string|between:2,180',
            'description' => 'required|string|between:5,5000',
            'display' => 'required|in:0,1',
            'execute' => 'required|in:0,1',
            'type_id' => 'required|exists:product_types,id',
            'company_id' => (auth()->user()->rule == 1 ? 'required' : 'nullable') . '|exists:companies,id',
            'photo' => 'required|string',
            'gallery' => 'nullable|array',
            'details' => 'nullable|array'
        ]);

        $id = $request->id;
        $product = Product::find($id);
        $keys_except = ['details', 'deletedGallery', 'deletedDetails'];
        if (auth()->user()->rule == 2) {
            $keys_except[] = 'company_id';
        }
        $data = $request->except($keys_except);

        /****************************************************************************/
        // handel price and discount
        if ($request->price > 0 && $request->discount > 0) {
            if ($request->percent == 1) {
                $newPrice = $request->price - ($request->price * ($request->discount / 100));
            } else {
                $newPrice = $request->price - $request->discount;
            }
            $data['new_price'] = $newPrice;
        } else if ($request->discount === null) {
            $data['new_price'] = null;
        }
        /****************************************************************************/
        // handel details

        // delete details
        $details_deleted = collect($request->deletedDetails)->filter(function ($value) {
            return key_exists('id', $value);
        });
        $details_deleted_ids = [];
        foreach ($details_deleted as $item) {
            $details_deleted_ids[] = $item['id'];
        }
        // delete details [if deleted by user]
        if (count($details_deleted_ids) > 0) {
            $product->details()->whereIn('id', $details_deleted_ids)->delete();
        }
        /*================================================*/

        // add new details
        $details_no_null = collect($request->details)->filter(function ($value) {
            return $value['name'] !== null && $value['value'] !== null;
        });
        $details = [];
        foreach ($details_no_null as $row) {
            $row['user_id'] = auth()->id();
            $details[] = $row;
        }
        // save and craete new details in database
        if (count($details) > 0) {
            for ($x = 0; $x < count($details); $x++) {
                $product->details()->updateOrCreate(
                    [
                        'id' => key_exists('id', $details[$x]) ? $details[$x]['id'] : 0
                    ],
                    $details[$x]
                );
            }
        }
        /****************************************************************************/

        // handel photo
        $directory = 'images/products/' . explode('/', $product->photo)[2];
        if (strpos($data['photo'], 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $data['photo'])[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName =  uniqid('product-default-image-') . '.' . $ext;
            $imagePath = $directory . '/' . $imageNewName;

            // delete old image if exists
            if ($product->photo !== null) {
                if (file_exists(public_path($product->photo))) {
                    unlink(public_path($product->photo));
                }
            }
            /*================================================*/
            Image::make($data['photo'])->save(public_path($imagePath));
            $data['photo'] = $imagePath;
        }
        /****************************************************************************/

        // handel gallery
        // delete images in array [gallery deleted by user]
         $gallery_deleted = collect($request->deletedGallery)->filter(function ($value) {
             return strpos($value['url'], 'images/products') === 0;
         });
         if ($gallery_deleted->count() > 0) {
            foreach ($gallery_deleted as $image) {
                if (file_exists(public_path($image['url']))) {
                    unlink(public_path($image['url']));
                }
            }
         }

        /*================================================*/
        // save new and old images
         $gallery = collect($request->gallery);
         $galllery_new = $gallery->filter(function ($value) {
            return strpos($value['url'], 'images/products') === false;
         });
         $galllery_old = $gallery->filter(function ($value) {
            return strpos($value['url'], 'images/products') === 0;
         });
        /*================================================*/
        $gallery_saved = [];
        // save new image if exists new image
        if ($galllery_new->count() > 0) {
            foreach ($galllery_new as $image) {
                $get_ext = explode(';', explode('/', $image['url'])[1])[0];
                $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
                $imageNewName =  uniqid('product-image-') . '.' . $ext;
                $imagePath = $directory . '/' . $imageNewName;
                if (is_dir(public_path($directory))) {
                    Image::make($image['url'])->save(public_path($imagePath));
                    $gallery_saved[] = $imagePath;
                }
            }
        }
        /*================================================*/
        if ($galllery_old->count() > 0) {
            foreach ($galllery_old as $value) {
                $gallery_saved[] = $value['url'];
            }
        }
        if (count($gallery_saved) > 0) {
            $data['gallery'] = implode(',', $gallery_saved);
        } else {
            $data['gallery'] = null;
        }
        /****************************************************************************/

        $product->update($data);
        $updatedProduct = Product::find($id);
        return response(['message' => $data['name'] . ' Product has been updated.', 'data' => $updatedProduct]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $product = Product::withTrashed()->where('id', $id)->first();
        if ($product->trashed()) {
            // delete image
            $directory = 'images/products/' . explode('/', $product->photo)[2];
            \File::deleteDirectory($directory);
            $product->details()->delete();
            $product->forceDelete();
        } else {
            $product->delete();
        }
        return response(['status' => true]);
    }


    public function restoreProduct(Request $request)
    {
        $id = $request->id;
        $product_deleted = Product::onlyTrashed()->where('id', $id)->first();
        $product_deleted->restore();
        return response(['status' => true]);
    }


    public function sell(Request $request)
    {
        $id = $request->id;
        $sales_count = $request->sales_count;
        $add_sales = $request->add_sales;
        $increase_decrease_current_products = $request->increase_decrease_current_products;

        if ($sales_count != null && is_numeric($sales_count)) {
            $product = Product::find($id);
            if ($add_sales === true) {
                $product->count_selling = $product->count_selling + $sales_count;
                if ($increase_decrease_current_products === true) {
                    $product->product_count = $product->product_count - $sales_count;
                }
            } else {
                $product->count_selling = $product->count_selling - $sales_count;
                if ($increase_decrease_current_products === true) {
                    $product->product_count = $product->product_count + $sales_count;
                }
            }
            $product->save();
            return response(['status' => true, 'product' => $product]);
        } else {
            return response('Sales count is null or not integer', 422);
        }
    }
}
