<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BillingAndPlanController extends Controller
{


    // عرض واجهة الخطة
    public function index()
    {
        $user = Auth::user();
        // $subscription = $user->subscriptions()->latest()->first(); // كنتي معلقها

        return Inertia::render('Client/billing-plan', [
            'plan' => $subscription?->plan ?? 'free',
            // 'started_at' => $subscription?->started_at,
            // 'ended_at' => $subscription?->ended_at,
        ]);
    }

    // ترقية الخطة
    public function upgrade(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:free,pro,enterprise',
        ]);

        $user = $request->user();

        // نوقف الاشتراك الحالي
        $latest = $user->subscriptions()->latest()->first();
        if ($latest && !$latest->ended_at) {
            $latest->update(['ended_at' => now()]);
        }

        // نضيف اشتراك جديد
        $user->subscriptions()->create([
            'plan' => $request->plan,
            'started_at' => now(),
            'ended_at' => null,
        ]);

        return redirect()->back()->with('success', 'تمت الترقية بنجاح');
    }

    // إلغاء الخطة
    public function cancel(Request $request)
    {
        $user = $request->user();

        $latest = $user->subscriptions()->latest()->first();
        if ($latest && !$latest->ended_at) {
            $latest->update(['ended_at' => now()]);
        }

        // نرجعو لخطة مجانية
        $user->subscriptions()->create([
            'plan' => 'free',
            'started_at' => now(),
            'ended_at' => null,
        ]);

        return redirect()->back()->with('success', 'تم إلغاء الاشتراك. تم الرجوع إلى الخطة المجانية.');
    }

    // حذف الاشتراك نهائيا (اختياري)
    public function destroy($id)
    {
        // $subscription = Subscription::findOrFail($id);

        // $this->authorize('delete', $subscription); // إذا عندك صلاحيات

        // $subscription->delete();

        return redirect()->back()->with('success', 'تم حذف الاشتراك بنجاح.');
    }
}


