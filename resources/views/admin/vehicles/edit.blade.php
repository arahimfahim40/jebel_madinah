@extends('admin.layout.main')
@section('title', 'Vehicles')
@push('css')
{{-- <link rel="stylesheet" href="{{ asset('assets/formwizard/css/jquery-ui.min.css') }}"> --}}
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
    #create-vehicle-form ul {
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
                    <h2 class="mb-1" style="text-align: center;">Edit Vehicle</h2>
                    <form id="create-vehicle-form" class="form-register form-horizontal" method="POST" action="{{ route('vehicles.update', $vehicle->id)}}">
                        @csrf
                        @method('PUT')
                        <div>
                            <h2>
                                <span class="step-icon"><i class="ti-receipt"></i></span>
                                <span class="step-text">General Info</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label class="required">Select Customer</label>
                                                <select 
                                                    {{-- onchange="onCantainerChange(this)" --}}
                                                    name="customer_id"
                                                    class="form-control s2s_customers"
                                                    required
                                                />
                                                    <option value="{{ old('customer_id') ?? @$vehicle->customer_id }}" selected>{{ old('customer_name') ?? @$vehicle->customer->name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label >Year</label>
                                                <input 
                                                    type="number" 
                                                    name="year" 
                                                    placeholder="Year"
                                                    class="form-control"
                                                    value="{{old('year') ?? @$vehicle->year}}"
                                                />
                                            </div>
                                            
                                            <div class="col-md-12 form-group">
                                                <label >Make</label>
                                                <input 
                                                    type="text" 
                                                    name="make" 
                                                    placeholder="Make" 
                                                    class="form-control"
                                                    value="{{ old('make') ?? @$vehicle->make }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label >Model</label>
                                                <input 
                                                    type="text" 
                                                    name="model" 
                                                    placeholder="Model" 
                                                    class="form-control"
                                                    value="{{ old('model') ?? @$vehicle->model }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label >Color</label>
                                                <input 
                                                    type="text" 
                                                    name="color" 
                                                    placeholder="Color" 
                                                    class="form-control"
                                                    value="{{ old('color') ?? @$vehicle->color }}"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label class="required">Vin#</label>
                                                <input 
                                                    type="text" 
                                                    name="vin"   
                                                    placeholder="Vin"
                                                    class="form-control"
                                                    value="{{ old('vin') ?? @$vehicle->vin }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="required">Lot Number</label>
                                                <input type="number" 
                                                    name="lot_number"    
                                                    placeholder="Lot Number" 
                                                    class="form-control"
                                                    value="{{ old('lot_number') ?? @$vehicle->lot_number }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label >Container Number</label>
                                                <input type="text" 
                                                    name="container_number" 
                                                    placeholder="Container Number" 
                                                    class="form-control"
                                                    value="{{ old('container_number') ?? @$vehicle->container_number }}"
                                                />
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="required">Point Of Loading</label>
                                                <select 
                                                    name="point_of_loading_id"
                                                    class="form-control"
                                                    required
                                                >
                                                <option value="">-- Select Point Of Loading --</option>
                                                @foreach (@getLocations() as  $location)
                                                    <option value="{{ $location->id }}" {{ old('point_of_loading_id') ?? $vehicle->point_of_loading_id == $location->id ? 'selected' : '' }}>
                                                        {{ $location->name }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Ship As</label>
                                                <select name="ship_as" class="form-control">
                                                    <option value="">-- Select Ship As --</option>
                                                    <option value="complete" {{ old('ship_as') ?? $vehicle->ship_as == 'complete' ? 'selected' : '' }}>Complete</option>
                                                    <option value="half-cut" {{ old('ship_as') ?? $vehicle->ship_as == 'half-cut' ? 'selected' : '' }}>Half-Cut</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label>Purchase Date</label>
                                                <input type="date" 
                                                    name="purchase_date"   
                                                    placeholder="Purchase Date"
                                                    class="form-control"
                                                    value="{{ old('purchase_date') ?? @$vehicle->purchase_date }}"
                                                    required
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Payment Date</label>
                                                <input type="date" 
                                                    name="payment_date"   
                                                    placeholder="Payment Date"
                                                    class="form-control"
                                                    value="{{ old('payment_date') ?? @$vehicle->payment_date }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Pick Up Date</label>
                                                <input type="date" 
                                                    name="pickup_date"   
                                                    placeholder="Pick Up Date"
                                                    class="form-control"
                                                    value="{{ old('pickup_date') ?? @$vehicle->pickup_date }}"
                                                />
                                            </div>
                                            
                                            <div class="col-md-12 form-group">
                                                <label>Deliver Date</label>
                                                <input type="date" 
                                                    name="deliver_date"   
                                                    placeholder="Deliver Date"
                                                    class="form-control"
                                                    value="{{ old('delivery_date') ?? @$vehicle->delivery_date }}"
                                                />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea name="note" placeholder="Note" rows="6" class="form-control">{{ old('note') ?? $vehicle->note }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Remark</label>
                                                <textarea name="customer_remark" placeholder="Customer Remark" rows="6" class="form-control">{{ old('customer_remark') ?? $vehicle->customer_remark }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- SECTION 2 -->
                            <h2>
                                <span class="step-icon"><i class="fa fa-car"></i></span>
                                <span class="step-text">Vehicle Info</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label>Hat Number</label>
                                                <input 
                                                    type="text" 
                                                    name="hat_number"   
                                                    placeholder="Hat Number"
                                                    class="form-control"
                                                    value="{{ old('hat_number') ?? @$vehicle->hat_number }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Title Received Date</label>
                                                <input type="date" 
                                                    name="title_received_date"   
                                                    placeholder="Title Received Date"
                                                    class="form-control"
                                                    value="{{ old('title_received_date') ?? @$vehicle->title_received_date }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Title Number</label>
                                                <input 
                                                    type="text" 
                                                    name="title_number"   
                                                    placeholder="Title Number"
                                                    class="form-control"
                                                    value="{{ old('title_number') ?? @$vehicle->title_number }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Title Status</label>
                                                <input 
                                                    type="text" 
                                                    name="title_status"   
                                                    placeholder="Title Number"
                                                    class="form-control"
                                                    value="{{ old('title_status') ?? @$vehicle->title_status }}"
                                                />
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label>Weight (KG)</label>
                                                <input type="number" 
                                                    name="weight"    
                                                    placeholder="Weight (KG)"
                                                    class="form-control"
                                                    value="{{ old('weight') ?? @$vehicle->weight }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Buyer Number</label>
                                                <input type="text" 
                                                    name="buyer_number"   
                                                    placeholder="Buyer Number" 
                                                    class="form-control"
                                                    value="{{ old('buyer_number') ?? @$vehicle->buyer_number }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Auction</label>
                                                <input type="text" 
                                                    name="auction"   
                                                    placeholder="Auction" 
                                                    class="form-control"
                                                    value="{{ old('auction') ?? @$vehicle->auction }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Auction City</label>
                                                <input type="text"
                                                    name="auction_city"
                                                    placeholder="Auction City"
                                                    class="form-control"
                                                    value="{{ old('auction_city') ?? @$vehicle->auction_city }}"
                                                    
                                                />
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label>Is Key Present</label>
                                                <select name="is_key" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option value="Yes" {{ old('is_key') ?? $vehicle->is_key == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ old('is_key') ?? $vehicle->is_key == 'No' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>License plate/Tag Number</label>
                                                <input 
                                                    type="text" 
                                                    name="licence_number"   
                                                    placeholder="License plate/Tag Number"
                                                    class="form-control"
                                                    value="{{ old('licence_number') ?? @$vehicle->licence_number }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Created at</label>
                                                <input type="date" 
                                                    name="created_at"    
                                                    placeholder="Created at"
                                                    value="{{date('Y-m-d')}}"
                                                    class="form-control"
                                                    disabled
                                                />
                                            </div>
                                            @if (auth()->id())
                                                <div class="col-md-12 form-group">
                                                    <label>Created By</label>
                                                    <input type="text" 
                                                        name="created_by" 
                                                        placeholder="Created By"
                                                        value="{{auth()->user()?->name }}"
                                                        class="form-control"
                                                        disabled
                                                    />
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Photos Link</label>
                                            <input type="url" 
                                                name="photos_link"    
                                                placeholder="Photos Link" 
                                                class="form-control"
                                                value="{{ old('photos_link') ?? @$vehicle->photos_link }}"
                                            />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Auction Invoice (link)</label>
                                            <input type="url" 
                                                name="auction_invoice_link"    
                                                placeholder="Auction Invoice (link)" 
                                                class="form-control"
                                                value="{{ old('auction_invoice_link') ?? @$vehicle->auction_invoice_link }}"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- SECTION 3 -->
                            <h2>
                                <span class="step-icon"><i class="fa fa-money"></i></span>
                                <span class="step-text">Charges & Costs</span>
                            </h2>

                            <section>
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-6 px-0">
                                            <h4 class="mx-1">Vehicle Charges on Customer</h4>
                                            <hr class="mx-1"/>
                                            <div class="col-md-12 form-group">
                                                <label>Vehicle Price</label>
                                                <input type="number" 
                                                    name="vehicle_price"    
                                                    placeholder="Vehicle Price"
                                                    class="form-control"
                                                    value="{{ old('vehicle_price') ?? @$vehicle->vehicle_price }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Towing charge</label>
                                                <input type="number" 
                                                    name="towing_charge"     
                                                    placeholder="Towing Charge"
                                                    class="form-control"
                                                    value="{{ old('towing_charge') ?? @$vehicle->towing_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Auction Fee charge</label>
                                                <input type="number"
                                                    name="auction_fee_charge"
                                                    placeholder="Auction Fee charge"
                                                    class="form-control"
                                                    value="{{ old('auction_fee_charge') ?? @$vehicle->auction_fee_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Dismantal Charge</label>
                                                <input type="number"
                                                    name="dismantal_charge"
                                                    placeholder="Dismantal Charge"
                                                    class="form-control"
                                                    value="{{ old('dismantal_charge') ?? @$vehicle->dismantal_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Ship Charge</label>
                                                <input type="number"
                                                    name="shiping_charge"
                                                    placeholder="Ship Charge"
                                                    class="form-control"
                                                    value="{{ old('shiping_charge') ?? @$vehicle->shiping_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Storage Charge</label>
                                                <input type="number"
                                                    name="storage_charge"
                                                    placeholder="Storage Charge"
                                                    class="form-control"
                                                    value="{{ old('storage_charge') ?? @$vehicle->storage_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Custom Charge</label>
                                                <input type="number"
                                                    name="custom_charge"
                                                    placeholder="Custom Charge"
                                                    class="form-control"
                                                    value="{{ old('custom_charge') ?? @$vehicle->custom_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Demurage Charge</label>
                                                <input type="number"
                                                    name="demurage_charge"
                                                    placeholder="Demurage Charge"
                                                    class="form-control"
                                                    value="{{ old('demurage_charge') ?? @$vehicle->demurage_charge }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Other Charge</label>
                                                <input type="number"
                                                    name="other_charge"
                                                    placeholder="Other Charge"
                                                    class="form-control"
                                                    value="{{ old('other_charge') ?? @$vehicle->other_charge }}"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-0">
                                            <h4 class="px-1">Vehicle Costs On AL Sadeer</h4>
                                            <hr class="mx-1"/>
                                            <div class="col-md-12 form-group">
                                                <label>Towing Cost</label>
                                                <input type="number" 
                                                    name="towing_cost"    
                                                    placeholder="Towing Cost" 
                                                    class="form-control"
                                                    value="{{ old('towing_cost') ?? @$vehicle->towing_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Auction Fee cost</label>
                                                <input type="number"
                                                    name="auction_fee_cost"
                                                    placeholder="Auction Fee Cost"
                                                    class="form-control"
                                                    value="{{ old('auction_fee_cost') ?? @$vehicle->auction_fee_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Dismantal cost</label>
                                                <input type="number"
                                                    name="dismantal_cost"
                                                    placeholder="Dismantal cost"
                                                    class="form-control"
                                                    value="{{ old('dismantal_cost') ?? @$vehicle->dismantal_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Ship cost</label>
                                                <input type="number"
                                                    name="ship_cost"
                                                    placeholder="Ship cost"
                                                    class="form-control"
                                                    value="{{ old('ship_cost') ?? @$vehicle->ship_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Storage Cost</label>
                                                <input type="number"
                                                    name="storage_cost"
                                                    placeholder="Storage Cost"
                                                    class="form-control"
                                                    value="{{ old('storage_cost') ?? @$vehicle->storage_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Custom Cost</label>
                                                <input type="number"
                                                    name="custom_cost"
                                                    placeholder="Custom Cost"
                                                    class="form-control"
                                                    value="{{ old('custom_cost') ?? @$vehicle->custom_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Demurage Cost</label>
                                                <input type="number"
                                                    name="demurage_cost"
                                                    placeholder="Demurage Cost"
                                                    class="form-control"
                                                    value="{{ old('demurage_cost') ?? @$vehicle->demurage_cost }}"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Other Cost</label>
                                                <input type="number"
                                                    name="other_cost"
                                                    placeholder="Other Cost"
                                                    class="form-control"
                                                    value="{{ old('other_cost') ?? @$vehicle->other_cost }}"
                                                />
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


    // function onInputClearanceCost(event) {
    //     var totalClearance = parseFloat($('[name="port_handling_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="inspection_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="doc_attestation_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="terminal_handling_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="custom_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="vat_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="wash_find_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="port_storage_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="additional_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="demurrage_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="repairing_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="vcc_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="damage_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="detention_pgl_cost"]').val() || 0);
    //     $('#total_clrearance_pgl_cost').val(totalClearance.toLocaleString('en-US'));
    // }

    // function onInputTransportationCost(event) {
    //     var total_tranportation = parseFloat($('[name="fuel_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="tip_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="crane_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="token_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="charges_on_truck_pgl_cost"]').val() || 0)
    //         + parseFloat($('[name="taxi_truck_pgl_cost"]').val() || 0);
    //     $('#total_transportation_pgl_cost').val(total_tranportation.toLocaleString('en-US'));

    // }

    // function changeInput(event) {
    //     if(event.name == 'custom_duty'){
    //         $('[name="custom_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'vat'){
    //         $('[name="vat_pgl_cost"]').val(event.value != 0 ? event.value - 125 : 0);
    //     }else if(event.name == 'vcc'){
    //         $('[name="vcc_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'demurrage'){
    //         $('[name="demurrage_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'detention_charges'){
    //         $('[name="detention_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'damage_charges'){
    //         $('[name="damage_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'wash_fine_charges'){
    //         $('[name="wash_find_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'repairing_cost_charges'){
    //         $('[name="repairing_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'port_storage'){
    //         $('[name="port_storage_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'additional_charges'){
    //         $('[name="additional_pgl_cost"]').val(event.value);
    //     }else if(event.name == 'port_handling'){
    //         if(event.value == ''){
    //             $('[name="port_handling_pgl_cost"]').val(0);
    //         }else if($('[name="port_handling_pgl_cost"]').val() == 0){
    //             $('[name="port_handling_pgl_cost"]').val(369);
    //         }
    //     }else if(event.name == 'inspection_charges'){
    //         if(event.value == ''){
    //             $('[name="inspection_pgl_cost"]').val(0);
    //         }else if($('[name="inspection_pgl_cost"]').val() == 0){
    //             $('[name="inspection_pgl_cost"]').val(350);
    //         }
    //     }else if(event.name == 'doc_attestation'){
    //         if(event.value == ''){
    //             $('[name="doc_attestation_pgl_cost"]').val(0);
    //         }else if($('[name="doc_attestation_pgl_cost"]').val() == 0){
    //             $('[name="doc_attestation_pgl_cost"]').val(152.02);
    //         }
    //     }else if(event.name == 'terminal_handling_charges'){
    //         if(event.value == ''){
    //             $('[name="terminal_handling_pgl_cost"]').val(0);
    //         }else if($('[name="terminal_handling_pgl_cost"]').val() == 0){
    //             $('[name="terminal_handling_pgl_cost"]').val(1100);
    //         }
    //     }

    //     var total = parseFloat($('[name="custom_clearing_balance"]').val() || 0)
    //         + parseFloat($('[name="custom_duty"]').val() || 0)
    //         + parseFloat($('[name="vat"]').val() || 0)
    //         + parseFloat($('[name="port_handling"]').val() || 0)
    //         + parseFloat($('[name="vcc"]').val() || 0)
    //         + parseFloat($('[name="transporter_charges"]').val() || 0)
    //         + parseFloat($('[name="e_token"]').val() || 0)
    //         + parseFloat($('[name="local_service_charges"]').val() || 0)
    //         + parseFloat($('[name="bill_of_entry"]').val() || 0)
    //         + parseFloat($('[name="handling_fee"]').val() || 0)
    //         + parseFloat($('[name="demurrage"]').val() || 0)
    //         + parseFloat($('[name="unloading"]').val() || 0)
    //         + parseFloat($('[name="consignee_charges"]').val() || 0)
    //         + parseFloat($('[name="damage_charges"]').val() || 0)
    //         + parseFloat($('[name="wash_fine_charges"]').val() || 0)
    //         + parseFloat($('[name="repairing_cost_charges"]').val() || 0)
    //         + parseFloat($('[name="export_services_fees"]').val() || 0)
    //         + parseFloat($('[name="detention_charges"]').val() || 0)
    //         + parseFloat($('[name="port_storage"]').val() || 0)
    //         + parseFloat($('[name="terminal_handling_charges"]').val() || 0)
    //         + parseFloat($('[name="inspection_charges"]').val() || 0)
    //         + parseFloat($('[name="delivery_order_amount"]').val() || 0)
    //         + parseFloat($('[name="additional_charges"]').val() || 0)
    //         + parseFloat($('[name="crune_charges"]').val() || 0)
    //         + parseFloat($('[name="doc_attestation"]').val() || 0)
    //         + parseFloat($('[name="other_charges"]').val() || 0)
    //         + (0.05 * parseFloat($('[name="local_service_charges"]').val() || 0));
    
    //     $('#total_invoice').val(total.toLocaleString('en-US'));
    // }

    var form = $("#create-vehicle-form");
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

    function onFormSubmit(){
        form.validate().settings.ignore = ":disabled";
        if(form.valid()){
            form.submit();
        }
    }

</script>
@endpush
