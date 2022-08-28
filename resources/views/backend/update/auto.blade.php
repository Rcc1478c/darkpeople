<x-jet-form-section submit="apply">
    <x-slot name="title">
        {{ __('OTA Updates') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You can apply OTA Updates here if available.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <div class="w-full py-3 px-4 overflow-hidden rounded-md flex items-center border {{ $status['available'] ? 'bg-blue-50' : 'bg-gray-50'}} {{ $status['available'] ? 'border-blue-500' : 'border-gray-500'}}">
                <div class="{{ $status['available'] ? 'text-blue-500' : 'text-gray-500'}} w-10"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-lg text-gray-600 font-semibold">{{ __($status['available'] ? 'Update Available' : 'You\'re on Latest Version') }}</div>
                    <div class="text-sm">{!! $status['message'] !!}</div>
                </div>
            </div>
        </div>
        @if($progress)
        <div class="col-span-6 bg-black px-5 py-4 rounded-md">
            {!! $progress !!}
        </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        @if($status['available'] && !$status['disabled'])
        <x-jet-button>
            {{ __('Apply') }}
        </x-jet-button>
        @elseif($status['disabled'])
        <small class="text-red-500 font-bold">{{ __('Please upgrade your PHP version to apply update.') }}</small>
        @else
        <x-jet-button disabled>
            {{ __('Apply') }}
        </x-jet-button>
        @endif
    </x-slot>
</x-jet-form-section>