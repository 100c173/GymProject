@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Times')
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
          <li class="breadcrumb-item active">Times</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

      <!-- Create User -->
      <a class="btn btn-primary me-1" href="{{route('times.create')}}" role="button">
        Create New Time
      </a>
    </div>
</div>

<!-- Filter Content -->
<div class="collapse" id="collapseExample">
    <div class="card mb-6 w-100">
        <h4 class="card-header">Filter</h4>
        <form id="FilterForm" action="{{ route('times.index') }}" method="GET">
            <div class="card-body">
                <div class="row mb-3">
                     <!-- Min Time -->
                     <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="min_price">Min Time</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="min_price" class="input-group-text"></span>
                            <input name="min_time" value="{{ request('min_time') }}" class="form-control" type="time" id="html5-time-input">
                        </div>
                    </div>

                    <!-- Max Time -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="basic-icon-default-fullname2">Max Time</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="basic-icon-default-fullname2" class="input-group-text"></span>
                            <input name="max_time" value="{{request('max_time')}}" class="form-control" type="time" id="html5-time-input" />
                        </div>
                    </div>
                   
                </div>
                <div class="row mb-3">
                   <!-- Min Date -->
                    <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="max_price">Min Date</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="max_price" class="input-group-text"></span>
                            <input name="min_date" value="{{ request('min_date') }}"  class="form-control" type="date" id="html5-date-input">
                        </div>
                    </div>

                     <!-- Max Date -->
                     <div class="col-sm-4 d-flex align-items-center">
                        <label class="col-form-label me-2" for="max_price">Max Date</label>
                        <div class="input-group input-group-merge flex-grow-1">
                            <span id="max_price" class="input-group-text"></span>
                            <input name="max_date" value="{{ request('max_date') }}"  class="form-control" type="date" id="html5-date-input">
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
              <th>Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($times as $time)
                
            
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i>
                     <span>
                        {{$time->id}}
                    </span>
                </td>
                <td><span class="badge bg-label-dark me-1">{{$time->day}}</span></td>
                <td>
                    <span class="badge bg-label-success me-1">{{$time->start_time}}</span>
                  </ul>
                </td>
                <td>
                    <span class="badge bg-label-danger me-1">{{$time->end_time}}</span>
                </td>
                <td>
                    
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">

                      <a class="dropdown-item" href="{{route('times.show',$time)}}"><i class="bx bx-show me-1"></i>Show</a>
                      <a class="dropdown-item" href="{{route('times.edit',$time)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                        
                      {{-- Please don't forget to replace the $membership->id with real one in the form id and js like it should be remove_equipment_{{$membership->id}}  --}}
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_membership_{{$time->id}}').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="remove_membership_{{$time->id}}" action="{{route('times.destroy',$time)}}" method="POST" style="display: none;">
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
                    <li class="page-item {{ $times->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $times->appends(request()->except('page'))->previousPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
            
                    <!-- Pagination Links -->
                    @for ($i = 1; $i <= $times->lastPage(); $i++)
                        <li class="page-item {{ $times->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $times->appends(request()->except('page'))->url($i) }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
            
                    <!-- Next Page Link -->
                    <li class="page-item {{ $times->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $times->appends(request()->except('page'))->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        
      </div>
</div>
<script>
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