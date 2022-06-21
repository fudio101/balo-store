@if ($paginator->hasPages())

    <div class="row">

        <div class="col-lg-12 text-center">

            <div class="pagination-wrap">

                <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="disabled"><a>Prev</a></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}">Prev</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled">
                                <a>{{ $element }}</a>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <a class="active">{{ $page }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
                    @else
                        <li class="disabled"><a>Next</a></li>
                    @endif
                </ul>

            </div>

        </div>

    </div>
@endif
