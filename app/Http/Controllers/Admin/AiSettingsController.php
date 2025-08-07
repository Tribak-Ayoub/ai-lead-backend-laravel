<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AiSetting;

class AiSettingsController extends Controller
{

    // عرض الإعدادات
    public function getSettings()
    {
        // $settings = AiSetting::first();

        // if (!$settings) {
        //     // إذا لم يكن موجودًا أنشئ نموذج فارغ مع قيم افتراضية
        //     $settings = new AiSetting([
        //         'whisper_version' => null,
        //         'piper_voice' => null,
        //         'gpt_key_pool' => [],
        //         'current_key_index' => 0,
        //     ]);
    // //     }

    //     return response()->json($settings);
    }

    // تحديث الإعدادات
    public function updateSettings(Request $request)
    {
        $request->validate([
            'whisper_version' => 'nullable|string',
            'piper_voice' => 'nullable|string',
            'gpt_key_pool' => 'nullable|array',
            'gpt_key_pool.*' => 'string', // كل مفتاح في المصفوفة يجب أن يكون نصاً
        ]);

        // $settings = AiSetting::first();

        // if (!$settings) {
        //     $settings = new AiSetting();
        // }

    //     $settings->whisper_version = $request->input('whisper_version', $settings->whisper_version);
    //     $settings->piper_voice = $request->input('piper_voice', $settings->piper_voice);

    //     if ($request->has('gpt_key_pool')) {
    //         $settings->gpt_key_pool = $request->input('gpt_key_pool');
    //         // بعد تحديث قائمة المفاتيح، نرجع مؤشر المفتاح الحالي للصفر
    //         $settings->current_key_index = 0;
    //     }

    //     $settings->save();

    //     return response()->json([
    //         'message' => 'AI settings updated successfully',
    //         'settings' => $settings,
    //     ]);
    // }

    // // API لإرجاع المفتاح الحالي واستبداله بالمفتاح التالي (دوران المفتاح)
    // public function rotateGptKey()
    // {
    //     $settings = AiSetting::first();

    //     if (!$settings) {
    //         return response()->json(['error' => 'AI settings not configured'], 404);
    //     }

    //     $newKey = $settings->rotateGptKey();

        return response()->json([
            'message' => 'GPT key rotated',
            // 'current_key' => $newKey,
        ]);
    }
}

