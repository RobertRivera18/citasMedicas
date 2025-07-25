<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:256',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cedula' => 'required|string|min:10|unique:users,cedula',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create($data);
        $user->roles()->attach($data['role_id']);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado correctamente',
            'text' => 'El usuario ha sido creado exitosamente.',
            'position' => 'top-end',
            'toast' => true,
            'timer' => 3000,
            'showConfirmButton' => false
        ]);

        if ($user->hasRole('Paciente')) {
            $patient = $user->patient()->create([]);
            return redirect()->route('admin.patients.edit', $patient);
        }

        if ($user->hasRole('Doctor')) {
            $doctor = $user->doctor()->create([]);
            return redirect()->route('admin.doctors.edit', $doctor);
        }

        return redirect()->route('admin.users.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:256',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'cedula' => 'required|string|min:10|unique:users,cedula,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',

        ]);
        $user->update($data);
        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        $user->roles()->sync([$data['role_id']]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Actualizado correctamente',
            'text' => 'El usuario ha sido actualizado exitosamente.',
            'position' => 'top-end',
            'toast' => true,
            'timer' => 3000,
            'showConfirmButton' => false
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Eliminado correctamente',
            'text' => 'El usuario ha sido eliminado exitosamente.',
            'position' => 'top-end',
            'toast' => true,
            'timer' => 3000,
            'showConfirmButton' => false
        ]);

        return redirect()->route('admin.users.index');
    }
}
