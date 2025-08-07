<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallSession;
use Inertia\Inertia;
use App\Models\Lead;

class CallLogController extends Controller
{
        // عرض جميع المكالمات
    public function index()
    {
        $sessions = CallSession::with('lead')->latest()->get();
            
        return Inertia::render('Client/call-logs', [
            'sessions' => $sessions,
        ]);
    }

    // عرض صفحة إضافة مكالمة
    public function create()
    {
        $leads = Lead::all();

        return Inertia::render('CallLogs/Create', [
            'leads' => $leads,
        ]);
    }

    // حفظ مكالمة جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'outcome' => 'nullable|string',
            'status' => 'required|in:pending,completed,failed', // مطابق لل enum
        ]);

        CallSession::create($validated);

        return redirect()->route('calllogs.index')->with('success', 'تمت إضافة الجلسة بنجاح');
    }

    // عرض صفحة تعديل المكالمة
    public function edit($id)
    {
        $session = CallSession::findOrFail($id);
        $leads = Lead::all();

        return Inertia::render('CallLogs/Edit', [
            'session' => $session,
            'leads' => $leads,
        ]);
    }

    // تعديل الجلسة
    public function update(Request $request, $id)
    {
        $session = CallSession::findOrFail($id);

        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'outcome' => 'nullable|string',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $session->update($validated);

        return redirect()->route('calllogs.index')->with('success', 'تم التعديل بنجاح');
    }

    // حذف الجلسة
    public function destroy($id)
    {
        $session = CallSession::findOrFail($id);
        $session->delete();

        return redirect()->route('calllogs.index')->with('success', 'تم الحذف بنجاح');
    }
}

