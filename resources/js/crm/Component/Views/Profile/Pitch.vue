<template>
    <app-overlay-loader v-if="preLoader" />
    <div class="content py-primary" v-else>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Pitch Name</th>
            <th>Pitch Type</th>
            <th>View File</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(pitch, index) in userProfileInfo.document" :key="index">
            <td>{{ pitch.pitchname }}</td>
            <td>{{ pitch.pitchtype }}</td>
            <td>
              <a :href="getPitchFileUrl(pitch.pitchfile)" target="_blank"> <i class="fas fa-eye"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  

<script>

    import {FormMixin} from "@core/mixins/form/FormMixin.js";
    import HelperMixin from "@app/Mixins/Global/HelperMixin";

    export default {
        name: "InvestorInfo",
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

        methods: {
                getPitchFileUrl(pitchfile) {
                   //alert(pitchfile)
                    let withoutPublic = pitchfile.replace('admin/', '');
                    return `/${withoutPublic}`;
                    //return pitchfile
                }
            },




        computed: {
           
            userInfo() {
                if (!this.props) {  
                    
                    this.userProfileInfo = {...this.$store.getters.getUserInformation}
                    console.log('from store')
                    console.log(this.userProfileInfo)
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
                console.log('from props')
                console.log(this.userProfileInfo)
            }
        }

    }
</script>

