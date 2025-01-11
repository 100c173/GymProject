
@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Edit Equipment')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Basic with Icons -->
  <div class="col-xxl">
        <div class="card mb-6">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Sport Equipment</h5>
            {{-- <small class="text-muted float-end">Merged input group</small> --}}
          </div>
          <div class="card-body">
            <form action="{{route('equipments.update', $equipment)}}" method="POST" id="create_session" enctype="multipart/form-data">
              @csrf
                @method('PUT')

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Equipment Name</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-dumbbell"></i></span>
                    <input name="name" value="{{$equipment->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                  </div>
                </div>
              </div>
              
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Brand</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxl-sketch'></i></span>
                    <input name="brand" value="{{$equipment->brand}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Description</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-detail"></i></span>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type More Information Here ...">{{$equipment->description}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="equipment_status" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option {{$equipment->equipment_status == 'available'? 'selected' : ''}} value="available">available</option>
                        <option {{$equipment->equipment_status == 'damaged'? 'selected' : ''}} value="damaged">damaged</option>
                        <option {{$equipment->equipment_status == 'under maintenance'? 'selected' : ''}} value="under maintenance">under maintenance</option>
                    </select>
                </div>
              </div>

              <div class="row mb-6">
                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Upload Image</label>
                <div class="col-sm-10">
                    <input name="image_path" class="form-control" type="file" id="formFile">
                </div>
              </div>

              <input type="hidden" name="current_image_path" value="{{ $equipment->image_path }}">
                <input type="hidden" name="redirect_to" id="redirect_to" value="">

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" id = "submit_redirect_index" class="btn btn-primary">Edit</button>
                  <a href="{{url()->previous()}}" class="btn btn-light">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
  
<script>
  document.getElementById('submit_redirect_index').addEventListener('click', function(event) {
      document.getElementById('redirect_to').value = 'index';
      document.getElementById('create_user').submit();
  });
  document.getElementById('submit_redirect_create').addEventListener('click', function(event) {
      document.getElementById('redirect_to').value = 'create';
      document.getElementById('create_user').submit();
  });
</script>
@endsection