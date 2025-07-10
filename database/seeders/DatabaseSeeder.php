<?php

namespace Database\Seeders;

use App\Models\CallQueue;
use App\Models\CallSession;
use App\Models\ConversationSummary;
use App\Models\ConversationTurn;
use App\Models\Intent;
use App\Models\IntentTraining;
use App\Models\Lead;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        Intent::factory(10)->create();
        Lead::factory(20)->create()->each(function ($lead) {
            CallQueue::factory(rand(1, 3))->create(['lead_id' => $lead->id]);
            CallSession::factory(rand(1, 3))->create(['lead_id' => $lead->id])->each(function ($session) {
                ConversationSummary::factory()->create(['call_session_id' => $session->id]);
                ConversationTurn::factory(rand(5, 15))->create(['call_session_id' => $session->id]);
            });
        });

        IntentTraining::factory(30)->create([
            'user_id' => $user->id,
        ]);
    }
}
