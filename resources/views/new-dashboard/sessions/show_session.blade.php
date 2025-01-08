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
                <a href="{{route('sessions.index')}}">Sessions</a>
              </li>
              <li class="breadcrumb-item active">{{$session->name}}</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Session Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$session->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Description</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$session->description}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Max Members</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$session->max_members}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Status</p>
                </div>
                <div class="col-sm-9">

                    @if ($session->status == 'active')
                    <span class="badge bg-label-warning me-1 border-none " >
                        {{$session->status}}
                      </span>
                    @elseif ($session->status == 'completed')
                    <span class="badge bg-label-success me-1 border-none " >
                        {{$session->status}}
                      </span>
                    @elseif ($session->status == 'inactive')
                    <span class="badge bg-label-danger me-1 border-none " >
                      {{$session->status}}
                    </span>
                    @endif

                  {{-- <p class="text-muted mb-0">{{$session->status}}</p> --}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Time</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <span class="badge bg-label-success me-1">{{$session->time->getStartTime12Hours()}}</span>
                    {{" - "}}
                    <span class="badge bg-label-danger ms-1">{{$session->time->getEndTime12Hours()}}</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mb-4">

                <a href="{{route('sessions.edit',$session)}}" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning me-2">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </a>

                            <a class="btn btn-danger" href="javascript:{}" onclick="document.getElementById('remove_to_trush_session_{{$session->id}}').submit();">
                                <form id="remove_to_trush_session_{{$session->id}}" action="{{ route('sessions.destroy', $session) }}" method="POST" style="display: none;">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                Delete
                            </a>
              
                
              </div>
          </div>


     
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0"><span class="text-success font-italic me-1">Allowed</span>Plans</p>
                </li>
                @forelse ($session->plans as $plan)
                <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                  <p class="mb-0 ">{{$plan->name}}</p>
                </li>
                {{-- <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">Start: {{$subscription->start}}</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">End: {{$subscription->end}}</p>
                </li> --}}
                @empty
                <p class=" d-flex flex-row-reverse justify-content-center text-muted mt-3">Nothing To Show Here</p>
                @endforelse
              </ul>
            </div>
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
