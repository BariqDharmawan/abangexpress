<x-admin.modal id="change-desc-heading" heading="Ubah deskripsi dan heading">
    <form action="{{ route('admin.content.section-heading.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="section-name">Heading title</label>
            <input type="text" class="form-control"
            id="section-name" name="section_name"
            value="{{ $landingSection->section_name }}" required>
        </div>
        @if ($landingSection->first_desc)
            <div class="form-group">
                <label for="section-first-desc">Deskripsi 1</label>
                <textarea name="first_desc" id="section-first-desc"
                rows="3" class="form-control summernote"
                style="resize: none;" required>{{ $landingSection->first_desc }}</textarea>
            </div>
        @endif
        @if ($landingSection->second_desc)
            <div class="form-group">
                <label for="section-second-desc">Deskripsi 2</label>
                <textarea name="second_desc" id="section-second-desc"
                class="form-control summernote"
                style="resize: none;" rows="3"
                required>{{ $landingSection->second_desc }}</textarea>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-admin.modal>
