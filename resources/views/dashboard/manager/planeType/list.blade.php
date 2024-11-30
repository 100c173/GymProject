@extends('/dashboard/manager/layout')
@section('content')

<div class="container">
    <div class="d-flex align-items-center justify-content-end mt-4 me-3 mb-0">
        <a class="btn btn-success" href="{{route('plan_types.create')}}">Create new plan type</a>
    </div>
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
                <div class="card shadow-lg border-0 rounded-lg mt-4 mb-4">
                    <div class="card-header">
                        <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                            </path>
                        </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                        DataTable Plan types
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                     <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plan_types as $plan_type)
                                <tr>
                                     <td>{{$plan_type->id}}</td>
                                     <td>{{$plan_type->name}}</td>
                                     <td>{{$plan_type->created_at}}</td>
                                   
                                     <th> 
                                        
                                         <a href="{{route('plan_types.show',$plan_type)}}" class="btn btn-sm btn-secondary btn-animate">Show</a>
                                        <a href="{{route('plan_types.edit',$plan_type)}}" class="btn btn-sm btn-warning btn-animate">Edit</a>
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