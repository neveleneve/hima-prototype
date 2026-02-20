<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller {
    public function index(Request $request) {
        $perPage = $request->input('per_page', 10);
        return Inertia::render('Authenticated/User/Index', [
            'user' => User::query()
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => $request->only(['search', 'perPage'])
        ]);
    }

    public function create() {
        return Inertia::render('Authenticated/User/Create');
    }

    public function store(Request $request) {
        //
    }

    public function show(User $pengguna) {
        return Inertia::render('Authenticated/User/Show', [
            'user' => $pengguna
        ]);
    }

    public function edit(User $pengguna) {
        //
    }

    public function update(Request $request, User $pengguna) {
        //
    }

    public function destroy(User $pengguna) {
        //
    }
}
