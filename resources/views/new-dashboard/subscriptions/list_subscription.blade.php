@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'subscription')
@section('content')
    @extends('components.alert')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3">
            <!-- Breadcrumb -->
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Subscriptions</li>
                    </ol>
                </nav>
            </div>

            <!-- Filter Button -->
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <a class="btn btn-primary me-1" data-bs-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    Filter
                </a>
            </div>
        </div>

        <!-- Filter Content -->
        <div class="collapse" id="collapseExample">
            <div class="d-flex p-4">
                <div class="card mb-6 w-100">
                    <h4 class="card-header">Filter</h4>
                    <form id="FilterForm" action="{{ route('subscription.index') }}" method="GET">
                        <div class="card-body">
                            <div class="row mb-3 d-flex align-items-center">
                                <!-- Search -->
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label class="col-form-label me-2" for="basic-icon-default-fullname2">Search</label>
                                    <div class="input-group input-group-merge flex-grow-1">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-search"></i></span>
                                        <input name="search" value="{{ request('search') }}" type="text"
                                            class="form-control" id="basic-icon-default-fullname2"
                                            placeholder="Search Something" aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2">
                                    </div>
                                </div>
                                <!-- filter by subscription status -->
                                <div class="col-sm-2 d-flex align-items-center">
                                    <input type="hidden" name="status" value="{{ request('status') }}" id="status">
                                    <div class="btn-group me-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="statusDropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Subscription Status
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                            @foreach (['ongoing', 'finished', 'all'] as $status)
                                                <li>
                                                    <a class="dropdown-item {{ request('status') == $status ? 'active' : '' }}"
                                                        href="javascript:void(0);"
                                                        onclick="selectStatus('{{ $status }}')">
                                                        {{ $status }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- sort by -->
                                <div class="col-sm-2 d-flex align-items-center">
                                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}" id="sort_by">
                                    <div class="btn-group" style="margin-left: 10px;">
                                        <!-- added margin-left to create space -->
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="rateableTypeDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Sort by
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="rateableTypeDropdown">
                                            <li>
                                                <a class="dropdown-item {{ request('sort_by') == 'start_date' ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectSortBy('start_date')">Start
                                                    Date </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item {{ request('sort_by') == 'plan_name' ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectSortBy('plan_name')">Plan Name
                                                    (A to Z)</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>





                                <!-- Entries Number Dropdown -->
                                <div class="col-sm-2 d-flex align-items-center">
                                    <input type="hidden" value="{{ request('entries_number') }}" name="entries_number"
                                        id="entries_number">
                                    <div class="btn-group me-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="entriesDropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Entries Number
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="entriesDropdown">
                                            <li><a class="dropdown-item {{ request('entries_number') == 5 ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectEntries('5')">5</a></li>
                                            <li><a class="dropdown-item {{ request('entries_number') == 10 ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectEntries('10')">10</a></li>
                                            <li><a class="dropdown-item {{ request('entries_number') == 15 ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectEntries('15')">15</a></li>
                                            <li><a class="dropdown-item {{ request('entries_number') == 20 ? 'active' : '' }}"
                                                    href="javascript:void(0);" onclick="selectEntries('20')">20</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <!-- Apply Button -->
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button class="btn btn-primary me-1">APPLY</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (request('status') == 'finished')
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-warning" href="javascript:{}"
                    onclick="document.getElementById('move_to_trash_form').submit();">
                    delete all
                </a>
                <form id="move_to_trash_form" action="{{ route('subscription.AllMoveToTrash') }}" method="POST"
                    style="display:none;">
                    @csrf
                </form>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> Subscriber Name</th>
                        <th>Plan Name</th>
                        <th>Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td><i class="fab fa-angular fa-xl text-danger me-4"></i> <span>{{ $subscription->id }}</span>
                            </td>
                            <td>{{ $subscription->user->getFullName() }}</td>
                            <td>
                                {{ $subscription->plan->name }}
                                </ul>
                            </td>
                            <td>

                                @if ($subscription->status == 'ongoing')
                                    <span class="badge bg-label-success">OnGoing</span>
                                @endif
                                @if ($subscription->status == 'finished')
                                    <span class="badge bg-label-danger">Finished</span>
                                @endif

                            </td>
                            <td>
                                {{ $subscription->start }}
                            </td>
                            <td>
                                {{ $subscription->end }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="javascript:{}"
                                            onclick="document.getElementById('remove_to_trash_subscription_{{ $subscription->id }}').submit();">
                                            <i class="bx bx-trash me-1"></i>
                                            <form id="remove_to_trash_subscription_{{ $subscription->id }}"
                                                action="{{ route('subscription.destroy', $subscription) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            Remove to trash
                                        </a>

                                        <a class="dropdown-item" href="javascript:{}"
                                            onclick="document.getElementById('force_delete_subscription_{{ $subscription->id }}').submit();">
                                            <i class="bx bx-trash me-1"></i>
                                            <form id="force_delete_subscription_{{ $subscription->id }}"
                                                action="{{ route('subscription.forceDelete', ['id' => $subscription->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            Delete permanently
                                        </a>


                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Previous Page Link -->
                    <li class="page-item {{ $subscriptions->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $subscriptions->previousPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>

                    <!-- Pagination Links -->
                    @for ($i = 1; $i <= $subscriptions->lastPage(); $i++)
                        <li class="page-item {{ $subscriptions->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $subscriptions->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next Page Link -->
                    <li class="page-item {{ $subscriptions->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $subscriptions->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
    <script>
        function selectRole(value) {
            document.getElementById('role').value = value;
        }

        function selectEntries(value) {
            document.getElementById('entries_number').value = value;
        }

        function selectSortBy(sortBy) {
            document.getElementById('sort_by').value = sortBy;
            // Submit the form or reload with the new sorting
            document.forms[0].submit();
        }

        function selectStatus(status) {
            const statusInput = document.getElementById('status');
            if (status === 'all') {
                statusInput.value = '';
            } else {
                statusInput.value = status;
            }
            document.forms[0].submit();
        }
    </script>
@endsection
