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

           <!-- Modal untuk melihat foto besar dan tombol hapus -->
            <div class="modal fade" id="viewFotoModal" tabindex="-1" aria-labelledby="viewFotoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewFotoModalLabel">Lihat Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="modalImage" src="" alt="Foto Besar" class="img-fluid" style="max-width: 90%; max-height: 500px;">
                            <!-- Form Delete -->
                            <form id="deleteFotoForm" action="#" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Hapus Foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Card Foto -->
            <div class="row">
                @foreach($fotos as $foto)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm h-100" onclick="showModal('{{ asset('uploads/galeri/' . $foto->file) }}', '{{ route('Vfoto.destroy', $foto->id) }}')">
                        <img src="{{ asset('uploads/galeri/' . $foto->file) }}" class="card-img-top" alt="{{ $foto->judul }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-truncate">{{ $foto->judul }}</h6>
                            {{-- <p class="text-muted mb-1">Album: {{ $gallery->judul }}</p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </main>

    <script>
         function showModal(imageSrc, deleteUrl) {
        // Menampilkan foto di modal
        document.getElementById('modalImage').src = imageSrc;

        // Mengatur action form delete dengan URL yang benar
        document.getElementById('deleteFotoForm').action = deleteUrl;

        // Menampilkan modal
        var modal = new bootstrap.Modal(document.getElementById('viewFotoModal'));
        modal.show();
    }

        // document.addEventListener('DOMContentLoaded', function() {
        //     // Event listener untuk card klik
        //     var cards = document.querySelectorAll('.card[data-img-url]');
        //     cards.forEach(function(card) {
        //         card.addEventListener('click', function() {
        //             var imgUrl = card.getAttribute('data-img-url');
        //             var deleteUrl = card.getAttribute('data-delete-url');

        //             // Set src image pada modal
        //             document.getElementById('modalImage').src = imgUrl;

        //             // Set action form delete pada modal
        //             document.getElementById('deleteFotoForm').action = deleteUrl;
        //         });
        //     });
        // });
    </script>
</x-app-layout>
