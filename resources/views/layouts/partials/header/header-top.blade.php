<div class="bg-[#bb1724]">
    <div class="container px-2">
        <div class="flex w-full items-center justify-center py-2.5 sm:justify-end">
            {{-- <div class="hidden sm:block">
          <a href="#" class="text-white">Admin</a>
        </div> --}}

            @auth
                @if (auth()->user()->level == 'Admin')
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="dark:hover inline-flex items-center rounded-lg px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800"
                        type="button">{{ auth()->user()->namaUser }} <svg class="ml-2 h-4 w-4" aria-hidden="true"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg></button>

                    <!-- Dropdown menu -->
                    <div id="dropdownInformation"
                        class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 552px);">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="/dashboard"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Halaman
                                    Admin</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="/logout"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Keluar</a>
                        </div>
                    </div>
                @elseif (auth()->user()->level == 'Kasir')
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="dark:hover inline-flex items-center rounded-lg px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800"
                        type="button">{{ auth()->user()->namaUser }} <svg class="ml-2 h-4 w-4" aria-hidden="true"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg></button>

                    <!-- Dropdown menu -->
                    <div id="dropdownInformation"
                        class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 552px);">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="{{ route('kasir.index') }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Halaman
                                    Kasir</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="/logout"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Keluar</a>
                        </div>
                    </div>
                @elseif (auth()->user()->level == 'Customer')
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="dark:hover inline-flex items-center rounded-lg px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800"
                        type="button">{{ auth()->user()->namaUser }} <svg class="ml-2 h-4 w-4" aria-hidden="true"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg></button>

                    <!-- Dropdown menu -->
                    <div id="dropdownInformation"
                        class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 552px);">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profil</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="/logout"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Keluar</a>
                        </div>
                    </div>
                @endif
            @else
                <div class="text-white">
                    <a href="/login" class="text-white">Login</a> | <a href="/register" class="text-white">Register</a>
                </div>
            @endauth
        </div>
    </div>
</div>
