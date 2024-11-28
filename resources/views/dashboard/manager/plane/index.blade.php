@extends('/dashboard/manager/layout')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <form method="GET"action="{{route('plans.search')}}" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            @csrf
            <div class="input-group">
                 <input class="form-control" type="text"name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                 <button class="btn btn-primary" id="btnNavbarSearch" type="submit">Search<i class="fas fa-search"></i></button>
             </div>
         </form>
        <i class="fas fa-table me-1"></i>
  Subscribtion Plans
    </div>
    
           
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <a class="btn btn-primary" href="{{route('plans.create')}}">create new plan</a>
        <a class="btn btn-primary" href="{{route('plan_types.index')}}">create new plan type</a>
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
                @foreach ($plans as $plan)
                <tr>
                     <td>{{$plan->name}}</td>
                     <td>  {{$plan->planType->name}}</td>
                     <td>{{$plan->period}}</td>
                    <td>{{$plan->price}}</td>
                    <td>
                    <div>
                        @if($plan->with_trainer==0)
                            None
                        @elseif($plan->with_trainer==1)
                            Personal Trainer
                        @else
                             Group
                        @endif
                       
                    </div>
                  
                    </td>
                     <th> 
                        <a href="{{route('plans.show',$plan)}}" class="btn btn-sm btn-secondary btn-animate">Show</a>
                        <a href="{{route('plans.edit',$plan)}}" class="btn btn-sm btn-secondary btn-animate">Edit</a>
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
@endsection