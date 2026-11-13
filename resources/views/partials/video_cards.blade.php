<!-- Bagian Card Video Showcase -->
<section class="section-block" id="video-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-circle-play"></i> Video Tutorial & Demo Proyek
        </span>
        <h2 class="section-title">Galeri Video & Pembelajaran</h2>
        <p class="section-subtitle">
            Tonton cuplikan demo sistem aplikasi web nyata, studi kasus arsitektur kode, webinar, serta rekaman materi training pemrograman web.
        </p>
    </div>

    <!-- Grid Card Video -->
    <div class="videos-grid">
        @forelse($videos as $video)
            <div class="video-item-card">
                <div class="video-player-wrapper">
                    <!-- Embed Video Player (YouTube / Video URL) -->
                    @if(str_contains($video->video_url, 'youtube.com') || str_contains($video->video_url, 'youtu.be'))
                        <iframe src="{{ $video->video_url }}" 
                                title="{{ $video->title }}" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen 
                                loading="lazy"></iframe>
                    @else
                        <video controls poster="{{ $video->thumbnail_url }}">
                            <source src="{{ $video->video_url }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video HTML5.
                        </video>
                    @endif

                    @if($video->category)
                        <span class="video-category-tag">
                            <i class="fa-solid fa-tag"></i> {{ $video->category }}
                        </span>
                    @endif

                    @if($video->duration)
                        <span class="video-duration-badge">
                            <i class="fa-solid fa-clock"></i> {{ $video->duration }}
                        </span>
                    @endif
                </div>

                <div class="video-card-body">
                    <h3 class="video-card-title">{{ $video->title }}</h3>
                    <p class="video-card-desc">{{ $video->description }}</p>

                    <div class="video-card-footer">
                        <div class="video-badge-author">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Ibrahim">
                            <span>Oleh Ibrahim</span>
                        </div>
                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" class="btn-video-watch">
                            <i class="fa-brands fa-youtube" style="color: #ef4444;"></i> Buka Video
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #64748b;">Belum ada video yang ditambahkan.</p>
        @endforelse
    </div>
</section>

