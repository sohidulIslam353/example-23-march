

     <form action="{{ route('warehouse.update') }}"  method="Post" id="add-form">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input type="text" class="form-control"  name="warehouse_name" required="" value="{{ $warehouse->warehouse_name }}">
          </div>   
          <input type="hidden" name="id" value="{{ $warehouse->id }}">

          <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <input type="text" class="form-control"  name="warehouse_address" required="" value="{{ $warehouse->warehouse_address }}">
          </div>   

          <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input type="text" class="form-control"  name="warehouse_phone" required="" value="{{ $warehouse->warehouse_phone }}">
          </div>   
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Update </span> </button>
      </div>
      </form>
   
  