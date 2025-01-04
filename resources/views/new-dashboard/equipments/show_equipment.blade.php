@extends('new-dashboard.layouts.app_dashborad')
@section('title')
{{$equipment->name}}
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="dropdown float-end">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('equipments.edit', $equipment) }}">
                        <i class="bx bx-edit-alt me-1"></i>Edit
                    </a>
                    <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('remove_equipment_{{ $equipment->id }}').submit();">
                        <i class="bx bx-trash me-1"></i>
                        <form id="remove_equipment_{{ $equipment->id }}" action="{{ route('equipments.destroy', $equipment) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        Delete
                    </a>
                </div>
            </div>
            <h5 class="card-title">{{ $equipment->name }}</h5>
            <p class="card-text">{{ $equipment->description }}</p>
            <p class="card-text">
                @if ($equipment->equipment_status == 'available')
                    <span class="badge bg-label-success me-1">{{ $equipment->equipment_status }}</span>
                @elseif ($equipment->equipment_status == 'damaged')
                    <span class="badge bg-label-danger me-1">{{ $equipment->equipment_status }}</span>
                @elseif ($equipment->equipment_status == 'under maintenance')
                    <span class="badge bg-label-warning me-1">{{ $equipment->equipment_status }}</span>
                @endif
            </p>
        </div>
        <img src="{{ asset('storage/' . $equipment->image_path) }}" class="card-img-bottom" alt="Camera"/>
    </div>
</div>

      @endsection
