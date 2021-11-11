@extends('layouts.shipment')

@section('title', 'Data order')

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="parent-dataOrder">
        <div class="card">
            <div class="header">
                <h2>Data order</h2>
            </div>
            <div class="header">
                <div class="datas-action" data-datable-id="#dataOrder">
                    <button type="button" class="btn m-b-10 bg-grey waves-effect" data-toggle="collapse"
                    data-target="#filter-order" aria-expanded="true" aria-controls="filter-order">
                        <i class="material-icons">filter_list</i>
                        <span>Filter</span>
                    </button>

                    <button type="button" class="btn m-b-10 bg-green waves-effect btn-export-custom" data-export-type="excel">
                        <i class="material-icons">
                            file_download
                        </i>
                        <span>Export ke excel</span>
                    </button>
                </div>

                <div class="collapse" id="filter-order" aria-expanded="true">
                    <div class="well">
                            <form action="{{ route('shipping.order.filter.order') }}"
                            method="POST" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-shipment.input label="Tanggal Awal" class="bootstrap-datepicker"
                                        name="start_date" id="start-date" :is-material-ui="false" />

                                        <x-shipment.input label="Pengirim"
                                        name="pengirim" :is-material-ui="false" />
                                    </div>
                                    <div class="col-lg-6">
                                        <x-shipment.input label="Tanggal Akhir" class="bootstrap-datepicker"
                                        name="end_date" id="end-date" :is-material-ui="false" />

                                        @if (count($underling) > 0)
                                        <x-shipment.input type="select" placeholder="Sub Cabang" name="kodeanak" required>
                                            @foreach ($underling as $underling)
                                                <option value="{{$underling->kodeAgen}}">
                                                    {{$underling->nama}}
                                                </option>
                                            @endforeach
                                        </x-shipment.input>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-end">
                                    <button type="submit" class="btn btn-lg btn-primary">Cari data</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="dataOrder"
                        class="table table-bordered table-striped table-hover w-100 datatable-export-excel-without-action">
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
                                @foreach ($orderData as $order)
                                    <tr>
                                        <td>
                                            {{ $order['tglOrder'] }}
                                        </td>
                                        <td>{{ $order['noresi'] }}</td>
                                        <td>{{ $order['pengirim'] }} <br> {{ $order['telepon'] }}</td>
                                        <td>
                                            {{ $order['penerima'] }} <br>
                                            {{ $order['teleponp'] }} <br>
                                            {{ $order['alamat'] }}
                                        </td>
                                        <td>{{ $order['tujuan'] }}</td>
                                        <td>Berat : {{ $order['berat'] }} <br> Qty : {{ $order['qty'] }}</td>
                                        <td>
                                            <x-shipment.modal-trigger text="Cancel"
                                            class="btn-danger btn-small" icon="clear"
                                            target="modal-cancel-order-{{ $loop->iteration }}" />
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

@section('components')
    @if ($statusRes =='success')
        @foreach ($orderData as $order)
            <x-shipment.modal id="modal-cancel-order-{{ $loop->iteration }}" title="Cancel Orderan {{ $order['noresi'] }}">
                <p class="mt-5 mb-5">
                    Apakah kamu yakin ingin cancel orderan dengan resi <b>{{ $order['noresi'] }}</b>? <br>
                    <strong>Jika sudah tercancel, tidak bisa di-uncancel</strong>
                </p>
                <form method="POST" action="{{ route('shipping.order.cancel') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $order['token'] }}">
                    <button type="submit" class="btn btn-danger w-100">
                        Yakin
                    </button>
                </form>
            </x-shipment.modal>
        @endforeach
    @endif
@endsection
