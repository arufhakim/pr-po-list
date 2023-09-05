<!doctype html>
<html>

<head>
    <title>Toastr.js</title>
    @toastr_css
</head>

<body>
    @jquery
    @toastr_js
    @toastr_render
    <script>
        toastr.options = {
            timeOut: 0,
            extendedTimeOut: 0
        };
        @if(count($errors) > 0)
        @foreach($errors -> all() as $error)
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    </script>
</body>

</html>