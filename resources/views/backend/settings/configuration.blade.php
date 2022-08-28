<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Configuration') }}
    </x-slot>

    <x-slot name="description">
        {{ __('TMail specific settings which are applied on the App functionality.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fetch_seconds" value="{{ __('Fetch Seconds') }}" />
            <x-jet-input id="fetch_seconds" type="number" class="mt-1 block w-full" min="10" wire:model.defer="state.fetch_seconds" />
            <x-jet-input-error for="state.fetch_seconds" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fetch_messages_limit" value="{{ __('Fetch Messages Limit') }}" />
            <x-jet-input id="fetch_messages_limit" type="number" class="mt-1 block w-full" wire:model.defer="state.fetch_messages_limit" />
            <x-jet-input-error for="state.fetch_messages_limit" class="mt-2" />
            <small>{{ __('Limit of messages retrived at a time. Keep it to as low as possible. Default - 15.') }}</small>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="{{ __('Domains') }}" />
            @foreach($state['domains'] as $key => $domains)
            <div class="flex {{ ($key > 0) ? 'mt-1' : '' }}">
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="state.domains.{{ $key }}" />
                <button type="button" wire:click="remove('domains', {{ $key }})" class="form-input rounded-md ml-2 mt-1 bg-red-700 text-white border-0"><i class="fas fa-trash"></i></button>
            </div>
            <x-jet-input-error for="state.domains.{{ $key }}" class="mt-1 mb-2" />
            @endforeach
            @if(count($state['domains']) == 0)
            <x-jet-input-error for="state.domains.0" class="mt-1 mb-2" />
            @endif
            <button type="button" wire:click="add('domains')" class="mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">{{ __('Add') }}</button>
        </div>
        <div x-data="{ show: false }" class="col-span-6 sm:col-span-4">
            <x-jet-label for="cron_password" value="{{ __('CRON Password') }}" />
            <div class="relative">
                <x-jet-input id="cron_password" x-bind:type="show ? 'text' : 'password'" class="mt-1 block w-full" autocomplete="new-password" wire:model.defer="state.cron_password" />
                <div x-on:click="show = !show" x-text="show ? 'HIDE' : 'SHOW'" class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-5 text-xs"></div>
            </div>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <div class="flex">
                <div>
                    <x-jet-label for="cron_password" value="{{ __('Delete After') }}" />
                    <x-jet-input type="number" class="mt-1 block w-full" wire:model.defer="state.delete.value" />
                </div>
                <div class="ml-2 flex-1">
                    <x-jet-label for="cron_password" value="{{ __('Delete Duration') }}" />
                    <div class="relative">
                        <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer" wire:model.defer="state.delete.key">
                            <option value="d">{{ __('Day(s)') }}</option>
                            <option value="w">{{ __('Week(s)') }}</option>
                            <option value="m">{{ __('Month(s)') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="{{ __('Forbidden IDs') }}" />
            @foreach($state['forbidden_ids'] as $key => $domains)
            <div class="flex {{ ($key > 0) ? 'mt-1' : '' }}">
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="state.forbidden_ids.{{ $key }}" />
                <button type="button" wire:click="remove('forbidden_ids', {{ $key }})" class="form-input rounded-md ml-2 mt-1 bg-red-700 text-white border-0"><i class="fas fa-trash"></i></button>
            </div>
            <x-jet-input-error for="state.forbidden_ids.{{ $key }}" class="mt-1 mb-2" />
            @endforeach
            <button type="button" wire:click="add('forbidden_ids')" class="mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">{{ __('Add') }}</button>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="{{ __('Blocked Domains') }}" />
            <small class="block">{{ __('Emails from this domain(s) will be marked as BLOCKED on the site') }}</small>
            @foreach($state['blocked_domains'] as $key => $domains)
            <div class="flex {{ ($key > 0) ? 'mt-1' : '' }}">
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="state.blocked_domains.{{ $key }}" />
                <button type="button" wire:click="remove('blocked_domains', {{ $key }})" class="form-input rounded-md ml-2 mt-1 bg-red-700 text-white border-0"><i class="fas fa-trash"></i></button>
            </div>
            <x-jet-input-error for="state.blocked_domains.{{ $key }}" class="mt-1 mb-2" />
            @endforeach
            <button type="button" wire:click="add('blocked_domains')" class="mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">{{ __('Add') }}</button>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="date_format" value="{{ __('Date Format') }}" />
            <x-jet-input id="date_format" type="text" class="mt-1 block w-full" wire:model.defer="state.date_format" />
            <x-jet-input-error for="state.date_format" class="mt-2" />
            <small>{{ __('Caution: For Advance Users Only!') }} <a class="border-b" href="https://www.w3schools.com/php/func_date_date_format.asp" target="_blank">{{ __('View Reference') }}</a></small>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="after_last_email_delete" value="{{ __('Action after last Email ID is Deleted by User') }}" />
            <div class="relative">
                <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer" wire:model.defer="state.after_last_email_delete">
                    <option value="redirect_to_homepage">{{ __('Redirect to Homepage') }}</option>
                    <option value="create_new_email_id">{{ __('Create New Email ID') }}</option>
                </select>
            </div>
            <x-jet-input-error for="state.after_last_email_delete" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <div class="flex">
                <div class="flex-1">
                    <x-jet-label for="custom_min" value="{{ __('Custom Min Length') }}" />
                    <x-jet-input id="custom_min" type="number" min="3" class="mt-1 block w-full" wire:model.defer="state.custom.min" />
                    <x-jet-input-error for="state.custom.min" class="mt-1 mb-2" />
                </div>
                <div class="flex-1 ml-2">
                    <x-jet-label for="custom_max" value="{{ __('Custom Max Length') }}" />
                    <x-jet-input id="custom_max" type="number" class="mt-1 block w-full" wire:model.defer="state.custom.max" />
                    <x-jet-input-error for="state.custom.max" class="mt-1 mb-2" />
                </div>
            </div>
            <small>{{ __('Above are character limits for username on custom email address.') }}</small>
        </div>
        <div x-data="{ show_advance_random: {{ $state['advance_random'] ? 'true' : 'false' }} }" class="col-span-6 sm:col-span-4">
            <label for="show_advance_random" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Show Advance Random Email Configuration') }}</div>
                <div class="relative">
                    <input x-model="show_advance_random" id="show_advance_random" type="checkbox" class="hidden" wire:model.defer="state.advance_random" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <div x-show="show_advance_random" class="mt-6">
                <div class="flex">
                    <div class="flex-1">
                        <x-jet-label for="random_start" value="{{ __('Random Start') }}" />
                        <x-jet-input id="random_start" type="text" class="mt-1 block w-full" wire:model.defer="state.random.start" />
                        <x-jet-input-error for="state.random.start" class="mt-1 mb-2" />
                    </div>
                    <div class="flex-1 ml-2">
                        <x-jet-label for="random_end" value="{{ __('Random End') }}" />
                        <x-jet-input id="random_end" type="text" class="mt-1 block w-full" wire:model.defer="state.random.end" />
                        <x-jet-input-error for="state.random.end" class="mt-1 mb-2" />
                    </div>
                </div>
            </div>
        </div>
        <div x-data="{ enable_recaptcha: {{ $state['recaptcha']['enabled'] ? 'true' : 'false' }} }" class="col-span-6 sm:col-span-4">
            <label for="enable_recaptcha" class="flex items-center cursor-pointer">
                <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Enable reCaptcha') }}</div>
                <div class="relative">
                    <input x-model="enable_recaptcha" id="enable_recaptcha" type="checkbox" class="hidden" wire:model.defer="state.recaptcha.enabled" />
                    <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                    <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
            </label>
            <div x-show="enable_recaptcha" class="mt-6">
                <div>
                    <x-jet-label for="recaptcha_site_key" value="{{ __('Site Key') }}" />
                    <x-jet-input id="recaptcha_site_key" type="text" class="mt-1 block w-full" wire:model.defer="state.recaptcha.site_key" />
                    <x-jet-input-error for="state.recaptcha.site_key" class="mt-1 mb-2" />
                </div>
                <div class="mt-2">
                    <x-jet-label for="recaptcha_secret_key" value="{{ __('Secret Key') }}" />
                    <x-jet-input id="recaptcha_secret_key" type="text" class="mt-1 block w-full" wire:model.defer="state.recaptcha.secret_key" />
                    <x-jet-input-error for="state.recaptcha.site_key" class="mt-1 mb-2" />
                </div>
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