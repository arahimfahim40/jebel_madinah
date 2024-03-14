<script type="text/javascript">
    $(document).ready(function() {
        $(".s2s_user").select2({
            ajax: {
                url: "{{ route('s2s_user') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });

        $(".s2s_timezone").select2({
            ajax: {
                url: "{{ route('s2s_timezone') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });

        $(".s2s_vehicles").select2({
            placeholder: "Search by Vin or Lot Number",
            ajax: {
                url: "{{ route('s2s_vehicles') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true,
            },
        });

        // Vehicle select2 for checks
        $(".s2s_vehicles_check").select2({
            placeholder: "Search by Vin or Lot Number",
            ajax: {
                url: "{{ route('s2s_vehicles_check') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true,
            },
        });



        $(".s2s_category").select2({
            // allowClear: true,
            ajax: {
                url: "{{ route('s2s_category') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });
        $(".s2s_parent_category").select2({
            // allowClear: true,
            ajax: {
                url: "{{ route('s2s_category') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        type: 'parent'
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });
        $(".s2s_sub_category").select2({
            // allowClear: true,
            ajax: {
                url: "{{ route('s2s_category') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        parent_id: $('.s2s_parent_category').val()
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });

        $(".s2s_for_account").select2({
            ajax: {
                url: "{{ route('s2s_for_account') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        source_account_id: $('#source_account_id').val(),
                        destination_account_id: $('#destination_account_id').val(),
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                error: function(jqXHR, status, error) {
                    console.log(error + ": " + jqXHR.responseText);
                    return {
                        results: []
                    }; // Return dataset to load after error
                },
                cache: true,
                tags: true,
            }
        });

        $(".searchContainerNoSelect2InDC").select2({
            ajax: {
                url: "{{ route('searchContainerNoSelect2InDC') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                // error: function (jqXHR, status, error) {
                //     console.log(error + ": " + jqXHR.responseText);
                //     return { results: [] }; // Return dataset to load after error
                // },
                cache: true,
                tags: true,
            }
        });

        $(".searchContainerNoSelect2InEcc").select2({
            ajax: {
                url: "{{ route('searchContainerNoSelect2InEcc') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".s2s_all_containers").select2({
            placeholder: 'Search by Container Number',
            ajax: {
                url: "{{ route('s2s_all_containers') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".s2mix_containers").select2({
            placeholder: 'Search by Container Number',
            ajax: {
                url: "{{ route('s2s_mix_containers') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".searchContainerNumnerSelect2").select2({
            ajax: {
                url: "{{ route('searchContainerNoSelect2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".search_vehicle_select2").select2({
            ajax: {
                url: "{{ route('search_vehicle_select2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".search_comapny_select2").select2({
            ajax: {
                url: "{{ route('searchCompany') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $(".search_purchaser_select2").select2({
            ajax: {
                url: "{{ route('searchPurchaserSelect2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return 'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewPurchaser()"><i class="fa fa-plus"></i></a>';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        $(".search_customer_select2").select2({
            ajax: {
                url: "{{ route('searchCustomerSelect2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return 'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewCustomer()"><i class="fa fa-plus"></i></a>';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        $(".search_yard_select2").select2({
            ajax: {
                url: "{{ route('searchPucYardSelect2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return 'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewYard()"><i class="fa fa-plus"></i></a>';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        // Checks select2
        $(".search_check_select2").select2({
            ajax: {
                url: "{{ route('searchCheckSelect2') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return 'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewYard()"><i class="fa fa-plus"></i></a>';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        // select2 search of customers and united customers by spacifing the customer type.
        $(".s2s_customer_and_united_customer").select2({
            placeholder: 'Search by Customer or Company name',
            ajax: {
                url: "{{ route('s2s_customer_and_united_customer') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        customer_type: $('#customer_type').val(),
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true,
                tags: true
            },
            language: {
                noResults: function() {
                    return $('#customer_type').val() == 3 ?
                        'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewSupplier()"><i class="fa fa-plus"></i> Add New Supplier</a>' :
                        'No Result Found';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        // select2 search of only customers.
        $(".s2s_customer").select2({
            placeholder: 'Search by Customer name',
            ajax: {
                url: "{{ route('s2s_customer') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true,
                tags: true
            }
        });

        // select2 search of container by selected vehicle location
        $("#assign_to_container").select2({
            placeholder: 'Search by Booking# or Container#',
            ajax: {
                url: "{{ route('s2s_containers_filter_by_location') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        status: 'at_loading',
                        location_id: window.port_loading,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        // select2 search of container by selected vehicle location
        $("#s2s_clear_log_container").select2({
            placeholder: 'Search by Container#',
            ajax: {
                url: "{{ route('s2s_clear_log_container') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });


        // Select 2 for booking list
        $(".s2s_all_bookings").select2({
            placeholder: 'Search by Booking Number',
            ajax: {
                url: "{{ route('s2s_all_bookings') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        // Select 2 for vessels
        $(".s2s_all_vessels").select2({
            placeholder: 'Search by Vessel Name',
            ajax: {
                url: "{{ route('s2s_all_vessels') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        // Select 2 for vessels
        $(".s2s_all_steamshipline").select2({
            placeholder: 'Search by Steamship Line',
            ajax: {
                url: "{{ route('s2s_all_steamshipline') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        // Select 2 for destinations
        $(".s2s_all_destinations").select2({
            placeholder: 'Search by Destination',
            ajax: {
                url: "{{ route('s2s_all_destinations') }}",
                type: "get",
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });



    });
</script>