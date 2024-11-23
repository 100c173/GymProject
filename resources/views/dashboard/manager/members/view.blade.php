@extends('/dashboard/manager/layout')
@section('content')
    <div class="app-body">

        <!-- Row starts -->
        <div class="row gx-4">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-body">

                        <!-- Row starts -->
                        <div class="row gx-4">
                            <div class="col-xxl-2 col-sm-3">
                                <img src="assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg" class="img-fluid rounded-3"
                                    alt="Gym Dashboard">
                            </div>
                            <div class="col-xxl-4 col-sm-8">
                                <div class="mt-3">
                                    <h6>Hello I am,</h6>
                                    <h3>coach name</h3>
                                    <h6>Fitness and Gym Trainer</h6>
                                    <h6>her Experience</h6>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <!-- Card details start -->
                                <div class="border rounded-2 p-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box lg bg-primary-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-empathize-line fs-4 text-primary"></i>
                                        </div>
                                        <h1 class="text-primary">890</h1>
                                        <h6>Number of trainees</h6>
                                        <span class="badge bg-primary">8 new this week</span>
                                    </div>
                                </div>
                                <!-- Card details end -->
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <!-- Card details start -->
                                <div class="border rounded-2 p-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box lg bg-primary-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-lungs-line fs-4 text-primary"></i>
                                        </div>
                                        <h1 class="text-primary">$90k</h1>
                                        <h6>Earnings</h6>
                                        <span class="badge bg-primary">26% high this week</span>
                                    </div>
                                </div>
                                <!-- Card details end -->
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <!-- Card details start -->
                                <div class="border rounded-2 p-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box lg bg-primary-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-star-line fs-4 text-primary"></i>
                                        </div>
                                        <h1 class="text-primary">3689</h1>
                                        <h6>Reviews</h6>
                                        <span class="badge bg-primary">30 new reviews</span>
                                    </div>
                                </div>
                                <!-- Card details end -->
                            </div>
                        </div>
                        <!-- Row ends -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->

        <!-- Row starts -->
        <div class="row gx-4">
            <div class="col-xl-8 col-sm-12">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-sm-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">About</h5>
                            </div>
                            <div class="card-body">

                                <div class="">
                                    <h6 class="mb-3">Specialized in</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-primary">Fitness</span>
                                        <span class="badge bg-primary">Gym</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Row ends -->

            </div>
            <div class="col-xl-4 col-sm-12">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-xl-12 col-sm-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Avalibility</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="p-2 lh-1 bg-light rounded-2 box-shadow">Mon - 9:AM - 2:PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-6">

                    </div>
                </div>
                <!-- Row ends -->

            </div>
        </div>
        <!-- Row ends -->

    </div>

    <style>
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px 15px;
        }

        .card-title {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .card-body {
            padding: 20px;
        }

        .card p {
            line-height: 1.6;
        }

        .badge {
            font-size: 0.9rem;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
            /* عرض الشارة كمربع مستقل */
            padding: 5px 10px;
            border-radius: 5px;
        }

        .bg-primary {
            background-color: #007bff;
            color: #fff;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .lh-1 {
            line-height: 1;
        }

        .rounded-2 {
            border-radius: 5px;
        }
    </style>
@endsection
