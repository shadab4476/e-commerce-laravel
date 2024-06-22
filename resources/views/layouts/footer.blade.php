<footer class="py-6 bg-black border-t-[1px] border-white footer">

    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            <div class="w-[25%] ">
                <p>Copyright © 2024.</p>
            </div>
            <div class="footer_menu w-[75%]">
                <ul class="flex justify-end gap-x-5 items-center">
                    <li><a class="hover:border-b-yellow-500 {{ url()->current() == asset('/index') || url()->current() == url('') || url()->current() == asset('/home') ? 'text-yellow-500 border-b-yellow-500' : '' }}  hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ !session()->has('verify_otp_true') ? route('index') : route('home') }}">Home</a>
                    </li>
                    <li><a class="{{ url()->current() == asset('/about') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:border-b-yellow-500   hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{route('about.page')}}">About</a>
                    </li>
                    <li><a class="{{ url()->current() == asset('/contect') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:border-b-yellow-500  hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ route('contect.page') }}">Contect</a>
                    </li>
                    <li><a class="hover:border-b-yellow-500 {{ url()->current() == asset('/shop') ? 'text-yellow-500 border-b-yellow-500' : '' }} hover:text-gray-300 border-b-2  block transition-all py-2  border-transparent uppercase text-lg font-medium text-white"
                            href="{{ route('shop.index') }}">Shop</a>
                </ul>
            </div>
        </div>
    </div>

</footer>
