<nav class="flex items-center">
    @if(View::hasSection('backUrl'))
        <a class="text-white" href="@yield('backUrl')">
            @svg('icons/chevron-left')
        </a>
    @else
        <label class="text-white" for="menu-toggle">
            @svg('icons/menu')
        </label>
        <input id="menu-toggle" type="checkbox" class="hidden" />
        <div id="menu" class="hidden fixed inset-0 z-50">
            <div class="flex flex-col flex-grow bg-white shadow-md">
                <div class="border-b-2 border-gray-300 py-4 px-2">
                    <h2 class="font-bold">
                        {{ config('app.name', 'Laravel') }}
                    </h2>
                </div>

                @guest
                    {{-- Guest Navigation --}}
                    <nav>
                        <ul>
                            <li class="border-b border-gray-300">
                                <a class="flex py-4 px-2" href="{{ route('login') }}">
                                    <span class="flex-grow">
                                        Login
                                    </span>
                                    @svg('icons/chevron-right')
                                </a>
                            </li>
                            <li class="border-b border-gray-300">
                                <a class="flex py-4 px-2" href="{{ route('register') }}">
                                    <span class="flex-grow">
                                        Register
                                    </span>
                                    @svg('icons/chevron-right')
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endguest

                @auth
                    {{-- User Navigation --}}
                    <nav class="flex-grow">
                        <ul>
                            <li class="border-b border-gray-300">
                                <a class="flex py-4 px-2" href="{{ route('diary.index') }}">
                                    <span class="flex-grow">
                                        Diaries
                                    </span>
                                    @svg('icons/chevron-right')
                                </a>
                            </li>
                            <li class="border-b border-gray-300">
                                <a class="flex py-4 px-2" href="{{ route('tag.index') }}">
                                    <span class="flex-grow">
                                        Analytics
                                    </span>
                                    @svg('icons/chevron-right')
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="flex border-t border-gray-300">
                            <li class="flex-grow border-r border-gray-300 p-2">
                                <a href="#" class="btn block w-full text-left">
                                    @svg('icons/user', 'inline-block mr-4')
                                    Profile
                                </a>
                            </li>

                            <li class="flex-grow p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn block w-full text-left">
                                        @svg('icons/logout', 'inline-block mr-4')
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                @endauth
            </div>
            <label for="menu-toggle" class="w-12 p-2 text-white bg-black-t-30">
                @svg('icons/cross')
            </label>
        </div>
    @endif

    <h1 class="ml-4 text-white font-bold">
        @yield('title', config('app.name', 'Laravel'))
    </h1>
</nav>
