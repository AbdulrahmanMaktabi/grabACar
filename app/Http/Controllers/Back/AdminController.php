<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\CreatingAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $admins = Admin::paginate(5);
        return view('back.admins.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('back.admins.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatingAdminRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $admin->assignRole($data['role']);

        return redirect()->route('back.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
