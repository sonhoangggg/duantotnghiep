<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Beesphone</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/bootstrap.min.css') }}">

<!-- Animate -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/animate.css') }}">

<!-- Swiper -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/swiper-bundle.min.css') }}">

<!-- Bootstrap Select -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/bootstrap-select.min.css') }}">

<!-- Drift zoom -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/drift-basic.min.css') }}">

<!-- Image compare -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/image-compare-viewer.min.css') }}">

<!-- Photoswipe -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/photoswipe.css') }}">

<!-- CSS chính (LUÔN ĐỂ CUỐI) -->
<link rel="stylesheet" href="{{ asset('assets/Users/css/styles.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<!-- JS -->
<script src="{{ asset('assets/Users/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/carousel.js') }}"></script>
<script src="{{ asset('assets/Users/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/lazysize.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/count-down.js') }}"></script>
<script src="{{ asset('assets/Users/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/Users/js/multiple-modal.js') }}"></script>
<script src="{{ asset('assets/Users/js/main.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            const alertBox = document.getElementById("success-alert");
            if (alertBox) {
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.style.display = "none", 500);
            }
        }, 2000);
    });
</script>

</head>
<body>

@include('partials.header')
@include('partials.center')

@yield('content')


@include('partials.footer')


</body>
</html>
