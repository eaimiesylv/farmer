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
                    @blur="ValidateEmail()"
                    :placeholder="$t('your_email')"
                    :required="true"
                    v-model="fields.email"
                  />
                </div>
                <span v-if="email_exist" class="text-danger">Email already exist</span>
               
            </div>
            <div class="form-row">
              
                <div class="form-group col-12">
                  <label>{{ $t("password") }}</label>
                  <app-input
                    type="password"
                    @blur="ValidatePassword()"
                    :placeholder="$t('your_password')"
                    :required="true"
                    v-model="fields.password"
                    :show-password="true"
                  />
                </div>
                <span v-if="password_error" class="text-danger">Password must be a min of 6, max of 15 letter and must contain any of
                  +\×#%@\$\!\*\(\)&£₩\-\,?;":,..</span>
               
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
                  @blur="ValidateNumber()"
                  v-model="fields.phone_number"
                  placeholder="Phone number"
                  :required="true"
                />
              </div>
               
            </div>
            <span v-if="phone_exist" class="text-danger">Phone number already exist</span>
              <!--  Agric Business -->
          
  
  
    </div>       
  </template>
  
  <script>
  import axios from 'axios';

  
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
         
         
        },
          password_error:false,
          phone_exist:false,
          email_exist:false,
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
      async ValidateNumber(){
        try{
         let url='https://connect.fnsdealroom.com/api/user/phone_exist/'+this.fields.phone_number;
         //let url='http://localhost:8000/api/user/phone_exist/'+this.fields.phone_number;
        const response = await axios.get(url);
        
         if(response.data.message == "exist"){
           this.phone_exist = true;
           this.fields.phone_number = '';
           
          }else{
            this.phone_exist = false;
            console.log('passed');
          }
        }catch (error) {
           console.error(error)
        }
      },
      async ValidateEmail(){
        try{
         let url='https://connect.fnsdealroom.com/api/user/phone_exist/'+this.fields.email;
         //let url='http://localhost:8000/api/user/email_exist/'+this.fields.email;
         
        const response = await axios.get(url);
        
         if(response.data.message == "exist"){
           this.email_exist = true;
           this.fields.email = '';
          }else{
            this.email_exist = false;
            console.log('passed');
          }
        }catch (error) {
           console.error(error)
        }
      },
      ValidatePassword(){
        const password = this.fields.password;
      // Check if the password has at least one uppercase letter
      const hasUppercase = /[A-Z]/.test(password);

      // Check if the password has at least one lowercase letter
      const hasLowercase = /[a-z]/.test(password);

      // Check if the password has a minimum length of 6 characters and a maximum length of 15 characters
      const isLengthValid = password.length >= 6 && password.length <= 15;

      // Check if the password contains any of the specified special characters
      const hasSpecialChar = /[+\×#%@\$\!\*\(\)&£₩\-\,?;":,.]/.test(password);

// Check all conditions and show an error message if any condition fails

      // Check all conditions and show an error message if any condition fails
      if (!hasUppercase || !hasLowercase || !isLengthValid || !hasSpecialChar) {
        this.password_error = true; // Set error flag to true
        this.fields.password = '';
      } else {
        this.password_error= false; // Reset error flag if all conditions are met
      }
        
      }
      
    },
  
   
  };
  </script>
  