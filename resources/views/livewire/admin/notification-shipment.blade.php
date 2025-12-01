<div class="relative ml-3">
    <x-jet-dropdown align="right" width="60">
        <x-slot name="trigger">
            <span class="inline-flex rounded-md">
                <button type="button"
                    wire:click="resetNotificationCount()"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                    Envios
                    @if(auth()->user()->id)
                    <span class="inline-flex items-center justify-center px-2 py-1 ml-2 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{-- {{ $notifications->count() }} --}}  {{ $noti }}</span>
                    @endif
                </button>
            </span>
        </x-slot>

        <x-slot name="content">
            <div class="w-60">
                <!-- Team Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Envios por Confirmar') }}
                </div>

             <ul class="divide-y-2">
                @foreach ($notifications as $notification)
                <li wire:click="read('{{ $notification->id }}')" class = "{{ ! $notification->read_at ? 'bg-gray-200' : '' }}">
                    <x-jet-dropdown-link class="text-gray-700" href="{{ $notification->data['url']  }}">
                    {{ $notification->data['message'] }}

                    <span class="text-xs font-bold">{{ $notification->created_at->diffForHumans() }}</span>
                    </x-jet-dropdown-link>
                </li>
                @endforeach
            </ul>



            </div>
        </x-slot>
    </x-jet-dropdown>
</div>
