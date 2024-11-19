<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Post</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">Tambah Post</button>
                </div>

                <div class="card-body">
                    <!-- Menampilkan Alert jika ada pesan sukses -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Daftar Posts -->
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4 mb-4">
                                <!-- Card Post -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->judul }}</h5>
                                        <p class="card-text">{{ $post->isi }}</p>
                                    <div class="card">
                                        <!-- Menampilkan Foto Berdasarkan foto_id -->
                                        @if($post->foto)
                                            <img src="{{ asset('uploads/galeri/' . $post->foto->file) }}" class="card-img-top" alt="{{ $post->foto->judul }}">
                                        @else
                                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-top" alt="No image available">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->judul }}</h5>
                                            <p class="card-text">{{ $post->isi }}</p>

                                            <!-- Button Status Aktif/Tidak Aktif -->
                                            <div class="d-flex justify-content-between mt-3">
                                                @if($post->status == 1)
                                                    <button class="btn btn-success btn-sm">
                                                        Aktif (1)
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm">
                                                        Tidak Aktif (0)
                                                    </button>
                                                @endif

                                                <!-- Button Edit -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPostModal-{{ $post->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Post -->
        <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createPostModalLabel">Tambah Post Baru</h5>
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
                                        <option value="{{ $kategori->id }}">{{ $kategori->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto_id" class="form-label">Foto</label>
                                <select class="form-select" name="foto_id" id="fotoSelect" required>
                                    <option value="" selected>Pilih Foto</option>
                                    @foreach($fotos as $foto)
                                        <option value="{{ $foto->id }}">{{ $foto->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi</label>
                                <textarea class="form-control" name="isi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="users_id" class="form-label">Petugas</label>
                                <input type="text" class="form-control" name="users_id" value="{{ auth()->user()->id }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0" selected>Tidak Aktif</option>
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


            <!-- Modal Edit Post -->
            <div class="modal fade" id="editPostModal-{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel-{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPostModalLabel-{{ $post->id }}">Edit Post: {{ $post->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Post</label>
                                    <input type="text" class="form-control" name="judul" value="{{ $post->judul }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select class="form-select" name="kategori_id" required>
                                        @foreach($categories as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $post->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="foto_id" class="form-label">Foto</label>
                                    <select class="form-select" name="foto_id" required>
                                        @foreach($fotos as $foto)
                                            <option value="{{ $foto->id }}" {{ $post->foto_id == $foto->id ? 'selected' : '' }}>{{ $foto->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi</label>
                                    <textarea class="form-control" name="isi" rows="3" required>{{ $post->isi }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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


        <x-app.footer />
    </main>
</x-app-layout>


