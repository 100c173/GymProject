@extends('/dashboard/manager/layout')
@section('content')

<!-- Show messages in case of errors -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Edit Session</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('sessions.update',$session->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="session_id" value="{{$session->id}}">
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputName" name="name" value="{{$session->name}}">
                            <label for="inputName" >Session Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" id="inputDescription" >{{$session->description}}</textarea>
                            <label for="inputDescription">Session Description</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNumberofmembers" name="members_number" value="{{$session->max_members}}">
                            <label for="inputNumberofmembers">Number of members</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="time_id" id="time_id">
                                <option value="">Select Time</option>
                                @foreach($times as $time)
                                <option value="{{ $time->id }}">
                                    {{ $time->day }} | {{ $time->start_time }} - {{ $time->end_time }}
                                </option>
                                @endforeach
                            </select>
                            <label for="time_id">Available Times</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                                <option value="completed">completed</option>
                                
                            </select>
                            <label for="status">Status</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="hidden" id="selected_trainer" name="trainer_id">
                            <div class="dropdown-center">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select a Coach
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($trainers as $trainer)
                                    <li>
                                        <button class="dropdown-item" type="button" data-value="{{ $trainer->id }}">{{ $trainer->name }}</button>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-primary">

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            document.getElementById('selected_trainer').value = this.getAttribute('data-value');
        });
    });
</script>
@endsection