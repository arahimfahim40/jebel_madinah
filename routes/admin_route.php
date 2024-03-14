<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin_login', function () {
    return view('admin/auth/login');
});

Route::get('/dashboards', 'admin\HomeController@dashboard')->name('dashboard_admin');
Route::post('/admin_login', 'admin\LoginController@login')->name('admin_login');
Route::get('/admin_shipment_summary', 'admin\HomeController@shipment_summary')->name('shipment_summary_admin');
Route::get('/admin_vehicle_summary', 'admin\HomeController@vehicle_summary')->name('vehicle_summary_admin');
Route::get('/admin_sidebar_count', 'admin\HomeController@admin_sidebar_count')->name('admin_sidebar_count');
Route::get('/admin_sidebar_sub_count', 'admin\HomeController@admin_sidebar_sub_count')->name('admin_sidebar_sub_count');
Route::get('/admin_message', 'admin\HomeController@message')->name('message_admin');
Route::get('/delete_vehicle_admin/{id}', 'admin\VehicleController@delete_vehicle')->name('delete_vehicle_admin');

// company section 
Route::get('/company_admin', 'admin\CustomerController@company')->name('company_admin');
Route::get('/company_data_admin', 'admin\CustomerController@company_data')->name('all_vehicle_data_admin');
Route::get('/search_company', 'admin\CustomerController@search_company')->name('search_company_admin');
Route::get('/paginat_company_admin', 'admin\CustomerController@paginate_company')->name('paginate_company_admin');
Route::get('/delete_company_admin/{id}', 'admin\CustomerController@delete_company')->name('delete_company_admin');
Route::post('/add_company_admin', 'admin\CustomerController@add_company')->name('add_company_admin');
Route::get('/edit_company_admin', 'admin\CustomerController@edit_company')->name('edit_company_admin');
Route::post('/update_company', 'admin\CustomerController@updateCompany')->name('update_company');

// Customer section 
Route::get('/customer_admin', 'admin\CustomerController@customer')->name('customer_admin');
Route::get('/customer_data_admin', 'admin\CustomerController@customer_data')->name('all_vehicle_data_admin');
Route::get('/search_customer', 'admin\CustomerController@search_customer')->name('search_customer_admin');
Route::get('/paginat_customer_admin', 'admin\CustomerController@paginate_customer')->name('paginate_customer_admin');
Route::get('/delete_customer_admin/{id}', 'admin\CustomerController@delete_customer')->name('delete_customer_admin');
Route::post('/add_customer_admin', 'admin\CustomerController@add_customer')->name('add_customer_admin');
Route::post('/add_short_customer_admin', 'admin\CustomerController@add_short_customer')->name('add_short_customer_admin');
Route::get('/edit_customer_admin/{id}', 'admin\CustomerController@edit_customer')->name('edit_customer_admin');
Route::post('/update_customer', 'admin\CustomerController@update_customer')->name('update_customer');
Route::get('/single_customer_admin', 'admin\CustomerController@singel_customer')->name('single_customer_admin');

// all vehicle section
Route::get('/all_vehicles_admin', 'admin\VehicleController@all_vehicles')->name('all_vehicle_admin');
Route::get('/all_vehicles_data_admin', 'admin\VehicleController@all_vehicles_data')->name('all_vehicle_data_admin');
Route::get('/search_all_vehicle_admin', 'admin\VehicleController@search_all_vehicle')->name('search_all_vehicle_admin');
Route::get('/paginate_all_vehicle_admin', 'admin\VehicleController@paginate_all_vehicle')->name('paginate_all_vehicle_admin');
Route::get('/paginate_entry_all_vehicle_admin', 'admin\VehicleController@paginate_entry_all_vehicle')->name('paginate_entry_all_vehicle_admin');
Route::get('/vehicle_pdf_admin', 'admin\VehicleController@vehiclesPdf')->name('vehicle_pdf_admin');
// PGL cars gatepass
Route::get('/downPglGatepass/{id}', 'admin\VehicleController@downloadPGLgatePass')->name('downPglGatepass');
Route::get('/downGatepassPgl/{id}', 'admin\VehicleController@DownGatepassPgls')->name('downGatepassPgl'); //only from email inbox clicked
// PGL end gatepasss
// on the way vehicle section
Route::get('/on_theway_vehicles_admin', 'admin\VehicleController@on_theway_vehicles')->name('on_theway_vehicle_admin');
Route::get('/on_theway_vehicles_data_admin', 'admin\VehicleController@on_theway_vehicles_data')->name('on_theway_vehicle_data_admin');
Route::get('/search_on_theway_vehicle_admin', 'admin\VehicleController@search_on_theway_vehicle')->name('search_on_theway_vehicle_admin');
Route::get('/paginate_on_theway_vehicle_admin', 'admin\VehicleController@paginate_on_theway_vehicle')->name('paginate_on_theway_vehicle_admin');
Route::get('/paginate_entry_on_theway_vehicle_admin', 'admin\VehicleController@paginate_entry_on_theway_vehicle')->name('paginate_entry_on_theway_vehicle_admin');
Route::get('/on_inventory_vehicle_admin', 'admin\VehicleController@on_inventory_vehicles')->name('on_inventory_vehicle_admin');

// Pending vehicle section
Route::get('/pending_vehicles_admin', 'admin\VehicleController@pending_vehicles')->name('pending_vehicle_admin');
Route::get('/pending_vehicles_data_admin', 'admin\VehicleController@pending_vehicles_data')->name('pending_vehicle_data_admin');
Route::get('/search_pending_vehicle_admin', 'admin\VehicleController@search_pending_vehicle')->name('search_pending_vehicle_admin');
Route::get('/paginate_pending_vehicle_admin', 'admin\VehicleController@paginate_pending_vehicle')->name('paginate_pending_vehicle_admin');
Route::get('/paginate_entry_pending_vehicle_admin', 'admin\VehicleController@paginate_entry_pending_vehicle')->name('paginate_entry_pending_vehicle_admin');

// on the way vehicle section
Route::get('/onhand_notitle_vehicles_admin', 'admin\VehicleController@onhand_notitle_vehicles')->name('onhand_notitle_vehicle_admin');
Route::get('/onhand_notitle_vehicles_data_admin', 'admin\VehicleController@onhand_notitle_vehicles_data')->name('onhand_notitle_vehicle_data_admin');
Route::get('/search_onhand_notitle_vehicle_admin', 'admin\VehicleController@search_onhand_notitle_vehicle')->name('search_onhand_notitle_vehicle_admin');
Route::get('/paginate_onhand_notitle_vehicle_admin', 'admin\VehicleController@paginate_onhand_notitle_vehicle')->name('paginate_onhand_notitle_vehicle_admin');
Route::get('/paginate_entry_onhand_notitle_vehicle_admin', 'admin\VehicleController@paginate_entry_onhand_notitle_vehicle')->name('paginate_entry_onhand_notitle_vehicle_admin');

// on the way vehicle section
Route::get('/onhand_withtitle_vehicles_admin', 'admin\VehicleController@onhand_withtitle_vehicles')->name('onhand_withtitle_vehicle_admin');
Route::get('/onhand_withtitle_vehicles_data_admin', 'admin\VehicleController@onhand_withtitle_vehicles_data')->name('onhand_withtitle_vehicle_data_admin');
Route::get('/search_onhand_withtitle_vehicle_admin', 'admin\VehicleController@search_onhand_withtitle_vehicle')->name('search_onhand_withtitle_vehicle_admin');
Route::get('/paginate_onhand_withtitle_vehicle_admin', 'admin\VehicleController@paginate_onhand_withtitle_vehicle')->name('paginate_onhand_withtitle_vehicle_admin');
Route::get('/paginate_entry_onhand_withtitle_vehicle_admin', 'admin\VehicleController@paginate_entry_onhand_withtitle_vehicle')->name('paginate_entry_onhand_withtitle_vehicle_admin');


// onHalfCut vehicle section
Route::get('/onhand_onhalfcut_vehicle_admin', 'admin\VehicleController@onhalfcut_vehicles')->name('onhand_onhalfcut_vehicle_admin');
Route::get('/search_halfcut_vehicle_admin', 'admin\VehicleController@search_halfcut_vehicle_admin')->name('search_halfcut_vehicle_admin');
Route::get('/onhand_onhalfcut_vehicle_admin/onhand_onhalfcut_vehicle_summary', 'admin\VehicleController@onhalfcut_vehicle_summary')->name('onhand_onhalfcut_vehicle_summary'); // show halfuct summary
Route::get('/vehicle_summary_search_halfcut/{company_id}/{halfcut_status}/{location}', 'admin\VehicleController@vehicle_summary_search_halfcut')->name('vehicle_summary_search_halfcut');
Route::get('/get_halfcut_based_customer', 'admin\VehicleController@search_halfcut_vehicle_customer')->name('get_halfcut_based_customer');
Route::get('/get_halfcut_based_status', 'admin\VehicleController@search_halfcut_vehicle_status')->name('get_halfcut_based_halfcut');
Route::get('/paginate_halfcut_vehicle_admin', 'admin\VehicleController@paginate_halfcut_vehicle')->name('paginate_halfcut_vehicle_admin');
Route::get('/paginate_entry_halfcut_vehicle_admin', 'admin\VehicleController@paginate_entry_onhand_halfcut_vehicle')->name('paginate_entry_halfcut_vehicle_admin');
Route::get('/s2s_customer', 'admin\VehicleController@searchOnlyCustomerSelect2')->name('s2s_customer'); // get only customers


// shipped vehicle section
Route::get('/shipped_vehicles_admin', 'admin\VehicleController@shipped_vehicles')->name('shipped_vehicle_admin');
Route::get('/shipped_vehicles_data_admin', 'admin\VehicleController@shipped_vehicles_data')->name('shipped_vehicle_data_admin');
Route::get('/search_shipped_vehicle_admin', 'admin\VehicleController@search_shipped_vehicle')->name('search_shipped_vehicle_admin');
Route::get('/paginate_shipped_vehicle_admin', 'admin\VehicleController@paginate_shipped_vehicle')->name('paginate_shipped_vehicle_admin');
Route::get('/paginate_entry_shipped_vehicle_admin', 'admin\VehicleController@paginate_entry_shipped_vehicle')->name('paginate_entry_shipped_vehicle_admin');

// Shipped at loading and already in Yard vehilces.
Route::get('/shipped_atloading_vehicles', 'admin\VehicleController@shippedAtloadingVehicles')->name('shipped_atloading_vehicles');

// cost analysis section 
Route::get('/vehicles_cost_anylysis_admin', 'admin\VehicleController@vehicle_cost_analysis')->name('vehicle_cost_analysis_admin');
Route::get('/vehicle_cost_analysis_data_admin', 'admin\VehicleController@vehicle_cost_analysis_data')->name('vehicle_cost_analysis_data_admin');
Route::get('/search_vehicle_cost_analysis_admin', 'admin\VehicleController@search_vehicle_cost_analysis')->name('search_vehicle_cost_analysis_admin');
Route::get('/paginate_vehicle_cost_analysis_admin', 'admin\VehicleController@paginate_vehicle_cost_analysis')->name('paginate_vehicle_cost_analysis_admin');

// tow cost report section 
Route::get('/tow_cost_report_admin', 'admin\VehicleController@tow_cost_report')->name('tow_cost_report_admin');
Route::get('/tow_cost_report_data_admin', 'admin\VehicleController@tow_cost_report_data')->name('tow_cost_report_data_admin');
Route::get('/search_tow_cost_report', 'admin\VehicleController@search_tow_cost_report')->name('search_tow_cost_report_admin');
Route::get('/paginate_tow_cost_report', 'admin\VehicleController@paginate_tow_cost_report')->name('paginate_tow_cost_report_admin');

//  vehicle dateline section
Route::get('/dateline_vehicles_admin', 'admin\VehicleController@dateline_vehicles')->name('dateline_vehicle_admin');
Route::get('/dateline_vehicles_data_admin', 'admin\VehicleController@dateline_vehicles_data')->name('dateline_vehicle_data_admin');
Route::get('/search_dateline_vehicle_admin', 'admin\VehicleController@search_dateline_vehicle')->name('search_dateline_vehicle_admin');
Route::get('/paginate_dateline_vehicle_admin', 'admin\VehicleController@paginate_dateline_vehicle')->name('paginate_dateline_vehicle_admin');
Route::get('/paginate_entry_dateline_vehicle_admin', 'admin\VehicleController@paginate_entry_dateline_vehicle')->name('paginate_entry_dateline_vehicle_admin');

//  view vehicle photo form google drive
Route::get('/vehicle_photo_admin/{id}', 'admin\VehicleController@vehicle_photo')->name('vehicle_photo_admin');

// vehicle condational report
Route::get('vehicle_condational_report_admin/{id}', 'admin\VehicleController@vehicle_condational_report')->name('vehicle_condational_report_admin');

// route to vehicle auction invoice 
Route::get('/auction_inv_file_admin/{file}', [function ($file) {
    $path = base_path('../pgl/public/assets/file/' . $file);
    if (file_exists($path)) {
        return response()->file($path, array('Content-Type' => 'application/pdf'));
    }
    abort(404);
}])->name('auction_ivn_file.admin');

// vehicle summary section 
Route::get('/vehicle_summary', 'admin\VehicleController@vehicle_summary')->name('vehicle_summary');
Route::get('/vehicle_summary_search/{company_id}/{status}/{location}', 'admin\VehicleController@vehicle_summary_search')->name('vehicle_summary_search');
Route::get('/vehicleSummaryCounter', 'admin\VehicleController@vehicleSummaryCounter')->name('vehicleSummaryCounter');

// add and edit vehicle
Route::get('/add_vehicle', 'admin\VehicleController@add_vehicle')->name('add_vehicel');
Route::post('/add_new_vehicle', 'admin\VehicleController@add_new_vehicle')->name('add_new_vehicle');
Route::get('/view_vehicle/{id}', 'admin\VehicleController@view_vehicle')->name('view_vehicel');
Route::get('/edit_vehicle/{id}', 'admin\VehicleController@edit_vehicle')->name('edit_vehicel');
Route::post('/update_vehicle', 'admin\VehicleController@update_vehicle')->name('update_vehicle');
Route::get('/single_vehicle_vin', 'admin\VehicleController@singel_vehicle_vin')->name('single_vehicle_vin');

// change vehicle status section 
Route::get('/change_status_vehicle', 'admin\VehicleController@change_status_vehicle')->name('change_status_vehicle');
Route::get('/change_on_hand_with_title_vehicle_status', 'admin\VehicleController@change_on_hand_with_title_vehicle_status');
Route::get('/add_to_container', 'admin\VehicleController@add_to_container')->name('add_to_container');
Route::get('/s2s_containers_filter_by_location', 'admin\VehicleController@s2s_container')->name('s2s_containers_filter_by_location');
Route::get('/search_vehicle_select2', 'admin\VehicleController@searchVehicleSelect2')->name('search_vehicle_select2');

// Shipment section 
Route::get('/shipment_admin/{id}/{location}/{booking}', 'admin\ShipmentController@shipment')->name('shipment_admin');
Route::get('/shipment_admin_draft_check', 'admin\ShipmentController@draft_check')->name('shipment_admin_draft_check');
Route::get('/shipment_admin_clearance_invoice', 'admin\ShipmentController@clearance_invoice')->name('shipment_admin_clearance_invoice');
Route::get('/shipment_data_admin', 'admin\ShipmentController@shipment_data')->name('shipment_data_admin');
Route::get('/search_shipment', 'admin\ShipmentController@search_shipment')->name('search_shipment_admin');
Route::get('/paginate_shipment', 'admin\ShipmentController@paginate_shipment')->name('paginate_shipment_admin');
Route::get('/approve_change_status', 'admin\ShipmentController@change_shipment_status')->name('approve_change_status');
Route::get('/change_status_no_pass', 'admin\ShipmentController@changeStatusWithoutPass')->name('change_status_no_pass');
Route::get('/add_shipment', function () {
    return view('admin.shipment.add_shipment');
})->middleware('auth:admin');
Route::post('/add_new_shipment', 'admin\ShipmentController@add_new_shipment');
Route::get('/edit_shipment/{id}/{status}', 'admin\ShipmentController@edit_shipment')->name('edit_shipment');
Route::post('/update_shipment', 'admin\ShipmentController@update_shipment')->name('update_shipment');
Route::get('/duplicate_shipment/{id}', 'admin\ShipmentController@duplicate_shipment')->name('duplicate_shipment');
Route::get('/delete_shipment/{id}', 'admin\ShipmentController@delete_shipment')->name('delete_shipment');
Route::get('/checkForContainer', 'admin\ShipmentController@existContainer')->name('checkForContainer');

// Advanced Booking

Route::get('/booking_admin/{vessel_id}/{dest_id}/{location}', 'admin\ShipmentController@booking_admin')->name('booking_admin');
Route::post('/add_booking_admin', 'admin\ShipmentController@add_booking_admin')->name('add_booking_admin');
Route::get('/load_new_booking', 'admin\ShipmentController@loadNewBooking')->name('load_new_booking');
Route::post('/update_booking', 'admin\ShipmentController@update_booking')->name('update_booking');
Route::get('/edit_booking/{id}', 'admin\ShipmentController@bookingEdit')->name('edit_booking');
Route::get('/delete_booking/{id}', 'admin\ShipmentController@delete_booking')->name('delete_booking');
Route::get('/change_status_booking', 'admin\ShipmentController@change_status_booking')->name('change_status_booking');
Route::post('/addBkgtoVessel', 'admin\ShipmentController@addBkgtoVessels')->name('addBkgtoVessel');
Route::post('/addContToBkg', 'admin\ShipmentController@addContToBkgs')->name('addContToBkg');
Route::get('/single_booking_number', 'admin\ShipmentController@ExistBookingNumber')->name('single_booking_number');
Route::get('/single_Editbooking_number', 'admin\ShipmentController@ExistEditBookingNumber')->name('single_Editbooking_number');


//Vessel
Route::get('/all_vessel', 'admin\advBooking\VesselController@allVessel')->name('all_vessel');
Route::post('/saveVessel', 'admin\advBooking\VesselController@saveVessels')->name('saveVessel');
Route::get('/edit_vessel_admin/{id}', 'admin\advBooking\VesselController@editVessel')->name('edit_vessel_admin');
Route::get('/addBooking_to_vessel_admin/{id}', 'admin\advBooking\VesselController@addBkgToVessel')->name('addBooking_to_vessel_admin');
Route::post('/update_vessel', 'admin\advBooking\VesselController@updateVessel')->name('update_vessel');
Route::post('/updateVessel', 'admin\advBooking\VesselController@updateVesselAjax')->name('updateVessel'); //ajax
Route::get('/delete_vessel_admin/{id}', 'admin\advBooking\VesselController@deleteVessel')->name('delete_vessel_admin');
Route::get('/single_exist_vessel', 'admin\advBooking\VesselController@ExistVessel')->name('single_exist_vessel');
Route::get('/existEdit_Vessel', 'admin\advBooking\VesselController@ExistEditVessel')->name('existEdit_Vessel');
Route::get('/booking_summary', 'admin\advBooking\VesselController@bookingSummary')->name('booking_summary');
Route::get('/s2s_all_vessels', 'admin\advBooking\VesselController@s2s_all_vessels')->name('s2s_all_vessels');
Route::get('/s2s_all_destinations', 'admin\advBooking\VesselController@s2s_all_destinations')->name('s2s_all_destinations');

Route::get('/view_booking_containers/{id}', 'admin\advBooking\VesselController@viewBookingContainers')->name('view_booking_containers');

Route::get('/excel_sheet_view', 'admin\advBooking\VesselController@exceSheetView')->name('excel_sheet_view');
Route::post('/update_excel_sheet_view', 'admin\advBooking\VesselController@updateExceSheetView')->name('update_excel_sheet_view');
Route::get('/s2s_all_steamshipline', 'admin\advBooking\VesselController@s2s_allSteamshipline')->name('s2s_all_steamshipline');

// shipment bol and doc
Route::get('/bol_admin/{id}', 'admin\ShipmentController@bol')->name('bol_admin');
Route::get('/bol_pdf_admin/{id}', 'admin\ShipmentController@bol_pdf')->name('bol_pdf_admin');
Route::get('/dock_recepit_admin/{id}', 'admin\ShipmentController@dock_recepit')->name('dock_recepit_admin');
Route::get('/custom_form_admin/{id}', 'admin\ShipmentController@custom_form')->name('custom_form_admin');
Route::get('/release_document_admin/{id}', 'admin\ShipmentController@release_document')->name('release_document_admin');
Route::get('/change_status_shipment', 'admin\ShipmentController@change_status_shipment')->name('change_status_shipment');
Route::get('/shipment_summary', 'admin\ShipmentController@shipment_summary')->name('shipment_summary');
Route::get('/shipment_summary_search/{company_id}/{status}', 'admin\ShipmentController@shipment_summary_search')->name('shipment_summary_search');
Route::get('/check_container_number', 'admin\ShipmentController@check_container_number')->name('check_container_number');
Route::get('/update_etd_date', 'admin\ShipmentController@update_etd_date');
Route::get('/update_eta_date', 'admin\ShipmentController@update_eta_date');
Route::get('/invoice_pdf_admin/{id}', 'admin\InvoiceController@invoice_pdf')->name('invoice_pdf_admin');

// title archive shipment from savannah with status on loading 
Route::get('/archive_shipment_admin', 'admin\ShipmentController@archive_shipment')->name('archive_shipment_admin');
Route::get('/archive_shipment_data_admin', 'admin\ShipmentController@archive_shipment_data')->name('archive_shipment_data_admin');
Route::get('/search_archive_shipment', 'admin\ShipmentController@search_archive_shipment')->name('search_archive_shipment_admin');
Route::get('/paginate_archive_shipment', 'admin\ShipmentController@paginate_archive_shipment')->name('paginate_archive_shipment_admin');
Route::post('/add_archive_shipment', 'admin\ShipmentController@add_archive_shipment')->name('add_archive_shipment');

// pending archive shipment from savannah with status on loading 
Route::get('/pending_archive_shipment_admin', 'admin\ShipmentController@pending_archive_shipment')->name('pending_archive_shipment_admin');
Route::get('/pending_archive_shipment_data_admin', 'admin\ShipmentController@pending_archive_shipment_data')->name('pending_archive_shipment_data_admin');
Route::get('/search_pending_archive_shipment', 'admin\ShipmentController@search_pending_archive_shipment')->name('search_pending_archive_shipment_admin');
Route::get('/paginate_pending_archive_shipment', 'admin\ShipmentController@paginate_pending_archive_shipment')->name('paginate_pending_archive_shipment_admin');

// Invoices section 
Route::get('/invoice_admin/{id}', 'admin\InvoiceController@view_invoice')->name('invoice_admin');
Route::get('/invoice_data_admin', 'admin\InvoiceController@invoice_data')->name('invoice_data_customer');
Route::get('/search_invoice_admin', 'admin\InvoiceController@search_invoice')->name('search_invoice_admin');
Route::get('/paginate_invoice_admin', 'admin\InvoiceController@paginate_invoice')->name('paginate_invoice_admin');
Route::get('/invoices_pdf_admin/{id}', 'admin\InvoiceController@invoice_pdf')->name('invoice_pdf_admin');
Route::get('/add_invoice', 'admin\InvoiceController@add_invoice')->name('add_invoice_admin');
Route::post('/add_new_invoice', 'admin\InvoiceController@add_new_invoice')->name('add_new_invoice_admin');
Route::get('/approve_invoice', 'admin\InvoiceController@approve_invoice')->name('approve_invoice');
Route::get('/edit_invoice/{id}', 'admin\InvoiceController@edit_invoice')->name('edit_invoice_admin');
Route::post('/update_invoice', 'admin\InvoiceController@update_invoice')->name('update_invoice_admin');
Route::get('/delete_invoice/{id}', 'admin\InvoiceController@delete_invoice')->name('delete_invoice_admin');
Route::get('/change_status_invoice', 'admin\InvoiceController@change_status_invoice')->name('change_status_invoice');
Route::get('/check_invoice_number', 'admin\InvoiceController@check_invoice_number')->name('check_invoice_number');

// Checks Section
Route::get('/checks_admin/{id}', 'admin\ChecksController@view_checks')->name('checks_admin');
Route::get('/edit_check/{id}', 'admin\ChecksController@edit_check')->name('edit_check_admin');
Route::post('/update_check', 'admin\ChecksController@update_check')->name('update_check_admin');
Route::get('/delete_check/{id}', 'admin\ChecksController@delete_check')->name('delete_check_admin');
Route::get('/check_vehicles/{id}', 'admin\ChecksController@check_vehicle')->name('check_vehicles');
Route::get('/add_to_check/{id}', 'admin\ChecksController@addToChecks')->name('add_to_check');
Route::get('/searchCheckSelect2', 'admin\ChecksController@searchCheckSelect2')->name('searchCheckSelect2');
Route::post('/addItemToCheck', 'admin\ChecksController@addItemToCheck')->name('addItemToCheck');
Route::get('/s2s_vehicles_check', 'admin\ChecksController@searchVehicleSelect2Check')->name('s2s_vehicles_check');
Route::get('/checks_report_pdf', 'admin\ChecksController@checksPdf')->name('checks_report_pdf');
// End Checks
//Start Mix Shipping Section
Route::get('/add_to_mix_shipping_container/{id}', 'admin\MixShippingController@add_to_mix_shipping_container')->name('add_to_mix_shipping_container');
Route::get('/mix_shipping/containers', 'admin\MixShippingController@mix_shipping_containers')->name('mix_shipping_containers');
Route::get('/mix_shipping/containers/{id}', 'admin\MixShippingController@mix_shipping_container_edit')->name('mix_shipping_container_edit');
Route::post('/mix_shipping/containers/{id}', 'admin\MixShippingController@mix_shipping_container_update')->name('mix_shipping_container_update');
Route::get('/mix_shipping/container_delete', 'admin\MixShippingController@mix_shipping_coantianer_delete')->name('mix_shipping_coantianer_delete');
Route::get('/mix_shipping/s2s_containers', 'admin\MixShippingController@s2s_mix_containers')->name('s2s_mix_containers');
// invoice
Route::get('/mix_shipping/invoices/change_status', 'admin\MixShippingController@mix_shipping_invoice_change_status')->name('mix_shipping_invoice_change_status');
Route::get('/mix_shipping/invoices/approve', 'admin\MixShippingController@mix_shipping_invoice_approve')->name('mix_shipping_invoice_approve');
Route::get('/mix_shipping/invoices/{status}', 'admin\MixShippingController@mix_shipping_invoice')->name('mix_shipping_invoice');
Route::get('/mix_shipping/invoices/{id}/edit', 'admin\MixShippingController@mix_shipping_invoice_edit')->name('mix_shipping_invoice_edit');
Route::post('/mix_shipping/invoices/{id}/update', 'admin\MixShippingController@mix_shipping_invoice_update')->name('mix_shipping_invoice_update');
Route::get('/mix_shipping/invoices/{id}/pdf', 'admin\MixShippingController@mix_shipping_invoice_pdf')->name('mix_shipping_invoice_pdf');
// Settings
Route::get('/mix_shipping/view_settings', 'admin\MixShippingController@mix_shipping_settings')->name('mix_shipping_settings');
Route::post('/mix_shipping/update_settings', 'admin\MixShippingController@mix_shipping_update_settings')->name('mix_shipping_update_settings');
// End Mix Shipping Section

// Shipping rate section 
Route::get('/rates', 'admin\RateController@view_shipping_rate')->name('rates');
Route::get('/rates/shipping_rate_admin', 'admin\RateController@view_shipping_rate')->name('shipping_rate_admin');
Route::get('/shipping_rate_data_admin', 'admin\RateController@shipping_rate_data')->name('shipping_rate_data_admin');
Route::get('/search_shipping_rate_admin', 'admin\RateController@search_shipping_rate')->name('search_shipping_rate_admin');
Route::get('/paginate_shipping_rate_admin', 'admin\RateController@paginate_shipping_rate')->name('paginate_shipping_rate_admin');
Route::post('/add_shipping_rate_admin', 'admin\RateController@add_shipping_rate')->name('add_shipping_rate_admin');
Route::post('/update_shipping_rate_admin', 'admin\RateController@update_shipping_rate')->name('update_shipping_rate_admin');
Route::get('/delete_shipping_rate_admin/{id}', 'admin\RateController@delete_shipping_rate')->name('delete_shipping_rate_admin');

// Twoing rate section 
Route::get('/rates/towing_rate_admin', 'admin\RateController@view_towing_rate')->name('towing_rate_admin');
Route::get('/towing_rate_data_admin', 'admin\RateController@towing_rate_data')->name('towing_rate_data_admin');
Route::get('/search_towing_rate_admin', 'admin\RateController@search_towing_rate')->name('search_towing_rate_admin');
Route::get('/paginate_towing_rate_admin', 'admin\RateController@paginate_towing_rate')->name('paginate_towing_rate_admin');
Route::post('/add_towing_rate_admin', 'admin\RateController@add_update_towing_rate')->name('add_towing_rate_admin');
Route::post('/update_towing_rate_admin', 'admin\RateController@add_update_towing_rate')->name('update_towing_rate_admin');
Route::get('/delete_towing_rate_admin/{id}', 'admin\RateController@delete_towing_rate')->name('delete_towing_rate_admin');

// Pgl profile section 
Route::get('/pgl_profile', 'admin\PglController@pgl_profile')->name('pgl_profile');
Route::post('/update_pgl_profile', 'admin\PglController@update_pgl_profile')->name('update_pgl_profile');

// location section 
Route::get('/location_admin', 'admin\PglController@location')->name('location_admin');
Route::get('/location_data_admin', 'admin\PglController@location_data')->name('all_vehicle_data_admin');
Route::get('/search_location', 'admin\PglController@search_location')->name('search_location_admin');
Route::get('/paginat_location_admin', 'admin\PglController@paginate_location')->name('paginate_location_admin');
Route::get('/delete_location_admin/{id}', 'admin\PglController@delete_location')->name('delete_location_admin');
Route::post('/add_location_admin', 'admin\PglController@add_location')->name('add_location_admin');
Route::post('/edit_location_admin', 'admin\PglController@edit_location')->name('edit_location_admin');

// status section 
Route::get('/status_admin', 'admin\PglController@status')->name('status_admin');
Route::get('/status_data_admin', 'admin\PglController@status_data')->name('all_vehicle_data_admin');
Route::get('/search_status', 'admin\PglController@search_status')->name('search_status_admin');
Route::get('/paginat_status_admin', 'admin\PglController@paginate_status')->name('paginate_status_admin');
Route::get('/delete_status_admin/{id}', 'admin\PglController@delete_status')->name('delete_status_admin');
Route::post('/add_status_admin', 'admin\PglController@add_status')->name('add_status_admin');
Route::post('/edit_status_admin', 'admin\PglController@edit_status')->name('edit_status_admin');

// user section 
Route::get('/user_admin', 'admin\UserController@user')->name('user_admin');
Route::get('/user_data_admin', 'admin\UserController@user_data')->name('all_vehicle_data_admin');
Route::get('/search_user', 'admin\UserController@search_user')->name('search_user_admin');
Route::get('/paginat_user_admin', 'admin\UserController@paginate_user')->name('paginate_user_admin');
Route::get('/delete_user_admin/{id}', 'admin\UserController@deleteUser')->name('delete_user_admin');
Route::get('/edit_user_admin/{id}', 'admin\UserController@editUserAdmin')->name('edit_user_admin');
Route::post('/add_user_admin', 'admin\UserController@add_user')->name('add_user_admin');
Route::post('/update_user_admin', 'admin\UserController@updateUser')->name('update_user_admin');
Route::get('/admin_logout', 'admin\LoginController@logout')->name('admin_logout');
Route::get('/s2s_user', 'admin\UserController@s2sUser')->name('s2s_user');
Route::get('/s2s_timezone', 'admin\UserController@s2sTimezone')->name('s2s_timezone');
Route::get('/get_user_permissions', 'admin\UserController@getUserPermissions')->name('get_user_permissions');
Route::get('/assign_permission_to_user', 'admin\UserController@assignPermissionToUser')->name('assign_permission_to_user');
Route::get('/edit_my_profile', 'admin\UserController@editMyProfile')->name('edit_my_profile');
Route::post('/update_my_profile', 'admin\UserController@updateMyProfile')->name('update_my_profile');

// supplier section.
Route::get('/suppliers', 'admin\SupplierController@suppliers')->name('suppliers');
Route::get('/supplier/{id}', 'admin\SupplierController@supplier')->name('supplier');
Route::post('/save_supplier', 'admin\SupplierController@save_supplier')->name('save_supplier');
Route::post('/update_supplier/{id}', 'admin\SupplierController@update_supplier')->name('update_supplier');
Route::get('/delete_supplier/{id}', 'admin\SupplierController@delete_supplier')->name('delete_supplier');
Route::get('/s2s_supplier', 'admin\SupplierController@s2s_supplier')->name('s2s_supplier');

// PGL Log Section
Route::get('/view_vehicle_logs', 'admin\logs\pgl\VehicleLogController@viewLogs')->name('view_vehicle_logs');
Route::get('/vehicle_log_properties', 'admin\logs\pgl\VehicleLogController@logProperties')->name('vehicle_log_properties');

Route::get('/view_shipment_logs', 'admin\logs\pgl\ShipmentLogController@viewLogs')->name('view_shipment_logs');
Route::get('/shipment_log_properties', 'admin\logs\pgl\ShipmentLogController@logProperties')->name('shipment_log_properties');

Route::get('/view_invoice_logs', 'admin\logs\pgl\InvoiceLogController@viewLogs')->name('view_invoice_logs');
Route::get('/invoice_log_properties', 'admin\logs\pgl\InvoiceLogController@logProperties')->name('invoice_log_properties');

Route::get('/view_company_logs', 'admin\logs\pgl\CompanyLogController@viewLogs')->name('view_company_logs');
Route::get('/company_log_properties', 'admin\logs\pgl\CompanyLogController@logProperties')->name('company_log_properties');

Route::get('/view_customer_logs', 'admin\logs\pgl\CustomerLogController@viewLogs')->name('view_customer_logs');
Route::get('/customer_log_properties', 'admin\logs\pgl\CustomerLogController@logProperties')->name('customer_log_properties');

Route::get('/view_rate_logs', 'admin\logs\pgl\RateLogController@viewLogs')->name('view_rate_logs');
Route::get('/rate_log_properties', 'admin\logs\pgl\RateLogController@logProperties')->name('rate_log_properties');

Route::get('/view_towing_rate_logs', 'admin\logs\pgl\TowingRateLogController@viewLogs')->name('view_towing_rate_logs');
Route::get('/towing_rate_log_properties', 'admin\logs\pgl\TowingRateLogController@logProperties')->name('towing_rate_log_properties');

Route::get('/view_location_logs', 'admin\logs\pgl\LocationStatusLogController@viewLogs')->name('view_location_logs');
Route::get('/location_log_properties', 'admin\logs\pgl\LocationStatusLogController@logProperties')->name('location_log_properties');

Route::get('/view_status_logs', 'admin\logs\pgl\LocationStatusLogController@viewStatusLogs')->name('view_status_logs');
Route::get('/status_log_properties', 'admin\logs\pgl\LocationStatusLogController@statusLogProperties')->name('status_log_properties');

Route::get('/view_user_logs', 'admin\logs\pgl\UserLogController@viewLogs')->name('view_user_logs');
Route::get('/user_log_properties', 'admin\logs\pgl\UserLogController@logProperties')->name('user_log_properties');

Route::get('/view_permission_logs', 'admin\logs\pgl\PermissionLogController@viewLogs')->name('view_permission_logs');
Route::get('/permission_log_properties', 'admin\logs\pgl\PermissionLogController@logProperties')->name('permission_log_properties');

// PGLA Log Section
Route::get('/view_transaction_logs', 'admin\logs\pgla\TransactionLogController@viewLogs')->name('view_transaction_logs');
Route::get('/transaction_log_properties', 'admin\logs\pgla\TransactionLogController@logProperties')->name('transaction_log_properties');

Route::get('/view_transfer_logs', 'admin\logs\pgla\TransferLogController@viewLogs')->name('view_transfer_logs');
Route::get('/transfer_log_properties', 'admin\logs\pgla\TransferLogController@logProperties')->name('transfer_log_properties');

Route::get('/view_account_logs', 'admin\logs\pgla\AccountLogController@viewLogs')->name('view_account_logs');
Route::get('/account_log_properties', 'admin\logs\pgla\AccountLogController@logProperties')->name('account_log_properties');

Route::get('/view_category_logs', 'admin\logs\pgla\CategoryLogController@viewLogs')->name('view_category_logs');
Route::get('/category_log_properties', 'admin\logs\pgla\CategoryLogController@logProperties')->name('category_log_properties');


// PGLC Log Section
Route::get('/view_clear_log_logs', 'admin\logs\pglc\ClearLogLogController@viewLogs')->name('view_clear_log_logs');
Route::get('/clear_log_log_properties', 'admin\logs\pglc\ClearLogLogController@logProperties')->name('clear_log_log_properties');

Route::get('/view_log_invoice_logs', 'admin\logs\pglc\LogInvoiceLogController@viewLogs')->name('view_log_invoice_logs');
Route::get('/log_invoice_log_properties', 'admin\logs\pglc\LogInvoiceLogController@logProperties')->name('log_invoice_log_properties');

Route::get('/view_delivery_invoice_logs', 'admin\logs\pglc\DeliveryInvoiceLogController@viewLogs')->name('view_delivery_invoice_logs');
Route::get('/delivery_invoice_log_properties', 'admin\logs\pglc\DeliveryInvoiceLogController@logProperties')->name('delivery_invoice_log_properties');

Route::get('/view_single_vcc_logs', 'admin\logs\pglc\SingleVccLogController@viewLogs')->name('view_single_vcc_logs');
Route::get('/single_vcc_log_properties', 'admin\logs\pglc\SingleVccLogController@logProperties')->name('single_vcc_log_properties');

Route::get('/view_exit_claim_logs', 'admin\logs\pglc\ExitClaimLogController@viewLogs')->name('view_exit_claim_logs');
Route::get('/exit_claim_log_properties', 'admin\logs\pglc\ExitClaimLogController@logProperties')->name('exit_claim_log_properties');

Route::get('/view_detention_charge_logs', 'admin\logs\pglc\DetentionChargeLogController@viewLogs')->name('view_detention_charge_logs');
Route::get('/detention_charge_log_properties', 'admin\logs\pglc\DetentionChargeLogController@logProperties')->name('detention_charge_log_properties');

// PGLU Log Section

Route::get('/view_used_car_logs', 'admin\logs\pglu\UsedCarLogController@viewLogs')->name('view_used_car_logs');
Route::get('/used_car_log_properties', 'admin\logs\pglu\UsedCarLogController@logProperties')->name('used_car_log_properties');

Route::get('/view_inventory_logs', 'admin\logs\pglu\InventoryLogController@viewLogs')->name('view_inventory_logs');
Route::get('/inventory_log_properties', 'admin\logs\pglu\InventoryLogController@logProperties')->name('inventory_log_properties');

Route::get('/view_payment_logs', 'admin\logs\pglu\PaymentLogController@viewLogs')->name('view_payment_logs');
Route::get('/payment_log_properties', 'admin\logs\pglu\PaymentLogController@logProperties')->name('payment_log_properties');

Route::get('/view_united_customer_logs', 'admin\logs\pglu\UnitedCustomerLogController@viewLogs')->name('view_united_customer_logs');
Route::get('/united_customer_log_properties', 'admin\logs\pglu\UnitedCustomerLogController@logProperties')->name('united_customer_log_properties');

Route::get('/view_united_purchaser_logs', 'admin\logs\pglu\UnitedPurchaserLogController@viewLogs')->name('view_united_purchaser_logs');
Route::get('/united_purchaser_log_properties', 'admin\logs\pglu\UnitedPurchaserLogController@logProperties')->name('united_purchaser_log_properties');

Route::get('/view_united_yard_logs', 'admin\logs\pglu\UnitedYardLogController@viewLogs')->name('view_united_yard_logs');
Route::get('/united_yard_log_properties', 'admin\logs\pglu\UnitedYardLogController@logProperties')->name('united_yard_log_properties');


// ===================================================== PGL Trash =============================================

Route::get('/view_vehicle_trash', 'admin\trash\pgl\VehiclesTrashController@viewPglTrash')->name('view_vehicle_trash');
Route::get('/restore_deleted_vehicle/{id}', 'admin\trash\pgl\VehiclesTrashController@restore_deleted_vehicle')->name('restore_deleted_vehicle');
Route::get('/delete_vehicle_perm/{id}', 'admin\trash\pgl\VehiclesTrashController@force_delete_vehicle')->name('delete_vehicle_perm');

Route::get('/view_shipment_trash', 'admin\trash\pgl\ShipmentsTrashController@viewPglShipmentTrash')->name('view_shipment_trash');
Route::get('/restore_deleted_shipment/{id}', 'admin\trash\pgl\ShipmentsTrashController@restore_deleted_shipment')->name('restore_deleted_shipment');
Route::get('/delete_shipment_perm/{id}', 'admin\trash\pgl\ShipmentsTrashController@force_delete_shipment')->name('delete_shipment_perm');

Route::get('/view_invoice_trash', 'admin\trash\pgl\InvoicesTrashController@viewPglInvoiceTrash')->name('view_invoice_trash');
Route::get('/restore_deleted_invoice/{id}', 'admin\trash\pgl\InvoicesTrashController@restore_deleted_invoice')->name('restore_deleted_invoice');
Route::get('/delete_invoice_perm/{id}', 'admin\trash\pgl\InvoicesTrashController@force_delete_invoice')->name('delete_invoice_perm');

Route::get('/view_company_trash', 'admin\trash\pgl\CompaniesTrashController@viewPglcompanyTrash')->name('view_company_trash');
Route::get('/restore_deleted_company/{id}', 'admin\trash\pgl\CompaniesTrashController@restore_deleted_company')->name('restore_deleted_company');
Route::get('/delete_company_perm/{id}', 'admin\trash\pgl\CompaniesTrashController@force_delete_company')->name('delete_company_perm');

Route::get('/view_customer_trash', 'admin\trash\pgl\CustomersTrashController@viewPglcustomerTrash')->name('view_customer_trash');
Route::get('/restore_deleted_customer/{id}', 'admin\trash\pgl\CustomersTrashController@restore_deleted_customer')->name('restore_deleted_customer');
Route::get('/delete_customer_perm/{id}', 'admin\trash\pgl\CustomersTrashController@force_delete_customer')->name('delete_customer_perm');

Route::get('/view_shipping_rates_trash', 'admin\trash\pgl\shippingRatesTrashController@viewPglshippingRatesTrash')->name('view_shipping_rates_trash');
Route::get('/restore_deleted_shipping_rates/{id}', 'admin\trash\pgl\shippingRatesTrashController@restore_deleted_shipping_rates')->name('restore_deleted_shipping_rates');
Route::get('/delete_shipping_rates_perm/{id}', 'admin\trash\pgl\shippingRatesTrashController@force_delete_shipping_rates')->name('delete_shipping_rates_perm');

Route::get('/view_towing_rates_trash', 'admin\trash\pgl\towingRatesTrashController@viewPgltowingRatesTrash')->name('view_towing_rates_trash');
Route::get('/restore_deleted_towing_rates/{id}', 'admin\trash\pgl\towingRatesTrashController@restore_deleted_towing_rates')->name('restore_deleted_towing_rates');
Route::get('/delete_towing_rates_perm/{id}', 'admin\trash\pgl\towingRatesTrashController@force_delete_towing_rates')->name('delete_towing_rates_perm');

Route::get('/view_status_trash', 'admin\trash\pgl\statusTrashController@viewPglstatusRatesTrash')->name('view_status_trash');
Route::get('/restore_deleted_status/{id}', 'admin\trash\pgl\statusTrashController@restore_deleted_status')->name('restore_deleted_status');
Route::get('/delete_status_perm/{id}', 'admin\trash\pgl\statusTrashController@force_delete_status')->name('delete_status_perm');

Route::get('/view_location_trash', 'admin\trash\pgl\locationTrashController@viewPgllocationRatesTrash')->name('view_location_trash');
Route::get('/restore_deleted_location/{id}', 'admin\trash\pgl\locationTrashController@restore_deleted_location')->name('restore_deleted_location');
Route::get('/delete_location_perm/{id}', 'admin\trash\pgl\locationTrashController@force_delete_location')->name('delete_location_perm');

Route::get('/view_status_user', 'admin\trash\pgl\userTrashController@viewPgluserRatesTrash')->name('view_status_user');
Route::get('/restore_deleted_user/{id}', 'admin\trash\pgl\userTrashController@restore_deleted_user')->name('restore_deleted_user');
Route::get('/delete_user_perm/{id}', 'admin\trash\pgl\userTrashController@force_delete_user')->name('delete_user_perm');




// ===================================================== End PGL Trash =========================================

// ===================================================== PGLA Trash =============================================

Route::get('/view_vehicle_transactions', 'admin\trash\pgla\TransactionTrashController@viewPglTransTrash')->name('view_vehicle_transactions');
Route::get('/restore_deleted_transaction/{id}', 'admin\trash\pgla\TransactionTrashController@restore_deleted_transaction')->name('restore_deleted_transaction');
Route::get('/delete_transaction_perm/{id}', 'admin\trash\pgla\TransactionTrashController@force_delete_transaction')->name('delete_transaction_perm');

Route::get('/view_vehicle_transfer', 'admin\trash\pgla\TransferTrashController@viewPglTransferTrash')->name('view_vehicle_transfer');
Route::get('/restore_deleted_transfer/{id}', 'admin\trash\pgla\TransferTrashController@restore_deleted_transfer')->name('restore_deleted_transfer');

Route::get('/view_trashed_account', 'admin\trash\pgla\AccountTrashController@viewPglAccountTrash')->name('view_trashed_account');
Route::get('/restore_deleted_account/{id}', 'admin\trash\pgla\AccountTrashController@restore_deleted_account')->name('restore_deleted_account');

Route::get('/view_trashed_categories', 'admin\trash\pgla\CategoryTrashController@viewPglCategoryTrash')->name('view_trashed_categories');
Route::get('/restore_trashed_category/{id}', 'admin\trash\pgla\CategoryTrashController@restore_deleted_category')->name('restore_trashed_category');


// ===================================================== End PGLA Trash =========================================

// ===================================================== PGLC Trash =============================================

Route::get('/view_clear_log_trash', 'admin\trash\pglc\ClearLogTrashController@viewPglClearLogTrash')->name('view_clear_log_trash');
Route::get('/restore_trashed_clear_log/{id}', 'admin\trash\pglc\ClearLogTrashController@restore_deleted_clear_log')->name('restore_trashed_clear_log');

Route::get('/view_log_invoice_trash', 'admin\trash\pglc\LogInvoiceTrashController@viewPglcLogInvoiceTrash')->name('view_log_invoice_trash');
Route::get('/restore_trashed_log_invoice/{id}', 'admin\trash\pglc\LogInvoiceTrashController@restore_deleted_log_invoice')->name('restore_trashed_log_invoice');

Route::get('/view_delivery_invoice_trash', 'admin\trash\pglc\DeliveryInvoiceTrashController@viewPglcDeliveryInvoiceTrash')->name('view_delivery_invoice_trash');
Route::get('/restore_trashed_delivery_invoice/{id}', 'admin\trash\pglc\DeliveryInvoiceTrashController@restore_deleted_delivery_invoice')->name('restore_trashed_delivery_invoice');

Route::get('/view_singlvcc_invoice_trash', 'admin\trash\pglc\SinglevccTrashController@viewPglcSinglevccTrash')->name('view_singlvcc_invoice_trash');
Route::get('/restore_trashed_singlvcc_invoice/{id}', 'admin\trash\pglc\SinglevccTrashController@restore_deleted_singlvcc_invoice')->name('restore_trashed_singlvcc_invoice');

Route::get('/view_exit_claim_trash', 'admin\trash\pglc\ExitClaimTrashController@viewPglcExitClaimTrash')->name('view_exit_claim_trash');
Route::get('/restore_trashed_exit_claim/{id}', 'admin\trash\pglc\ExitClaimTrashController@restore_deleted_exit_claim')->name('restore_trashed_exit_claim');

Route::get('/view_detention_charges_trash', 'admin\trash\pglc\DetentionCharTrashController@viewPglcDetenCharTrash')->name('view_detention_charges_trash');
Route::get('/restore_trashed_etention_charges/{id}', 'admin\trash\pglc\DetentionCharTrashController@restore_deleted_etention_charges')->name('restore_trashed_etention_charges');


// ===================================================== End PGLC Trash =========================================


// ===================================================== PGLU Trash =============================================

Route::get('/view_used_cars_trash', 'admin\trash\pglu\UsedCarsTrashController@viewPglUusedCarTrash')->name('view_used_cars_trash');
Route::get('/restore_trashed_used_cars/{id}', 'admin\trash\pglu\UsedCarsTrashController@restore_deleted_used_cars')->name('restore_trashed_used_cars');

Route::get('/view_inventory_trash', 'admin\trash\pglu\InventroyTrashController@viewInventoryTrash')->name('view_inventory_trash');
Route::get('/restore_inventory_trash/{id}', 'admin\trash\pglu\InventroyTrashController@restoreTrashedInventory')->name('restore_inventory_trash');

Route::get('/view_unitedCustomers_trash', 'admin\trash\pglu\UnitedCustomersTrashController@viewUnitedCustomersTrash')->name('view_unitedCustomers_trash');
Route::get('/restore_unitedCustomers_trash/{id}', 'admin\trash\pglu\UnitedCustomersTrashController@restoreTrashedUnitedCustomers')->name('restore_unitedCustomers_trash');

Route::get('/view_companies_trash', 'admin\trash\pglu\CompnayTrashController@viewCompaniesTrash')->name('view_companies_trash');
Route::get('/restore_companies_trash/{id}', 'admin\trash\pglu\CompnayTrashController@restoreTrashedCompanies')->name('restore_companies_trash');

Route::get('/view_purchases_trash', 'admin\trash\pglu\PurchasesTrashController@viewInventoryTrash')->name('view_purchases_trash');
Route::get('/restore_purchases_trash/{id}', 'admin\trash\pglu\PurchasesTrashController@restoreTrashedPurchases')->name('restore_purchases_trash');

Route::get('/view_yard_trash', 'admin\trash\pglu\YardTrashController@viewYardTrash')->name('view_yard_trash');
Route::get('/restore_yard_trash/{id}', 'admin\trash\pglu\YardTrashController@restoreTrashedYard')->name('restore_yard_trash');

// ===================================================== End PGLU Trash =========================================

//  ==================================================== GPLC | Clearance ====================================================
// operation department.
Route::get('/pglc_dashboard', 'admin\ClearLogController@dashboard')->name('pglc_dashboard');
Route::get('/get_clear_log_list', 'admin\ClearLogController@index')->name('clear_log_list');
Route::get('/searchContainers', 'admin\ClearLogController@searchContainers')->name('searchContainers');
Route::get('/search_clear_log', 'admin\ClearLogController@search_clear_log')->name('search_clear_log');
// Route::get('/paginat_clear_log_admin', 'admin\ClearLogController@paginate_clear_log')->name('paginate_clear_log_admin');
Route::get('/delete_clear_log_admin/{id}', 'admin\ClearLogController@delete_clear_log')->name('delete_clear_log_admin');
Route::post('/add_clear_log', 'admin\ClearLogController@add_clear_log')->name('add_clear_log');
Route::post('/edit_clear_log', 'admin\ClearLogController@edit_clear_log')->name('edit_clear_log');
Route::get('/add_clear_log_admin', 'admin\ClearLogController@add_clear_log_admin')->name('add_clear_log_admin');
Route::get('/edit_clear_log_admin/{id}', 'admin\ClearLogController@edit_clear_log_admin')->name('edit_clear_log_admin');
Route::get('/update_clear_log_admin/{id}', 'admin\ClearLogController@update_clear_log_admin')->name('update_clear_log_admin');
Route::get('/clearlog_excel', 'admin\ClearLogController@clearlog_excel')->name('clearlog_excel.export');
Route::get('/search_clears_log', 'admin\ClearLogController@search_clears_log')->name('search_clears_log');
Route::get('/pglcinvoices_pdf_receipt/{id}', 'admin\CreateInvoicesController@invoices_pdf_receipt')->name('pglcinvoices_pdf_receipt');
Route::get('/pglcinvoice_pdf_admin_receipt/{id}', 'admin\CreateInvoicesController@invoice_pdf_receipt')->name('pglcinvoice_pdf_admin_receipt');
Route::get('/pglcinvoice_pdf_admin/{id}', 'admin\CreateInvoicesController@invoice_pdf1')->name('pglcinvoice_pdf_admin'); // pdf 1
Route::get('/pglcinvoice_pdf1_admin/{id}', 'admin\CreateInvoicesController@invoice_pdf2')->name('pglcinvoice_pdf1_admin');
Route::post('/clearlog_excel_import', 'admin\ClearLogController@clearLogImortExcel')->name('clearlog_excel_import');
Route::get('/downloadClearLogImportErrorLog', 'admin\ClearLogController@downloadClearLogImportErrorLog')->name('downloadClearLogImportErrorLog');
Route::get('/filter_clear_log', 'admin\ClearLogController@filter_clear_log')->name('filter_clear_log');
// single vcc charges.
Route::get('/create_single_vcc', 'admin\CreateInvoicesController@createSingleVcc')->name('create_single_vcc');
Route::get('/single_vcc_list/{vcc_status}', 'admin\CreateInvoicesController@singleVccCharges')->name('single_vcc_list');
Route::post('/save_single_vcc', 'admin\CreateInvoicesController@saveSingleVcc')->name('save_single_vcc');
Route::get('/deleteSingleVcc/{id}', 'admin\CreateInvoicesController@deleteSingleVcc')->name('deleteSingleVcc');
Route::get('/getSingleVcc', 'admin\CreateInvoicesController@getSingleVcc')->name('getSingleVcc');
Route::post('/update_single_vcc', 'admin\CreateInvoicesController@updateSingleVcc')->name('update_single_vcc');
Route::get('/searchContainerNoSelect2', 'admin\CreateInvoicesController@searchContainerNoSelect2')->name('searchContainerNoSelect2');
Route::get('/s2s_all_containers', 'admin\CreateInvoicesController@s2s_all_containers')->name('s2s_all_containers');
Route::get('/change_vcc_status', 'admin\CreateInvoicesController@changeVccStatus')->name('change_vcc_status');
Route::get('/singlevcc_invoice/{id}', 'admin\CreateInvoicesController@singlevcc_invoice')->name('singlevcc_invoice'); //pdf tax invoice

// exit claim charges.
Route::get('/create_ecc', 'admin\CreateInvoicesController@createEcc')->name('create_ecc');
Route::get('/exit_claim_charges/{ecc_status}', 'admin\CreateInvoicesController@exitClaimCharges')->name('exit_claim_charges');
Route::post('/save_exit_claim_charges', 'admin\CreateInvoicesController@saveExitClaimCharges')->name('save_exit_claim_charges');
Route::get('/deleteExitClaimCharges/{id}', 'admin\CreateInvoicesController@deleteExitClaimCharges')->name('deleteExitClaimCharges');
Route::get('/getExitClaimCharges', 'admin\CreateInvoicesController@getExitClaimCharges')->name('getExitClaimCharges');
Route::post('/update_exit_claim_charges', 'admin\CreateInvoicesController@updateExitClaimCharges')->name('update_exit_claim_charges');
Route::get('/searchContainerNoSelect2InEcc', 'admin\CreateInvoicesController@searchContainerNoSelect2InEcc')->name('searchContainerNoSelect2InEcc');
Route::get('/change_ecc_status', 'admin\CreateInvoicesController@changeEccStatus')->name('change_ecc_status');
Route::get('/exitclaim_invoice/{id}', 'admin\CreateInvoicesController@exitclaim_invoice')->name('exitclaim_invoice'); //pdf tax invoice

// detention charges.
Route::get('/create_detention', 'admin\CreateInvoicesController@createDetention')->name('create_detention');
Route::post('/save_detention', 'admin\CreateInvoicesController@saveDetention')->name('save_detention');
Route::get('/searchContainerNoSelect2InDC', 'admin\CreateInvoicesController@searchContainerNoSelect2InDC')->name('searchContainerNoSelect2InDC');
Route::get('/detention_charges_list/{status}', 'admin\CreateInvoicesController@detentionChargesList')->name('detention_charges_list');
Route::get('/delete_detention_charge', 'admin\CreateInvoicesController@deleteDetentionCharge')->name('delete_detention_charge');
Route::get('/change_dec_status', 'admin\CreateInvoicesController@changeDecStatus')->name('change_dec_status');
Route::post('/update_detention', 'admin\CreateInvoicesController@updateDetention')->name('update_detention');
Route::get('/getDetentionCharges', 'admin\CreateInvoicesController@getDetentionCharges')->name('getDetentionCharges');
Route::get('/detention_charges_invoice/{id}', 'admin\CreateInvoicesController@detention_charges_invoice')->name('detention_charges_invoice');

//Create Invoice
Route::get('/create_invoice_list', 'admin\CreateInvoicesController@createInvoiceList')->name('create_invoice_list');
Route::get('/delivery_invoice_list', 'admin\CreateInvoicesController@deliveryInvoiceList')->name('delivery_invoice_list');
Route::post('/clear_log_invoice', 'admin\CreateInvoicesController@createInvoice')->name('createInvoice');
Route::post('/delivery_invoice', 'admin\CreateInvoicesController@deliveryInvoice')->name('delivery_invoice');
Route::post('/clearance_status/{id}', 'admin\ClearLogController@clearance_status')->name('clearance_status');
Route::get('/create_invoice_list_excel', 'admin\CreateInvoicesController@create_invoice_excel')->name('create_invoice_excel.export');
Route::get('/invoice_export/{status}', 'admin\CreateInvoicesController@invoice_export')->name('invoices_list.export');
Route::get('/delivery_invoice_export/{status}', 'admin\CreateInvoicesController@delivery_invoice_export')->name('delivery_invoice_list.export');
Route::get('/invoice_pdf_admin/{id}', 'admin\CreateInvoicesController@invoice_pdf1')->name('invoice_pdf_admin'); // pdf 1
Route::get('/invoice_pdf1_admin/{id}', 'admin\CreateInvoicesController@invoice_pdf2')->name('invoice_pdf1_admin');
Route::get('/invoices_list_admin/{id}', 'admin\CreateInvoicesController@allInvoiceList')->name('invoices_list_admin');
Route::post('/invoices_list_admin/pendingStatus/{id}', 'admin\CreateInvoicesController@pendingStatus')->name('pendingStatus');
Route::post('/invoices_list_admin/deliveryPendingStatus/{id}', 'admin\CreateInvoicesController@deliveryPendingStatus')->name('deliveryPendingStatus');
Route::get('/change_status_logs', 'admin\CreateInvoicesController@change_status_logs')->name('change_status_logs');
Route::get('/change_status_delivery', 'admin\CreateInvoicesController@change_status_delivery')->name('change_status_delivery');
Route::get('/delete_invoicefile/{id}', 'admin\CreateInvoicesController@delete_invoice')->name('delete_invoicefile');
Route::post('/edit_delivery_invoice', 'admin\CreateInvoicesController@edit_delivery_invoice')->name('edit_delivery_invoice');
Route::get('/delete_delivery_invoice/{id}', 'admin\CreateInvoicesController@delete_delivery_invoice')->name('delete_delivery_invoice');
Route::get('/s2s_clear_log_container', 'admin\CreateInvoicesController@s2s_clear_log_container')->name('s2s_clear_log_container');

// PGLC Reports
Route::get('/pglc_reports/all_clear_log_reports_pdf', 'admin\PglcReportsController@all_clear_log_customer_report_pdf')->name('all_clear_log_customer_report_pdf');
Route::get('/pglc_reports/all_clear_log_reports_excel', 'admin\PglcReportsController@all_clear_log_customer_report_excel')->name('all_clear_log_customer_report_excel');
Route::get('/pglc_reports/clear_log_reports', 'admin\PglcReportsController@pglc_clear_log_reports')->name('pglc_clear_log_reports');
Route::get('/pglc_reports/clear_log_reports/{company_id}', 'admin\PglcReportsController@clear_log_customer_report')->name('pglc_clear_log_customer_report');
Route::get('/pglc_reports/clear_log_customer_pdf/{company_id}', 'admin\PglcReportsController@clear_log_customer_report_pdf')->name('pglc_clear_log_customer_report_pdf');
Route::get('/pglc_reports/clear_log_customer_excel/{company_id}', 'admin\PglcReportsController@clear_log_customer_report_excel')->name('pglc_clear_log_customer_report_excel');
// Delivery Report of PGLC
Route::get('/pglc_reports/all_delivery_reports_pdf', 'admin\PglcReportsController@all_delivery_customer_report_pdf')->name('all_delivery_customer_report_pdf');
Route::get('/pglc_reports/all_delivery_reports_excel', 'admin\PglcReportsController@all_delivery_customer_report_excel')->name('all_delivery_customer_report_excel');
Route::get('/pglc_reports/delivery_reports', 'admin\PglcReportsController@pglc_delivery_reports')->name('pglc_delivery_reports');
Route::get('/pglc_reports/delivery_reports/{company_id}', 'admin\PglcReportsController@pglc_delivery_customer_report')->name('pglc_delivery_customer_report');
Route::get('/pglc_reports/delivery_customer_pdf/{company_id}', 'admin\PglcReportsController@pglc_delivery_customer_report_pdf')->name('pglc_delivery_customer_report_pdf');
Route::get('/pglc_reports/delivery_customer_excel/{company_id}', 'admin\PglcReportsController@pglc_delivery_customer_report_excel')->name('pglc_delivery_customer_report_excel');
// Single VCC Report of PGLC
Route::get('/pglc_reports/all_single_vcc_reports_pdf', 'admin\PglcReportsController@all_single_vcc_customer_report_pdf')->name('all_single_vcc_customer_report_pdf');
Route::get('/pglc_reports/all_single_vcc_reports_excel', 'admin\PglcReportsController@all_single_vcc_customer_report_excel')->name('all_single_vcc_customer_report_excel');
Route::get('/pglc_reports/single_vcc_reports', 'admin\PglcReportsController@pglc_single_vcc_reports')->name('pglc_single_vcc_reports');
Route::get('/pglc_reports/single_vcc_reports/{company_id}', 'admin\PglcReportsController@pglc_single_vcc_customer_report')->name('pglc_single_vcc_customer_report');
Route::get('/pglc_reports/single_vcc_customer_pdf/{company_id}', 'admin\PglcReportsController@pglc_single_vcc_customer_report_pdf')->name('pglc_single_vcc_customer_report_pdf');
Route::get('/pglc_reports/single_vcc_customer_excel/{company_id}', 'admin\PglcReportsController@pglc_single_vcc_customer_report_excel')->name('pglc_single_vcc_customer_report_excel');
// Exit Claim Report of PGLC
Route::get('/pglc_reports/all_exit_claim_reports_pdf', 'admin\PglcReportsController@all_exit_claim_customer_report_pdf')->name('all_exit_claim_customer_report_pdf');
Route::get('/pglc_reports/all_exit_claim_reports_excel', 'admin\PglcReportsController@all_exit_claim_customer_report_excel')->name('all_exit_claim_customer_report_excel');
Route::get('/pglc_reports/exit_claim_reports', 'admin\PglcReportsController@pglc_exit_claim_reports')->name('pglc_exit_claim_reports');
Route::get('/pglc_reports/exit_claim_reports/{company_id}', 'admin\PglcReportsController@pglc_exit_claim_customer_report')->name('pglc_exit_claim_customer_report');
Route::get('/pglc_reports/exit_claim_customer_pdf/{company_id}', 'admin\PglcReportsController@pglc_exit_claim_customer_report_pdf')->name('pglc_exit_claim_customer_report_pdf');
Route::get('/pglc_reports/exit_claim_customer_excel/{company_id}', 'admin\PglcReportsController@pglc_exit_claim_customer_report_excel')->name('pglc_exit_claim_customer_report_excel');
// Detention Charges Report of PGLC
Route::get('/pglc_reports/all_detention_reports_pdf', 'admin\PglcReportsController@all_detention_customer_report_pdf')->name('all_detention_customer_report_pdf');
Route::get('/pglc_reports/all_detention_reports_excel', 'admin\PglcReportsController@all_detention_customer_report_excel')->name('all_detention_customer_report_excel');
Route::get('/pglc_reports/detention_reports', 'admin\PglcReportsController@pglc_detention_reports')->name('pglc_detention_reports');
Route::get('/pglc_reports/detention_reports/{company_id}', 'admin\PglcReportsController@pglc_detention_customer_report')->name('pglc_detention_customer_report');
Route::get('/pglc_reports/detention_customer_pdf/{company_id}', 'admin\PglcReportsController@pglc_detention_customer_report_pdf')->name('pglc_detention_customer_report_pdf');
Route::get('/pglc_reports/detention_customer_excel/{company_id}', 'admin\PglcReportsController@pglc_detention_customer_report_excel')->name('pglc_detention_customer_report_excel');

// Finance Department
Route::get('/finance_admin_invoice', 'admin\FinanceInvoiceController@finance_invoice')->name('finance_invoice');

// Get Customer
Route::get('/get_customer_admin', 'admin\CustomerController@get_customer')->name('get_customer_admin');
Route::get('/get_container_admin', 'admin\CustomerController@get_container')->name('get_container_admin');
Route::get('/filter_customer_admin', 'admin\CustomerController@filterCustomer')->name('filter_customer_admin');
Route::post('/save_invoice', 'admin\CreateInvoicesController@save_invoice')->name('save_invoice');
Route::post('/update_log_invoice', 'admin\CreateInvoicesController@update_log_invoice')->name('update_log_invoice');
Route::post('/update_log_delivery', 'admin\CreateInvoicesController@update_log_delivery')->name('update_log_delivery');
Route::get('/edit_log_invoice/{id}', 'admin\CreateInvoicesController@edit_log_invoice')->name('edit_log_invoice');
Route::get('/edit_log_delivery/{id}', 'admin\CreateInvoicesController@edit_log_delivery')->name('edit_log_delivery');

//report center
Route::get('/customer_report', 'admin\ReportsController@customer_report')->name('customer_report');
Route::get('/dind_customer_report', 'admin\ReportsController@dirInd_customer_report')->name('dind_customer_report');
Route::get('/vehicle_report', 'admin\ReportsController@vehicle_report')->name('vehicle_report');
Route::get('/vehicle_graph_report', 'admin\ReportsController@vehicle_graph_report')->name('vehicle_graph_report');
Route::get('/vehicle_delivery_report', 'admin\ReportsController@vehicleDeliveryreport')->name('vehicle_delivery_report');
Route::get('/pgl_dashbord', 'admin\ReportsController@pglDashboard')->name('pgl_dashbord');
Route::get('/VehilcesStatistics', 'admin\ReportsController@VehilcesStatistics')->name('VehilcesStatistics');
Route::get('/vehicleReportExcel', 'admin\ReportsController@vehicleReportExcel')->name('vehicleReportExcel');
Route::get('/shipment_report', 'admin\ReportsController@shipment_report')->name('shipment_report');
Route::get('/invoice_report', 'admin\ReportsController@invoice_report')->name('invoice_report');


//  ==================================================== GPLU | Used Cars ====================================================
// used cars.
Route::get('/pglu_dashbord', 'admin\InventoryController@pgluDashboard')->name('pglu_dashbord');
Route::get('/united_car_list', 'admin\InventoryController@unitedCarsList')->name('united_car_list');
Route::get('/united_cars_search/{purchaser_id}/{carstate_id}/{inventory_status}', 'admin\InventoryController@unitedCarsSearch')->name('united_car_search');
Route::get('/all_united_car_list', 'admin\InventoryController@unitedCarsList')->name('all_united_car_list');
Route::get('/united_cars_by_selling_satatus/{selling_status}', 'admin\InventoryController@unitedCarsBySellingSatatus')->name('united_cars_by_selling_satatus');
Route::get('/filter_united_in_selling_status', 'admin\InventoryController@filterUnitedInSellingaStatus')->name('filter_united_in_selling_status');
Route::get('/add_to_united/{vId}', 'admin\InventoryController@addToUnitedCars')->name('add_to_united');
Route::get('/add_to_inventory_vehicles_info', 'admin\InventoryController@vehiclesInfo')->name('add_to_inventory_vehicles_info');
Route::post('/add_vehicles_to_united_inventory', 'admin\InventoryController@addVehiclesToUnitedCars')->name('add_vehicles_to_united_inventory');
Route::get('/edit_united/{id}', 'admin\InventoryController@editUnited')->name('edit_united');
Route::post('/update_united', 'admin\InventoryController@updateUnited')->name('update_united');
Route::get('/united_car_details/{id}', 'admin\InventoryController@unitedCarDetails')->name('united_car_details');
Route::get('/prepareDataForAddToInventory', 'admin\InventoryController@prepareDataForAddToInventory')->name('prepareDataForAddToInventory');
Route::get('/UsedCarsStatistics', 'admin\InventoryController@UsedCarsStatistics')->name('UsedCarsStatistics');
Route::get('/united_cars_export', 'admin\InventoryController@UnitedCarExport')->name('united_cars_export');
Route::get('/deleteUnitedCar/{id}', 'admin\InventoryController@deleteUnitedCar')->name('deleteUnitedCar');
Route::get('/change_selling_status', 'admin\InventoryController@changeSellingStatus')->name('change_selling_status');
Route::get('/change_status_pass', 'admin\InventoryController@changeStatusPass')->name('change_status_pass');
Route::get('/change_pglu_purchaser', 'admin\InventoryController@changePurchaser')->name('change_pglu_purchaser');

//Unted car invoice based on customer
Route::get('/all_united_car_invoice', 'admin\InventoryController@unitedInvoicesList')->name('all_united_car_invoice');
Route::get('/pgluInvoice_pdf', 'admin\InventoryController@Pgluinvoice_pdf')->name('pgluInvoice_pdf');

// United Customers.
Route::get('/unitedCustomers', 'admin\InventoryController@unitedCustomers')->name('unitedCustomers');
Route::post('/saveCustomer', 'admin\InventoryController@saveCustomer')->name('saveCustomer');
Route::post('/updateCustomer', 'admin\InventoryController@updateCustomer')->name('updateCustomer');
Route::get('/deleteUnitedCustomer/{id}', 'admin\InventoryController@deleteUnitedCustomer')->name('deleteUnitedCustomer');
Route::get('/searchCustomerSelect2', 'admin\InventoryController@searchCustomerSelect2')->name('searchCustomerSelect2');
Route::get('/findCustomer', 'admin\InventoryController@findCustomer')->name('findCustomer');
Route::post('/updateCustomerPhone', 'admin\InventoryController@updateCustomerPhone')->name('updateCustomerPhone');

// inventory.
Route::get('/editYardInventory/{id}', 'admin\InventoryController@editYardInventory')->name('editYardInventory');
Route::get('/deleteYardInventory/{id}', 'admin\InventoryController@deleteYardInventory')->name('deleteYardInventory');
Route::get('/add_to_inventory/{vehicle_id}', 'admin\InventoryController@addToInventoryView')->name('add_to_inventory');
Route::post('/addToInventory', 'admin\InventoryController@addToInventory')->name('addToInventory');
Route::post('/changeInventoryStatus', 'admin\InventoryController@changeInventoryStatus')->name('changeInventoryStatus');
Route::post('/updateYardInventory', 'admin\InventoryController@updateYardInventory')->name('updateYardInventory');
Route::get('/pglu_inventory/{inventory_status}', 'admin\InventoryController@inventories')->name('pglu_inventory');
Route::get('/pglu_inventory_search/{purchaser_id}/{inventory_status}', 'admin\InventoryController@inventoriesSearch')->name('pglu_inventory_search');

// invoice.
Route::get('/inventory_invoice/{vehicle_id}', 'admin\InventoryInvoiceController@inventory_invoice')->name('inventory_invoice');
Route::post('/updateInventoryInvoice', 'admin\InventoryInvoiceController@updateInventoryInvoice')->name('updateInventoryInvoice');
Route::get('/pending_invoices', 'admin\InventoryInvoiceController@pendingInvoices')->name('pending_invoices');
Route::post('/updatePayAmount', 'admin\InventoryInvoiceController@updatePayAmount')->name('updatePayAmount');
Route::post('/sendEmailToAccounting', 'admin\InventoryInvoiceController@sendEmailToAccounting')->name('sendEmailToAccounting');
Route::delete('/deleteInventoryInvoiceInstallment/{id}', 'admin\InventoryInvoiceController@deleteInventoryInvoiceInstallment')->name('deleteInventoryInvoiceInstallment');
Route::post('/updateInventoryInvoiceProperites', 'admin\InventoryInvoiceController@updateInventoryInvoiceProperites')->name('updateInventoryInvoiceProperites');

// customer report.
Route::get('/pglu_customer_report', 'admin\InventoryController@pgluCustomerReport')->name('pglu_customer_report');
Route::get('/pglu_customer_report_details/{customer_id}', 'admin\InventoryController@pgluCustomerReportDetails')->name('pglu_customer_report_details');
Route::get('/customer_report_view/{customer_id}', 'admin\InventoryController@customerReportView')->name('customer_report_view');
Route::get('/customer_report_pdf/{customer_id}', 'admin\InventoryController@customerReportPdf')->name('customer_report_pdf');
Route::get('/pglu_all_customer_report', 'admin\InventoryController@pgluAllCustomerReport')->name('pglu_all_customer_report');

// used cars companies.
Route::get('/pgl_used_cars_company', 'admin\UsedCarsCompanyController@usedCarCompanies')->name('pgl_used_cars_company');
Route::post('/saveCompany', 'admin\UsedCarsCompanyController@saveCompany')->name('saveCompany');
Route::delete('/deleteUsedCarCompany/{id}', 'admin\UsedCarsCompanyController@deleteUsedCarCompany')->name('deleteUsedCarCompany');
Route::get('/searchCompany', 'admin\UsedCarsCompanyController@searchCompany')->name('searchCompany');

// pgl used cars purchaser.
Route::get('/usedCarPurchaser', 'admin\PglUsedCarPurchaserController@usedCarPurchaser')->name('usedCarPurchaser');
Route::post('/usedCarPurchaserSave', 'admin\PglUsedCarPurchaserController@usedCarPurchaserSave')->name('usedCarPurchaserSave');
Route::post('/usedCarPurchaserUpdate', 'admin\PglUsedCarPurchaserController@usedCarPurchaserUpdate')->name('usedCarPurchaserUpdate');
Route::delete('/usedCarPurchaserDelete/{id}', 'admin\PglUsedCarPurchaserController@usedCarPurchaserDelete')->name('usedCarPurchaserDelete');
Route::get('/searchPurchaserSelect2', 'admin\PglUsedCarPurchaserController@searchPurchaserSelect2')->name('searchPurchaserSelect2');

// pgl yard.
Route::get('/pucYard', 'admin\PGLUsedCarsYardController@pucYard')->name('pucYard');
Route::post('/pucYardSave', 'admin\PGLUsedCarsYardController@pucYardSave')->name('pucYardSave');
Route::post('/pucYardUpdate', 'admin\PGLUsedCarsYardController@pucYardUpdate')->name('pucYardUpdate');
Route::delete('/pucYardDelete/{id}', 'admin\PGLUsedCarsYardController@pucYardDelete')->name('pucYardDelete');
Route::get('/searchPucYardSelect2', 'admin\PGLUsedCarsYardController@searchPucYardSelect2')->name('searchPucYardSelect2');




//  ==================================================== GPLA | Accounting ====================================================
Route::get('/accounting_dashboard', 'admin\accounting\AccountController@dashboard')->name('accounting_dashboard');
Route::get('/get_bank_transaction', 'admin\accounting\AccountController@getBankTransaction')->name('get_bank_transaction'); // get only bank transaction based on id
Route::get('/view_accounts_trans', 'admin\accounting\AccountController@viewMyProfiles')->name('view_accounts_trans');
// transaction.
Route::get('/create_transaction', 'admin\accounting\TransactionController@createTransaction')->name('create_transaction');
Route::post('/saveTransaction', 'admin\accounting\TransactionController@saveTransaction')->name('saveTransaction');
Route::get('/transaction_list', 'admin\accounting\TransactionController@transactionList')->name('transaction_list');
Route::get('/delete_transaction', 'admin\accounting\TransactionController@deleteTransaction')->name('delete_transaction');
Route::get('/edit_transaction/{id}', 'admin\accounting\TransactionController@editTransaction')->name('edit_transaction');
Route::post('/update_transaction', 'admin\accounting\TransactionController@updateTransaction')->name('update_transaction');
Route::get('/change_transaction_status', 'admin\accounting\TransactionController@changeTransacitonStatus')->name('change_transaction_status');
Route::get('/transaction_password', 'admin\accounting\TransactionController@transactionPassword')->name('transaction_password');
Route::get('/s2s_customer_and_united_customer', 'admin\accounting\TransactionController@searchCustomerSelect2')->name('s2s_customer_and_united_customer');
Route::get('/s2s_containers', 'admin\accounting\TransactionController@searchContainerSelect2')->name('s2s_containers');
Route::get('/s2s_vehicles', 'admin\accounting\TransactionController@searchVehicleSelect2')->name('s2s_vehicles');
Route::get('/view_transaction/{id}', 'admin\accounting\TransactionController@viewTransaction')->name('view_transaction');
Route::get('/email_transaction', 'admin\accounting\TransactionController@sendTransactionEmail')->name('email_transaction');

// transfer.
Route::get('/create_transfer', 'admin\accounting\TransferController@createTransfer')->name('create_transfer');
Route::post('/save_transfer', 'admin\accounting\TransferController@saveTransfer')->name('save_transfer');
Route::get('/transfer_list', 'admin\accounting\TransferController@transferList')->name('transfer_list');
Route::get('/edit_transfer/{id}', 'admin\accounting\TransferController@editTransfer')->name('edit_transfer');
Route::get('/delete_transfer', 'admin\accounting\TransferController@deleteTransfer')->name('delete_transfer');
Route::post('/update_transfer', 'admin\accounting\TransferController@updateTranfer')->name('update_transfer');
Route::get('/change_transfer_status', 'admin\accounting\TransferController@changeTransferStatus')->name('change_transfer_status');
Route::get('/transfer_password', 'admin\accounting\TransferController@transferPassword')->name('transfer_password');

// account.
Route::get('/create_account', 'admin\accounting\AccountController@createAccount')->name('create_account');
Route::post('/save_account', 'admin\accounting\AccountController@saveAccount')->name('save_account');
Route::get('/s2s_for_account', 'admin\accounting\AccountController@s2sForAccount')->name('s2s_for_account');
Route::get('/account_list', 'admin\accounting\AccountController@accountList')->name('account_list');
Route::get('/edit_account/{id}', 'admin\accounting\AccountController@accountEdit')->name('edit_account');
Route::post('/update_account/{id}', 'admin\accounting\AccountController@accountUpdate')->name('update_account');
Route::get('/delete_account', 'admin\accounting\AccountController@accountDelete')->name('delete_account');
Route::get('/change_enable_account', 'admin\accounting\AccountController@changeEnable')->name('change_enable_account');

// category
Route::get('/s2s_category', 'admin\accounting\CategoryController@s2sForCategory')->name('s2s_category');
Route::get('/create_category', 'admin\accounting\CategoryController@createCategory')->name('create_category');
Route::post('/save_category', 'admin\accounting\CategoryController@saveCategory')->name('save_category');
Route::get('/category_list', 'admin\accounting\CategoryController@categoryList')->name('category_list');
Route::get('/edit_category/{id}', 'admin\accounting\CategoryController@categoryEdit')->name('edit_category');
Route::post('/update_category/{id}', 'admin\accounting\CategoryController@categoryUpdate')->name('update_category');
Route::get('/delete_category', 'admin\accounting\CategoryController@categoryDelete')->name('delete_category');
Route::get('/change_enable_category', 'admin\accounting\CategoryController@changeEnable')->name('change_enable_category');

// Expenses
Route::get('/banking_expences/{status}', 'admin\accounting\TransactionController@expences')->name('banking_expences');
Route::get('/banking_settings', 'admin\accounting\AccountController@settings')->name('banking_settings');

// Report
Route::get('/accounting_report', 'admin\accounting\ReportController@index')->name('accounting_report');
Route::get('/accounting_report_excel', 'admin\accounting\ReportController@reportExcel')->name('accounting_report_excel');
Route::get('/accounting_statements', 'admin\accounting\ReportController@report_statement')->name('accounting_statements');
Route::get('/accounting_statements_pdf', 'admin\accounting\ReportController@report_statement_pdf')->name('accounting_statements_pdf');

//PDF for sale agreement in PGLU
Route::get('/viewSaleAgreement/{id}', 'admin\accounting\AccountController@viewSaleAgreement')->name('viewSaleAgreement');
Route::get('/downloadSaleAgreement/{id}', 'admin\accounting\AccountController@downloadSaleAgreements')->name('downloadSaleAgreement');
Route::get('/applyVcc/{id}', 'admin\accounting\AccountController@applyForVcc')->name('applyVcc');
Route::get('/downloadGatepass/{id}', 'admin\accounting\AccountController@DownGatepass')->name('downloadGatepass'); //only from email inbox clicked
Route::post('/update_chases_number', 'admin\accounting\AccountController@update_chases_number')->name('update_chases_number');
Route::get('/get_saleAgreement_pdf/{id}', 'admin\accounting\AccountController@saleAgreement_pdf')->name('get_saleAgreement_pdf'); // pdf Sale
// PGLC Report in excel

Route::get('/pgla_reports_excel', 'admin\accounting\ReportController@pglaReportsExport')->name('pgla_reports_excel');
Route::get('/pgla_trans_reports_excel', 'admin\accounting\ReportController@pglaExpReportsExport')->name('pgla_trans_reports_excel');


// Shipment Test
Route::get('/shipment_test_admin/{id}/{location}', 'admin\ShipmentController@shipmentTest')->name('shipment_test_admin');
Route::get('/add_test_shipment', 'admin\ShipmentController@addTestShipment')->name('add_test_shipment');
Route::post('/add_newtest_shipment', 'admin\ShipmentController@addTest_shipment')->name('add_newtest_shipment');
Route::get('/edit_test_shipment/{id}/{status}', 'admin\ShipmentController@edit_test_shipment')->name('edit_test_shipment');
Route::post('/update_test_shipment', 'admin\ShipmentController@update_test_shipment')->name('update_test_shipment');
Route::get('/s2s_all_bookings', 'admin\ShipmentController@s2s_all_booking')->name('s2s_all_bookings');

//----------------------------------------------------WhatSapp API Set up ---------------------------------//

Route::get('/test', 'admin\whatsapp\WebhookCallbackController@test')->name('test');
Route::get('/webhook', 'admin\whatsapp\WebhookCallbackController@webhook')->name('webhook');
Route::POST('/webhook', 'admin\whatsapp\WebhookCallbackController@webhookpost')->name('webhookpost');
Route::get('/cus-whatsapp-messages/{status}', 'admin\whatsapp\WhatsAppController@whatsappMessages')->name('cus-whatsapp-messages');
Route::get('/messages', 'admin\whatsapp\WhatsAppController@messages')->name('messages');
Route::get('/chat/{business_id}', 'admin\whatsapp\WhatsAppController@chat')->name('chat');
Route::post('/send_message', 'admin\whatsapp\WhatsAppController@sendMessage')->name('send_message');
