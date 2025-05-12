<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with('user')->get();
        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);
        $patient = $user->patient()->create([
            'medium_acquisition' => $validated['medium_acquisition']
        ]);

        return response()->json([
            'message' => 'Patient created successfully',
            'patient_id' => $patient->id,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return new PatientResource(($patient));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, string $id)
    {
        $validated = $request->validated();

        $patient = Patient::findOrFail($id);
        $patient->medium_acquisition = $validated['medium_acquisition'];
        $patient->save();

        $user = $patient->user;
        $user->update($validated);

        return response()->json([
            'message' => 'Patient updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->user()->delete();

        return response()->json(['message' => 'Patient deleted']);
    }
}
