<x-app-layout>



    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Menu General') }}
        </h2>
    </x-slot>




    <section class="">
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                        <div class="grid grid-cols-1 px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                            

                            <div class="py-2 mb-1">
                                <label>Categorias </label>
                                <select  name="category_id" class="select2"  style="height:50%; width:100%">
                                    <option value="0" selected disabled>Seleccione</option> 
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    
                                </select>
                                <x-jet-input-error for="category_id" /> 
                            </div>



                            <div class="py-2 mb-1">
                                <label>Marcas </label>
                                <select  name="brand_id" class="select22"  style="height:50%; width:100%">
                                    <option value="0" selected disabled>Seleccione</option> 
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                    
                                </select>
                                <x-jet-input-error for="brand_id" /> 
                            </div>
                                
                 
                        </div>
                </div>
            </div>
        </div>   










    </section>



    <section>
        <div class="mt-4 bg-white shadow">
            hola
        </div>
    </section>

    

    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        
        <script>
        
            $('.select2').select2({
                tags:true
            });
        
            $('.select22').select2({
                tags:true
            });
        
        
        </script>
    @endpush
</x-app-layout>

