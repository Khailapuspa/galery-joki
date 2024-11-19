<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container mt-4">
            <h4 class="mb-4">Daftar Foto untuk Galeri: <strong>{{ $gallery->judul }}</strong></h4>

            <!-- Container untuk tombol "Kembali" dan "Tambah Foto" -->
            <div class="d-flex justify-content-between mb-4">
                <!-- Button Back untuk kembali ke halaman Vgalery.index -->
                <a href="{{ route('Vgalery.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <!-- Button untuk membuka modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFotoModal">
                    <i class="fas fa-plus"></i> Tambah Foto
                </button>
            </div>

            <!-- Alert sukses jika upload berhasil -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="color: black; background-color: transparent;"></button>
                </div>
            @endif

            <!-- Modal untuk upload foto -->
            <div class="modal fade" id="uploadFotoModal" tabindex="-1" aria-labelledby="uploadFotoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('Vfoto.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadFotoModalLabel">Tambah Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="galery_id" value="{{ $gallery->id }}">
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

           <!-- Modal untuk melihat foto besar, tombol hapus, dan edit -->
           <div class="modal fade" id="viewFotoModal" tabindex="-1" aria-labelledby="viewFotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewFotoModalLabel">Lihat Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Foto Besar" class="img-fluid" style="max-width: 90%; max-height: 500px;">
                        <div class="d-flex justify-content-center mt-3">
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <!-- Modal untuk Edit Foto -->
            <div class="modal fade" id="editFotoModal" tabindex="-1" aria-labelledby="editFotoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editFotoForm" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFotoModalLabel">Edit Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editGaleryId" name="galery_id" value="{{ $gallery->id }}">
                                <div class="mb-3">
                                    <label for="editJudul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="editJudul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editFile" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="editFile" name="file" accept="image/*">

                                    <!-- Menampilkan file yang sudah diupload sebelumnya -->
                                    <small class="form-text text-muted" id="currentFile"></small>

                                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card Foto -->
            <div class="row">
                @foreach($fotos as $foto)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <!-- Card Image -->
                        <img
                            src="{{ asset('uploads/galeri/' . $foto->file) }}"
                            class="card-img-top"
                            alt="{{ $foto->judul }}"
                            style="height: 180px; object-fit: cover; cursor: pointer;"
                            onclick="showImageModal('{{ asset('uploads/galeri/' . $foto->file) }}')">
                        <div class="card-body">
                            <!-- Card Title -->
                            <h6 class="card-title text-truncate">{{ $foto->judul }}</h6>

                            <!-- Button Group -->
                            <div class="d-flex justify-content-between mt-3">
                                <!-- Button Edit -->
                                <button class="btn btn-warning btn-sm" onclick="showEditModal('{{ $foto->id }}', '{{ $foto->judul }}', '{{ asset('uploads/galeri/' . $foto->file) }}', '{{ $foto->file }}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <!-- Form Delete -->
                                <form action="{{ route('Vfoto.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>
    </main>

    <script>
        function showImageModal(imageUrl) {
        // Set the image source for the larger view modal
        document.getElementById('modalImage').src = imageUrl;

        // Show the view photo modal
        var viewFotoModal = new bootstrap.Modal(document.getElementById('viewFotoModal'));
        viewFotoModal.show();
    }

    function showEditModal(id, title, imageUrl, fileName) {
    // Set the title field in the edit modal
    document.getElementById('editJudul').value = title;

    // Update the form action with the correct ID
    document.getElementById('editFotoForm').action = `/Vfoto/${id}`;

    // Display the current file name and make it visible in the edit modal
    const fileInfo = document.getElementById('currentFile');
    fileInfo.innerHTML = `File saat ini: <a href="${imageUrl}" target="_blank">${fileName}</a>`;

    // Show the edit photo modal
    var editModal = new bootstrap.Modal(document.getElementById('editFotoModal'));
    editModal.show();
}

    </script>
</x-app-layout>
