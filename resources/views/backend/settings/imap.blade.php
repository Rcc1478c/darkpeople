<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('IMAP Configuration') }}
    </x-slot>

    <x-slot name="description">
        {{ __('IMAP Settings for internal or external server from which TMail will fetch emails.') }}
    </x-slot>
    
    <x-slot name="form">
        @if($state['error'])
        <div class="col-span-6">
            <div class="w-full py-3 px-4 overflow-hidden rounded-md flex items-center border bg-red-50 border-red-500">
                <div class="text-red-500 w-10"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> 
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path> 
                    </svg> 
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-lg text-gray-600 font-semibold">{{ __('Error') }}</div>
                    <div class="text-sm">{{ $state['error'] }}</div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="hostname" value="{{ __('Hostname') }}" />
            <x-jet-input id="hostname" type="text" class="mt-1 block w-full" wire:model.defer="state.imap.host"/>
            <x-jet-input-error for="state.imap.host" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="port" value="{{ __('Port') }}" />
            <x-jet-input id="port" type="text" class="mt-1 block w-full" wire:model.defer="state.imap.port"/>
            <x-jet-input-error for="state.imap.port" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="encryption" value="{{ __('Encryption') }}" />
            <div class="relative">
                <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer" wire:model.defer="state.imap.encryption">
                    <option value="">{{ __('None') }}</option>
                    <option value="ssl">{{ __('SSL') }}</option>
                    <option value="tls">{{ __('TLS') }}</option>
                </select>
            </div>
            <x-jet-input-error for="state.imap.encryption" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <label for="validate_cert" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Validate Encryption Certificate') }}</div>
                <div class="relative">
                    <input id="validate_cert" type="checkbox" class="hidden" wire:model.defer="state.imap.validate_cert"/>
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.imap.username"/>
            <x-jet-input-error for="state.imap.username" class="mt-2" />
        </div>
        <div x-data="{ show: false }" class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <div class="relative">
                <x-jet-input id="password" x-bind:type="show ? 'text' : 'password'" class="mt-1 block w-full" wire:model.defer="state.imap.password"/>
                <div x-on:click="show = !show" x-text="show ? 'HIDE' : 'SHOW'" class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-5 text-xs"></div>
            </div>
            <x-jet-input-error for="state.imap.password" class="mt-2" />
        </div>
        <div x-data="{ show_advance: false }" class="col-span-6 sm:col-span-4">
            <label for="show_advance" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Show Advance') }}</div>
                <div class="relative">
                    <input x-model="show_advance" id="show_advance" type="checkbox" class="hidden"/>
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <div x-show="show_advance" class="mt-6">
                <x-jet-label for="default_account" value="{{ __('Default Account') }}" />
                <x-jet-input id="default_account" type="text" class="mt-1 block w-full" wire:model.defer="state.imap.default_account"/>
            </div>
            <div x-show="show_advance" class="mt-6">
                <x-jet-label for="protocol" value="{{ __('Protocol') }}" />
                <x-jet-input id="protocol" type="text" class="mt-1 block w-full" wire:model.defer="state.imap.protocol"/>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>