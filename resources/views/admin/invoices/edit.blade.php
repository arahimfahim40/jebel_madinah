@extends('admin.layout.main')
@section('title', 'Invoices')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/formwizard/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/formwizard/css/style.css') }}" />

<style>
    .form-group label {
        font-weight: bold;
    }

    .loading {
        display: none;
    }

    .requited_filed {
        color: red;
        font-weight: bold;
    }

    .is-invalid {
        border: 1px solid red;
    }

    .invalid-feedback {
        color: red;
    }
    .form-register .steps ul{
        justify-content: center;
    }
    /* .actions {
        display: none;
    } */
    #edit-invoice-form ul {
        margin-bottom: 0px;
    }
    .error{
        color: red;
        font-size: 12px;
    }
    .required::after {
        content: ' *';
        color: red;
    }
</style>
@endpush
@section('content')
<div class="site-content">
    <div class="content-area py-1">
        <div class="container-fluid">

            @include('errors')

            <div class="wizard-v4-content w-100">
                <div class="wizard-form py-2">
                    <h2 class="mb-1" style="text-align: center;">Edit Invoice</h2>
                    <form id="edit-invoice-form" class="form-register form-horizontal" method="POST" action="{{ route('invoices.update', $invoice->id)}}" onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')
                        <div>
                            <h2>
                                <span class="step-icon"><i class="ti-receipt"></i></span>
                                <span class="step-text">Invoice Details</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-12 px-0">
                                            <div class="col-md-6 form-group">
                                                <label class="required">Select Customer</label>
                                                <select 
                                                    onchange="onCustomerChange(this)"
                                                    name="customer_id"
                                                    class="form-control s2s_customers"
                                                    required
                                                >
                                                <?php $cust = DB::table('customers')->whereNull('deleted_at')->where('id', isset($invoice) ? $invoice->customer_id : '')->first(); ?>
                                                <option value="<?php echo $cust->id ?>"><?php echo $cust->name ?></option>
                                                @foreach($customers as $cst)
                                                <option value="{{$cst->id}}">{{$cst->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="required">Status</label>
                                                <select name="status"
                                                    class="form-control"
                                                >
                                                    <option value="">-- Select Status --</option>
                                                    <option value="open" <?php echo $invoice->status == 'open' ? 'selected' : ''; ?>>Open</option>
                                                    <option value="pending" <?php echo $invoice->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="past_due" <?php echo $invoice->status == 'past_due' ? 'selected' : ''; ?>>Past Due</option>
                                                    <option value="paid" <?php echo $invoice->status == 'paid' ? 'selected' : ''; ?>>Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 px-0">
                                            <div class="col-md-12 form-group">
                                                <input type="hidden" name="vehicles" value="" />
                                                <label for="VehicleSelect">Vehicle</label>
                                                <div class="input-group">
                                                    <select id='VehicleSelect' class="form-control"
                                                        aria-describedby="basic-addon2">
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button id="basic-addon2" onclick="addVehicleToList()"
                                                            class="btn btn-success bootstrap-touchspin-up" type="button">
                                                            Add <i class="fa fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="card mt-1">
                                                    <h5 class="card-header">List Of Vehicles<label class="required"></label></h5>
                                                    
                                                    <div class="card-body">
                                                        <ul class="vehicle_list list-group m-1"> No item in list</ul>
                                                    </div>
                                                </div>
                                                @error('vehicles')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 px-0">
                                            <div class="col-md-4 form-group">
                                                <label class="required">Move To Open Date</label>
                                                <input type="date" 
                                                name="move_to_open_date"   
                                                placeholder="Move To Open Date"
                                                class="form-control"
                                                value="{{ old('move_to_open_date', @$invoice->move_to_open_date) }}"
                                                required
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="required">Invoice Date</label>
                                                <input type="date" 
                                                name="invoice_date"   
                                                placeholder="Invoice Date"
                                                class="form-control"
                                                value="{{ old('invoice_date', @$invoice->invoice_date) }}"
                                                required
                                                />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="required">Due Date</label>
                                                <input type="date" 
                                                name="invoice_due_date"   
                                                placeholder="Due Date"
                                                class="form-control"
                                                value="{{ old('invoice_due_date', @$invoice->invoice_due_date) }}"
                                                required
                                                />
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-12 px-0"> 
                                            <div class="col-md-4 form-group">
                                                <label class="required">Exchange Rate</label>
                                                <input 
                                                    type="number" 
                                                    name="exchange_rate"   
                                                    placeholder="Exchange Rate"
                                                    class="form-control"
                                                    value="{{ old('exchange_rate', @$invoice->exchange_rate) }}"
                                                    required
                                                />
                                            </div>
                                            
                                            <div class="col-md-4 form-group">
                                                <label >Discount</label>
                                                <input 
                                                    type="number" 
                                                    name="discount" 
                                                    placeholder="Discount" 
                                                    class="form-control"
                                                    value="{{ old('discount', @$invoice->discount) }}"
                                                    value="0"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" placeholder="Description" rows="6" class="form-control" value="{{ old('description', @$invoice->description) }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="col-md-12 px-0">
                                <button type="button" onclick="onFormSubmit()" class="btn btn-primary">Save</button>
                                <input type="reset" class="btn btn-danger" value="RESET">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script src="{{ asset('assets/formwizard/js/jquery.steps.js') }}"></script>
<script src="{{ asset('assets/formwizard/js/jquery.validate.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($cust): ?>
            onCustomerChange({ value: '<?php echo $cust->id ?>' });
        <?php endif; ?>
    });
    var form = $("#edit-invoice-form");
    var vehiclesIds = new Map(Object.entries(<?= json_encode($vehicles ?? []) ?>));
    renderVehicleList();
    console.log("vehiclesIds: ", vehiclesIds)
    form.children("div").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back',
            next : 'Next',
            finish : 'Submit',
            current : 'Save'
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            // alert("Submitted!");
            form.submit();
        }
    });

    // Add vehicle to the list
    function addVehicleToList() {
        const vehicleSelect = document.getElementById("VehicleSelect");
        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
        const vehicleId = selectedOption.value;
        const vehicleDetails = selectedOption.text;

        if (vehicleId && !vehiclesIds.has(vehicleId)) {
            vehiclesIds.set(vehicleId, vehicleDetails);
            renderVehicleList();
        }
    }

    function renderVehicleList() {
        $("input[name=vehicles]").val(Array.from(vehiclesIds.keys()));
        if (vehiclesIds.size == 0) {
            $('.vehicle_list').html('No item in list');
        } else {
            $('.vehicle_list').html('');
        }
        vehiclesIds.forEach((item, key) => {
            $('.vehicle_list').append(`<li class="list-group-item px-1" >${item}
        <button onClick="removeVehicle(${key})" class="close">
            <span aria-hidden="true">&times;</span>
        </button>
        </li>`);
        });
    }

    function removeVehicle(id) {
        vehiclesIds.delete(id.toString());
        renderVehicleList();
    }

    function onCustomerChange(event) {
        if (event.value) {
            $.ajax({
                url: "{{route('get_vehicles_open_of_customer')}}",
                method: 'GET',
                data: {
                    id: event.value
                },
                success: function(response) {
                    renderVehicleOptions(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("Error!", jqXHR.statusText, "error");
                    console.log("Error : " + jqXHR.responseText + " Status: " + textStatus + " Http error:" + errorThrown);
                }
            });
        }
    }
    
    function renderVehicleOptions(vehicles) {
    let selectOptions = '<option value="">Select Vehicle</option>';
    vehicles.forEach(vehicle => {

        let auctionFeeCharge = parseFloat(vehicle.auction_fee_charge) || 0;
        let storageCharge = parseFloat(vehicle.storage_charge) || 0;
        let towingCharge = parseFloat(vehicle.towing_charge) || 0;
        let dismantleCharge = parseFloat(vehicle.dismantal_charge) || 0;
        let shippingCharge = parseFloat(vehicle.shiping_charge) || 0;
        let customCharge = parseFloat(vehicle.custom_charge) || 0;
        let demurrageCharge = parseFloat(vehicle.demurage_charge) || 0;
        let otherCharge = parseFloat(vehicle.other_charge) || 0;

        let totalCharges = auctionFeeCharge +
                            storageCharge +
                            towingCharge +
                            dismantleCharge +
                            shippingCharge +
                            customCharge +
                            demurrageCharge +
                            otherCharge;

        selectOptions += `<option value="${vehicle.id}" data-total-charges="${totalCharges}">${vehicle.vin} | ${vehicle.lot_number}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$${totalCharges.toFixed(2)}</option>`;
    });

    $('#VehicleSelect').html(selectOptions);
}


    function validateForm() {
        if (vehiclesIds.size === 0) {
            alert('Please select at least one vehicle.');
            return false; 
        }
        return true;
    }
    
    function onFormSubmit(){
        form.validate().settings.ignore = ":disabled";
        if(form.valid()){
            form.submit();
        }
    }

</script>
@endpush
