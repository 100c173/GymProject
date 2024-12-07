@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Create Time')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Basic with Icons -->
  <div class="col-xxl">
        <div class="card mb-6">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Create New Time</h5>
            {{-- <small class="text-muted float-end">Merged input group</small> --}}
          </div>
          <div class="card-body">
            <form action="{{route('times.store')}}" method="POST" id="create_time">
              @csrf

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Date</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input name="day" class="form-control" type="date" id="html5-date-input"/>
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Start Time</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input name="start_time" class="form-control" type="time" id="html5-time-input" />
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">End Time</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input name="end_time" class="form-control" type="time" id="html5-time-input" />
                  </div>
                </div>
              </div>
              
                <input type="hidden" name="redirect_to" id="redirect_to" value="">
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" id = "submit_redirect_index" class="btn btn-primary">Create</button>
                  <button type="submit" id="submit_redirect_create" class="btn btn-light">Create & Create Another one</button>
                  <a href="{{route('times.index')}}" class="btn btn-light">Cancel</a>
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