@extends('layouts.admin')
@section('title', 'Dashboard')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" 
    href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css"> --}}
@endpush
@section('content')
<div class="container-fluid">

    <table id="dataTable" class="table table-sm table-bordered">
        <thead>
            <th>No</th>
            <th>Product Name</th>
            <th>Stock</th>
            <th>Price</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Peanut Butter</td>
                <td>10</td>
                <td>10</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Peanut Butter Chocolate</td>
                <td>5</td>
                <td>50</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Peanut Butter Chocolate Cake</td>
                <td>3</td>
                <td>100</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Peanut Butter Chocolate Cake with Kool-aid</td>
                <td>2</td>
                <td>150</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
{{-- <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script> --}}
{{-- <script>
    $("#dataTable").DataTable();
</script> --}}
@endpush