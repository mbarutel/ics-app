<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Hello, world!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
</head>

<body class="relative">
    @auth
        <header class="bg-stone-700 relative">
            <livewire:navmenu />
        </header>
    @endauth

    {{ $slot }}

    <footer class="bg-stone-700">
        <h1 class="text-white">FOOTER</h1>
    </footer>
</body>

</html>
