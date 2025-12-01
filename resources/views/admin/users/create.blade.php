<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

                    <div class="px-3 bg-white">

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div>

                                   {{--  <h3 class="text-center profile-username">Datos del Usuario</h3> --}}
                                    <p class="text-lg font-bold underline underline-offset-2">Datos del Usuario</p>


                                    {{--  @include('partials.error-messages') --}}




                                        <div class="mb-4">
                                            <x-jet-label value="Nombre:" />
                                            <x-jet-input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="tu  nombre"
                                            class="w-full"/>
                                            <x-jet-input-error for="name" />
                                        </div>

                                        <div class="mb-4">
                                            <x-jet-label value="Email:" />
                                            <x-jet-input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="ingrese tu Email"
                                            class="w-full"/>
                                            <x-jet-input-error for="email" />
                                        </div>


                                        <div class="mb-4">
                                            <x-jet-label value="Password:" />
                                            <x-jet-input type="password"
                                            placeholder="tu  passowrd"
                                            class="w-full " name="password" />
                                            <x-jet-input-error for="password" />
                                        </div>

                                        {{-- <div class="mb-4">
                                                <x-jet-label value="Passwordd:" />
                                                <x-jet-input type="passwordd" class="w-full" name="passwordd" />
                                                <x-jet-input-error for="passwordd"/>
                                            </div> --}}


                                        <div class="mb-5">
                                        <x-jet-label value="Password:" />
                                            <x-jet-input id="password_confirmation" name="password_confirmation" type="password"
                                            placeholder="Repite tu  passowrd"
                                            class="w-full"/>
                                        </div>
                                        <hr>
                                        <div class="mb-4">
                                            <x-jet-label value="Dirección:" />
                                            <x-jet-input type="text" name="address" value="{{ old('address') }}"
                                            placeholder="Dirección"
                                            class="w-full"/>
                                            <x-jet-input-error for="address" />
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="mb-4">
                                                <x-jet-label value="Celular:" />
                                                <x-jet-input type="text" name="movil" value="{{ old('movil') }}" placeholder="Celular" class="w-full"/>
                                                <x-jet-input-error for="movil" />
                                            </div>

                                            <div class="mb-4">
                                                <x-jet-label value="DNI:" />
                                                <x-jet-input type="text" name="dni" value="{{ old('dni') }}" placeholder="DNI" class="w-full"/>
                                                <x-jet-input-error for="dni" />
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                            <div>
                                                <x-jet-label value="Cargo:" />
                                                <select name="position_id" class="block w-full py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">Selecciona una categoria</option>
                                                    @foreach($positions as $position)
                                                        <option value="{{$position->id}}" {{ old('position_id',$user->position_id)== $position->id ? 'selected':''}} >{{$position->name}}</option>
                                                    @endforeach
                                                </select>
                                                <x-jet-input-error for="position_id" />
                                            </div>

                                            <div>
                                                <x-jet-label value="Genero:" />
                                                <select name="gender" class="block w-full py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">Escoger</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                                <x-jet-input-error for="gender" />
                                            </div>

                                            <div>
                                                <x-jet-label value="Local:" />
                                                <select name="local_id" class="block w-full py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">Selecciona un local</option>
                                                    @foreach($locales as $local)
                                                        <option value="{{$local->id}}" {{ old('local_id', auth()->user()->employee->local->id)== $local->id ? 'selected':''}} >{{$local->name}}</option>
                                                    @endforeach
                                                </select>
                                                <x-jet-input-error for="position_id" />
                                            </div>
                                        </div>


                                        <div class="py-4">
                                            <input type="file" name="photo" id="file" accept="image/*">
                                        </div>

                                       {{--  <x-jet-danger-button class="w-full mt-4 mb-3" type="submit">
                                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Usuario
                                        </x-jet-danger-button> --}}





                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="px-3 py-4 bg-white md:col-span-2">
                        <p class="text-lg font-bold underline underline-offset-2">Roles</p>
                        <div class="mb-4">

                            @include('admin.roles.checkboxes')
                        </div>

                        <p class="text-lg font-bold underline underline-offset-2">Permisos</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">

                            @include('admin.permissions.checkboxes', ['model' => $user])
                        </div>

                    </div>

                    <x-jet-danger-button class="w-full mt-1 mb-3" type="submit">
                        <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Usuario
                    </x-jet-danger-button>

        </div>
    </form>
</x-app-layout>
