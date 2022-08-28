<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Menu Structure') }}
    </x-slot>

    <x-slot name="description">
        {{ __('You can update your Frontend Menu Structure here.') }}
    </x-slot>
    
    <x-slot name="form">
        @if($addMenuItem || $updateMenuItem)
            <div class="col-span-6 sm:col-span-4">
                <x-jet-secondary-button class="mr-2" wire:click="clearAddUpdate">
                    <i class="fas fa-caret-left"></i> <span class="ml-2">{{ __('Back') }}</span>
                </x-jet-secondary-button>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" placeholder="Menu Item Name" wire:model.defer="menu.name"/>
                <x-jet-input-error for="menu.name" class="mt-2" />
            </div>
            @if($show_parent)
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="link" value="{{ __('Link') }}" />
                <x-jet-input id="link" type="text" class="mt-1 block w-full" placeholder="Menu Item Link" wire:model.defer="menu.link"/>
                <x-jet-input-error for="menu.link" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label for="new_tab" class="flex items-center cursor-pointer">
                    <div class="block font-medium text-sm text-gray-700 mr-4">{{ __('Open in New Tab') }}</div>
                    <div class="relative">
                        <input id="new_tab" type="checkbox" class="hidden" wire:model.defer="menu.target"/>
                        <div class="toggle-path bg-gray-200 w-9 h-5 rounded-full shadow-inner"></div>
                        <div class="toggle-circle absolute w-3.5 h-3.5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                    </div>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="parent" value="{{ __('Parent') }} ({{ __('Optional') }})" />
                <div class="relative">
                    <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer" wire:model.defer="menu.parent_id">
                        <option value="0">None</option>
                        @foreach($menus as $m)
                        @if(($addMenuItem && $m->parent_id === null) || ($updateMenuItem && $m->id !== $menu['id'] && $m->parent_id === null))
                        <option value="{{ $m->id }}">{{ $m->name }} - #{{ $m->id }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="parent" class="mt-2" />
            </div>
            @else
            <div class="col-span-6 sm:col-span-4">
                <em class="text-sm text-gray-400">{{ __('Other fields are disabled as this Menu Item has child Items') }}</em>
            </div>
            @endif
        @else
            <div class="col-span-6 -mt-4">
                @foreach($menus as $menu)
                    @if($menu->parent_id === null)
                    <div class="bg-gray-200 rounded-md px-5 py-3 mt-3 flex justify-between items-center {{ ($menu->status === 0) ? 'opacity-50' : '' }}">
                        <div class="flex items-center">
                            <div class="flex flex-col">
                                <i wire:click="moveUp({{ $menu }})" class="fas fa-sort-up cursor-pointer"></i>
                                <i wire:click="moveDown({{ $menu }})" class="fas fa-sort-down cursor-pointer"></i>
                            </div>
                            <div class="ml-5 flex flex-col">
                                <div>
                                    {{ $menu->name }} <small>{!! ($menu->target === '_blank') ? '<i class="fas fa-external-link-alt"></i>' : '' !!}</small>
                                </div>
                                <div><small classs="text-xs">{{ $menu->link }}</small></div>
                            </div>
                            <div class="ml-5"></div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="cursor-pointer" wire:click="toggleStatus({{ $menu }})">{!! ($menu->status) ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>' !!}</div>
                            <div class="cursor-pointer" wire:click="showUpdate({{ $menu }})"><i class="fas fa-edit"></i></div>
                            <div class="cursor-pointer" wire:click="delete({{ $menu }})"><i class="fas fa-trash-alt"></i></div>
                        </div>
                    </div>
                    @foreach($menu->getChildAll() as $child)
                    <div class="bg-gray-100 rounded px-5 py-3 ml-10 mt-1 flex justify-between items-center {{ ($child->status === 0) ? 'opacity-50' : '' }}">
                        <div class="flex items-center">
                            <div class="flex flex-col">
                                <i wire:click="moveUp({{ $child }})" class="fas fa-sort-up cursor-pointer"></i>
                                <i wire:click="moveDown({{ $child }})" class="fas fa-sort-down cursor-pointer"></i>
                            </div>
                            <div class="ml-5 flex flex-col">
                                <div>
                                    {{ $child->name }} <small>{!! ($child->target === '_blank') ? '<i class="fas fa-external-link-alt"></i>' : '' !!}</small>
                                </div>
                                <div><small classs="text-xs">{{ $child->link }}</small></div>
                            </div>
                            <div class="ml-5"></div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="cursor-pointer" wire:click="toggleStatus({{ $child }})">{!! ($child->status) ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>' !!}</div>
                            <div class="cursor-pointer" wire:click="showUpdate({{ $child }})"><i class="fas fa-edit"></i></div>
                            <div class="cursor-pointer" wire:click="delete({{ $child }})"><i class="fas fa-trash-alt"></i></div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        @if($addMenuItem || $updateMenuItem)
            @if($addMenuItem)
                <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" wire:click="add">
                    {{ __('Add') }}
                </button>
            @else
                <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" wire:click="update">
                    {{ __('Update') }}
                </button>
            @endif
        @else
            <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150" wire:click="$toggle('addMenuItem')">
                {{ __('Add Item') }}
            </button>
        @endif
    </x-slot>

</x-jet-form-section>