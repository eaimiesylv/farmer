<template>
  <div class="container-fluid p-0">
    <h4>Investor Detail</h4>
    <!-- Finance / Funding Institution -->
    <div class="form-row">
      <div class="form-group col-12">
        <label>Finance / Funding Institution</label>
        <app-input
          type="text"
          v-model="fields.finance_institution"
          placeholder="Finance / Funding Institution"
          :required="true"
        />
      </div>
    </div>

    <!-- Type of Investment -->
    <div class="form-row">
      <div class="form-group col-12">
        <label>Type of Investment(Pick all that applies to you)</label>
        <input type="radio" :checked="fields.investment_type.length > 0" name="checkChain"  class="custom-checkbox" required/>
        <div class="form-checkboxes">
          <label v-for="investmentTypeOption in investment_types" :key="investmentTypeOption.value" class="form-checkbox-label">
          
            <input
              type="checkbox"
              :value="investmentTypeOption.value"
              v-model="fields.investment_type"
              @change="setInvestmentType(investmentTypeOption.value)"
            />
            {{investmentTypeOption.label }}
          </label>
        </div>
      </div>
    </div>

    <!-- Preferred Deal Size -->
    <div class="form-row">
      <div class="form-group col-12">
        <label>Preferred Deal Size</label>
        <div class="form-radio-buttons">
          <label v-for="dealSizeOption in preferred_deal_sizes" :key="dealSizeOption.value" class="form-radio-label">
            <input
              type="radio"
              :value="dealSizeOption.value"
              name="preferredDealSize"
              :required="true"
              v-model="fields.preferred_deal_size"
            />
            {{ dealSizeOption.label }}
          </label>
        </div>
      </div>
    </div>

    <!-- Type of Funding -->
    <div class="form-row">
      <div class="form-group col-12">
        <label>Type of Funding</label>
        <div class="form-radio-buttons">
          <label v-for="fundingOption in funding_types" :key="fundingOption.value" class="form-radio-label">
            <input
              type="radio"
              :value="fundingOption.value"
              :required="true"
              name="fundingType"
              v-model="fields.funding_type"
            />
            {{ fundingOption.label }}
          </label>
        </div>
      </div>
    </div>

    <!-- Brief description of your organization -->
    <div class="form-row">
      <div class="form-group col-12">
        <label>Brief description of your organization</label>
        <textarea
          v-model="fields.organization_description"
          :required="true"
          rows="4"
          placeholder="Brief description of your organization"
        ></textarea>
      </div>
    </div>
  </div>
</template>


<script>


export default {
  name: "investor",
  data() {
    return {
      
      fields: {
        finance_institution:'', // 15. Finance / Funding Institution
       investment_type: [], // 18. Type of Investment (checkboxes)
       preferred_deal_size: '', // 20. Preferred Deal Size (radio)
       funding_type: '', // 21. Type of Funding (radio)
        organization_description: '', // 22. Brief description of your organization
      },
     investment_types: [
        { value: "Crop", label: "Crop" },
        { value: "Livestock", label: "Livestock" },
        { value: "Aquaculture", label: "Aquaculture" },
        { value: "Agribusiness", label: "Agribusiness" },
        { value: "Others", label: "Others" },
      ],
     preferred_deal_sizes: [
        { value: "Below 1 million Dollars", label: "Below 1 million Dollars" },
        // ... (other options)
        { value: "Others", label: "Others" },
      ],
     funding_types: [
        { value: "Equity", label: "Equity" },
        { value: "Debt", label: "Debt" },
        // ... (other options)
        { value: "Other", label: "Other" },
      ],
      
     

    }
  },
    methods:{setInvestmentType(d){
      //console.log(d);
    }
  }
};
</script>
<style>
/* Add styles for better spacing and alignment */
.form-checkboxes,
.form-radio-buttons {
  display: flex;
  flex-direction: column;
}

.form-checkbox-label,
.form-radio-label {
  display: block;
  margin-bottom: 8px;
}
</style>