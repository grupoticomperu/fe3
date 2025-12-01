<x-app-layout>

    @push('styles')

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush
    <div>



        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">


                <div class="flex flex-col content-center px-10 mb-4">
                    <form action="{{route('admin.productatribute.storephoto')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded dropzone h-96">
                        @csrf
                    </form>
                </div>

        </div>

    </div>



</x-app-layout>
