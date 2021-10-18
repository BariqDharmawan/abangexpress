@extends('layouts/shipment')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ $title }}</h2>
            </div>
            <div class="header"></div>
            <div class="body">
                <div class="table-responsive">
                    <table id="{{ $tableClass}}" class="table table-bordered table-striped table-hover js-basic-example dataTable w-100">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Invoice</th>
                                <th>Nama</th>
                                <th>Total</th>
                                <th>Sisa Tagihan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($statusRes =='success')
                                @foreach ($orderData as $xdata)
                                    <tr>
                                        <td>{{ $xdata->tanggal }}</td>
                                        <td>{{ $xdata->nomor }}</td>
                                        <td>{{ $xdata->nama }}</td>
                                        <td>{{ $xdata->total }}</td>
                                        <td>{{ $xdata->sisa }}</td>
                                        <td>Berat : {{ $xdata->status }}</td>
                                        <td>
                                            <form method="POST"  action="{{ route('shipping.order.print') }}" target="_blank">
                                                @csrf
                                                <input type="hidden" name="link" value="view-tagihan/{{ $xdata->nomor}}">
                                                <button type="submit" class="btn btn-big btn-primary"><i class="material-icons">print</i>Cetak Ulang</button>
                                            </form>
                                            {{-- <a type="submit" href="https://duniaexportimport.com/view-tagihan/{{ $xdata->nomor}}" target="_blank" class="btn btn-big btn-primary"><i class="material-icons">print</i>Detail Tagihan</a> --}}
                                        </td>
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
