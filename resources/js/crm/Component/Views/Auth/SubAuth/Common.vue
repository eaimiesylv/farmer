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
                    v-on:blur="ValidatePassword()"
                    :placeholder="$t('your_password')"
                    :required="true"
                    v-model="fields.password"
                    :show-password="true"
                  />
                </div>
                <span v-if="fields.error" class="text-danger">Password must contain at least one uppercase letter, 
                  one lowercase letter, and be at least 6 characters long.</span>
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
          phone_number:'',
          error:false,
         
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
      ValidatePassword(){
          const password = this.fields.password;
           // Check if the password has at least one uppercase letter
           const hasUppercase = /[A-Z]/.test(password);

        // Check if the password has at least one lowercase letter
        const hasLowercase = /[a-z]/.test(password);

        // Check if the password has a minimum length of 6 characters
        const isLengthValid = password.length >= 6;

        // Check all conditions and show an error message if any condition fails
        if (!hasUppercase || !hasLowercase || !isLengthValid) {
          this.fields.error = true; // Set error flag to true
          this.fields.password = '';
          
        } else {
          this.fields.error = false; // Reset error flag if all conditions are met
        }
        
      }
      
    },
  
   
  };
  </script>
  