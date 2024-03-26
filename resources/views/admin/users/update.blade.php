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
    #create-user-form ul {
        margin-bottom: 0px;
        margin-right: 200px; 
        margin-left: 200px; 
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
        <div class="container">
            @include('errors')
            <div class="wizard-v4-content w-100">
                <div class="wizard-form py-2">
                    <h2 class="mb-1" style="text-align: center;">Update User Detail</h2>
                    <form id="create-user-form" class="form-register form-horizontal" method="POST" action="{{ route('users.update',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="px-4">
                            <h2>
                                <span class="step-icon"><i class="ti-user"></i></span>
                                <span class="step-text">User Information</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="form-group">
                                        <label for="fullname">Full name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="fullname" class="form-control" value="{{$user->name}}" placeholder="Enter fullname" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}" placeholder="Enter username" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" placeholder="Enter user email" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password </label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter user password" />
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="timezone">Choose User Timezone <span class="text-danger">*</span></label>
                                            <select name="time_zone_id" id="timezone" class="form-control s2s_timezone" required>
                                                <option value="" hidden selected disabled>--- Timezone ---</option>
                                                @foreach($timezones as $tz)
                                                    <option value="{{$tz->id}}" {{($tz->id == $user->time_zone_id) ? 'selected' : ''}}>
                                                        {{ucfirst($tz->name)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="box box-block bg-white">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>User Photo</h6>
                                                <input type="file" id="input-file-now" class="dropify" name="photo" accept="image/png, image/gif, image/jpeg"/>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </section>
                            <!-- SECTION 2 -->
                            <h2>
                                <span class="step-icon"><i class="ti-shield" ></i></span>
                                <span class="step-text">Roles & Permissions</span>
                            </h2>
                                <section>
                                <div class="inner">
                                    <div class="row" style="margin-bottom: 15px; ">
                                        <div class="col-md-12">
                                            <label for="roles">Choose Roles</label>
                                            <select name="roles" id="roles" class="form-control">
                                                <option value="" selected>--- Roles ---</option>
                                                @foreach($roles as $r)
                                                    <option value="{{$r->id}}" {{($r->id == @$user->roles[0]->id) ? 'selected' : ''}}>
                                                        {{ucfirst($r->name)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @foreach($permissions as $key => $p)
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <div class="font-weight-bold" style="font-size: 20px;"> {{ucfirst($key)}} </div>
                                            <div style="display:flex; justify-content: space-between; border-bottom:#00000033 solid 1px; margin-bottom: 15px;" class="px-2">
                                                @foreach($p as $key => $per)
                                                    <div>
                                                        <input type="checkbox" name="permissions[]" id="{{ $key }}"  class="form-check-input" value="{{ $key }}" {{(in_array($key,$has_permissions)) ? 'checked' : ''}}>
                                                        <label for="{{ $key }}">{{ ucfirst(explode("-",$per)[1]) }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </section>
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

    var form = $("#create-user-form");
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
