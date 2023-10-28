<template>

    
<div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="proposalDealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="proposalDealModalLabel">
                    {{ matchingRecords }}
                    <!-- <img src="https://connect.fnsdealroom.com/images/profile.png" alt="logo" class="rounded-circle" width="50" height="50"/> -->
                    
                    <h4>{{ matchingRecords['title'] }}</h4>
                   
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-12 description">
                       <p> {{ matchingRecords['description'] }}</p>
                    </div>
        
                </div>
            </div>
           
        </div>
    </div>
</div>

</template>
<script>
export default {
  name: "DealProposal",
  props: {
    matchingRecords: {
      type: Object,
      required: true
    },
    modalId: {
      type: String,
      required: true
    },
  },
  mounted(){
    console.log("mounted");
    console.log(this.matchingRecords);
    
  },

 
  watch: {
    matchingRecords: {
      handler(newVal, oldVal) {
        // Handle changes to matchingRecords, including nested properties
        console.log('matchingRecords updated:', newVal);
      },
      deep: true
    }
  },
 
}
</script>

<style scoped>
.col-md-12{
    margin:0 !important;
    padding:0 !important;
}


.description {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    padding:0 1em !important;
   
    
}

</style>

