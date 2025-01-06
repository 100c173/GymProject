@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Show Session')
@section('content')
@extends('components.alert')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">View session</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-floating mb-3">
                            <h4> Name: {{$session->name}}</h4>

                        </div>
                        <div class="form-floating mb-3">
                            <h4> Description: {{$session->description}}</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4> period : {{$session->time->getStartAndEndtime() }}</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4>Coach: {{ $session->getFullName ?? 'No coach assigned' }}</h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4> Number of members: {{$session->max_members}} </h4>
                        </div>
                        <div class="form-floating mb-3">
                            <h4> date: {{$session->time->day}}</h4>
                        </div>
                        <a href="{{route('sessions.index')}}" class="btn btn-sm btn-info btn-animate">back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection