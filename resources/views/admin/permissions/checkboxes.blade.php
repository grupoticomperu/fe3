@foreach ($permissions as $id => $name)
    <div class="px-3">
        <x-jet-label>
            {{--  <x-jet-checkbox name="permissions[]" value="{{ $name }}"
             {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($name) ? 'checked':''}} /> --}}
            <input name="permissions[]" type="checkbox" value="{{ $name }}"
                class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($name) ? 'checked' : '' }}>
            {{ $name }}
        </x-jet-label>
    </div>
@endforeach
