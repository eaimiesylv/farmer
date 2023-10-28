@php
    $locale = \Cookie::has('user_lang') ? \Cookie::get('user_lang') : config('settings.application.language');
   
    $data = [
        [
            'icon' => 'pie-chart',
            'name' => __('default.dashboard',[],$locale),
            'url' => request()->root().'/admin/dashboard',
            'permission' => authorize_any(['manage_dashboard']),
        ],
		 [
            'icon' => 'file',
            'name' => __('Manage Pitch',[],$locale),
            'url' => request()->root().'/admin/pitch/view_pitch',
           'permission' => authorize_any(['manage_pitch']),
        ],
        [
            'icon' => 'users',
            'name' => __('Investors',[],$locale),
            'url' => request()->root().'/admin/investor_detail',
           'permission' => authorize_any(['view_investor_detail']),
        ],
        [
            'icon' => 'users',
            'name' => __('Agribusinesses',[],$locale),
            'url' => request()->root().'/admin/agri_business',
           'permission' => authorize_any(['view_agri_business']),
        ],

        /* [
            'id' => 'email',
            'icon' => 'mail',
            'name' => __('default.email',[],$locale),
            'permission' => authorize_any(['view_persons', 'view_organizations', 'view_types']),
            'subMenu' => [
                [
                   'name' => __('default.inbox',[],$locale),
                   'url' => request()->root().'/email/inbox',
                   'permission' => authorize_any(['view_persons']),
                ],
                [
                    'name' => __('default.email_compose',[],$locale),
                    'url' => request()->root().'/email/compose',
                    'permission' => authorize_any(['view_types']),
                ],
            ],
    ], */
        /*[
            'id' => 'leads',
            'icon' => 'users',
            'name' => __('default.leads',[],$locale),
            'permission' => authorize_any(['view_persons', 'view_organizations', 'view_types']),
            ****remove one'permission' => authorize_any(['']),
            'subMenu' => [
                [
                    'name' => __('default.persons',[],$locale),
                    'url' => request()->root().'/person/list',
                    'permission' => authorize_any(['view_persons']),
                ],
               
                [
                    'name' => __('default.lead_groups',[],$locale),
                    'url' => request()->root().'/contact/type/list',
                    'permission' => authorize_any(['view_types']),
                ],
            ],
        ],*/
        
       /* [
            'id' => 'deals',
            'icon' => 'clipboard',
            'name' => __('Manage deal',[],$locale),
            'permission' => authorize_any(['view_deals', 'manage_deal']),
            'subMenu' => [
                
                [
                    'name' => __('Manage deal',[],$locale),
                    'url' => request()->root().'admin/managedeal',
                    'permission' => authorize_any(['manage_deal']),

                ],
                [
                    'name' => __('Manage deal',[],$locale),
                    'url' => request()->root().'/admin/managedeal',
                    'permission' => authorize_any(['manage_deal']),
                ],
                [
                    'name' => __('Manage deal',[],$locale),
                    'url' => request()->root().'/admin/managedeal',
                    'permission' => authorize_any(['manage_deal']),

                ]
                 
            ],
        ],*/
        [
            'id' => 'deals',
            'icon' => 'clipboard',
            'name' => __('default.deals',[],$locale),
            'permission' => authorize_any(['view_deals', 'view_pipelines', 'view_lost_reasons','manage_deal']),
            'subMenu' => [
               /* [
                    'name' => __('default.all_deals',[],$locale),
                    'url' => request()->root().'/deals/list/view',
                    'permission' => authorize_any(['view_deals']),

                ],*/
                /************************************************************************** This session handles viewing of deal**************************/
                [
                    'name' => __('default.all_deals',[],$locale),
                    'url' => request()->root().'/admin/managedeals',
                    'permission' => authorize_any(['view_deals']),

                ],
                /*[
                    'name' => __('default.pipelines',[],$locale),
                    'url' => request()->root().'/pipelines/list/view',
                    'permission' => authorize_any(['view_pipelines']),
                ],
                [
                    'name' => __('default.pipeline_view',[],$locale),
                    'url' => request()->root().'/deals/pipeline/view',
                    'permission' => authorize_any(['page_deals_pipeline']),

                ]*/
                 
            ],
        ],
        /************************************************************************ This handles Invoice and proposal of ************************************** */
        /*[
           'icon' => 'file-text',
           'name' => __('default.invoices',[],$locale),
            'url' => request()->root().'/invoices/list',
           'permission' => authorize_any(['view_invoice']),
        ],
        [
           'icon' => 'file-text',
           'name' => __('default.invoices',[],$locale),
           'url' => request()->root().'/admin/dealinvoices',
           'permission' => authorize_any(['view_invoice']),
        ],*/
        [
            'icon' => 'hexagon',
            'name' => __('Proposal',[],$locale),
            'url' => request()->root().'/admin/dealproposals',
            'permission' => authorize_any(['view_proposal']),
        ],
        /*
        [
            'id' => 'proposals',
            'icon' => 'hexagon',
            'name' => __('default.proposals',[],$locale),
            'permission' => authorize_any(['view_proposals']),
            'subMenu' => [
                [
                    'name' => __('default.proposal_list',[],$locale),
                    'url' => request()->root().'/proposals/list/view',
                    'permission' => authorize_any(['view_proposals']),
                ],
                [
                    'name' => __('default.templates',[],$locale),
                    'url' => request()->root().'/template/view',
                    'permission' => authorize_any(['view_templates']),
                ],
            ],
        ],*/
        /*[
            'id' => 'activities',
            'icon' => 'activity',
            'name' => __('default.activities',[],$locale),
            'permission' => authorize_any(['view_activities']),
            'subMenu' => [
                [
                    'name' => __('default.calendar_view',[],$locale),
                    'url' => request()->root().'/activities/calendar/view/',
                    'permission' => authorize_any(['view_activities']),
                ],
                [
                    'name' => __('default.activity_list',[],$locale),
                    'url' => request()->root().'/activities/list/view',
                    'permission' => authorize_any(['view_activities']),
                ],
            ],
        ],*/
        /* [
            'id' => __t('expenses'),
            'icon' => 'dollar-sign',
            'name' => __t('expenses'),
            'permission' => authorize_any(['view_activities']),
            'subMenu' => [
                [
                    'name' => __('default.expenses',[],$locale),
                    'url' => request()->root().'/expenses/list',
                    'permission' =>  authorize_any(['view_expense'])
                ],
                [
                    'name' => __('default.area_of_expense',[],$locale),
                    'url' => request()->root().'/expenses-area/list',
                    'permission' =>  authorize_any(['view_expense_area'])
                ]
            ],
        ],*/
       /* [
            'id' => 'reports',
            'icon' => 'bar-chart',
            'name' => __('default.reports',[],$locale),
             'permission' => authorize_any(['deal_reports', 'proposal_reports', 'pipeline_reports']),
            'subMenu' => [
                [
                    'name' => __('default.deal',[],$locale),
                    'url' => request()->root().'/reports/deal',
                    'permission' =>  authorize_any(['deal_reports']),
                ],
                [
                    'name' => __('default.proposal',[],$locale),
                    'url' => request()->root().'/reports/proposal',
                    'permission' => authorize_any(['proposal_reports']),
                ],
                [
                    'name' => __('default.pipeline',[],$locale),
                    'url' => request()->root().'/reports/pipeline',
                    'permission' => authorize_any(['pipeline_reports']),
                ],
            ],
        ],
        [

           'icon' => 'user-check',
           'name' => __('default.user_and_role',[],$locale),
           'url' => request()->root().'/users/list',
           'permission' => authorize_any(['view_users']),
        ],
        [
            'icon' => 'settings',
            'name' => __('default.settings',[],$locale),
            'url' => request()->root().'/settings/page',
            'permission' => authorize_any(['view_settings']),

        ],*/
       
       
    ];
@endphp
<sidebar :data="{{ json_encode($data) }}"
         :logo-icon-src="{{json_encode(env('APP_URL').config('settings.application.company_icon'))}}"
         :logo-src="{{json_encode(env('APP_URL').config('settings.application.company_logo'))}}"
         logo-url="{{env('APP_URL')}}">

</sidebar>
