<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('General') }}
    </x-slot>

    <x-slot name="description">
        {{ __('All the general settings shown here are applied on overall website.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('App Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" />
            <x-jet-input-error for="state.name" class="mt-2" />
        </div>
        @if(!env('APP_DEMO', false))
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="logo" value="{{ __('Logo') }}" />
            <input class="mt-2" type="file" wire:model="logo">
            @if ($logo)
                <img class="max-w-logo rounded my-2 p-2 striped-img-preview" src="{{ $logo->temporaryUrl() }}">
            @elseif ($state['custom_logo'])
                <img class="max-w-logo rounded my-2 p-2 striped-img-preview" src="{{ $state['custom_logo'] }}">
            @else
                <img class="max-w-logo rounded my-2 p-2 striped-img-preview" src="{{ asset('images/logo.png') }}">
            @endif
            <x-jet-input-error for="logo" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="favicon" value="{{ __('Favicon') }}" />
            <input class="mt-2" type="file" wire:model="favicon">
            @if ($favicon)
                <img class="max-w-favicon rounded my-2 p-2 striped-img-preview" src="{{ $favicon->temporaryUrl() }}">
            @elseif ($state['custom_favicon'])
                <img class="max-w-favicon rounded my-2 p-2 striped-img-preview" src="{{ $state['custom_favicon'] }}">
            @else
                <img class="max-w-favicon rounded my-2 p-2 striped-img-preview"
                    src="{{ asset('images/favicon.png') }}">
            @endif
            <x-jet-input-error for="favicon" class="mt-2" />
        </div>
        @endif
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="homepage" value="{{ __('Homepage') }}" />
            <div class="relative">
                <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer"
                    wire:model="state.homepage">
                    <option value="0">App - TMail</option>
                    @foreach ($state['pages'] as $id => $page)
                        <option value="{{ $id }}">{{ $page }}</option>
                    @endforeach
                </select>
            </div>
            <x-jet-input-error for="state.homepage" class="mt-2" />
        </div>
        @if($state['homepage'] == 0)
        <div class="col-span-6 sm:col-span-4">
            <label for="disable_mailbox_slug" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">
                    {{ __('Disable Mailbox Slug from URL') }}</div>
                <div class="relative">
                    <input id="disable_mailbox_slug" type="checkbox" class="hidden"
                        wire:model.defer="state.disable_mailbox_slug" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <small>{{ __('If you enable this, then /mailbox slug is removed from your URL.') }}</small>
        </div>
        @endif
        <div class="col-span-6">
            <div class="flex">
                <div x-data="{ color: '{{ $state['colors']['primary'] }}' }" class="flex-1">
                    <x-jet-label value="{{ __('Primary Color') }}" />
                    <div class="relative">
                        <label for="primary_color">
                            <div x-bind:style="`background-color: ${color}`"
                                class="mt-1 rounded-md cursor-pointer h-6 w-20"></div>
                        </label>
                        <input x-model="color" id="primary_color" type="color" class="absolute top-0 left-0 invisible"
                            wire:model.defer="state.colors.primary" />
                    </div>
                    <x-jet-input-error for="primary_color" class="mt-2" />
                </div>
                <div x-data="{ color: '{{ $state['colors']['secondary'] }}' }" class="flex-1">
                    <x-jet-label for="secondary_color" value="{{ __('Secondary Color') }}" />
                    <div class="relative">
                        <label for="secondary_color">
                            <div x-bind:style="`background-color: ${color}`"
                                class="mt-1 rounded-md cursor-pointer h-6 w-20"></div>
                        </label>
                        <input x-model="color" id="secondary_color" type="color" class="absolute top-0 left-0 invisible"
                            wire:model.defer="state.colors.secondary" />
                    </div>
                    <x-jet-input-error for="secondary_color" class="mt-2" />
                </div>
                <div x-data="{ color: '{{ $state['colors']['tertiary'] }}' }" class="flex-1">
                    <x-jet-label for="tertiary_color" value="{{ __('Tertiary Color') }}" />
                    <div class="relative">
                        <label for="tertiary_color">
                            <div x-bind:style="`background-color: ${color}`"
                                class="mt-1 rounded-md cursor-pointer h-6 w-20"></div>
                        </label>
                        <input x-model="color" id="tertiary_color" type="color" class="absolute top-0 left-0 invisible"
                            wire:model.defer="state.colors.tertiary" />
                    </div>
                    <x-jet-input-error for="tertiary_color" class="mt-2" />
                </div>
            </div>
        </div>
        <div x-data="{ cookie: {{ $state['cookie']['enable'] ? 'true' : 'false' }} }"
            class="col-span-6 sm:col-span4">
            <label for="cookie_input" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Cookie Policy') }}</div>
                <div class="relative">
                    <input x-model="cookie" id="cookie_input" type="checkbox" class="hidden"
                        wire:model.defer="state.cookie.enable" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <textarea x-show="cookie" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border"
                placeholder="Enter the Text to show for Cookie Policy (HTML allowed)"
                wire:model.defer="state.cookie.text"></textarea>
            <x-jet-input-error for="state.cookie" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="language" value="{{ __('Default Language') }}" />
            <div class="relative">
                <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer"
                    wire:model.defer="state.language">
                    @foreach (config('app.locales') as $locale)
                        <option>{{ $locale }}</option>
                    @endforeach
                </select>
            </div>
            <x-jet-input-error for="state.language" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <label for="enable_create_from_url" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">
                    {{ __('Enable Mail ID Creation from URL') }}</div>
                <div class="relative">
                    <input id="enable_create_from_url" type="checkbox" class="hidden"
                        wire:model.defer="state.enable_create_from_url" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <small>{{ __('If you enable this, then users will be able to create email ID from URL.') }}</small>
        </div>
        <div class="col-span-6">
            <x-jet-label for="app_header" value="{{ __('Custom Header for App (MailBox)') }}" />
            <textarea id="app_header" class="form-input rounded-md shadow-sm mt-1 block w-full resize-y border" placeholder="Enter your HTML Code here" wire:model.defer="state.app_header"></textarea>
            <x-jet-input-error for="app_header" class="mt-2" />
            <small>{{ __('Here you can add any Meta Tags or any additional custom header tags for App Page') }}</small>
        </div>
        <div class="col-span-6">
            <label for="enable_masking_external_link" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">
                    {{ __('Enable Masking of External URL') }}</div>
                <div class="relative">
                    <input id="enable_masking_external_link" type="checkbox" class="hidden"
                        wire:model.defer="state.enable_masking_external_link" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <small>{{ __('If you enable this, then TMail will use anon.ws to remove your site footprint being passed-on to external link.') }}</small>
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
