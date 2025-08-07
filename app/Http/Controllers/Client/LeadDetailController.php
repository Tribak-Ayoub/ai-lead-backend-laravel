<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadDetailController extends Controller
{
    /**
     * عرض معلومات Lead بالتفصيل
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);

        return Inertia::render('LeadDetails', [
            'lead' => $lead,
            // تقدر تزيد callHistory و notes و activities هنا من بعد
            'callHistory' => [], // مبدئياً فارغ حتى تضيفي CallSession مثلاً
            'activities' => [],
        ]);
    }
}
