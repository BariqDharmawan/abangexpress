<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Template 2'])
    @include('partials.styles', ['path' => 'template2'])
</head>
<body>
    @include('partials.btn-back-to-top')
    @include('partials.scripts', ['path' => 'template2'])
</body>
</html>