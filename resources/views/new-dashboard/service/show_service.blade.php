@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Show Session')
@section('content')
@extends('components.alert')

<section >
    <div class="container py-3">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3">
            <ol class="breadcrumb breadcrumb-style1">
              <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('services.index')}}">Services</a>
              </li>
              <li class="breadcrumb-item active">{{$service->name}}</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Service Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$service->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Description</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$service->description}}</p>
                </div>
              </div>
             
            <div class="d-flex justify-content-end mb-4">
                <a href="{{route('services.edit',$service)}}" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning me-2">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </a>
                <a class="btn btn-danger" href="javascript:{}" onclick="document.getElementById('remove_to_trush_session_{{$service->id}}').submit();">
                    <form id="remove_to_trush_session_{{$service->id}}" action="{{ route('services.destroy', $service) }}" method="POST" style="display: none;">
                        @csrf 
                        @method('DELETE')
                    </form>
                    Delete
                </a>
              </div>
          </div>



           




     <!--
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0"><span class="text-success font-italic me-1">Used</span>Sessions</p>
                </li>
                {{-- @forelse ($time->sessions as $session) --}}
                <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                  {{-- <p class="mb-0 ">{{$session->name}}</p> --}}
                </li>
                {{-- <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">Start: {{$subscription->start}}</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">End: {{$subscription->end}}</p>
                </li> --}}
                {{-- @empty --}}
                <p class=" d-flex flex-row-reverse justify-content-center text-muted mt-3">Nothing To Show Here</p>
                {{-- @endforelse --}}
              </ul>
            </div>
        -->
        </div>

        
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">Service</span>Ratings
                  </p>
                  @forelse ($service->ratings as $rating)
                  
                  <div class="row">
                    <div class="col-sm-5">
                      <p class="mb-0"><span class="fw-bold me-1">User:</span> {{$rating->user->getFullName()}}</p>
                    </div>
                    <div class="col-sm-9">
                        <div class="container">
                            <div class="row">
                              <div class="col-md-6 offset-md-3">
                                  <div class="rating d-flex flex-row-reverse justify-content-center">
                                    <input type="radio" id="star5" class="d-none" name="rating-{{$rating->id}}" value="5" readonly {{$rating->rating == 5 ? 'checked' : ''}}> 
                                  <label ></label>
                                  <input type="radio" id="star4" class="d-none" name="rating-{{$rating->id}}" value="4" readonly {{$rating->rating == 4 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star3" class="d-none" name="rating-{{$rating->id}}" value="3" readonly {{$rating->rating == 3 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star2" class="d-none" name="rating-{{$rating->id}}" value="2" readonly {{$rating->rating == 2 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star1" class="d-none" name="rating-{{$rating->id}}" value="1"  readonly {{$rating->rating == 1 ? 'checked' : ''}}>
                                  <label ></label>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <p class="text-muted mb-0 mt-2"><span class="fw-bold me-1">Comment: </span>{{$rating->comment}}</p>
                    </div>
                  </div>
                  <hr>
                  @empty
                  <p class=" d-flex flex-row-reverse justify-content-center text-muted mb-0">Nothing To Show Here</p>
                  @endforelse
                </div>
           
   

       
      </div>
    </div>
  </section>

  <style>
    .rating label {
    cursor: pointer;
    width: 40px;
    height: 40px;
    margin: 0 5px;
    }
    .rating label:before {
    content: '\2605';
    font-size: 2rem;
    color: #ccc;
    transition: color 0.3s;
    }
    .rating input:checked ~ label:before {
  color: #ffc107;
}
    </style>
@endsection
