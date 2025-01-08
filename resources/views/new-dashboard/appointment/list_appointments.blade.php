@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Appointments')
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
          <li class="breadcrumb-item active">Appointments</li>
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
    <div class="d-flex p-4">
      <div class="card mb-6 w-100">
        <h4 class="card-header">Filter</h4>
        <form id="FilterForm" action="{{ route('appointment.search') }}" method="GET">
          <div class="card-body">
            <div class="row mb-3 d-flex align-items-center">
              <!-- Search -->
              <div class="col-sm-4 d-flex align-items-center">
                <label class="col-form-label me-2" for="basic-icon-default-fullname2">Search</label>
                <div class="input-group input-group-merge flex-grow-1">
                  <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-search"></i></span>
                  <input name="search" value="{{request('search')}}" type="text" class="form-control" id="basic-icon-default-fullname2" placeholder="Search Something" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                </div>
              </div>

              <!-- Entries Number Dropdown -->
              <div class="col-sm-2 d-flex align-items-center">
                <input type="hidden" value="{{request('entries_number')}}" name="entries_number" id="entries_number">
                <div class="btn-group me-2">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="entriesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Entries Number
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="entriesDropdown">
                    <li><a class="dropdown-item {{request('entries_number') == 5 ? 'active' : ''}}" href="javascript:void(0);" onclick="selectEntries('5')">5</a></li>
                    <li><a class="dropdown-item {{request('entries_number') == 10 ? 'active' : ''}}" href="javascript:void(0);" onclick="selectEntries('10')">10</a></li>
                    <li><a class="dropdown-item {{request('entries_number') == 15 ? 'active' : ''}}" href="javascript:void(0);" onclick="selectEntries('15')">15</a></li>
                    <li><a class="dropdown-item {{request('entries_number') == 20 ? 'active' : ''}}" href="javascript:void(0);" onclick="selectEntries('20')">20</a></li>
                  </ul>
                </div>
              </div>
            </div>


            <!-- Apply Button -->
            <div class="row">
              <div class="col-sm-12 d-flex justify-content-end">
                <button class="btn btn-primary me-1">APPLY</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th> Member Name</th>
          <th>Session Name</th>
          <th>Session Date</th>
          <th>Start Time</th>
          <th>End Time</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($appointments as $appointment)
        <tr>
          <td><i class="fab fa-angular fa-xl text-danger me-4"></i> <span>{{$appointment->id}}</span></td>
          <td>{{$appointment->user->getFullName()}}</td>
          <td>
            {{$appointment->session->name}}
            </ul>
          </td>
          <td>
            {{ $appointment->session->time->day }}
          </td>
          <td>
            {{ $appointment->session->time->start_time }}
          </td>
          <td>
            {{ $appointment->session->time->end_time  }}
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('Delete_{{$appointment->id}}').submit();"><i class="bx bx-trash me-1"></i>
                  <form id="Delete_{{$appointment->id}}" action="{{ route('appointment.destroy', $appointment) }}" method="POST" style="display: none;">
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
        <li class="page-item {{ $appointments->onFirstPage() ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $appointments->appends(['entries_number' => request('entries_number'), 'search' => request('search')])->previousPageUrl() }}">
            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
          </a>
        </li>

        <!-- Pagination Links -->
        @for ($i = 1; $i <= $appointments->lastPage(); $i++)
          <li class="page-item {{ $appointments->currentPage() == $i ? 'active' : '' }}">
            <a class="page-link" href="{{ $appointments->appends(['entries_number' => request('entries_number'), 'search' => request('search')])->url($i) }}">
              {{ $i }}
            </a>
          </li>
          @endfor

          <!-- Next Page Link -->
          <li class="page-item {{ $appointments->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $appointments->appends(['entries_number' => request('entries_number'), 'search' => request('search')])->nextPageUrl() }}">
              <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
            </a>
          </li>
      </ul>
    </nav>

  </div>
</div>
<script>
  function selectRole(value) {
    document.getElementById('role').value = value;
  }

  function selectEntries(value) {
    document.getElementById('entries_number').value = value;
  }
</script>
@endsection