@foreach($roles as $role)
    <div >
        <x-jet-label>
            <input name="roles[]" type="checkbox"
                   class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   value="{{ $role->name }}"
            {{ $user->roles->contains($role->id) ? 'checked':''}} >
            {{ $role->name }} <br>
            <small class="text-muted">
                {{ $role->permissions->pluck('name')->implode(', ') }}
            </small>
        </x-jet-label>
    </div>
@endforeach
