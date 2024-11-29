@extends('/dashboard/manager/layout')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid px-4">
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"></path>
                </svg>
                DataTable sessions
            </div>

            <div class="d-flex justify-content-between mt-4 mb-0">
                <a class="btn btn-primary" href="{{route('sessions.create')}}">Add New Session</a>
            </div>

            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top d-flex justify-content-between align-items-center mb-4">
                        <!-- Entries per page dropdown -->
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector form-select">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>

                    </div>

                    <!-- Filter Form -->
                    <form action="{{ route('sessions.index') }}" method="GET" class="d-flex gap-3 mb-4">
                        <div class="form-group w-25">
                            <label for="sessionFilter" class="form-label">Session Name</label>
                            <input type="text" class="form-control" id="sessionFilter" name="session_name" value="{{ request('session_name') }}" placeholder="Session Name">
                        </div>

                        <div class="form-group w-25">
                            <label for="memberFilter" class="form-label">Max Members</label>
                            <input type="number" class="form-control" id="memberFilter" name="max_members" value="{{ request('max_members') }}" placeholder="Max Members">
                        </div>

                        <button type="submit" class="btn btn-primary align-self-end">Filter</button>
                    </form>

                    <!-- Sessions Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Training Session
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Session Name</th>
                                        <th>Session Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Registered Members</th>
                                        <th>Session Status</th>
                                        <th>Management</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Session Name</th>
                                        <th>Session Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Registered Members</th>
                                        <th>Session Status</th>
                                        <th>Management</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody id="sessionsTable">
                                    @foreach($sessions as $session)
                                    <tr class="session-row" data-session-name="{{ strtolower($session->name) }}" data-member-count="{{ $session->appointments->count() }}">
                                        <td>{{$session->name}}</td>
                                        <td>{{$session->time->day}}</td>
                                        <td>{{$session->time->start_time}}</td>
                                        <td>{{$session->time->end_time}}</td>
                                        <td>{{$session->appointments->count()}}</td>
                                        <td>{{$session->status}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-secondary btn-animate">Manage</a>
                                            <a href="/appointments" class="btn btn-sm btn-info btn-animate">Log</a>
                                        </td>
                                        <td>
                                            <a href="{{route('sessions.show',$session->id)}}" class="btn btn-sm btn-info btn-animate">View</a>
                                            <a href="{{route('sessions.edit',$session->id)}}" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                                            <form action="{{route('sessions.destroy',$session->id)}}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-animate">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add JavaScript for Filtering -->
    <script>
        document.getElementById('sessionFilter').addEventListener('input', function() {
            filterSessions();
        });

        document.getElementById('memberFilter').addEventListener('input', function() {
            filterSessions();
        });

        function filterSessions() {
            const sessionFilter = document.getElementById('sessionFilter').value.toLowerCase();
            const memberFilter = document.getElementById('memberFilter').value;

            const rows = document.querySelectorAll('.session-row');

            rows.forEach(row => {
                const sessionName = row.getAttribute('data-session-name');
                const memberCount = row.getAttribute('data-member-count');

                // Check if the row matches the filters
                const matchesSessionName = sessionName.includes(sessionFilter);
                const matchesMemberCount = memberFilter ? memberCount <= memberFilter : true;

                // Show or hide the row based on filter criteria
                if (matchesSessionName && matchesMemberCount) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

@endsection
