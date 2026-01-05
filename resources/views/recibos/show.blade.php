@extends('layout')

@section('content')
    <div style="max-width:800px; margin:auto;">

        <h1 style="color:#6a1b9a;">🧾 Recibo de pago</h1>

        <div style="background:#fafafa; padding:20px; border-radius:8px;
                box-shadow:0 2px 6px rgba(0,0,0,.1); margin-top:20px;">

            <p><strong>Número:</strong> {{ $recibo->numero }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($recibo->fecha)->format('d/m/Y') }}</p>
            <p><strong>Estudiante:</strong> {{ $recibo->ingreso->estudiante->nombre_completo }}</p>
            <p><strong>Concepto:</strong> {{ $recibo->ingreso->concepto }}</p>

            @if($recibo->ingreso->mes_correspondiente)
                <p><strong>Mes:</strong> {{ $recibo->ingreso->mes_correspondiente }}</p>
            @endif

            <p><strong>Medio de pago:</strong> {{ $recibo->ingreso->medio_pago }}</p>

            <p style="font-size:20px; font-weight:bold; margin-top:15px;">
                Total pagado:
                $ {{ number_format($recibo->ingreso->valor, 0, ',', '.') }}
            </p>

        </div>

        {{-- BOTONES --}}
        <div style="margin-top:25px; display:flex; gap:10px;">
            <a href="{{ route('recibos.pdf', $recibo->id) }}"
               target="_blank"
               class="btn-purple"
               style="padding:10px 18px; text-decoration:none;">
                🖨️ Imprimir recibo
            </a>

            <a href="{{ route('ingresos.index') }}"
               style="padding:10px 18px; text-decoration:none; color:#555;">
                ⬅ Volver a ingresos
            </a>
        </div>

    </div>
@endsection
