<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Galeri</h4>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGalleryModal">Tambah Galeri</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($galleries as $galery)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('Vgalery.show', $galery->id) }}" class="text-decoration-none text-dark">
                                <div class="card gallery-card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $galery->judul }}</h5>
                                        {{-- <p class="card-text">{{ $galery->position }}</p>
                                        @if($galery->status == 1)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk menambah galeri -->
        <div class="modal fade" id="createGalleryModal" tabindex="-1" aria-labelledby="createGalleryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('Vgalery.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createGalleryModalLabel">Tambah Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Galeri</label>
                                <input type="text" class="form-control" name="judul" id="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" id="position" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Galeri</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <x-app.footer />
    </main>

    <!-- Tambahkan CSS untuk tampilan card -->
    <style>
        .gallery-card {
            background-color: #f8f9fa; /* Memberikan warna latar belakang abu-abu muda */
            border: 1px solid #e0e0e0; /* Menambahkan border */
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border-radius: 8px; /* Membuat sudut sedikit melengkung */
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background-color: #e9ecef; /* Warna latar belakang saat hover */
        }

        .gallery-card .card-title {
            font-weight: bold;
            color: #343a40; /* Warna teks judul agar lebih gelap */
        }

        .gallery-card .card-text {
            color: #6c757d; /* Warna teks posisi agar tidak terlalu kontras */
        }

        .badge {
            font-size: 0.9em;
            padding: 0.4em 0.7em;
        }

        /* Menambahkan efek pada badge */
        .badge.bg-success {
            background-color: #28a745;
        }

        .badge.bg-danger {
            background-color: #dc3545;
        }
    </style>

</x-app-layout>
