@extends('layouts/shipment')

{{-- @section('title', $title) --}}

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
    id="parent-dataOrder">
        <div class="card">
            <div class="header">
                <h2>
                    {{$title}}
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="dataOrder" class="table table-bordered table-striped table-hover js-basic-example dataTable w-100">
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
                                        <td>{{ $xdata['tglOrder'] }}</td>
                                        <td>{{ $xdata['noresi'] }}</td>
                                        <td>{{ $xdata['pengirim'] }} <br> {{ $xdata['telepon'] }}</td>
                                        <td>{{ $xdata['penerima'] }} <br> {{ $xdata['teleponp'] }} <br> {{ $xdata['alamat'] }}</td>
                                        <td>{{ $xdata['tujuan'] }}</td>
                                        <td>Berat : {{ $xdata['berat'] }} <br> Qty : {{ $xdata['qty'] }}</td>
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
