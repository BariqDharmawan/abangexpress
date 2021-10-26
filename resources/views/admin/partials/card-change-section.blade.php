<div class="col-12">
    <x-admin.card title="Deskripsi dan heading" class="m{{ isset($side) ? $side : 't' }}-5">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ubah deskripsi dan heading"
            modal-target="change-desc-heading" />
        </x-slot>
        <h1 class="h4">{{ $landingSection->section_name }}</h1>
    </x-admin.card>
</div>