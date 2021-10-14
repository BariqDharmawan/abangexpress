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
                    <x-shipment.input typpe="number"
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
                <button type="submit" class="btn btn-big btn-primary enable-other-btn show-el-after-click" data-el-to-show="#parent-commercialInvoice" data-enable-other-btn="#btn-generate-pdf">
                    Simpan
                </button>
            </div>
        </div>
    </form>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-none" 
    id="parent-commercialInvoice">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table id="commercialInvoice" class="table table-bordered table-striped table-hover js-basic-example dataTable w-100">
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
                    </table>
                </div>
                <div class="mt-5">
                    <a href="" class="btn btn-big btn-primary disabled"
                    id="btn-generate-pdf">Generate PDF</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('components')
@endsection
