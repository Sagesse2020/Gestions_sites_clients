<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cursage Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: system-ui, Arial, sans-serif;
            background: #f5f6fa;
        }

        header {
            background: #273c75;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            overflow-x: auto;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #40739e;
            color: white;
        }

        .btn {
            padding: 6px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-edit { background: #00a8ff; color: white; }
        .btn-delete { background: #e84118; color: white; }
        .btn-success { background: #44bd32; color: white; }

        /* ✅ RESPONSIVE */
        @media (max-width: 768px) {
            table, thead, tbody, tr, td, th {
                display: block;
            }
            th { display: none; }
            tr {
                margin-bottom: 15px;
                background: white;
                padding: 10px;
                border-radius: 8px;
            }
            td {
                display: flex;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Cursage Solutions</h1>
    <nav>
        <a href="{{ route('clients.index') }}">Clients</a>
        <a href="{{ route('hebergements.index') }}">Hébergements</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
