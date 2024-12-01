@extends('/dashboard/manager/layout')
@section('content')

    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <a class="btn btn-primary" href="index.html">create new coach</a>
    </div><br>

    <div class="row gx-4">
        @for ($i = 0; $i < 4; $i++)
            <div class="col-xxl-3 col-sm-6">
                <div class="border p-3 rounded-2 text-center mb-4">
                    <img src="assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg" class="img-7x rounded-pill mb-3"
                        alt="Gym Dashboard">
                    <h5>Gwen Richard</h5>
                    <h6>Boxing</h6>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Experience
                            <span class="badge border border-primary text-primary">12 Years</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Available
                            <span class="badge border border-primary text-primary">6-9PM ,5-8PM</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sessions
                            <span class="badge border border-primary text-primary">yoga</span>
                        </li>
                    </ul>
                    <div class="d-grid mb-3">
                        <a href="trainer-profile.html" class="btn btn-outline-primary">View Profile</a>
                    </div>

                </div>
            </div>
        @endfor
    </div>

    <style>

        .border {
            border: 1px solid #e0e0e0;
            /* إضافة حد للعنصر */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* ظل خفيف */
          
        }

        .text-center {
            text-align: center;
            /* محاذاة النص في المركز */
        }

        .img-7x {
            width: 7rem;
            /* تعديل حجم الصورة */
        }

        .rounded-pill {
            border-radius: 50px;
            /* تدوير حواف الصورة لتبدو مستديرة */
        }

        .list-group {
            padding: 0;
            /* إزالة التباعد الداخلي */
        }

        .list-group-item {
            background-color: #f9f9f9;
            /* لون خلفية عنصر القائمة */
            border: none;
            /* إزالة الحدود */
        }

        .list-group-item span {
            font-weight: bold;
            /* جعل النص غامقًا */
        }

        .btn-outline-primary {
            color: #007bff;
            /* لون الزر */
            border-color: #007bff;
            /* لون حدود الزر */
        }

        .btn-outline-primary:hover {
            color: #fff;
            /* تغيير لون النص عند تحويل مؤشر الماوس */
            background-color: #007bff;
            /* تغيير لون الخلفية عند تحويل مؤشر الماوس */
            border-color: #007bff;
            /* تغيير لون حدود الزر عند تحويل مؤشر الماوس */
        }
    </style>
@endsection
