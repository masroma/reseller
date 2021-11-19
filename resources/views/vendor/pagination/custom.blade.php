
@if ($paginator->hasPages())
<style>
    .pager{
        align-self: 'center';
    }
    .pager li{
        float:left;
        list-style: none;
        margin:10px;
    }
    .menu{
        background-color: white;
        color:black;
        border-radius: 5px;
        border: 1px solid;
        padding:10px;
    }
    .disabled{
        background-color: black;
        color:white;
        border-radius: 5px;
        padding:10px;
    }
    a{
        color:black;
        text-decoration: none;
    }

    .menu:hover{
        background-color: black;
        color:white;
        border-radius: 5px;
        padding:10px;
    }

    .my-active {
			background-color: black !important;
			color: white !important;
			border-color: black!important;
		}



</style>
<ul class="pager">

    @if ($paginator->onFirstPage())
        <li class="menu disabled "><span>← Sebelumnya</span></li>
    @else
        <li class="menu"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Sebelumnya</a></li>
    @endif



    @foreach ($elements as $element)

        @if (is_string($element))
            <li class="menu disabled"><span>{{ $element }}</span></li>
        @endif



        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="menu active my-active"><span>{{ $page }}</span></li>
                @else
                    <li class="menu"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    @if ($paginator->hasMorePages())
        <li class="menu"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya →</a></li>
    @else
        <li class="menu disabled"><span>Selanjutnya →</span></li>
    @endif
</ul>
@endif
