@include('template.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @stack('head')
</head>

<body>
    <div class="container">
        <div class="box my-5">

            @if (Session::has('error'))
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ Session::get('success') }}
                </div>
            @endif


            <div class="block">
                <span class="has-text-weight-bold is-size-4">@yield('title')</span>
            </div>
            @stack('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                var $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });

    </script>
    @stack('script')
</body>

</html>
