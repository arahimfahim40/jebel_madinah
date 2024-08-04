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

    .form-register .steps ul {
      justify-content: center;
    }

    /* .actions {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */
    #create-invoice-form ul {
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

        <div class="wizard-v4-content w-100">
          <div class="wizard-form py-2 px-2">
            <h2 class="mb-1" style="text-align: center;">Add New Invoice</h2>
            <form id="create-invoice-form" class="form-register form-horizontal" method="POST"
              action="{{ route('invoices.store') }}" onsubmit="return validateForm()">
              @csrf
              <div>
                <h2 style="display: none;"></h2>
                <section style="padding: 10px;">
                  <div class="inner">
                    <div class="row">
                      <div class="col-md-12 px-0">
                        <div class="col-md-4 form-group">
                          <label class="required">Select Customer</label>
                          <select name="customer_id" class="form-control s2s_customers" required></select>
                        </div>
                        <div class="col-md-4 form-group">
                          <label class="required">Invoice Date</label>
                          <input type="date" name="invoice_date" placeholder="Invoice Date" class="form-control"
                            value="{{ old('invoice_date', now()->format('Y-m-d')) }}" required />
                        </div>
                        <div class="col-md-4 form-group">
                          <label>Due Date</label>
                          <input type="date" name="invoice_due_date" placeholder="Due Date" class="form-control" />
                        </div>
                      </div>
                      <div class="col-md-12 px-0">
                        <div class="col-md-4 form-group">
                          <label for="discount">Discount</label>
                          <div class="input-group">
                            <div class="input-group-addon">AED</div>
                            <input type="number" id="discount" name="discount" placeholder="Discount"
                              class="form-control" value="{{ old('discount', '') }}" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6 px-0">

                        <div class="col-md-12 form-group">
                          <label>Add Vehicles</label>
                          <div class="input-group">
                            <select id="vehicle-sold-price-select" class="form-control select2">
                              <option value="">--- Select Vehicle ---</option>
                              @foreach (@$vehicles as $item)
                                <option value="{{ $item->id }}" data-sold_price="{{ $item->sold_price }}"
                                  data-vin="{{ $item->vin }}"
                                  data-description="{{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }}">
                                  {{ $item->year }} {{ $item->make }} {{ $item->model }} {{ $item->color }} |
                                  {{ $item->vin }} | {{ $item->lot_number }}</option>
                              @endforeach
                            </select>
                            <span class="input-group-btn">
                              <button onclick="addNewVehicleSoldField(this)"
                                class="btn btn-success bootstrap-touchspin-up" type="button">
                                Add <i class="fa fa-plus"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                        <span id="vehicle-sold-price-list">
                          {{-- @foreach ([] as $charge)
                            <div class="form-group col-md-12">
                              <label for="{{ $charge->name }}">{{ $allCharges[$charge->name] }}</label>
                              <div class="input-group">
                                <div class="input-group-addon">Charge($)</div>
                                <input type="number" step="any" oninput="changeChargeInput(this)"
                                  name="vehicles[{{ $index }}][{{ $charge->name }}]" id="{{ $charge->name }}"
                                  value="{{ @$charge->value }}" class="vehicle_charges form-control"
                                  placeholder="{{ $allCharges[$charge->name] }}" />
                                <div class="input-group-addon">Cost($)</div>
                                <input type="number" step="any"
                                  name="vehicles[{{ $index }}][{{ $charge->name . '_cost' }}]"
                                  id="{{ $charge->name . '_cost' }}" value="{{ @$charge->cost_value }}"
                                  class="form-control" placeholder="{{ $allCharges[$charge->name] }} Cost" />
                              </div>
                            </div>
                          @endforeach --}}
                        </span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
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
    // Convert the keys to integers
    var vehicles = new Map(
      [...new Map(Object.entries(<?= json_encode($vehicles->toArray()) ?>)).entries()]
      .map(([key, value]) => [parseInt(key), value])
    );
    var selectedVehicleIds = [];

    form.children("div").steps({
      title: 'Add New Invoice',
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "fade",
      enableAllSteps: false,
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

    function validateForm() {
      if (selectedVehicleIds.size === 0) {
        alert('Please select at least one vehicle.');
        return false;
      }
      return true;
    }

    function onFormSubmit() {
      form.validate().settings.ignore = ":disabled";
      if (form.valid()) {
        form.submit();
      }
    }

    function addNewVehicleSoldField() {
      let select = $(`#vehicle-sold-price-select`);
      if (select.val() != '') {
        var fieldTitle = $(`#vehicle-sold-price-select option:selected`).data('description');
        var newField = $('<div>', {
          class: `form-group col-md-12 vehicle-field-${select.val()}`
        }).append(
          $('<label>', {
            for: select.val(),
            text: fieldTitle
          }),
          $('<div>', {
            class: 'input-group'
          }).append(
            $('<div>', {
              class: 'input-group-addon',
              text: 'Sold Price (AED)'
            }),
            $('<input>', {
              type: 'number',
              step: 'any',
              name: `vehicles[${select.val()}]`,
              class: 'vehicle_charges form-control',
              placeholder: 'Enter Vehicle Sold Price',
              value: select.data('sold_price')
            }),
            $('<span>', {
              class: 'input-group-btn',
              text: 'Cost($)'
            }).append(
              $('<button>', {
                onclick: `removeVehicleSoldField(${select.val()})`,
                type: "button",
                class: "btn btn-danger bootstrap-touchspin-up",
              })
              .append(
                $('<i>', {
                  class: 'fa fa-trash' // Replace with the appropriate icon class
                })
              )
            )
            // $('<input>', {
            //   type: 'number',
            //   step: 'any',
            //   name: `vehicles[${select.val()}_cost]`,
            //   class: 'form-control',
            //   placeholder: fieldTitle + ' Cost'
            // })
          )
        );
        selectedVehicleIds.push(select.val());

        $(`#vehicle-sold-price-list`).append(newField);
        $(`#vehicle-sold-price-select option[value="${select.val()}"]`).remove();
      }
    }

    function removeVehicleSoldField(id) {
      let select = $(`#vehicle-sold-price-select`);
      $(`.vehicle-field-${id}`).remove();
      selectedVehicleIds.pop(id);

      // Find the object by id and set a new field
      var vehicle = [...vehicles.values()].find(v => v.id == id);
      select.append(
        `<option data-sold_price="${vehicle.sold_price}"
          data-vin="${vehicle.vin}"
          data-description="${vehicle.year} ${vehicle.make} ${vehicle.model} ${vehicle.color}"
          value="${vehicle.id}">${vehicle.year} ${vehicle.make} ${vehicle.model} ${vehicle.color} | ${vehicle.vin} | ${vehicle.lot_number}
        </option>`
      );
    }

  </script>
@endpush
