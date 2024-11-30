@extends('/dashboard/manager/layout')
@section('content')
<<<<<<< HEAD
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Attendance Record
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <tr>
                        <th> Member Name</th>
                        <th>Session Name </th>
                        <th>Trainer </th>
                        <th>Session Date </th>
                        <th>Session start </th>
                       <th>Attendence status</th>
                        
                    </tr>   
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Member Name</th>
                    <th>Session Name </th>
                    <th>Trainer </th>
                    <th>Session Date </th>
                    <th>Session start </th>
                   <th>Attendence status</th>
                
                </tr>
            </tfoot>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{$appointment->user->name}}</td>
                    <td>{{$appointment->session->name}}</td>
                    <td>{{$appointment->session->user->name}}</td>
                    <td>{{$appointment->session->times->first()->day}} </td>
                    <td>{{$appointment->session->times->first()->start_time}} </td>
                   
                    <td>  
                        <select class="form-select" aria-label="حالة الحضور">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="late">Late</option>
                        </select>
                </tr>
                @endforeach
              
            </tbody>
        </table>
=======

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid px-4">
    <div class="row">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                    </path>
                </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                Member Attendance
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
                        <!-- نموذج الفلترة -->
                        <form action="{{ route('attendance.index') }}" method="GET">
                            <div class="row">
                                <!-- فلترة حسب اسم العضو -->
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="member_name" placeholder="Member Name" value="{{ request('member_name') }}">
                                </div>

                                <!-- فلترة حسب اسم الجلسة -->
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="session_name" placeholder="Session Name" value="{{ request('session_name') }}">
                                </div>

                                <!-- أزرار الفلترة -->
                                <div class="col-md-4 text-end">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="datatable-container">
                        <table id="datatablesSimple" class="datatable-table">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Session Name</th>
                                    <th>Session Date</th>
                                    <th>Session Time</th>
                                    <th> Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <!-- اسم العضو -->
                                    <td>{{ $appointment->user->name }}</td>

                                    <!-- اسم الجلسة -->
                                    <td>{{ $appointment->session->name }}</td>
                                    <!-- وقت الجلسة -->
                                    <td>
                                        @if ($appointment->session->time)
                                        {{ $appointment->session->time->day }}
                                        @else
                                        <p>No times available</p>
                                        @endif
                                    </td>
                                    <!-- وقت الجلسة -->
                                    <td>
                                        @if ($appointment->session->time)
                                        {{ $appointment->session->time->start_time }} - {{ $appointment->session->time->end_time }}
                                        @else
                                        <p>No times available</p>
                                        @endif
                                    </td>

                                    <td>
                                        @if($appointment->attendances->first()?->status == 'nnconfirmed' )
                                        <a href="/attendance/{{$appointment->id}}/1"><button class="btn btn-success btn-sm accept">Present</button></a>
                                        <a href="/attendance/{{$appointment->id}}/0"><button class="btn btn-danger btn-sm reject"> Absent</button></a>
                                        @endif

                                        @if($appointment->attendances->first()?->status == 'present' )
                                        <button class="btn btn-success btn-sm accept">Present</button>
                                        @endif

                                        @if($appointment->attendances->first()?->status == 'absent' )
                                        <button class="btn btn-danger btn-sm reject"> Absent</button>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('attendance.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        <a href="/attendance/{{$appointment->id}}/3"><button class="btn btn-secondary btn-sm reset">Reset</button></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
>>>>>>> feature/attendances
    </div>
</div>

@endsection
<style>
    body {
        background-image: url('assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    #datatablesSimple,
    #datatablesSimple th,
    #datatablesSimple td {
        border: 1px solid black;
    }

    #datatablesSimple {
        background-color: rgba(255, 255, 255, 0.6);
    }
</style>