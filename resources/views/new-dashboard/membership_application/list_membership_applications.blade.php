@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Membership Applications')
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
          <li class="breadcrumb-item active">Membership Applications</li>
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
      <form id="FilterForm" action="" method="GET">
        <div class="card-body">
          <div class="row mb-3 d-flex align-items-center">
            <!-- Search -->
            <div class="col-sm-4 d-flex align-items-center">
              <label class="col-form-label me-2" for="basic-icon-default-fullname2">Search</label>
              <div class="input-group input-group-merge flex-grow-1">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-search"></i></span>
                <input name="name" value="{{request('name')}}" type="text" class="form-control" id="basic-icon-default-fullname2" placeholder="Search Something" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
              </div>
            </div>

            <!-- Entries Number Dropdown -->
            <div class="col-sm-2 d-flex align-items-center">
              <input type="hidden" name="entries_number" value="{{request('entries_number')}}" id="entries_number">
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
              <th>User Name</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Request</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i>
                     <span>
                        1
                    </span>
                </td>
                <td>User Name</td>
                <td>
                    <!-- Please use success for accepted and danger for declined -->
                    <span class="badge bg-label-info me-1">pending</span>
                  </ul>
                </td>
                <td>
                   2024/10/5
                </td>
                <td>
                    <a class="btn btn-success btn-sm me-1" href="">Accept</a>
                    <a class="btn btn-danger btn-sm" href="">Decline</a>
                </td>
                <td>
                    
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">

                      <a class="dropdown-item" href=""><i class="bx bx-show me-1"></i>Show</a>
                      <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i>Edit</a>
                        
                      {{-- Please don't forget to replace the $membership->id with real one in the form id and js like it should be remove_equipment_{{$membership->id}}  --}}
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_membership_$membership->id').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="remove_membership_$membership->id" action="" method="POST" style="display: none;">
                              @csrf 
                              @method('DELETE')
                          </form>
                          Delete
                      </a>
                
                    </div>
                  </div>
                </td>
              </tr>
            
          </tbody>
        </table>

        <!-- Please uncomment under below and replace the $sessions with $membership
             .. Don't forget to use paginate on your controller first! -->


        {{-- <nav aria-label="Page navigation">
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
          </nav> --}}
        
      </div>
</div>
<script>
  function selectEntries(value) {
    document.getElementById('entries_number').value = value;
  }
</script>
@endsection