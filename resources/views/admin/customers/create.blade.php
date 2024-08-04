@extends('admin.layout.main')
@section('title', 'Customers')
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

    .view-customer.steps ul {
      justify-content: center;
    }

    .view-customer .content {
      box-shadow: none;
    }

    /* .actions {
                display: none;
            } */
    #create-customer ul {
      margin-bottom: 0px;
      margin-right: 200px;
      margin-left: 200px;
    }

    .error {
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
            <h2 class="mb-1" style="text-align: center;">Create Customer</h2>
            <form id="create-customer" class="px-3" action="{{ route('customers.store') }}" method="post">
              @csrf
              <section>
                <div class="inner">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name"> Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                          value="{{ old('name') }}" placeholder="Enter customer name" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address"> Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                          value="{{ old('address') }}" placeholder="Enter customer address" />
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender"> Gender</label>
                        <select name="gender" id='gender' class="form-control">
                          <option value="" disabled selected> ----Gender----</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="status"> Status <span class="text-danger">*</span></label>
                        <select name="status" id='status' class="form-control">
                          <option value="" disabled selected> ----Status----</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email"> Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                          value="{{ old('email') }}" placeholder="Enter customer email" />
                      </div>

                      {{-- <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" minlength="6" value="{{old('password')}}" placeholder="Enter customer password" required />
                      </div> --}}
                      <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                          value="{{ old('phone') }}" placeholder="Enter customer phone" />
                      </div>
                      <div class="form-group">
                        <label for="join_date"> Join Date</label>
                        <input type="date" name="join_date" id="join_date" class="form-control"
                          value="{{ old('join_date', '') }}" placeholder="Join Date" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="second_email"> Second Email</label>
                        <input type="email" name="second_email" id="second_email" class="form-control"
                          value="{{ old('second_email') }}" placeholder="Enter customer second email" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="second_phone"> Second Phone </label>
                        <input type="text" name="second_phone" id="second_phone" class="form-control"
                          value="{{ old('second_phone') }}" placeholder="Enter customer second phone" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="about"> About </label>
                    <textarea name="about" id="about" class="form-control" placeholder="About customer"> {{ old('about') }} </textarea>
                  </div>
                  <!-- <div class="box box-block bg-white">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Customer Photo</h6>
                                                    <input type="file" id="input-file-now" class="dropify" name="photo" accept="image/png, image/gif, image/jpeg"/>
                                                </div>
                                            </div>
                                        </div> -->

                  <div class="row mt-2">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success btn-rounded" style="float:right; margin-left:5px;">
                        <i class="fa fa-plus"></i> Save
                      </button>
                      <a href="{{ route('customers.index') }}" class="btn btn-danger btn-rounded"
                        style="float:right;">
                        <i class="fa fa-times"></i> Cancel
                      </a>
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
    var form = $("#create-customer");
    form.children("div").steps({
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "fade",
      enableAllSteps: true,
      autoFocus: true,
      transitionEffectSpeed: 500,
      titleTemplate: '<div class="title">#title#</div>',
      labels: {
        previous: 'Back',
        next: 'Next',
        finish: 'Submit',
        current: 'Save'
      },
      onStepChanging: function(event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
      },
      onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
      },
      onFinished: function(event, currentIndex) {
        // alert("Submitted!");
        form.submit();
      }
    });

    function onFormSubmit() {
      form.validate().settings.ignore = ":disabled";
      if (form.valid()) {
        form.submit();
      }
    }
  </script>
@endpush
