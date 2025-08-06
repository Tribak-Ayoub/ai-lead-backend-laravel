<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    public function index()
    {
        // بيانات وهمية (mock) حالياً، يمكن تربطها من database لاحقاً
        $popularArticles = [
            [
                'id' => 1,
                'title' => 'Getting Started with Campaigns',
                'description' => 'Learn how to create and manage your first marketing campaign',
                'readTime' => 5,
                'icon' => 'BookOpenIcon'
            ],
            [
                'id' => 2,
                'title' => 'Campaign Settings & Configuration',
                'description' => 'Understand all the settings and options available for campaigns',
                'readTime' => 8,
                'icon' => 'SettingsIcon'
            ],
            // ...
        ];

        $faqs = [
            [
                'id' => 1,
                'question' => 'How do I create a new campaign?',
                'answer' => 'To create a new campaign, click the "New Campaign" button...',
            ],
            [
                'id' => 2,
                'question' => 'Can I pause or stop a campaign?',
                'answer' => 'Yes, you can pause or stop any campaign at any time...',
            ],
            // ...
        ];

        return Inertia::render('Support', [
            'popularArticles' => $popularArticles,
            'faqs' => $faqs
        ]);
    }
}
