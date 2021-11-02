<h2 class="mb-1">Gambar</h2>

@if(isset($galleryImg) and count($galleryImg) > 0)
    <small class="d-block text-black-50 font-weight-bold mb-3">
        Klik gambar untuk zoom
    </small>
    <div class="row">
        @foreach ($galleryImg as $gallery)
        <div class="col-lg-3 mb-5">
            <a href="{{ asset($gallery->img) }}" class="glightbox position-relative d-block" data-gallery="gallery-img">
                <img src="{{ asset($gallery->img) }}" width="100%" class="object-cover" height="300px"
                alt="image" />
                <img src="{{ asset('img/icon/bxs-zoom-in.svg') }}" height="40px" class="center-parent" alt=""
                    title="Klik untuk zoom">
            </a>
            @if (isset($hasBtnDelete) and $hasBtnDelete)
                <x-admin.modal.trigger text="Hapus"
                    modal-target="remove-image-{{ $loop->iteration }}"
                    class="d-block w-100 mt-2 btn-danger" />
            @endif
        </div>
        @endforeach
    </div>
@else
    <small>Tidak ada gallery berupa gambar saat ini, tambahkan sekarang</small>
@endif

<h2 class="mt-4">Video</h2>
@if(isset($galleryYoutube) and count($galleryYoutube) > 0)
    <small class="d-block text-black-50 font-weight-bold mb-3">
        Klik video untuk zoom
    </small>
    <div class="row">
        @foreach ($galleryYoutube as $gallery)
        <div class="col-lg-3 mb-5">
            <a href="{{ $gallery->youtube }}" class="glightbox position-relative">
                <img src="https://img.youtube.com/vi/{{ Str::after(
                    $gallery->youtube, 'https://www.youtube.com/watch?v='
                ) }}/hqdefault.jpg" alt="" class="border rounded img-fluid" />
                <img src="{{ asset('img/icon/bx-play.svg') }}" height="60px" class="center-parent" alt="">
            </a>

            @if (isset($hasBtnDelete) and $hasBtnDelete)
            <x-admin.modal.trigger text="Hapus"
            modal-target="remove-youtube-{{ $loop->iteration }}"
            class="d-block w-100 mt-2 btn-danger" />
            @endif
        </div>
        @endforeach
    </div>
@else
    <small>Tidak ada gallery berupa video saat ini, tambahkan sekarang</small>
@endif
