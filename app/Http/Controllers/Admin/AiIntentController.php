<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Intent;
use App\Models\IntentTraining;;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class AiIntentController extends Controller
{


    // Show the list of intents
    public function index(Request $request)
    {
        $intents = Intent::with('utterances')->get();

        return Inertia::render('Admin/Intents/Index', [
            'intents' => $intents,
        ]);
    }

    // Store a new intent
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'utterances' => 'array',
            'utterances.*' => 'string'
        ]);

        $intent = Intent::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'accuracy' => rand(80, 100), // temp mock
        ]);

        foreach ($validated['utterances'] as $utterance) {
            IntentTraining::create([
                'intent_id' => $intent->id,
                'training_phrase' => $utterance,
                'is_positive' => true,
                'source' => 'manual'
            ]);
        }

        return redirect()->back()->with('success', 'Intent created successfully.');
    }

    // Update an intent
    public function update(Request $request, Intent $intent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $intent->update($validated);

        return redirect()->back()->with('success', 'Intent updated.');
    }

    // Delete an intent
    public function destroy(Intent $intent)
    {
        $intent->utterances()->delete();
        $intent->delete();

        return redirect()->back()->with('success', 'Intent deleted.');
    }

    // Add utterance
    public function addUtterance(Request $request, $intentId)
    {
        $request->validate([
            'utterance' => 'required|string',
        ]);

        return IntentTraining::create([
            'intent_id' => $intentId,
            'training_phrase' => $request->utterance,
            'is_positive' => true,
            'source' => 'manual'
        ]);
    }

    // Remove utterance
    public function removeUtterance($utteranceId)
    {
        IntentTraining::findOrFail($utteranceId)->delete();

        return response()->json(['message' => 'Utterance removed']);
    }

    // Retrain model by calling FastAPI
    public function retrain()
    {
        // Example FastAPI endpoint call
        try {
            $response = Http::post(env('FASTAPI_URL') . '/api/intents/retrain');

            if ($response->successful()) {
                return response()->json(['message' => 'Retraining complete!']);
            } else {
                return response()->json(['error' => 'Retraining failed'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Connection error'], 500);
        }
    }
}

