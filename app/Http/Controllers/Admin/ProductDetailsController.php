<?php

namespace App\Http\Controllers\Admin;

use App\ProductDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDetails $productDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetails $productDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetails $productDetails)
    {
        //
    }
}
