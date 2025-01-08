@extends('new-dashboard.layouts.app_dashborad')
@section('title', 'Trashed Subscriptions')
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
                        <li class="breadcrumb-item">
                            <a href="{{ route('subscription.index') }}">Subscriptions</a>
                        </li>
                        <li class="breadcrumb-item active">Trash</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Plan Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->user->name }}</td>
                            <td>{{ $subscription->plan->name }}</td>
                            <td>{{ ucfirst($subscription->status) }}</td>
                            <td>
                                <div>
                                    <!-- Permanently Delete Button -->
                                    <form id="force_delete_subscription_{{ $subscription->id }}"
                                        action="{{ route('subscription.forceDelete', ['id' => $subscription->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash me-1"></i> Delete Permanently
                                        </button>
                                    </form>
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
@endsection
