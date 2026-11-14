<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkyNet</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        nav { background: #222; padding: 12px 20px; }
        nav a { color: #fff; margin-right: 20px; text-decoration: none; }
        .contenedor { max-width: 950px; margin: 20px auto; padding: 0 15px; }
        .caja { background: #fff; padding: 15px; margin-bottom: 20px; border: 1px solid #ccc; }
        input, select { padding: 6px; margin: 4px 0; width: 100%; box-sizing: border-box; }
        button { padding: 6px 12px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        .error { color: red; font-size: 13px; }
        .ok { color: green; }
    </style>
    @livewireStyles
</head>
<body>
    <nav>
        <a href="/">Clientes</a>
        <a href="/cuentas">Cuentas</a>
    </nav>

    <div class="contenedor">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>