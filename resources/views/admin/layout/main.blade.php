<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo-25.png') }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/animate.css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jscrollpane/jquery.jscrollpane.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/waves/waves.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/switchery/dist/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/morris/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/toastr/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables-1.10.12/datatables.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom-style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Roboto+Condensed:wght@300;400;700&display=swap">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <!-- Neptune CSS -->

    <style>
        .search_reload:hover {
            cursor: pointer;
            font-weight: bold;
        }

        .search-listing {
            overflow-x: scroll;
        }

        .containerr {
            position: absolute;
            overflow: none;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
            margin-top: 60px;
            margin-right: 230px;
            margin-left: 220px;
        }

        /* Then style the iframe to fit in the container div with full height and width */
        .responsive-iframe {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            width: 90%;
            height: 100%;
        }

        .form-group>.select2-container {
            width: 100% !important;
        }

        .select2-selection.select2-selection--single {
            overflow: hidden;
            border-radius: unset;
            height: 32px;
            padding-top: 1px;
            padding-bottom: 1px;
            border: 1px solid rgba(0, 0, 0, .15);
            width: 100%;
        }
    </style>
    @yield('style')
</head>

<body class="fixed-sidebar fixed-header skin-default content-appear">
    <div class="wrapper">
        <div class="preloader"></div>
        @include('admin.layout.sidebar')
        @include('admin.layout.header')
        @yield('content')
    </div>
    <script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-plugin/tableHTMLExport.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/tether/js/tether.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/detectmobilebrowser/detectmobilebrowser.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.mousewheel.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jscrollpane/mwheelIntent.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jscrollpane/jquery.jscrollpane.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-fullscreen-plugin/jquery.fullscreen-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/waves/waves.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/switchery/dist/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/TinyColor/tinycolor.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/raphael/raphael.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/morris/morris.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/peity/jquery.peity.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/DataTables-1.10.12/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/sweetalert2v11/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
   
    <script type="text/javascript" src="{{asset('assets/notify/notify.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>

    @yield('js')




    {{-- <script type="text/javascript">
        var request = $.ajax({
            url: "{{route('admin_sidebar_count')}}",
            method: "GET",
            dataType: 'json'
        });

        $(document).ready(function() {
            // Get location and store in global variables of js
            window.locations = <?php echo json_encode($locations = \App\Models\Location::all()) ?>;
            window.vehicle_section = false;
            window.vehicle_inventory_section = false;
            window.vehicle_halfcut_section = false;
            window.shipment_section = false;
            window.shipment_atloading_section = false;
            window.shipment_checked_section = false;
            window.shipment_advanced_booking_section = false;
            window.advanced_booking_summary_section = false;
            window.shipment_clearance_section = false;
            window.invoice_section = false;
            window.mix_shipping_section = false;
            window.mix_shipping_invoice_section = false;
            window.expenses_section = false;
            window.clearance_section = false;
            window.used_cars_section = false;
            window.inventory_section = false;
            if ($('.vehicle_section .active').html() != undefined && !vehicle_section) {
                vehicle_section = true;
                get_admin_sidebar_sub_count('Vehicle');
                if ($('.vehicle_inventory_section .active').html() != undefined && !vehicle_inventory_section) {
                    vehicle_inventory_section = true;
                    get_admin_sidebar_sub_count('VehicleInventory');
                } else if ($('.vehicle_halfcut_section .active').html() != undefined && !vehicle_halfcut_section) {
                    vehicle_halfcut_section = true;
                    get_admin_sidebar_sub_count('VehicleHalfcut');
                }
            } else if ($('.shipment_section .active').html() != undefined && !shipment_section) {
                shipment_section = true;
                get_admin_sidebar_sub_count('Shipment');

                // start sub content of shipment section
                if ($('.shipment_atloading_section .active').html() != undefined && !shipment_atloading_section) {
                    shipment_atloading_section = true;
                    get_admin_sidebar_sub_count('ShipmentAtLoading');
                } else if ($('.shipment_checked_section .active').html() != undefined && !shipment_checked_section) {
                    shipment_checked_section = true;
                    get_admin_sidebar_sub_count('ShipmentChecked');
                } else if ($('.shipment_advanced_booking_section .active').html() != undefined && !shipment_advanced_booking_section) {
                    shipment_advanced_booking_section = true;
                    get_admin_sidebar_sub_count('ShipmentAdvancedBooking');
                    if ($('.advanced_booking_summary_section .active').html() != undefined && !advanced_booking_summary_section) {
                        advanced_booking_summary_section = true;
                        get_admin_sidebar_sub_count('AdvancedBookingSummary');
                    }
                } else if ($('.shipment_clearance_section .active').html() != undefined && !shipment_clearance_section) {
                    shipment_clearance_section = true;
                    get_admin_sidebar_sub_count('ShipmentClearance');
                }
                // end sub content of shipment section
            } else if ($('.invoice_section .active').html() != undefined && !invoice_section) {
                invoice_section = true;
                get_admin_sidebar_sub_count('Invoice');
            } else if ($('.mix_shipping_section .active').html() != undefined && !mix_shipping_section) {
                mix_shipping_section = true;
                get_admin_sidebar_sub_count('MixShipping');
                if ($('.mix_shipping_invoice_section .active').html() != undefined && !mix_shipping_invoice_section) {
                    mix_shipping_invoice_section = true;
                    get_admin_sidebar_sub_count('MixShippingInvoice');
                }
            } else if ($('.expenses_section .active').html() != undefined && !expenses_section) {
                expenses_section = true;
                get_admin_sidebar_sub_count('Expenses');
            } else if ($('.clearance_section .active').html() != undefined && !clearance_section) {
                clearance_section = true;
                get_admin_sidebar_sub_count('Clearance');
            } else if ($('.used_cars_section .active').html() != undefined && !used_cars_section) {
                used_cars_section = true;
                get_admin_sidebar_sub_count('UsedCars');
            } else if ($('.inventory_section .active').html() != undefined && !inventory_section) {
                inventory_section = true;
                get_admin_sidebar_sub_count('Inventory');
            }

        });

        request.done(function(msg) {
            $('.t_all_vehicle').text(msg.t_all_vehicle);
            $('.t_all_shipment').text(msg.t_all_shipment);
            $('.t_all_invoice').text(msg.t_all_invoice);
            $('.t_all_transaction').text(msg.t_all_transaction);
            $('.t_all_transfer').text(msg.t_all_transfer);
            // Clearance
            $('.t_all_clearance_shipment').text(msg.t_all_clearance_shipment);
            //pglc software
            $('.t_all_clear_invoice').text(msg.t_all_clear_invoice);
            $('.t_all_log_invoices').text(msg.t_all_log_invoices);
            //delivery order invoices
            $('.t_all_delivery_invoices').text(msg.t_all_delivery_invoices);
            // used cars
            $('.t_all_usedcars').text(msg.t_all_usedcars);
            $('.t_all_pglu_inventory').text(msg.t_all_pglu_inventory);
        });


        function get_admin_sidebar_sub_count(type = 'Vehicle') {
            var vehicle_sub_count = $.ajax({
                url: "{{route('admin_sidebar_sub_count')}}",
                method: "GET",
                dataType: 'json',
                data: {
                    type: type
                }
            });
            vehicle_sub_count.done(function(msg) {
                if (type == 'Vehicle') {
                    window.vehicle_section = true;
                    $('.t_on_the_way').text(msg.t_on_the_way);
                    $('.t_on_hand_no_title').text(msg.t_on_hand_no_title);
                    $('.t_on_inventory').text(msg.t_on_inventory);
                    $('.t_on_hand_with_title').text(msg.t_on_hand_with_title);
                    $('.t_shipped').text(msg.t_shipped);
                    $('.t_pending').text(msg.t_pending);
                    $('.t_halfcut').text(msg.t_halfcut);
                    $('.t_shipped_at_loading').text(msg.t_shipped_at_loading);

                } else if (type == 'VehicleInventory') {
                    window.vehicle_inventory_section = true;
                    locations.forEach(item => {
                        $('.t_on_inventory_' + item.id).text(msg['t_on_inventory_' + item.id]);
                    });
                } else if (type == 'VehicleHalfcut') {
                    window.vehicle_halfcut_section = true;
                    locations.forEach(item => {
                        $('.t_halfcut_' + item.id).text(msg['t_halfcut_' + item.id]);
                    });
                } else if (type == 'Shipment') {
                    window.shipment_section = true;
                    $('.t_pending_shipment').text(msg.t_pending_shipment);
                    $('.t_loading_shipment').text(msg.t_loading_shipment);
                    $('.t_at_the_dock_shipment').text(msg.t_at_the_dock_shipment);
                    $('.t_checked_shipment').text(msg.t_checked_shipment);
                    $('.t_final_checked_shipment').text(msg.t_final_checked_shipment);
                    $('.t_submit_si_shipment').text(msg.t_submit_si_shipment);
                    $('.t_on_the_way_shipment').text(msg.t_on_the_way_shipment);
                    $('.t_arrived_shipment').text(msg.t_arrived_shipment);
                    $('.t_title_archive_shipment').text(msg.t_title_archive_shipment);
                    $('.t_pending_title_archive_shipment').text(msg.t_pending_title_archive_shipment);
                    $('.t_clearance_shipment').text(msg.t_clearance_shipment);
                    $('.t_advanced_booking').text(msg.t_advanced_booking);
                } else if (type == 'ShipmentAtLoading') {
                    window.shipment_atloading_section = true;
                    locations.forEach(item => {
                        $('.t_loading_shipment_' + item.id).text(msg['t_loading_shipment_' + item.id]);
                    });
                } else if (type == 'ShipmentChecked') {
                    window.shipment_checked_section = true;
                    locations.forEach(item => {
                        $('.t_checked_shipment_' + item.id).text(msg['t_checked_shipment_' + item.id]);
                    });
                } else if (type == 'ShipmentAdvancedBooking') {
                    window.shipment_advanced_booking_section = true;
                    $('.t_vessels').text(msg['t_vessels']);
                    locations.forEach(item => {
                        $('.t_advanced_booking_' + item.id).text(msg['t_advanced_booking_' + item.id]);
                    });
                } else if (type == 'AdvancedBookingSummary') {
                    window.advanced_booking_summary_section = true;
                    $('.t_booking_summary_all').text(msg['t_booking_summary_all']);
                    locations.forEach(item => {
                        $('.t_booking_summary_' + item.id).text(msg['t_booking_summary_' + item.id]);
                    });
                } else if (type == 'ShipmentClearance') {
                    window.shipment_clearance_section = true;
                    locations.forEach(item => {
                        $('.t_shipment_clearance_' + item.id).text(msg['t_shipment_clearance_' + item.id]);
                    });
                } else if (type == 'Invoice') {
                    window.invoice_section = true;
                    $('.t_pending_invoice').text(msg.t_pending_invoice);
                    $('.t_open_invoice').text(msg.t_open_invoice);
                    $('.t_past_due_invoice').text(msg.t_past_due_invoice);
                    $('.t_paid_invoice').text(msg.t_paid_invoice);
                } else if (type == 'MixShippingInvoice') {
                    window.mix_shipping_invoice_section = true;
                    $('.t_mix_pending_invoice').text(msg.t_mix_pending_invoice);
                    $('.t_mix_open_invoice').text(msg.t_mix_open_invoice);
                    $('.t_mix_past_due_invoice').text(msg.t_mix_past_due_invoice);
                    $('.t_mix_paid_invoice').text(msg.t_mix_paid_invoice);
                } else if (type == 'MixShipping') {
                    window.mix_shipping_section = true;
                    $('.t_mix_container').text(msg.t_mix_container);
                    $('.t_mix_all_invoice').text(msg.t_mix_all_invoice);
                } else if (type == 'Expenses') {
                    window.expenses_section = true;
                    $('.t_pending_transaction').text(msg.t_pending_transaction);
                    $('.t_pending_transfer').text(msg.t_pending_transfer);
                    $('.t_reviewed_transaction').text(msg.t_reviewed_transaction);
                    $('.t_reviewed_transfer').text(msg.t_reviewed_transfer);
                    $('.t_cancelled_transaction').text(msg.t_cancelled_transaction);
                    $('.t_cancelled_transfer').text(msg.t_cancelled_transfer);
                } else if (type == 'Clearance') {
                    window.clearance_section = true;
                    $('.t_delivery_pending_invoice').text(msg.t_delivery_pending_invoice);
                    $('.t_pending_invoice').text(msg.t_pending_invoice);
                    $('.t_delivery_open_invoice').text(msg.t_delivery_open_invoice);
                    $('.t_open_invoice').text(msg.t_open_invoice);
                    $('.t_delivery_past_due_invoice').text(msg.t_delivery_past_due_invoice);
                    $('.t_past_due_invoice').text(msg.t_past_due_invoice);
                    $('.t_delivery_paid_invoice').text(msg.t_delivery_paid_invoice);
                    $('.t_paid_invoice').text(msg.t_paid_invoice);
                } else if (type == 'UsedCars') {
                    window.used_cars_section = true;
                    $('.t_pending_united_cars').text(msg.t_pending_united_cars);
                    $('.t_yet_to_sell_united_cars').text(msg.t_yet_to_sell_united_cars);
                    $('.t_no_advance_united_cars').text(msg.t_no_advance_united_cars);
                    $('.t_advance_paid_united_cars').text(msg.t_advance_paid_united_cars);
                    $('.t_completed_united_cars').text(msg.t_completed_united_cars);
                } else if (type == 'Inventory') {
                    window.inventory_section = true;
                    $('.t_inventory').text(msg.t_inventory);
                    $('.t_repairing').text(msg.t_repairing);
                    $('.t_archived_inventories').text(msg.t_archived_inventories);
                }
            });

            vehicle_sub_count.fail(function(jqXHR, textStatus) {
                alert('fail to load the vehicle summary total.');
                console.log(msg, jqXHR);
            });
        }



        request.done(function(msg) {
            $('.t_all_vehicle').text(msg.allvehicle);
            $('.t_on_the_way').text(msg.onthewayvehicle);
            $('.t_on_hand_no').text(msg.onhandnotitlevehicle);
            $('.t_on_inventory').text(msg.oninventoryvehicle);
            $('.t_on_inventory-1').text(msg.oninventoryvehicle1);
            $('.t_on_inventory-2').text(msg.oninventoryvehicle2);
            $('.t_on_inventory-4').text(msg.oninventoryvehicle3);
            $('.t_on_inventory-5').text(msg.oninventoryvehicle4);
            $('.t_on_hand_with').text(msg.onhandwithtitlevehicle);
            $('.t_shipped').text(msg.shippedvehicle);
            $('.t_shipped_atloading').text(msg.shippedAtloadingvehicle);
            $('.t_pending').text(msg.pendingvehicle);

            $('.t_all_ship').text(msg.allshipment);
            $('.t_pending_ship').text(msg.pendingshipment);
            $('.t_loading_ship').text(msg.loadingshipment);
            $('.t_at_the_dock_ship').text(msg.atTheDockShipment);
            $('.t_checked_ship').text(msg.checkedshipment);
            $('.t_finalchecked_ship').text(msg.finalcheckedshipment);
            $('.t_submitsi_ship').text(msg.submitsishipment);
            $('.t_on_the_way_ship').text(msg.onthewayshipment);
            $('.t_arrived_ship').text(msg.arrivedshipment);

            // halfcut

            $('.t_clearance_ship').text(msg.clearanceshipment);
            $('.t_clearance_ship-1').text(msg.clearanceshipment1);
            $('.t_clearance_ship-2').text(msg.clearanceshipment2);
            $('.t_clearance_ship-4').text(msg.clearanceshipment4);
            $('.t_clearance_ship-5').text(msg.clearanceshipment5);

            // Booking

            $('.t_advanced_booking').text(msg.advanced_booking);
            $('.t_advanced_booking-1').text(msg.advanced_booking1);
            $('.t_advanced_booking-2').text(msg.advanced_booking2);
            $('.t_advanced_booking-4').text(msg.advanced_booking3);
            $('.t_advanced_booking-5').text(msg.advanced_booking4);

            // Vessels

            $('.t_vessels').text(msg.vessels);
            $('.booking-all').text(msg.all_booking_summ);
            $('.booking-1').text(msg.all_booking_summ1);
            $('.booking-2').text(msg.all_booking_summ2);
            $('.booking-4').text(msg.all_booking_summ4);
            $('.booking-5').text(msg.all_booking_summ5);

            //Halfcut coutn

            $('.t_halfcut').text(msg.halfcutVehicles);
            $('.t_halfcut-1').text(msg.halfcutVehicles1);
            $('.t_halfcut-2').text(msg.halfcutVehicles2);
            $('.t_halfcut-4').text(msg.halfcutVehicles4);
            $('.t_halfcut-5').text(msg.halfcutVehicles55);

            $('.t_all_inv').text(msg.allinvoice);
            $('.t_open_inv').text(msg.openinvoice);
            $('.t_past_due_inv').text(msg.pastdueinvoice);
            $('.t_paid_inv').text(msg.paidinvoice);
            $('.t_pending_inv').text(msg.pendinginvoice);

            //pglc software
            $('.clearinvoice').text(msg.clearinvoice);

            $('.allinvoices').text(msg.allinvoices);
            $('.pendinginvoices').text(msg.pendinginvoices);
            $('.openinvoices').text(msg.openinvoices);
            $('.pastdueinvoices').text(msg.pastdueinvoices);
            $('.paidinvoices').text(msg.paidinvoices);
            //delivery order invoices
            $('.deliveryallinvoices').text(msg.deliveryallinvoices);
            $('.deliverypendinginvoices').text(msg.deliverypendinginvoices);
            $('.deliveryopeninvoices').text(msg.deliveryopeninvoices);
            $('.deliverypastdueinvoices').text(msg.deliverypastdueinvoices);
            $('.deliverypaidinvoices').text(msg.deliverypaidinvoices);
        });
        request.fail(function(jqXHR, textStatus) {
            alert('fail to load the total');
        });
        // get messages
        $('.message_admin').click(function() {
            $('.meessage_admin_detail').html("<div style='text-align:center'><img width='40px' src='img/loading.gif' alt='Loading ...'> </div>");
            var request = $.ajax({
                url: "{{route('message_admin')}}",
                method: "GET",
                dataType: 'json'
            });
            request.done(function(msg) {
                $('.meessage_admin_detail').html(msg);
            });
            request.fail(function(jqXHR, textStatus) {
                $('.meessage_admin_detail').html('');
                alert(textStatus);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example th').each(function(col) {

                $(this).click(function() {
                    if ($(this).is('.asc')) {
                        $(this).removeClass('asc');
                        $(this).addClass('desc selected');
                        sortOrder = -1;
                    } else {
                        $(this).addClass('asc selected');
                        $(this).removeClass('desc');
                        sortOrder = 1;
                    }
                    $(this).siblings().removeClass('asc selected');
                    $(this).siblings().removeClass('desc selected');
                    var arrData = $('table').find('tbody >tr:has(td)').get();
                    arrData.sort(function(a, b) {
                        var val1 = $(a).children('td').eq(col).text().toUpperCase();
                        var val2 = $(b).children('td').eq(col).text().toUpperCase();
                        if ($.isNumeric(val1) && $.isNumeric(val2))
                            return sortOrder == 1 ? val1 - val2 : val2 - val1;
                        else
                            return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                    });
                    $.each(arrData, function(index, row) {
                        $('tbody').append(row);
                    });
                });
            });
            $('.excel').click(function() {
                $("#example").tableHTMLExport({
                    type: 'csv',
                    filename: 'sample.csv',
                    separator: ',',
                    newline: '\r\n',
                    trimContent: true,
                    quoteFields: true,
                    ignoreColumns: '.column',
                    ignoreRows: '.bottom',
                    htmlContent: false,
                    consoleLog: false,
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    <script>
        function onlyDotsAndNumbers(txt, event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode == 46) {
                if (txt.value.indexOf(".") < 0)
                    return true;
                else
                    return false;
            }
            if (txt.value.indexOf(".") > 0) {
                var txtlen = txt.value.length;
                var dotpos = txt.value.indexOf(".");
                //Change the number here to allow more decimal points than 2
                if ((txtlen - dotpos) > 2)
                    return false;
            }
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        $(document).ready(function() {
            //   $('.select2search').select2();
            $('.select2search').select2({
                width: 'element',
                // tags: true,
            });
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            changeSelect()
        })

        // Select2
        function changeSelect() {
            $("select.select2search").select2({
                // tags: true
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#searchData').keyup(function() {
                let searchData = $('#searchData').val();
                $.ajax({
                    type: 'get',
                    url: "{{route('search_clears_log')}}",
                    data: {
                        searchData: searchData
                    },
                    success: function(data) {
                        $('#user_data').empty().html(data);
                    }
                });
            })
            $("#clear_status").change(function() {
                let selectstatus = $('#clear_status').val();
                let searchData = $('#searchData').val();
                $.ajax({
                    type: 'get',
                    url: "{{route('search_clears_log')}}",
                    data: {
                        searchData: searchData,
                        selectstatus: selectstatus
                    },
                    success: function(data) {
                        $('#user_data').empty().html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function addNewPurchaser() {
            if ("{{Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-used-car-purchaser'])}}") {
                window.location.href = "{{route('usedCarPurchaser')}}";
            } else {
                alert("You are not allowed to add new purchaser!");
            }
        }

        function addNewCustomer() {
            if ("{{Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-used-cars-customers'])}}") {
                window.location.href = "{{route('unitedCustomers')}}";
            } else {
                alert("You are not allowed to add new customer!");
            }
        }

        function addNewYard() {
            if ("{{Auth::guard('admin')->user()->hasPermissions(['Admin', 'add-used-car-yard'])}}") {
                window.location.href = "{{route('pucYard')}}";
            } else {
                alert("You are not allowed to add new yard!");
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#filterByClearance").on('change', function() {
                let filterBy = $(this).val();
                filterClearLog(filterBy);
            });

            function filterClearLog(filterBy) {
                $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '" + "{{asset('img/loading.gif')}}" + "' alt='Loading ...'> </div> ");
                var request = $.ajax({
                    url: "{{route('filter_clear_log')}}",
                    method: "GET",
                    data: {
                        filterBy: filterBy
                    },
                });
                request.done(function(msg) {
                    $('#user_data').html(msg);
                });
                request.fail(function(jqXHR, textStatus) {
                    $('#user_data').append(textStatus);
                });
            }
        });
    </script>


    <script type="text/javascript">
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>

    <script type="text/javascript">
        function getVehicleSummaryCounts(e) {
            e.preventDefault();
            vehicleSummaryCounter();
        }

        function DisableLink(e) {
            e.preventDefault();
        }

        function vehicleSummaryCounter() {
            var pgla_request = $.ajax({
                url: "{{route('vehicleSummaryCounter')}}",
                method: "GET",
                dataType: 'json'
            });
            pgla_request.done(function(msg) {
                for (let i = 0; i <= Object.values(msg.data).length; i++) {
                    $('#vl-all').text(msg.all);
                    $('#vl-' + Object.keys(msg.data)[parseInt(i)]).text(Object.values(msg.data)[i]);
                }
            });
            pgla_request.fail(function(jqXHR, textStatus) {
                alert('fail to load the vehicle summary total.');
                console.log(msg, jqXHR);
            });
        }
    </script>
    <!-- this script is very danger don't touch. -->
    @include('admin.layout.select2-search') --}}


</body>

</html>