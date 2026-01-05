<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Models\Estudiante;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::orderBy('nombre_completo')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        // Trae solo los campos normales
        $data = $request->except('foto');

        // Manejo explícito de la foto
        if ($request->file('foto')) {
            $path = $request->file('foto')->store('estudiantes', 'public');
            $data['foto'] = $path;
        }

        Estudiante::create($data);

        return redirect()
            ->route('estudiantes.index')
            ->with('success', 'Estudiante registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        $data = $request->validated();

        // 📸 Si viene nueva foto
        if ($request->hasFile('foto')) {

            // Borrar foto anterior
            if ($estudiante->foto && Storage::disk('public')->exists($estudiante->foto)) {
                Storage::disk('public')->delete($estudiante->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('estudiantes', 'public');
        }

        $estudiante->update($data);

        return redirect()
            ->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return redirect()
            ->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado correctamente');
    }

    public function pdf(Estudiante $estudiante)
    {
        $pdf = Pdf::loadView('estudiantes.pdf', compact('estudiante'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream('ficha_estudiante.pdf');
    }
}
