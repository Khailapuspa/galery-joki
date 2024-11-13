<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- <x-app.navbar /> --}}
        <div class="container-fluid py-4 px-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h4>Kategori</h4>
                                    <p class="text-sm mb-sm-0">Daftar Kategori</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-dark d-flex align-items-center mb-0 me-2" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                                        <span class="btn-inner--text" style="font-size: 1.2em; font-weight: bold;">Tambah Kategori</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead style="background: linear-gradient(to right, #3b82f6, #7c3aed); color: white;">
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th style="width: 70%;">Judul</th>
                                            <th style="width: 25%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoris as $index => $kategori)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $kategori->judul }}</td>
                                                <td>
                                                    <!-- Button Edit -->
                                                    <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $kategori->id }}">Edit</button>

                                                    <!-- Form Delete -->
                                                    <form action="{{ route('Vkategori.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('Vkategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="judul">Judul Kategori</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

                <!-- Modal Edit Kategori -->
                @foreach ($kategoris as $kategori)
                <div class="modal fade" id="editKategoriModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $kategori->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('Vkategori.update', $kategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKategoriModalLabel{{ $kategori->id }}">Edit Kategori</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="judul">Judul Kategori</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $kategori->judul }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

    </main>
</x-app-layout>
