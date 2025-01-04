<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentFilterRequest;
use App\Http\Requests\EquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Services\EquipmentService;
use Illuminate\Http\Request;
use App\Models\SportEquipment;
use App\Http\Requests\SportEquipmentRequest;

class SportEquipmentController extends Controller
{


    /**
     * Service to handle equipment-related logic 
     * and separating it from the controller
     * 
     * @var EquipmentService
     */
    protected $equipmentService;

    /**
     * SportEquipmentController constructor
     *
     * @param EquipmentService $equipmentService
     */
    public function __construct(EquipmentService $equipmentService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the EquipmentService to handle equipment-related logic
        $this->equipmentService = $equipmentService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentFilterRequest $request)
    {

        $validated = $request->validated();
        $equipments = $this->equipmentService->getAllEquipmentsAfterFiltering($validated);

        return view('new-dashboard.equipments.list_equipments', [
            'equipments' => $equipments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new-dashboard.equipments.create_equipment');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param EquipmentRequest $request To store the equipment according to the conditions used
     * in this form request
     */
    public function store(EquipmentRequest $request)
    {

        $validated = $request->validated();
        $equipment = $this->equipmentService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($equipment, 'Equipment created successfully.', 'Failed to Create Equipment.');

        return redirect()->route('equipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SportEquipment $equipment)
    {

        return view('new-dashboard.equipments.show_equipment', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportEquipment $equipment)
    {

        return view('new-dashboard.equipments.edit_equipment', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateEquipmentRequest $request To update the equipment according to the conditions used
     * in this form request
     */
    public function update(UpdateEquipmentRequest $request, SportEquipment $equipment)
    {

        $validated = $request->validated();
        $equipment = $this->equipmentService->update($validated, $equipment);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($equipment, 'Equipment updated successfully.', 'Failed to update equipment.');


        return redirect()->route('equipments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportEquipment $equipment)
    {

        $equipment = $this->equipmentService->delete($equipment);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($equipment, 'Equipment Deleted successfully.', 'Failed to Delete equipment.');

        return redirect()->route('equipments.index');
    }
}
