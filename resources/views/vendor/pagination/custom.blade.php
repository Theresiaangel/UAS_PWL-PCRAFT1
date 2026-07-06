@if ($paginator->hasPages())
    <div style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
        <nav style="background: white; border-radius: 50px; padding: 10px 30px; display: inline-flex; align-items: center; gap: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span style="color: #ccc; cursor: not-allowed; font-size: 18px; font-weight: bold;">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" style="color: #555; text-decoration: none; font-size: 18px; font-weight: bold; transition: 0.3s;">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span style="color: #888; font-weight: bold; font-size: 16px;">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="width: 35px; height: 35px; background-color: #d9383e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; box-shadow: 0 0 0 6px rgba(217, 56, 62, 0.2);">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="color: #888; text-decoration: none; font-weight: bold; font-size: 16px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; transition: 0.3s;" onmouseover="this.style.color='#d9383e'" onmouseout="this.style.color='#888'">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" style="color: #555; text-decoration: none; font-size: 18px; font-weight: bold; transition: 0.3s;">&rsaquo;</a>
            @else
                <span style="color: #ccc; cursor: not-allowed; font-size: 18px; font-weight: bold;">&rsaquo;</span>
            @endif
        </nav>
    </div>
@endif
