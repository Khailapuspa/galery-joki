<form action="{{ route('Vfoto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $foto->judul }}" required>
    </div>

    <div class="mb-3">
        <label for="galery_id" class="form-label">Galeri</label>
        <select class="form-select" id="galery_id" name="galery_id" required>
            @foreach($galeries as $galery)
                <option value="{{ $galery->id }}" {{ $foto->galery_id == $galery->id ? 'selected' : '' }}>
                    {{ $galery->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Upload File (kosongkan jika tidak ingin mengubah)</label>
        <input type="file" class="form-control" id="file" name="file" accept="image/*">

        @if($foto->file)
            <small class="form-text text-muted">File saat ini: <a href="{{ asset('uploads/galeri/' . $foto->file) }}" target="_blank">{{ $foto->file }}</a></small>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Foto</button>
</form>
