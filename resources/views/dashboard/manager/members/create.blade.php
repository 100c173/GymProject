@extends('/dashboard/manager/layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Session</h3></div>
                <div class="card-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                            <label for="inputEmail">Coach Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                            <label for="inputEmail">Trainer's specialty</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword" type="number" placeholder="Password">
                            <label for="inputPassword">working hours</label>
                        </div>
                       
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="btn btn-primary" href="index.html">Save</a>
                            
                        </div>
                        
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection