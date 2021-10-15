@extends('layouts.shipment')

{{-- @section('title', $title) --}}

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
    id="parent-{{ $tableClass}}">
        <div class="card">
            <div class="header">
                <h2>
                    {{$title}}
                </h2>
            </div>
            <div class="header">
                <button type="button" class="btn m-b-10 bg-green waves-effect" data-toggle="collapse" data-target="#myxDIV" aria-expanded="true" aria-controls="myxDIV">
                    <i class="material-icons">filter_list</i>
                    <span>Filter</span>
                </button>
               <div class="collapse" id="myxDIV" aria-expanded="true">
                    <div  class="well">
                        <div class="row">

                            <form role="form" method="POST" action="{{ route('shipping.order.filter.order') }}"
                            autocomplete="off">
                                @csrf
                                <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="disabledSelect">Tanggal Awal</label>
                                                <input class="form-control" name="awal" type="date">
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledSelect">Pengirim</label>
                                                <input class="form-control" name="pengirim" type="text">
                                            </div>
                                </div>
                                <div class="col-lg-4">

                                        <div class="form-group">
                                            <label for="disabledSelect">Tanggal Akhir</label>
                                            <input class="form-control" name="akhir" type="date">
                                        </div>

                                        <div class="form-group">
                                            <label class="">Sub Cabang</label>
                                            <select class="custom-select2 form-control select2-hidden-accessible" name="kodeanak" style="width: 100%; height: 38px;" required="" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option disabled="" selected="" data-select2-id="3">ALL</option>
                                            <option value="666blast">febry setiawan</option><option value="ACT-20210001">BANG TAMPAN</option><option value="ACT-20210002">ABDUL KHOLIK</option><option value="adin">ADIN</option><option value="adminrifki">rifki</option><option value="ALWI">ABANG EXPRESS INTERNATIONAL</option><option value="CDM-20210001">ZHULIAN FIRDAUS</option><option value="CMS-20210001">ARIS MUNANDAR</option><option value="CMS-20210002">RIZKI ANGGRIAWAN</option><option value="CMS-20210003">NOVAN SARIFUDIN</option><option value="CMS-20210004">BUSTOMI</option><option value="CMS-20210005">ABBAS MARSAH</option><option value="coloader">sample Re-Loader</option><option value="daniel">DANIEL</option><option value="DRT-20210001">ALWI</option><option value="GNA-20210001">LUKMAN NUR TOHA</option><option value="helmi">HELMI</option><option value="KOP-20210001">SUNARYO</option><option value="MNG-20210001">RIFKI FAUZI</option><option value="muis">Bang Tampan</option><option value="OAX0001">OPERATOR</option><option value="OBN-20210001">AHAD SUDRAJAD</option><option value="OBN-20210002">MAULANA YUSUF</option><option value="OBN-20210004">AHMAD AWALUDIN</option><option value="OBN-20210005">PUTRA RIDWAN</option><option value="OPR-20210001">RUDI SATRIA ANDIKA</option><option value="OPR-20210002">MUHAMMAD</option><option value="OPR-20210003">RUDI SATRIA ANDIKA</option><option value="OPR-20210004">ACHMAD DHARMAWAN</option><option value="OPR-20210005">WIRANDA AGUSTYAN</option><option value="PAD-20210001">DANIEL ALATAS</option><option value="SPV-20210001">ABANGNYA BANG TAMPAN</option><option value="WDR-20210001">MUHIDIN JAFAR</option>            							</select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-kodeanak-yc-container"><span class="select2-selection__rendered" id="select2-kodeanak-yc-container" role="textbox" aria-readonly="true" title="ALL">ALL</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cari data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="{{ $tableClass}}" class="table table-bordered table-striped table-hover js-basic-example dataTable w-100">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Resi</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>Tujuan</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($statusRes =='success')
                                @foreach ($orderData as $xdata)
                                    <tr>
                                        <td>{{ $xdata->tglOrder }}</td>
                                        <td>{{ $xdata->noresi }}</td>
                                        <td>{{ $xdata->pengirim }} <br> {{ $xdata->telepon }}</td>
                                        <td>{{ $xdata->penerima }} <br> {{ $xdata->teleponp }} <br> {{ $xdata->alamat }}</td>
                                        <td>{{ $xdata->tujuan }}</td>
                                        <td>Berat : {{ $xdata->berat }} <br> Qty : {{ $xdata->qty }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
