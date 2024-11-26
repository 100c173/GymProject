@extends('/dashboard/manager/layout')
@section('content')
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
    </div>
</div>
@endsection