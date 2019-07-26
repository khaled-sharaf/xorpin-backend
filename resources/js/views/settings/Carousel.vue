<style lang="scss" scoped>

.wrapper-drop-image {
    &, .overlay-drop-image {
        &, .view-overlay {
            min-height: 400px;
        }
    }
    .view-images {
        .image {
            &, .img {
                height: 210px;
            }
        }
    }
    &.contains-image {
        .view-overlay {
            min-height: 150px;
        }
    }
}

</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title="$t('settings_table.carousel')"></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h3 class="m-0 mb-2 text-dark">
                                    <h3 class="m-0 mb-2 text-dark">{{ $t('global.setting') | capitalize }}: <span style="color: #3498db"> {{ $t('settings_table.carousel') }} </span></h3>
                                </h3>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="updateCarousel()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <!-- carousel_images -->
                                    <div class="form-group">
                                        <div class="wrapper-drop-image"  :class="{'contains-image': form.value !== null && form.value.length > 0, 'is-invalid': form.errors.has('value')}" id="carousel_images_wrapper"> <!-- contains-image -->
                                            <div class="overlay-drop-image" for="carousel_images">
                                                <div class="view-images">
                                                    <div class="image elevation-5" v-for="image in form.value" :key="image.id">
                                                        <div class="img">
                                                            <img :src="addDomainToPhoto(image.url)">
                                                            <div class="remove-image" @click="removePhoto(image.id)"><i class="fas fa-times"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="view-overlay" for="carousel_images">
                                                    <div class="content-overlay">
                                                        <i class="icon far fa-image"></i>
                                                        <span class="title"> {{ $t('global.drag_msg') }} </span>
                                                    </div>
                                                </label>
                                            </div>
                                            <input
                                                type="file"
                                                class="custom-file-drop custom-file-input"
                                                id="carousel_images"
                                                accept="image/*"
                                                @change="showFiles($event.target.files, $event.target.id)"
                                                :class="{ 'is-invalid': form.errors.has('value') }"
                                                multiple
                                            >
                                            <has-error :form="form" field="value"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        :disabled="form.busy"
                                        class="btn btn-success float-right"
                                    > {{ $t('global.update') }} </button>
                                </div> <!-- ./card-footer -->

                            </form><!-- form -->
                        </div>
                    </div><!-- /.col-12 -->

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import HeaderPage from './../../components/HeaderPage'
import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        HeaderPage
    },
    data() {
      return {
        urlEditCarousel: '/setting/edit/carousel',
        urlUpdateCarousel: '/setting/update/carousel',
        form: new Form({
          id: 0,
          value: [],
          deleted_carousel_images: [],
        }),
        droppedFiles: false,
        idPage: 'settings',
        typePage: 'edit_carousel'
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
                if (self.form.value.length < 10 && (self.form.value.length + files.length) < 11) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i]
                        let imageId = Math.floor(Math.random() * 100000);
                        let reader = new FileReader();
                        reader.onloadend = function() {
                            self.form.value.push({id: imageId, url: reader.result})
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
                            "يجب عليك تحميل 10 صور أو أقل.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Oops...",
                            "You must upload 10 images or less.",
                            "error"
                        );
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
            }
        },
        removePhoto(id) {
            let index = this.getIndex(this.form.value, 'id', id)
            this.form.deleted_carousel_images.push(this.form.value[index])
            this.form.value.splice(index, 1)
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

        fillData(data) {
            let carousel = data
            if (carousel.value !== null && carousel.value != '') {
                let carousel_images = carousel.value.split(',')
                let carousel_images_arr = []
                carousel_images.forEach(image => {
                    carousel_images_arr.push({id:  Math.floor(Math.random() * 10000), url: image})
                })
                carousel.value = carousel_images_arr
            } else {
                carousel.value = []
            }
            carousel.deleted_carousel_images = []
            this.form.reset()
            this.form.fill(carousel)
        },
        updateCarousel() {
            loadReq(this.$Progress);
            this.form.post(this.urlUpdateCarousel).then(response => {
                if (response.status === 200) {
                    this.fillData(response.data.data)
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            })
            .catch(errors => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },
        getCarouselEdit() {
            axios.post(this.urlEditCarousel).then(response => {
                if (response.status === 200) {
                    const carousel = response.data.carousel
                    if (carousel != null) {
                        this.fillData(carousel)
                    } else {
                        this.$router.push({name: 'settings'})
                    }
                }
            })
            .catch(errors => {
                if (errors.response && errors.response.status != 404 && errors.response.status != 500) {
                    setTimeout(() => {
                        this.getCarouselEdit()
                    }, 1000)
                }
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('settings_table.carousel')
            vm.handelDropImages()
            vm.getCarouselEdit()
        })
    }
}
</script>
