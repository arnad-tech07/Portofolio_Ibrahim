<!-- Bagian Card Dokumentasi Proyek -->
<section class="section-block" id="dokumentasi-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-folder-open"></i> Galeri Portofolio Proyek
        </span>
        <h2 class="section-title">Dokumentasi Proyek Pilihan</h2>
        <p class="section-subtitle">
            Kumpulan dokumentasi teknis sistem informasi, platform web kustom, dan website komersial yang telah selesai saya rancang dan rilis ke produksi.
        </p>
    </div>

    <!-- Grid Card Dokumentasi -->
    <div class="documentation-grid">
        @forelse($projects as $project)
            <div class="doc-card">
                <div class="doc-card-thumb-wrap">
                    <img src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format&fit=crop&q=80' }}" 
                         alt="{{ $project->title }}" 
                         class="doc-card-thumb" 
                         loading="lazy">
                    <span class="doc-card-category-badge">{{ $project->category }}</span>
                    @if($project->client)
                        <span class="doc-card-client-tag">
                            <i class="fa-solid fa-user-check"></i> {{ $project->client }}
                        </span>
                    @endif
                </div>

                <div class="doc-card-body">
                    <h3 class="doc-card-title">{{ $project->title }}</h3>
                    <p class="doc-card-desc">{{ $project->description }}</p>

                    @if($project->tech_stack)
                        <div class="doc-tech-stack-row">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="doc-tech-pill">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="doc-card-actions">
                        @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn-doc-demo">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Demo Live
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="btn-doc-github" title="Repositori GitHub">
                                <i class="fa-brands fa-github"></i> Source Code
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #64748b;">Belum ada data dokumentasi proyek.</p>
        @endforelse
    </div>
</section>

