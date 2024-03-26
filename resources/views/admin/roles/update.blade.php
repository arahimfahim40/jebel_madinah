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
    .view-user .steps ul{
        justify-content: center;
    }

    .view-user .content {
        box-shadow:none;
    }
    /* .actions {
        display: none;
    } */
    #create-role ul {
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
                    <h2 class="mb-1" style="text-align: center;">Update Role</h2>
                    <form id="create-role" class="px-3" action="{{ route('roles.update',$role->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <section>
                            <div class="inner">
                                <div class="form-group">
                                    <label for="role">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" name="role" id="role" class="form-control" value="{{$role->name}}" placeholder="Enter role name" required/>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col-md-12"> <h4>Permissions</h4></div>  
                                </div>
                                @foreach($permissions as $key => $p)
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="font-weight-bold" style="font-size: 15px;"> {{ucfirst($key)}} </div>
                                        <div style="display:flex; justify-content: space-between; border-bottom:#00000033 solid 1px; margin-bottom: 15px;" class="px-2">
                                            @foreach($p as $key => $per)
                                                <div>
                                                    <input type="checkbox" name="permissions[]" id="{{ $key }}"  class="form-check-input" value="{{ $key }}" {{(in_array($key,$has_permissions)) ? 'checked' : ''}} >
                                                    <label for="{{ $key }}">{{ ucfirst(explode("-",$per)[1]) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach  
                                
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-success btn-rounded" style="float:right; margin-left:5px;">
                                            <i class="fa fa-plus"></i> Save
                                        </button>
                                        <button type="button" class="btn btn-danger btn-rounded" style="float:right;">
                                            <i class="fa fa-times"></i> Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
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
    var form = $("#create-role");
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