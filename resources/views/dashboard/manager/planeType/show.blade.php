@extends('/dashboard/manager/layout')
@section('content')
<div class="container d-flex justify-content-between">
    <div class="container-fluid px-4">
    <!--Section: Content-->
   <section class="text-center">
  <h4 class="mb-4 mt-5"><strong>{{$plan_type->name}}</strong></h4>
  <div data-mdb-ripple-init class="btn-group mb-4" role="group" aria-label="Basic example">
    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark active">Latest Plans</button>
    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light">
        Count of Plans related with <small>({{$plan_type->Plan->count() ?? 'Nothing Related'}})</small>
    </button>
  </div>
</section>

<div class="row">
    @foreach ($plan_type->Plan as $plan)
  <div class="col-md-3">
    <div class="card mb-4">
      <div class="mx-2 card-body">
        <h5 class="card-title my-2 ">{{$plan->name}}</h5>
        <p class="text-muted mb-2">
          {{$plan->description}}
        </p>
        <p class="h2 fw-bold">${{$plan->price}}<small class="text-muted" style="font-size: 18px;">/{{$plan->period}}<small>days</small></small></p>
        <a href="{{route('plans.show',$plan)}}" data-mdb-ripple-init class="btn btn-dark d-block mb-2 mt-3 text-capitalize">Show</a>
      </div>
      <div class="card-footer">
        <p class="text-uppercase fw-bold" style="font-size: 12px;">What's included</p>
        <ol class="list-unstyled mb-0 px-4">
          <p class="my-3 fw-bold text-muted text-center">
          </p>
          @if ($plan->with_trainer)
          <li class="mb-3">
            <i class="fas fa-check text-success me-3"></i><small>Lorem Ipsum</small>
          </li>
          @else
          <li class="mb-3">
            <i class="fas fa-close text-danger me-3"></i><small>With Trainer</small>
          </li>
          @endif
        </ol>
      </div>
    </div>
  </div>

  @endforeach
  
@endsection