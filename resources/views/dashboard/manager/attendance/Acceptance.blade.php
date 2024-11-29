@extends('/dashboard/manager/layout')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Acceptance Member</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="sessions.html">Back</a></li>
   </ol>
  
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Acceptance Member
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <tr>
                            <th>Member Name</th>
                            <th>Session Name </th>
                            <th>Session Date </th>
                            <th>Session Start </th>
                            <th>Action</th>
                            
                        </tr>   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <td>{{$session->user->first()->name}}</td>
                        <td>{{$session->name}}</td>
                        <td>{{$session->times->first()->day}}</td>
                        <td>{{$session->times->first()->start_time}}</td>
                       
                        <td>               
                            <select class="form-select" aria-label="حالة الحضور">
                            <option value="present">Accept</option>
                            <option value="absent">Reject</option>
                           
                          </select>

                       
                        
                    </tr>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection