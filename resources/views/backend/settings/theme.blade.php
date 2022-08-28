<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Theme Options') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You will see here theme specific options.') }}
    </x-slot>

    <x-slot name="form">
        @if (config('app.settings.theme') == 'groot')
            <div class="col-span-6">
                <x-jet-label for="groot_extra_text_page" value="{{ __('Extra Text Page') }}" />
                <div class="relative">
                    <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer"
                        wire:model.defer="state.groot.extra_text_page">
                        <option value="0">None</option>
                        @foreach ($state['pages'] as $id => $page)
                            <option value="{{ $id }}">{{ $page }}</option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="state.groot.extra_text_page" class="mt-2" />
                <small class="block mt-1">{{ __('Selected Page Content will be shown on App Page') }}</small>
            </div>
        @endif
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
