<div x-data="{ in_app: {{ $in_app ? 'true' : 'false' }} }">
    <div x-show.transition.in="in_app" class="app-action mt-4 px-8" style="display: none;">
        @if(count($emails) > 0 && $in_app)
        <div class="lg:max-w-72 lg:mx-auto">
            <a href="{{ route('mailbox') }}" class="block appearance-none w-full rounded-md my-5 py-3 px-5 bg-white bg-opacity-25 text-white text-sm cursor-pointer focus:outline-none"><i class="fas fa-angle-double-left"></i><span class="ml-2">{{ __('Get back to MailBox') }}</span></a>
        </div>
        @endif
        <form wire:submit.prevent="create" class="lg:max-w-72 lg:mx-auto" method="post">
            <input class="block appearance-none w-full border-0 rounded-md py-4 px-5 bg-white text-white bg-opacity-10 focus:outline-none placeholder-white placeholder-opacity-50" type="text" name="user" id="user" wire:model.defer="user" placeholder="{{ __('Enter Username') }}">
            <div class="divider mt-5"></div>
            <div class="relative">
                <x-jet-dropdown width="w-full">
                    <x-slot name="trigger">
                        <input x-ref="domain" type="text" class="block appearance-none w-full border-0 bg-white text-white py-4 px-5 pr-8 bg-opacity-10 rounded-md cursor-pointer focus:outline-none select-none placeholder-white placeholder-opacity-50" placeholder="{{ __('Select Domain') }}" name="domain" id="domain" wire:model="domain" readonly>
                    </x-slot>
                    <x-slot name="content">
                        @foreach($domains as $domain)
                        <a x-on:click="$refs.domain.value = '{{ $domain }}'; $wire.setDomain('{{ $domain }}')" class='block px-4 py-2 text-sm leading-5 text-gray-700 cursor-pointer hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'>{{ $domain }}</a>
                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-white">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <div class="divider mt-5"></div>
            <input id="create" class="block appearance-none w-full rounded-md py-4 px-5 bg-teal-500 text-white cursor-pointer focus:outline-none" style="background-color: {{ config('app.settings.colors.secondary') }}" type="submit" value="{{ __('Create') }}">
            <div class="divider my-8 flex justify-center">
                <div class="border-t-2 w-2/3 border-white border-opacity-25"></div>
            </div>
        </form>
        <form wire:submit.prevent="random" class="lg:max-w-72 lg:mx-auto" method="post">
            <input id="random" class="block appearance-none w-full rounded-md py-4 px-5 bg-yellow-500 text-white cursor-pointer focus:outline-none" style="background-color: {{ config('app.settings.colors.tertiary') }}" type="submit" value="{{ __('Random') }}">
        </form>
        @if(!$in_app)
        <div class="lg:max-w-72 lg:mx-auto">
            <button x-on:click="in_app = false" class="block appearance-none w-full rounded-md my-5 py-2 px-5 bg-white bg-opacity-10 text-white text-sm cursor-pointer focus:outline-none">{{ __('Cancel') }}</button>
        </div>
        @endif
    </div>
    <div x-show.transition.in="!in_app" class="in-app-actions mt-4 px-8" style="display: none;">
        <form class="lg:max-w-72 lg:mx-auto" action="#" method="post">
            <div class="relative">
                <x-jet-dropdown align="top" width="w-full">
                    <x-slot name="trigger">
                        <div class="block appearance-none w-full bg-white text-white py-4 px-5 pr-8 bg-opacity-10 rounded-md cursor-pointer focus:outline-none select-none" id="email_id">{{ $email }}</div>
                    </x-slot>
                    <x-slot name="content">
                        @foreach($emails as $email)
                        <x-jet-dropdown-link href="{{ route('switch', $email) }}">
                            {{ $email }}
                        </x-jet-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </form>
        <div class="divider mt-5"></div>
        <div class="grid grid-cols-4 lg:grid-cols-2 gap-2 lg:gap-6 lg:max-w-72 lg:mx-auto">
            <div class="btn_copy bg-white bg-opacity-10 text-white rounded-md py-5 lg:py-10 text-center hover:bg-opacity-25 cursor-pointer">
                <div class="text-xl lg:text-3xl mx-auto">
                    <i class="far fa-copy"></i>
                </div>
                <div class="text-xs lg:text-base pt-5">{{ __('Copy') }}</div>
            </div>
            <div onclick="document.getElementById('refresh').classList.remove('pause-spinner')" wire:click="$emit('fetchMessages')" class="bg-white bg-opacity-10 text-white rounded-md py-5 lg:py-10 text-center hover:bg-opacity-25 cursor-pointer">
                <div class="text-xl lg:text-3xl  mx-auto">
                    <i id="refresh" class="fas fa-sync-alt fa-spin"></i>
                </div>
                <div class="text-xs lg:text-base pt-5">{{ __('Refresh') }}</div>
            </div>
            <div x-on:click="in_app = true" class="bg-white bg-opacity-10 text-white rounded-md py-5 lg:py-10 text-center hover:bg-opacity-25 cursor-pointer">
                <div class="text-xl lg:text-3xl  mx-auto">
                    <i class="far fa-plus-square"></i>
                </div>
                <div class="text-xs lg:text-base pt-5">{{ __('New') }}</div>
            </div>
            <div wire:click="deleteEmail" class="bg-white bg-opacity-10 text-white rounded-md py-5 lg:py-10 text-center hover:bg-opacity-25 cursor-pointer">
                <div class="text-xl lg:text-3xl  mx-auto">
                    <i class="far fa-trash-alt"></i>
                </div>
                <div class="text-xs lg:text-base pt-5">{{ __('Delete') }}</div>
            </div>
        </div>
    </div>
    @if(config('app.settings.recaptcha.enabled', false))
    <div wire:loading>
        <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-75 text-white flex justify-center items-center z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.settings.recaptcha.site_key') }}"></script>
    <script>
        const handle = (e) => {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('app.settings.recaptcha.site_key') }}', { action: 'submit' }).then(function(token) {
                    Livewire.emit('checkCaptcha', token, e.target.id);
                });
            });
        }
        document.getElementById('create').addEventListener('click', handle);
        document.getElementById('random').addEventListener('click', handle);
    </script>
    @endif
</div>