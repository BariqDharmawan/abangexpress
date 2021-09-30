{{-- <script src="{{ asset('admin/js/admin.js') }}"></script> --}}

<script src="{{ asset('admin/template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/template/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset(
    'admin/template/vendor/bootstrap/js/bootstrap.bundle.min.js'
) }}"></script>
<script src="{{ asset('admin/template/vendor/chart.js/Chart.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
        $('.collapse').on('show.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').addClass('rotate-180deg')
        })
        $('.collapse').on('hide.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').removeClass('rotate-180deg')
        })
    });
</script>
@stack('scripts')