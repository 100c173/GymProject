@extends('/dashboard/manager/layout')
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="card mb-4">

            <div class="card-header">

                <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"></path>
                </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                DataTable sessions
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="btn btn-primary" href="\create">Add new session</a>
            </div>
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns"><div class="datatable-top">
<div class="datatable-dropdown">
<label>
<select class="datatable-selector"><option value="5">5</option><option value="10" selected="">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select> entries per page
</label>
</div>
<div class="datatable-search">
<input class="datatable-input" placeholder="Search..." type="search" title="Search within table" aria-controls="datatablesSimple">
</div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
   Training Session
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th> Session Name</th>
                    <th>Session Date </th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Registered Members</th>
                    <th>Session status</th>
                    <th>Session Management</th>     
                    <th>Action</th> 
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th> Session Name</th>
                    <th>Session Date </th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Registered Members</th>
                    <th>Session status</th>
                    <th>Session Management</th> 
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>

                     
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                   
                    
                </tr>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>

                     
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                   
                    
                </tr>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>
                     
                    </td>
                   
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>

                     
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>

                     
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                <tr>
                    <td>Cardio</td>
                    <td>4/4/2024   </td>
                    <td>2:00</td>
                    <td>4:00</td>
                    <td>15</td>
                    <td>        <select class="status-dropdown">
                        <option value="inProgress">InProgress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="pending"> Pending</option>
                        <option value="rescheduled">Rescheduled</option>
                      </select></td>
                    <td>
                        <a href="acceptance.html" class="btn btn-sm btn-secondary btn-animate"> Manage</a>
                        <a href="attendence.html" class="btn btn-sm btn-info btn-animate">Log</a>
                    

                     
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger btn-animate">Delete</button>
                        </form>
                    </td>
                    
                </tr>
              
            </tbody>
        </table>
    </div>
</div>
</div>
            </div>
        </div>
    </div>
</div>

@endsection