<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\LeadStatus;

class LeadController extends Controller
{
    // قائمة جميع الـ leads
    public function index()
    {
        $leads = Lead::latest()->get();

        return Inertia::render('Leads/Index', [
            'leads' => $leads,
            'statuses' => array_column(LeadStatus::cases(), 'value'),
        ]);
    }

    // صفحة إنشاء lead جديد
    public function create()
    {
        return Inertia::render('Leads/Create', [
            'statuses' => array_column(LeadStatus::cases(), 'value'),
        ]);
    }

    // حفظ lead جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone_number' => 'required|string|max:20',
            'qualification' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_column(LeadStatus::cases(), 'value')),
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    // عرض lead واحد بالتفصيل
    public function show(Lead $lead)
    {
        return Inertia::render('Leads/Show', [
            'lead' => $lead,
        ]);
    }

    // صفحة تعديل lead
    public function edit(Lead $lead)
    {
        return Inertia::render('Leads/Edit', [
            'lead' => $lead,
            'statuses' => array_column(LeadStatus::cases(), 'value'),
        ]);
    }

    // تحديث lead
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone_number' => 'required|string|max:20',
            'qualification' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_column(LeadStatus::cases(), 'value')),
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        $lead->update($validated);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    // حذف lead
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
