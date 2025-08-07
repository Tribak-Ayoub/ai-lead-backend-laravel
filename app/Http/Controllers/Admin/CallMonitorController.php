<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CallSession;

class CallMonitorController extends Controller
{
    public function index(Request $request)
    {
        $query = CallSession::with('lead'); // جلب المكالمات مع معلومات العميل (lead)

        // بحث على lead name أو phone number
        if ($request->search) {
            $search = $request->search;
            $query->whereHas('lead', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // فلترة الحالة status
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // فلترة حسب الوكيل agent (إذا عندك في call_sessions حقل agent)
        if ($request->agent && $request->agent !== 'all') {
            $query->where('agent', $request->agent); // تأكد أن عندك هاد الحقل أو عطيني التفاصيل
        }

        // عرض المكالمات النشيطة فقط
        if ($request->showActiveOnly) {
            $query->whereIn('status', ['in-progress', 'connecting']);
        }

        $calls = $query->paginate(12)->withQueryString();

        // عدد المكالمات النشيطة
        $activeCallsCount = CallSession::whereIn('status', ['in-progress'])->count();

        // إجمالي المكالمات اليوم
        $totalCallsToday = CallSession::whereDate('start_time', now()->toDateString())->count();

        return Inertia::render('CallMonitor/Index', [
            'calls' => $calls,
            'activeCallsCount' => $activeCallsCount,
            'totalCallsToday' => $totalCallsToday,
            'filters' => $request->only(['search', 'status', 'agent', 'showActiveOnly']),
        ]);
    }
}
