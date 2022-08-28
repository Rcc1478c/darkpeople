<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Ad Spaces') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You can setup your Ad Codes here for various Ad Spaces on TMail.') }}
    </x-slot>
    
    <x-slot name="form">
        <div class="col-span-6">
            <x-jet-label for="ad_space_1" value="{{ __('Ad Space 1') }}" />
            <textarea id="ad_space_1" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your Ad Code here" wire:model.defer="state.ads.one"></textarea>
            <x-jet-input-error for="ad_space_1" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="ad_space_2" value="{{ __('Ad Space 2') }}" />
            <textarea id="ad_space_2" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your Ad Code here" wire:model.defer="state.ads.two"></textarea>
            <x-jet-input-error for="ad_space_2" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="ad_space_3" value="{{ __('Ad Space 3') }}" />
            <textarea id="ad_space_3" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your Ad Code here" wire:model.defer="state.ads.three"></textarea>
            <x-jet-input-error for="ad_space_3" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="ad_space_4" value="{{ __('Ad Space 4') }}" />
            <textarea id="ad_space_4" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your Ad Code here" wire:model.defer="state.ads.four"></textarea>
            <x-jet-input-error for="ad_space_4" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-jet-label for="ad_space_5" value="{{ __('Ad Space 5') }}" />
            <textarea id="ad_space_5" class="form-input rounded-md shadow-sm mt-4 block w-full resize-y border" placeholder="Enter your Ad Code here" wire:model.defer="state.ads.five"></textarea>
            <x-jet-input-error for="ad_space_5" class="mt-2" />
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