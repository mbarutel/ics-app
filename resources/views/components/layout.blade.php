<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Hello, world!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="relative">
    @auth
        <header class="bg-stone-700 relative">
            <livewire:navmenu />
        </header>
    @endauth

    @if (session()->has('success'))
        <div class="max-w-2xl mx-auto my-2">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('failure'))
        <div class="max-w-2xl mx-auto my-2">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center">
                {{ session('failure') }}
            </div>
        </div>
    @endif

    {{ $slot }}

    <footer class="bg-stone-700">
        <h1 class="text-white">FOOTER</h1>
    </footer>
</body>

</html>
