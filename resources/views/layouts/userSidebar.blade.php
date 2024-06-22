<div class="user_sidebar_parent w-full  ">
    <div class="user_detail mb-5   bg-black flex items-center  gap-x-5 p-3">
        <div class="user_img">
            @if (auth()->user()->image)
                <button class="w-[50px] h-[50px]  inline-block" type="button"><img
                        class="block w-full object-cover rounded-full object-center"
                        src="{{ asset('assets/images/') . '/' . auth()->user()->image }}" alt="user Image"></button>
            @else
                <button type="button" class="inline-block w-full"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0"
                        viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve"
                        class="block">
                        <g>
                            <circle cx="64" cy="64" r="64" fill="#ffb215" opacity="1"
                                data-original="#1597ff" class=""></circle>
                            <path fill="#eb4954"
                                d="M64 128c18.2 0 34.6-7.6 46.3-19.8-6.7-13.4-21.5-22.5-46.3-22.5s-39.6 9.1-46.3 22.5C29.4 120.4 45.8 128 64 128z"
                                opacity="1" data-original="#f85863" class=""></path>
                            <path fill="#ffffff" d="M52.6 71.6v17.1c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V71.6z"
                                opacity="1" data-original="#ffffff" class=""></path>
                            <path fill="#01277b" d="M52.6 73.6v6.6c3.1 2.9 6.8 5 11.1 6.2s8 1 11.1-.2V73.6z"
                                opacity="1" data-original="#01277b" class=""></path>
                            <g fill="#fff">
                                <circle cx="42.3" cy="61.3" r="6.3" fill="#ffffff" opacity="1"
                                    data-original="#ffffff" class=""></circle>
                                <circle cx="85.1" cy="61.3" r="6.3" fill="#ffffff" opacity="1"
                                    data-original="#ffffff" class=""></circle>
                            </g>
                            <ellipse cx="63.6" cy="42.9" fill="#01277b" rx="29" ry="29.7"
                                opacity="1" data-original="#01277b" class=""></ellipse>
                            <ellipse cx="63.7" cy="56" fill="#ffffff" rx="22" ry="27.5"
                                opacity="1" data-original="#ffffff" class=""></ellipse>
                            <g fill="#01277b">
                                <ellipse cx="59.9" cy="27.9" rx="17" ry="13.4"
                                    transform="rotate(-5.73 60.219 27.981)" fill="#01277b" opacity="1"
                                    data-original="#01277b" class=""></ellipse>
                                <ellipse cx="81.8" cy="29.1" rx="13.5" ry="10"
                                    transform="rotate(-6.78 82.097 29.056)" fill="#01277b" opacity="1"
                                    data-original="#01277b" class=""></ellipse>
                            </g>
                            <g fill="#01277b">
                                <circle cx="54.2" cy="52.2" r="2.1" fill="#01277b" opacity="1"
                                    data-original="#01277b" class="">
                                </circle>
                                <circle cx="73.2" cy="52.2" r="2.1" fill="#01277b" opacity="1"
                                    data-original="#01277b" class="">
                                </circle>
                                <path d="M73.2 62c0 5.3-4.3 9.5-9.5 9.5-5.3 0-9.5-4.3-9.5-9.5z" fill="#01277b"
                                    opacity="1" data-original="#01277b" class=""></path>
                            </g>
                        </g>
                    </svg></button>
            @endif
        </div>
        <div class="userName capitalize">
            hello,
            <h3 class="w-full font-bold text-yellow-600 inline-block">{{ auth()->user()->name }}
            </h3>
        </div>
    </div>

    {{-- tabs Start --}}

    <div class="my_order p-3 bg-black border-b-[1px] border-gray-400 ">
        <a href="{{route('order.index',auth()->user()->name)}}"
            class="flex items-center hover:text-yellow-500 gap-x-5  transition  font-medium block uppercase text-lg ">
            <span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="25" height="25" x="0" y="0" viewBox="0 0 24 24"
                    style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path
                            d="M9.021 22.25a1.25 1.25 0 0 1-.01-2.5h.01a1.25 1.25 0 0 1 0 2.5zm9.25-1.25a1.25 1.25 0 0 0-1.25-1.25h-.01a1.25 1.25 0 1 0 1.26 1.25zM20.96 8.36l-1.01 6.18A2.579 2.579 0 0 1 17 17H8.73a1.994 1.994 0 0 1-1.98-1.72L5.249 4.832A1.243 1.243 0 0 0 4.01 3.75h-.26a.75.75 0 0 1 0-1.5h.26a2.729 2.729 0 0 1 2.722 2.364L6.941 6H19a2 2 0 0 1 1.96 2.36zm-5.453 1.276a.75.75 0 0 0-1.061 0l-2.136 2.136-.8-.8a.75.75 0 0 0-1.061 1.06l1.333 1.334a.752.752 0 0 0 1.061 0l2.664-2.666a.75.75 0 0 0 0-1.064z"
                            fill="#ffc608" opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg></span>
            <span class="flex items-center justify-between w-full">
                MY
                ORDER
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="10" height="10" x="0" y="0" viewBox="0 0 492.004 492.004"
                    style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path
                            d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"
                            fill="#ffffff" opacity="1" data-original="#000000"></path>
                    </g>
                </svg>
            </span>
        </a>
    </div>

    <div class="account_setting_tabs bg-black pt-5 pb-3 mb-5 border-b-[1px] border-gray-400 ">
        <h3 class="w-full font-medium text-lg px-3 flex gap-x-5 text-center items-center mb-5"><svg
                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="25" height="25" x="0" y="0" viewBox="0 0 510 510"
                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path
                        d="M255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 76.5c43.35 0 76.5 33.15 76.5 76.5s-33.15 76.5-76.5 76.5-76.5-33.15-76.5-76.5 33.15-76.5 76.5-76.5zm0 362.1c-63.75 0-119.85-33.149-153-81.6 0-51 102-79.05 153-79.05S408 306 408 357c-33.15 48.45-89.25 81.6-153 81.6z"
                        fill="#ffc608" opacity="1" data-original="#000000" class=""></path>
                </g>
            </svg>ACCOUNT SETTINGS</h3>
        <ul class="flex flex-wrap gap-y-1">
            <li class=" w-full"><a href="{{ route('get.accountDetail') }}"
                    class="block text-center px-3 transition  hover:text-yellow-500  {{ url()->current() == route('get.accountDetail') ? ' text-yellow-500' : '' }} font-normal text-lg py-2">Profile
                    Information</a></li>
            <li class=" w-full"><a href="{{ route('get.addressDetail') }}"
                    class="block text-center  px-3   hover:text-yellow-500   {{ url()->current() == route('get.addressDetail') ? ' text-yellow-500' : '' }} text-white-500 transition font-normal text-lg py-2">Manage
                    Address</a></li>
        </ul>
    </div>
    {{-- tabs End --}}

    <div class="logout ">
        <a class="block flex items-center gap-x-5 text-center  transition  px-3 bg-black hover:text-yellow-500 text-white-500 transition font-medium text-lg py-2"
            onclick="return confirm('Logout..')" href="{{ route('logout') }}" class="block w-full ">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="25" height="25" x="0" y="0" viewBox="0 0 512 512"
                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <g fill-rule="evenodd" clip-rule="evenodd">
                        <path fill="#ffc608"
                            d="M256 0C114.8 0 0 114.8 0 256s114.8 256 256 256 256-114.8 256-256S397.2 0 256 0z"
                            opacity="1" data-original="#f34235" class=""></path>
                        <path fill="#000000"
                            d="M366 274.5c0 60.7-49.4 110-110 110-60.7 0-110-49.4-110-110 0-37.4 18.7-71.9 50.1-92.2 7.4-4.8 17.3-2.7 22.1 4.7s2.7 17.3-4.7 22.1C191.2 223.5 178 248 178 274.5c0 43 35 78 78 78s78-35 78-78c0-26.5-13.3-51-35.5-65.4-7.4-4.8-9.5-14.7-4.7-22.1s14.7-9.5 22.1-4.7c31.4 20.3 50.1 54.8 50.1 92.2zm-126-57.1v-73.9c0-8.8 7.2-16 16-16s16 7.2 16 16v73.9c0 8.8-7.2 16-16 16s-16-7.2-16-16z"
                            opacity="1" data-original="#ffffff" class=""></path>
                    </g>
                </g>
            </svg>
            Logout</a>
    </div>

</div>
