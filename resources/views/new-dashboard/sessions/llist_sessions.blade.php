@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Sessions')
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
          <li class="breadcrumb-item active">Sessions</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

      <!-- Create User -->
      <a class="btn btn-primary me-1" href="{{route('sessions.create')}}" role="button">
        Create New Session  
      </a>
    </div>
  </div>
  
<!-- Filter Content -->
<div class="collapse" id="collapseExample">
  <div class="d-flex p-4">
    <div class="card mb-6 w-100">
      <h4 class="card-header">Filter</h4>
      <form id="FilterForm" action="{{ route('sessions.index') }}" method="GET">
        <div class="card-body">
          <div class="row mb-3">
            <!-- Search -->
            <div class="col-sm-4 d-flex align-items-center">
              <label class="col-form-label me-2" for="basic-icon-default-fullname2">Session Name</label>
              <div class="input-group input-group-merge flex-grow-1">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-search"></i></span>
                <input name="session_name" value="{{ request('session_name') }}" type="text" class="form-control" placeholder="Type the session name" id="basic-icon-default-fullname2" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
              </div>
            </div>

            <div class="col-sm-4 d-flex align-items-center">
              <label class="col-form-label me-2" for="basic-icon-default-fullname2">Max Members</label>
              <div class="input-group input-group-merge flex-grow-1">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-group"></i></span>
                <input name="max_members" value="{{ request('max_members') }}" type="number" class="form-control" placeholder="Members in a session" id="basic-icon-default-fullname2" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
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
                  <li><a class="dropdown-item {{request('entries_number') == 20 ? 'active' : ''}}"  href="javascript:void(0);" onclick="selectEntries('20')">20</a></li>
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
              <th>Session Name</th>
              <th>Session Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Registered Members</th>
              <th>Session Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sessions as $session)
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i> <span>{{$session->id}}</span></td>
                <td>{{$session->name}}</td>
                <td>
                  {{$session->time->day}}
                  </ul>
                </td>
                <td>
                    {{$session->time->start_time}}
                </td>
                <td>
                    {{$session->time->end_time}}
                </td>
                <td>
                    {{$session->appointments->count()}}
                </td>
                <td>
                  <!-- Button trigger modal -->
                  @if ($session->status == 'active')
                    <button type="button" class="badge bg-label-warning me-1 border-none" data-bs-toggle="modal" data-bs-target="#basicModal-{{$session->id}}">
                      {{$session->status}}
                    </button>
                    @elseif ($session->status == 'completed')
                    <button type="button" class="badge bg-label-success me-1 border-none" data-bs-toggle="modal" data-bs-target="#basicModal-{{$session->id}}">
                      {{$session->status}}
                    </button>
                    @elseif ($session->status == 'inactive')
                    <button type="button" class="badge bg-label-danger me-1 border-none" data-bs-toggle="modal" data-bs-target="#basicModal-{{$session->id}}">
                      {{$session->status}}
                    </button>
                    @endif
                    
              <!-- Modal -->
              <div class="modal fade" id="basicModal-{{$session->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1-{{$session->id}}">Change Status</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-6">
                          <form action="{{route('sessions.updateStatus', $session)}}" method="POST">
                            @csrf
                            @method('PUT')
                          <label for="nameBasic-{{$session->id}}" class="form-label">Status</label>
                          <select name="status" class="form-select" id="nameBasic-{{$session->id}}" aria-label="Default select example">
                            <option {{$session->status == 'active' ? 'selected' : ''}} value="active">active</option>
                            <option {{$session->status == 'inactive' ? 'selected' : ''}} value="inactive">inactive</option>
                            <option {{$session->status == 'completed' ? 'selected' : ''}} value="completed">completed</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
                  </div>
                </div>
              </div>

                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('sessions.show',$session)}}"><i class="bx bx-show me-1"></i>Show</a>
                      <a class="dropdown-item" href="{{route('sessions.edit',$session)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                        <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('Delete_{{$session->id}}').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="Delete_{{$session->id}}" action="{{ route('sessions.destroy', $session) }}" method="POST" style="display: none;">
                              @csrf 
                              @method('DELETE')
                          </form>
                          Delete
                      </a>
                      <div class="divider">
                        <div class="divider-text">Managment</div>
                      </div>
                      <a href="" class="dropdown-item">Manage</a>
                      <a href="/appointments" class="dropdown-item">Log</a>
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
            <li class="page-item {{ $sessions->onFirstPage() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $sessions->appends(['entries_number' => request('entries_number'), 'session_name' => request('session_name'), 'max_members' => request('max_members')])->previousPageUrl() }}">
                <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
              </a>
            </li>
        
            <!-- Pagination Links -->
            @for ($i = 1; $i <= $sessions->lastPage(); $i++)
              <li class="page-item {{ $sessions->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $sessions->appends(['entries_number' => request('entries_number'), 'session_name' => request('session_name'), 'max_members' => request('max_members')])->url($i) }}">
                  {{ $i }}
                </a>
              </li>
            @endfor
        
            <!-- Next Page Link -->
            <li class="page-item {{ $sessions->hasMorePages() ? '' : 'disabled' }}">
              <a class="page-link" href="{{ $sessions->appends(['entries_number' => request('entries_number'), 'session_name' => request('session_name'), 'max_members' => request('max_members')])->nextPageUrl() }}">
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