
<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- name -->
                <div class="form-group">
                    <label>{{ $t('users_table.name') }} <span class="field-required"></span></label>
                    <input
                        v-model="form.name"
                        type="text"
                        :placeholder="$t('users_table.name')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>

                <!-- email -->
                <div class="form-group">
                    <label>{{$t('users_table.email')}} <span class="field-required"></span></label>
                    <input
                        v-model="form.email"
                        type="text"
                        :placeholder="$t('users_table.email')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                    >
                    <has-error :form="form" field="email"></has-error>
                </div>

                <!-- password -->
                <div class="form-group">
                    <label>{{$t('users_table.password') }}<span class="field-required"></span></label>
                    <input
                        v-model="form.password"
                        type="password"
                        :placeholder="$t('users_table.password')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                    >
                    <has-error :form="form" field="password"></has-error>
                </div>

                <!-- password confirm -->
                <div class="form-group">
                    <label>{{$t('users_table.repeat_password')}} <span class="field-required"></span></label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        :placeholder="$t('users_table.repeat_password')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                    >
                    <has-error :form="form" field="password_confirmation"></has-error>
                </div>

                <!-- phone -->
                <div class="form-group">
                    <label> {{$t('users_table.phone')}} </label>
                    <input
                        v-model="form.phone"
                        type="text"
                        :placeholder="$t('users_table.phone')"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('phone') }"
                    >
                    <has-error :form="form" field="phone"></has-error>
                </div>

                <!-- address -->
                <div class="form-group">
                    <label>{{$t('users_table.address')}} </label>
                    <select
                        style="transform: scale(0); height: 0;"
                        class="custom-select"
                        v-select2address="form.address"
                        :class="{ 'is-invalid': form.errors.has('address') }"
                    >
                        <!-- <optgroup v-for="gov in cities" :key="gov.governorate.id" :label="gov.governorate.governorate_name"> -->
                            <option
                                v-for="governorate in governorates" :key="governorate.id"
                                :value="governorate.id"
                                v-text="governorate.governorate_name"
                                :selected="typeForm == 'edit' && governorate.id == form.address"
                            >
                            ></option>
                        <!-- </optgroup> -->
                    </select>
                    <has-error :form="form" field="address"></has-error>
                </div>

                <!-- rule -->
                <div class="form-group" v-if="((typeForm === 'edit' && form.id !== 1) || typeForm === 'create') && $gate.isAdmin()">
                    <label>{{$t('users_table.rule')}} <span class="field-required"></span></label>
                    <select
                        v-model="form.rule"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('rule') }"
                        >
                        <option value="0">{{$t('users_table.rules.user')}}</option>
                        <option value="2">{{$t('users_table.rules.company')}}</option>
                        <option value="1">{{$t('users_table.rules.admin')}}</option>
                    </select>
                    <has-error :form="form" field="rule"></has-error>
                </div>

                <!-- company -->
                <div class="form-group" v-if="(selectCompany && ((typeForm === 'edit' && form.id !== 1) || typeForm === 'create')) && $gate.isAdmin()">
                    <label>{{$t('users_table.company')}} <span class="field-required"></span></label>
                    <select
                        v-model="form.company_id"
                        class="custom-select"
                        :class="{ 'is-invalid': form.errors.has('company_id') }"
                        style="direction: ltr; text-align: left"
                    >
                    <option
                        v-for="company in companies"
                        :value="company.id"
                        :key="company.id"
                    >{{ company.name }}</option>
                    </select>
                    <has-error :form="form" field="company_id"></has-error>
                </div>

                <!-- active -->
                <div class="form-group" v-if="((typeForm === 'edit' && form.id !== 1) || typeForm === 'create') && $gate.isAdmin()">
                    <label>{{$t('datatable.activation')}} <span class="field-required"></span></label>
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
                    <label> {{$t('users_table.photo')}} </label>
                    <div class="custom-file">
                    <input
                        :lang="$i18n.locale"
                        type="file"
                        class="custom-file-input"
                        id="user_image"
                        accept="image/*"
                        @change="encodeUserProfileFileAsURL"
                        :class="{ 'is-invalid': form.errors.has('photo') }"
                    >
                    <label class="custom-file-label" for="user_image"> {{$t('global.choose_image')}} </label>
                    <has-error :form="form" field="photo"></has-error>
                    </div>
                    <div class="col-sm-12" style="text-align: center;">
                        <div class="user-avatar">
                            <span @click="removeAvatar" v-if="showBtnRemoveAvatar" class="remove-avatar"><i class="fas fa-times"></i> </span>
                            <img :src="userAvatar">
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
        userActive: [
          { text: "Active", value: 1 },
          { text: "Deactive", value: 0 }
        ],
        userRules: [
          { text: "User", value: 0 },
          { text: "User company", value: 2 },
          { text: "Admin", value: 1 },
        ],
        selectCompany: false,
        companies: [],
        // cities: [],
        governorates: [],
        urlGetAllCompanies: '/companies-id',
        // urlGetCities: '/cities',
        urlGetGovernorates: '/governorates',
        userAvatar: "",
        oldUserAvatar: "images/user-avatar/default-avatar.png",
        showBtnRemoveAvatar: false
      }
    },
    methods: {
        imageHasHttp(imageUrl) {
            return imageUrl.indexOf('http') === 0 ? imageUrl : this.$domain + '/' + imageUrl;
        },
        encodeUserProfileFileAsURL(e) {
            let self = this;
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = function() {
                self.form.photo = reader.result;
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
                    this.form.photo = this.oldUserAvatar;
                }
            } else {
                this.form.photo = this.oldUserAvatar;
            }
            e.target.value = ''
        },
        removeAvatar() {
            this.form.photo = this.oldUserAvatar
            this.userAvatar = this.imageHasHttp(this.oldUserAvatar)
        },
        getCompanies() {
            axios.post(this.urlGetAllCompanies).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.companies = data;
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCompanies()
                }, 1000)
            });
        },
        getGovernorates() {
            axios.post(this.urlGetGovernorates).then(response => {
                let data = response.data;
                if (response.status === 200) {
                    this.governorates = data;
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getGovernorates()
                }, 1000)
            });
        },
    },
    watch: {
        "form.photo"(val) {
            if (val.indexOf("data:image/") == 0) {
                this.userAvatar = val;
                this.showBtnRemoveAvatar = true
            } else if (val != this.oldUserAvatar && this.typeForm == 'edit') {
                this.showBtnRemoveAvatar = true
            } else if (val == '' || val == null) {
                this.userAvatar = this.imageHasHttp(this.oldUserAvatar);
                this.showBtnRemoveAvatar = false
            } else {
                this.userAvatar = this.imageHasHttp(val);
                this.showBtnRemoveAvatar = false
            }


            // if go to profile only
            if (this.typeForm == 'edit') {
                if (this.form.photo != '' && this.form.photo.indexOf('data:image/') !== 0) {
                    this.userAvatar = this.imageHasHttp(this.form.photo)
                }
            }

        },
        "form.rule"(val) {
            this.selectCompany = val == 2 ? true : false;
        }
    },
    mounted() {
        if (this.$gate.isAdmin()) {
            this.$nextTick( () => {
                this.getGovernorates();
                this.getCompanies();
            })
            // this.getCities();
        }
        if (this.typeForm == 'create') {
            this.form.photo = this.oldUserAvatar;
        } else {
            let getPhoto = setInterval(() => {
                if (this.form.photo != '') {
                    this.userAvatar = this.imageHasHttp(this.form.photo)
                    clearInterval(getPhoto)
                }
            }, 500)
        }
    },
  }
</script>
