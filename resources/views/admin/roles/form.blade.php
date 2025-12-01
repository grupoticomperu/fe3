{{ csrf_field() }}

        <div class="px-3 bg-white">
        <div class="grid w-full grid-cols-1 px-4 pt-4 pb-6 mx-auto mt-4 mb-6 bg-white sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

              @include('admin.permissions.checkboxes',['model'=>$role])

        </div>
        </div>
