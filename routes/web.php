<?php

use Illuminate\Support\Facades\Route;

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
#=== FRONT END ROUTES ======
// Route::get('/', function () {
//     return view('home');
// }); 
Route::get('/','App\Http\Controllers\Seeker\Home@index')->name('home');
Route::get('/login','App\Http\Controllers\Seeker\Login@login')->name('seeker.login');
Route::get('/signup','App\Http\Controllers\Seeker\Register@create_account')->name('seeker.create');
Route::get('/seeker/properties','App\Http\Controllers\Seeker\Properties@properties')->name('seeker.properties');
Route::post('/login_account','App\Http\Controllers\Seeker\Login@login_seeker')->name('seeker.login_seeker');
Route::get('/seeker/logout','App\Http\Controllers\Seeker\Login@logout')->name('seeker.logout');
Route::get('/seeker/properties/pages','App\Http\Controllers\Seeker\Properties@render_property_pages')->name('seeker.render_property_pages');
Route::get('/seeker/properties/list','App\Http\Controllers\Seeker\Properties@render_property_list')->name('seeker.render_property_list');
Route::post('/seeker/properties/search_properties_filter','App\Http\Controllers\Seeker\Properties@search_filter_data_properties')->name('seeker.search_filter_data_properties');
Route::post('/seeker/create-account','App\Http\Controllers\Seeker\Register@sign_up_seeker')->name('seeker.sign_up_seeker');
// Route::get('/seeker/profile','App\Http\Controllers\Seeker\ProfileCtr@user_profile')->name('seeker.profile');
Route::get('/seeker/properties/{id}','App\Http\Controllers\Seeker\Properties@property_details')->name('seeker.property_details');
Route::get('/seeker/search-agent','App\Http\Controllers\Seeker\SearchAgent@search_agent')->name('seeker.search_agent');
Route::get('/seeker/search-agent/profile/{agent_id}','App\Http\Controllers\Seeker\SearchAgent@view_agent_profile')->name('seeker.view_agent_profile');
Route::post('/seeker/search-agent/details','App\Http\Controllers\Seeker\SearchAgent@query_agent_posted')->name('seeker.query_agent_posted');
Route::get('/seeker/query_agents','App\Http\Controllers\Seeker\SearchAgent@query_agents')->name('seeker.query_agents');
Route::get('/seeker/map','App\Http\Controllers\Seeker\Properties@map')->name('seeker.map');





Route::group(['middleware' => 'seeker'], function(){

    Route::get('/seeker/profile','App\Http\Controllers\Seeker\ProfileCtr@user_profile')->name('seeker.profile');
    Route::get('/seeker/favorite','App\Http\Controllers\Seeker\Favorites@show_favorite_property')->name('seeker.show_favorite_property');
    Route::post('/seeker/add_items_favorite','App\Http\Controllers\Seeker\Properties@add_items_favorite')->name('seeker.add_items_favorite');
    Route::post('/seeker/remove_favorite','App\Http\Controllers\Seeker\Favorites@remove_favorite')->name('seeker.remove_favorite');
    Route::get('/seeker/submit_report','App\Http\Controllers\Seeker\Reports@submit_report')->name('seeker.submit_report');
    Route::post('/seeker/create_report','App\Http\Controllers\Seeker\Reports@create_report')->name('seeker.create_report');
    Route::post('/seeker/change_password', 'App\Http\Controllers\Seeker\ProfileCtr@change_password')->name('seeker.change_password');
    Route::post('/seeker/update_email', 'App\Http\Controllers\Seeker\ProfileCtr@update_email')->name('seeker.update_email');
    Route::post('/seeker/update_username', 'App\Http\Controllers\Seeker\ProfileCtr@update_username')->name('seeker.update_username');

});

#=== ADMIN ROUTES ======
Route::get('admin/login', 'App\Http\Controllers\AdminController\LoginController@login_form')->name('admin.loginshow');
Route::post('admin/login', 'App\Http\Controllers\AdminController\LoginController@login')->name('admin.login');
Route::get('logout', 'App\Http\Controllers\AdminController\LoginController@logout')->name('logout');
Route::get('admin/create-account', 'App\Http\Controllers\AdminController\LoginController@create_user')->name('create_admin_account');
Route::post('admin/create-account', 'App\Http\Controllers\AdminController\RegistrationController@sign_up_admin')->name('sign_up_admin');
Route::post('profile/upload', 'App\Http\Controllers\AdminController\AdminController@upload_photo_user')->name('upload_profile_img');
Route::post('seeker/update_profile_img', 'App\Http\Controllers\Seeker\ProfileCtr@update_profile_img')->name('seeker.update_profile_img');
Route::post('seeker/update_user_information', 'App\Http\Controllers\Seeker\ProfileCtr@update_user_information')->name('seeker.update_user_information');

#===== GROUPING ROUTE ACCORDING TO MIDDLEWARE ==========
Route::group(['middleware' => 'admin'], function(){

    Route::get('admin/dashboard', 'App\Http\Controllers\AdminController\AdminController@admin_dashboard')->name('admin.home');
    Route::get('admin/view_request_approval', 'App\Http\Controllers\AgentCtr@view_request_approval')->name('admin.view_request_approval');
    Route::get('admin/get_all_pending_review', 'App\Http\Controllers\AgentCtr@get_all_pending_review')->name('admin.get_all_pending_review');
    Route::get('admin/view_agent_profile_review/{user_id}/{review_id}', 'App\Http\Controllers\AgentCtr@view_agent_profile_review');
    Route::post('admin/reject_agent_account', 'App\Http\Controllers\AgentCtr@reject_agent_account')->name('admin.reject_agent_account');
    Route::post('admin/approve_agents_account', 'App\Http\Controllers\AgentCtr@approve_agents_account')->name('admin.approve_agents_account');
    Route::get('admin/view_agent_list', 'App\Http\Controllers\AgentCtr@view_agent_list')->name('admin.view_agent_list');
    Route::post('admin/agent_search_result', 'App\Http\Controllers\AgentCtr@agent_search_result')->name('admin.agent_search_result');
    Route::post('admin/deactivate_agents_accounts', 'App\Http\Controllers\AgentCtr@deactivate_agents_accounts')->name('admin.deactivate_agents_accounts');
    Route::get('admin/view_property_agent_posted/{user_id}', 'App\Http\Controllers\AgentCtr@view_property_agent_posted');
    Route::get('admin/get_all_property_posted_agent/{user_id}', 'App\Http\Controllers\AgentCtr@get_all_property_posted_agent')->name('admin.get_all_property_posted_agent');
    Route::post('admin/get_photos_carousel', 'App\Http\Controllers\AgentCtr@get_photos_carousel')->name('admin.get_photos_carousel');
    Route::post('admin/reset_password', 'App\Http\Controllers\AgentCtr@reset_password')->name('admin.reset_password');
    Route::get('admin/view_customer_list', 'App\Http\Controllers\CustomerCtr@view_customer_list')->name('admin.view_customer_list');
    Route::get('admin/show_customer_record', 'App\Http\Controllers\CustomerCtr@show_customer_record')->name('admin.show_customer_record');
    Route::post('admin/view_properties_table', 'App\Http\Controllers\CustomerCtr@view_properties_table')->name('admin.view_properties_table');
    Route::get('admin/view_favorite', 'App\Http\Controllers\CustomerCtr@view_favorite')->name('admin.view_favorite');
    Route::get('admin/view_new_request_list/{status}', 'App\Http\Controllers\InvestigationCtr@view_new_request_list');
    Route::get('admin/view_request_all/{status}', 'App\Http\Controllers\InvestigationCtr@view_request_all');
    Route::get('admin/open_request_details/{inv_id}', 'App\Http\Controllers\InvestigationCtr@open_request_details');
    Route::post('admin/insert_notes', 'App\Http\Controllers\InvestigationCtr@insert_notes')->name('admin.insert_notes');
    Route::get('admin/create_announcement', 'App\Http\Controllers\AnnouncementCtr@create_announcement')->name('admin.create_announcement');
    Route::post('admin/publish_announcement', 'App\Http\Controllers\AnnouncementCtr@publish_announcement')->name('admin.publish_announcement');
    Route::get('admin/view_announcement_list', 'App\Http\Controllers\AnnouncementCtr@view_announcement_list')->name('admin.view_announcement_list');
    Route::get('admin/announcement_list', 'App\Http\Controllers\AnnouncementCtr@announcement_list')->name('admin.announcement_list');
    Route::post('admin/remove_announcement', 'App\Http\Controllers\AnnouncementCtr@removeAnnouncement')->name('admin.removeAnnouncement');
    Route::post('admin/show_announcement_by_id', 'App\Http\Controllers\AnnouncementCtr@show_announcement_by_id')->name('admin.show_announcement_by_id');
    Route::get('admin/admin_profile_settings', 'App\Http\Controllers\ProfileCtr@admin_profile_settings')->name('admin.admin_profile_settings');
    Route::post('admin/update_user_details', 'App\Http\Controllers\ProfileCtr@update_user_details')->name('admin.update_user_details');
    Route::post('admin/change_password', 'App\Http\Controllers\ProfileCtr@change_password')->name('admin.change_password');
    Route::post('admin/update_profile_img', 'App\Http\Controllers\ProfileCtr@update_profile_img')->name('admin.update_profile_img');
    Route::get('admin/view_create_admin', 'App\Http\Controllers\CreateAdminCtr@view_create_admin')->name('admin.view_create_admin');
    Route::post('admin/sign_up_admin', 'App\Http\Controllers\CreateAdminCtr@sign_up_admin')->name('admin.sign_up_admin');

});

Route::post('agent/query_active_properties', 'App\Http\Controllers\AdminController\AppointmentCtr@query_active_properties')->name('agent.query_active_properties');

Route::group(['middleware' => 'agent'], function(){

    Route::get('agent/dashboard', 'App\Http\Controllers\AdminController\AdminController@agent_dashboard')->name('admin.agent');
    Route::get('agent/properties', 'App\Http\Controllers\AdminController\AdminController@show_properties')->name('agent.properties');
    Route::post('agent/add_properties', 'App\Http\Controllers\AdminController\AdminController@add_properties')->name('agent.add_properties');
    Route::get('agent/show_user_properties', 'App\Http\Controllers\AdminController\AdminController@get_all_property_posted')->name('agent.show_prop_posted');
    Route::post('agent/view_property_by_id', 'App\Http\Controllers\AdminController\AdminController@view_property_by_id')->name('agent.show_prop_by_id');
    Route::post('agent/remove_properties', 'App\Http\Controllers\AdminController\AdminController@remove_properties')->name('agent.remove_properties');
    Route::post('agent/update_property_details', 'App\Http\Controllers\AdminController\AdminController@update_property_details')->name('agent.update_property_details');
    Route::post('agent/agent_verify_email', 'App\Http\Controllers\AdminController\AdminController@agent_verify_email')->name('agent.agent_verify_email');
    Route::post('agent/verify_pin_received', 'App\Http\Controllers\AdminController\AdminController@verify_pin_received')->name('agent.verify_pin_received');
    Route::get('agent/view_subscription', 'App\Http\Controllers\SubscriptionController@view_subscription')->name('agent.view_subscription');
    Route::get('agent/add_appointments', 'App\Http\Controllers\AdminController\AppointmentCtr@add_appointments')->name('agent.add_appointments');
    Route::post('agent/query_active_seekers', 'App\Http\Controllers\AdminController\AppointmentCtr@query_active_seekers')->name('agent.query_active_seekers');
    
    Route::post('agent/create_apt_insert', 'App\Http\Controllers\AdminController\AppointmentCtr@create_apt_insert')->name('agent.create_apt_insert');
    Route::get('agent/view_appointment', 'App\Http\Controllers\AdminController\AppointmentCtr@view_appointment')->name('agent.view_appointment');
    Route::get('agent/view_apt_ajax', 'App\Http\Controllers\AdminController\AppointmentCtr@view_apt_ajax')->name('agent.view_apt_ajax');
    Route::post('agent/add_images', 'App\Http\Controllers\PropertyController@add_images')->name('agent.add_images');
    Route::post('agent/upload_image_property', 'App\Http\Controllers\PropertyController@upload_image_property')->name('agent.upload_image_property');
    Route::post('agent/fetch_existing_img', 'App\Http\Controllers\PropertyController@fetch_existing_img')->name('agent.fetch_existing_img');
    Route::post('agent/delete_property_photo', 'App\Http\Controllers\PropertyController@delete_property_photo')->name('agent.delete_property_photo');
    Route::post('agent/remove_appointment', 'App\Http\Controllers\AdminController\AppointmentCtr@remove_appointment')->name('agent.remove_appointment');
    Route::post('agent/add_agent_subscription', 'App\Http\Controllers\SubscriptionController@add_agent_subscription')->name('agent.add_agent_subscription');
    Route::post('agent/load_subscription_data', 'App\Http\Controllers\SubscriptionController@load_subscription_data')->name('agent.load_subscription_data');
    Route::post('agent/update_agent_subscription_status', 'App\Http\Controllers\SubscriptionController@update_agent_subscription_status')->name('agent.update_agent_subscription_status');
    Route::get('agent/agent_profile', 'App\Http\Controllers\ProfileCtr@agent_profile')->name('agent.agent_profile');
    Route::post('agent/update_user_details', 'App\Http\Controllers\ProfileCtr@update_user_details')->name('agent.update_user_details');
    Route::post('agent/create_broker', 'App\Http\Controllers\BrokerCtr@create_broker')->name('agent.create_broker');
    Route::post('agent/update_broker_details', 'App\Http\Controllers\BrokerCtr@update_broker_details')->name('agent.update_broker_details');
    Route::post('agent/update_broker_img', 'App\Http\Controllers\BrokerCtr@update_broker_img')->name('agent.update_broker_img');
    Route::post('agent/update_profile_img', 'App\Http\Controllers\ProfileCtr@update_profile_img')->name('agent.update_profile_img');
    Route::post('agent/add_documents', 'App\Http\Controllers\DocumentCtr@add_documents')->name('agent.add_documents');
    Route::post('agent/remove_document', 'App\Http\Controllers\DocumentCtr@remove_document')->name('agent.remove_document');
    Route::post('agent/submit_application', 'App\Http\Controllers\ReviewAccountCtr@submitApplication')->name('agent.submitApplication');
    Route::post('agent/agent_view_notification', 'App\Http\Controllers\AnnouncementCtr@agent_view_notification')->name('agent.agent_view_notification');
    Route::post('agent/change_password', 'App\Http\Controllers\ProfileCtr@change_password')->name('agent.change_password');
    Route::get('agent/view_announcement_details/{ann_id}', 'App\Http\Controllers\AnnouncementCtr@view_announcement_details')->name('agent.view_announcement_details');
});
