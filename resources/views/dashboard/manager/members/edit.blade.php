@extends('/dashboard/manager/layout')
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="far fa-check-circle me-2"></i> 
        <span style="font-weight: 500">
            {{ session('success') }}
        </span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="far fa-close me-2"></i>
        <span style="font-weight: 500">
            {{ session('error') }}
        </span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">

        {{-- User Information --}}

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h4 class="text-center font-weight-light my-2">User Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('users.update',$user)}}" method="POST" id="edit_user">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-floating mb-3">
                            <input name="first_name" value="{{$user->first_name}}" class="form-control" id="inputFN " type="text" placeholder="Name">
                            <label for="inputFN">First Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="last_name" value="{{$user->last_name}}" class="form-control" id="inputLN" type="text" placeholder="Last Name">
                            <label for="inputLN">Last Name</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input name="email" class="form-control" value="{{$user->email}}" id="inputE-mail" type="email" placeholder="example@gmail.com">
                            <label for="inputE-mail">E-mail</label>
                        </div>
                </div>
            </div>
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h4 class="text-center font-weight-light my-2">Role</h4>
                </div>
                <div class="card-body">

                        <div class="form-floating">
                            <select class="form-control" name="user_role" id="SelectRole">
                                <option value="">User</option>
                                <option value="">Trainer</option>
                                <option value="">Admin</option>
                            </select>
                            <label for="SelectRole">Select Role</label>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                <a class="btn btn-secondary " href="{{route('users.index')}}">Cancel</a>
                <button type="Edit" class="btn btn-primary btn-flat ms-2" form="edit_user">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
        document.getElementById('edit_user').submit();
    }
</script>
@endsection