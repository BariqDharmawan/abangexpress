@extends('layouts.admin')

@section('content')
<div class="row mx-0">
    @if (session('success'))
    <div class="col-12 mb-4">
        <x-admin.alert-success/>
    </div>
    @endif
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Manage FAQ</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-faq">
                Add new faq
            </button>
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
                            <button type="button" class="btn btn-link text-primary px-0 mr-2" data-toggle="modal" data-target="#edit-faq-{{ $loop->iteration }}">
                                Edit detail
                            </button>
                            <button class="btn btn-link text-danger px-0" data-toggle="modal" 
                            type="button" data-target="#remove-faq-{{ $loop->iteration }}">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('components')
    <x-admin.modal id="add-new-faq" heading="Add new FAQ">
        @include('admin.faq.form', ['action' => route('admin.faq.store')])
    </x-admin.modal>

    @foreach ($faqs as $faq)
        <x-admin.modal id="edit-faq-{{ $loop->iteration }}" heading="Add new FAQ">
            @include('admin.faq.form', [
                'action' => route('admin.faq.update', $faq->id),
                'data' => $faq
            ])
        </x-admin.modal>

        @include('admin.partials.popup-delete', [
            'id' => 'remove-faq-' . $loop->iteration,
            'heading' => 'Remove FAQ ' . $faq->question,
            'warningMesssage' => 
                'Are you sure wana remove <b>' . $faq->question . '</b>?',
            'action' => route('admin.faq.destroy', $faq->id)
        ])
    @endforeach

@endsection