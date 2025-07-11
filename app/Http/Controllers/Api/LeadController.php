<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LeadService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    protected $leadService;

    public function __construct(LeadService $leadService)
    {
        $this->leadService = $leadService;
    }

    public function index()
    {
        return response()->json($this->leadService->list());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone_number' => 'required|string|unique:leads,phone_number',
            'status' => 'nullable|string',
            'qualification' => 'nullable|string',
            'last_call_at' => 'nullable|date',
            'call_attempts' => 'nullable|integer|min:0',
        ]);

        $lead = $this->leadService->create($data);
        return response()->json($lead, 201);
    }

    public function show($id)
    {
        return response()->json($this->leadService->find($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone_number' => "sometimes|string|unique:leads,phone_number,$id",
            'status' => 'nullable|string',
            'qualification' => 'nullable|string',
            'last_call_at' => 'nullable|date',
            'call_attempts' => 'nullable|integer|min:0',
        ]);

        $lead = $this->leadService->update($id, $data);
        return response()->json($lead);
    }

    public function destroy($id)
    {
        $this->leadService->delete($id);
        return response()->json(null, 204);
    }
}
