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

    .form-register .steps ul {
      justify-content: center;
    }

    /* .actions {
                                                                                                                                                  display: none;
                                                                                                                                              } */
    #create-vehicle-form ul {
      margin-bottom: 0px;
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
      <div class="container-fluid">

        @include('errors')
        @php
          $customer_name = old('customer_id', '') ? DB::table('customers')->find(old('customer_id', ''))->name : '';
        @endphp

        <div class="wizard-v4-content w-100">
          <div class="wizard-form py-2">
            <h2 class="mb-1" style="text-align: center;">Add New Vehicle</h2>
            <form id="create-vehicle-form" class="form-register form-horizontal" method="POST"
              action="{{ route('vehicles.store') }}">
              @csrf
              <div>
                {{-- Section 1 --}}
                <h2>
                  <span class="step-icon"><i class="fa fa-car"></i></span>
                  <span class="step-text">Vehicle Info</span>
                </h2>
                <section>
                  <div class="inner">
                    <div class="row">
                      <div class="col-md-4 px-0">
                        <div class="col-md-12 form-group">
                          <label>Year</label>
                          <input type="number" name="year" placeholder="Year" class="form-control"
                            value="{{ old('year', '') }}" />
                        </div>

                        <div class="col-md-12 form-group">
                          <label>Make</label>
                          <input type="text" name="make" placeholder="Make" class="form-control"
                            value="{{ old('make', '') }}" />
                        </div>
                        <div class="col-md-12 form-group">
                          <label>Model</label>
                          <input type="text" name="model" placeholder="Model" class="form-control"
                            value="{{ old('model', '') }}" />
                        </div>
                        <div class="col-md-12 form-group">
                          <label>Color</label>
                          <input type="text" name="color" placeholder="Color" class="form-control"
                            value="{{ old('color', '') }}" />
                        </div>
                      </div>
                      <div class="col-md-4 px-0">
                        <div class="col-md-12 form-group">
                          <label class="required">Vehicle Owner</label>
                          <select name="owner_id" class="form-control" required>
                            <option value="">-- Select Owner --</option>
                            @foreach (@getOwners() as $owner)
                              <option value="{{ $owner->id }}"
                                {{ old('owner_id', '') == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-12 form-group">
                          <label class="required">Vin#</label>
                          <input type="text" name="vin" placeholder="Vin" class="form-control"
                            value="{{ old('vin', '') }}" required />
                        </div>
                        <div class="col-md-12 form-group">
                          <label class="required">Lot Number</label>
                          <input type="text" name="lot_number" placeholder="Lot Number" class="form-control"
                            value="{{ old('lot_number', '') }}" required />
                        </div>
                        <div class="col-md-12 form-group">
                          <label>Container Number</label>
                          <input type="text" name="container_number" placeholder="Container Number"
                            class="form-control" value="{{ old('container_number', '') }}" />
                        </div>

                      </div>

                      <div class="col-md-4 px-0">
                        <div class="col-md-12 form-group">
                          <label>Auction Name</label>
                          <select name="auction_name" class="form-control">
                            <option value="">-- Select Auction --</option>
                            <option value="Copart" {{ old('auction_name', '') == 'Copart' ? 'selected' : '' }}>
                              Copart
                            </option>
                            <option value="IAAI" {{ old('auction_name', '') == 'IAAI' ? 'selected' : '' }}>
                              IAAI
                            </option>
                          </select>
                        </div>
                        <div class="col-md-12 form-group">
                          <label>Buyer Number</label>
                          <input type="text" name="buyer_number" placeholder="Buyer Number" class="form-control"
                            value="{{ old('buyer_number', '') }}" />
                        </div>
                        <div class="col-md-12 form-group">
                          <label>Created at</label>
                          <input type="date" name="created_at" placeholder="Created at" value="{{ date('Y-m-d') }}"
                            class="form-control" disabled />
                        </div>
                        @if (auth()->id())
                          <div class="col-md-12 form-group">
                            <label>Created By</label>
                            <input type="text" name="created_by" placeholder="Created By"
                              value="{{ auth()->user()?->name }}" class="form-control" disabled />
                          </div>
                        @endif
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Note</label>
                          <textarea name="note" placeholder="Note" rows="5" class="form-control">{{ old('note', '') }}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- SECTION 2 -->
                <h2>
                  <span class="step-icon"><i class="fa fa-money"></i></span>
                  <span class="step-text">Costs & Sold Price</span>
                </h2>

                <section>
                  <div class="inner">
                    <div class="row">
                      <div class="col-md-8 px-0">
                        <h4 class="mx-1">Vehicle Costs on Jabal AL Madinah</h4>
                        <hr class="mx-1" />
                        <div class="col-md-6 px-0">

                          <div class="col-md-12 form-group">
                            <label>Vehicle Price</label>
                            <input type="number" name="vehicle_price" placeholder="Vehicle Price"
                              class="form-control" value="{{ old('vehicle_price', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Towing Cost</label>
                            <input type="number" name="towing_cost" placeholder="Towing Cost" class="form-control"
                              value="{{ old('towing_cost', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Clearance Cost</label>
                            <input type="number" name="clearance_cost" placeholder="Clearance Cost"
                              class="form-control" value="{{ old('clearance_cost', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Ship Cost</label>
                            <input type="number" name="ship_cost" placeholder="Ship Cost" class="form-control"
                              value="{{ old('ship_cost', '') }}" />
                          </div>
                        </div>
                        <div class="col-md-6 px-0">
                          <div class="col-md-12 form-group">
                            <label>Storage Cost</label>
                            <input type="number" name="storage_cost" placeholder="Storage Cost" class="form-control"
                              value="{{ old('storage_cost', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Custom Cost</label>
                            <input type="number" name="custom_cost" placeholder="Custom Cost" class="form-control"
                              value="{{ old('custom_cost', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>TDS Cost</label>
                            <input type="number" name="tds_cost" placeholder="TDS Cost" class="form-control"
                              value="{{ old('tds_cost', '') }}" />
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Other Cost</label>
                            <input type="number" name="other_cost" placeholder="Other Cost" class="form-control"
                              value="{{ old('other_cost', '') }}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 px-0">
                        <h4 class="px-1">Vehicle Sold Price</h4>
                        <hr class="mx-1" />
                        <div class="col-md-12 form-group">
                          <label>Sold Price</label>
                          <input type="number" name="sold_price" placeholder="Sold Price" class="form-control"
                            value="{{ old('sold_price', '') }}" />
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <label for="invoice_description">Invoice Description</label>
                        <textarea name="invoice_description" placeholder="Invoice Description" rows="6" class="form-control">{{ old('invoice_description', '') }}</textarea>
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
    var form = $("#create-vehicle-form");
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
