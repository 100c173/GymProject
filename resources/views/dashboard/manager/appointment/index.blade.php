@extends('/dashboard/manager/layout')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4">Appoinment Members</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
   </ol>
  
   <div class="container-fluid px-4">
    <div class="row">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="card-header">
       
        <div class="card-header">
            <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                data-fa-i2svg="">
                <path fill="currentColor"
                    d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                </path>
            </svg>
            Appoinment Members
        </div>

        <div class="card-body">
            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                <div class="datatable-top">
                    <div class="datatable-dropdown">
                        <label>
                            <select class="datatable-selector">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select> entries per page
                        </label>
                    </div>
                    <div class="datatable-search">
                        <form action="{{ route('appointment.search') }}" method="get" class="d-flex">
                            @csrf
                            <input class="form-control me-3" name="search" style="width: 520px;" type="search" aria-label="Search" placeholder="Search " value="{{request('search')}}">
                                <button class="btn btn-info me-5 mt-1" style="font-weight: 600;"  type="submit">Search</button>
                        </form>
                    </div>
                </div>
                <div class="datatable-container">
                    <table id="datatablesSimple" class="datatable-table">
                <thead>
                    <tr>
                        <tr>
                            <th> Member Name</th>
                            <th>Session Name </th>
                            <th>Session Date </th>
                            <th>Session Start </th>
                            <th>Session End </th>
                            <th>Action</th>

                        </tr>   
                    </tr>
                </thead>
                
                <tbody>
                    
                        @foreach ($appointments as $appointment )
                       
                        <tr  id="appointment-{{ $appointment->id }}">
                        <td>{{$appointment->user->name}}</td>
                        <td>{{$appointment->session->name}}</td>
                        <td>{{ $appointment->session->time->day }}</td>
                        <td>{{ $appointment->session->time->start_time }}</td>
                        <td>{{ $appointment->session->time->end_time  }}</td>
                        <td>
                           @if($appointment->status == 'pending' )
                           <a href="/appointments/update_status/{{$appointment->id}}/1"><button class="btn btn-success btn-sm accept" >Accept</button></a>
                           <a href="/appointments/update_status/{{$appointment->id}}/0"><button class="btn btn-danger btn-sm reject" >Reject</button></a> 
                           @endif
                           @if($appointment->status == 'accepted')
                                <button class="btn btn-success btn-sm accept" >approved</button>
                           @endif
                           @if($appointment->status == 'cancelled')
                                <button class="btn btn-danger btn-sm reject" >rejected</button>
                           @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection