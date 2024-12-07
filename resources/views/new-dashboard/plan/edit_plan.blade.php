@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Create Edit')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Basic with Icons -->
  <div class="col-xxl">
        <div class="card mb-6">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Plan</h5>
            {{-- <small class="text-muted float-end">Merged input group</small> --}}
          </div>
          <div class="card-body">
            <form action="{{route('plans.update', $plan)}}" method="POST" id="create_user">
              @csrf
              @method('PUT')
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Plan Name</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-purchase-tag'></i></span>
                    <input name="name" value="{{$plan->name}}" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                  </div>
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Description</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-detail"></i></span>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type More Information Here ...">{{$plan->description}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Price</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class='bx bx-money'></i></span>
                    <input min="1" value="{{$plan->price}}" type="number" class="form-control" id="inputNumberofmembers" name="price" placeholder="$30">
                  </div>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Period</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class='bx bxs-calendar-alt' ></i></span>
                    <input min="30" value="{{$plan->period}}" type="number" class="form-control" id="inputNumberofmembers" name="period" placeholder="90 Days">
                  </div>
                </div>
              </div>


              <div class="row mb-6">
                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Plan Type</label>
                <div class="col-sm-10">
                    <select name="plan_type_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Open To Select A Plan Type</option>
                        @foreach ($plan_types as $plan_type)
                        <option {{$plan_type->id == $plan->planType->id ? 'selected' : ''}} value="{{$plan_type->id}}">{{$plan_type->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              
            <div class="row mb-6">  
              <div class="col-sm-4 d-flex align-items-center mt-3">
                <div class="form-check me-2">
                    <input class="form-check-input" type="radio" name="with_trainer" {{$plan->with_trainer == 1 ? 'checked' : ''}} value="1" id="with_trainer_yes" {{ request('with_trainer') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="with_trainer_yes">
                        With Trainer
                    </label>
                </div>
                <div class="form-check me-2">
                    <input class="form-check-input" type="radio" name="with_trainer" {{$plan->with_trainer == 0 ? 'checked' : ''}} value="0" id="with_trainer_no" {{ request('with_trainer') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="with_trainer_no">
                        Without Trainer
                    </label>
                </div>
              </div>
            </div>

                <input type="hidden" name="redirect_to" id="redirect_to" value="">
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" id = "submit_redirect_index" class="btn btn-primary">Edit</button>
                  <a href="{{route('plans.index')}}" class="btn btn-light">Cancel</a>
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