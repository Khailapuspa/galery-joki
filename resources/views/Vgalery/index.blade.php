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
                            <!-- Card galeri -->
                            <div class="card gallery-card h-100">
                                <!-- Bagian atas card yang berisi judul dan link ke detail galeri -->
                                <a href="{{ route('Vgalery.show', $galery->id) }}" class="text-decoration-none text-dark">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $galery->judul }}</h5>
                                    </div>
                                </a>

                                <!-- Garis pemisah -->
                                <hr class="card-divider">

                                <!-- Bagian bawah card untuk tombol edit dan delete -->
                                <div class="card-footer text-center">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editGalleryModal{{ $galery->id }}">Editt</button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('Vgalery.destroy', $galery->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- Tombol Post -->
                                    <button class="btn btn-info btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#createPostModal{{ $galery->id }}">Post</button>
                                </div>
                            </div>
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

        @foreach($galleries as $galery)
            <!-- Modal untuk Edit Galeri -->
            <div class="modal fade" id="editGalleryModal{{ $galery->id }}" tabindex="-1" aria-labelledby="editGalleryModalLabel{{ $galery->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('Vgalery.update', $galery->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editGalleryModalLabel{{ $galery->id }}">Edit Galeri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Galeri</label>
                                    <input type="text" class="form-control" name="judul" value="{{ $galery->judul }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control" name="position" value="{{ $galery->position }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ $galery->status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $galery->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        @foreach($galleries as $galery)
            <!-- Modal untuk menambah post -->
            <div class="modal fade" id="createPostModal{{ $galery->id }}" tabindex="-1" aria-labelledby="createPostModalLabel{{ $galery->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $galery->id }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createPostModalLabel{{ $galery->id }}">Tambah Post untuk Galeri {{ $galery->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Post</label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select class="form-select" name="kategori_id" required>
                                        @foreach($categories as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi</label>
                                    <textarea class="form-control" name="isi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="petugas_id" class="form-label">Petugas</label>
                                    <input type="text" class="form-control" name="petugas_id" value="{{ auth()->user()->id }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach


        <x-app.footer />
    </main>

    <!-- Tambahkan CSS untuk tampilan card -->
    <style>
        .gallery-card {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden; /* Menghindari konten card melampaui batas */
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .gallery-card .card-body {
        padding: 16px;
    }

    .card-title {
        font-weight: bold;
        color: #343a40;
    }

    .card-divider {
        border-top: 1px dashed #e0e0e0;
        margin: 0; /* Menghilangkan margin tambahan */
    }

    .card-footer {
        padding: 12px;
        background-color: #f1f1f1; /* Latar belakang footer untuk memisahkan dari bagian atas */
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.875em;
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
