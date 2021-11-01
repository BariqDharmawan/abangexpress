@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')
<div class="row mx-0">
    @if (session('success'))
    <div class="col-12 mb-4">
        <x-admin.alert-success/>
    </div>
    @endif
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Tanya kami</h1>
            <x-admin.modal.trigger text="Tambah pertanyaan"
            modal-target="add-new-faq" />
        </div>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordion-faq">
            @foreach ($faqs as $faq)
                <div class="card mb-3 border-bottom">
                    <div class="card-header bg-light"
                    id="heading-faq-{{ $loop->iteration }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left d-flex justify-content-between hover-no-underline"
                            type="button" data-toggle="collapse"
                            data-target="#faq-{{ $loop->iteration }}"
                            @if($loop->first)aria-expanded="true"
                            @else aria-expanded="false" @endif
                            aria-controls="faq-{{ $loop->iteration }}">
                                {{ $faq->question }}
                                <i class="fas fa-chevron-down
                                collapse-icon transition-default @if($loop->first) rotate-180deg @endif"></i>
                            </button>
                        </h2>
                    </div>

                    <div id="faq-{{ $loop->iteration }}"
                        class="collapse @if($loop->first) show @endif"
                        aria-labelledby="heading-faq-{{ $loop->iteration }}"
                        data-parent="#accordion-faq">
                        <div class="card-body">
                            {{ nl2br($faq->answer) }}
                        </div>
                        <div class="card-footer bg-transparent">
                            <x-admin.modal.trigger text="Ubah detail"
                            :is-default-style="false"
                            class="btn-link text-primary px-0 mr-2"
                            modal-target="edit-faq-{{ $loop->iteration }}" />

                            <x-admin.modal.trigger text="Hapus pertanyaan"
                            :is-default-style="false"
                            class="btn-link text-danger px-0"
                            modal-target="remove-faq-{{ $loop->iteration }}" />

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('admin.partials.card-change-section')

</div>
@endsection

@section('components')

    <x-admin.modal id="change-desc-heading" heading="Ubah deskripsi dan heading">
        <form action="{{ route('admin.content.section-heading.update') }}" method="POST">
            @csrf @method('PUT')

            <x-admin.input label="Heading Title" name="faq_title"
            value="{{ $sectionTitle }}"  required />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-admin.modal>

    <x-admin.modal id="add-new-faq" heading="Tambah pertanyaan">
        @include('admin.faq.form', ['action' => route('admin.faq.store')])
    </x-admin.modal>

    @foreach ($faqs as $faq)
        <x-admin.modal id="edit-faq-{{ $loop->iteration }}" heading="Ubah pertanyaan">
            @include('admin.faq.form', [
                'action' => route('admin.faq.update', $faq->id),
                'data' => $faq
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-faq-' . $loop->iteration,
            'heading' => 'Hapus pertanyaan ' . $faq->question,
            'warningMesssage' =>
                'Apakah kamu yakin ingin menghapus pertanyaa <b>'
                . $faq->question . '</b>?',
            'action' => route('admin.faq.destroy', $faq->id)
        ])
    @endforeach

@endsection
