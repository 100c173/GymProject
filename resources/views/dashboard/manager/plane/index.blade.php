@extends('/dashboard/manager/layout')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
  Subscribtion Plans
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <a class="btn btn-primary" href="index.html">create new session</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th> Plane Name</th>
                    <th> Plane Type</th>
                     <th>Period </th>
                     <th> Price</th>
                     <th>With Trainer</th>
                     <th>action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th> Plane Name</th>
                    <th> Plane Type</th>
                     <th>Period </th>
                     <th> Price</th>
                     <th>With Trainer</th>
                     <th>action</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                     <td> Plan1</td>
                     <td>  Premium</td>
                     <td>monthly</td>
                    <td>150$</td>
                    <td> <select class="status-dropdown">
                        <option value="inProgress">Personal</option>
                        <option value="completed">Group</option>
                        <option value="cancelled">None</option>
                     </select></td></td>
                     <th> 
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-animate" >Delete</button>
                        </form></th>
                </tr>
                <tr>
                    <td>  Plan 2</td>
                    <td> Family</td>
                    <td>Annual</td>
                   <td>200$</td>
                   <td> <select class="status-dropdown">
                       <option value="inProgress">Personal</option>
                       <option value="completed">Group</option>
                       <option value="cancelled">None</option>
                    </select></td></td>
                    <th>
                        <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-animate" >Delete</button>
                        </form></th>
               </tr>
               <tr>
                <td>  Plan 3 </td>
                <td>Basic</td>
                <td>Daily</td>
               <td>10$</td>
               <td> <select class="status-dropdown">
                   <option value="inProgress">Personal</option>
                   <option value="completed">Group</option>
                   <option value="cancelled">None</option>
                </select></td></td>
                <th>
                    <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                    <form action="" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger btn-animate" >Delete</button>
                    </form></th>
           </tr>
               

            </tbody>
        </table>
    </div>
</div>
@endsection