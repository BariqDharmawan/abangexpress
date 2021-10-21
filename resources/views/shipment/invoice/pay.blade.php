@extends('layouts.shipment')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <x-shipment.card heading="Verifikasi Pembayaran">
            <form action="{{ route('shipping.invoice.pay.store', $invoiceNumber) }}" method="POST">
                @csrf
                <x-shipment.input type="select" name="account_name" 
                label="Nama Rekening Anda" required>
                    <option value="bca">BCA</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="bni">BNI</option>
                </x-shipment.input>
                <x-shipment.input class="input-decimal-dot-without-padding"
                label="Jumlah Pembayaran" text-addon="Rp. "
                name="total_payed" required />

                <x-shipment.input type="file" input-hidden="proof_of_paying_hidden" 
                placeholder="Bukti Transfer"
                name="proof_of_paying" accept="image/*" required />

                <input type="hidden" id="proof_of_paying_hidden" 
                name="proof_of_paying_hidden" required readonly>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-shipment.card>
    </div>
</div>
@endsection