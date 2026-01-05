<?php

namespace App\Http\Controllers;

use App\Models\AccountingEntry;
use App\Models\AccountingMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingEntryController extends Controller
{
    public function index()
    {
        $entries = AccountingEntry::latest()->get();
        return view('contabilidad.index', compact('entries'));
    }

    public function create()
    {
        return view('contabilidad.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required|string|max:255',
            'documento' => 'nullable|string|max:255',
            'numero' => 'required|string|max:255',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string',
            'movimientos' => 'required|array|min:1',
            'movimientos.*.cuenta' => 'required|string',
            'movimientos.*.nombre_cuenta' => 'nullable|string',
            'movimientos.*.debito' => 'nullable|numeric',
            'movimientos.*.credito' => 'nullable|numeric',
            'movimientos.*.observaciones' => 'nullable|string',
        ]);

        $totalDebito = collect($data['movimientos'])->sum('debito');
        $totalCredito = collect($data['movimientos'])->sum('credito');

        if (round($totalDebito, 2) !== round($totalCredito, 2)) {
            return back()
                ->withInput()
                ->withErrors(['balance' => 'El asiento no está cuadrado (Débito ≠ Crédito).']);
        }

        DB::transaction(function () use ($data, $totalDebito, $totalCredito) {
            $entry = AccountingEntry::create([
                'tipo' => $data['tipo'],
                'documento' => $data['documento'],
                'numero' => $data['numero'],
                'fecha' => $data['fecha'],
                'observaciones' => $data['observaciones'],
                'total_debito' => $totalDebito,
                'total_credito' => $totalCredito,
            ]);

            foreach ($data['movimientos'] as $mov) {
                $entry->movements()->create([
                    'cuenta' => $mov['cuenta'],
                    'nombre_cuenta' => $mov['nombre_cuenta'] ?? '',
                    'debito' => $mov['debito'] ?? 0,
                    'credito' => $mov['credito'] ?? 0,
                    'observaciones' => $mov['observaciones'] ?? null,
                ]);
            }
        });

        return redirect()->route('contabilidad.index')->with('success', 'Asiento guardado correctamente.');
    }

    public function show($id)
    {
        $entry = AccountingEntry::with('movements')->findOrFail($id);
        return view('contabilidad.show', compact('entry'));
    }

    public function edit($id)
    {
        $entry = AccountingEntry::with('movements')->findOrFail($id);
        return view('contabilidad.edit', compact('entry'));
    }

    public function update(Request $request, $id)
    {
        $entry = AccountingEntry::findOrFail($id);

        $data = $request->validate([
            'tipo' => 'required|string|max:255',
            'documento' => 'nullable|string|max:255',
            'numero' => 'required|string|max:255',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string',
            'movimientos' => 'required|array|min:1',
            'movimientos.*.cuenta' => 'required|string',
            'movimientos.*.nombre_cuenta' => 'nullable|string',
            'movimientos.*.debito' => 'nullable|numeric',
            'movimientos.*.credito' => 'nullable|numeric',
            'movimientos.*.observaciones' => 'nullable|string',
        ]);

        $totalDebito = collect($data['movimientos'])->sum('debito');
        $totalCredito = collect($data['movimientos'])->sum('credito');

        if (round($totalDebito, 2) !== round($totalCredito, 2)) {
            return back()
                ->withInput()
                ->withErrors(['balance' => 'El asiento no está cuadrado (Débito ≠ Crédito).']);
        }

        DB::transaction(function () use ($entry, $data, $totalDebito, $totalCredito) {
            $entry->update([
                'tipo' => $data['tipo'],
                'documento' => $data['documento'],
                'numero' => $data['numero'],
                'fecha' => $data['fecha'],
                'observaciones' => $data['observaciones'],
                'total_debito' => $totalDebito,
                'total_credito' => $totalCredito,
            ]);

            // Eliminar movimientos anteriores y volver a crear
            $entry->movements()->delete();

            foreach ($data['movimientos'] as $mov) {
                $entry->movements()->create($mov);
            }
        });

        return redirect()->route('contabilidad.index')->with('success', 'Asiento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $entry = AccountingEntry::findOrFail($id);
        $entry->delete();

        return redirect()->route('contabilidad.index')->with('success', 'Asiento eliminado correctamente.');
    }

    public function print($id)
    {
        $entry = AccountingEntry::with('movements')->findOrFail($id);
        return view('contabilidad.print', compact('entry'));
    }
}

