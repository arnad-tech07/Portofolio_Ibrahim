@if($projects->isNotEmpty())
<section class="section soft-section">
    <div class="section-heading"><div><span class="eyebrow">Karya pilihan</span><h2>Dokumentasi proyek</h2></div><a href="{{ route('dokumentasi') }}">Lihat semua <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="carousel" data-carousel>
        <div class="carousel-track">
            @foreach($projects->take(6) as $project)
                <article class="project-card">
                    <div class="project-image"><img src="{{ $project->image_url ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $project->title }}"></div>
                    <div><span>{{ $project->category }}</span><h3>{{ $project->title }}</h3><p>{{ \Illuminate\Support\Str::limit($project->description, 90) }}</p></div>
                </article>
            @endforeach
        </div>
        <button type="button" data-prev aria-label="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button><button type="button" data-next aria-label="Berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</section>
@endif
