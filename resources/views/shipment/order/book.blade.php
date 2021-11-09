@extends('layouts.shipment')

@section('title', $title)

@section('content')

<div class="row clearfix">
    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" method="POST"
    action="{{ route('shipping.order.book.step-order') }}"
    id="form-book-order" enctype="multipart/form-data">
        @csrf
        <x-shipment.card heading="Detail Pengirim" icon="account_box">
            <div class="row clearfix mx-0">
                <div class="col-12">
                    <x-shipment.input placeholder="Nama pengirim"
                    name="sender_name" class="not-allow-number" required />
                </div>
                <div class="col-12">
                    <x-shipment.input placeholder="Telepon pengirim"
                    name="sender_telephone" class="only-number"
                    type="tel" minlength="7" maxlength="15" required />
                </div>
            </div>
        </x-shipment.card>

        <x-shipment.card heading="Detail Penerima" icon="person_add" id="data-recipient">
            <div class="col-12">
                <x-shipment.input type="select" placeholder="Pilih penerima"
                name="recipient_previous" id="get-previous-recipient" required>
                    <optgroup label="Pilih penerima baru jika penerima tidak ada
                    di data sebelumnya">
                        <option value="penerima-baru" class="fw-bold" selected>
                            Penerima Baru
                        </option>
                    </optgroup>
                    <optgroup label="Data penerima sebelumnya">
                        @foreach ($prevRecipient as $recipient)
                            <option value="{{ $recipient->id }}">
                                {{ $recipient->name }} - {{ $recipient->country }} - {{ $recipient->telephone }}
                            </option>
                        @endforeach
                    </optgroup>
                </x-shipment.input>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Nama penerima"
                    name="recipient_name" class="not-allow-number" required />
                </div>
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Telepon penerima"
                    name="recipient_telephone" class="only-number"
                    minlength="8" maxlength="15" required />
                </div>
            </div>

            @if(strpos(strtolower($akun),'arm') !== false)
            <div class="col-12">
                <x-shipment.input type="select"
                placeholder="Negara penerima" class="validate-receiver-package"
                data-value-to-check="TAIWAN" data-url-api="/shipping/check-zipcode"
                data-input-related="#recipient-zipcode"
                name="recipient_country" required>
                    <option value="TAIWAN">TAIWAN</option>
                </x-shipment.input>
            </div>
            @else
            <div class="col-12">
                <x-shipment.input type="select"
                placeholder="Negara penerima" class="validate-receiver-package"
                data-value-to-check="TAIWAN" data-url-api="/shipping/check-zipcode"
                data-input-related="#recipient-zipcode"
                name="recipient_country" required>
                    @foreach ($countryList as $country)
                        <option value="{{ $country->tujuan }}">
                            {{ $country->alias }}
                        </option>
                    @endforeach
                </x-shipment.input>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Nomor ID Card Penerima"
                    name="recipient_nik" class="not-allow-space" maxlength="40" />
                </div>
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Kode pos"
                    name="recipient_zipcode" id="recipient-zipcode" inputmode="numeric"
                    class="only-number" data-akun="coloader" data-key="f03e563b71454776e2cb1e7b5f5ea5c4" data-country="TAIWAN" required />
                </div>
            </div>
            <div class="col-12">
                <x-shipment.input type="textarea" id="recipient-address"
                placeholder="Alamat lengkap penerima" class="prevent-enter"
                name="recipient_address" required />
            </div>
            <div class="col-12">
                <img src="" alt="Photo ID Card" id="idcard-preview"
                height="100px" class="mb-2 d-none">

                {{-- get idcard photo from database if
                recipient_previous is not 'penerima-baru' --}}
                <x-shipment.input type="file" id="id-card"
                placeholder="Foto KTP penerima" class="preview-upload"
                accept="image/*" input-hidden="idcard_input_hidden"
                name="recipient_idcard" maxlength="8" minlength="3"
                small-text="Gambar hanya boleh berekstensi .jpg, .jpeg, .png, .svg"
                data-img-preview="#idcard-preview" required />
                <input type="hidden" name="idcard_input_hidden"
                id="idcard_input_hidden" />
            </div>
        </x-shipment.card>

        <x-shipment.card heading="Detail paket" icon="card_giftcard">

            <div class="row d-flex parent-validate-package" data-dropdown-target="#courier"
            data-option-to-disable="heimao">
                <div class="row col-lg-6">
                    <p class="form-label fw-bold pl-4 m-b-2 form-label--required">Dimensi paket (cm)</p>
                    <div class="col-lg-4">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input
                                type="number"
                                min="1"
                                name="package_length"
                                class="form-control"
                                id="package-length" required />
                                <label class="form-label mb-0" for="package-length">
                                    Panjang
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input
                                type="number"
                                min="1"
                                name="package_width"
                                class="form-control"
                                id="package-width" required />
                                <label class="form-label mb-0" for="package-width">
                                    Lebar
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input
                                type="number"
                                min="1"
                                name="package_height"
                                class="form-control"
                                id="package-height" required />
                                <label class="form-label mb-0" for="package-height">
                                    Tinggi
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <x-shipment.input
                    placeholder="Masukan berat paket"
                    text-addon="(kg)" type="number" min="1"
                    name="package_weight" id="package-weight" required />
                </div>
            </div>
            {{-- @if(strpos(strtolower($akun),'arm') !== false) --}}
            <div class="col-12 d-none" id="select-courier">
                <x-shipment.input type="select"
                placeholder="Pilih kurir" class="form-control"
                name="courier" id="courier"></x-shipment.input>
            </div>
            {{-- @else
            @endif --}}

            <div class="col-12">
                <x-shipment.input type="select"
                placeholder="Pilh jenis paket"
                name="package_type" required>
                    @foreach ($commodityList as $commodity)
                        <option value="{{ $commodity->commodity }}">
                            {{ $commodity->commodity }}
                        </option>
                    @endforeach
                </x-shipment.input>
            </div>
            <div class="col-12">
                <x-shipment.input type="textarea"
                placeholder="Jelaskan detail isi paket"
                name="package_detail" id="package-detail"
                class="prevent-enter" required />
            </div>
            <div class="row d-flex">
                <div class="col-lg-6 d-flex items-center">
                    <x-shipment.input type="number"
                    placeholder="Masukan jumlah paket / koli"
                    name="package_koli" id="package-koli" min="1" step="1"
                    class="only-number-not-allow-decimal" required
                    small-text="Jangan inputkan angka decimal, wajib angka bulat" />
                </div>
                <div class="col-lg-6">
                    <x-shipment.input type="text" icon-addon="attach_money"
                    label="Masukan total harga kiriman"
                    placeholder=""
                    class="input-currency"
                    id="package-value"
                    small-text="Harga menggunakan mata uang dollar"
                    name="package_value" required />
                </div>
            </div>

            <div class="row no-before no-after d-flex justify-content-between mx-0 flex-md-column">
                <small class="mb-3 mb-md-0">
                    Dengan menekan tombol "order", anda sudah menyetujui
                    <x-shipment.modal-trigger text="syarat & ketentuan"
                    class="btn-link p-0 text-primary m-r-20"
                    target="modal-tnc" />
                </small>
                <button type="submit" class="btn btn-big btn-primary"
                form="form-book-order">Order</button>
            </div>
        </x-shipment.card>
    </form>
</div>

@endsection

@section('components')
<x-shipment.modal id="modal-tnc" title="Syarat dan ketentuan">
    Mohon untuk mengisi data dengan valid..!!
</x-shipment.modal>
@endsection
