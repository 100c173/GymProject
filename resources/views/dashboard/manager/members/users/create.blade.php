@extends('/dashboard/manager/layout')
@section('content')
@include('components.alert')

<div class="container">
    <div class="row justify-content-center">

        {{-- User Information --}}

        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h4 class="text-center font-weight-light my-2">User Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="POST" id="create_user">
                        @csrf

                        <input type="hidden" name="redirect_to" id="redirect_to" value="">

                        <div class="form-floating mb-3">
                            <input name="first_name" class="form-control" id="inputFN " type="text" placeholder="Name">
                            <label for="inputFN">First Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="last_name" class="form-control" id="inputLN" type="text" placeholder="Last Name">
                            <label for="inputLN">Last Name</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input name="email" class="form-control" id="inputE-mail" type="email" placeholder="example@gmail.com">
                            <label for="inputE-mail">E-mail</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" >
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input required name="password_confirmation" class="form-control" id="inputPassword" type="password" placeholder="Password">
                            <label for="inputPassword">Confirm Password</label>
                        </div>
                </div>
            </div>
        </div>

        {{-- User Role --}}

        <div class="col-lg-5">
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
                <a id = "submit_redirect_index" class="btn btn-primary btn-flat ">Create</a>
                <a id="submit_redirect_create" class="btn btn-secondary ms-2">Create & Create Another One</a>
                <a class="btn btn-secondary ms-2" href="{{route('users.index')}}">Cancel</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('submit_redirect_index').addEventListener('click', function(event) {
        document.getElementById('redirect_to').value = 'index';
        document.getElementById('create_user').submit();
    });
    document.getElementById('submit_redirect_create').addEventListener('click', function(event) {
        document.getElementById('redirect_to').value = 'create';
        document.getElementById('create_user').submit();
    });
</script>
@endsection