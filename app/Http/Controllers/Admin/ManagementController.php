<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManagementController extends Controller
{
    // عرض Users مع Pagination وفلترة وبحث وترتيب، مع Inertia
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%");
            });
        }

        if ($request->plan && $request->plan !== 'all') {
            $query->where('plan', $request->plan);
        }

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->sortBy) {
            if ($request->sortBy === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sortBy === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $itemsPerPage = $request->get('itemsPerPage', 12);
        $users = $query->paginate($itemsPerPage)->withQueryString();

        return Inertia::render('Clients/Index', [
            'clients' => $users,
            'filters' => $request->only(['search', 'plan', 'status', 'sortBy', 'itemsPerPage']),
        ]);
    }

    // إضافة User جديد (POST)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'plan' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        User::create($validated);

        return redirect()->route('clients.index')->with('success', 'User added successfully');
    }

    // عرض تفاصيل User (لو بغيت صفحة خاصة)
    public function show($id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('Clients/Show', [
            'client' => $user,
        ]);
    }

    // تحديث User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'plan' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string',
        ]);

        $user->update($validated);

        return redirect()->route('clients.index')->with('success', 'User updated successfully');
    }

    // حذف User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('clients.index')->with('success', 'User deleted successfully');
    }
}
