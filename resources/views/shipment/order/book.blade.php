@extends('layouts.shipment')

@section('title', $title)

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Detail pengirim</h2>
            </div>
            <div class="body">
                <div class="row clearfix mx-0">
                    <div class="col-12">
                        <x-shipment.input placeholder="Nama pengirim"
                        name="sender_name" required />
                    </div>
                    <div class="col-12">
                        <x-shipment.input placeholder="Telepon pengirim"
                        name="sender_telephone" type="tel" required />
                    </div>
                </div>
            </div>

            <div class="header">
                <h2>Detail penerima</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Nama penerima"
                        name="recipient_name" required />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Telepon penerima"
                        name="recipient_telephone" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="NIK KTP Penerima"
                        name="recipient_nik" inputmode="numeric" 
                        class="only-number" required />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Kode pos"
                        name="recipient_zipcode" inputmode="numeric" 
                        class="only-number" required />
                    </div>
                </div>
                <div class="col-12">
                    <x-shipment.input type="select" placeholder="Negara penerima"
                    name="recipient_telephone" required>
                        @for ($i = 1; $i <= 5; $i++)
                        <option value="">Negara {{ $i }}</option>
                        @endfor
                    </x-shipment.input>
                </div>
                <div class="col-12">
                    <x-shipment.input type="textarea" 
                    placeholder="Alamat lengkap penerima"
                    name="recipient_telephone" required />
                </div>
                <div class="col-12">
                    <x-shipment.input type="file" id="id-card" 
                    placeholder="Foto KTP penerima" accept="image/*"
                    name="recipient_idcard" small-text="Gambar hanya boleh berekstensi .jpg, .jpeg, .png, .svg" required />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
