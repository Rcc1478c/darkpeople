<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Socials') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You can add multiple social media properties to showcase on your website. You can select icons for social media from Font Awesome by visiting ') }}
        <a class="font-bold underline" href="https://fontawesome.com/icons?m=free" target="_blank" rel="noopener noreferrer">{{ __('this link.') }}</a>
    </x-slot>
    
    <x-slot name="form">
        @foreach($state['socials'] as $key => $social)
        <div x-data="{ icon: '{{ $social['icon'] }}' }" class="col-span-6 flex">
            <div>
                <x-jet-label value="{{ __('Icon') }}" />
                <div class="relative">
                    <x-jet-input x-model="icon" type="text" class="mt-1 block" wire:model.defer="state.socials.{{ $key }}.icon"/>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3"><i :class="icon"></i></div>
                </div>
                <x-jet-input-error for="state.socials.{{ $key }}.icon" class="mt-2" />
            </div>
            <div class="flex-1 ml-3">
                <x-jet-label value="{{ __('Link') }}" />
                <div class="flex">
                    <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="state.socials.{{ $key }}.link"/>
                    <button type="button" wire:click="remove({{ $key }})" class="form-input rounded-md ml-3 mt-1 bg-red-700 text-white border-0"><i class="fas fa-trash"></i></button>  
                </div>
                <x-jet-input-error for="state.socials.{{ $key }}.link" class="mt-2" />
            </div>
        </div>
        @endforeach
        <div class="col-span-6">
            <button type="button" wire:click="add" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">{{ __('Add') }}</button>
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