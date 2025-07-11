<?php

namespace App\Services;

use App\Models\Lead;

class LeadService
{
    public function list()
    {
        return Lead::all();
    }

    public function create(array $data)
    {
        return Lead::create($data);
    }

    public function find(int $id)
    {
        return Lead::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($data);
        return $lead;
    }

    public function delete(int $id)
    {
        Lead::destroy($id);
    }
}
