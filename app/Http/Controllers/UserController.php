<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller {
    public function index() {
        return Inertia::render('Authenticated/User/Index', [
            'user' => User::paginate(2)
        ]);
    }

    public function create() {
        return Inertia::render('Authenticated.User.Create');
    }

    public function store(Request $request) {
        //
    }

    public function show(User $pengguna) {
        //
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
