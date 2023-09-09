<template>
  <app-overlay-loader v-if="preLoader" />
   
    <div class="content py-primary" v-else>
    
        <form ref="form" data-url='admin/auth/users/change-settings' v-if="userProfileInfo['agricbusiness_detail'][0]">
           
            <!-- Organization Name -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-fullname"
                               class="text-left d-block mb-lg-2 mb-xl-0">Organization Name</label>
                    </div>
                    <div class="col-xl-8">
                       
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-organization-name"
                                   placeholder="Organization Name"
                                   :required="true"
                                   v-model="userProfileInfo['agricbusiness_detail'][0].organizationName"/>
                                    
                    </div>
                </div>
            </div>
            
             <!-- Deal Name -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-fullname"
                               class="text-left d-block mb-lg-2 mb-xl-0">Deal Name</label>
                    </div>
                    <div class="col-xl-8">
                       
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-deal-name"
                                   placeholder="Deal Name"
                                   :required="true"
                                   v-model="userProfileInfo['agricbusiness_detail'][0].dealName"/>
                                    
                    </div>
                </div>
            </div>
            
              <!-- Deal Promoters -->
                <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-deal_promoters"
                               class="text-left d-block mb-lg-2 mb-xl-0">Deal Promoters</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-preferred_deal_size"
                                   placeholder="Preferred Deal Size"
                                   :required="true"
                                   v-model="userProfileInfo['agricbusiness_detail'][0].dealPromoters"/>
                    </div>
                </div>
            </div>

           

             <!-- Deal Description -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-phone_number"
                               class="text-left d-block mb-lg-2 mb-xl-0">Deal Description</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-deal_description"
                                   placeholder="Deal Description"
                                   :required="true"
                                   v-model="userProfileInfo['agricbusiness_detail'][0].dealDescription"/>
                    </div>
                </div>
            </div>

             <!-- Business Plan -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-phone_number"
                               class="text-left d-block mb-lg-2 mb-xl-0">Business Plan</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-business_plan"
                                   placeholder="Has business plan"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].hasBusinessPlan"/>
                    </div>
                </div>
            </div>

             <!-- Focal States -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-focal_state"
                               class="text-left d-block mb-lg-2 mb-xl-0">Focal States</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-focal_state"
                                   placeholder="Focal State"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].focalStates"/>
                    </div>
                </div>
            </div>

             <!-- Ticket Size -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-ticket_size"
                               class="text-left d-block mb-lg-2 mb-xl-0">Ticket Size</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-ticket_size"
                                   placeholder="Ticket Size"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].ticketSize"/>
                    </div>
                </div>
            </div>

             <!-- Raise Amount -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-raise_amount"
                               class="text-left d-block mb-lg-2 mb-xl-0">Raise Amount</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-raise_amount"
                                   placeholder="Raise Amount"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].raiseAmount"/>
                    </div>
                </div>
            </div>

             <!-- Purpose -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-purpose"
                               class="text-left d-block mb-lg-2 mb-xl-0">Purpose</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-purpose"
                                   placeholder="Purpose"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].purpose"/>
                    </div>
                </div>
            </div>
             <!-- Preferred Value Chain -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-preferred_value_chain"
                               class="text-left d-block mb-lg-2 mb-xl-0">Preferred Value Chain</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-preferred_value_chain"
                                   placeholder="Preferred Value Chain"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].preferredValueChain"/>
                    </div>
                </div>
            </div>
             <!-- other Value Chains -->
            <div class="form-group mb-primary">
                <div class="row">
                    <div class="col-xl-3 d-flex align-items-center">
                        <label for="input-text-other_value_chains"
                               class="text-left d-block mb-lg-2 mb-xl-0">Other Value Chains</label>
                    </div>
                    <div class="col-xl-8">
                        <app-input type="text"
                                   :disabled="clientRoleAccess"
                                   id="input-text-other_value_chains"
                                   placeholder="Other Value Chains"
                                   :required="true"
                                    v-model="userProfileInfo['agricbusiness_detail'][0].otherValueChains"/>
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
                preLoader:true,
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
            
        },
        computed: {
            clientRoleAccess(){
                return (!this.$can('manage_public_access') && this.$can('client_access'));
            },
            userInfo() {
                if (!this.props) {  
                    
                    this.userProfileInfo = {...this.$store.getters.getUserInformation}
                    return this.$store.getters.getUserInformation;
                }
            }
        },

      created(){
        if(this.props){
          this.preLoader = true;
        }
      },

        watch: {
            userInfo: {
                handler: function (user) {
                   
                    this.preLoader = false;
                
                    
                },
                deep: true,
                 immediate: true 
            }
        },

        mounted(){
            if(this.props){
                this.preLoader = false;
                this.userProfileInfo = { ...this.props }
                console.log(this.userProfileInfo)
            }
            
        }

    }
</script>

