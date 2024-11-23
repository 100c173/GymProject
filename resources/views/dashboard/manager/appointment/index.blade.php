@extends('/dashboard/manager/layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Appoinment Members</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
   </ol>
  
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Appoinment Members
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <tr>
                            <th> Member Name</th>
                            <th>Session Name </th>
                            <th>Session Date </th>
                            <th>Session Start </th>
                            <th>Action</th>
                            
                        </tr>   
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th> Member Name</th>
                        <th>Session Name </th>
                        <th>Session Date </th>
                        <th>Session Start </th>
                       <th>Action</th>
                    
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>Cardio</td>
                        <td>4/4/2024   </td>
                        <td>2;00  </td>
                       
                        <td>               <select class="form-select" aria-label="حالة الحضور">
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