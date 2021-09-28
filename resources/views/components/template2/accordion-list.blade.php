<li {{ $attributes }}>
    @isset($iconTitle)
        <i class="bx bx-help-circle {{ $iconTitle }}"></i> 
    @endisset
    <a data-bs-toggle="collapse" 
    class="@if(isset($isOpen) and $isOpen == true) collapse @else collapsed @endif toggler-accordion" 
    data-bs-target="#accordion-list-{{ Str::of($heading)->lower()->slug('-') }}">
        <span class="accordion__heading">{{ $heading }}</span> 
        <i class="bx bx-chevron-down icon-show"></i>
        <i class="bx bx-chevron-up icon-close"></i>
    </a>
    <div id="accordion-list-{{ Str::of($heading)->lower()->slug('-') }}" class="collapse 
    @if(isset($isOpen) and $isOpen == true) show @endif li-without-padding py-4 accordion__text"
    data-bs-parent=".{{ $parentList }}">
        {{ $slot }}
    </div>
</li>