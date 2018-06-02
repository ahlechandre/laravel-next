<nav class="breadcrumbs">
    @foreach ($items as $item)
        
        @if ($item['url'] ?? false)
            <a class="breadcrumbs__item" href="{{ $item['url'] }}">{{ $item['text'] }}</a>
        @else
            <span class="breadcrumbs__item">{{ $item['text'] }}</span>
        @endif

    @endforeach
</nav>