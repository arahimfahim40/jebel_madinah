@extends('admin.layout.main')
@section('title', 'Roles')
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
    .view-role .steps ul{
        justify-content: center;
    }

    .view-role .content {
        box-shadow:none;
    }
    /* .actions {
        display: none;
    } */
    #view-role ul {
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
                    <h2 class="mb-1" style="text-align: center;">Roles Detail</h2>
                    <div id="view-role" class="px-3">
                        <section>
                            <div class="inner">
                                <div class="row pt-3 pb-1">
                                    <div class="col-md-3 font-weight-bold">Role</div>
                                    <div class="col-md-6">{{ $role->name }}</div>
                                </div>
                               
                                <div class="row py-2">
                                    <div class="col-md-3 font-weight-bold"> Permissions </div>
                                    <div class="col-md-9"> 
                                        <div style="display:flex; justify-content: space-between;">
                                            @foreach($role->permissions as $p)
                                                <div> {{ $p->name }} </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div style="display:flex; justify-content: space-between; border-top:1px solid gray;" class="pt-2">
                                            <a href="{{ route('role.index') }}" class="btn btn-secondary btn-outline-warning " style="height: 33px; margin-top:-5px;">
                                                <i class="fa fa fa-arrow-left"></i> Back To List
                                            </a>
                                            <a href="{{ route('role.edit',$role->id)  }}" class="btn btn-secondary btn-outline-info " style="height: 33px; margin-top:-5px;">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
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
    var form = $("#view-role");
    form.children("div").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        
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