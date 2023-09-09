<template>
  <app-overlay-loader v-if="preLoader" />
   
    <div class="content py-primary" v-else>
    
        <form ref="form" data-url='admin/auth/users/change-settings'>
           
            <!-- finanical institution -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-fullname"
                               class="text-left d-block mb-lg-2 mb-xl-0">Financial Institution</label>
                    </div>
                    <div class="col-xl-8">
                       
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-fullname"
                                   placeholder="Fullname"
                                   :required="true"
                                   v-model="userProfileInfo['investor_detail'][0].finance_institution"/>
                                    
                    </div>
                </div>
            </div>
            
             <!-- Investment type -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-fullname"
                               class="text-left d-block mb-lg-2 mb-xl-0">Investment Type</label>
                    </div>
                    <div class="col-xl-8">
                       
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-investment_type"
                                   placeholder="Investment Type"
                                   :required="true"
                                   v-model="userProfileInfo['investor_detail'][0].investment_type"/>
                                    
                    </div>
                </div>
            </div>
            
              <!-- preferred deal size -->
                <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-company-website"
                               class="text-left d-block mb-lg-2 mb-xl-0">Preferred Deal Size</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-preferred_deal_size"
                                   placeholder="Preferred Deal Size"
                                   :required="true"
                                   v-model="userProfileInfo['investor_detail'][0].preferred_deal_size"/>
                    </div>
                </div>
            </div>

           

             <!-- funding type -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-phone_number"
                               class="text-left d-block mb-lg-2 mb-xl-0">Funding Type</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-funding_type"
                                   placeholder="Funding Type"
                                   :required="true"
                                   v-model="userProfileInfo['investor_detail'][0].funding_type"/>
                    </div>
                </div>
            </div>

             <!-- organization description -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-phone_number"
                               class="text-left d-block mb-lg-2 mb-xl-0">Organization Description</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-organization_description"
                                   placeholder="Organization description"
                                   :required="true"
                                    v-model="userProfileInfo['investor_detail'][0].organization_description"/>
                    </div>
                </div>
            </div>


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
        props: ['props'],
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
            getLeadUserInfo(){
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
            }
        },
        computed: {
            clientRoleAccess(){
                return (!this.$can('manage_public_access') && this.$can('client_access'));
            },
            userInfo() {
                return this.$store.getters.getUserInformation
            }
        },

      created(){
        this.preLoader = true;
      },

        watch: {
            userInfo: {
                handler: function (user) {
                  this.preLoader = false;
                    this.userProfileInfo = {
                        ...user,
                       
                    };
                    console.log(this.userProfileInfo)

                    
                },
                deep: true
            }
        },

        mounted(){
            this.$store.dispatch('getUserInformation');
            if (this.clientRoleAccess){
                //called at 194
                this.getLeadUserInfo();
            }
        }

    }
</script>

