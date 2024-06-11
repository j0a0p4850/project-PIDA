<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
        }

        .input-duplo {
            display: flex;
            justify-content: space-between;
        }

        .input-duplo input {
            width: 48%;
        }

        .habilidades {
            height: 100px;
        }
    </style>
</head>

<body>

    <form method="POST" action="editar_processar_comentario.php?comentario_edicao_id=<?php echo $_GET['comentario_edicao_id']; ?>">
        <label for="comentario_body">Descrição:</label>
        <textarea name="comentario_body" id="comentario_body" placeholder="Comentario novo" rows="4" cols="50"></textarea>

        <button type="submit">Modificar</button>
    </form>

</body>

</html>
