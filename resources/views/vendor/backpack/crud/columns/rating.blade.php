@php
    $stars = $entry->{$column['name']} ?? 0; // Obtiene la cantidad de estrellas del modelo
@endphp

<span class="rating">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $stars)
            <i class="la la-star"></i>
        @else
            <i class="lar la-star"></i>
        @endif
    @endfor
</span>
