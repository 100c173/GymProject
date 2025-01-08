@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Ratings')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-3">
    <!-- Breadcrumb -->
    <div class="col-md-8">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Ratings</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

    </div>
</div>

<!-- Filter Content -->
<div class="collapse" id="collapseExample">
    <div class="card mb-6 w-100">
        <h4 class="card-header">Filter</h4>
        <form id="FilterForm" action="{{ route('ratings.index') }}" method="GET">
            <div class="card-body">

                <div class="row mb-3">
                    <!-- Rated By -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="rater_name">Rated By</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="rater_name" class="input-group-text"><i class="bx bx-search"></i></span>
                            <input name="rater_name" value="{{ request('rater_name') }}" placeholder="Enter The Rater Name" class="form-control" type="text" id="rater_name-input">
                        </div>
                    </div>

                    <!-- Awarded To -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="rateable_name">Awarded To</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="rateable_name" class="input-group-text"><i class="bx bx-search"></i></span>
                            <input name="rateable_name" value="{{ request('rateable_name') }}" placeholder="Enter the ratable name" class="form-control" type="text" id="rateable_name-input">
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                        <!-- Entries Number Dropdown -->
                        <div class="col-sm-2 d-flex align-items-center">
                            <input type="hidden" name="entries_number" value="{{ request('entries_number') }}" id="entries_number">
                            <div class="btn-group me-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="entriesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Entries Number
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="entriesDropdown">
                                    <li><a class="dropdown-item {{ request('entries_number') == 5 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEntries('5')">5</a></li>
                                    <li><a class="dropdown-item {{ request('entries_number') == 10 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEntries('10')">10</a></li>
                                    <li><a class="dropdown-item {{ request('entries_number') == 15 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEntries('15')">15</a></li>
                                    <li><a class="dropdown-item {{ request('entries_number') == 20 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEntries('20')">20</a></li>
                                </ul>
                            </div>
                        </div>

                           <!-- Rateable Type Dropdown -->
                            <div class="col-sm-2 d-flex align-items-center">
                                <input type="hidden" name="rateable_type" value="{{ request('rateable_type') }}" id="rateable_type">
                                <div class="btn-group me-2">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="rateableTypeDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Rateable Type
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="rateableTypeDropdown">
                                        <li><a class="dropdown-item {{ request('rateable_type') == 'App\Models\User' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRateableType('App\\Models\\User')">User</a></li>
                                        <li><a class="dropdown-item {{ request('rateable_type') == 'App\Models\Service' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRateableType('App\\Models\\Service')">Service</a></li>
                                        <li><a class="dropdown-item {{ request('rateable_type') == '' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRateableType('')">Both</a></li>
                                    </ul>
                                </div>
                            </div>

                    <!-- Rating Dropdown -->
                    <div class="col-sm-2 d-flex align-items-center">
                        <input type="hidden" name="rating" value="{{ request('rating') }}" id="rating">
                        <div class="btn-group me-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="ratingDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Rating
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="ratingDropdown">
                                <li><a class="dropdown-item {{ request('rating') == 'All' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('All')">All</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 0 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('0')">0</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 1 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('1')">1</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 2 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('2')">2</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 3 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('3')">3</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 4 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('4')">4</a></li>
                                <li><a class="dropdown-item {{ request('rating') == 5 ? 'active' : '' }}" href="javascript:void(0);" onclick="selectRating('5')">5</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
 
                <!-- Apply Button -->
                <div class="row mb-3">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-light me-1" onclick="resetFilters()">Reset</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

  
  
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Awarded To</th>
              <th>type</th>
              <th>Rated By</th>
              <th style="width: 5%">rating</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ratings as $rating)
                
            
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i>
                     <span>
                        {{$rating->id}}
                    </span>
                </td>
                @if (class_basename($rating->rateable_type) == "User")
                <td>{{$rating->rateable->getFullName()}}</td>
                @else
                <td>{{$rating->rateable->name}}</td>
                @endif
              
                <td>
                    @if (class_basename($rating->rateable_type) == 'User')
                    <span class="badge bg-label-primary me-1">{{class_basename($rating->rateable_type)}}</span>
                    @else
                    <span class="badge bg-label-dark me-1">{{class_basename($rating->rateable_type)}}</span>
                    @endif
                </td>
                <td>
                  {{$rating->user->getFullName()}}
                </td>

                <td>
                    <div class="col-md-1 offset-md-2">
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
              
            </ul>
          </td>

                <td>
                    
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">

                      <a class="dropdown-item" href="{{route('ratings.show',$rating)}}"><i class="bx bx-show me-1"></i>Show</a>
                        
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_rating_{{$rating->id}}').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="remove_rating_{{$rating->id}}" action="{{route('ratings.destroy',$rating)}}" method="POST" style="display: none;">
                              @csrf 
                              @method('DELETE')
                          </form>
                          Delete
                      </a>
                
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>

             <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Previous Page Link -->
                    <li class="page-item {{ $ratings->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ratings->previousPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
            
                    <!-- Pagination Links -->
                    @for ($i = 1; $i <= $ratings->lastPage(); $i++)
                        <li class="page-item {{ $ratings->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $ratings->url($i) }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
            
                    <!-- Next Page Link -->
                    <li class="page-item {{ $ratings->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $ratings->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        
      </div>
</div>


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

<script>
function selectEntries(number) {
    document.getElementById('entries_number').value = number;
}

function selectRateableType(type) {
    document.getElementById('rateable_type').value = type;
}

function selectRating(rating) {
    document.getElementById('rating').value = rating;
}

function resetFilters() {

    // Get the filter form
    var form = document.getElementById('FilterForm');

    // Clear all input fields
    var inputs = form.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++)
    {
        inputs[i].value = ''; 
    }

    // Reload the page without any query parameters
    window.location.href = form.action;
}
</script>
@endsection