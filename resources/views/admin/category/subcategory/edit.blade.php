 <form action="{{ route('subcategory.update') }}" method="Post">
      	@csrf
      <div class="modal-body">
           <div class="form-group">
            <label for="category_name">Category Name</label>
            <select class="form-control" name="category_id" required="">
            	@foreach($category as $row)
            	  <option value="{{ $row->id }}" @if($row->id==$data->category_id) selected="" @endif >{{ $row->category_name }}</option>
            	@endforeach
            </select>
            <input type="hidden" name="id" value="{{ $data->id }}">
          </div>
          <div class="form-group">
            <label for="category_name">SubCategory Name</label>
            <input type="text" class="form-control"  name="subcategory_name" value="{{ $data->subcategory_name }}" required="">
            <small id="emailHelp" class="form-text text-muted">This is your sub category</small>
          </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
      </div>
</form>