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
    #create-invoice-form ul {
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
                    <h2 class="mb-1" style="text-align: center;">Add New Invoice</h2>
                    <form id="create-invoice-form" class="form-register form-horizontal" method="POST" action="{{ route('invoices.store')}}">
                        @csrf
                        <div>
                            <h2>
                                <span class="step-icon"><i class="ti-receipt"></i></span>
                                <span class="step-text">Invoice Details</span>
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
                                                /></select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Status</label>
                                                <select name="status"
                                                    class="form-control"
                                                >
                                                    <option value="">-- Select Status --</option>
                                                    <option value="open">Open</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="past_due">Past Due</option>
                                                    <option value="paid">paid</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-12 form-group">
                                                <label >Discount</label>
                                                <input 
                                                    type="number" 
                                                    name="discount" 
                                                    placeholder="Discount" 
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label class="required">Exchange Rate</label>
                                                <input 
                                                    type="number" 
                                                    name="exchange_rate"   
                                                    placeholder="Exchange Rate"
                                                    class="form-control"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-0">
                                            <div class="col-md-12 form-group">
                                                <label>Move To Open Date</label>
                                                <input type="date" 
                                                    name="move_to_open_date"   
                                                    placeholder="Move To Open Date"
                                                    class="form-control"
                                                    required
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Invoice Date</label>
                                                <input type="date" 
                                                    name="invoice_date"   
                                                    placeholder="Invoice Date"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Due Date</label>
                                                <input type="date" 
                                                    name="invoice_due_date"   
                                                    placeholder="Due Date"
                                                    class="form-control"
                                                />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" placeholder="Description" rows="6" class="form-control"></textarea>
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

    var form = $("#create-invoice-form");
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
