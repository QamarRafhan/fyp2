<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }} - {{ trans('application-auth::social.landing.title') }}</title>
</head>
<body>
{{ trans('application-auth::social.landing.info') }}

<script>
    var parent = window.opener || window.parent;

    if (parent && parent !== window) {
        parent.postMessage(@json($payload), '*');

        if (window.opener) {
            window.close();
        }
    } else {
        window.location.href = 'unity:?' + @json(http_build_query($payload));
    }
</script>
</body>
</html>
