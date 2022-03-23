
    <form action="{{ route('blog.category.update') }}" method="Post" >
      	@csrf
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $data->category_name }}" required="">
          </div> 
          <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
      </div>
   </form>
