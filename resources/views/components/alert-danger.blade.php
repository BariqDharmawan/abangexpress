@props(['isDismissable' => false])

<div {{ $attributes->class(['alert', 'alert-danger', 'alert-dismissible' => $isDismissable, 'fade' => $isDismissable, 'show' => $isDismissable])->merge([
    'role' => 'alert'
]) }} style="z-index: 2">
    {{ session('error') }}
    <button type="button" class="btn-close" 
    data-bs-dismiss="alert" aria-label="Close"></button>
</div>