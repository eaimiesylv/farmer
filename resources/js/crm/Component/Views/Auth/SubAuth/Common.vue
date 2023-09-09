<template>
    <div class="container-fluid p-0">
      
          
            <div class="form-row">
              <div class="form-group col-12">
                <label>Fullname</label>
                <app-input
                  type="text"
                  :required="true"
                  v-model="fields.fullname"
                  placeholder="Fullname"
                />
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                  <label>{{ $t("email") }}</label>
                  <app-input
                    type="email"
                    :placeholder="$t('your_email')"
                    :required="true"
                    v-model="fields.email"
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
                    v-model="fields.password"
                    :show-password="true"
                  />
                </div>
            </div>
            
            <!--1.Agric Business-->
            <div class="form-row">
              <div class="form-group col-12">
                <label>Your Company Website</label>
                <app-input
                  type="text"
                  v-model="fields.company_website"
                  placeholder="Your company website"
                 
                />
              </div>
            </div>
             <!-- 3 Contact Person -->
            <div class="form-row">
              <div class="form-group col-12">
                <label>Contact Person</label>
                <app-input
                  type="text"
                  v-model="fields.contact_person"
                  placeholder="Contact Person"
                  :required="true"
                />
              </div>
            </div>
            <!-- 17. Phone number -->
            <div class="form-row">
              <div class="form-group col-12">
                <label>Phone number</label>
                <app-input
                  type="text"
                  v-model="fields.phone_number"
                  placeholder="Phone number"
                  :required="true"
                />
              </div>
            </div>
              <!--  Agric Business -->
          
  
  
    </div>       
  </template>
  
  <script>
  
  
  export default {
    name: "Common",
    data() {
      return {
       
        fields: {
          company_website: '', // 1. Your Company Website
          contact_person: '', // 3. Contact Person
          fullname:'',
          email: '',
          password:'',
          phone_number:''
         
        },
        
      };
    },
    computed: {
    isUserRole2() {
      return this.userRole;
    }
  },
    methods: {
      setUserInfo() {
        this.userTypeList.map((user) => {
          if (user.id == this.userRole) {
            this.fields.email = '';
            this.fields.password = '';
          }
        });
        //alert(this.userRole)
      },
      
    },
  
   
  };
  </script>
  