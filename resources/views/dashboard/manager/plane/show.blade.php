@extends('/dashboard/manager/layout')
@section('content')
 
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="container-fluid px-4">
            <div class="card-body px-0 py-0 glass-card shadow-lg">
                <div class="row">
                    <div class="col-md-8 py-2">
                        <div class="mx-4 my-4">
                            <p class="h3 mb-3"><strong>{{$plan->name}}</strong></p>
                            <p class="text-muted">{{$plan->description}}.</p>
                            <p class="text-uppercase text-primary mb-0 new-section" style="font-size: 14px;"> what’s included <span class="line-pricing"></span></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ol class="list-unstyled mb-0 pt-0 pb-0">
                                        <p class="my-3 fw-bold text-muted text-center"></p>
                                        @if ($plan->with_trainer)
                                            
                                        <li class="mb-3">
                                            <i class="fas fa-check text-success me-3"></i><small>With Trainer</small>
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
                    </div>
                    <div class="col-md-4 text-center glass-card shadow-lg me-0">
                        <div class="mt-5 pt-4 me-4">
                            <p class="h5">Price</p>
                            <p class="h2 fw-bold text-body" style="font-size: 40px;">${{$plan->price}} <small class="text-muted" style="font-size: 15px;">/{{$plan->period}}<small>days</small></small></p>
                            <p class="text-decoration-underline text-body-50 " style="font-size: 15px;">{{$plan->planType->name}}</p>
                            <a href="{{route('plans.edit', $plan)}}" data-mdb-ripple-init class="btn btn-warning d-block mb-2 mt-3 text-capitalize">Edit</a>
                            <a href="{{route('plans.destroy', $plan)}}" id="delete" data-mdb-ripple-init class="btn btn-danger d-block mb-2 mt-3 text-capitalize">Delete
                            <form id="delete-form" action="{{route('plans.destroy',$plan)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('delete').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });
</script>


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

.glass-card {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px) saturate(180%);
    -webkit-backdrop-filter: blur(10px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 20px;
}



  </style>
@endsection