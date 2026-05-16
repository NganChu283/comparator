<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index', [
            'users' => User::query()
                ->when($request->q, fn ($query, $q) => $query->where(fn ($sub) => $sub->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")))
                ->when($request->role, fn ($query, $role) => $query->where('role', $role))
                ->latest()
                ->paginate(12)
                ->withQueryString(),
        ]);
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('Không thể tự khóa tài khoản của chính mình.');
        }

        $user->update([
            'status' => $user->status === 'blocked' ? 'active' : 'blocked',
        ]);

        return back()->with('success', 'Đã cập nhật trạng thái tài khoản.');
    }
}
