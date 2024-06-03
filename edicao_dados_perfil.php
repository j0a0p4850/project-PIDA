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

    <form method="post" action="pagina_de_processamento.php">
        <label for="user_description">Resumo:</label>
        <textarea id="user_description" name="user_description" rows="4"></textarea>

        <label for="habilidades">Habilidades:</label>
        <input type="text" name="habilidades" id="habilidades" placeholder="Titulo Habilidade. Ex: HTML">

        <label for="habilidade_descricao">Descrição Habilidade:</label>
        <textarea name="habilidade_descricao" id="habilidade_descricao" cols="30" rows="4"
            placeholder="Descreva a sua habilidade"></textarea>

        <div class="input-duplo">
            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa">
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo">
        </div>

        <button type="submit">Modificar</button>
    </form>


    


</body>

</html>