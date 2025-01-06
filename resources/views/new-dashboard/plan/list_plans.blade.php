@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Plans')
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
          <li class="breadcrumb-item active">Plans</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

      <!-- Create User -->
      <a class="btn btn-primary me-1" href="{{route('plans.create')}}" role="button">
        Create New Plan
      </a>
    </div>
  </div>
  
<!-- Filter Content -->
<div class="collapse" id="collapseExample">
    <div class="card mb-6 w-100">
        <h4 class="card-header">Filter</h4>
        <form id="FilterForm" action="{{ route('plans.index') }}" method="GET">
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Search -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="basic-icon-default-fullname2">Session Name</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-search"></i></span>
                            <input name="name" value="{{ request('name') }}" type="text" class="form-control" placeholder="Type the Plan name" id="basic-icon-default-fullname2" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                    </div>

                    <!-- Min Price -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="min_price">Min Price</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="min_price" class="input-group-text"><i class="bx bx-search"></i></span>
                            <input name="min_price" value="{{ request('min_price') }}" type="number" class="form-control" placeholder="Min Plan price" id="min_price" aria-label="Min Price" aria-describedby="min_price">
                        </div>
                    </div>

                    <!-- Max Price -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="max_price">Max Price</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="max_price" class="input-group-text"><i class="bx bx-search"></i></span>
                            <input name="max_price" value="{{ request('max_price') }}" type="number" class="form-control" placeholder="Max Plan price" id="max_price" aria-label="Max Price" aria-describedby="max_price">
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

                    <!-- Plan Type Dropdown -->
                    <div class="col-sm-2 d-flex align-items-center">
                        <input type="hidden" name="plan_type" value="{{ request('plan_type') }}" id="plan_type">
                        <div class="btn-group me-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="planTypeDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Plan Type
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="planTypeDropdown">
                                @foreach ($plan_types as $plan_type)
                                    <li><a class="dropdown-item {{ request('plan_type') == $plan_type->id ? 'active' : '' }}" href="javascript:void(0);" onclick="selectPlanType({{ $plan_type->id }})">{{ $plan_type->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                   
                    <!-- With Trainer Radio Buttons -->
                    <div class="col-sm-4 d-flex align-items-center mt-3">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" name="with_trainer" value="1" id="with_trainer_yes" {{ request('with_trainer') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="with_trainer_yes">
                                With Trainer
                            </label>
                        </div>
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" name="with_trainer" value="0" id="with_trainer_no" {{ request('with_trainer') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="with_trainer_no">
                                Without Trainer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="with_trainer" value="" id="both" {{ request('with_trainer') == '' ? 'checked' : '' }}>
                            <label class="form-check-label" for="both">
                                Both
                            </label>
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
              <th>Name</th>
              <th>Price</th>
              <th>With Trainer</th>
              <th>period</th>
              <th>plan Type</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($plans as $plan)
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i> <span>{{$plan->id}}</span></td>
                <td>{{$plan->name}}</td>
                </td>
                <td>
                    ${{$plan->price}}
                </td>
                <td>
                    @if ($plan->with_trainer == 1)
                    <span class="badge bg-label-success me-1">Yes</span>
                    @else
                    <span class="badge bg-label-danger me-1">No</span>
                    @endif
                </td>
                <td>
                   {{$plan->period}}
                </td>
                <td>
                    {{$plan->planType->name}}
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('plans.show',$plan)}}"><i class="bx bx-show me-1"></i>Show</a>
                      <a class="dropdown-item" href="{{route('plans.edit',$plan)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                        <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_plan_{{$plan->id}}').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="remove_plan_{{$plan->id}}" action="{{ route('plans.destroy', $plan) }}" method="POST" style="display: none;">
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
                <li class="page-item {{ $plans->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $plans->appends(request()->except('page'))->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                    </a>
                </li>
        
                <!-- Pagination Links -->
                @for ($i = 1; $i <= $plans->lastPage(); $i++)
                    <li class="page-item {{ $plans->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $plans->appends(request()->except('page'))->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor
        
                <!-- Next Page Link -->
                <li class="page-item {{ $plans->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $plans->appends(request()->except('page'))->nextPageUrl() }}">
                        <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                    </a>
                </li>
            </ul>
        </nav>
        
        
      </div>
</div>
<script>
   function selectPlanType(value) {
        document.getElementById('plan_type').value = value;
   }

  function selectEntries(value) {
    document.getElementById('entries_number').value = value;
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