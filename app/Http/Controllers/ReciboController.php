<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    public function show(Recibo $recibo)
    {
        $recibo->load('ingreso.estudiante');

        return view('recibos.show', compact('recibo'));
    }

    public function pdf(Recibo $recibo)
    {
        $recibo->load('ingreso.estudiante');

        $pdf = Pdf::loadView('recibos.pdf', compact('recibo'))
            ->setPaper('letter');

        return $pdf->stream("recibo-{$recibo->numero}.pdf");
        // 👉 usa ->download() si quieres forzar descarga
    }
}
