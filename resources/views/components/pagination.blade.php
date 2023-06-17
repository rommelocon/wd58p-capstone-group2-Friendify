@props(['paginator'])

@if ($paginator->lastPage() > 1)
<div class="bg-white p-4 flex items-center flex-wrap justify-center ">
    <nav aria-label="Page navigation">
        <ul class="inline-flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li>
                <a class="h-10 px-5 text-green-600 transition-colors duration-150 rounded-l-lg focus:outline-none cursor-not-allowed" disabled>
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
            @else
            <li>
                <a class="h-10 px-5 text-green-600 transition-colors duration-150 rounded-l-lg focus:outline-none hover:bg-green-100" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li>
                    <a class="h-10 px-5 {{ $paginator->currentPage() === $i ? 'text-white bg-green-600 border border-r-0 border-green-600 rounded-none focus:outline-none' : 'text-green-600 transition-colors duration-150 focus:outline-none hover:bg-green-100' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li>
                    <a class="h-10 px-5 text-green-600 transition-colors duration-150 rounded-r-lg focus:outline-none hover:bg-green-100" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
                @else
                <li>
                    <a class="h-10 px-5 text-green-600 transition-colors duration-150 rounded-r-lg focus:outline-none cursor-not-allowed" disabled>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
                @endif
        </ul>
    </nav>
</div>
@endif