<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Botão de Acréscimo e Decréscimo</title>
<style>
  button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
  }

  button:hover {
    background-color: #0056b3;
  }

  #counter {
    font-size: 24px;
    margin: 20px 0;
  }
</style>
</head>
<body>

<div id="counter">0</div>
<button id="incrementBtn">Aumentar</button>
<button id="decrementBtn">Diminuir</button>

<script>
  const counterElement = document.getElementById('counter');
  const incrementBtn = document.getElementById('incrementBtn');
  const decrementBtn = document.getElementById('decrementBtn');

  let counterValue = 0;

  // Função para aumentar o contador
  function incrementCounter() {
    if (counterValue < 1) {
      counterValue++;
      counterElement.textContent = counterValue;
    }
  }

  // Função para diminuir o contador
  function decrementCounter() {
    if (counterValue > 0) {
      counterValue--;
      counterElement.textContent = counterValue;
    }
  }

  // Adicionando eventos aos botões
  incrementBtn.addEventListener('click', incrementCounter);
  decrementBtn.addEventListener('click', decrementCounter);
</script>

</body>
</html>
