<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display the index page.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Process DataTables AJAX request.
     */
    public function data()
    {
        $roles = Role::query()->select(['id', 'name', 'label', 'created_at']);

        return DataTables::of($roles)
            ->addIndexColumn()
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('M d, Y');
            })
            ->addColumn('action', function ($role) {
                $editUrl = route('roles.edit', $role->id);
                $deleteUrl = route('roles.destroy', $role->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                return "
                    <div class='flex gap-2'>
                        <a href='{$editUrl}' class='px-3 py-1 bg-indigo-50 text-indigo-600 rounded-md text-sm hover:bg-indigo-100'>Edit</a>
                        
                        <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Are you sure?\");'>
                            {$csrf}
                            {$method}
                            <button type='submit' class='px-3 py-1 bg-red-50 text-red-600 rounded-md text-sm hover:bg-red-100'>Delete</button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        // prevent deleting the super admin role if needed
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Cannot delete Super Admin role.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}