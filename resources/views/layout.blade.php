<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Internacional Promesas') }}</title>

    <!-- Estilos base -->
    <style>
        :root {
            --morado: #6a1b9a;
            --negro: #000;
            --blanco: #fff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--blanco);
            color: var(--negro);
        }

        header {
            background-color: var(--morado);
            color: var(--blanco);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 40px;
        }

        header img {
            height: 60px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center; /* Alinea verticalmente todos los li */
            gap: 25px; /* Espaciado uniforme */
        }

        nav li {
            position: relative; /* Necesario para los dropdowns */
            display: flex;
            align-items: center; /* Centra el contenido verticalmente */
        }

        nav a {
            color: var(--blanco);
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .dropdown-title {
            display: flex;
            align-items: center;
            gap: 5px; /* Espacio entre nombre y flecha */
        }


        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;  /* Pegado justo debajo del título */
            left: 0;
            background-color: #6a1b9a;
            border-radius: 6px;
            min-width: 220px;
            z-index: 1000;
            padding: 0; /* Quitamos padding extra del contenedor */
        }

        .dropdown-menu li a {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #4527a0;
        }

        /* 🔑 ESTO ES LO IMPORTANTE */
        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }

        main {
            padding: 40px;
        }

        footer {
            background-color: var(--negro);
            color: var(--blanco);
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .text-purple { color: #5e35b1; }
        .bg-purple { background-color: #5e35b1; }

        .btn-purple {
            background-color: #5e35b1;
            color: white;
            border: none;
            transition: all 0.2s;
        }
        .btn-purple:hover {
            background-color: #4527a0;
            color: white;
        }
        .form-input {
            width: 90%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 4px;
            margin-bottom: 14px;
        }

        label {
            font-weight: 600;
            color: #444;
        }
    </style>
</head>
<body>
<!-- Banner / Encabezado -->
<header>
    <div class="logo">
        <img src="{{ asset('images/escudo.png') }}" alt="Escudo Internacional Promesas">
    </div>
    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <!-- 🔑 NUEVO DROPDOWN DE USUARIOS -->
            <li class="dropdown">
                <span class="dropdown-title">Usuarios ▾</span>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('users.create') }}">➕ Crear Usuario</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">📋 Listado de Usuarios</a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
            <li class="dropdown">
                <span class="dropdown-title">Reportes ▾</span>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('reporteEstudiantes.index') }}">
                            📊 Reporte por estudiante
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reportesTotales.index') }}">
                            💰 Reportes Totales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reporteEstudiantes.categoria') }}">
                            🏆 Reporte por categoría
                        </a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('ingresos.index') }}">Ingresos</a></li>
            <!--
            <li class="dropdown">
                <span class="dropdown-title">Contabilidad ▾</span>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{/{ route('contabilidad.index') }}">Asientos Contables</a>
                    </li>
                    <li>
                        <a href="{/{ url('/reportes') }}">Reportes Contables</a>
                    </li>
                </ul>
            </li>
            -->
            <li class="dropdown">
                <span class="dropdown-title">{{ Auth::user()->name }} ▾</span>
                <ul class="dropdown-menu">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">
                                🔓 Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<!-- Contenido dinámico -->
<main>
    @yield('content')
</main>

<footer>
    © {{ date('Y') }} Internacional Promesas - Todos los derechos reservados.
</footer>
</body>
</html>
