@extends('layout')

@section('content')
    <h1>📊 Reportes Contables</h1>

    <ul>
        <li><a href="{{ route('reportes.situacion') }}">📘 Estado de Situación Financiera</a></li>
        <li><a href="{{ route('reportes.resultados.mensual') }}">📅 Estado de Resultados por Mes</a></li>
        <li><a href="{{ route('reportes.resultados.acumulado') }}">📈 Estado de Resultados Acumulado</a></li>
    </ul>
@endsection
