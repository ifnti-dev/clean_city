@if ($paginator->hasPages())
    <nav class="pagination-shell" role="navigation" aria-label="Pagination">
        <p class="text-sm text-gray-600">
            Affichage
            <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }}</span>
            à
            <span class="font-semibold text-gray-900">{{ $paginator->lastItem() }}</span>
            sur
            <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span>
            résultats
        </p>

        <div class="pagination-links">
            @if ($paginator->onFirstPage())
                <span class="pagination-link pagination-link-disabled" aria-disabled="true">Précédent</span>
            @else
                <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Précédent</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-gray-400" aria-hidden="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-link pagination-link-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="pagination-link" href="{{ $url }}"
                                aria-label="Aller à la page {{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant</a>
            @else
                <span class="pagination-link pagination-link-disabled" aria-disabled="true">Suivant</span>
            @endif
        </div>
    </nav>
@endif
