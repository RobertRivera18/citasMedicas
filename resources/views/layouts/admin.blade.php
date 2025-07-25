@props([
'title'=>config('app.name', 'Laravel'),
'breadcrumbs'=>[]

])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <script src="https://kit.fontawesome.com/f2ff89425f.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{--wireui---}}
    <wireui:scripts />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50">

    @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

    <div class="p-4 sm:ml-64">
        <div class="mt-14 flex items-center">
            @include('layouts.includes.admin.breadcrumb')

            @isset($action)
            <div class="ml-auto">
                {{$action}}
            </div>
            @endisset
        </div>
        {{ $slot }}
    </div>

    @stack('modals')


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @if (session('swal'))
    <script>
        Swal.fire(@json(session('swal')??[]));
    </script>
    @endif

    <script>
        forms=document.querySelectorAll('.delete-form');
            forms.forEach(form => {
                form.addEventListener('submit',function(e){
                e.preventDefault();
              Swal.fire({
                    title: '¿Eliminar Rol?',
                    html: `<div style="font-size: 15px;">
                    <strong>¡Esta acción no se puede deshacer!</strong><br>
                  El rol será eliminada de forma permanente del.
                </div>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt"></i> Sí, eliminar',
                    cancelButtonText: '<i class="fas fa-times-circle"></i> Cancelar',
                    customClass: {
                        popup: 'rounded-xl px-6 pt-6 pb-4',
                        confirmButton: 'px-4 py-2 text-sm',
                        cancelButton: 'px-4 py-2 text-sm'
                    },
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
  if (result.isConfirmed) {
    form.submit()
  }
});

                });
            });
    </script>
</body>

</html>