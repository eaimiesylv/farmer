<template>
  <div class="content-wrapper">
    <app-breadcrumb :page-title="$t('my_profile')" :icon="'user'" />
    <div class="user-profile mb-primary">
      <div class="card position-relative card-with-shadow py-primary border-0">
        <app-overlay-loader v-if="dataLoaded" class="h-100" />
        <div class="row align-items-center" v-else>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-5">
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
                      <div class="align-self-center mr-3">
                        <app-icon :name="'gift'" />
                      </div>
                      <div class="media-body">
                        <p class="text-muted mb-0">{{ $t("date_of_birth") }}:</p>
                        <p class="mb-0" v-if="loggedInUser.profile">
                          {{ loggedInUser.profile.date_of_birth }}
                        </p>
                        <p class="mb-0" v-else>{{ $t("not_added_yet") }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- Personal information -->
    <app-tab v-if="!dataLoaded" :tabs="tabs" :icon="tabIcon" />
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
            type: Object, // Change the type to match the data type of $detail
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
      tabs: [
        {
          name: this.$t("personal_info"),
          title: this.$t("personal_info"),
          component: "app-profile-personal-info",
          permission: "",
          props: "",
        },
        {
          name: this.$t("password_change"),
          title: this.$t("password_change"),
          component: "app-password-change",
          permission: "",
          props: "",
        },
       /* {
          name: this.$t("activity_logs"),
          title: this.$t("activity_logs"),
          component: "app-activity-log",
          permission: "",
          props: "",
        },-->
        {
          name: this.$t("social_links"),
          title: this.$t("social_links"),
          component: "app-profile-social-links",
          permission: "",
          props: "",
        },
        {
          name:'Investor Detail',
          title: 'Investor payment',
          component: "app-profile-investor-info",
          permission: "",
          props: "",
        },
        {
          name:'AgriBusiness',
          title: 'AgriBusiness',
          component: "app-profile-agribusiness-info",
          permission: "",
          props: "",
        },*/
      ],
      formatDateToLocal,
    };
  },
  computed: {
    userInfo() {
      
       console.log(this.$store.getters.getUserInformation);
      return this.$store.getters.getUserInformation;
     
    },
    
  addAgric() {
      
          
            this.tabs.push({
              name: 'AgriBusiness',
              title: 'AgriBusiness',
              component: 'app-profile-agribusiness-info',
              permission: '',
              props: '',
            });
           
          
          
      
  // Trigger an update to ensure reactivity
    this.$forceUpdate();
},
  
addInvestor() {
      this.tabs.push({
         name:'Investor Detail',
          title: 'Investor Detail',
          component: "app-profile-investor-info",
          permission: "",
          props: "",
      });

  // Trigger an update to ensure reactivity
    this.$forceUpdate();
  }
},
  
  methods: {
    /*updateSocialLink() {
      this.$hub.$on("update-social-link", (value = true) => {
        if (value) {
          this.getUserSocialLin();
        }
      });
    },
    getUserSocialLin() {
      this.dataLoaded = true;
      this.axiosGet(route("user_social_link.index"))
        .then((response) => {
          this.socialLinks = response.data;
        })
        .finally(() => {
          this.dataLoaded = false;
        });
    },
    changeProfile() {
      let formData = new FormData();
      formData.append("profile_picture", this.profile_picture);
      this.axiosPost({
        url: `admin/auth/users/profile-picture`,
        data: formData,
      })
        .then((response) => {
          location.reload();
          this.$toastr.s(response.data.message);
        })
        .catch(({ error }) => {});
    },*/
     
  },
  watch: {
    userInfo: {
      handler: function (user) {
        this.loggedInUser = user;
        this.profile_picture = this.loggedInUser.profile_picture
          ? urlGenerator(this.loggedInUser.profile_picture.path)
          : urlGenerator("images/profile.png");

          if (Array.isArray(user.agricbusiness_detail) && user.agricbusiness_detail.length>0) {
            
            this.type="agric"
            this.addAgric
            
          }
          if (Array.isArray(user.investor_detail) && user.investor_detail.length>0) {
             //console.log(user.investor_detail)
            this.addInvestor
           
          }
      },
       immediate: true,
    },
  
    deep: true,
  },
  mounted() {
    
    // this.tabs.forEach((el) => {
    //   el["props"] = {
    //     isMarketPlaceVersion: this.marketPlaceVersion,
    //   };
    // });
    // this.getUserSocialLin();
    // this.updateSocialLink();
    /***
     * this details are passed from ProfileController or AuthenticateUserController
     */
    this.$store.dispatch("getUserInformation");
    console.log('from admin area');
    console.log(this.initialDetail)

  },
};
</script>

<style scoped>
.user-profile .card {
  min-height: 190px;
}
</style>