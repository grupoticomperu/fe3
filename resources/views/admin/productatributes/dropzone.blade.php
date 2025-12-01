<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <form action="{{route('admin.dropzoneok')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded dropzone h-96">
        @csrf
    </form>


</x-app-layout>
