<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display the index page.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Process DataTables AJAX request.
     */
    public function data()
    {
        // Eager load 'role' to avoid N+1 queries
        $users = User::with('role')->select(['id', 'name', 'email', 'role_id', 'created_at']);

        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('M d, Y');
            })
            // Add a column to display the Role Label instead of ID
            ->addColumn('role', function ($user) {
                return $user->role ? $user->role->label : '<span class="text-gray-400">No Role</span>';
            })
            ->addColumn('action', function ($user) {
                $editUrl = route('users.edit', $user->id);
                $deleteUrl = route('users.destroy', $user->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                // Prevent deleting the currently logged-in user
                if (auth()->id() === $user->id) {
                    return "
                        <div class='flex gap-2'>
                            <a href='{$editUrl}' class='px-3 py-1 bg-indigo-50 text-indigo-600 rounded-md text-sm hover:bg-indigo-100'>Edit</a>
                        </div>";
                }

                return "
                    <div class='flex gap-2'>
                        <a href='{$editUrl}' class='px-3 py-1 bg-indigo-50 text-indigo-600 rounded-md text-sm hover:bg-indigo-100'>Edit</a>
                        
                        <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Are you sure? This action cannot be undone.\");'>
                            {$csrf}
                            {$method}
                            <button type='submit' class='px-3 py-1 bg-red-50 text-red-600 rounded-md text-sm hover:bg-red-100'>Delete</button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['role', 'action']) // Allow HTML in role and action columns
            ->make(true);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Get all roles to populate the select dropdown
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        
        // Hash the password before saving
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Handle Password Update: Only hash and update if a new password is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            // Remove password from data so it doesn't get overwritten with null
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Security check: Prevent user from deleting themselves
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}