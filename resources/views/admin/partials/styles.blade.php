{{-- <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
<script src="{{ asset('admin/js/vendor.js') }}"></script> --}}

<link href="{{ asset('admin/template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('admin/template/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    @media screen and (max-width: 993px) {
        .md-h-auto {
            height: auto;
        }
    }
    .hover-no-underline:hover {
        text-decoration: none
    }
    .transition-default {
        transition: all 250ms;
    }
    .rotate-180deg {
        transform: rotate(180deg);
    }
    .h-full {
        height: 100%;
    }
    .center-parent {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .embeded-full iframe {
        width: 100%;
    }
    .option-slide {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">