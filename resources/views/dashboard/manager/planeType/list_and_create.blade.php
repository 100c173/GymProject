@extends('/dashboard/manager/layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Plan Type</h3></div>
                <div class="card-body">
                    <form  action="{{route('plan_types.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input name="name" class="form-control" id="inputName" type="text" placeholder="plan name">
                            <label for="inputName">Plane Type</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                           
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Save</button>
                        </div>
                        
                    </form>
                    <hr>
                    <hr>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th> Plane Type</th>
                                 <th>action</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            @foreach ($plan_types as $plan_type)
                            <tr>
                                 <td>{{$plan_type->name}}</td>
                               
                                 <th> 
                                    
                                    <a href="{{route('plan_types.edit',$plan_type)}}" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                                    <form action="{{route('plan_types.destroy',$plan_type)}}" method="POST" style="display: inline-block;">
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
@endsection