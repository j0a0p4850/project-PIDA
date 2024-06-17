<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu de Três Pontinhos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Estilos CSS personalizados */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .menu-container {
            position: relative;
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }

        .menu-content {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }

        .menu-content button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            border: none;
            background: none;
            text-align: left;
            font-size: 16px;
            color: #333;
            cursor: pointer;
        }

        .menu-content button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="menu-container">
        <div class="menu-icon" onclick="toggleMenu()">&#x22EE;</div>
        <div class="menu-content" id="menuContent">
            <button onclick="action1()">Ação 1</button>
            <button onclick="action2()">Ação 2</button>
            <button onclick="action3()">Ação 3</button>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function toggleMenu() {
            var menuContent = document.getElementById('menuContent');
            if (menuContent.style.display === 'block') {
                menuContent.style.display = 'none';
            } else {
                menuContent.style.display = 'block';
            }
        }

        // Fechar o menu ao clicar fora dele
        window.onclick = function(event) {
            if (!event.target.matches('.menu-icon')) {
                var menuContent = document.getElementById('menuContent');
                if (menuContent.style.display === 'block') {
                    menuContent.style.display = 'none';
                }
            }
        }

        // Funções de exemplo para os botões
        function action1() {
            alert('Ação 1 executada');
        }

        function action2() {
            alert('Ação 2 executada');
        }

        function action3() {
            alert('Ação 3 executada');
        }
    </script>
</body>

</html>
