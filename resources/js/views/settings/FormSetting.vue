<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- slug -->
                <div class="form-group">
                    <label> {{ $t('settings_table.slug') }} <span class="field-required"></span></label>
                    <input
                    v-model="form.slug"
                    type="text"
                    :placeholder="$t('settings_table.slug')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('slug') }"
                    >
                    <has-error :form="form" field="slug"></has-error>
                </div>


                <!-- name -->
                <div class="form-group">
                    <label> {{ $t('settings_table.name') }} <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    :placeholder="$t('settings_table.name')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>


                <!-- type -->
                <div class="form-group">
                    <label> {{ $t('settings_table.type') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.type"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('type') }"
                    >
                        <option value="string"> {{ $t('settings_table.setting_types.string') }} </option>
                        <option value="text"> {{ $t('settings_table.setting_types.text') }} </option>
                        <option value="image"> {{ $t('settings_table.setting_types.image') }} </option>
                    </select>
                    <has-error :form="form" field="type"></has-error>
                </div>


                <!-- vlaue -->

                <div class="form-group">
                    <label> {{ $t('settings_table.value') }} <span class="field-required"></span></label>
                    <div v-if="form.type == 'string'">
                        <input
                            v-model="form.value"
                            type="text"
                            :placeholder="$t('settings_table.value')"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        >
                        <has-error :form="form" field="value"></has-error>
                    </div>

                    <div v-else-if="form.type == 'text'">
                        <textarea
                            v-model="form.value"
                            type="text"
                            :placeholder="$t('settings_table.value')"
                            class="form-control textarea-form"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        ></textarea>
                        <has-error :form="form" field="value"></has-error>
                    </div>
                    <div v-else-if="form.type == 'image'">
                        <div class="custom-file">
                            <input
                                :lang="$i18n.locale"
                                type="file"
                                class="custom-file-input"
                                id="setting_image"
                                accept="image/*"
                                @change="encodeImageSettingAsURL"
                                :class="{ 'is-invalid': form.errors.has('value') }"
                            >
                            <label class="custom-file-label" for="setting_image">{{$t('global.choose_image')}}</label>
                            <has-error :form="form" field="value"></has-error>
                        </div>
                        <div class="col-sm-12" style="text-align: center;">
                            <div class="preview-image-setting-in-form" v-if="previewImage != ''" :class="previewImage != '' ? 'elevation-5 not-empty' : ''">
                                <img :src="previewImage.indexOf('data:image') === 0 ? previewImage : $domain + '/' + previewImage">
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
        previewImage: ""
      }
    },
    methods: {
        encodeImageSettingAsURL(e) {
            let self = this;
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = function() {
                self.form.value = reader.result;
                self.previewImage = reader.result;
            };
            if (file) {
                if (file["size"] < 8000000) {
                    reader.readAsDataURL(file);
                } else {
                    if (this.$i18n.locale == 'ar') {
                        Swal.fire(
                            "خطأ...",
                            "الحجم المسموح به للصورة هو 8 ميجا بايت.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Oops...",
                            "You are uploading a large file, (8MB) last.",
                            "error"
                        );
                    }
                }
            }
            e.target.value = ''
        }
    },
    watch: {
        "form.type"(newVal, oldVal) {
            if (newVal == 'image' || oldVal == 'image') {
                if (this.previewImage == '') {
                    if (this.form.value.indexOf('data:image/') === 0 || this.form.value.indexOf('images/settings/') === 0) {
                        this.previewImage = this.form.value
                    }
                }
                this.form.value = ''
            }
            if (newVal == 'image') {
                this.form.value = this.previewImage
            }
        }
    },
    mounted() {

    },
  }
</script>
