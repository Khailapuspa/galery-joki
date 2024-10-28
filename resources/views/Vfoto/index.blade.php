<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container mt-4">
            <h4>Daftar Foto</h4>
            <!-- Button untuk membuka modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#uploadFotoModal">
                Tambah Foto
            </button>

            <!-- Alert sukses jika upload berhasil -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Modal untuk upload foto -->
            <div class="modal fade" id="uploadFotoModal" tabindex="-1" aria-labelledby="uploadFotoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadFotoModalLabel">Tambah Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="file" name="file" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($fotos as $foto)
                    <div class="media-item">
                        <h5>{{ $foto->judul }}</h5>
                        @if(in_array(pathinfo($foto->file, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif']))
                            <img src="{{ asset('uploads/galeri/' . $foto->file) }}" alt="{{ $foto->judul }}" class="img-fluid">
                        @elseif(in_array(pathinfo($foto->file, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                            <video controls class="video-fluid">
                                <source src="{{ asset('uploads/galeri/' . $foto->file) }}" type="video/{{ pathinfo($foto->file, PATHINFO_EXTENSION) }}">
                                Browser Anda tidak mendukung video.
                            </video>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-app-layout>
