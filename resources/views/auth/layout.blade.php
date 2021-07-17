<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visit-Shymkent</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @toastr_css
    <!-- End layout styles -->
    <link rel="shortcut icon" href="favicon.png" />
</head>
<body>
<div class="main-wrapper">

@yield("content")

</div>
<!-- core:js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.4-beta.33/inputmask.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
@jquery
@toastr_js
@toastr_render
<script>
    var selector = document.getElementById("exampleInputPhone");

    var im = new Inputmask("+7999-999-99-99");
    im.mask(selector);
</script>
<!-- end custom js for this page -->
</body>
</html>
