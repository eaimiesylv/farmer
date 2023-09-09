<template>
    <app-modal
        modal-id="activity-modal"
        modal-size="large"
        modal-alignment="top"
        @close-modal="closeModal"
    >
        <template slot="header">
            <h5 class="modal-title">
                {{ selectedUrl ? $t("edit_activity") : $t("Add Document") }}
            </h5>

            <button
                type="button"
                class="close outline-none"
                data-dismiss="modal"
                aria-label="Close"
            >
        <span>
          <app-icon :name="'x'"></app-icon>
        </span>
            </button>
        </template>
        <template slot="body">
            <form
                ref="form"
                :data-url="selectedUrl ? selectedUrl : route(`activities.store`)"
                v-if="dataLoaded"
            >
               
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2 d-flex align-items-center">{{
                                $t("title")
                            }}</label>
                        <div class="col-sm-10">
                            <app-input
                                type="text"
                                :required="true"
                                :placeholder="$t('title')"
                                v-model="formData.title"
                            />
                            <small class="text-danger" v-if="errors.title">{{
                                    errors.title[0]
                                }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2">{{ $t("description") }}</label>
                        <div class="col-sm-10">
                            <app-input
                                type="textarea"
                                :text-area-rows="5"
                                :placeholder="$t('description_here')"
                                v-model="formData.description"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2">{{ $t("Select File") }}</label>
                        <div class="col-sm-10">
                            <app-input
                                type="file"
                             
                                :placeholder="$t('description_here')"
                                v-model="formData.file"
                            />
                        </div>
                    </div>
                </div>
               

                <!-- Activity change input
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2 d-flex align-items-center">{{
                                $t("activity_type")
                            }}</label>
                        <div class="col-sm-10">
                            <app-input
                                type="select"
                                list-value-field="title"
                                :list="setTypeActivity"
                                :placeholder="$t('choose_your_activity_type')"
                                :required="true"
                                v-model="formData.type_of_activity"
                                @input="activityTypeChanged"
                            />
                        </div>
                    </div>
                </div> -->
                <!-- end of Activity change input -->


               
              
                
               
            </form>
            <app-overlay-loader v-else/>
        </template>
        <template slot="footer">
            <button
                type="button"
                class="btn btn-secondary mr-2"
                data-dismiss="modal"
                @click.prevent="closeModal"
            >
                {{ $t("cancel") }}
            </button>
            <button type="button" class="btn btn-primary" @click.prevent="submit">
        <span class="w-100">
          <app-submit-button-loader v-if="loading"></app-submit-button-loader>
        </span>
                <template v-if="!loading">{{ $t("save") }}</template>
            </button>
        </template>
    </app-modal>
</template>


<script>
import {FormMixin} from "@core/mixins/form/FormMixin";
import {collect} from "@app/Helpers/Collection";
import {mapGetters} from "vuex";
import moment from "moment";
import {
    formatted_date,
    formatted_time,
    time_format,
    urlGenerator,
} from "@app/Helpers/helpers";
import {formatDateTimeForServer, formatDateTimeToLocal} from "../../../Helpers/helpers";

export default {
    name: "ActivityModal",
    mixins: [FormMixin],
    props: {
        tableId: String,
        previousData: Boolean,
        setDate: Object,
        selectData: Object,
    },
    data() {
        return {
           
            route,
            urlGenerator,
            formData: {
                activity_type: null,
                title: "",
                description: "",
                started_at: new Date(),
                ended_at: new Date(),
                person_id: [],
                owner_id: [],
                type_of_activity: null,
                contextable_id: null,
                reminder_type: '',
                reminder_on: null,
            },
            ownerSelectOptions: {
                // url: route('crm.auth_user'),
                url: route('selectable.owners'),
                listValueField: "full_name",
                per_page: 10,
                loader: "app-pre-loader", // by default 'app-overlay-loader'
            },
            personSelectOptions: {
                url: route('selectable.persons'),
                listValueField: "name",
                per_page: 10,
                loader: "app-pre-loader", // by default 'app-overlay-loader'
            },
            addEditData: {},
            activityTypeList: [],
            errors: {},
            statusList: [],
            dataLoaded: false,
            loading: false,
            endTime: moment(new Date()).format(`${time_format()}`),
            startTime: moment(new Date())
                .subtract("15", "minutes")
                .format(`${time_format()}`),
            activityId: 1,
            activePreset: 15,
        };
    },
    computed: {
        ...mapGetters({
            ownerList: "getOwner",
            // organizationList: "getOrganization",
            // personList: "getPerson",
            // dealList: "getDeal",
            activityStatusList: "getActivityStatus",
        }),

        dealChange() {
            return this.dealList.find(
                (deal) => deal.id == this.formData.contextable_id
            );
        },
        leadType() {
            return this.dealChange.contextable_type ==
            "App\\Models\\CRM\\Person\\Person"
                ? "person"
                : "org";
        },

        setTypeActivity() {
            return [
                {
                    id: 1,
                    title: this.$t("deal"),
                },
                {
                    id: 2,
                    title: this.$t("person"),
                },
                {
                    id: 3,
                    title: this.$t("organization"),
                },
            ];
        },

        setReminderType() {
            return [
                {
                    id: '',
                    title: this.$t("none"),
                },
                {
                    id: '15mins',
                    title: this.$t("15mins"),
                },
                {
                    id: '1hr',
                    title: this.$t("1hr"),
                },
                {
                    id: '1day',
                    title: this.$t("1day"),
                },
                {
                    id: 'custom',
                    title: this.$t("custom"),
                },
            ];
        },
    },
    created() {
        this.$store.dispatch("getActivityStatus");
    },
    mounted() {
        if (this.previousData) {
            this.formData.type_of_activity = Number(this.selectData.type_of_activity);
            this.activityId = this.selectData.activity_type_id
                ? Number(this.selectData.activity_type_id)
                : this.activityId;
            this.formData.contextable_id = this.selectData.contextable_id;
            this.formData.title = this.selectData.title;
            this.formData.activity_done = this.selectData.is_done_activity;
            this.dateFormate();
        }

        this.pipeline([this.getActivityType()])
            .then(() => {
                this.dataLoaded = true;
            })
            .catch((err) => console.log(err));

        //for setting up data if update action fired
    },
    methods: {
        
        afterSuccessFromGetEditData(response) {
            this.formData.activity_done =
                response.data.status.name == 'status_done' ? true : false;
            this.activePreset = null;
            this.formData.contextable_id = response.data.contextable_id;
            this.formData.description = response.data.description;
            this.formData.reminder_type = response.data.reminder_type;
            this.formData.reminder_on = new Date(moment(response.data.reminder_on).utc(true)
                .local())
            if (response.data.contextable_type) {
                let arr = response.data.contextable_type.split("\\");
                if (arr[arr.length - 1] == "Deal") {
                    this.formData.type_of_activity = 1;
                } else if (arr[arr.length - 1] == "Organization") {
                    this.formData.type_of_activity = 3;
                } else if (arr[arr.length - 1] == "Person") {
                    this.formData.type_of_activity = 2;
                }
            }
            this.formData.activity_type_id = response.data.activity_type.id;
            this.formData.title = response.data.title;
            this.activityId = response.data.activity_type.id;
            this.formData.owner_id =
                response.data.collaborators.length > 0
                    ? collect(response.data.collaborators).pluck("id")
                    : [];
            this.formData.person_id =
                response.data.participants.length > 0
                    ? collect(response.data.participants).pluck("id")
                    : [];

            let start = moment(response.data.started_at + ' ' + response.data.start_time).utc(true)
                .local()

            this.formData.started_at = response.data.started_at
                ? new Date(start)
                : "";
            this.startTime = response.data.start_time
                ? moment(start).format(`${time_format()}`)
                : "";

            let end = moment(response.data.ended_at + ' ' + response.data.end_time).utc(true)
                .local()

            this.formData.ended_at = response.data.ended_at
                ? new Date(end)
                : "";
            this.endTime = response.data.end_time
                ? moment(end).format(`${time_format()}`)
                : "";
            this.dataLoaded = true;
        },
        beforeSubmit() {
            this.loading = true;
        },
        submit() {
            
            
            
        },
        pipeline(funcArr) {
            funcArr.forEach((obj) => {
                if (Promise.resolve(obj) !== obj) {
                    throw new Error(
                        "Expects all methods are passed in parameter array should return Promise"
                    );
                }
            });
            return Promise.all(funcArr);
        },
        getActivityType() {
            return this.axiosGet(route(`activity_types.index`))
                .then((response) => {
                    this.activityTypeList = this.collection(response.data.data).shaper(
                        "translated_name"
                    );
                    console.log(this.a)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        
        
    },
};
</script>

<style scoped lang="scss">
.schedule-default-time-slot {
    .active {
        color: #4466f2 !important;
        background-color: var(--base-color) !important;
        border-color: var(--default-border-color) !important;
    }
}
</style>
