@if ($slides)

<div class="slider-area ">
    <div class="slider-active owl-carousel">
        @foreach ($slides as $slide)
        <div class="single-slider-4 slider-height-4 bg-img" style="background-image: url({{ asset('storage/'. $slide->gambar_besar) }})">
        </div>
        @endforeach
    </div>
</div>

@endif