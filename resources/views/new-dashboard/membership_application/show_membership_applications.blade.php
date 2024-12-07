@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Show Membership application')
@section('content')
@include('components.alert')

<section >
    <div class="container py-3">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3">
            <ol class="breadcrumb breadcrumb-style1">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="#">Library</a>
              </li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"></h5>
              {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
              {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
              <div class="d-flex justify-content-center mb-2">

                <a href="" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </a>

                <div class="btn-group ms-1">
                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_to_trush_user_').submit();">
                                <form id="remove_to_trush_user_" action="" method="POST" style="display: none;">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                Remove to trash
                            </a>
                        </li>
                    </ul>
                </div>
                
              </div>
            </div>
          </div>
        </div>
   
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">Bsher</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">Al-Mahayni</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">bsher@gmail.com</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Role</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">Member</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href=""></a>
      </div>
    </div>
  </section>

  <style>
    .rating label {
    cursor: pointer;
    width: 40px;
    height: 40px;
    margin: 0 5px;
    }
    .rating label:before {
    content: '\2605';
    font-size: 2rem;
    color: #ccc;
    transition: color 0.3s;
    }
    .rating input:checked ~ label:before {
  color: #ffc107;
}
    </style>
@endsection
