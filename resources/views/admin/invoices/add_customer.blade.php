  <!-- Change Status modal -->
  <div class="modal fade small-modal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="add_new_customer_modal" style="z-index: 100000;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Add New Customer</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name"> Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter customer name"
              required />
          </div>
          <div class="form-group">
            <label for="email"> Email</label>
            <input type="email" name="email" id="email" class="form-control"
              placeholder="Enter customer email" />
          </div>
          <div class="form-group">
            <label for="phone"> Phone</label>
            <input type="text" name="phone" id="phone" class="form-control"
              placeholder="Enter customer phone" />
          </div>
          <div class="modal-footer" style="text-align:center !important;">
            <button type="button" class="btn btn-primary btn-rounded" onclick="createNewCustomer()">Create</button>
            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
