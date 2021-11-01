<div class="col-12">
    <x-admin.card title="Heading Section" class="m{{ isset($side) ? $side : 't' }}-5">
        <x-slot name="header">
            <x-admin.modal.trigger text="Ubah heading"
            modal-target="change-desc-heading" />
        </x-slot>
        <h1 class="h4">{{ $sectionTitle }}</h1>
        @isset ($sectionDesc)
            <p>{{ $sectionDesc }}</p>
        @endisset
    </x-admin.card>
</div>
