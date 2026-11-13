@extends('layouts.cms')

@section('title', 'Dashboard - CMS Portofolio Ibrahim')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Dashboard Kendali Sistem (CMS)</h1>
            <p class="cms-page-desc">Selamat datang kembali! Berikut ringkasan performa dan konten digital portofolio Anda.</p>
        </div>
        <div>
            <a href="{{ route('cms.proyek') }}" class="btn-cms-primary">
                <i class="fa-solid fa-plus"></i> Tambah Proyek Baru
            </a>
        </div>
    </div>

    <!-- Metrik Statistik -->
    <div class="cms-stats-grid">
        <div class="cms-stat-box">
            <div class="cms-stat-icon-wrap">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <div class="cms-stat-num">{{ $totalProjects }}</div>
                <div class="cms-stat-text">Card Dokumentasi</div>
            </div>
        </div>

        <div class="cms-stat-box">
            <div class="cms-stat-icon-wrap amber">
                <i class="fa-solid fa-circle-play"></i>
            </div>
            <div>
                <div class="cms-stat-num">{{ $totalVideos }}</div>
                <div class="cms-stat-text">Card Video Tutorial</div>
            </div>
        </div>

        <div class="cms-stat-box">
            <div class="cms-stat-icon-wrap purple">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div>
                <div class="cms-stat-num">{{ $totalServices }}</div>
                <div class="cms-stat-text">Layanan & Training</div>
            </div>
        </div>

        <div class="cms-stat-box">
            <div class="cms-stat-icon-wrap green">
                <i class="fa-solid fa-comments"></i>
            </div>
            <div>
                <div class="cms-stat-num">{{ $totalTestimonials }}</div>
                <div class="cms-stat-text">Ulasan Testimoni</div>
            </div>
        </div>

        <div class="cms-stat-box">
            <div class="cms-stat-icon-wrap red">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <div class="cms-stat-num">{{ $unreadMessagesCount }} <span style="font-size: 0.9rem; font-weight: normal; color: #9ca3af;">/ {{ $totalMessages }}</span></div>
                <div class="cms-stat-text">Pesan Belum Dibaca</div>
            </div>
        </div>
    </div>

    <!-- Pesan Masuk Terbaru -->
    <div class="cms-panel-card">
        <div class="cms-panel-header">
            <h2 class="cms-panel-title">
                <i class="fa-solid fa-envelope-open-text" style="color: #60a5fa;"></i> Pesan Masuk Terbaru dari Klien
            </h2>
            <a href="{{ route('cms.pesan') }}" class="btn-cms-sm btn-cms-edit">
                Lihat Semua Pesan <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Pengirim</th>
                        <th>Layanan Diminati</th>
                        <th>Ringkasan Pesan</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                        <tr>
                            <td>
                                @if(!$msg->is_read)
                                    <span class="cms-badge-tag unread">Belum Dibaca</span>
                                @else
                                    <span class="cms-badge-tag read">Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <strong style="color: #fff;">{{ $msg->nama }}</strong><br>
                                <span style="font-size: 0.78rem; color: #9ca3af;">{{ $msg->email }}</span>
                            </td>
                            <td>
                                <span class="cms-badge-tag">{{ $msg->layanan ?? 'Umum' }}</span>
                            </td>
                            <td style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $msg->pesan }}
                            </td>
                            <td style="font-size: 0.78rem; color: #9ca3af;">
                                {{ $msg->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    @if(!$msg->is_read)
                                        <form action="{{ route('cms.pesan.baca', $msg->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-cms-sm btn-cms-check" title="Tandai Dibaca">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->telepon) }}?text=Halo%20{{ urlencode($msg->nama) }},%20saya%20Ibrahim%20menanggapi%20pesan%20Anda" target="_blank" class="btn-cms-sm btn-cms-edit" title="Balas via WhatsApp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada pesan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dokumentasi Proyek Terbaru -->
    <div class="cms-panel-card">
        <div class="cms-panel-header">
            <h2 class="cms-panel-title">
                <i class="fa-solid fa-laptop-code" style="color: #34d399;"></i> Dokumentasi Proyek Aktif
            </h2>
            <a href="{{ route('cms.proyek') }}" class="btn-cms-sm btn-cms-edit">
                Kelola Semua Proyek <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Judul Dokumentasi Proyek</th>
                        <th>Kategori</th>
                        <th>Klien</th>
                        <th>Tech Stack</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProjects as $proj)
                        <tr>
                            <td>
                                <strong style="color: #fff;">{{ $proj->title }}</strong>
                            </td>
                            <td><span class="cms-badge-tag">{{ $proj->category }}</span></td>
                            <td>{{ $proj->client ?? '-' }}</td>
                            <td style="font-size: 0.78rem; color: #9ca3af;">{{ $proj->tech_stack ?? '-' }}</td>
                            <td>
                                <a href="{{ route('cms.proyek') }}" class="btn-cms-sm btn-cms-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Kelola
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada proyek ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
