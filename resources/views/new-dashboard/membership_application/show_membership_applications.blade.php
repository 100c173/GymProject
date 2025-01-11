@extends('new-dashboard.layouts.app_dashborad')
@section('title')
{{$membership->user->getFullName() . ' Membership Application'}}
@endsection
@section('content')

<section >
    <div class="container py-3">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3">
            <ol class="breadcrumb breadcrumb-style1">
              <li class="breadcrumb-item">
                <a href="{{route('dashboard.index')}}">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('membership_applications')}}">Membership Applications</a>
              </li>
              <li class="breadcrumb-item active">{{$membership->user->getFullName()}}</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="{{ asset('storage/' . $membership->image_path) }}" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"></h5>
              {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
              {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
              <div class="d-flex justify-content-center mb-2">
                <a class="btn btn-danger btn-sm" href="javascript:{}" onclick="document.getElementById('remove_to_trush_user_').submit();">
                    <form id="remove_to_trush_user_" action="{{route('membership_applications.destroy',$membership->id)}}" method="POST" style="display: none;">
                        @csrf 
                        @method('DELETE')
                    </form>
                    Delete
                </a>
           
                
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
                  <p class="text-muted mb-0">{{$membership->user->first_name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$membership->user->last_name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$membership->user->email}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Role</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$membership->user->roles->first()->name}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="container">
            <h1>CV</h1>
            <div class="pdf-viewer">
                <object data="{{ asset('storage/' . $membership->pdf_path) }}" type="application/pdf" width="100%" height="600">
                    <p>Your browser does not support PDFs. <a href="{{ asset('storage/' . $membership->pdf_path) }}">Download the PDF</a>.</p>
                </object>
            </div>
        </div>
        

        

      
      </div>
    </div>
  </section>

 



@endsection
