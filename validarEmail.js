document.getElementById('emailForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    verificarEmail(email).then(isValid => {
        const resultado = document.getElementById('resultado');
        if (isValid) {
            resultado.textContent = 'Email é válido!';
            resultado.style.color = 'green';
        } else {
            resultado.textContent = 'Email é inválido!';
            resultado.style.color = 'red';
        }
    });
});

function verificarSintaxeEmail(email) {
    const padrao = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return padrao.test(email);
}

async function verificarDominioEmail(email) {
    const dominio = email.split('@')[1];
    const url = `https://dns.google/resolve?name=${dominio}&type=MX`;
    
    try {
        const response = await fetch(url);
        const data = await response.json();
        return data.Answer && data.Answer.length > 0;
    } catch (error) {
        console.error('Erro ao verificar o domínio:', error);
        return false;
    }
}

async function verificarEmail(email) {
    if (!verificarSintaxeEmail(email)) {
        return false;
    }
    if (!await verificarDominioEmail(email)) {
        return false;
    }
    return true;
}
