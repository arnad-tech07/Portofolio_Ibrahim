@if($testimonials->isNotEmpty())
<section class="section">
    <div class="section-heading"><div><span class="eyebrow">Cerita klien</span><h2>Apa kata mereka</h2></div><a href="{{ route('testimoni') }}">Semua testimoni <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="testimonial-carousel" data-carousel>
        <div class="carousel-track">
            @foreach($testimonials->take(5) as $testimonial)
                <article class="testimonial-card"><div class="stars">@for($i=0;$i<$testimonial->rating;$i++)<i class="fa-solid fa-star"></i>@endfor</div><p>"{{ $testimonial->content }}"</p><div class="person"><span>{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span><div><strong>{{ $testimonial->name }}</strong><small>{{ $testimonial->role }}{{ $testimonial->company ? ' · '.$testimonial->company : '' }}</small></div></div></article>
            @endforeach
        </div>
        <button type="button" data-prev aria-label="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button><button type="button" data-next aria-label="Berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</section>
@endif
