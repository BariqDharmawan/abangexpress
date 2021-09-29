@stack('plugins')

{{-- <script src="{{ asset('admin/js/admin.js') }}"></script> --}}
<script src="{{ asset('admin/template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset(
    'admin/template/vendor/bootstrap/js/bootstrap.bundle.min.js'
) }}"></script>
<script src="{{ asset('admin/template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/template/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('admin/template/vendor/chart.js/Chart.min.js') }}"></script>
@stack('scripts')