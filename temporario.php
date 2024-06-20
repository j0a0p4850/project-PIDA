<?php
header('Content-Type: application/json');

// Mensagens predefinidas do chatbot
$respostas = [
    'Olá' => 'Olá! Como posso ajudar?',
    'Como você está?' => 'Estou bem, obrigado!',
    'Quem é você?' => 'Eu sou um chat bot que responde perguntas de forma geral',
    'Qual é o seu nome?' => 'Meu nome é ChatBot.',
    'Onde você mora?' => 'Eu sou um bot, não tenho um local físico.',
    'Qual é o sentido da vida?' => '42.',
    'Tchau' => 'Até logo! Estou aqui se precisar de mais alguma coisa.',
    'O que é uma linguagem de programação?' => 'Uma linguagem de programação é uma linguagem utilizada para escrever instruções que um computador pode executar. Ela permite que programadores criem software, aplicativos e sistemas diversos.',
    'Quais são os principais tipos de linguagens de programação?' => 'Os principais tipos são: linguagens de programação de alto nível (como Python, Java, C++), linguagens de script (como JavaScript, PHP), linguagens de programação de baixo nível (como Assembly), e linguagens específicas de domínio (DSLs).',
    'Qual é a diferença entre linguagem de programação compilada e interpretada?' => 'Linguagens compiladas são traduzidas inteiramente em código de máquina antes da execução, enquanto linguagens interpretadas são traduzidas linha por linha durante a execução.',
    'O que é um algoritmo e qual a sua importância na programação?' => 'Um algoritmo é um conjunto de instruções passo a passo para resolver um problema ou realizar uma tarefa. É fundamental na programação pois guia o desenvolvimento de software eficiente e funcional.',
    'Como posso aprender a programar do zero?' => 'Você pode começar estudando conceitos básicos de lógica de programação e escolhendo uma linguagem para iniciar. Há muitos recursos online, tutoriais e cursos que podem ajudar.',
    'Qual é a diferença entre front-end e back-end?' => 'Front-end refere-se à parte de um aplicativo ou site que os usuários interagem diretamente, enquanto back-end lida com a lógica e o processamento dos dados que ocorrem nos servidores.',
    'Quais são as principais características de uma linguagem de programação orientada a objetos?' => 'Principais características incluem encapsulamento, herança, polimorfismo e abstração, que permitem organizar e estruturar programas de forma modular e reutilizável.',
    'O que são frameworks de desenvolvimento e para que servem?' => 'Frameworks são conjuntos de ferramentas e bibliotecas pré-estruturadas que ajudam os desenvolvedores a criar aplicações mais rapidamente ao fornecer abstrações e funcionalidades comuns.',
    'Quais são os principais bancos de dados utilizados na programação?' => 'Alguns dos principais são MySQL, PostgreSQL, MongoDB, Oracle e SQL Server, cada um com características adequadas para diferentes necessidades de armazenamento e recuperação de dados.',
    'O que é versionamento de código e por que é importante?' => 'Versionamento de código é o controle das alterações feitas no código fonte ao longo do tempo. É importante para rastrear mudanças, facilitar colaboração e permitir reversões quando necessário.',
    'Como posso realizar depuração (debug) de código?' => 'Depuração envolve identificar e corrigir erros em um código. Pode ser feita usando ferramentas específicas, como debuggers, e técnicas como impressão de mensagens ou análise passo a passo do código.',
    'Qual é a diferença entre Git e SVN?' => 'Git é um sistema de controle de versão distribuído, enquanto SVN é centralizado. Git permite trabalho offline e ramificações mais flexíveis, enquanto SVN requer conexão contínua ao repositório central.',
    'Como funciona a integração contínua (CI) e entrega contínua (CD)?' => 'CI envolve a automação de testes e integração de código frequentemente em um repositório compartilhado, enquanto CD vai além ao automatizar o processo de deploy de código para produção.',
    'O que são APIs e como elas são usadas na programação?' => 'APIs são conjuntos de regras e definições que permitem que diferentes softwares interajam entre si. São usadas para integrar funcionalidades e dados de um sistema para outro.',
    'Qual é a diferença entre HTTP e HTTPS?' => 'HTTP é um protocolo de transferência de dados não criptografado, enquanto HTTPS utiliza SSL/TLS para criptografar dados transmitidos, proporcionando segurança adicional.',
    'O que são cookies em um contexto de programação web?' => 'Cookies são pequenos arquivos de texto armazenados no navegador dos usuários. Eles são usados para rastrear informações como preferências de usuário e estado da sessão em aplicações web.',
    'Como proteger um site contra ataques de segurança?' => 'Medidas incluem uso de HTTPS, validação de entrada de dados, atualizações regulares de software, filtragem de tráfego malicioso, e práticas de segurança como autenticação e autorização robustas.',
    'Quais são os principais princípios do desenvolvimento ágil?' => 'Princípios incluem entregas frequentes, colaboração entre equipe e clientes, adaptação a mudanças, foco em indivíduos e interações, e software funcional como medida de progresso.',
    'O que é DevOps e qual é o seu papel no desenvolvimento de software?' => 'DevOps é uma cultura e prática que integra desenvolvimento (Dev) e operações (Ops) para melhorar a colaboração e eficiência na entrega de software, utilizando automação e monitoramento contínuos.',
    'Como posso otimizar o desempenho de um site ou aplicativo?' => 'Otimização envolve usar técnicas como caching, compressão de arquivos, minimização de solicitações HTTP, otimização de imagens e uso eficiente de recursos do servidor e do cliente.',
    'Quais são as melhores práticas para documentação de código?' => 'Incluir comentários claros e concisos, usar nomes de variáveis descritivos, documentar funções e métodos, e manter a documentação atualizada são algumas das melhores práticas.',
    'Como escolher entre desenvolvimento nativo e desenvolvimento cruzado?' => 'A escolha depende de fatores como desempenho, custo, tempo de desenvolvimento, e experiência do usuário final. O desenvolvimento nativo oferece melhor desempenho e integração, enquanto o desenvolvimento cruzado pode ser mais rápido e econômico.',
    'Quais são as linguagens de programação mais populares em 2024?' => 'As linguagens populares incluem Python, JavaScript, Java, C#, PHP, C++, Ruby, Swift, Kotlin e TypeScript, cada uma com suas áreas de aplicação e comunidades de desenvolvedores.',
    'O que é cloud computing e como é utilizado na programação?' => 'Cloud computing é a entrega de serviços de computação, como servidores, armazenamento, bancos de dados, redes, software, pela internet. É usado na programação para hospedar aplicações, armazenar dados e escalonar recursos conforme necessário.',
    'Como funcionam os algoritmos de machine learning?' => 'Algoritmos de machine learning são modelos matemáticos que aprendem a partir de dados para fazer previsões ou tomar decisões. Eles são treinados com conjuntos de dados para identificar padrões e fazer inferências.',
    'Quais são os principais desafios da segurança cibernética na programação?' => 'Desafios incluem proteger contra vulnerabilidades de software, ataques de negação de serviço (DDoS), roubo de dados, violações de privacidade, e garantir a conformidade com regulamentações de segurança.',
    'O que são containers e qual é o seu uso na programação?' => 'Containers são ambientes isolados que encapsulam software e suas dependências para execução consistente e portátil. São usados para implantação rápida e consistente de aplicações em diferentes ambientes.',
    'Como funciona a programação funcional?' => 'Programação funcional trata a computação como avaliação de funções matemáticas e evita o estado mutável e mudanças de estado. Usa funções puras, imutabilidade e expressões lambda para estruturar programas.',
    'Quais são as tendências atuais em arquitetura de software?' => 'Tendências incluem microserviços, arquitetura serverless, contêineres, computação em nuvem, DevOps, segurança e escalabilidade.',
    'O que são microserviços e como são implementados?' => 'Microserviços são uma abordagem arquitetural em que uma aplicação é composta por vários serviços pequenos e independentes, cada um executando um processo específico. São implementados como serviços que se comunicam via APIs.',
    'Quais são os principais padrões de design de software?' => 'Padrões incluem MVC (Model-View-Controller), MVVM (Model-View-ViewModel), Singleton, Factory, Strategy, Observer, entre outros, que ajudam a resolver problemas comuns de design de software.',
];

// Obtém a mensagem do usuário
$userMessage = isset($_POST['message']) ? $_POST['message'] : '';

// Verifica se há uma resposta predefinida para a mensagem do usuário
if (array_key_exists($userMessage, $respostas)) {
    $botMessage = $respostas[$userMessage];
} else {
    $botMessage = 'Desculpe, não entendi sua pergunta.';
}

// Retorna a resposta do bot como JSON
echo json_encode(['message' => $botMessage]);
?>
