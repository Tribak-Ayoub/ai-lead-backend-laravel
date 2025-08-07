<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plan;
use Inertia\Inertia;
class PlanAndPricingController extends Controller
{

    // 🟡 Show all plans
    public function index()
    {
        // $plans = Plan::all();

        return Inertia::render('Admin/AdminPlansPage', [
            // 'plans' => $plans
        ]);
    }

    // 🟢 Store a new plan
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|string',
            'features' => 'nullable|string',
            'status' => 'required|string|in:Active,Custom,Inactive',
        ]);

        // Plan::create($data);

        return redirect()->back()->with('success', 'Plan created successfully.');
    }

    // 🔵 Update an existing plan
    // public function update(Request $request, Plan $plan)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'price' => 'required|string',
    //         'features' => 'nullable|string',
    //         'status' => 'required|string|in:Active,Custom,Inactive',
    //     ]);

    //     $plan->update($data);

    //     return redirect()->back()->with('success', 'Plan updated successfully.');
    // }

    // 🔴 Delete a plan
    // public function destroy(Plan $plan)
    // {
    //     $plan->delete();

    //     return redirect()->back()->with('success', 'Plan deleted.');
    // }
}

