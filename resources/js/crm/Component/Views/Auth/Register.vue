<template>
  <form @submit.prevent="registerUser" class="sign-in-sign-up-form w-100" ref="form">
    <div class="container-fluid p-0">
      <!-- ... (other code) -->
      <div v-if="currentPage === 1">
        <div class="form-row">
          <div class="form-group col-12">
            <label class="col-12">Register as </label>
            <select class="col-12" v-model="userRole" required>
              <option value="" disabled selected>Select a category</option>
              <option value="3">Agric Businesss</option>
              <option value="4">Investor</option>
            </select>
            <!-- <app-input
              type="select"
              id="input-select"
              :placeholder="$t('select_a_role')"
              :required=true
              v-model="userRole"
              @change="setUserInfo"
              :list="userTypeList"
             
             
            /> -->
          </div>
        </div>
        <!-- Render components or content for page 1 -->
        <Common ref="commonComponent" />
      </div>
      <div v-else-if="currentPage === 2">
        <!-- Render components or content for page 2 -->
        <component :is="dynamicComponentName" ref="dynamicComponent"></component>
      </div>

      <!-- Add more pages as needed -->
      
      <div class="form-row">
        <div class="col-6">
          <button class="bluish-text btn btn-warning btn-block text-center" @click="prevPage" v-if="currentPage > 1 && currentPage < 3">Previous</button>
        </div>
        <div class="col-6 text-right">
          <button  class="btn btn-success btn-block text-center" v-if="currentPage != 1">
            <span class="w-100">
              <app-submit-button-loader v-if="loading"></app-submit-button-loader>
            </span>
            <template v-if="!loading">{{ $t('sign_up') }}</template>
          </button>
        </div>
      </div>

      <!-- Show Previous and Next Page--->
      <div class="form-row">
        <div class="col-6">
          <router-link to="/admin/users/login">
            <button class="bluish-text btn btn-primary btn-block text-center"   v-if="currentPage === 1">Login</button>
          </router-link>
        </div>
        <div class="col-6 text-right ">
          <button class="bluish-text btn btn-success btn-block text-center"
            @click="nextPage"
            v-if="currentPage === 1 && userRole !== null && userRole !== 0"
            :disabled="userRole === null || userRole === 0  "
          >
            Next
          </button>
        
        </div>
      </div>
    </div>
  </form>
</template>
<script>
import { companyName, copyRightText, urlGenerator } from "../../../Helpers/helpers";
import { FormSubmitMixin } from "../../../Mixins/Global/FormSubmitMixin";
import Investor from "./SubAuth/Investor.vue";
import AgricBusiness from "./SubAuth/AgricBusiness.vue";
import Common from "./SubAuth/Common.vue";
import axios from 'axios';

export default {
  name: "Login",
  mixins: [FormSubmitMixin],
  components: {
    Investor,
    AgricBusiness,
    Common,
  },
  data() {
    return {
      companyName,
      copyRightText,
      urlGenerator,
      currentPage: 1, 
      userTypeList: [
        { id: 3, value: "Agric Business", email: "agent@demo.com", password: 123456 },
        { id: 4, value: "Investor", email: "client@demo.com", password: 123456 },
      ],
      userRole:'',
      commonField:''
    };
  },
  computed: {
    dynamicComponentName() {
      if (this.userRole == 3) {
        return "AgricBusiness";
      } else if (this.userRole == 4) {
        return "Investor";
      }
      return null;
    },
  },
  methods: {
    nextPage() {
    if (this.currentPage < 3) {
      if (this.validateCommonFields()) {
          this.currentPage++; // Increment to the next page
        } else {
          this.$toastr.e('All fields are required');
        }
    }
  },
  prevPage() {
    if (this.currentPage > 1) {
      this.currentPage--; // Decrement to the previous page
    }
  },
    setUserInfo() {},
    
    afterSuccess({ data }) {
      window.location.href = data;
    },
    afterError(response) {
      this.loading = false;
      this.$toastr.e(response.data.message);
    },
    validateCommonFields() {
      // Access the Common component using the reference
      this.commonField = this.$refs.commonComponent;
      
      // Check if all required fields are filled in the Common component
      const requiredFieldsFilled =
        this.userRole && 
        this.commonField.fields.phone_number &&
        this.commonField.fields.email &&
        this.commonField.fields.password &&
        this.commonField.fields.contact_person &&
        this.commonField.fields.fullname
        // Add other required fields here

      return requiredFieldsFilled;
    },
    async registerUser() {
    try {
      // Construct the data payload
      // Extract the data from dynamicComponent and commonComponent
    const dynamicComponentData = { ...this.$refs.dynamicComponent.fields };
    const commonComponentData = { ...this.commonField.fields };

    // Construct the data payload
    const payload = {
      userRole: this.userRole,
      dynamicComponentData,
      commonComponentData
    };

      
      // Send the data payload to the backend using Axios
      const response = await axios.post('/api/user', payload); // Replace '/api/register' with your actual backend endpoint
      
      // Handle the response
      if (response.data.message) {
        // Success handling
        this.$toastr.s(response.data.message);
        this.$router.push('/admin/users/login');
        console.log('Registration successful :', response.data.message);
        // Redirect or show a success message to the user
      } 
    } catch (error) {
      if (error.response) {
       
        const errorData = error.response.data.error;

        // Show an error toast for each error message
        for (const key in errorData) {
            if (errorData.hasOwnProperty(key)) {
                const errorMessages = errorData[key];
                errorMessages.forEach(errorMessage => {
                  const messageParts = errorMessage.split('.');
                  if (messageParts.length > 1) {
                    this.$toastr.e(`${messageParts[1]}`);
                   }
                   
                });
            }
        }

        this.$toastr.s('An error occurred.'); 
       
      // The request was made and the server responded with an error status code
      console.error('Response data:', error.response.data.error);
   
    } 
    }
  },
    //Process submitted data
    getMissingFields() {
      /*loop over the fields from dynamicComponent and chek if they are required filled
       
       const commonComponent =this.$refs.dynamicComponent.fields
      
        const requiredFieldsFilled = Object.values(commonComponent.fields).every(field => field);

        return requiredFieldsFilled;

     
      */
    },

  },
  watch: {
    userRole: {
      immediate: true, // This ensures the watch function is called on component mount
      handler(newRole, oldRole) {
        if (newRole !== oldRole) {
          // User role changed, update nextPageFields
         // this.nextPageFields = this.getNextPageFields();
          console.log('watching well')
        }
      }
    }
  },
};
</script>
<style>
  .custom-checkbox {
  display: inline-block;
  opacity: 0; /* Set initial opacity for the checkbox */
} 
</style>