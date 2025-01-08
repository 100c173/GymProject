@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Edit Permission')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Basic with Icons -->
  <div class="col-xxl">
        <div class="card mb-6">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Create New Permission</h5>
            {{-- <small class="text-muted float-end">Merged input group</small> --}}
          </div>
          <div class="card-body">
            <form action="{{route('permissions.update', $permission)}}" method="POST" id="create_session">
                @method('PUT')
                @csrf
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Permission Name</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxl-sketch'></i></span>
                    <input name="name" value="{{$permission->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="create-user" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                  </div>
                </div>
              </div>
        
                <input type="hidden" name="redirect_to" id="redirect_to" value="">
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" id = "submit_redirect_index" class="btn btn-primary">Edit</button>
                  <a href="{{route('permissions.index')}}" class="btn btn-light">Cancel</a>
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