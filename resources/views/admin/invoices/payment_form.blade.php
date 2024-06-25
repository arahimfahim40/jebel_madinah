<!-- Edit installment modal -->
<div class="modal fade large-modal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="payment_form_modal">
  <div class="modal-dialog">
    <form class="form" id="payment_form" method="POST">
      @csrf
      <div class="modal-content">
        <div id="edit-page-loading"></div>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Payment Form</h4>
        </div>
        <div class="row">
          <div class="col-md-12 pt-1">
            <div class="mx-2 alert alert-danger" id="edit-form-dismissable-alerts" style="display: none;">
              <strong>Error! </strong> <span id="error-message"></span>
            </div>
          </div>
          <input type="hidden" name="invoice_id" id="invoice_id" class="form-control" required />
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <span class="main"><label for="payment_amount">Payment Amount(DH)</label>&nbsp;<span class="text-danger">*</span></span>
                <input type="number" step=".01" name="payment_amount" id="payment_amount" class="form-control" required />
                <span id="payment_amount" style="color: red;font-weight: bold;"></span>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="discount">Discount</label>
              <div class="input-group">
                <div class="input-group-addon currency-type">AED</div>
                <input type="number"
                  step="any"
                  name="discount"
                  id="discount" 
                  value="0"
                  class="form-control"
                  placeholder="Discount"
                />
              </div>
          </div>
            <div class="col-md-6">
              <div class="form-group">
                <span class="main"><label for="payment_date">Payment Date</label>&nbsp;<span class="text-danger">*</span></span>
                <input type="date" value="{{now()->format('Y-m-d')}}" name="payment_date" id="payment_date" class="form-control" required />
                <span id="payment_date" style="color: red;font-weight: bold;"></span>
              </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Evidence Link</label>
                <input type="text" class="form-control" name="evidence_link" id="evidence_link">
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <span class="main"><label for="payment_description">Description</label>&nbsp;</span>
                <textarea name="payment_description" id="payment_description" cols="70" rows="5" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-rounded label-left float-xs-left">
            <span class="btn-label"><i class="ti-save"></i></span>
            Save
          </button>
          <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>