@extends('admin.layout.main')
@section('title', 'Vehicles')
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
    #create-vehicle-form ul {
        margin-bottom: 0px;
    }
    .error{
        color: red;
        font-size: 12px;
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
                    <h2 class="mb-1" style="text-align: center;">Add New Vehicle</h2>
                    <form id="create-vehicle-form" class="form-register form-horizontal" method="POST" action="{{ route('vehicles.create')}}">
                        @csrf
                        <div>
                            <h2>
                                <span class="step-icon"><i class="ti-receipt"></i></span>
                                <span class="step-text">General Info</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Clear Log</label>
                                            <select onchange="onCantainerChange(this)"
                                                name="log_id"
                                                class="form-control s2s_available_clear_logs"
                                            />
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Invoice Date</label>
                                            <input type="date" 
                                                name="invoice_date"   
                                                placeholder="Invoice Date"
                                                class="form-control"
                                                value="{{date('Y-m-d')}}"
                                                required
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>B.E No</label>
                                            <input type="text" 
                                                name="be_no"   
                                                placeholder="B.E No" 
                                                class="form-control"
                                                required
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Job No</label>
                                            <input type="text" 
                                                name="job_no" 
                                                placeholder="Job No" 
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                    <span id="invoice_amount">
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Custom Duty</label>
                                                <input type="number" 
                                                    name="custom_duty" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    placeholder="Custom Duty" 
                                                    class="form-control"
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Vat Amount</label>
                                                <input type="number" 
                                                    name="vat" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    placeholder="Vat Amount" 
                                                    class="form-control"
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Port Handling</label>
                                                <input type="number" 
                                                    name="port_handling" 
                                                    placeholder="Port Handling"  
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>VCC</label>
                                                <input type="number" 
                                                    name="vcc" 
                                                    placeholder="VCC" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Transporter Charges</label>
                                                <input type="number" 
                                                    name="transporter_charges" 
                                                    placeholder="Transporter Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <label>E Token</label>
                                                <input type="number" 
                                                    name="e_token" 
                                                    placeholder="E Token" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <label>Local Service Charges</label>
                                                <input type="number" 
                                                    name="local_service_charges" 
                                                    placeholder="Local Service Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <label>Bill Of Entry</label>
                                                <input type="number" 
                                                    name="bill_of_entry" 
                                                    placeholder="Bill Of Entry" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Handling Fee</label>
                                                <input type="number" 
                                                    name="handling_fee" 
                                                    placeholder="Handling Fee" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <label>Demurrage Charges</label>
                                                <input type="number" 
                                                    name="demurrage" 
                                                    placeholder="Demurrage Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Unloading Charges</label>
                                                <input type="number" 
                                                    name="unloading" 
                                                    placeholder="Unloading Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Consignee Charges</label>
                                                <input type="number" 
                                                    name="consignee_charges" 
                                                    placeholder="Consignee Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Demage Charges</label>
                                                <input type="number" 
                                                    name="damage_charges" 
                                                    placeholder="Demage Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Wash Fine Charges</label>
                                                <input type="number" 
                                                    name="wash_fine_charges" 
                                                    placeholder="Wash Fine Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Repairing Cost Charges</label>
                                                <input type="number" 
                                                    name="repairing_cost_charges" 
                                                    placeholder="Repairing Cost Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>MOF Service Charges</label>
                                                <input type="number" 
                                                    name="export_services_fees" 
                                                    placeholder="MOF Service Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Detention Charges</label>
                                                <input type="number" 
                                                    name="detention_charges" 
                                                    placeholder="Detention Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Port Storage</label>
                                                <input type="number" 
                                                    name="port_storage" 
                                                    placeholder="Port Storage" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                >
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Inspection Charges</label>
                                                <input type="number" 
                                                    name="inspection_charges" 
                                                    placeholder="Inspection Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Deliver Order Charges</label>
                                                <input type="number" 
                                                    name="delivery_order_amount" 
                                                    placeholder="Deliver Order Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Terminal Handling Charges</label>
                                                <input type="number" 
                                                    name="terminal_handling_charges" 
                                                    placeholder="Terminal Handling Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Additional Charges</label>
                                                <input type="number" 
                                                    name="additional_charges" 
                                                    placeholder="Additional Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Doc Attestation</label>
                                                <input type="number" 
                                                    name="doc_attestation" 
                                                    placeholder="Doc Attestation" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Crane Charges</label>
                                                <input type="number" 
                                                    name="crune_charges" 
                                                    placeholder="Crane Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                                
                                            </div>
                                        
                                            <div class="col-md-3 form-group">
                                                <label>Other Charges</label>
                                                <input type="number" 
                                                    name="other_charges" 
                                                    placeholder="Other Charges" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    onchange="changeInput(this)"
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Total Invoice</label>
                                                <input type="text" 
                                                    id="total_invoice" 
                                                    name="total_invoice" 
                                                    placeholder="Total Invoice" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control" 
                                                    disabled
                                                />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label>Discount/Deduction</label>
                                                <input type="number" 
                                                    name="discount" 
                                                    placeholder="Discount or Deduction" 
                                                    step="0.01" 
                                                    maxlength="10" 
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                    </span>
                                    
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" placeholder="Description" rows="6" class="form-control"></textarea>
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
                                        <div class="col-md-12">
                                            <h4>Clearance Costs</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 form-group">
                                        <label>Port Handling Cost on PGL</label>
                                        <input type="number" 
                                            name="port_handling_pgl_cost" 
                                            placeholder="Port Handling Cost on PGL"
                                            step="0.01" 
                                            maxlength="10"
                                            oninput="onInputClearanceCost(this)" 
                                            class="form-control"
                                        />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Inspection Cost on PGL</label>
                                            <input type="number" 
                                                name="inspection_pgl_cost" 
                                                placeholder="Inspection Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Doc Attestation Cost on PGL</label>
                                            <input type="number" 
                                                name="doc_attestation_pgl_cost" 
                                                placeholder="Doc Attestation Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Terminal Handling Cost on PGL</label>
                                            <input type="number" 
                                                name="terminal_handling_pgl_cost" 
                                                placeholder="Terminal Handling Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Custom Duty on PGL</label>
                                            <input type="number" 
                                                name="custom_pgl_cost" 
                                                placeholder="Custom on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Vat on PGL</label>
                                            <input type="number" 
                                                name="vat_pgl_cost" 
                                                placeholder="Vat on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Wash Find Cost on PGL</label>
                                            <input type="number" 
                                                name="wash_find_pgl_cost" 
                                                placeholder="Wash Find Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Port Storage Cost on PGL</label>
                                            <input type="number" 
                                                name="port_storage_pgl_cost" 
                                                placeholder="Port Storage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Additional Cost on PGL</label>
                                            <input type="number" 
                                                name="additional_pgl_cost" 
                                                placeholder="Additional Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Demurrage Cost on PGL</label>
                                            <input type="number" 
                                                name="demurrage_pgl_cost" 
                                                placeholder="Demurrage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Repairing Cost on PGL</label>
                                            <input type="number" 
                                                name="repairing_pgl_cost" 
                                                placeholder="Repairing Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>VCC Cost on PGL</label>
                                            <input type="number" 
                                                name="vcc_pgl_cost" 
                                                placeholder="VCC Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Damage Cost on PGL</label>
                                            <input type="number" 
                                                name="damage_pgl_cost" 
                                                placeholder="Damage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Detention Cost on PGL</label>
                                            <input type="number" 
                                                name="detention_pgl_cost" 
                                                placeholder="Detention Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Total Clearance</label>
                                            <input type="number" 
                                                id="total_clrearance_pgl_cost"
                                                name="total_clrearance_pgl_cost"
                                                placeholder="Total Clearance" 
                                                step="0.01" 
                                                maxlength="10"
                                                disabled
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Delivery Costs</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Delivery Cost on PGL</label>
                                            <input type="number" 
                                                name="delivery_pgl_cost" 
                                                placeholder="Delivery Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                class="form-control"
                                            />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Transportation Costs</h4>
                                            <hr>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>Fuel Cost on PGL</label>
                                            <input type="number" 
                                                name="fuel_pgl_cost" 
                                                placeholder="Fuel Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Tip Cost on PGL</label>
                                            <input type="number" 
                                                name="tip_pgl_cost" 
                                                placeholder="Tip Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Crane Cost on PGL</label>
                                            <input type="number" 
                                                name="crane_pgl_cost" 
                                                placeholder="Crane Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Token Cost on PGL</label>
                                            <input type="number" 
                                                name="token_pgl_cost" 
                                                placeholder="Token Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Charges on truck Cost</label>
                                            <input type="number" 
                                                name="charges_on_truck_pgl_cost" 
                                                placeholder="Charges on truck Cost" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Taxi truck Cost on PGL</label>
                                            <input type="number" 
                                                name="taxi_truck_pgl_cost" 
                                                placeholder="Taxi truck Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Total Transportation</label>
                                            <input type="number" 
                                                id="total_transportation_pgl_cost"
                                                name="taxi_truck_pgl_cost"
                                                placeholder="Total Transportation" 
                                                step="0.01" 
                                                maxlength="10"
                                                disabled
                                                class="form-control"
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
                                        <div class="col-md-12">
                                            <h4>Clearance Costs</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 form-group">
                                        <label>Port Handling Cost on PGL</label>
                                        <input type="number" 
                                            name="port_handling_pgl_cost" 
                                            placeholder="Port Handling Cost on PGL"
                                            step="0.01" 
                                            maxlength="10"
                                            oninput="onInputClearanceCost(this)" 
                                            class="form-control"
                                        />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Inspection Cost on PGL</label>
                                            <input type="number" 
                                                name="inspection_pgl_cost" 
                                                placeholder="Inspection Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Doc Attestation Cost on PGL</label>
                                            <input type="number" 
                                                name="doc_attestation_pgl_cost" 
                                                placeholder="Doc Attestation Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Terminal Handling Cost on PGL</label>
                                            <input type="number" 
                                                name="terminal_handling_pgl_cost" 
                                                placeholder="Terminal Handling Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Custom Duty on PGL</label>
                                            <input type="number" 
                                                name="custom_pgl_cost" 
                                                placeholder="Custom on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Vat on PGL</label>
                                            <input type="number" 
                                                name="vat_pgl_cost" 
                                                placeholder="Vat on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Wash Find Cost on PGL</label>
                                            <input type="number" 
                                                name="wash_find_pgl_cost" 
                                                placeholder="Wash Find Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Port Storage Cost on PGL</label>
                                            <input type="number" 
                                                name="port_storage_pgl_cost" 
                                                placeholder="Port Storage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Additional Cost on PGL</label>
                                            <input type="number" 
                                                name="additional_pgl_cost" 
                                                placeholder="Additional Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Demurrage Cost on PGL</label>
                                            <input type="number" 
                                                name="demurrage_pgl_cost" 
                                                placeholder="Demurrage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Repairing Cost on PGL</label>
                                            <input type="number" 
                                                name="repairing_pgl_cost" 
                                                placeholder="Repairing Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>VCC Cost on PGL</label>
                                            <input type="number" 
                                                name="vcc_pgl_cost" 
                                                placeholder="VCC Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Damage Cost on PGL</label>
                                            <input type="number" 
                                                name="damage_pgl_cost" 
                                                placeholder="Damage Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Detention Cost on PGL</label>
                                            <input type="number" 
                                                name="detention_pgl_cost" 
                                                placeholder="Detention Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputClearanceCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Total Clearance</label>
                                            <input type="number" 
                                                id="total_clrearance_pgl_cost"
                                                name="total_clrearance_pgl_cost"
                                                placeholder="Total Clearance" 
                                                step="0.01" 
                                                maxlength="10"
                                                disabled
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Delivery Costs</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Delivery Cost on PGL</label>
                                            <input type="number" 
                                                name="delivery_pgl_cost" 
                                                placeholder="Delivery Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                class="form-control"
                                            />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Transportation Costs</h4>
                                            <hr>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>Fuel Cost on PGL</label>
                                            <input type="number" 
                                                name="fuel_pgl_cost" 
                                                placeholder="Fuel Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Tip Cost on PGL</label>
                                            <input type="number" 
                                                name="tip_pgl_cost" 
                                                placeholder="Tip Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Crane Cost on PGL</label>
                                            <input type="number" 
                                                name="crane_pgl_cost" 
                                                placeholder="Crane Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Token Cost on PGL</label>
                                            <input type="number" 
                                                name="token_pgl_cost" 
                                                placeholder="Token Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Charges on truck Cost</label>
                                            <input type="number" 
                                                name="charges_on_truck_pgl_cost" 
                                                placeholder="Charges on truck Cost" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Taxi truck Cost on PGL</label>
                                            <input type="number" 
                                                name="taxi_truck_pgl_cost" 
                                                placeholder="Taxi truck Cost on PGL" 
                                                step="0.01" 
                                                maxlength="10"
                                                oninput="onInputTransportationCost(this)" 
                                                class="form-control"
                                            />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Total Transportation</label>
                                            <input type="number" 
                                                id="total_transportation_pgl_cost"
                                                name="taxi_truck_pgl_cost"
                                                placeholder="Total Transportation" 
                                                step="0.01" 
                                                maxlength="10"
                                                disabled
                                                class="form-control"
                                            />
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <div class="col-md-12 px-0">
                                <button type="submit" class="btn btn-primary">Save</button>
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
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{ asset('assets/formwizard/js/jquery.steps.js') }}"></script>
<script src="{{ asset('assets/formwizard/js/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/formwizard/js/jquery-ui.min.js') }}"></script>

<script>


    function onInputClearanceCost(event) {
        var totalClearance = parseFloat($('[name="port_handling_pgl_cost"]').val() || 0)
            + parseFloat($('[name="inspection_pgl_cost"]').val() || 0)
            + parseFloat($('[name="doc_attestation_pgl_cost"]').val() || 0)
            + parseFloat($('[name="terminal_handling_pgl_cost"]').val() || 0)
            + parseFloat($('[name="custom_pgl_cost"]').val() || 0)
            + parseFloat($('[name="vat_pgl_cost"]').val() || 0)
            + parseFloat($('[name="wash_find_pgl_cost"]').val() || 0)
            + parseFloat($('[name="port_storage_pgl_cost"]').val() || 0)
            + parseFloat($('[name="additional_pgl_cost"]').val() || 0)
            + parseFloat($('[name="demurrage_pgl_cost"]').val() || 0)
            + parseFloat($('[name="repairing_pgl_cost"]').val() || 0)
            + parseFloat($('[name="vcc_pgl_cost"]').val() || 0)
            + parseFloat($('[name="damage_pgl_cost"]').val() || 0)
            + parseFloat($('[name="detention_pgl_cost"]').val() || 0);
        $('#total_clrearance_pgl_cost').val(totalClearance.toLocaleString('en-US'));
    }

    function onInputTransportationCost(event) {
        var total_tranportation = parseFloat($('[name="fuel_pgl_cost"]').val() || 0)
            + parseFloat($('[name="tip_pgl_cost"]').val() || 0)
            + parseFloat($('[name="crane_pgl_cost"]').val() || 0)
            + parseFloat($('[name="token_pgl_cost"]').val() || 0)
            + parseFloat($('[name="charges_on_truck_pgl_cost"]').val() || 0)
            + parseFloat($('[name="taxi_truck_pgl_cost"]').val() || 0);
        $('#total_transportation_pgl_cost').val(total_tranportation.toLocaleString('en-US'));

    }

    function changeInput(event) {
        if(event.name == 'custom_duty'){
            $('[name="custom_pgl_cost"]').val(event.value);
        }else if(event.name == 'vat'){
            $('[name="vat_pgl_cost"]').val(event.value != 0 ? event.value - 125 : 0);
        }else if(event.name == 'vcc'){
            $('[name="vcc_pgl_cost"]').val(event.value);
        }else if(event.name == 'demurrage'){
            $('[name="demurrage_pgl_cost"]').val(event.value);
        }else if(event.name == 'detention_charges'){
            $('[name="detention_pgl_cost"]').val(event.value);
        }else if(event.name == 'damage_charges'){
            $('[name="damage_pgl_cost"]').val(event.value);
        }else if(event.name == 'wash_fine_charges'){
            $('[name="wash_find_pgl_cost"]').val(event.value);
        }else if(event.name == 'repairing_cost_charges'){
            $('[name="repairing_pgl_cost"]').val(event.value);
        }else if(event.name == 'port_storage'){
            $('[name="port_storage_pgl_cost"]').val(event.value);
        }else if(event.name == 'additional_charges'){
            $('[name="additional_pgl_cost"]').val(event.value);
        }else if(event.name == 'port_handling'){
            if(event.value == ''){
                $('[name="port_handling_pgl_cost"]').val(0);
            }else if($('[name="port_handling_pgl_cost"]').val() == 0){
                $('[name="port_handling_pgl_cost"]').val(369);
            }
        }else if(event.name == 'inspection_charges'){
            if(event.value == ''){
                $('[name="inspection_pgl_cost"]').val(0);
            }else if($('[name="inspection_pgl_cost"]').val() == 0){
                $('[name="inspection_pgl_cost"]').val(350);
            }
        }else if(event.name == 'doc_attestation'){
            if(event.value == ''){
                $('[name="doc_attestation_pgl_cost"]').val(0);
            }else if($('[name="doc_attestation_pgl_cost"]').val() == 0){
                $('[name="doc_attestation_pgl_cost"]').val(152.02);
            }
        }else if(event.name == 'terminal_handling_charges'){
            if(event.value == ''){
                $('[name="terminal_handling_pgl_cost"]').val(0);
            }else if($('[name="terminal_handling_pgl_cost"]').val() == 0){
                $('[name="terminal_handling_pgl_cost"]').val(1100);
            }
        }

        var total = parseFloat($('[name="custom_clearing_balance"]').val() || 0)
            + parseFloat($('[name="custom_duty"]').val() || 0)
            + parseFloat($('[name="vat"]').val() || 0)
            + parseFloat($('[name="port_handling"]').val() || 0)
            + parseFloat($('[name="vcc"]').val() || 0)
            + parseFloat($('[name="transporter_charges"]').val() || 0)
            + parseFloat($('[name="e_token"]').val() || 0)
            + parseFloat($('[name="local_service_charges"]').val() || 0)
            + parseFloat($('[name="bill_of_entry"]').val() || 0)
            + parseFloat($('[name="handling_fee"]').val() || 0)
            + parseFloat($('[name="demurrage"]').val() || 0)
            + parseFloat($('[name="unloading"]').val() || 0)
            + parseFloat($('[name="consignee_charges"]').val() || 0)
            + parseFloat($('[name="damage_charges"]').val() || 0)
            + parseFloat($('[name="wash_fine_charges"]').val() || 0)
            + parseFloat($('[name="repairing_cost_charges"]').val() || 0)
            + parseFloat($('[name="export_services_fees"]').val() || 0)
            + parseFloat($('[name="detention_charges"]').val() || 0)
            + parseFloat($('[name="port_storage"]').val() || 0)
            + parseFloat($('[name="terminal_handling_charges"]').val() || 0)
            + parseFloat($('[name="inspection_charges"]').val() || 0)
            + parseFloat($('[name="delivery_order_amount"]').val() || 0)
            + parseFloat($('[name="additional_charges"]').val() || 0)
            + parseFloat($('[name="crune_charges"]').val() || 0)
            + parseFloat($('[name="doc_attestation"]').val() || 0)
            + parseFloat($('[name="other_charges"]').val() || 0)
            + (0.05 * parseFloat($('[name="local_service_charges"]').val() || 0));
    
        $('#total_invoice').val(total.toLocaleString('en-US'));
    }

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
            console.log(form);
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });

</script>
@endpush
