<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CallSessionService;
use Illuminate\Http\Request;

class CallSessionController extends Controller
{
    protected $callSessionService;

    public function __construct(CallSessionService $callSessionService)
    {
        $this->callSessionService = $callSessionService;
    }

    public function index()
    {
        return response()->json($this->callSessionService->list());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'outcome' => 'nullable|string',
            'audio_file_path' => 'nullable|string',
            'status' => 'nullable|string',

        ]);
        $callSession = $this->callSessionService->create($data);
        return response()->json($callSession, 201);
    }

    public function show($id)
    {
        return response()->json($this->callSessionService->find($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'outcome' => 'nullable|string',
            'audio_file_path' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        $callSession = $this->callSessionService->update($id, $data);
        return response()->json($callSession);
    }

    public function destroy($id)
    {
        $this->callSessionService->delete($id);
        return response()->json(null, 204);
    }
}
