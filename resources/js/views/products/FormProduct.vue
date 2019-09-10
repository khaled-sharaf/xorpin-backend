<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- name -->
                <div class="form-group">
                    <label> {{ $t('products_table.name') }} <span class="field-required"></span></label>
                    <input
                        v-model="form.name"
                        type="text"
                        :placeholder="$t('products_table.name')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>


                <!-- price -->
                <div class="form-group">
                    <label> {{ $t('products_table.price') }} <span class="field-required"></span></label>
                    <input
                        v-model="form.price"
                        type="number"
                        :placeholder="$t('products_table.price')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('price') }"
                    >
                    <has-error :form="form" field="price"></has-error>
                </div>


                <!-- discount -->
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-md-10">
                            <label class="label-dir"> {{ $t('products_table.discount') }} </label>
                            <input
                                v-model="form.discount"
                                type="number"
                                :placeholder="$t('products_table.discount')"
                                class="form-control"
                                :disabled="form.price === null || form.price < 1"
                                :class="{ 'is-invalid': form.errors.has('discount') }"
                            >
                            <has-error :form="form" field="discount"></has-error>
                        </div>

                        <div class="col-md-2">
                            <div class="custom-control custom-checkbox checkbox-percent">
                                <input type="checkbox" class="custom-control-input" id="percent" v-model="form.percent">
                                <label class="custom-control-label" for="percent"> {{ $t('products_table.percent') }} </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Show new price -->
                <div class="form-group" v-if="(form.discount != '' && form.discount > 0) && (form.price != '' && form.price > 0)">
                    <div class="show-new-price" v-if="calcNewPrice !== false">
                        <span class="price" v-text="form.price"></span>
                        <span class="operator">-</span>
                        <span class="discount">{{ form.discount + ' ' + (form.percent == 1 ? '%' : '') }}</span>
                        <span class="operator">=</span>
                        <span class="result">{{ calcNewPrice }}</span>
                    </div>
                </div>


                <!-- product count -->
                <div class="form-group">
                    <label> {{ $t('products_table.product_count') }} <span class="field-required"></span></label>
                    <input
                        v-model="form.product_count"
                        type="number"
                        :placeholder="$t('products_table.product_count')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('product_count') }"
                    >
                    <has-error :form="form" field="product_count"></has-error>
                </div>


                <!-- Manufacture company -->
                <div class="form-group">
                    <label> {{ $t('products_table.manufacture_company') }} <span class="field-required"></span></label>
                    <input
                        v-model="form.manufacture_company"
                        type="text"
                        :placeholder="$t('products_table.manufacture_company')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('manufacture_company') }"
                    >
                    <has-error :form="form" field="manufacture_company"></has-error>
                </div>


                <!-- description -->
                <div class="form-group">
                    <label> {{ $t('products_table.description') }} <span class="field-required"></span></label>
                    <textarea
                        v-model="form.description"
                        type="text"
                        :placeholder="$t('products_table.description')"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('description') }"
                    ></textarea>
                    <has-error :form="form" field="description"></has-error>
                </div>


                <!-- dispaly products -->
                <div class="form-group">
                    <label> {{ $t('datatable.display') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.display"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('display') }"
                    >
                        <option value="1"> {{ $t('global.visible') }} </option>
                        <option value="0"> {{ $t('global.hidden') }} </option>
                    </select>
                    <has-error :form="form" field="display"></has-error>
                </div>

                <!-- run out -->
                <div class="form-group">
                    <label> {{ $t('products_table.execute') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.execute"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('execute') }"
                    >
                        <option value="0"> {{ $t('global.available') }} </option>
                        <option value="1"> {{ $t('global.unavailable') }} </option>
                    </select>
                    <has-error :form="form" field="execute"></has-error>
                </div>


                <!-- Product Type -->
                <div class="form-group">
                    <label> {{ $t('products_table.type') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.type_id"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('type_id') }"
                    >
                    <option :value="type.id" v-for="type in proTypes" :key="type.id" v-text="type.name"></option>
                    </select>
                    <has-error :form="form" field="type_id"></has-error>
                </div>

                <!-- company -->
                <div class="form-group" v-if="$gate.isAdmin()">
                    <label> {{ $t('products_table.company') }} <span class="field-required"></span></label>
                    <select
                    v-model="form.company_id"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('company_id') }"
                    >
                    <option
                        v-for="company in companies"
                        :value="company.id"
                        :key="company.id"
                    >{{ company.name }}</option>
                    </select>
                    <has-error :form="form" field="company_id"></has-error>
                </div>

                <!-- photo -->
                <div class="form-group">
                    <label> {{ $t('products_table.photo') }} <span class="field-required"></span></label>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="wrapper-drop-image" :class="{'contains-image': form.photo != '', 'is-invalid': form.errors.has('photo')}" id="product-default-photo"> <!-- contains-image -->
                                <div class="overlay-drop-image">
                                    <div class="view-images">
                                        <div class="image elevation-5" v-if="form.photo != ''">
                                            <div class="img">
                                                <img :src="productPhoto">
                                            </div>
                                        </div>

                                    </div>
                                    <label class="view-overlay" for="product_photo">
                                        <div class="content-overlay">
                                            <i class="icon far fa-image"></i>
                                            <span class="title"> {{ $t('global.drag_msg') }} </span>
                                        </div>
                                    </label>
                                </div>
                                <input
                                    type="file"
                                    class="custom-file-drop custom-file-input"
                                    id="product_photo"
                                    accept="image/*"
                                    @change="showFiles($event.target.files, $event.target.id)"
                                    :class="{ 'is-invalid': form.errors.has('photo') }"
                                >
                                <has-error :form="form" field="photo"></has-error>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- gallery -->
                <div class="form-group">
                    <label> {{ $t('products_table.photos') }} </label>

                    <div class="wrapper-drop-image"  :class="{'contains-image': form.gallery !== null && form.gallery.length > 0}" id="product-multi-photo"> <!-- contains-image -->
                        <div class="overlay-drop-image" for="product_photos">
                            <div class="view-images">
                                <div class="image elevation-5" v-for="image in form.gallery" :key="image.id">
                                    <div class="img">
                                        <img :src="addDomainToPhoto(image.url)">
                                        <div class="remove-image" @click="removePhoto(image.id)"><i class="fas fa-times"></i></div>
                                    </div>
                                </div>
                            </div>
                            <label class="view-overlay" for="product_photos">
                                <div class="content-overlay">
                                    <i class="icon far fa-image"></i>
                                    <span class="title"> {{ $t('global.drag_msg') }} </span>
                                </div>
                            </label>
                        </div>
                        <input
                            type="file"
                            class="custom-file-drop"
                            id="product_photos"
                            accept="image/*"
                            @change="showFiles($event.target.files, $event.target.id)"
                            :class="{ 'is-invalid': form.errors.has('photo') }"
                            multiple
                        >
                    </div>
                </div>

                <!-- Details -->
                <div class="form-group">
                    <label> {{ $t('products_table.product_details') }} </label>
                    <div class="wrapper-details-product">
                        <div class="d-none d-sm-none d-md-block">
                            <div class="row row-table-label">
                                <div class="col-md-4 col-details">
                                    <label> {{ $t('products_table.name') }} </label>
                                </div>
                                <div class="col-md-4 col-details">
                                    <label> {{ $t('products_table.value') }} </label>
                                </div>
                                <div class="col-md-2 col-details">
                                    <label> {{ $t('datatable.display') }} </label>
                                </div>
                                <div class="col-md-2 col-details plus">
                                    <label> {{ $t('products_table.plus') }} </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row align-items-center form-data" v-for="(item, index) in form.details" :key="index">
                            <div class="col-sm-12 col-md-4 col-details">
                                <input
                                    type="text"
                                    v-model="form.details[index].name"
                                    :placeholder="$t('products_table.name')"
                                    class="form-control"
                                >
                            </div>
                            <div class="col-sm-12 col-md-4 col-details">
                                <input
                                    type="text"
                                    v-model="form.details[index].value"
                                    :placeholder="$t('products_table.value')"
                                    class="form-control"
                                >
                            </div>
                            <div class="col-sm-6 col-md-2 col-details">
                                <div class="action">
                                    <div class="custom-control custom-checkbox checkbox-display-details">
                                        <input type="checkbox" class="custom-control-input" :id="'display' + index" v-model="form.details[index].display">
                                        <label class="custom-control-label" :for="'display' + index"> <span class="d-block d-sm-block d-md-none"> {{ $t('datatable.display') }} </span> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-details">
                                <div class="action">
                                    <span class="plus-more-details btn btn-danger" @click="removeRowDetails(index)" v-if="form.details.length > 1 && (index + 1) !== form.details.length">
                                        <i class="fa fa-times"></i>
                                    </span>
                                    <span class="plus-more-details btn btn-success" @click="addRowDetails()" v-else>
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>
  export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        urlGetProductsTypes: '/pro-types-data',
        proTypes: [],
        urlGetAllCompanies: '/companies-id',
        companies: [],
        productPhoto: "",
        droppedFiles: false
      }
    },
    methods: {
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value);
        },
        encodeFileAsURL(files) {
            let self = this;
            if (files.length) {
                // multi images
                if (self.form.gallery.length < 6 && (self.form.gallery.length + files.length) < 7) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i]
                        let imageId = Math.floor(Math.random() * 10000);
                        let reader = new FileReader();
                        reader.onloadend = function() {
                            self.form.gallery.push({id: imageId, url: reader.result})
                        };
                        if (file) {
                            if (file["size"] > 8000000) {
                                if (this.$i18n.locale == 'ar') {
                                    Swal.fire(
                                        "خطأ...",
                                        "الحجم المسموح به للصورة هو 8 ميجا بايت.",
                                        "error"
                                    );
                                } else {
                                    Swal.fire(
                                        "Oops...",
                                        "You are uploading a large file 8MB last.",
                                        "error"
                                    );
                                }
                            } else if (file['type'] != 'image/jpeg' && file['type'] != 'image/png' && file['type'] != 'image/gif') {
                                if (this.$i18n.locale == 'ar') {
                                    Swal.fire(
                                        "خطأ...",
                                        "يجب أن تكون الصورة لها امتداد من هذه الإمتدادات [jpg, png, gif].",
                                        "error"
                                    );
                                } else {
                                    Swal.fire(
                                        "Oops...",
                                        "You must be image have extension between [jpg, png, gif].",
                                        "error"
                                    );
                                }
                            } else {
                                reader.readAsDataURL(file);
                            }
                        }
                    }
                } else {
                    if (this.$i18n.locale == 'ar') {
                        Swal.fire(
                            "خطأ...",
                            "يجب عليك تحميل 6 صور أو أقل.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Oops...",
                            "You must upload 6 images or less.",
                            "error"
                        );
                    }
                }

            } else {
                let file = files;
                let reader = new FileReader();
                reader.onloadend = function() {
                    self.form.photo = reader.result
                };
                if (file) {
                    if (file["size"] > 8000000) {
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                "الحجم المسموح به للصورة هو 8 ميجا بايت.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                "You are uploading a large file 8MB last.",
                                "error"
                            );
                        }
                    } else if (file['type'] != 'image/jpeg' && file['type'] != 'image/png' && file['type'] != 'image/gif') {
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                "يجب أن تكون الصورة لها امتداد من هذه الإمتدادات [jpg, png, gif].",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                "You must be image have extension between [jpg, png, gif].",
                                "error"
                            );
                        }
                    } else {
                        reader.readAsDataURL(file);
                    }
                }
            }
        },
        showFiles(files, input) {
            if (typeof input === 'string') {
                input = $('#' + input)
            }
            let lengthFiles = files.length;
            if (input.attr('multiple')) {
                if (lengthFiles > 0) {
                    this.encodeFileAsURL(files)
                }
            } else {
                if (lengthFiles > 0) {
                    this.encodeFileAsURL(files[0])
                }
            }
        },
        removePhoto(id) {
            let index = this.getIndex(this.form.gallery, 'id', id)
            if (this.typeForm == 'edit') {
                this.form.deletedGallery.push(this.form.gallery[index])
            }
            this.form.gallery.splice(index, 1)
        },
        handelDropImages() {
            const self = this;
            // view-images
            $('.wrapper-drop-image').on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
            }).on('dragover dragenter', function(e) {
                $(this).addClass('is-dragover');
            })
            .on('dragleave dragend drop', function() {
                $(this).removeClass('is-dragover');
            })
            .on('drop', function(e) {
                this.droppedFiles = e.originalEvent.dataTransfer.files;
                let lengthFiles = e.originalEvent.dataTransfer.files.length;
                let input = $(this).find('.custom-file-drop');
                self.showFiles(this.droppedFiles, input)
            });
        },
        addDomainToPhoto(url) { // return url
            let resultUrl = '';
            if (url.indexOf("data:image/") === 0) {
                resultUrl = url;
            } else {
                resultUrl = this.$domain + '/' + url;
            }
            return resultUrl;
        },

        addRowDetails() {
            this.form.details.push({name: '', value: '', display: true})
        },
        removeRowDetails(index) {
            if (this.typeForm == 'edit') {
                this.form.deletedDetails.push(this.form.details[index])
            }
            this.form.details.splice(index, 1)
        },

        getProductsTypes() {
          axios.post(this.urlGetProductsTypes).then(response => {
              if (response.status === 200) {
                  this.proTypes = response.data.types
              }
          })
          .catch(errors => {
                if (errors.response.status === 405) {
                    setTimeout(() => {
                        this.getProductsTypes()
                    }, 1000)
                }
            })
        },
        getCompanies(url = this.urlGetAllCompanies) {
            axios.post(url).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.companies = data;
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCompanies(this.urlGetAllCompanies)
                }, 1000)
            });
        },
    },
    computed: {
        calcNewPrice() {
            let result = 0;
            if (this.form.price > 0 && this.form.discount > 0) {
                if (this.form.percent == 1) {
                    result = this.form.price - (this.form.price * (this.form.discount / 100))
                } else {
                    result = this.form.price - this.form.discount;
                }
            } else {
                result = false;
            }
            return result;
        }
    },
    watch: {
        "form.photo"(val) {
            this.productPhoto = this.addDomainToPhoto(val);
        }
    },
    mounted() {
        const self = this;
        if (this.typeForm == 'edit') {
            let getPhoto = setInterval(() => {
                if (this.form.photo != '') {
                    this.productPhoto = this.$domain + '/' + this.form.photo
                    clearInterval(getPhoto)
                }
            }, 500)
        }
        this.getProductsTypes()
        this.handelDropImages()
        if (this.$gate.isAdmin()) {
            this.getCompanies()
        }
    }
  }
</script>
