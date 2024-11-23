@extends('/dashboard/manager/layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255, 255, 255, 0.5);">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Update equipment</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                                <label for="inputEmail">Equipment Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                                <label for="inputEmail">Equipment Type</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                                <label for="inputEmail">Equipment Brand</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="" placeholder="name@example.com">
                                <label for="inputEmail">Equipment Description</label>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <select class="form-select" id="validationCustom04" required>
                                    <option selected disabled value=""></option>
                                    <option>available</option>
                                    <option>Not available</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>
                            </div>
                            <br>
                            <div class="">
                                <input class="form-control" id="inputPassword" type="file" placeholder="Password"
                                    name="image">

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
