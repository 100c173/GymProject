@extends('/dashboard/manager/layout')
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="card mb-4">

                <div class="card-header">

                    <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
                        </path>
                    </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                    DataTable sessions
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
                                        <th data-sortable="true" style="width: 8.908579465541491%;">
                                            Image
                                        </th>
                                        <th data-sortable="true" style="width: 19.268635724331926%;">
                                            Name
                                        </th>
                                        <th data-sortable="true" style="width: 19.268635724331926%;">
                                            profession
                                        </th>
                                        <th data-sortable="true" style="width:  19.720112517580873%;">
                                          CV
                                        </th>
                                        <th data-sortable="true" style="width:19.239099859353026%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-index="0">
                                        <td><img src="assets/img/1251698b-28df-4178-ba93-b9de32a16816.jpg" class="img-fluid rounded-3" alt="My Image"></td>
                                    
                                        <td>Tiger Nixon</td>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                    
                                        <td>
                                            <a href="" class="btn btn-sm btn-success btn-animate">accept</a>
                                            <a href="" class="btn btn-sm btn-danger btn-animate">reject</a>
                                        
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
        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
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
