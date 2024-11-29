@extends('/dashboard/manager/layout')
@section('content')
<div class="d-flex align-items-center justify-content-end me-4 mt-4 mb-0">
    <a class="btn btn-success" href="{{route('plans.create')}}">create new plan</a>
</div>
<div class="container">
    <div class="d-flex align-items-center justify-content-end mt-2 mb-4">

        <div class="container-fluid px-4">
            <div class="row justify-content-center">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
    <div class="card-header">
      
        <i class="fas fa-table me-1"></i>
   Plans
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
            
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                     <td>{{$plan->name}}</td>
                     <td>  {{$plan->planType->name}}</td>
                     <td>{{$plan->period}}</td>
                    <td>{{$plan->price}}</td>
                    <td> {{$plan->with_trainer == 0 ? 'No' : 'yes'}}</td>
                     <th> 
                        <a href="{{route('plans.show',$plan)}}" class="btn btn-sm btn-secondary btn-animate">Show</a>
                        <a href="{{route('plans.edit',$plan)}}" class="btn btn-sm btn-warning btn-animate">Edit</a>
                        <form action="{{route('plans.destroy',$plan)}}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-animate" >Delete</button>
                        </form></th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection