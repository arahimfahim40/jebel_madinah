<link rel="stylesheet" href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">

<style>
  * {
    box-sizing: border-box;
  }

  table,
  tr {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  .th1,
  .td1 {
    border: 1px solid #0a0a0a;
    text-align: left;
    padding: 5px;
    border-collapse: collapse !important;
  }

  #tr1:nth-child(even) {
    background-color: #dddddd;
  }

  #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    font-size: 14px;
    padding: 5px !important;
  }

  .no-border {
    border: none !important;
  }

  #payments-section {
    /* display: none; */
    /* Hide the payments section by default */
  }
</style>
<div class="container" style="width: 190mm; margin: auto;">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12 col-md-offset-1 ">
        <div style="width: 100%; text-align: center;">
          <img src="data:image/png;base64,{!! base64_encode(file_get_contents(public_path('img/logo.png'))) !!}" height="140px">
          <div style=" font-size:20px;font-weight:bold; text-align:center">
            Tax Invoice
          </div>
          <div style="margin-top: 4px; text-align:center">
            <span style="font-size: 12px; font-weight: bold;">
              TRN: <span>******************</span>
            </span>
          </div>

        </div>

        <table
          style="background-color: #f5f8f8; color: black; width: 100%; margin-top: 6px; margin-bottom: 8px; border-radius: 4px;"
          id="print_content">
          <tbody>
            <tr>
              <td colspan="3">
                <table>
                  <tr>
                    <td>Customer</td>
                    <td>: <strong>{{ @$invoice->customer->name }}</strong></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td>: <strong>{{ @$invoice->customer->phone }}</strong></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>: <strong>Dubai U.A.E</strong></td>
                  </tr>
                </table>
              </td>
              <td colspan="2">
                <table style="text-align:left; width: 100%;">
                  <tr>
                    <td>Invoice No</td>
                    <td>: <strong style="color: red;">{{ 'JAM' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </td>
                  </tr>
                  <tr>
                    <td>Invoice Date</td>
                    <td>: <strong>{{ date('Y-m-d', strtotime(@$invoice->invoice_date)) }}</strong>
                    </td>
                  </tr>
                  <tr>
                    <td>Due Balance</td>
                    <td>: <strong>@money($invoice->vehicles->sum('sold_price') - $invoice->discount - $invoice->payments->sum('payment_amount'))</th< /strong>
                    </td>
                  </tr>
                </table>
              </td>
              {{-- <td colspan="2">
                <table dir="rtl" style="text-align:right; width: 100%;">
                  <tr>
                    <td>مشتری</td>
                    <td>: <strong>{{ @$invoice->customer->name }}</strong></td>
                  </tr>
                  <tr>
                    <td>المتحرک</td>
                    <td>: <strong>{{ @$invoice->customer->phone }}</strong></td>
                  </tr>
                  <tr>
                    <td>العنوان</td>
                    <td>: <strong>Dubai U.A.E</strong></td>
                  </tr>
                </table>
              </td> --}}
            </tr>
          </tbody>
        </table>
        <div id="yoba">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th class="th1">#</th>
                <th class="th1">Vehicle Description</th>
                <th class="th1">Amount</th>
                <th class="th1">Sub Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoice->vehicles as $key => $vehicle)
                <tr style="width: 70mm;">
                  <td class="td1">{{ $key + 1 }}</td>
                  <td class="td1">
                    <strong>{{ @$vehicle->year . ' ' . @$vehicle->make . ' ' . @$vehicle->model . ' ' . @$vehicle->color }}</strong>
                    <br>
                    VIN: <strong>{{ @$vehicle->vin }}</strong>
                    <br>
                    Lot#: <strong>{{ @$vehicle->lot_number }}</strong>
                  </td>
                  <td class="td1">@money($vehicle->sold_price)</td>
                  <td class="td1">@money($vehicle->sold_price)</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="no-border" style="border: none !important;"></td>
                <td class="td1" colspan="2">
                  <div style="clear: both;">
                    <span style="float: left;"> Sub Total</span>
                    <span style="font-weight: bold; float: right;">
                      @money(@$invoice->vehicles->sum('sold_price'))
                    </span>
                  </div>
                  @if ($invoice->discount > 0)
                    <div style="clear: both;">
                      <span style="float: left;">Discount</span>
                      <span style="font-weight: bold; float: right;">
                        -@money(@$invoice->discount)
                      </span>
                    </div>
                  @endif
                  <div style="clear: both;">
                    <span style="float: left;">Total</span>
                    <span style="font-weight: bold; float: right;">
                      @money(@$invoice->vehicles->sum('sold_price') - @$invoice->discount)
                    </span>
                  </div>
                  <div style="clear: both;"></div>
                </td>
              </tr>
            </tfoot>
          </table>

          @if (count($invoice->payments) > 0)
            <div id="payments-section" style="margin: 10px 0;">
              <div style="text-align: left; font-weight: bold; margin: 5px 0;">Payments</div>
              <table class="table table-bordered" width="100%">
                <tbody>
                  <tr>
                    <th class="td1">#</th>
                    <th class="td1">Payment Amount</th>
                    <th class="td1">Date</th>
                    <th class="td1">Description</th>
                    <th class="td1">Link</th>
                  </tr>
                  @foreach ($invoice->payments as $key => $payment)
                    <tr>
                      <td class="td1">{{ $key + 1 }}</td>

                      <td class="td1">@money(@$payment->payment_amount)
                      </td>
                      <td class="td1" style="text-align:right;">{{ $payment->payment_date }}</td>

                      <td class="td1" style="max-width: 150px;">
                        {{ $payment->description }}
                      </td>
                      <td class="td1" style="text-align:right;">
                        <a href="{{ $payment->evidence_link }}" target="_blank" style="cursor: pointer;"
                          class="btn btn-info btn-circle btn-sm waves-effect waves-light">
                          view evidence
                        </a>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <th class="td1" colspan="2">Total Paid</th>
                    <th style="text-align:right;" class="td1">@money($invoice->payments->sum('payment_amount'))</th>
                    <th class="td1">Due Balance</th>
                    <th style="text-align:right;" class="td1">@money($invoice->vehicles->sum('sold_price') - $invoice->discount - $invoice->payments->sum('payment_amount'))</th>
                  </tr>
                </tbody>
              </table>
            </div>
          @endif

          <table width="100%" style="margin-top: 15px;">
            <tbody>
              @if ($invoice->description)
                <tr style="background-color: #f5f8f8; color: black;">
                  <th
                    style="padding-left:10px; padding-right:10px; width:100%; padding-top: 10px; padding-bottom: 5px;">
                    <span style="text-align:left;">Additional Note
                      : {{ $invoice->description }}
                    </span>
                  </th>
                </tr>
              @endif
              <tr style="background-color: #f5f8f8; color: black;">
                <td
                  style="padding-left:35% !important; width:100% !important; padding-top: 10px !important; padding-bottom: 10px !important;">
                  <b>Wire Transfer Information:</b><br>
                  Account Name: Jabal AL Madinah <br />
                  Account Number: ********** <br />
                  Currency: <br />
                  BIC Code: <br />
                  IBAN: <br />
                  Bank Name : Bank Name <br />
                </td>
              </tr>
            </tbody>
          </table>
          {{-- <table width="100%">
            <tbody>
              <tr>
                <th style="background-color: #f5f8f8;">Phone: <br>
                  M Phone
                </th>
                <th style="background-color: #f5f8f8;">Fax:
                  <br>N Fax
                </th>
                <th style="background-color: #f5f8f8;">
                  Website:<br>O Web</th>
                <th style="background-color: #f5f8f8;">
                  Facebook:<br>P Fb</th>
              </tr>
            </tbody>
          </table> --}}
        </div>
      </div>
    </div>
  </div>
</div>
