<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('client.layouts.head')
</head>
<body>
<!-- Page Preloder -->
{{--<div id="preloder">--}}
{{--    <div class="loader"></div>--}}
{{--</div>--}}

<!-- Humberger Begin -->
@include('client.layouts.humber_wrapper')
<!-- Humberger End -->

<!-- Header Section Begin -->
    @include('client.layouts.top_info')
<!-- Header Section End -->

@yield('content')

<!-- Footer Section Begin -->
    @include('client.layouts.footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
@include('client.layouts.script')
@yield('script')
</body>

</html>
