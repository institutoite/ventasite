<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class MarcaController extends Controller
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

        return view('marcas.index', [
            'marcas' => Marca::filter(request(['search']))
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
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'marca' => 'required|unique:marcas,marca',
        ];

        $validatedData = $request->validate($rules);

        Marca::create($validatedData);

        return Redirect::route('marcas.index')->with('success', 'Marca creado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', [
            'marca' => $marca
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $rules = [
            'marca' => 'required|unique:marcas,marca,'.$marca->id,
        ];

        $validatedData = $request->validate($rules);

        Marca::where('id', $marca->id)->update($validatedData);

        return Redirect::route('marcas.index')->with('success', 'Marca se actualizó correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        Marca::destroy($marca->id);

        return Redirect::route('marcas.index')->with('success', 'Marcas fue eliminado correctamente!');
    }
}
