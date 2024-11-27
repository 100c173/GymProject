@extends('/dashboard/manager/layout')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
  Subscribtion Plans
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <a class="btn btn-primary" href="{{route('plans.create')}}">create new session</a>
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
                     <td>{{$plan->name}}</td>
                     <td>  {{$plan->planType->name}}</td>
                     <td>{{$plan->period}}</td>
                    <td>{{$plan->price}}</td>
                    <td> <select class="status-dropdown">
                        <option value="inProgress">Personal</option>
                        <option value="completed">Group</option>
                        <option value="cancelled">None</option>
                     </select></td>
                     <th> 
                        <a href="{{route('plans.edit',$plan)}}" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                        <form action="{{route('plans.destroy',$plan)}}" method="POST" style="display: inline-block;">
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