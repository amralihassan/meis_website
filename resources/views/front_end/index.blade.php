<!DOCTYPE html>
<html lang="en">
    @include('front_end.layouts.head')
<body>
    @include('front_end.layouts.topHeader')
    @include('front_end.layouts.navbar')

    {{--  page content  --}}
    @yield('content')

    @include('front_end.layouts.gallary')
    @include('front_end.layouts.footer')
    @include('front_end.layouts.javascript')
</body>
</html>
