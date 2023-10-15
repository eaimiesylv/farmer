<template>

    
<div class="modal fade" id="commentDealModal" tabindex="-1" role="dialog" aria-labelledby="commentDealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="commentDealModalLabel">
            
                    <img src="https://connect.fnsdealroom.com/images/profile.png" alt="logo" class="rounded-circle" width="50" height="50"/>
                  
                    {{  receiver_detail }}
                    {{  current_view }}
                
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 chat ">
                        <div v-for="(comment, index) in comments" :key="index"  class="row">
                            <div class="col-md-10 comment" :class="{ 'other-user-comment': comment.created_by !== current_view}">
                            {{ comment.description }}
                            </div>
                            <small>{{ comment.created_at }}</small>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <form enctype="multipart/form-data">
                            
                        
                            <div class="form-group">
                        
                                <textarea class="form-control" id="description" v-model="description" name="description" placeholder="Enter description" required></textarea>
                                
                            </div>

                            
                            <div class="modal-footer">
                        
                                <button class="btn btn-primary" @click="submitComment">Submit</button>
                                <span v-if="loading">...</span> 
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-md-4">
                        <ul>
                            <li><h6 class="title">Stage</h6>
                                 <p class="description">Inital discussion</p>
                             </li>
                             <li><h6 class="title">Deal value</h6>
                                 <p class = "description">$ 45</p>
                             </li>
                             <li><h6 class="title">Proposal</h6>
                                 <p class = "description">0</p>
                             </li>
                             <li><h6 class="title">Expected closing date</h6>
                                 <p class = "description">2023-10-05</p>
                             </li>
                         </ul>
                    </div> -->
                </div>
            </div>
           
        </div>
    </div>
</div>

</template>
<script>
import axios from 'axios';
export default {
  name: "Comment",
  props: {
    matchingRecords: {
            type: Object, 
            required: true
    },
  },
  data(){
     return{
        description:"test",
        receiver_detail:"",
        comments :"",
        loading: false,
        created_by:"",
        current_view:"",
        
      
     }
  },
  methods:{
     async submitComment(e) {
       
        e.preventDefault();
        this.loading = true;
        const payload = {
            user_id:this.matchingRecords.user_id,
            investor_id:this.matchingRecords.investor_id,
            description: this.description,
            created_by: this.created_by
        }

         try {
            const response = await axios.post('/api/comments', payload); 
            // Handle the response
            if (response.data) {
                console.log(response.data)
              
                let user_id=this.matchingRecords.user_id;
                let investor_id=this.matchingRecords.investor_id;
                this.comments.unshift(response.data);
                // this.getComment(user_id, investor_id);
                 this.loading = false;
            
            } 
         }catch(error){
            console.log(error);
         }
         finally {
            this.loading = false;
        }      
    },
    async getComment(user_id, investor_id) {
       
        try {
        let url = `/api/comments/${user_id}/${investor_id}`;
           const response = await axios.get(url);
           if (response.data) {
               this.comments =response.data;
                
           } 
        }catch(error){
           console.log(error);
          
        }

        
   }
  },
  mounted() {
    let fullname;
    let date;
    let type;
    let investor_id
    let user_id
    // Pull investor detail
    if (this.matchingRecords.investor && this.matchingRecords.investor.fullname) {
        fullname = this.matchingRecords.investor.fullname;
        type= "Investor";
        date = this.matchingRecords.investor.created_at;
        this.created_by = this.matchingRecords.investor.id;
        this.current_view = this.created_by

    } else if (this.matchingRecords.agricbusiness && this.matchingRecords.agricbusiness.fullname) {
        fullname = this.matchingRecords.agricbusiness.fullname;
        type= "Agricbusiness"
        date = this.matchingRecords.agricbusiness.created_at;
        this.created_by = this.matchingRecords.agricbusiness.id;
        this.current_view = this.created_by
       
    } else {

    fullname = " ";
    }
    this.receiver_detail = " " + fullname + " " + type + " " + " since " + date;
    user_id= this.matchingRecords.user_id;
    investor_id= this.matchingRecords.investor_id;
    this.getComment(user_id, investor_id);
  },
}
</script>
<style scoped>
.col-md-12{
    margin:0 !important;
    padding:0 !important;
}
.chat {
    max-height: 50vh;
    overflow-y: auto;
    overflow-x: hidden;
    background: #F9F9F9;
    padding: 1em !important;
    margin: 1em;
}

.comment {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    margin: 1em !important;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.other-user-comment {
    background-color: grey;
    color: white;
    margin-left:3em !important;
   

}

small {
    text-align: center;
    color:blue;
    margin:0 auto;

}
</style>

