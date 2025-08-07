<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Lead;
use App\Models\CallSession;
use App\Models\Revenue;
use Carbon\Carbon;
use DB;

class AdminDashboardController extends Controller
{
     public function index() {
        return Inertia::render('Admin/AdminDashboard');
    }
   /* public function index()
    {
        // 1. Metrics الأساسية
        // $totalClients = Client::count();
    
   


        $dailyCalls = CallSession::whereDate('startTime', Carbon::today())->count();

        // حساب الإيرادات الشهرية
        $startOfMonth = Carbon::now()->startOfMonth();
        // $monthlyRevenue = DB::table('revenues')
            // ->where('date', '>=', $startOfMonth)
            // ->sum('amount');

        $uptime = 99.9; // قيمة ثابتة أو تحسبها بطريقة خاصة

        // 2. بيانات المكالمات لآخر 7 أيام
        $callVolumeData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $callsCount = CallSession::whereDate('startTime', $date)->count();
            $callVolumeData[] = [
                'day' => $date->format('D'),
                'calls' => $callsCount
            ];
        }

        // 3. بيانات الإيرادات لآخر 6 أشهر
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();

            // $revenue = DB::table('revenues')
                // ->whereBetween('date', [$monthStart, $monthEnd])
                // ->sum('amount');

            $revenueData[] = [
                'month' => $month->format('M'),
                // 'revenue' => $revenue / 1000, // تحويل للإلف كما في الواجهة
            ];
        }

        // 4. Recent Activity - مثال ثابت (يمكن تعديله حسب قاعدة البيانات)
        $recentActivity = [
            [
                'id' => 1,
                'type' => 'user',
                'message' => 'New client "TechCorp Solutions" registered with Professional plan',
                'time' => '2 minutes ago'
            ],
            [
                'id' => 2,
                'type' => 'alert',
                'message' => 'High call volume detected - Auto-scaling triggered',
                'time' => '15 minutes ago'
            ],
            [
                'id' => 3,
                'type' => 'payment',
                'message' => 'Payment of $299 received from "Real Estate Pro"',
                'time' => '1 hour ago'
            ],
            [
                'id' => 4,
                'type' => 'system',
                'message' => 'AI model retrained for campaign "Insurance Leads Q1"',
                'time' => '2 hours ago'
            ],
            [
                'id' => 5,
                'type' => 'user',
                'message' => 'Client "Solar Solutions Inc" upgraded to Enterprise plan',
                'time' => '3 hours ago'
            ],
        ];

        // 5. System Status - مثال ثابت
        $systemStatus = [
            ['name' => 'API Gateway', 'status' => 'operational'],
            ['name' => 'Call Processing', 'status' => 'operational'],
            ['name' => 'AI Services', 'status' => 'operational'],
            ['name' => 'Database', 'status' => 'operational'],
            ['name' => 'Payment System', 'status' => 'warning'],
            ['name' => 'Backup Services', 'status' => 'operational'],
        ];

        // 6. Top Clients - جلب أفضل 5 عملاء بالإيرادات وعدد المكالمات
        // $topClients = Client::select('clients.id', 'clients.name')
            // ->withCount(['callSessions as calls_count'])
            // ->withSum('revenues as revenue_sum', 'amount')
            // ->orderByDesc('revenue_sum')
            // ->limit(5)
            // ->get()
            // ->map(function ($client) {
            //     return [
            //         'id' => $client->id,
            //         'name' => $client->name,
            //         'plan' => 'Enterprise',  // عدل حسب بياناتك
            //         'revenue' => number_format($client->revenue_sum),
            //         'calls' => number_format($client->calls_count),
            //     ];
            // });

        // return inertia('AdminDashboard', [
        //     'metrics' => [
        //         'totalClients' => $totalClients,
        //         'dailyCalls' => $dailyCalls,
        //         'monthlyRevenue' => $monthlyRevenue,
        //         'uptime' => $uptime,
        //     ],
        //     'callVolumeData' => $callVolumeData,
        //     'revenueData' => $revenueData,
        //     'recentActivity' => $recentActivity,
        //     'systemStatus' => $systemStatus,
        //     'topClients' => $topClients,
        // ]);
    }*/
}
