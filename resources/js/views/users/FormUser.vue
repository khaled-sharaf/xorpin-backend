
<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- name -->
                <div class="form-group">
                    <label>Name <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    placeholder="Name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>

                <!-- email -->
                <div class="form-group">
                    <label>Email <span class="field-required"></span></label>
                    <input
                    v-model="form.email"
                    type="text"
                    placeholder="Email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    >
                    <has-error :form="form" field="email"></has-error>
                </div>

                <!-- password -->
                <div class="form-group">
                    <label>Password <span class="field-required"></span></label>
                    <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    >
                    <has-error :form="form" field="password"></has-error>
                </div>

                <!-- password confirm -->
                <div class="form-group">
                    <label>Repeat Password <span class="field-required"></span></label>
                    <input
                    v-model="form.password_confirmation"
                    type="password"
                    placeholder="Repeat Password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                    >
                    <has-error :form="form" field="password_confirmation"></has-error>
                </div>

                <!-- phone -->
                <div class="form-group">
                    <label>Mobile</label>
                    <input
                    v-model="form.phone"
                    type="text"
                    placeholder="Mobile"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('phone') }"
                    >
                    <has-error :form="form" field="phone"></has-error>
                </div>

                <!-- address -->
                <div class="form-group">
                    <label>Address</label>
                    <input
                    v-model="form.address"
                    type="text"
                    placeholder="Address"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('address') }"
                    >
                    <has-error :form="form" field="address"></has-error>
                </div>

                <!-- rule -->
                <div class="form-group" v-if="((typeForm === 'edit' && form.id !== 1) || typeForm === 'create') && $gate.isAdmin()">
                    <label>Rule <span class="field-required"></span></label>
                    <select
                    v-model="form.rule"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('rule') }"
                    >
                    <option
                        v-for="(rule, i) in userRules"
                        :value="rule.value"
                        :key="i"
                    >{{ rule.text }}</option>
                    </select>
                    <has-error :form="form" field="rule"></has-error>
                </div>

                <!-- company -->
                <div class="form-group" v-if="(selectCompany && ((typeForm === 'edit' && form.id !== 1) || typeForm === 'create')) && $gate.isAdmin()">
                    <label>Company <span class="field-required"></span></label>
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

                <!-- active -->
                <div class="form-group" v-if="((typeForm === 'edit' && form.id !== 1) || typeForm === 'create') && $gate.isAdmin()">
                    <label>Active <span class="field-required"></span></label>
                    <select
                    v-model="form.active"
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('active') }"
                    >
                    <option
                        v-for="(type, i) in userActive"
                        :value="type.value"
                        :key="i"
                    >{{ type.text }}</option>
                    </select>
                    <has-error :form="form" field="active"></has-error>
                </div>

                <div class="form-group">
                    <label>User Avatar</label>
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
                    <label class="custom-file-label" for="user_image">Choose Image</label>
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
        urlGetAllCompanies: '/companies-id',
        userAvatar: "",
        oldUserAvatar: "images/user-avatar/default-avatar.png",
        showBtnRemoveAvatar: false
      }
    },
    methods: {
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
                    Swal.fire(
                        "Oops...",
                        "You are uploading a large file, (8MB) last.",
                        "error"
                    );
                    this.form.photo = this.oldUserAvatar;
                }
            } else {
                this.form.photo = this.oldUserAvatar;
            }
            e.target.value = ''
        },
        removeAvatar() {
            this.form.photo = this.oldUserAvatar
            this.userAvatar = this.$domain + '/' + this.oldUserAvatar
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
    watch: {
        "form.photo"(val) {
            if (val.indexOf("data:image/") == 0) {
                this.userAvatar = val;
                this.showBtnRemoveAvatar = true
            } else if (val != this.oldUserAvatar && this.typeForm == 'edit') {
                this.showBtnRemoveAvatar = true
            } else if (val == '' || val == null) {
                this.userAvatar = this.$domain + '/' + this.oldUserAvatar;
                this.showBtnRemoveAvatar = false
            } else {
                this.userAvatar = this.$domain + '/' + val;
                this.showBtnRemoveAvatar = false
            }
        },
        "form.rule"(val) {
            this.selectCompany = val == 2 ? true : false;
        }
    },
    mounted() {
        if (this.$gate.isAdmin()) {
            this.getCompanies();
        }
        if (this.typeForm == 'create') {
            this.form.photo = this.oldUserAvatar;
        } else {
            let getPhoto = setInterval(() => {
                if (this.form.photo != '') {
                    this.userAvatar = this.$domain + '/' + this.form.photo
                    clearInterval(getPhoto)
                }
            }, 500)
        }
    },
  }
</script>
