<nav class="side-nav">
    <a href="#" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone - HTML Admin Template" src="{{ asset('clients/images/logos/5.png')}}">
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="javascript:;.html" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                    <div class="side-menu__sub-icon transform rotate-180"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                <div class="side-menu__title">
                    Categories
                    <div class="side-menu__sub-icon  "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('list-category') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">  List Categories </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('create-category') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Add Categories </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="briefcase" class="block mx-auto"></i> </div>
                <div class="side-menu__title">
                    Brands
                    <div class="side-menu__sub-icon  "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('list-brand') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title">  List Brands </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('create-brand') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Add Brands </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="package" class="block mx-auto"></i> </div>
                <div class="side-menu__title">
                    Products
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('list-product') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> List Products </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('create-product') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Add Products </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('list-user') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="side-menu__title">
                    Users
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('list-comment') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="message-square"></i> </div>
                <div class="side-menu__title"> Comment </div>
            </a>
        </li>
        <li>
            {{-- <a href="{{ url('list-order') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                <div class="side-menu__title">
                    Orders
                </div>
            </a> --}}
            <a href="{{ url('list-order') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                <div class="side-menu__title">
                    Orders
                </div>
            </a>
        </li>
    </ul>
</nav>
