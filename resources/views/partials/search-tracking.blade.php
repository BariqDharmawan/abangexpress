<form method="GET" class="col-lg-8" action="{{ route('tracking-order.index') }}">
    @csrf
    <div class="row align-items-center justify-content-center 
                    position-relative">
        <div class="col-12 mx-0 px-0">
            <input type="text" class="form-control py-3 ps-lg-4 py-lg-4 shadow input--btn-inside not-allow-space"
                minlength="3" placeholder="Ketik nomor resi disini" name="track_order" required>
            @error('track_order')
            <span class="text-{{ $errorText }} text-shadow
            input__error-message input__error-message--absolute-bottom">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary
                            btn--inside-input py-lg-2">
                <i class="fas fa-search"></i>
                <span class="d-none d-lg-block" style="margin-left: 10px">
                    Cari resi
                </span>
            </button>
        </div>
    </div>
</form>