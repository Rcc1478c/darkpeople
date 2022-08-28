<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-20 py-10 bg-white">
                    <div class="text-2xl">
                        {{ __('Hi') }} {{ Auth::user()->name }}!
                    </div>
                    <div class="mt-2 text-gray-500">
                        {{ __('Welcome to TMail Dashboard') }}
                    </div>
                </div>
                <div class="bg-gray-50 text-gray-800 grid grid-cols-1 md:grid-cols-3 px-15 py-10">
                    <div class="px-5">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold"><a href="https://support.thehp.in/articles/100015613" target="_blank">{{ __('Articles') }}</a></div>
                        </div>
                        <div class="">
                            <div class="mt-2 text-sm">
                                {{ __('A bunch of helpful articles related to TMail can be found in the below portal. This will help you to get more details and help on various features of TMail.') }}
                            </div>
                            <a href="https://support.thehp.in/articles/100015613" target="_blank">
                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                    <div>{{ __('Explore the Articles') }}</div>
                                    <div class="ml-1 text-indigo-700">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-5">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold"><a href="https://support.thehp.in/submit/#100015613" target="_blank">{{ __('Support') }}</a></div>
                        </div>
                        <div class="">
                            <div class="mt-2 text-sm">
                                {{ __('In case if you\'re not able to find the right solution of your problem in the Articles section, we\'re always here to help you out at our Support Portal. ') }}
                            </div>
                            <a href="https://support.thehp.in/submit/#100015613" target="_blank">
                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                    <div>{{ __('Create a Support Ticket') }}</div>
                                    <div class="ml-1 text-indigo-500">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-5">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold"><a href="https://tmail.thehp.in" target="_blank">{{ __('Themes') }}</a></div>
                        </div>
                        <div class="">
                            <div class="mt-2 text-sm">
                                {{ __('TMail 6 now supports Themes that opens the door for unlimited possibilities like making your TMail just the way you want without impacting the codebase.') }}
                            </div>
                            <a href="https://tmail.thehp.in" target="_blank">
                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                    <div>{{ __('Get Exciting Themes') }}</div>
                                    <div class="ml-1 text-indigo-500">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white grid grid-cols-1 md:grid-cols-2">
                    <div class="px-20 py-10">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-24 h-24 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            <div class="ml-6">
                                <div class="text-lg text-gray-600 leading-7 font-semibold">{{ __('Email IDs Created') }}</div>
                                <div class="mt-2 text-2xl text-gray-500">{{ number_format(App\Models\Meta::getEmailIdsCreated()) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="px-20 py-10">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-24 h-24 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                            </svg>
                            <div class="ml-6">
                                <div class="text-lg text-gray-600 leading-7 font-semibold">{{ __('Messages Received') }}</div>
                                <div class="mt-2 text-2xl text-gray-500">{{ number_format(App\Models\Meta::getMessagesReceived()) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
