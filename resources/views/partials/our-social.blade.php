@foreach ($ourSocial as $social)
<a href="{{ $social->link }}" class="h2 @if(!$loop->last) me-2 @endif">
    <i class="{{ $social->icon }}"></i>
</a>
@endforeach