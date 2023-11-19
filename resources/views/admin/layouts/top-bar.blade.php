<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="#"> <i data-lucide="search"
                class="notification__icon dark:text-slate-500"></i> </a>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="intro-x">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button"
            aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell"
                class="notification__icon dark:text-slate-500"></i>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x">
        <x-app-layout>

        </x-app-layout>
    </div>
    <!-- END: Account Menu -->
</div>
