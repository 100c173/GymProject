@extends('/dashboard/manager/layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Plan</h3></div>
                <div class="card-body">
                    <form  action="{{route('plans.update',$plan)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input name="name" value="{{$plan->name}}" class="form-control" id="inputName" type="text" placeholder="plan name">
                            <label for="inputName">Plane Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="description"value="{{$plan->description}}" class="form-control" id="inputDescription" type="textbox" placeholder="description">
                            <label for="inputDescription">Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="price"value="{{$plan->price}}" class="form-control" id="inputPrice" type="number" placeholder="plan price">
                            <label for="inputPrice">Plane Price</label>
                        </div>
                       
                        <div class="form-floating mb-3">
                            <input name="period"value="{{$plan->period}}" class="form-control" id="inputPeriod" type="number" placeholder="Period">
                            <label for="inputPeriod">Plane Period</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select id="planType" name="plan_type_id" class="form-control">
                                @foreach($plans as $plantype)
                                    <option {{ $plan->plan_type_id == $plantype->id ? 'selected' : '' }} name="plan_type_id" value="{{$plantype->id}}">{{$plantype->name}}</option>
                                 @endforeach  
                               </select>
                               <label for="planType">Plan Type</label>
                        </div>

                        <div>
                            
                            <label>
                                <input {{ $plan->with_trainer == 1 ? 'checked' : '' }} type="radio" name="with_trainer"value="1"  required>
                                With Trainer
                            </label>
                        </div>
                        <div>
                            
                            <label>
                                <input {{ $plan->with_trainer == 0 ? 'checked' : '' }} type="radio" name="with_trainer"value="0"  required>
                                Without Trainer
                            </label>
                        </div>

                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Update</button>
                            
                        </div>
                       

                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection