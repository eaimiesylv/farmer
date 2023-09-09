<template>
  <div class="container-fluid p-0">
    <form
          class="sign-in-sign-up-form w-100"
            ref="form"
            data-url="admin/users/login"
          >
       
          <div class="form-row">
              <div class="form-group col-12">
                <label>{{ $t("email") }}</label>
                <app-input
                  type="email"
                  :placeholder="$t('your_email')"
                  :required="true"
                  v-model="login.email"
                />
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-12">
                <label>{{ $t("password") }}</label>
                <app-input
                  type="password"
                  v-on:keyup.enter="submitData"
                  :placeholder="$t('your_password')"
                  :required="true"
                  v-model="login.password"
                  :show-password="true"
                />
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-12">
                <button
                  type="button"
                  class="btn btn-primary btn-block text-center"
                  @click="submitData"
                >
                  <span class="w-100">
                    <app-submit-button-loader v-if="loading"></app-submit-button-loader>
                  </span>
                  <template v-if="!loading">{{ $t("login") }}</template>
                </button>
              </div>
            </div>



          <div class="form-row">
              <div class="col-6">
                <!--register button-->
                <router-link to="/admin/users/register" class="bluish-text">
                  <i data-feather="user" class="pr-2" />
                  Register
              </router-link>
              </div>
              <div class="col-6 text-right">
               
                 <!--forget password button
                 <router-link to="/users/password-reset" class="bluish-text">Forgot Password</router-link>-->
                <a href="#" class="bluish-text" @click="forgetPassword">
                  <i data-feather="lock" class="pr-2" />{{ $t("forgot_password") }}?
                </a>
              </div>
              
          </div>
    </form>
  </div>       
</template>

<script>
import { companyName, copyRightText} from "../../../Helpers/helpers";
import { FormSubmitMixin } from "../../../Mixins/Global/FormSubmitMixin";

export default {
  name: "Login",
  mixins: [FormSubmitMixin],
  data() {
    return {
      companyName,
      copyRightText,
      login: {
        email: null,
        password: null,
      },
     
      userRole: null,
    };
  },
  methods: {
    
    submitData() {
      //this method is found in FormMixin.js 51
      this.save(this.login);
    },
    afterSuccess({ data }) {
      window.location.href = data;
    },
    afterError(response) {
      this.loading = false;
      this.$toastr.e(response.data.message);
    },
    forgetPassword() {
      window.location = urlGenerator(`users/password-reset`);
    },
  },

  mounted() {},
};
</script>
