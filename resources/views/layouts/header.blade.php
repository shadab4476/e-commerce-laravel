<header class="header_section md:px-10 sm:px-5 px-2 py-5">
    <nav>
        <div class="navbar flex items-center justify-between">
            <div class="logo w-[10%]">
                <a class="block" href="{{ !session()->has('verify_otp_true') ? route('index') : route('home') }}">
                    <img class="block w-full" src="{{ asset('images/logo.png') }}" alt="site_logo"></a>
            </div>
            <div class="menu_parent  w-[60%]">
                <ul class="flex justify-center gap-x-5 items-center">
                    <li><a class="hover:border-b-yellow-500 {{ url()->current() == asset('/index') || url()->current() == url('') || url()->current() == asset('/home') ? 'text-yellow-500 border-b-yellow-500' : '' }}  hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ !session()->has('verify_otp_true') ? route('index') : route('home') }}">Home</a>
                    </li>
                    <li><a class="{{ url()->current() == asset('/about') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:border-b-yellow-500   hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ route('about.page') }}">About</a>
                    </li>
                    <li><a class="{{ url()->current() == asset('/contect') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:border-b-yellow-500  hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ route('contect.page') }}">Contect</a>
                    </li>
                    <li><a class="hover:border-b-yellow-500 {{ url()->current() == asset('/shop') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    @auth
                        @role('admin')
                            <li class="z-50 relative mainAdminMainSubmenu hover_menu_parent ">
                                <button type="button"
                                    class=" border-b-2 {{ (url()->current() == asset('/admin/products') || url()->current() == asset('/admin/products/create') ? 'text-yellow-500 border-b-yellow-500' : '' || url()->current() == asset('/admin/categories') || url()->current() == asset('/admin/categories/create')) ? 'text-yellow-500 border-b-yellow-500' : '' }}   border-transparent inline-block uppercase py-2 text-lg font-medium text-white">
                                    Admin Side</button>

                                <ul class="absolute adminMainSubmenu  hover_submenu  w-[150px]">
                                    <li class="relative hover_submenu_parent w-full">
                                        <a class="block bg-black p-2  text-center uppercase transition text-white hover:text-yellow-500 hover:font-bold font-normal  "
                                            href="{{ route('users.index') }}">Users
                                        </a>
                                        <ul class="absolute  hover_submenu_child  ps-2  w-full top-0 left-full ">
                                            <li>
                                                <a class="block text-center  bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('users.create') }}">Create</a>
                                                <a class="block text-center bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('users.index') }}">Index</a>
                                            </li>
                                        </ul>

                                    </li>
                                    <li class="relative hover_submenu_parent w-full">
                                        <a class="block bg-black p-2  text-center uppercase transition text-white hover:text-yellow-500 hover:font-bold font-normal  "
                                            href="{{ route('products.index') }}">PRODUCT
                                        </a>
                                        <ul class="absolute  hover_submenu_child  ps-2  w-full top-0 left-full ">
                                            <li>
                                                <a class="block text-center  bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('products.create') }}">Create</a>
                                                <a class="block text-center bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('products.index') }}">Index</a>
                                            </li>
                                        </ul>

                                    </li>
                                    <li class="relative hover_submenu_parent w-full">
                                        <a class="block bg-black p-2  text-center uppercase transition text-white hover:text-yellow-500 hover:font-bold font-normal  "
                                            href="{{ route('categories.index') }}">Category
                                        </a>
                                        <ul class="absolute  hover_submenu_child  ps-2  w-full top-0 left-full ">
                                            <li>
                                                <a class="block text-center  bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('categories.create') }}">Create</a>
                                                <a class="block text-center bg-black text-white transition p-2  hover:text-yellow-500 hover:font-bold font-normal capitalize"
                                                    href="{{ route('categories.index') }}">Index</a>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                            </li>
                        @endrole
                    @endauth

                </ul>
            </div>
            <div class="icon_parent w-[20%]">
                <ul class="flex justify-center gap-x-5 items-center">

                    <li>
                        <a class="text-lg font-medium text-white hover:text-gray-300 block p-2 relative"
                            href="{{ auth()->check() ? route('carts.index') : route('get.registerVerify') }}">
                            <button type="button" id="cart_qty"
                                class="w-6 h-6 flex justify-center {{ auth()->check() ? 'hidden' : '' }} items-center absolute top-[-10px] right-[-5px] rounded-full bg-red-500">0</button>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"
                                viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <circle cx="26" cy="54" r="6" fill="#ffffff" opacity="1"
                                        data-original="#5e5e5e" class=""></circle>
                                    <circle cx="46" cy="54" r="6" fill="#ffffff" opacity="1"
                                        data-original="#5e5e5e" class=""></circle>
                                    <path fill="#ffce4a"
                                        d="M58.663 15.453A3.986 3.986 0 0 0 55.579 14h-40.14l-1.157-5.784A4.009 4.009 0 0 0 10.36 5H7a2 2 0 0 0 0 4h3.36s6.093 30.41 6.14 30.519A6 6 0 0 0 22.279 44H49.7a6.009 6.009 0 0 0 5.892-4.866l3.919-20.378a3.986 3.986 0 0 0-.848-3.303zM43 31h-5v5a2 2 0 0 1-4 0v-5h-5a2 2 0 0 1 0-4h5v-5a2 2 0 0 1 4 0v5h5a2 2 0 0 1 0 4z"
                                        opacity="1" data-original="#ffce4a" class=""></path>
                                </g>
                            </svg></a>
                    </li>
                    @if (auth()->check())
                        <li>
                            <a class="text-lg font-medium text-white hover:text-gray-300 block p-2 relative"
                                href="{{ route('order.index', auth()->user()->name) }}">
                                <button type="button" id="order_qty"
                                    class="w-6 h-6 flex justify-center {{ auth()->check() ? 'hidden' : '' }}  items-center absolute top-[-10px] right-[-5px] rounded-full bg-red-500">0</button>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="">
                                    <g>
                                        <path fill="#ffa001" d="M419.68 163.97V387H47.97V163.97L233.83 52.46z"
                                            opacity="1" data-original="#ffa001" class=""></path>
                                        <path fill="#f87f02" d="M419.68 163.97V387H233.83V52.46z" opacity="1"
                                            data-original="#f87f02" class=""></path>
                                        <path fill="#ffda2d" d="M0 163.971 47.968 52.456h185.858l-47.968 111.515z"
                                            opacity="1" data-original="#ffda2d" class=""></path>
                                        <path fill="#fcbe00"
                                            d="M467.651 163.971 419.683 52.456H233.826l47.968 111.515z" opacity="1"
                                            data-original="#fcbe00" class=""></path>
                                        <path fill="#ffda2d" d="M107.714 293.542h30v30h-30z" opacity="1"
                                            data-original="#ffda2d" class=""></path>
                                        <path fill="#83e470"
                                            d="M512 349.834c0 60.59-49.12 109.71-109.71 109.71-60.6 0-109.72-49.12-109.72-109.71 0-60.6 49.12-109.72 109.72-109.72 60.59 0 109.71 49.119 109.71 109.72z"
                                            opacity="1" data-original="#83e470" class=""></path>
                                        <path fill="#01b763"
                                            d="M512 349.834c0 60.59-49.12 109.71-109.71 109.71v-219.43c60.59 0 109.71 49.119 109.71 109.72z"
                                            opacity="1" data-original="#01b763"></path>
                                        <path fill="#f3fdff"
                                            d="m459.7 332.064-57.41 57.409-9.95 9.951-47.47-47.471 21.22-21.21 26.25 26.25 9.95-9.949 36.19-36.19z"
                                            opacity="1" data-original="#f3fdff"></path>
                                        <path fill="#d7f3f7" d="m459.7 332.064-57.41 57.409v-42.429l36.19-36.19z"
                                            opacity="1" data-original="#d7f3f7"></path>
                                    </g>
                                </svg></a>
                        </li>
                    @endif

                </ul>
            </div>
            @if (auth()->check())
                <div class="icon_parent w-[10%]">
                    <ul class="flex justify-center gap-x-5 items-center">
                        <li class="hover_menu_parent activeUserOnHover z-50">
                            <button
                                class=" border-b-2 inline-block uppercase py-2 border-transparent text-lg font-medium text-white">
                                <b class="capitalize hover:text-yellow-500 ">Active Users</b>
                                <div class="absolute px-2  bg-yellow-500 activeUserOnHoverChild  hover_submenu ">
                                    <ul class="flex flex-wrap gap-y-3">
                                        <li><a class="block text-lg items-center"
                                                href="{{ route('users.index') }}">......</a></li>
                                    </ul>
                                </div>

                            </button>
                        </li>
                        <li class="hover_menu_parent z-50">
                            <button
                                class="{{ url()->current() == route('get.accountDetail') ? 'text-yellow-500' : '' }}  border-b-2 inline-block uppercase py-2 border-transparent text-lg font-medium text-white">
                                <b
                                    class="{{ url()->current() == route('get.accountDetail') ? 'text-yellow-500' : '' }} capitalize">{{ auth()->user()->name }}'s</b>
                                Profile
                                <div class="absolute py-5 p-2 hover_submenu bg-black">
                                    <ul class="flex flex-wrap gap-y-3">
                                        <li class="w-full"><a
                                                class="block w-full capitalize  py-1 bg-yellow-700 px-2 hover:bg-yellow-600"
                                                href="{{ route('get.accountDetail') }}">View Profile</a>
                                        </li>
                                        <li class="w-full"> <a onclick="return confirm('Logout..')"
                                                class="block w-full capitalize py-1 bg-yellow-700 px-2 hover:bg-yellow-600"
                                                href="{{ route('logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                </div>

                            </button>
                        </li>

                    </ul>
                </div>
            @else
                <div class="icon_parent w-[10%]">
                    <ul class="flex justify-center gap-x-5 items-center">
                        <li><a class="text-lg font-medium text-white  hover:text-gray-300 block p-2"
                                href="{{ session()->has('email_otp') ? route('get.register') : route('get.registerVerify') }}">Register</a>
                        </li>
                        <li><a class="text-lg font-medium text-white hover:text-gray-300 block p-2"
                                href="{{ session()->has('email_otp') ? route('get.login') : route('get.registerVerify') }}">Login</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </nav>
</header>
