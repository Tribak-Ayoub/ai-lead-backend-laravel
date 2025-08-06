<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CampaignController extends Controller
{
    // ✅ عرض جميع الحملات
    public function index()
    {
        $campaigns = Campaign::orderByDesc('id')->get();

        return Inertia::render('Campaign/Index', [
            'campaigns' => $campaigns
        ]);
    }

    // ✅ إنشاء حملة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'status' => 'required|in:live,paused',
            'assignedLeads' => 'required|integer|min:0',
        ]);

        $data['conversionRate'] = rand(5, 20); // توليد نسبة عشوائية
        $data['leadsQualified'] = intval($data['assignedLeads'] * 0.15); // حساب المؤهلين

        Campaign::create($data);

        return redirect()->route('campaigns.index')->with('success', 'Campaign created.');
    }

    // ✅ تعديل حملة موجودة
    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'status' => 'required|in:live,paused',
            'assignedLeads' => 'required|integer|min:0',
        ]);

        $data['leadsQualified'] = intval($data['assignedLeads'] * 0.15);

        $campaign->update($data);

        return redirect()->route('campaigns.index')->with('success', 'Campaign updated.');
    }

    // ✅ حذف حملة
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted.');
    }
}
