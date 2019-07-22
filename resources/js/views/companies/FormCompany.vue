<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- name -->
                <div class="form-group">
                    <label> {{ $t('companies_table.name') }} <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    :placeholder="$t('companies_table.name')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>


                <!-- about the company -->
                <div class="form-group">
                    <label> {{ $t('companies_table.description') }} <span class="field-required"></span></label>
                    <textarea
                        v-model="form.description"
                        type="text"
                        :placeholder="$t('companies_table.description')"
                        class="form-control textarea-form"
                        :class="{ 'is-invalid': form.errors.has('description') }"
                    ></textarea>
                    <has-error :form="form" field="description"></has-error>
                </div>

                <!-- email -->
                <div class="form-group">
                    <label> {{ $t('companies_table.email') }} </label>
                    <input
                    v-model="form.email"
                    type="text"
                    :placeholder="$t('companies_table.email')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    >
                    <has-error :form="form" field="email"></has-error>
                </div>

                <!-- phone -->
                <div class="form-group">
                    <label> {{ $t('companies_table.phone') }} </label>
                    <input
                    v-model="form.phone"
                    type="text"
                    :placeholder="$t('companies_table.phone')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('phone') }"
                    >
                    <has-error :form="form" field="phone"></has-error>
                </div>

                <!-- website -->
                <div class="form-group">
                    <label> {{ $t('companies_table.website') }} </label>
                    <input
                    v-model="form.website"
                    type="text"
                    :placeholder="$t('companies_table.website')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('website') }"
                    >
                    <has-error :form="form" field="website"></has-error>
                </div>

                <!-- address -->
                <div class="form-group">
                    <label> {{ $t('companies_table.address') }} </label>
                    <input
                    v-model="form.address"
                    type="text"
                    :placeholder="$t('companies_table.address')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('address') }"
                    >
                    <has-error :form="form" field="address"></has-error>
                </div>

                <!-- latitude -->
                <div class="form-group">
                    <label> {{ $t('companies_table.latitude') }} </label>
                    <!-- v-model="form.latitude" -->
                    <input
                    type="text"
                    :placeholder="$t('companies_table.latitude')"
                    id="company_latitude"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('latitude') }"
                    readonly
                    >
                    <has-error :form="form" field="latitude"></has-error>
                </div>

                <!-- longitude -->
                <div class="form-group">
                    <label> {{ $t('companies_table.longitude') }} </label>
                    <!-- v-model="form.longitude" -->
                    <input
                    type="text"
                    :placeholder="$t('companies_table.longitude')"
                    id="company_longitude"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('longitude') }"
                    readonly
                    >
                    <has-error :form="form" field="longitude"></has-error>
                    <div class="">
                        <button type="button" class="btn btn-danger btn-sm mt-1" id="remove-location-company"> {{ $t('companies_table.remove_location') }} </button>
                    </div>
                </div>


                <!-- show latitude and longitude in google map -->
                <div class="form-group">
                    <div class="myMap" :data-lat="typeForm == 'create' || form.latitude == null ? '30.0444196' : form.latitude" :data-long="typeForm == 'create' || form.longitude == null ? '31.23571160000006' : form.longitude">
                        <!-- <h5>ابحث عن مكان الشركة ثم حرك العلامة الحمراء إلى مكان الشركة بشكل دقيق</h5> -->
                        <h5 class="info-map"> {{ $t('companies_table.msg_location_map') }}</h5>
                        <div id="floating-panel">
                            <input class="form-control" id="address" type="text" value="مصر، القاهرة" :placeholder="$t('datatable.search')">
                            <span class="error-location"> {{ $t('companies_table.error_location') }} </span>
                        </div>
                        <div id="map"></div>
                    </div>

                </div>


                <!-- facebook link -->
                <div class="form-group">
                    <label> {{ $t('companies_table.face_link') }} </label>
                    <input
                    v-model="form.face_link"
                    type="text"
                    :placeholder="$t('companies_table.face_link')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('face_link') }"
                    >
                    <has-error :form="form" field="face_link"></has-error>
                </div>

                <!-- twitter link -->
                <div class="form-group">
                    <label> {{ $t('companies_table.tw_link') }} </label>
                    <input
                    v-model="form.tw_link"
                    type="text"
                    :placeholder="$t('companies_table.tw_link')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('tw_link') }"
                    >
                    <has-error :form="form" field="tw_link"></has-error>
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

                <!-- active -->
                <div class="form-group" v-if="$gate.isAdmin()">
                    <label> {{ $t('datatable.activation') }}  <span class="field-required"></span></label>
                    <select
                        v-model="form.active"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('active') }"
                        >
                        <option value="1">{{$t('global.active')}}</option>
                        <option value="0">{{$t('global.disactive')}}</option>
                    </select>
                    <has-error :form="form" field="active"></has-error>
                </div>

                <div class="form-group">
                    <label> {{ $t('companies_table.logo') }} </label>
                    <div class="custom-file">
                    <input
                        :lang="$i18n.locale"
                        type="file"
                        class="custom-file-input"
                        id="user_image"
                        accept="image/*"
                        @change="encodeUserProfileFileAsURL"
                        :class="{ 'is-invalid': form.errors.has('logo') }"
                    >
                    <label class="custom-file-label" for="user_image">{{$t('global.choose_image')}}</label>
                    <has-error :form="form" field="logo"></has-error>
                    </div>
                    <div class="col-sm-12" style="text-align: center;">
                        <div class="user-avatar">
                            <span @click="removeAvatar" v-if="showBtnRemoveAvatar" class="remove-avatar"><i class="fas fa-times"></i> </span>
                            <img :src="companyLogo">
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
        companyLogo: "",
        oldCompanyLogo: "images/companies-logo/company-default-avatar.jpg",
        showBtnRemoveAvatar: false
      }
    },
    methods: {
        encodeUserProfileFileAsURL(e) {
            let self = this;
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = function() {
                self.form.logo = reader.result;
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
                    this.form.logo = this.oldCompanyLogo;
                }
            } else {
                this.form.logo = this.oldCompanyLogo;
            }
            e.target.value = ''
        },
        removeAvatar() {
            this.form.logo = this.oldCompanyLogo
            this.companyLogo = this.$domain + '/' + this.oldCompanyLogo
        },
        showGoogleMapCompany() {
            var scriptMap = document.createElement('script');
            document.body.appendChild(scriptMap);
            scriptMap.id = 'scriptMapCompany';
            scriptMap.setAttribute('async', true);
            scriptMap.setAttribute('defer', true);
            scriptMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyADsFcbM6g-A_nUwh41pFn9EgDdlRC6lGY&language=ar&region=EG&callback=initMapCompany');
        },
    },
    watch: {
        "form.logo"(val) {
            if (val.indexOf("data:image/") == 0) {
                this.companyLogo = val;
                this.showBtnRemoveAvatar = true
            } else if (val != this.oldCompanyLogo && this.typeForm == 'edit') {
                this.showBtnRemoveAvatar = true
            } else if (val == '' || val == null) {
                this.companyLogo = this.$domain + '/' + this.oldCompanyLogo;
                this.showBtnRemoveAvatar = false
            } else {
                this.companyLogo = this.$domain + '/' + val;
                this.showBtnRemoveAvatar = false
            }
        }
    },
    mounted() {
        this.showGoogleMapCompany()
        if (this.typeForm == 'create') {
            this.form.logo = this.oldCompanyLogo
        } else {
            let getPhoto = setInterval(() => {
                if (this.form.logo != '') {
                    this.companyLogo = this.$domain + '/' + this.form.logo
                    clearInterval(getPhoto)
                }
            }, 500)
        }
    }
  }
</script>
