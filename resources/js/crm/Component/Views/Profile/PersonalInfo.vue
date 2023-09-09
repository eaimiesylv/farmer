<template>
  <app-overlay-loader v-if="preLoader" />
   
    <div class="content py-primary" v-else>
    
        <form ref="form" data-url='admin/auth/users/change-settings'>
            <!-- first name -->
           <!-- 
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-first-name"
                               class="text-left d-block mb-lg-2 mb-xl-0">{{$t('first_name')}}</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-first-name"
                                   :placeholder="$t('first_name')"
                                   :required="true"
                                   v-model="userProfileInfo.first_name"/>
                    </div>
                </div>
            </div>
            -->
            <!-- fullname -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-fullname"
                               class="text-left d-block mb-lg-2 mb-xl-0">Full name</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-fullname"
                                   placeholder="Fullname"
                                   :required="true"
                                   v-model="userProfileInfo.fullname"/>
                    </div>
                </div>
            </div>
             <!-- last name -->
            <!--<div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-last-name"
                               class="text-left d-block mb-lg-2 mb-xl-0">{{$t('last_name')}}</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-last-name"
                                   :placeholder="$t('last_name')"
                                   :required="true"
                                   v-model="userProfileInfo.last_name"/>
                    </div>
                </div>
            </div>-->
             <!-- email -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-email"
                               class="text-left d-block mb-lg-2 mb-xl-0">{{$t('enter_email')}}</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                  
                                   id="input-select-email"
                                   :placeholder="$t('email', '')"
                                   v-model="userProfileInfo.email"
                                   :required="true"
                                   :list="personEmail"/>
                    </div>
                   
                </div>
            </div>  
            
              <!-- company website -->
                <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-company-website"
                               class="text-left d-block mb-lg-2 mb-xl-0">Company Website</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-company-website"
                                   placeholder="Company website"
                                   :required="true"
                                   v-model="userProfileInfo.fullname"/>
                    </div>
                </div>
            </div>

            <!-- contact person -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-contact-person"
                               class="text-left d-block mb-lg-2 mb-xl-0">Contact Person</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-contact-person"
                                   placeholder="Contact person"
                                   :required="true"
                                   v-model="userProfileInfo.contact_person"/>
                    </div>
                </div>
            </div>

             <!-- phone Number -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-phone_number"
                               class="text-left d-block mb-lg-2 mb-xl-0">Phone Number</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-phone_number"
                                   placeholder="Phone Number"
                                   :required="true"
                                   v-model="userProfileInfo.contact_person"/>
                    </div>
                </div>
            </div>

             <!-- gender -->
           <!-- <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label
                            class="text-left d-block mb-lg-2 mb-xl-0">{{$t('gender')}}</label>
                    </div>
                    <div class="col-xl-8" v-if="userProfileInfo.profile">
                        <app-input type="radio"
                                   :list="[{id:'male',
                                    value: $t('male')},
                                    {id:'female',
                                    value:  $t('female')}]"
                                   v-model="userProfileInfo.profile.gender"/>
                    </div>
                </div>
            </div>
            
            -->
             <!-- Contact number 
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-contact"
                               class="text-left d-block mb-lg-2 mb-xl-0">{{$t('contact_number')}}
                        </label>
                    </div>
                    <div class="col-xl-8" v-if="userProfileInfo.profile">
                        <app-input type="tel-input"
                                   id="input-text-contact"
                                   :placeholder="$t('enter_contact_number')"
                                   v-model="userProfileInfo.profile.contact"/>
                    </div>
                </div>
            </div>-->
             <!-- Address 
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-address"
                               class="text-left d-block mb-lg-2 mb-xl-0">{{$t('address')}}</label>
                    </div>
                    <div class="col-xl-8" v-if="userProfileInfo.profile">
                        <app-input type="text"
                                   id="input-text-address"
                                   :placeholder="$t('enter_address')"
                                   v-model="userProfileInfo.profile.address"/>
                    </div>
                </div>
            </div>-->

             <!-- dob 
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label class="text-left d-block mb-lg-2 mb-xl-0">
                            {{$t('date_of_birth')}}
                        </label>
                    </div>
                    <div class="col-xl-8" v-if="userProfileInfo.profile">
                        <app-input type="date"
                                   v-model="userProfileInfo.profile.date_of_birth"
                                   :placeholder="$t('enter_date_of_birth')"
                                  />
                    </div>
                </div>
            </div>-->

            <!-- submit button
            <div class="form-group mt-5">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary mr-3"
                                @click="submitData">
                            <span class="w-100">
                                <app-submit-button-loader v-if="loading"></app-submit-button-loader>
                            </span>
                            <template v-if="!loading">{{ $t('save') }}</template>
                        </button>
                        <button type="button" class="btn btn-secondary" @click="cancelData"> {{$t('cancel')}}
                        </button>
                    </div>
                </div>
            </div>-->
        </form>
    </div>
</template>

<script>

    import {FormMixin} from "@core/mixins/form/FormMixin.js";
    import HelperMixin from "@app/Mixins/Global/HelperMixin";

    export default {
        name: "PersonalInfo",
        props: {
            props:{
                type:Object,
                default:null
            },
           
        },
        mixins: [FormMixin,HelperMixin],
        data(){
            return{
                userProfileInfo:{},
                loading: false,
                preLoader:false,
                personEmail: []
            }
        },

        methods:{
            beforeSubmit(){
                this.preLoader = true;
                this.loading = true;
            },
            submitData() {
                let profile = this.userProfileInfo;
                profile.gender = this.userProfileInfo.profile.gender;
                profile.contact = this.userProfileInfo.profile.contact;
                profile.address = this.userProfileInfo.profile.address;
                profile.date_of_birth = this.userProfileInfo.profile.date_of_birth ?
                moment(this.userProfileInfo.profile.date_of_birth).format('YYYY-MM-DD') : '';
                this.save(profile);
            },

            cancelData(){
              location.reload();
            },

            afterError(response) {
                this.loading = false;
                this.$toastr.e(response.data.message);
            },
            afterSuccess(response) {
                this.$toastr.s(response.data.message);
            },

            afterFinalResponse() {
                this.loading = false;
                this.preLoader = true;
                this.scrollToTop(false);
                 setTimeout(() => location.reload())
            },
            /*getLeadUserInfo(){
                this.axiosGet(
                    route('lead.user_info')
                ).then((res) => {
                    this.personEmail = res.data.email.map(item => {
                        return {
                            id: item.value,
                            value: item.value
                        }
                    })
                });
            }*/
        },
        computed: {
            clientRoleAccess(){
                return (!this.$can('manage_public_access') && this.$can('client_access'));
            },
            userInfo() {
                if (!this.props) {  
                    return this.$store.getters.getUserInformation;
                }
            }
        },

      created(){
        //this.preLoader = true;
      },

        watch: {
            userInfo: {
                handler: function (user) {
                
                  this.preLoader = false;
                    this.userProfileInfo = { ...user };
                    
                },
                deep: true
            }
        },

        mounted(){
            if(this.props){
                this.userProfileInfo = { ...this.props }
            }
           
            this.$store.dispatch('getUserInformation');
            if (this.clientRoleAccess){
                //called at 280
                //this.getLeadUserInfo();
            }
        }

    }
</script>

