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
                <a href="{{route('ratings.index')}}">Ratings</a>
              </li>
              <li class="breadcrumb-item active">{{class_basename($rating->rateable_type) . " - " . $rating->rateable->name}}</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Ratable Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$rating->rateable->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Rateable Type</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{class_basename($rating->rateable_type)}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">User Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$rating->user->getFullName()}}</p>
                  <div class="d-flex justify-content-end">
                    <a class="btn btn-primary btn-sm" href="{{route('users.show', $rating->user)}}">
                        View Profile
                    </a>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Rating</p>
                </div>
                <div class="col-sm-9">
                    <div class="rating d-flex flex-row-reverse justify-content-end">
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
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Comment</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$rating->comment}}</p>
                </div>
              </div>
             
            <div class="d-flex justify-content-end mb-4">
        
                <a class="btn btn-danger btn-sm" href="javascript:{}" onclick="document.getElementById('remove_to_trush_session_{{$rating->id}}').submit();">
                    <form id="remove_to_trush_session_{{$rating->id}}" action="{{ route('ratings.destroy', $rating) }}" method="POST" style="display: none;">
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
