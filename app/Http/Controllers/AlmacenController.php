<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use Illuminate\Support\Facades\Redirect;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'El parámetro por página debe ser un número entero entre 1 y 100.');
        }

        return view('almacen.index', [
            'almacenes' => Almacen::filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlmacenRequest $request)
    {
        $rules = [
            'almacen' => 'required|unique:almacens,almacen',
        ];

        $validatedData = $request->validate($rules);

        Almacen::create($validatedData);

        return Redirect::route('almacens.index')->with('success', 'Almacen creado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Almacen $almacen)
    {
        return view('almacen.edit', [
            'almacen' => $almacen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlmacenRequest $request, Almacen $almacen)
    {
        $rules = [
            'almacen' => 'required|unique:almacens,almacen,'.$almacen->id,
        ];

        $validatedData = $request->validate($rules);

        Almacen::where('id', $almacen->id)->update($validatedData);

        return Redirect::route('almacens.index')->with('success', 'Almacen se actualizó correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacen)
    {
        Almacen::destroy($almacen->id);

        return Redirect::route('almacens.index')->with('success', 'Almacens fue eliminado correctamente!');
    }
}
