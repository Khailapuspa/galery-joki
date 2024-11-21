<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Hello, {{ Auth::user()->name }}</h3>
                            <p class="mb-0">Here are the latest posts:</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menampilkan Data Posts -->
            <div class="row">
                @if($posts->isEmpty())
                    <p class="text-center">No posts available.</p>
                @else
                    @foreach($posts as $post)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm rounded">
                                <!-- Gambar Post -->
                                <a href="#modalFoto{{ $post->id }}" data-bs-toggle="modal">
                                    <img src="{{ $post->foto ? asset('uploads/galeri/' . $post->foto->file) : asset('storage/default.jpg') }}"
                                        class="card-img-top img-fluid rounded-top"
                                        alt="{{ $post->judul }}"
                                        style="height: 200px; object-fit: cover;">
                                </a>

                                <!-- Judul dan Isi Post -->
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $post->judul }}</h5>
                                    <p class="card-text text-muted text-truncate">{{ Str::limit($post->isi, 100, '...') }}</p>
                                </div>

                                <!-- Footer Card -->
                                {{-- <div class="card-footer bg-transparent border-0 text-center">
                                    <a href="{{ route('Vposts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View Post
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Modal Foto -->
                        <div class="modal fade" id="modalFoto{{ $post->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $post->id }}">{{ $post->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $post->foto ? asset('uploads/galeri/' . $post->foto->file) : asset('storage/default.jpg') }}"
                                            class="img-fluid rounded"
                                            alt="{{ $post->judul }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
