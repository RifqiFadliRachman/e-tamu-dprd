@if ($paginator->hasPages())
    {{-- Tambahkan class "pagination" di sini --}}
    <nav class="pagination flex items-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">«</span>
        @else
            {{-- Tambahkan class "page-link" di sini --}}
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link px-3 py-1 border rounded hover:bg-gray-100">«</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 border rounded bg-[#E8BF6F] text-white">{{ $page }}</span>
                    @else
                        {{-- Tambahkan class "page-link" di sini --}}
                        <a href="{{ $url }}" class="page-link px-3 py-1 border rounded hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            {{-- Tambahkan class "page-link" di sini --}}
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link px-3 py-1 border rounded hover:bg-gray-100">»</a>
        @else
            <span class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed">»</span>
        @endif
    </nav>
@endif
