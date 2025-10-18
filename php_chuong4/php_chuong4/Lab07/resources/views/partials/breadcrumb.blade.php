@php
    $segments = Request::segments();
    $path = '';
@endphp

<nav style="margin-bottom: 16px; font-size: 14px; color: #6b7280;">
    <a href="{{ route('articles.index') }}" style="color: #2563eb; text-decoration: none;">Trang chủ</a>

    @foreach ($segments as $segment)
        @php $path .= '/'.$segment; @endphp
        > 
        @if (!$loop->last)
            <a href="{{ url($path) }}" style="color: #2563eb; text-decoration: none;">
                {{ ucfirst($segment) }}
            </a>
        @else
            <span style="color: #111827;">{{ ucfirst($segment) }}</span>
        @endif
    @endforeach
</nav>
