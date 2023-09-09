<template>
  <div class="container-fluid p-0">
    <div class="row">
     
      <div class="col-sm-12 pl-0">
        <div class="login-form ">
          <!--begining of form-->
          <div class="form-group">
            <div class="col-12 text-center pt-5">
               <img src="/images/log.png" width=200 alt="Banner Image">
            </div>
            <div class="col-12">
              <router-view></router-view>
            </div>
          </div>
         
            
          <div class="form-group">
                  <div class="col-12">
                    <p class="text-center mt-5 footer-copy">
                      {{ copyRightText() }}
                    </p>
                  </div>
          </div>
           
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { companyName, copyRightText} from "../../../Helpers/helpers";
import { FormSubmitMixin } from "../../../Mixins/Global/FormSubmitMixin";

export default {
  name: "LogReg",
 
  mixins: [FormSubmitMixin],
  data() {
    return {
      companyName,
      copyRightText,
    
    }
  },
 

  
};
</script>
