@if ($paginator->hasPages())
    <nav>
        <ul style="
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            justify-content: center;
            align-items: center;
        ">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <li style="opacity: 0.4;">←</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       style="text-decoration: none; color: #6a1b9a; font-weight: bold;">
                        ←
                    </a>
                </li>
            @endif

            {{-- Página actual --}}
            <li style="
                background: #6a1b9a;
                color: white;
                padding: 6px 12px;
                border-radius: 6px;
                font-weight: bold;
            ">
                {{ $paginator->currentPage() }}
            </li>

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       style="text-decoration: none; color: #6a1b9a; font-weight: bold;">
                        →
                    </a>
                </li>
            @else
                <li style="opacity: 0.4;">→</li>
            @endif

        </ul>
    </nav>
@endif

