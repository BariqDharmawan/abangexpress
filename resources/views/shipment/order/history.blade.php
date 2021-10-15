@extends('layouts/shipment')

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

                            <form role="form" method="POST" action="{{ route('shipping.order.filter.history') }}"
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

                                        <div class="form-group">
                                            <x-shipment.input type="select"
                                            placeholder="Sub Cabang"
                                            name="kodeanak" required>
                                                <option value="x">X</option>
                                            </x-shipment.input>
                                        </div>
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
                                {{-- <th>Action</th> --}}
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
                                        {{-- <td></td> --}}
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
