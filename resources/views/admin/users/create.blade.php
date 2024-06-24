@extends('admin.layout.main')
@section('title', 'Users')
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
                    <h2 class="mb-1" style="text-align: center;">Add New User</h2>
                    <form id="create-user-form" class="form-register form-horizontal" method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="px-4">
                            <h2>
                                <span class="step-icon"><i class="ti-user"></i></span>
                                <span class="step-text">User Information</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <div class="form-group">
                                        <label for="fullname">Full name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="fullname" class="form-control" value="{{old('name')}}" placeholder="Enter fullname" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}" placeholder="Enter username" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Enter user email" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" minlength="6" value="{{old('password')}}" placeholder="Enter user password" required />
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="status"> Status <span class="text-danger">*</span></label>
                                            <select name="status" id='status' class="form-control" >
                                                <option value="Active" selected>Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="timezone">Choose User Timezone <span class="text-danger">*</span></label>
                                            <select name="time_zone_id" id="timezone" class="form-control s2s_timezone" required>
                                                <option value="" hidden selected disabled>--- Timezone ---</option>
                                                @foreach($timezones as $tz)
                                                    <option value="{{$tz->id}}" {{($tz->id == old('time_zone_id')) ? 'selected' : ''}}>
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
                                <span class="step-text">Permissions</span>
                            </h2>
                                <section>
                                <div class="inner">
                                    <div class="row" style="margin-bottom: 15px; ">
                                        <div class="col-md-12">
                                            <label for="roles">Choose Roles</label>
                                            <select name="roles" id="roles" class="form-control">
                                                <option value="" hidden selected disabled>--- Roles ---</option>
                                                @foreach($roles as $r)
                                                    <option value="{{$r->id}}" {{($r->id == old('roles')) ? 'selected' : ''}}>
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
                                                        <input type="checkbox" name="permissions[]" id="{{ $key }}" class="form-check-input" value="{{ $key }}"  {{ in_array($key, old('permissions', [])) ? 'checked' : '' }}>
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
