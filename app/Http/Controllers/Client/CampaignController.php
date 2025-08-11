<?php

namespace App\Http\Controllers\Client;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller; // ✅ تأكد تضيف هاد السطر

class CampaignController extends Controller
{
    // ✅ عرض جميع الحملات
    public function index()
{
    $campaigns = Campaign::all();

    return Inertia::render('Client/Campaigns', [
        'campaigns' => $campaigns
    ]);
}


  public function update(Request $request, Campaign $campaign)
{
    $data = $request->validate([
        'name' => 'required|string',
        'phone' => 'nullable|string',
        'status' => 'required|in:live,paused',
    ]);

    $campaign->update($data);

    return response()->json([
        'message' => 'Campaign updated successfully',
        'campaign' => $campaign, // رجع الحملة المعدلة فقط
    ]);
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'phone' => 'nullable|string',
        'status' => 'required|in:live,paused',
    ]);

    $campaign = Campaign::create($data);

    // ترجع الصفحة مع بيانات جديدة محدثة
    return redirect()->route('client.Campaigns')->with('success', 'Campaign created successfully');
}

public function destroy(Campaign $campaign)
{
    $campaign->delete();

    return response()->json([
        'message' => 'Campaign deleted successfully',
        'id' => $campaign->id,
    ]);
}
public function show($id)
{
    $campaign = Campaign::findOrFail($id);
    return response()->json($campaign);
    // أو إذا كتستخدم Inertia أو Blade:
    // return Inertia::render('Campaigns/Show', ['campaign' => $campaign]);
}


}
