<!DOCTYPE html>
<html>
@include('manager.editor.pages.includes.head')

    <body>
        @yield('header')

        <div class="container-builder">
            @yield('contenido')
        </div>

        @yield('footer')
        
        {{-- js --}}
        @include('manager.editor.pages.includes.js')
    </body>
</html>
