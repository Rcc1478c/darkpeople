<nav>
    <div class="bg-gray-100 px-5 hidden lg:flex sticky top-0 z-40 h-24">
        <div class="w-full my-auto">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-baseline space-x-4">
                        @foreach($menus as $menu)
                            @if($menu->hasChild()) 
                            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex flex-row items-center w-full px-3 py-2 text-sm text-gray-700 font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none">
                                    <span>{{ __($menu->name) }}</span>
                                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                    <div class="px-2 py-2 bg-white rounded-lg shadow dark-mode:bg-gray-800">
                                        @foreach($menu->getChild() as $child)
                                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg text-gray-700 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none" href="{{ $child->link }}" target="{{ $child->target }}">{{ __($child->name) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @else
                                @if($menu->parent_id === null)
                                <a href="{{ $menu->link }}" class="px-3 py-2 text-sm font-semibold text-left bg-transparent text-gray-700 {{ url()->current() === $menu->link ? 'bg-gray-200' : '' }} rounded-lg md:w-auto md:inline hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none" target="{{ $menu->target }}">{{ __($menu->name) }}</a>
                                @endif
                            @endif
                        @endforeach
                        @if(Auth::check() && Auth::user()->role == 7)
                            <a href="{{ route('admin') }}" class="px-3 py-2 text-sm font-semibold text-left bg-transparent border-dashed border-2 border-red-700 text-red-700 rounded-lg md:w-auto md:inline hover:bg-red-100">{{ __('Admin') }}</a>
                        @endif
                    </div>
                </div>
                <div class="flex items-center">
                    <div>
                        @foreach(config('app.settings.socials') as $social)
                        <a href="{{ $social['link'] }}" target="_blank" class="ml-2 text-lg" rel="noopener noreferrer"><i class="{{ $social['icon'] }}"></i></a>
                        @endforeach
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative">
                            <form action="{{ route('locale', '') }}" id="locale-form" method="post">
                                @csrf
                                <select class="block appearance-none bg-gray-200 cursor-pointer text-gray-800 py-1 rounded-md focus:outline-none" name="locale" id="locale">
                                    @foreach(config('app.locales') as $locale)
                                    <option {{ (app()->getLocale() == $locale ) ? "selected" : "" }}>{{ $locale }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div @click="open = true" class="absolute top-12 right-6 w-8 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </div>
        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false" class="flex-col lg:hidden fixed top-0 left-0 min-h-screen w-full bg-black bg-opacity-75">
            <div @click="open = false" class="absolute top-6 right-6 w-8 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="w-full mx-auto mt-20">
                <div class="flex flex-col items-center justify-between">
                    <div class="flex flex-col items-center space-y-2">
                        @foreach($menus as $menu)
                            @if($menu->hasChild()) 
                            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex flex-row items-center w-full px-3 py-2 text-sm text-white font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline focus:text-gray-900 focus:bg-gray-200 focus:outline-none">
                                    <span>{{ __($menu->name) }}</span>
                                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                    <div class="px-2 py-2 text-center bg-white rounded-lg shadow dark-mode:bg-gray-800">
                                        @foreach($menu->getChild() as $child)
                                        <a class="block text-sm font-semibold bg-transparent rounded-lg text-gray-600 md:mt-0 focus:text-gray-900 focus:bg-gray-100 focus:outline-none" href="{{ $child->link }}" target="{{ $child->target }}">{{ __($child->name) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @else
                                @if($menu->parent_id === null)
                                <a href="{{ $menu->link }}" class="px-3 py-2 text-sm font-semibold text-left bg-transparent text-white {{ url()->current() === $menu->link ? 'bg-gray-200' : '' }} rounded-lg md:w-auto md:inline focus:text-gray-900 focus:bg-gray-200 focus:outline-none" target="{{ $menu->target }}">{{ __($menu->name) }}</a>
                                @endif
                            @endif
                        @endforeach
                        @if(Auth::check() && Auth::user()->role == 7)
                            <a href="{{ route('admin') }}" class="px-3 py-2 text-sm font-semibold text-left bg-transparent border-dashed border-2 border-red-400 text-red-400 rounded-lg md:w-auto md:inline hover:bg-red-100">{{ __('Admin') }}</a>
                        @endif
                    </div>
                    <div class="flex flex-col items-center space-y-2 mt-10">
                        <div class="text-white space-x-2">
                            @foreach(config('app.settings.socials') as $social)
                            <a href="{{ $social['link'] }}" target="_blank" class="text-lg" rel="noopener noreferrer"><i class="{{ $social['icon'] }}"></i></a>
                            @endforeach
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="relative">
                                <form action="{{ route('locale', '') }}" id="locale-form-mobile" method="post">
                                    @csrf
                                    <select class="block appearance-none bg-gray-200 cursor-pointer text-gray-800 py-1 rounded-md focus:outline-none" name="locale" id="locale-mobile">
                                        @foreach(config('app.locales') as $locale)
                                        <option {{ (app()->getLocale() == $locale ) ? "selected" : "" }}>{{ $locale }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>