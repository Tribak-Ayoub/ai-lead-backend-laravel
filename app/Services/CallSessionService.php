<?php

namespace App\Services;

use App\Models\CallSession;

class CallSessionService
{
    public function list()
    {
        return CallSession::with('lead')->get();
    }

    public function create(array $data)
    {
        return CallSession::create($data);
    }

    public function find(int $id)
    {
        return CallSession::with('lead')->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $callSession = CallSession::findOrFail($id);
        $callSession->update($data);
        return $callSession;
    }

    public function delete(int $id)
    {
        CallSession::destroy($id);
    }
}
