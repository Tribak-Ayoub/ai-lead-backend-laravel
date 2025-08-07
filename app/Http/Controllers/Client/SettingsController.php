<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SettingController extends Controller
{
    // عرض صفحة الإعدادات مع بيانات المستخدم
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return Inertia::render('Settings/Index', [
            'user' => $user,
            // يمكن تضيف هنا بيانات إضافية إذا بغيت
        ]);
    }

    // تحديث معلومات الملف الشخصي
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'timezone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|string', // URL أو Base64 أو غيرها
        ]);

        $user->update($data);

        return redirect()->route('settings.index')->with('success', 'Profile updated successfully!');
    }

    // تغيير كلمة السر
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'current' => 'required|string',
            'new' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current, $user->password)) {
            return back()->withErrors(['current' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Password updated successfully!');
    }

    // تحديث إعدادات الإشعارات (مثلاً تخزين JSON في عمود مخصص)
    public function updateNotifications(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $notifications = $request->input('notifications', []);

        // تأكد تخزينه كـ JSON في العمود
        $user->notification_settings = json_encode($notifications);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Notification preferences saved!');
    }

    // تحديث التفضيلات العامة (تخزين JSON في عمود مخصص)
    public function updatePreferences(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $preferences = $request->input('preferences', []);

        $user->preferences = json_encode($preferences);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Preferences saved successfully!');
    }

    // تبديل حالة التحقق بخطوتين 2FA
    public function toggle2FA()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->save();

        $message = $user->two_factor_enabled ? '2FA enabled!' : '2FA disabled!';

        return redirect()->route('settings.index')->with('success', $message);
    }
}
