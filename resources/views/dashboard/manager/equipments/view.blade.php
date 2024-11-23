@extends('/dashboard/manager/layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255, 255, 255, 0.5);">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">View Equipment</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <h4>Name:</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4>Type:</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4>Brand:</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4>Description:</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4>Status:</h4>
                        </div>
                        <a href="#" class="btn btn-sm btn-info btn-animate">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background-image: url('assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: rgba(255, 255, 255, 0.4);
        }
    </style>
@endsection
