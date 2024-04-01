<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra una lista de todos los administradores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.adminEvento.index', compact('admins'));
    }

    /**
     * Muestra el formulario para crear un nuevo administrador.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminEvento.create');
    }

    /**
     * Almacena un administrador recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        Admin::create($request->all());
        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Muestra el administrador especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('adminEvento.show', compact('admin'));
    }

    /**
     * Muestra el formulario para editar el administrador especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.adminEvento.edit', compact('admin'));
    }

    /**
     * Actualiza el administrador especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Elimina el administrador especificado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
}
