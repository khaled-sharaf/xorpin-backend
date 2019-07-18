<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- slug -->
                <div class="form-group">
                    <label>Slug <span class="field-required"></span></label>
                    <input
                    v-model="form.slug"
                    type="text"
                    placeholder="Slug"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('slug') }"
                    >
                    <has-error :form="form" field="slug"></has-error>
                </div>


                <!-- name -->
                <div class="form-group">
                    <label>Name <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    placeholder="example: setting_name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>


                <!-- type -->
                <div class="form-group">
                    <label>Type <span class="field-required"></span></label>
                    <select
                    v-model="form.type"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('type') }"
                    >
                    <option
                        v-for="(type, i) in types"
                        :value="type.value"
                        :key="i"
                    >{{ type.text }}</option>
                    </select>
                    <has-error :form="form" field="type"></has-error>
                </div>


                <!-- vlaue -->

                <div class="form-group">
                    <label>Value <span class="field-required"></span></label>
                    <div v-if="form.type == 'string'">
                        <input
                            v-model="form.value"
                            type="text"
                            placeholder="Value"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        >
                        <has-error :form="form" field="value"></has-error>
                    </div>

                    <div v-else-if="form.type == 'text'">
                        <textarea
                            v-model="form.value"
                            type="text"
                            placeholder="Value"
                            class="form-control textarea-form"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        ></textarea>
                        <has-error :form="form" field="value"></has-error>
                    </div>
                    <div v-else-if="form.type == 'image'">
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="setting_image"
                                accept="image/*"
                                @change="encodeImageSettingAsURL"
                                :class="{ 'is-invalid': form.errors.has('value') }"
                            >
                            <label class="custom-file-label" for="setting_image">Choose Image</label>
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
        types: [
          { text: "String", value: 'string' },
          { text: "Text", value: 'text' },
          { text: "Image", value: 'image' },
        ],
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
                    Swal.fire(
                        "Oops...",
                        "You are uploading a large file, (8MB) last.",
                        "error"
                    );
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
