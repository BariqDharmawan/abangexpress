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
                <x-shipment.input type="select" placeholder="Penerima Sebelumnya"
                name="recipient_previous" id="get-previous-recipient" required>
                    <optgroup label="Pilih penerima baru jika penerima tidak ada
                    di data sebelumnya">
                        <option value="penerima-baru" class="fw-bold">
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
            <div class="col-12">
                <x-shipment.input type="select"
                placeholder="Negara penerima" class="check-other-input-based-on-this-value"
                data-value-to-check="TAIWAN" data-input-related="#recipient-zipcode"
                name="recipient_country" required>
                    @foreach ($countryList as $country)
                        <option value="{{ $country->tujuan }}">
                            {{ $country->alias }}
                        </option>
                    @endforeach
                </x-shipment.input>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Nomor ID Card Penerima"
                    name="recipient_nik" class="not-allow-space" />
                </div>
                <div class="col-lg-6">
                    <x-shipment.input placeholder="Kode pos"
                    name="recipient_zipcode" id="recipient-zipcode" inputmode="numeric"
                    class="only-number validate-if-response-api-is-something show-other-input put-min-max-to-other-input
                    add-option-to-other-select-based-on-this-input"
                    data-input-to-put-min-max="#package-weight"
                    data-put-min="4"
                    data-put-max="23"
                    data-input-to-show="#package-length,#package-width,#package-height"
                    data-url-api="/shipping/check-zipcode"
                    data-akun="coloader" data-response-field-to-show="courier"
                    data-key="f03e563b71454776e2cb1e7b5f5ea5c4"
                    data-country="TAIWAN" data-additional-from-val="zipcode"
                    data-response-api-wish="heimao"
                    minlength="3" maxlength="8" required />
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
                data-img-preview="#idcard-preview" />
                <input type="hidden" name="idcard_input_hidden"
                id="idcard_input_hidden" />
            </div>
        </x-shipment.card>

        <x-shipment.card heading="Detail paket" icon="card_giftcard">

            <div class="row d-flex">
                <div class="col-lg-6">
                    <x-shipment.input
                    placeholder="Masukan Panjang Paket"
                    name="package_length"
                    class="d-none"
                    text-addon="(cm)"
                    id="package-length" />
                </div>
                <div class="col-lg-6">
                    <x-shipment.input
                    placeholder="Masukan Lebar Paket"
                    name="package_width"
                    text-addon="(cm)"
                    class="d-none"
                    id="package-width" />
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-lg-6">
                    <x-shipment.input
                    placeholder="Masukan Tinggi Paket"
                    name="package_height"
                    text-addon="(cm)"
                    class="d-none"
                    id="package-height" />
                </div>

                <div class="col-lg-6">
                    <x-shipment.input
                    placeholder="Masukan berat paket"
                    text-addon="(kg)" type="number" class="disable-one-option-if-this-value-something"
                    data-dropdown-target="#courier"
                    data-option-to-disable="heimao"
                    name="package_weight" id="package-weight" required />
                </div>
            </div>

            <div class="col-12">
                <x-shipment.input type="select"
                placeholder="Pilih kurir" id="courier"
                name="courier" required></x-shipment.input>
            </div>

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
                    class="only-number-not-allow-decimal" required />
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
                form="form-book-order" disabled>Order</button>
            </div>
        </x-shipment.card>
    </form>
</div>

@endsection

@section('components')
<x-shipment.modal id="modal-tnc" title="Syarat dan ketentuan">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. A quos necessitatibus, labore maiores molestiae sed atque, beatae mollitia distinctio nam similique libero reprehenderit totam culpa iusto excepturi ipsam tempore hic!
</x-shipment.modal>
@endsection
