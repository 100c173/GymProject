@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Equipments')
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
          <li class="breadcrumb-item active">Sport Equipments</li>
        </ol>
      </nav>
    </div>

    <!-- Filter Button -->
    <div class="col-md-4 d-flex justify-content-end align-items-center">
      <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>

      <!-- Create User -->
      <a class="btn btn-primary me-1" href="{{route('equipments.create')}}" role="button">
        Create New Equipment
      </a>
    </div>
  </div>
  
<!-- Filter Content -->
<div class="collapse" id="collapseExample">
  <div class="card mb-6 w-100">
      <h4 class="card-header">Filter</h4>
      <form id="FilterForm" action="{{ route('equipments.index') }}" method="GET">
          <div class="card-body">

              <div class="row mb-3">
                  <!-- Name -->
                  <div class="col-sm-4 d-flex align-items-center">
                      <label class="col-form-label me-2" for="rater_name">Name</label>
                      <div class="input-group input-group-merge flex-grow-1">
                          <span id="equipment_name" class="input-group-text"><i class="bx bx-search"></i></span>
                          <input name="name" value="{{ request('name') }}" placeholder="Enter The Equipment Name" class="form-control" type="text" id="equipment_name">
                      </div>
                  </div>

                  <!-- Brand -->
                  <div class="col-sm-4 d-flex align-items-center">
                      <label class="col-form-label me-2" for="rateable_name">Brand</label>
                      <div class="input-group input-group-merge flex-grow-1">
                          <span id="brand" class="input-group-text"><i class="bx bx-search"></i></span>
                          <input name="brand" value="{{ request('brand') }}" placeholder="Enter the brand" class="form-control" type="text" id="brand">
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

                         <!-- Equipment Status -->
                          <div class="col-sm-2 d-flex align-items-center">
                              <input type="hidden" name="equipment_status" value="{{ request('equipment_status') }}" id="equipment_status">
                              <div class="btn-group me-2">
                                  <button class="btn btn-primary dropdown-toggle" type="button" id="EquipmentStatusDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Equipment Status
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="EquipmentStatusDropdown">
                                      <li><a class="dropdown-item {{ request('equipment_status') == 'available' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEquipmentStatus('available')">Available</a></li>
                                      <li><a class="dropdown-item {{ request('equipment_status') == 'damaged' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEquipmentStatus('damaged')">Damaged</a></li>
                                      <li><a class="dropdown-item {{ request('equipment_status') == 'under maintenance' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEquipmentStatus('under maintenance')">Under Maintenance</a></li>
                                      <li><a class="dropdown-item {{ request('equipment_status') == '' ? 'active' : '' }}" href="javascript:void(0);" onclick="selectEquipmentStatus('')">All</a></li>
                                  </ul>
                              </div>
                          </div>
                        </div>


              <!-- Apply Button -->
              <div class="row mb-3">
                  <div class="col-sm-12 d-flex justify-content-end">
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
              <th>Brand</th>
              <th>equipment status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($equipments as $equipment)
              
            
              <tr>
                <td><i class="fab fa-angular fa-xl text-danger me-4"></i>
                     <span>
                        {{$equipment->id}}
                    </span>
                </td>
                <td>{{$equipment->name}}</td>
                <td>
                  {{$equipment->brand}}
                  </ul>
                </td>
                <td>
                    @if ($equipment->equipment_status == 'available')
                    <span class="badge bg-label-success me-1">{{$equipment->equipment_status}}</span>  
                    @elseif ($equipment->equipment_status == 'damaged')
                    <span class="badge bg-label-danger me-1">{{$equipment->equipment_status}}</span>  
                    @elseif ($equipment->equipment_status == 'under maintenance')
                    <span class="badge bg-label-warning me-1">{{$equipment->equipment_status}}</span>  
                    @endif
                    
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">

                      <a class="dropdown-item" href="{{route('equipments.show', $equipment)}}"><i class="bx bx-show me-1"></i>Show</a>
                      <a class="dropdown-item" href="{{route('equipments.edit',$equipment)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                        
                      <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_equipment_{{$equipment->id}}').submit();"><i class="bx bx-trash me-1"></i>
                          <form id="remove_equipment_{{$equipment->id}}" action="{{route('equipments.destroy', $equipment)}}" method="POST" style="display: none;">
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
              <li class="page-item {{ $equipments->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $equipments->appends(['entries_number' => request('entries_number'), 'name' => request('name'),'brand' => request('brand'),'equipment_status' => request('equipment_status'),])->previousPageUrl() }}">
                  <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                </a>
              </li>
          
              <!-- Pagination Links -->
              @for ($i = 1; $i <= $equipments->lastPage(); $i++)
                <li class="page-item {{ $equipments->currentPage() == $i ? 'active' : '' }}">
                  <a class="page-link" href="{{ $equipments->appends(['entries_number' => request('entries_number'), 'name' => request('name'), 'brand' => request('brand'),'equipment_status' => request('equipment_status'),])->url($i) }}">
                    {{ $i }}
                  </a>
                </li>
              @endfor
          
              <!-- Next Page Link -->
              <li class="page-item {{ $equipments->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $equipments->appends(['entries_number' => request('entries_number'), 'name' => request('name'), 'brand' => request('brand'),'equipment_status' => request('equipment_status'),])->nextPageUrl() }}">
                  <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                </a>
              </li>
            </ul>
          </nav>
        
      </div>
</div>
<script>
function selectEntries(number) {
    document.getElementById('entries_number').value = number;
}

function selectEquipmentStatus(type) {
    document.getElementById('equipment_status').value = type;
}
</script>
@endsection