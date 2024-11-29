@extends('/dashboard/manager/layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Session</h3></div>
                <div class="card-body">
                    <form  action="{{route('plan_types.update',$plan_type)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input name="name" value="{{$plan_type->name}}" class="form-control" id="inputName" type="text" placeholder="plan type">
                            <label for="inputName">Plane Type</label>
                        </div>

                        
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Update</button>
                            
                        </div>
                       

                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection