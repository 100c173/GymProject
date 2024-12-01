@extends('/dashboard/manager/layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Session</h3></div>
                <div class="card-body">
                    <form action="{{route('sessions.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="status" value="active">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputName" name="name" placeholder="SessionName">
                            <label for="inputName">Session Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputDescription" name="description" placeholder="SessionDescription">
                            <label for="inputDescription">Session Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPeriod" name="period" placeholder="inputPeriod">
                            <label for="inputPeriod">Session Period</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputCoach" type="" placeholder="SessionCoach">
                            <label for="inputCoach">Session Coach</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNumberofmembers" type="number" placeholder="NumberOfMembers">
                            <label for="inputNumberofmembers">Number of members</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputAvailabletimes" type="" placeholder="Availabletimes">
                            <label for="inputAvailabletimes"> Available times:</label>
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