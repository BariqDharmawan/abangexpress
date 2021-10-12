@extends('layouts.shipment')

@section('title', $title)

@section('content')

<div class="row clearfix">
    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" 
    id="form-invoice-order" method="POST">
        @csrf
        <div class="card">
            <div class="header">
                <h2 class="h1 fw-bold">Commercial Invoice</h2>
            </div>
            <div class="body d-flex flex-wrap flex-column items-end">
                <div class="w-100">
                    <x-shipment.input type="textarea" 
                    placeholder="Deskripsi barang" name="desc" required />
                </div>
                <div class="w-100">
                    <x-shipment.input class="not-allow-number"
                    placeholder="Quantity" name="quantity" required />
                </div>
                <div class="w-100">
                    <x-shipment.input type="select"
                    placeholder="Satuan unit" name="unit" required>
                        @for ($i = 1; $i <= 3; $i++)
                            <option value="unit-{{ $i }}">Unit {{ $i }}</option>
                        @endfor
                    </x-shipment.input>
                </div>
                <div class="w-100">
                    <x-shipment.input class="only-number"
                    placeholder="Value per unit" name="value_unit" required />
                </div>
                <button type="submit" class="btn btn-big btn-primary">Simpan</button>
            </div>
        </div>

        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Unit value</th>
                                <th>Total value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- todo: integration this from ajax data --}}
                            @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Cosmetic</td>
                                <td>Set</td>
                                <td>5</td>
                                <td>10000</td>
                                <td>50000</td>
                                <td>
                                    <x-shipment.modal-trigger class="btn-danger"
                                    target="delete-data{{ $i }}" icon="delete" />
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('components')
    {{-- todo: integration this from ajax data --}}
    @for ($i = 1; $i <= 5; $i++)
        <x-shipment.modal id="delete-data{{ $i }}" title="Hapus data {{ $i }}">
            <p>Apakah kamu yakin, ingin menghapus data {{ $i }}</p>
            <x-slot name="action">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tidak jadi</button>
                    <form action="" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger waves-effect">
                            Ya, hapus
                        </button>
                    </form>
                </div>
            </x-slot>
        </x-shipment.modal>
    @endfor
@endsection