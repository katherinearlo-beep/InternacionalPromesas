<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puc;

class PucController extends Controller
{
    /**
     * Buscar cuentas en el PUC por código o nombre.
     */
    public function search(Request $request)
    {
        $term = $request->get('term');

        $results = Puc::query()
            ->where('codigo', 'like', "%{$term}%")
            ->orWhere('nombre', 'like', "%{$term}%")
            ->limit(10)
            ->get(['codigo', 'nombre']);

        return response()->json($results);
    }
}
