<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lead;
use App\Models\CallSession;
use Carbon\Carbon;
class ClientDashboardController extends Controller
{


    public function stats(Request $request)
    {
        $clientId = $request->user()->id; // نفترض هنا ان ال Client هو المستخدم المسجل

        // إجمالي الـ Leads للعميل
        $totalLeads = Lead::where('client_id', $clientId)->count();

        // Leads المؤهلة (مثلاً حالة QUALIFIED حسب Enum LeadStatus)
        $qualifiedLeads = Lead::where('client_id', $clientId)
                              ->where('status', 'QUALIFIED')
                              ->count();

        // نسبة التحويل (conversion rate)
        $conversionRate = $totalLeads > 0 ? ($qualifiedLeads / $totalLeads) * 100 : 0;

        // عدد المكالمات اليوم
        $callsToday = CallSession::where('client_id', $clientId)
                                 ->whereDate('startTime', Carbon::today())
                                 ->count();

        return response()->json([
            'totalLeads' => $totalLeads,
            'qualifiedLeads' => $qualifiedLeads,
            'conversionRate' => round($conversionRate, 2), // تقريبا بدقة خانتين عشريتين
            'callsToday' => $callsToday,
        ]);
    }
}

