@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Show plan')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card-body px-0 py-0">
        <div class="row">
          <div class="col-md-8 py-2" style="background-color: white;">
            <div class="mx-4 my-4">
              <p class="h3 mb-3"><strong>{{$plan->name}}</strong></p>
              <p class="text-muted">{{$plan->description}}.</p>
              <p class="text-uppercase text-primary mb-0 new-section" style="font-size: 14px;"> what’s included
                <span class="line-pricing"></span></p>
      
              <div class="row">
                <div class="col-md-6">
                  <ol class="list-unstyled mb-0 pt-0 pb-0">
                    <p class="my-3 fw-bold text-muted text-center">
                    </p>
                    @if ($plan->with_trainer)
                    <li class="mb-3">
                      <i class="bx bx-check text-success me-3"></i><small>With Trainer</small>
                    </li>
                    @else
                    <li class="mb-3">
                      <i class="bx bx-x text-danger me-3"></i><small>Without Trainer</small>
                    </li>
                    @endif
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center"
            style="background-color:#F9FAFB ; box-shadow: 0px 0px 10px 1px #aaaaaa;">
            <div class=" mt-5 pt-4 me-4">
              <p class="h3">Price</p>
              <p class="h2 fw-bold text-body" style="font-size: 40px;">${{$plan->price}} <small class="text-muted"
                  style="font-size: 15px;">{{$plan->period}}<small class="text-muted">/days</small></small></p>
              <p class="text-decoration-underline text-body-50 " style="font-size: 15px;">{{$plan->planType->name}}</p>

              <a href="{{route('plans.edit',$plan)}}" data-mdb-ripple-init class="btn btn-dark d-block mb-2 mt-3 text-capitalize"><i class="bx bx-edit-alt me-1"></i>Edit</a>
              <a href="javascript:{}" data-mdb-ripple-init class="btn btn-dark d-block mb-2 mt-3 text-capitalize" onclick="document.getElementById('remove_plan_{{$plan->id}}').submit();">
                 <i class="bx bx-trash me-1"></i>
                 Delete
                 <form id="remove_plan_{{$plan->id}}" action="{{ route('plans.destroy', $plan) }}" method="POST" style="display: none;">
                    @csrf 
                    @method('DELETE')
                </form>
             </a>
             
              

            </div>
      
          </div>
        </div>
      </div>
      </div>


  <style>
  .new-section {
overflow :hidden;
color: gray;
text-align: left;
line-height: 1.6em;
}
.new-section::before {
display: block;
float: right;
margin-top: .7em;
border-top: 2px solid silver;
width: 78%;
content: "";
}



  </style>
@endsection