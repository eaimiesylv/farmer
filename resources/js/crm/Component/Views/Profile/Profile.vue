<template>
  <div class="content-wrapper">
    <app-breadcrumb :page-title="$t('my_profile')" :icon="'user'" />
    <div class="user-profile mb-primary" v-if="userProfile">
      <div class="card position-relative card-with-shadow py-primary border-0" >
        <app-overlay-loader v-if="dataLoaded" class="h-100" />
        <div class="row align-items-center" v-else>
          <div   class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-5">
            <div
              class="media border-right px-5 pr-xl-5 pl-xl-0 align-items-center user-header-media"
            >
              <!-- profile pix -->
              <div class="profile-pic-wrapper position-relative">
                <app-input
                  :wrapper-class="'circle small-wrapper mx-xl-auto'"
                  name="profile_picture"
                  type="custom-file-upload"
                  v-model="profile_picture"
                  :generate-file-url="false"
                  :label="$t('change')"
                  @change="changeProfile()"
                />
              </div>
              <!-- profile detail -->
              <div class="media-body user-info-header">
                <h4>{{ loggedInUser.full_name }}</h4>
                <p class="text-muted mb-2">{{ loggedInUser.email }}</p>
                <span class="badge badge-pill badge-success user-status">{{
                  $t("active")
                }}</span>
                <div class="social-links pt-3">
                  <template v-for="(social, index) in socialLinks">
                    <template v-if="social.link">
                      <a class="mr-3" :href="social.link" target="_blank" :key="index">
                        <app-icon
                          class="mb-1"
                          :name="social.icon"
                          width="16"
                          height="16"
                        />
                      </a>
                    </template>
                  </template>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
            <div
              class="user-details px-5 px-sm-5 px-md-5 px-lg-0 px-xl-0 mt-5 mt-sm-5 mt-md-0 mt-lg-0 mt-xl-0"
            >
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                  <div
                    class="border-right h-100 custom d-flex flex-column justify-content-around"
                  >
                    <div class="media mb-4 mb-xl-5">
                      <div class="align-self-center mr-3">
                        <app-icon :name="'map-pin'" />
                      </div>
                      <div class="media-body">
                        <p class="text-muted mb-0">{{ $t("address") }}:</p>
                        <p class="mb-0 mr-primary text-break" v-if="loggedInUser.profile">
                          {{ loggedInUser.profile.address }}
                        </p>
                        <p class="mb-0 mr-primary text-break" v-else>
                          {{ $t("not_added_yet") }}
                        </p>
                      </div>
                    </div>
                    <div class="media mb-4 mb-xl-0">
                      <div class="align-self-center mr-3">
                        <app-icon :name="'phone'" />
                      </div>
                      <div class="media-body">
                        <p class="text-muted mb-0">{{ $t("contact") }}:</p>
                        <p class="mb-0" v-if="loggedInUser.profile">
                          {{ loggedInUser.profile.contact }}
                        </p>
                        <p class="mb-0" v-else>{{ $t("not_added_yet") }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                  <div class="h-100 d-flex flex-column justify-content-around">
                    <div class="media mb-4 mb-xl-5">
                      <div class="align-self-center mr-3">
                        <app-icon :name="'calendar'" />
                      </div>
                      <div class="media-body">
                        <p class="text-muted mb-0">{{ $t("created") }}:</p>
                        <p class="mb-0" v-if="loggedInUser.created_at">
                          {{ formatDateToLocal(loggedInUser.created_at) }}
                        </p>
                        <p class="mb-0" v-else>{{ $t("not_added_yet") }}</p>
                      </div>
                    </div>
                    <div class="media mb-0 mb-xl-0">
                      <!--<div class="align-self-center mr-3">
                        <app-icon :name="'gift'" />
                      </div>
                       <div class="media-body">
                        <p class="text-muted mb-0">{{ $t("date_of_birth") }}:</p>
                        <p class="mb-0" v-if="loggedInUser.profile">
                          {{ loggedInUser.profile.date_of_birth }}
                        </p>
                        <p class="mb-0" v-else>{{ $t("not_added_yet") }}</p>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- Personal information, Password, Agric Business, Investor chk line 152-->
    <app-tab v-if="!dataLoaded" :tabs="visibleTabs" :icon="tabIcon" />
  </div>
</template>

<script>
import { FormMixin } from "@core/mixins/form/FormMixin";
import { formatDateToLocal, urlGenerator } from "@app/Helpers/helpers";

export default {
  name: "Profile",
  mixins: [FormMixin],
  props: {
    marketPlaceVersion: {
      default: false,
    },
    initialDetail: {
            type: Object, //This is either agri or investor detail
            default: null, // Set a default value, if needed
    },
  },

  data() {
    return {
      dataLoaded: false,
      loggedInUser: {},
      userImage: "",
      profile_picture: "",
      socialLinks: [],
      type:'investor',
      tabIcon: "user",
      userProfile:true,
      tabs: [
        {
          name: this.$t("personal_info"),
          title: this.$t("personal_info"),
          component: "app-profile-personal-info",
          permission: "",
          props:this.initialDetail,
          
        },
        {
          name: this.$t("password_change"),
          title: 'Password Change',
          component: "app-password-change",
          permission: "",
          props: "",
        },
        {
          name: 'AgriBusiness',
          title: 'AgriBusiness',
          component: 'app-profile-agribusiness-info',
          permission: '',
          props: this.initialDetail,
        },
        {
          name: 'Investor Detail',
          title: 'Investor Detail',
          component: "app-profile-investor-info",
          permission: "",
          props: this.initialDetail,
        },
        {
          name: 'Pitch',
          title: 'Pitch',
          component: "app-profile-pitch",
          permission: "",
          props: this.initialDetail,
        }
      
      ],
      formatDateToLocal,
    };
  },
 
  computed: {
    userInfo() {
      
      if (this.initialDetail) {
         //console.log(this.initialDetail)
        return this.initialDetail;
      } else {
        // Use the value from the
         //console.log(this.$store.getters.getUserInformation) 
         return this.$store.getters.getUserInformation;
      }
     
    },
    visibleTabs() {
      //If initialDetail has a value, Someone is viewing it
      if (this.initialDetail != null) {
        this.userProfile=false;
        this.tabs=this.tabs.filter(tab => tab.title !== 'Password Change');
        this.tabs=this.tabs.filter(tab => tab.title !== this.$t("personal_info"));
      }
      

      // Remove investor detail tab if the user is Agribusiness
      if (this.type == 'AgriBusiness') {
       
        return this.tabs.filter(tab => tab.title !== 'Investor Detail');
      } else if (this.type === 'Investor Detail') {
       // Remove Agribusiness tab if the user is Investor
       return this.tabs.filter(tab => tab.title !== 'AgriBusiness' && tab.title !== 'Pitch');
   
       
      } else {
        return this.tabs;
      }
    },
 


},
  watch: {
    userInfo: {
      handler: function (user) {
        this.loggedInUser = user;
        this.profile_picture = this.loggedInUser.profile_picture
          ? urlGenerator(this.loggedInUser.profile_picture.path)
          : urlGenerator("images/profile.png");

          if (Array.isArray(user.agricbusiness_detail) && user.agricbusiness_detail.length>0) {
            
            this.type="AgriBusiness"
          
           
            
          }
          if (Array.isArray(user.investor_detail) && user.investor_detail.length>0) {
             //console.log(user.investor_detail)
            this.type="Investor Detail"
           
           
          }
          
      },
       immediate: true,
    },
  
    deep: true,
  },
  mounted() {
    
    this.$store.dispatch("getUserInformation");
    //console.log(this.initialDetail)

  },
};
</script>

<style scoped>
.user-profile .card {
  min-height: 190px;
}
</style>