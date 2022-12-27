<!DOCTYPE html>
<html>
@include('manager.editor.template.includes.head')

    <body>
        <div class="container-builder main">
            @yield('contenido')
        </div>

        {{-- js --}}
        @include('manager.editor.template.includes.js')
    </body>
</html>
