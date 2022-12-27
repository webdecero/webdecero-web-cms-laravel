<!DOCTYPE html>
<html>
@include('manager.page.includes.head')

<body class={!! $class !!}>
  <!-- Home section-->
  @yield('contenido')

  @include('manager.page.includes.js')

</body>

</html>
