<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" 
    href="{{ route('admin.about-us.identity') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            {{ config('app.name') }}
        </div>
    </a>

    <hr class="sidebar-divider">

    <x-admin.sidebar-menu text="About Us" icon="fa-fw fa-cog" 
    data-toggle="collapse" data-target="#collapseAbout"
    aria-expanded="true" aria-controls="collapseAbout" class="collapsed">

        <x-admin.sidebar-dropdown id="collapseAbout" parent="accordionSidebar">
            <x-admin.sidebar-dropdown-link text="Identity" 
            :href="route('admin.about-us.identity')" />

            <x-admin.sidebar-dropdown-link text="Social Media" 
            :href="route('admin.our-social.manage')" />

            <x-admin.sidebar-dropdown-link text="Contacts" 
            :href="route('admin.contact.manage')" />

        </x-admin.sidebar-dropdown>

    </x-admin.sidebar-menu>

    <x-admin.sidebar-menu text="Contents" class="collapsed" data-toggle="collapse" 
    icon="fa-fw fa-cog" data-target="#collapseContent" 
    aria-expanded="true" aria-controls="collapseContent">

        <x-admin.sidebar-dropdown id="collapseContent" parent="accordionSidebar">
            
            <x-admin.sidebar-dropdown-link text="Header Carousel" 
            href="route('admin.content.carousel')" />

            <x-admin.sidebar-dropdown-link text="Cover Vision Mission" 
            href="route('admin.content.cover-vission-mission')" />

            <x-admin.sidebar-dropdown-link text="Section Heading Text" 
            href="route('admin.content.section-heading')" />
    
        </x-admin.sidebar-dropdown>

    </x-admin.sidebar-menu>

    <x-admin.sidebar-menu :href="route('admin.service.manage')" 
    text="Services" icon="fa-fw fa-tachometer-alt" />

    <x-admin.sidebar-menu :href="route('admin.team.manage')" 
    text="Teams" icon="fa-fw fa-tachometer-alt" />

    <x-admin.sidebar-menu :href="route('admin.faq.manage')" 
    text="FAQ" icon="fa-fw fa-tachometer-alt" />

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle">
        </button>
    </div>

</ul>
<!-- End of Sidebar -->
