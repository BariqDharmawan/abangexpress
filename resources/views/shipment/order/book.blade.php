@extends('layouts.shipment')

@section('title', )

@push('style-plugins')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<<<<<<< HEAD

<form  method="POST" >
    @csrf
    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                </div>
            </div>
        </div>

        {{--
            divide et impera
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form  method="POST" >
                        @csrf
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form  method="POST" >
                        @csrf
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>
</form>
=======
<div class="row clearfix">
    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" 
    id="form-book-order" method="POST">
        @csrf
        <div class="card">
            <div class="header">
                <h2 class="h1 fw-bold">Detail pengirim</h2>
            </div>
            <div class="body">
                <div class="row clearfix mx-0">
                    <div class="col-12">
                        <x-shipment.input placeholder="Nama pengirim"
                        name="sender_name" class="not-allow-number" required />
                    </div>
                    <div class="col-12">
                        <x-shipment.input placeholder="Telepon pengirim"
                        name="sender_telephone" class="only-number" 
                        type="tel" required />
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="header">
                <h2 class="h1 fw-bold">Detail penerima</h2>
            </div>
            <div class="body">
                <div class="col-12">
                    <x-shipment.input type="select" placeholder="Penerima Sebelumnya"
                    name="recipient_previous" required>
                        {{-- <optgroup label="Data penerima sebelumnya"> --}}
                            @for ($i = 1; $i <= 5; $i++)
                            <option value="">nama orang {{ $i }}</option>
                            @endfor
                        {{-- </optgroup> --}}
                        {{-- <optgroup label="Pilih penerima baru jika penerima tidak ada di data sebelumnya">
                            <option value="" class="fw-bold">Penerima Baru</option>
                        </optgroup> --}}
                    </x-shipment.input>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Nama penerima"
                        name="recipient_name" class="not-allow-number" required />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Telepon penerima"
                        name="recipient_telephone" class="only-number" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
<<<<<<< HEAD
                        <x-shipment.input placeholder="NIK KTP Penerima"
                        name="recipient_nik" inputmode="numeric"
=======
                        <x-shipment.input placeholder="Nomor ID Card Penerima"
                        name="recipient_nik" inputmode="numeric" 
>>>>>>> 43fe0299f5affdf35fab03cd204926eaab11c4d2
                        class="only-number" required />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input placeholder="Kode pos"
<<<<<<< HEAD
                        name="recipient_zipcode" inputmode="numeric"
                        class="only-number" required />
=======
                        name="recipient_zipcode" inputmode="numeric" 
                        class="only-number" minlength="3" maxlength="8" required />
>>>>>>> 43fe0299f5affdf35fab03cd204926eaab11c4d2
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
<<<<<<< HEAD
                    <x-shipment.input type="textarea"
=======
                    <x-shipment.input type="textarea" id="recipient-address" 
>>>>>>> 43fe0299f5affdf35fab03cd204926eaab11c4d2
                    placeholder="Alamat lengkap penerima"
                    name="recipient_address" required />
                </div>
                <div class="col-12">
<<<<<<< HEAD
                    <x-shipment.input type="file" id="id-card"
                    placeholder="Foto KTP penerima" accept="image/*"
                    name="recipient_idcard" small-text="Gambar hanya boleh berekstensi .jpg, .jpeg, .png, .svg" required />
=======
                    <img src="" alt="" id="idcard-preview" height="100px" class="mb-2">
                    <x-shipment.input type="file" id="id-card" 
                    placeholder="Foto KTP penerima" class="preview-upload" 
                    accept="image/*"
                    name="recipient_idcard" maxlength="8" minlength="3"
                    small-text="Gambar hanya boleh berekstensi .jpg, .jpeg, .png, .svg"  
                    data-img-preview="#idcard-preview" required />
                </div>
            </div>
        </div>

        <div class="card">
            <div class="header">
                <h2 class="h1 fw-bold">Detail paket</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-6">
                        <x-shipment.input type="text" 
                        placeholder="Masukan tarif ke pelanggan anda"
                        name="package_fee" class="input-currency" 
                        id="package-fee" />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input type="number" 
                        placeholder="Masukan berat paket"
                        small-text="Berat paket dibulatkan keatas (kg)"
                        name="package_weight" required />
                    </div>
                </div>
                <div class="col-12">
                    <x-shipment.input type="select" 
                    placeholder="Pilh jenis paket"
                    name="package_type" required>
                        @for ($i = 1; $i <= 4; $i++)
                        <option value="">jenis {{ $i }}</option>
                        @endfor
                    </x-shipment.input>
                </div>
                <div class="col-12">
                    <x-shipment.input type="textarea" 
                    placeholder="Jelaskan detail isi paket"
                    name="package_detail" required />
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <x-shipment.input type="number" 
                        placeholder="Masukan jumlah paket / koli"
                        name="package_fee" required />
                    </div>
                    <div class="col-lg-6">
                        <x-shipment.input type="text" text-addon="USD" 
                        placeholder="Masukan total harga kiriman" 
                        class="input-currency"
                        id="package-value"
                        small-text="Harga menggunakan mata uang dollar"
                        name="package_value" required />
                    </div>
                </div>
                <div class="row no-before no-after d-flex justify-content-between mx-0 flex-md-column">
                    <small class="mb-3 mb-md-0">
                        Dengan menekan tombol "order", anda sudah menyetujui 
                        <button type="button" class="btn btn-link p-0 text-primary
                        waves-effect m-r-20" data-toggle="modal"
                        data-target="#modal-tnc">
                            syarat & ketentuan
                        </button>
                    </small>
                    <button type="submit" class="btn btn-big btn-primary">Order</button>
>>>>>>> 43fe0299f5affdf35fab03cd204926eaab11c4d2
                </div>
            </div>
        </div>
    </form>
</div>
>>>>>>> d91c6faab0d859ae82c2ab2299730bc2ba97a845
@endsection

@section('components')
<x-shipment.modal id="modal-tnc" title="Syarat dan ketentuan">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. A quos necessitatibus, labore maiores molestiae sed atque, beatae mollitia distinctio nam similique libero reprehenderit totam culpa iusto excepturi ipsam tempore hic!
</x-shipment.modal>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush