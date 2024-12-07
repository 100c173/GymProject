@extends('/dashboard/manager/layout')
@section('content')
@include('components.alert')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Trashed Users</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<br>

<div class="container-fluid px-4">
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table me-1 " aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                    </path>
                </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                Users Table
            </div>
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <form method="GET" action="{{ route('users.trashed') }}">

                                <div class="datatable-dropdown" style="display: inline">
                                    <select name="entries_number" class="datatable-selector" onchange="this.form.submit()">
                                        <option value="5" {{ request('entries_number') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ request('entries_number') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ request('entries_number') == 15 ? 'selected' : '' }}>15</option>
                                        <option value="20" {{ request('entries_number') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="25" {{ request('entries_number') == 25 ? 'selected' : '' }}>25</option>
                                    </select>
                                </div> 

                                <div class="datatable-dropdown" style="display: inline">
                                        <select name="role" class="datatable-selector" onchange="this.form.submit()">
                                            <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>All</option>
                                            <option value="5" {{ request('role') == 5 ? 'selected' : '' }}>Users</option>
                                            <option value="10" {{ request('role') == 10 ? 'selected' : '' }}>Admins</option>
                                            <option value="15" {{ request('role') == 15 ? 'selected' : '' }}>Trainers</option>
                                        </select>
                                </div> 
                        </div>
                                <div class="datatable-search">
                                    <input name="searched_name" class="datatable-input" placeholder="Search..." type="search"
                                    title="Search within table" aria-controls="datatablesSimple">
                                </div>
                            </form>
                    </div>
                    <div class="datatable-container" style="overflow-x: auto; overflow-y: hidden;">
                        <table id="datatablesSimple" class="datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 8.908579465541491%;">
                                        ID
                                    </th>
                                    <th data-sortable="true" style="width: 19.268635724331926%;">
                                        First Name
                                    </th>
                                    <th data-sortable="true" style="width: 19.268635724331926%;">
                                        Last Name
                                    </th>
                                    <th data-sortable="true" style="width:  19.720112517580873%;">
                                    Email
                                    </th>
                                    <th data-sortable="true" style="width:25.239099859353026%;">
                                        Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr data-index="0">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm me-2" href="javascript:{}" onclick="document.getElementById('restore_user_{{$user->id}}').submit();" style="display: inline">
                                            <form id="restore_user_{{$user->id}}" action="{{ route('users.restore', $user) }}" method="POST" style="display: inline">
                                                @csrf 
                                            </form>
                                            <i class="fas  fa-reply-all"></i> Restore
                                        </a>
                                        
                                        <a class="btn btn-danger btn-sm" href="javascript:{}" onclick="document.getElementById('delete_user_permanently_{{$user->id}}').submit();" style="display: inline">
                                            <form id="delete_user_permanently_{{$user->id}}" action="{{ route('users.forceDelete', ['id' => $user->id, 'redirect' => url()->current()]) }}" method="POST" style="display: inline">
                                                @csrf 
                                                @method('DELETE')
                                            </form>
                                            <i class="fas fa-trash-alt"></i> Delete permanently
                                        </a>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>

                        <nav >
                            <ul class="pagination">
                                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->previousPageUrl() }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $users->appends(['entries_number' => request('entries_number'), 'searched_name' => request('searched_name'), 'role' => request('role')])->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* button {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
} */
button.accept {
    background-color: #4CAF50;
    color: white;
}
button.reject {
    background-color: #f44336;
    color: white;
}
</style>
@endsection
