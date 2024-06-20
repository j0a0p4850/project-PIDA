<?php

include 'funcao_adm.php';

$conexaoDB = new conexaoDB();
$conexao = $conexaoDB->conectar();
$denunciaObj = new administrador_func($conexao);

$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$detalhesDenuncias = $denunciaObj->obterDetalhesDenuncias($offset, $limit);
$totalDenuncias = $denunciaObj->obterNumeroTotalDenuncias();
$totalPages = ceil($totalDenuncias / $limit);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pagination {
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #007bff;
            border: 1px solid #007bff;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination a.active {
            background-color: #343a40;
            border-color: #343a40;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <?php
                        if (isset($_SESSION['login']) || isset($_SESSION['admin_login'])) {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="perfil_usuario.php">Perfil</a>
                                </li>';
                        } else {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="cadastro.php">Entrar</a>
                                </li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a href="Pag_tags.php" class="nav-link">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a href="pagina_de_resultados.php" class="nav-link">Pagina de perguntas</a>
                        </li>
                    </ul>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Pesquisar..."
                            oninput="buscarSugestoes(this.value)">
                        <button type="button" class="search-button"
                            onclick="realizarPesquisa(document.getElementById('searchInput').value)">Pesquisar</button>
                        <div class="suggestions-container" id="suggestions"></div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1>Detalhes das Denúncias</h1>
        <?php if ($detalhesDenuncias): ?>
            <table>
                <tr>
                    <th>ID Denúncia</th>
                    <th>Nome Denunciado</th>
                    <th>Nome Denunciou</th>
                    <th>Descrição Denunciada</th>
                    <th>Motivo</th>
                    <th>Outro</th>
                </tr>
                <?php foreach ($detalhesDenuncias as $denuncia): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($denuncia['id_denuncia']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['nome_denunciado']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['nome_denunciou']); ?></td>
                        <td>
                            <a href="pagina_de_post.php?id=<?php echo htmlspecialchars($denuncia['id_pergunta']); ?>">
                                <?php echo htmlspecialchars($denuncia['descricao_denunciada']); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($denuncia['motivo']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['outro']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php else: ?>
            <p>Nenhuma denúncia encontrada ou erro na consulta.</p>
        <?php endif; ?>
    </div>
</body>

</html>