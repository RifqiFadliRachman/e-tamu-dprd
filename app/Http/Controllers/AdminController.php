<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman manajemen admin.
     */
    public function index(Request $request): View
    {
        $query = User::query();
        $search = $request->input('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(10);
        return view('admin.admin', compact('users', 'search'));
    }

    /**
     * Menangani permintaan pencarian live untuk halaman admin (AJAX).
     */
    public function search(Request $request): View
    {
        $query = User::query();
        $search = $request->input('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(10);
        return view('admin.partials.admin-content', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat admin baru.
     */
    public function create(): View
    {
        return view('admin.create');
    }

    /**
     * Menyimpan admin baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admin')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit admin.
     */
    public function edit(User $user): View
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * Memperbarui data admin di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.admin')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Menghapus admin dari database.
     */
    public function destroy(User $user)
    {
        // Mencegah user menghapus akunnya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.admin')->with('success', 'Admin berhasil dihapus.');
    }
}
