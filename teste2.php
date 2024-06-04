<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de E-mail</title>
</head>
<body>
    <form id="emailForm" action="send_email.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
    <p id="resultado"></p>

    <script>
        document.getElementById('emailForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const resultado = document.getElementById('resultado');
                resultado.textContent = data;
                resultado.style.color = 'green';
            })
            .catch(error => {
                console.error('Erro:', error);
                const resultado = document.getElementById('resultado');
                resultado.textContent = 'Erro ao enviar e-mail de confirmação.';
                resultado.style.color = 'red';
            });
        });
    </script>
</body>
</html>


