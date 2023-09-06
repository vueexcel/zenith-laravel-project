<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\Accident;

Route::get('/azure', 'AzureController@index')->name('azure');

Route::get('/', 'WelcomeController@index')->name('welcome');

/**
 * Register the typical authentication routes for an application.
 * Replacing: Auth::routes();
 */
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('guest_login', 'LoginController@guest_login')->name('guest_login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    if (config('adminlte.registration_open')) {
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
    }

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    if (config('adminlte.impersonate')) {
        /**
         * Impersonate User. Requires authentication.
         */
        Route::post('impersonate/{id}', 'ImpersonateController@impersonate')->name('impersonate');
        /**
         * Stop Impersonate. Requires authentication.
         */
        Route::get('impersonate/stop', 'ImpersonateController@stopImpersonate')->name('impersonate.stop');
    }
});

// Redirect to /dashboard
Route::get('/home', 'HomeController@index')->name('home');



/**
 * Dashboard. Common access.
 * // Matches The "/dashboard/*" URLs
 */
Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard::'], function () {
    /**
     * Dashboard Index
     * // Route named "dashboard::index"
     */
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

    Route::post('graph', ['as' => 'graph_data', 'uses' => 'IndexController@get_graph_data']);
    Route::post('standard_graph', ['as' => 'standard_graph', 'uses' => 'IndexController@get_standard_graph']);
    /**
     * Profile
     * // Route named "dashboard::profile"
     */
    Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@showProfile']);
    Route::post('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@updateProfile']);
});

/**
 * Requires authentication.
 */
Route::group(['middleware' => 'auth'], function () {

    /**
     * // Matches The "/admin/*" URLs
     */
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin::'], function () {
        /**
         * Admin Access
         */
        Route::group(['middleware' => 'admin'], function () {
            /**
             * Admin Index
             * // Route named "admin::index"
             */
            Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

            /**
             * Manage Users.
             * // Routes name "admin.users.*"
             */
            Route::resource('users', 'UsersController');

            //Route::resource('group_codes', 'GroupCodesController');

            //1. Dashboard
            Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);

            //2. Health Concerns
            Route::get('/health_concerns', ['as' => 'health_concerns', 'uses' => 'AdminController@health_concerns']);

            //3. Accident
            Route::get('/accident', ['as' => 'accident', 'uses' => 'AdminController@accident']);

            //4. Quick Near Miss
            Route::get('/q_near_miss', ['as' => 'q_near_miss', 'uses' => 'AdminController@q_near_miss']);

            //5. Workplace Investigation
            Route::get('/workplace_invest', ['as' => 'workplace_invest', 'uses' => 'AdminController@workplace_invest']);

            //6. reduce_flex
            Route::get('/reduce_flex', ['as' => 'reduce_flex', 'uses' => 'AdminController@reduce_flex']);

            //7. Contractor Accident
            Route::get('/con_accident', ['as' => 'con_accidents', 'uses' => 'AdminController@con_accidents']);

            //Supervisors
            Route::get('/supervisors/all', 'SupervisorsController@get_all');
            Route::get('/supervisors/edit', 'SupervisorsController@edit');
            Route::post('/supervisors/save', 'SupervisorsController@save');
            Route::post('/supervisors/delete', 'SupervisorsController@delete');

            //Group Codes
            Route::get('/group_codes/all', 'GroupCodesController@get_all');
            Route::get('/group_codes/edit', 'GroupCodesController@edit');
            Route::post('/group_codes/save', 'GroupCodesController@save');
            Route::post('/group_codes/delete', 'GroupCodesController@delete');

            //Body Parts
            Route::get('/body_parts/all', 'BodyPartsController@get_all');
            Route::get('/body_parts/edit', 'BodyPartsController@edit');
            Route::post('/body_parts/save', 'BodyPartsController@save');
            Route::post('/body_parts/delete', 'BodyPartsController@delete');

            //Mss Causation
            Route::get('/mss_causation/all', 'MssCausationController@get_all');
            Route::get('/mss_causation/edit', 'MssCausationController@edit');
            Route::post('/mss_causation/save', 'MssCausationController@save');
            Route::post('/mss_causation/delete', 'MssCausationController@delete');

            //Origin Types
            Route::get('/origin_types/all', 'OriginTypesController@get_all');
            Route::get('/origin_types/edit', 'OriginTypesController@edit');
            Route::post('/origin_types/save', 'OriginTypesController@save');
            Route::post('/origin_types/delete', 'OriginTypesController@delete');

            //Outcomes
            Route::get('/outcomes/all', 'OutcomesController@get_all');
            Route::get('/outcomes/edit', 'OutcomesController@edit');
            Route::post('/outcomes/save', 'OutcomesController@save');
            Route::post('/outcomes/delete', 'OutcomesController@delete');

            //Next Step
            Route::get('/next_steps/all', 'NextStepsController@get_all');
            Route::get('/next_steps/edit', 'NextStepsController@edit');
            Route::post('/next_steps/save', 'NextStepsController@save');
            Route::post('/next_steps/delete', 'NextStepsController@delete');

            Route::get('/ramp_up/all', 'RampUpController@get_all');
            Route::get('/ramp_up/edit', 'RampUpController@edit');
            Route::post('/ramp_up/save', 'RampUpController@save');
            Route::post('/ramp_up/delete', 'RampUpController@delete');

            //Injury Types
            Route::get('/injury_types/all', 'InjuryTypesController@get_all');
            Route::get('/injury_types/edit', 'InjuryTypesController@edit');
            Route::post('/injury_types/save', 'InjuryTypesController@save');
            Route::post('/injury_types/delete', 'InjuryTypesController@delete');

            //Seen By
            Route::get('/seen_by/all', 'SeenByController@get_all');
            Route::get('/seen_by/edit', 'SeenByController@edit');
            Route::post('/seen_by/save', 'SeenByController@save');
            Route::post('/seen_by/delete', 'SeenByController@delete');

            //GIR Definitions
            Route::get('/gir_definitions/all', 'GirDefinitionsController@get_all');
            Route::get('/gir_definitions/edit', 'GirDefinitionsController@edit');
            Route::post('/gir_definitions/save', 'GirDefinitionsController@save');
            Route::post('/gir_definitions/delete', 'GirDefinitionsController@delete');

            //Causation
            Route::get('/causation/all', 'CausationController@get_all');
            Route::get('/causation/edit', 'CausationController@edit');
            Route::post('/causation/save', 'CausationController@save');
            Route::post('/causation/delete', 'CausationController@delete');

            //Causation Factor
            Route::get('/causation_factors/all', 'CausationFactorsController@get_all');
            Route::get('/causation_factors/edit', 'CausationFactorsController@edit');
            Route::post('/causation_factors/save', 'CausationFactorsController@save');
            Route::post('/causation_factors/delete', 'CausationFactorsController@delete');

            //Incident Types
            Route::get('/incident_types/all', 'IncidentTypesController@get_all');
            Route::get('/incident_types/edit', 'IncidentTypesController@edit');
            Route::post('/incident_types/save', 'IncidentTypesController@save');
            Route::post('/incident_types/delete', 'IncidentTypesController@delete');

            //Incident Types
            Route::get('/work_types/all', 'WorkTypesController@get_all');
            Route::get('/work_types/edit', 'WorkTypesController@edit');
            Route::post('/work_types/save', 'WorkTypesController@save');
            Route::post('/work_types/delete', 'WorkTypesController@delete');

            //Categories
            Route::get('/categories/all', 'CategoriesController@get_all');
            Route::get('/categories/edit', 'CategoriesController@edit');
            Route::post('/categories/save', 'CategoriesController@save');
            Route::post('/categories/delete', 'CategoriesController@delete');

            //Forms
            Route::get('/forms', ['as' => 'forms', 'uses' => 'FormsController@index']);
            Route::post('/section/save', 'FormsController@save_section')->name('save_section');
            Route::post('/section/update', 'FormsController@update_section')->name('update_section');
            Route::delete('/section/delete/{section}', 'FormsController@delete_section')->name('delete_section');
            Route::post('/field/save', 'FormsController@save_field')->name('save_field');
            Route::post('/field/update', 'FormsController@update_field')->name('update_field');
            Route::delete('/field/delete/{field}', 'FormsController@delete_field')->name('delete_field');
            Route::post('/answers', 'FormsController@read_answers')->name('answers');
            Route::post('/answer/save', 'FormsController@save_answer')->name('save_answer');
            Route::post('/answer/update', 'FormsController@update_answer')->name('update_answer');
            Route::delete('/answer/delete/{answer}', 'FormsController@delete_answer')->name('delete_answer');
            //Order
            Route::post('/update_order', 'FormsController@update_order')->name('update_order');
        });
    });

    //user list
    Route::post('/user_list', 'Admin\UsersController@getList')->name('user_list');


    //1. Member List
    Route::resource('members', 'MembersController');
    Route::post('/member_list', 'MembersController@getList')->name('members_list');

    //2. Health Concerns
    Route::resource('health_concerns', 'HealthConcernsController');
    Route::post('/health_concerns_list', 'HealthConcernsController@getList')->name('health_concerns_list');

    Route::get('exceptions', 'HealthConcernsController@exceptions')->name('exceptions');
    Route::post('exception_list', 'HealthConcernsController@exceptionList')->name('exception_list');
    Route::post('exception_export', 'HealthConcernsController@exceptionExport')->name('exception_export');
    Route::post('confirm_exception', 'HealthConcernsController@confirm_exception')->name('confirm_exception');

    //3. Accidents
    Route::resource('accidents', 'AccidentsController');
    Route::post('/accidents_list', 'AccidentsController@getList')->name('accidents_list');

    //3.5. MSS
    Route::get('mss', 'HealthConcernsController@getMss')->name('mss');
    Route::post('/mss_list', 'HealthConcernsController@getMssList')->name('mss_list');

    //4. Quick Near Miss
    Route::resource('quick_near_misses', 'QuickNearMissesController');

    //5. Workplace Investigation
    Route::resource('workplace_investigations', 'WorkplaceInvestigationsController');
    Route::post('/incident_investigations_list', 'WorkplaceInvestigationsController@getList')->name('incident_investigations_list');

    //6. Reduce Flexibility
    Route::resource('reduced_flexibilities', 'ReducedFlexibilitiesController');
    Route::post('/reduced_flexibilities_list', 'ReducedFlexibilitiesController@getList')->name('reduced_flexibilities_list');

    //7. Contractor Accidents
    Route::resource('contractor_accidents', 'ContractorAccidentsController');
    Route::post('/contractor_accidents_list', 'ContractorAccidentsController@getList')->name('contractor_accidents_list');
    //8. Fire Incidents
    Route::resource('fire_incidents', 'FireIncidentsController');
    Route::resource('fire_incidents', 'FireIncidentsController');
    Route::post('/fire_incidents_list', 'FireIncidentsController@getList')->name('fire_incidents_list');

    Route::get('member_info', 'MembersController@get_member');
    Route::get('supervisor_by_group_code', 'Admin\SupervisorsController@get_supervisors_by_group');

    Route::get('member/find', 'MembersController@find');
    Route::get('member_number/add', 'MembersController@add_member');
    Route::get('supervisor/add', 'Admin\SupervisorsController@add');
    Route::get('group_code/add', 'Admin\GroupCodesController@add');
    Route::get('next_step/add', 'Admin\NextStepsController@add');


    Route::get('import_admin', 'ImportCSVController@index')->name('import_admin');
    Route::post('import_admin/save', 'ImportCSVController@save')->name('import_admin.save');
    Route::get('import_admin/import', 'ImportCSVController@import')->name('import_admin.import');

    Route::get('histories', 'HistoryController@index');

    Route::get('import_xml', 'ImportXMLController@index')->name('import_xml');
    Route::post('import_xml/save', 'ImportXMLController@save')->name('import_xml.save');
    Route::get('import_xml/import', 'ImportXMLController@import')->name('import_xml.import');


    //Dashboard Buttons
    Route::post('dashboard/graph_export', 'Dashboard\IndexController@graph_export')->name('dashboard.graph_export');

    //Get Graph Data

    Route::post('dashboard/go_list', 'Dashboard\IndexController@go_list')->name('dashboard.go_list');
    Route::post('dashboard/get_list', 'Dashboard\IndexController@get_list')->name('dashboard.get_list');
    Route::post('dashboard/export', 'Dashboard\IndexController@export')->name('dashboard.export');

    //Save settings
    Route::post('save_setting', 'Admin\AdminController@save_setting')->name('save_setting');

    //Export Options
    Route::get('export_options', 'Admin\AdminController@export_options')->name('export_options');
    Route::post('export_options/save', 'Admin\AdminController@export_options_save')->name('export_options.save');

    //Report
    Route::group(['prefix' => 'report', 'namespace' => 'Report', 'as' => 'report::'], function () {
        /**
         * Report
         */
        //1. Company Statistics
        Route::get('/company_statistics/{report_type}',  ['as' => 'company_statistics',               'uses' => 'CompanyStatisticsController@index']);
        Route::post('/company_statistics/get_report',    ['as' => 'company_statistics.get_report',    'uses' => 'CompanyStatisticsController@get_report']);
        Route::post('/company_statistics/export_report', ['as' => 'company_statistics.export_report', 'uses' => 'CompanyStatisticsController@export_report']);

        //2. Lost Time Accidents
        Route::get('/lost_time_incidents',                ['as' => 'lost_time_incidents',               'uses' => 'LostTimeIncidentController@index']);
        Route::post('/lost_time_incidents/get_report',    ['as' => 'lost_time_incidents.get_report',    'uses' => 'LostTimeIncidentController@get_report']);
        Route::post('/lost_time_incidents/export_report', ['as' => 'lost_time_incidents.export_report', 'uses' => 'LostTimeIncidentController@export_report']);

        //3. All Accidents
        Route::get('/all_accidents/{report_type}',          ['as' => 'all_accidents',               'uses' => 'AllAccidentController@index']);
        Route::post('/all_accidents/get_report',    ['as' => 'all_accidents.get_report',    'uses' => 'AllAccidentController@get_report']);
        Route::post('/all_accidents/export_report', ['as' => 'all_accidents.export_report', 'uses' => 'AllAccidentController@export_report']);

        //4. MSS Incidents
        Route::get('/mss_incidents/{report_type}',  ['as' => 'mss_incidents',               'uses' => 'MSSIncidentController@index']);
        Route::post('/mss_incidents/get_report',    ['as' => 'mss_incidents.get_report',    'uses' => 'MSSIncidentController@get_report']);
        Route::post('/mss_incidents/export_report', ['as' => 'mss_incidents.export_report', 'uses' => 'MSSIncidentController@export_report']);

        //5. Illness Incidents
        Route::get('/illness_incidents',                ['as' => 'illness_incidents',               'uses' => 'IllnessIncidentController@index']);
        Route::post('/illness_incidents/get_report',    ['as' => 'illness_incidents.get_report',    'uses' => 'IllnessIncidentController@get_report']);
        Route::post('/illness_incidents/export_report', ['as' => 'illness_incidents.export_report', 'uses' => 'IllnessIncidentController@export_report']);

        //6. Near Misses
        Route::get('/near_misses',                ['as' => 'near_misses',               'uses' => 'NearMissController@index']);
        Route::post('/near_misses/get_report',    ['as' => 'near_misses.get_report',    'uses' => 'NearMissController@get_report']);
        Route::post('/near_misses/export_report', ['as' => 'near_misses.export_report', 'uses' => 'NearMissController@export_report']);

        //7. RIDDOR Incidents
        Route::get('/riddor_incidents',                ['as' => 'riddor_incidents',               'uses' => 'RiddorIncidentController@index']);
        Route::post('/riddor_incidents/get_report',    ['as' => 'riddor_incidents.get_report',    'uses' => 'RiddorIncidentController@get_report']);
        Route::post('/riddor_incidents/export_report', ['as' => 'riddor_incidents.export_report', 'uses' => 'RiddorIncidentController@export_report']);

        //8. Restriction Cost
        Route::get('/restriction_cost/{report_type}',  ['as' => 'restriction_cost',               'uses' => 'RestrictionController@index']);
        Route::post('/restriction_cost/get_report',    ['as' => 'restriction_cost.get_report',    'uses' => 'RestrictionController@get_report']);
        Route::post('/restriction_cost/export_report', ['as' => 'restriction_cost.export_report', 'uses' => 'RestrictionController@export_report']);

        //9. Work Other Incidents
        Route::get('/work_other_incidents',                ['as' => 'work_other_incidents',               'uses' => 'WorkOtherIncidentController@index']);
        Route::post('/work_other_incidents/get_report',    ['as' => 'work_other_incidents.get_report',    'uses' => 'WorkOtherIncidentController@get_report']);
        Route::post('/work_other_incidents/export_report', ['as' => 'work_other_incidents.export_report', 'uses' => 'WorkOtherIncidentController@export_report']);

        //10. Contract Accidents
        Route::get('/contractor_accidents',                ['as' => 'contractor_accidents',               'uses' => 'ContractorAccidentController@index']);
        Route::post('/contractor_accidents/get_report',    ['as' => 'contractor_accidents.get_report',    'uses' => 'ContractorAccidentController@get_report']);
        Route::post('/contractor_accidents/export_report', ['as' => 'contractor_accidents.export_report', 'uses' => 'ContractorAccidentController@export_report']);

        //11. Master KPI
        Route::get('/daily_restriction_status', ['as' => 'daily_restriction_status', 'uses' => 'DailyRestrictionStatusController@index']);

        //12. Master KPI
        Route::get('/master_kpi/{report_type}',  ['as' => 'master_kpi',               'uses' => 'MasterKPIController@index']);
        Route::post('/master_kpi/get_report',    ['as' => 'master_kpi.get_report',    'uses' => 'MasterKPIController@get_report']);
        Route::post('/master_kpi/export_report', ['as' => 'master_kpi.export_report', 'uses' => 'MasterKPIController@export_report']);

        //13. Health concerns by member
        Route::get('/health_concerns_by_member',                ['as' => 'health_concerns_by_member',               'uses' => 'HealthConcernByMemberController@index']);
        Route::get('/health_concerns_by_member/get_report',     ['as' => 'health_concerns_by_member.get_report',    'uses' => 'HealthConcernByMemberController@get_report']);
        Route::post('/health_concerns_by_member/export_report', ['as' => 'health_concerns_by_member.export_report', 'uses' => 'HealthConcernByMemberController@export_report']);

        Route::get('/all_health_concerns_db',   ['as' => 'all_health_concerns_db',      'uses' => 'AllRecordController@all_health_concerns']);
        Route::get('/all_accidents_db',         ['as' => 'all_accidents_db',            'uses' => 'AllRecordController@all_accidents']);
        Route::post('/all_record_export',       ['as' => 'all_record_export',           'uses' => 'AllRecordController@all_record_export']);

        //Form Reporting
        Route::get('/forms',  ['as' => 'forms',               'uses' => 'FormsController@index']);
    });


    //Forms
    Route::group(['prefix' => 'forms', 'as' => 'forms::'], function () {
        Route::get('/accident',         ['as' => 'accident',            'uses' => 'FormsController@accident']);
        Route::get('/mss',              ['as' => 'mss',                 'uses' => 'FormsController@mss']);
        Route::get('/near_miss',        ['as' => 'near_miss',           'uses' => 'FormsController@near_miss']);
        Route::get('/outstanding',      ['as' => 'outstanding',         'uses' => 'FormsController@outstanding']);
        Route::post('/outstanding',     ['as' => 'filter_outstanding',  'uses' => 'FormsController@filter_outstanding']);
        Route::post('/edit',            ['as' => 'edit',                'uses' => 'FormsController@edit']);
        Route::post('/save_field',      ['as' => 'save_field',          'uses' => 'FormsController@save_field']);
        Route::post('/complete_form',   ['as' => 'complete_form',       'uses' => 'FormsController@complete_form']);

    });
});

Route::get('/get_fully_fit_date', function (\Illuminate\Http\Request $request) {
    $ramp_up = $request->get('ramp_up');
    $placement_date = $request->get('placement_date');
    $placement_date = DateTime::createFromFormat('d/m/Y', $placement_date)->format('Y-m-d');
    $ramp = \App\Models\RampUp::find($ramp_up);
    $ramp_up_week = $ramp->ramp_up;
    if($ramp_up_week == 'None') {
        $fully_fit_date = $placement_date;
    } else{
        if($ramp_up_week == '1 Week') {
            $ramp_up_week = '+'.$ramp_up_week.'s';
        } else{
            $ramp_up_week = '+'.$ramp_up_week;
        }
        $fully_fit_date = date('Y-m-d', strtotime($ramp_up_week, strtotime($placement_date)));
    }

    $fully_fit_date = DateTime::createFromFormat('Y-m-d', $fully_fit_date)->format('d/m/Y');
    echo $fully_fit_date;
});
Route::get('dashboard/go_page/{type}', 'Dashboard\IndexController@go_page')->name('dashboard.go_page');

Route::get('/fixed', function () {

    //=========for Next Step id of health concerns==========
    $hs = HealthConcern::whereYear('logged_date', '>', '2019')->where('is_deleted', 0)->whereNotNull('episode_reference')->get();
    foreach ($hs as $item){
        $d_accident = Accident::where('episode_reference', $item->episode_reference)->where('is_deleted', 0)->get();
        foreach ($d_accident as $accident) {
            $accident->group_code_id = $item->group_code_id;
            $accident->save();
        }
    }
    echo "Success";
});
