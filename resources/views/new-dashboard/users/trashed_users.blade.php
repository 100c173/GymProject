@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Trashed Users')
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
          <li class="breadcrumb-item">
            <a href="{{route('users.index')}}">Users</a>
          </li>
          <li class="breadcrumb-item active">Trash</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

      <!-- Create User -->
      <a class="btn btn-primary me-1" href="{{route('users.create')}}" role="button">
        Create New User
      </a>
    </div>
  </div>
  
<!-- Filter Content -->
<div class="collapse" id="collapseExample">
  <div class="d-flex p-4">
    <div class="card mb-6 w-100">
      <h4 class="card-header">Filter</h4>
      <form id="FilterForm" action="{{ route('users.trashed') }}" method="GET">
        <div class="card-body">
          <div class="row mb-3 d-flex align-items-center">
            <!-- Search -->
            <div class="col-sm-3 d-flex align-items-center">
              <label class="col-form-label me-2" for="basic-icon-default-fullname2">Search</label>
              <div class="input-group input-group-merge flex-grow-1">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-search"></i></span>
                <input name="name" type="text" class="form-control" id="basic-icon-default-fullname2" placeholder="Search Something" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
              </div>
            </div>

            <!-- Entries Number Dropdown -->
            <div class="col-sm-2 d-flex align-items-center">
              <input type="hidden" name="entries_number" id="entries_number">
              <div class="btn-group me-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="entriesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Entries Number
                </button>
                <ul class="dropdown-menu" aria-labelledby="entriesDropdown">
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectEntries('5')">5</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectEntries('10')">10</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectEntries('15')">15</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectEntries('20')">20</a></li>
                </ul>
              </div>
            </div>

            <!-- Role Dropdown -->
            <div class="col-sm-4 d-flex align-items-center">
              <input type="hidden" name="role" id="role">
              <div class="btn-group me-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="roleDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Role
                </button>
                <ul class="dropdown-menu" aria-labelledby="roleDropdown">
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectRole('All')">All</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectRole('admin')">Admin</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectRole('trainer')">Trainer</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);" onclick="selectRole('member')">Member</a></li>
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
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i> <span>{{$user->id}}</span></td>
                <td>{{$user->getFullName()}}</td>
                <td>
                  {{$user->email}}
                  </ul>
                </td>
                <td>
                  @if ($user->getRoleNames()->first() == 'admin')
                  <span class="badge bg-label-primary me-1">{{$user->getRoleNames()->first()}}</span>
                  @elseif ($user->getRoleNames()->first() == 'trainer')
                  <span class="badge bg-label-success me-1">{{$user->getRoleNames()->first()}}</span>
                  @elseif ($user->getRoleNames()->first() == 'member')
                  <span class="badge bg-label-dark me-1">{{$user->getRoleNames()->first()}}</span>
                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('restore_user_{{$user->id}}').submit();">
                        <i class="bx bx-share me-1"></i> Restore
                      </a>
                      <form id="restore_user_{{$user->id}}" action="{{ route('users.restore', $user) }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('force_delete_user_{{$user->id}}').submit();">
                        <i class="bx bx-trash me-1"></i> Delete permanently
                      </a>
                      <form id="force_delete_user_{{$user->id}}" action="{{ route('users.forceDelete', ['id' => $user->id, 'redirect' => url()->current()]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </div>
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
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->previousPageUrl() }}">
                <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
              </a>
            </li>
        
            <!-- Pagination Links -->
            @for ($i = 1; $i <= $users->lastPage(); $i++)
              <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->url($i) }}">
                  {{ $i }}
                </a>
              </li>
            @endfor
        
            <!-- Next Page Link -->
            <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
              <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->nextPageUrl() }}">
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