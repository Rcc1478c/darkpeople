<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Advance') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You can control here, advance settings like adding Custom CSS or JS, adding HTML code to Header or Footer and configuring API Keys for advance access.') }}
    </x-slot>
    
    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="{{ __('API Keys') }}" />
            @foreach($state['api_keys'] as $key => $api_key)
            <div class="flex {{ ($key > 0) ? 'mt-1' : '' }}">
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="state.api_keys.{{ $key }}"/> 
                <button type="button" wire:click="remove({{ $key }})" class="form-input rounded-md ml-2 mt-1 bg-red-700 text-white border-0"><i class="fas fa-trash"></i></button>  
            </div> 
            <x-jet-input-error for="state.api_keys.{{ $key }}" class="mt-1 mb-2" />
            @endforeach
            <button type="button" wire:click="add" class="mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Add</button>
        </div>
        <div class="col-span-6">
            <x-jet-label for="global_css" value="{{ __('Global CSS') }}" />
            <textarea id="global_css" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your CSS Code here" wire:model.defer="state.global.css"></textarea>
            <x-jet-input-error for="global_css" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="global_js" value="{{ __('Global JS') }}" />
            <textarea id="global_js" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your JS Code here" wire:model.defer="state.global.js"></textarea>
            <x-jet-input-error for="global_js" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="global_header" value="{{ __('Global Header') }}" />
            <textarea id="global_header" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your HTML Code here" wire:model.defer="state.global.header"></textarea>
            <x-jet-input-error for="global_header" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="global_footer" value="{{ __('Global Footer') }}" />
            <textarea id="global_footer" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your HTML Code here" wire:model.defer="state.global.footer"></textarea>
            <x-jet-input-error for="global_footer" class="mt-2" />
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