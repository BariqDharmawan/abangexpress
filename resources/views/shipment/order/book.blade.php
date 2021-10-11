@extends('layouts.shipment')

@section('title', )

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
>>>>>>> d91c6faab0d859ae82c2ab2299730bc2ba97a845
@endsection
