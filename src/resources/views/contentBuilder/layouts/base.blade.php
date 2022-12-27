<!DOCTYPE html>
<html>
@include('contentBuilder.includes.head')
<!-- Header-->

{{-- @include('contentBuilder.includes.nav') --}}



<div>
    <div class="container">

        @yield('contenido')

    </div>
</div>


<!-- Home section-->






<!--footer-->
@include('contentBuilder.includes.footer')
{{-- js --}}
{{-- </div> --}}

@include('contentBuilder.includes.js')

</html>
