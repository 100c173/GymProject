@extends('/dashboard/manager/layout')
@section('content')
<section style="background-color: #eee;">
    <div class="container py-3">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Info</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{$user->first_name}}</h5>
              {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
              {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
              <div class="d-flex justify-content-center mb-2">

                <a href="{{route('users.edit',$user)}}" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </a>

                <div class="btn-group ms-1">
                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_to_trush_user_{{$user->id}}').submit();">
                                <form id="remove_to_trush_user_{{$user->id}}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                Remove to trash
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('force_delete_user_{{$user->id}}').submit();">
                                <form id="force_delete_user_{{$user->id}}" action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display: none;">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                Delete permanently
                            </a>
                        </li>
                    </ul>
                </div>
                
              </div>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0"><span class="text-success font-italic me-1">Active</span>Subsecriptions</p>
                </li>
                @forelse ($subscriptions as $subscription)
                <li class=" d-flex justify-content-center align-items-center p-3 bg-light">
                  <p class="mb-0 ">{{$subscription->plan->name}}</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">Start: {{$subscription->start}}</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <p class="mb-0">End: {{$subscription->end}}</p>
                </li>
                @empty
                <p class=" d-flex flex-row-reverse justify-content-center text-muted mt-3">Nothing To Show Here</p>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
   
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->first_name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->last_name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->email}}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">Service</span>Ratings
                  </p>
                  @forelse ($serviceRatings as $rating)
                  
                  <div class="row">
                    <div class="col-sm-5">
                      <p class="mb-0">{{$rating->rateable->name}}</p>
                    </div>
                    <div class="col-sm-9">
                        <div class="container">
                            <div class="row">
                              <div class="col-md-6 offset-md-3">
                                  <div class="rating d-flex flex-row-reverse justify-content-center">
                                    <input type="radio" id="star5" class="d-none" name="rating-{{$rating->rateable}}" value="5" readonly {{$rating->rating == 5 ? 'checked' : ''}}> 
                                  <label ></label>
                                  <input type="radio" id="star4" class="d-none" name="rating-{{$rating->rateable}}" value="4" readonly {{$rating->rating == 4 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star3" class="d-none" name="rating-{{$rating->rateable}}" value="3" readonly {{$rating->rating == 3 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star2" class="d-none" name="rating-{{$rating->rateable}}" value="2" readonly {{$rating->rating == 2 ? 'checked' : ''}}>
                                  <label ></label>
                                  <input type="radio" id="star1" class="d-none" name="rating-{{$rating->rateable}}" value="1"  readonly {{$rating->rating == 1 ? 'checked' : ''}}>
                                  <label ></label>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <p class="text-muted mb-0 mt-2">Comment: {{$rating->comment}}</p>
                    </div>
                  </div>
                  <hr>
                  @empty
                  <p class=" d-flex flex-row-reverse justify-content-center text-muted mb-0">Nothing To Show Here</p>
                  @endforelse
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">Trainer</span>Ratings
                    </p>
                    @forelse ($userRatings as $rating)
                   
                    <div class="row">
                      <div class="col-sm-5">
                        <p class="mb-0">{{$rating->rateable->first_name. ' ' .$rating->rateable->last_name}}</p>
                      </div>
                      <div class="col-sm-9">
                          <div class="container">
                              <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="rating d-flex flex-row-reverse justify-content-center">
                                      <input type="radio" id="star5" class="d-none" name="rating-{{$rating->rateable}}" value="5" readonly {{$rating->rating == 5 ? 'checked' : ''}}> 
                                    <label ></label>
                                    <input type="radio" id="star4" class="d-none" name="rating-{{$rating->rateable}}" value="4" readonly {{$rating->rating == 4 ? 'checked' : ''}}>
                                    <label ></label>
                                    <input type="radio" id="star3" class="d-none" name="rating-{{$rating->rateable}}" value="3" readonly {{$rating->rating == 3 ? 'checked' : ''}}>
                                    <label ></label>
                                    <input type="radio" id="star2" class="d-none" name="rating-{{$rating->rateable}}" value="2" readonly {{$rating->rating == 2 ? 'checked' : ''}}>
                                    <label ></label>
                                    <input type="radio" id="star1" class="d-none" name="rating-{{$rating->rateable}}" value="1"  readonly {{$rating->rating == 1 ? 'checked' : ''}}>
                                    <label ></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                      </div>
                    </div>
                    <hr>
                    @empty
                    <p class=" d-flex flex-row-reverse justify-content-center text-muted mb-0">Nothing To Show Here</p>
                    @endforelse
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    body {background-color: #eee;}
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
