@extends('/dashboard/manager/layout')
@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
<div class="container mt-4">
    <h3>Edit Attendance</h3>
    Member Name:
    <div class="form-floating mb-3">
      <input class="form-control" id="inpuText" type="" placeholder="name@example.com">
     <label for="inputEmail">{{ $appointment->user->first_name }}{{ $appointment->user->last_name }}</label>
    </div>
    Session Name:
    <div class="form-floating mb-3">
       <input class="form-control" id="inpuText" type="" placeholder="name@example.com">
       <label for="inputEmail">{{ $appointment->session->name }}</label>
    </div>
   Session Date:
    <div class="form-floating mb-3">
        <input class="form-control" id="inpuText" type="" placeholder="name@example.com">
        <label for="inputEmail">      @if ($appointment->session->times)
         @foreach ($appointment->session->times as $time)
                    {{ $time->day_of_week }}: 
                      @endforeach
                        @else
                     <p>No times available</p>
                      @endif</label>
   </div>
   Session Time:        
    <div class="form-floating mb-3">
         <input class="form-control" id="inpuText" type="" placeholder="name@example.com">
         <label for="inpuText">@if ($appointment->session->times)  @foreach ($appointment->session->times as $time)
          {{ $time->start_time }} - {{ $time->end_time }}
           @endforeach
           @else
           <p>No times available</p>
               @endif</label>
     </div>
    <form action="{{ route('attendance.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">Attendance Status</label>
            <select class="form-select" name="status" id="status" required>
                <option value="present" {{ $attendance && $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ $attendance && $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Attendance</button>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

