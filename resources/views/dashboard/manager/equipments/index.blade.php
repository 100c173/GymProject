@extends('/dashboard/manager/layout')
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255, 255, 255, 0.5);">
                <div class="card-header">
                    <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                        </path>
                    </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                    DataTable Equipment
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="btn btn-primary" href="index.html">create new sport equipment</a>
                </div>
                <div class="card-body">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        <div class="datatable-top">
                            <div class="datatable-dropdown">
                                <label>
                                    <select class="datatable-selector">
                                        <option value="5">5</option>
                                        <option value="10" selected="">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                    </select> entries per page
                                </label>
                            </div>
                            <div class="datatable-search">
                                <input class="datatable-input" placeholder="Search..." type="search"
                                    title="Search within table" aria-controls="datatablesSimple">
                            </div>
                        </div>
                        <div class="datatable-container">
                            <table id="datatablesSimple" class="datatable-table">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" style="width:14.908579465541491%;">
                                            Name
                                        </th>
                                        <th data-sortable="true" style="width: 14.908579465541491%;">
                                            Type
                                        </th>
                                        <th data-sortable="true" style="width: 14.908579465541491%;">
                                            Brand
                                        </th>
                                        <th data-sortable="true" style="width: 8.720112517580873%;">
                                            Description
                                        </th>
                                        <th data-sortable="true" style="width: 14.486638537271448%;">
                                            image
                                        </th>
                                        <th data-sortable="true" style="width: 14.486638537271448%;">
                                            status
                                        </th>
                                        <th data-sortable="true" style="width: 30.239099859353026%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-index="0">
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-info btn-animate">View</a>
                                            <a href="" class="btn btn-sm btn-secondary btn-animate">Edit</a>
                                            <form action="" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger btn-animate">Delete</button>
                                            </form>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background-image: url('assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg');
            /* استبدل برابط الصورة التي ترغب في وضعها كخلفية */
            background-size: cover;
            /* تغطية الصورة لكامل الشاشة */
            background-position: center;
            /* توسيط الصورة */
            background-attachment: fixed;
            /* ثبات الصورة عند التمرير */
        }

        #datatablesSimple,
        #datatablesSimple th,
        #datatablesSimple td {
            border: 1px solid black;
            /* تعيين لون حدود الجدول للون الأسود */
        }

        #datatablesSimple {
            background-color: rgba(255, 255, 255, 0.6);
            /* لون الخلفية مع شفافية معينة - هنا 0.7 تعني 70% شفافية */
        }
    </style>
@endsection
