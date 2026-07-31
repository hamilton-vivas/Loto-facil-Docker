# 🏛️ Diagnóstico Técnico: Arquitetura e Modernização Backend

> **Nota de Contexto:** Este documento apresenta uma análise de engenharia reversa do módulo central (`classes.php`). O objetivo principal deste repositório é demonstrar o uso de **Docker** para isolar e executar este ambiente legado (PHP 5.6 + MySQL 5.7). Abaixo, mapeio a estrutura do sistema e as melhorias propostas para um cenário real de migração.

---

## 🏗️ Estrutura de Classes

O sistema adota o paradigma de Orientação a Objetos com a seguinte árvore de herança para persistência e lógica de negócio:

*   **Conexao**: Classe base responsável pela abertura do canal com o banco de dados.
    *   └── **Operacao**: Abstração de persistência contendo métodos CRUD genéricos (`excluir`, `localizar`, `listar`).
        *   ├── **Aposta**: Validação de jogos contra o histórico de concursos.
        *   ├── **CadConc**: Gerenciamento e persistência de resultados da loteria.
        *   ├── **Cadconc_Ant**: Parser e ingestão de dados em lote via arquivos texto.
        *   ├── **CadUsuario**: Cadastro e modificação de contas de usuários.
        *   └── **Quadro_loto**: Processamento estatístico e geração de matrizes de dezenas.
    *   └── **Login**: Mecanismo de autenticação de sessão (acessa `Conexao` de forma independente).
*   **Tela**: Componente isolado para renderização de interfaces HTML.

---

## 🔎 Diagnóstico de Engenharia (Pontos Críticos Identificados)

Uma auditoria técnica no código backend identificou os seguintes fatores arquiteturais que motivaram o isolamento do projeto em um container legível:

1. **Depreciação de Driver de Dados**: O sistema utiliza a extensão nativa `mysql_*`, descontinuada a partir do PHP 5.5 e removida no PHP 7+. O uso do Docker com PHP 5.6 foi a solução ideal para viabilizar a execução local sem quebras.
2. **Segurança de Dados (OWASP Top 10)**: Os métodos de busca e escrita na classe `Operacao` interpolam variáveis diretamente nas strings SQL. Em um cenário produtivo, isso exigiria a transição para *Prepared Statements* (via PDO) para mitigar riscos de Injeção de SQL.
3. **Gerenciamento de Credenciais**: A autenticação realiza comparações em texto puro. O padrão arquitetural correto exige o uso de funções de hashing seguro, como `password_hash()` com algoritmos contemporâneos (BCRYPT/Argon2).
4. **Encapsulamento e Visibilidade**: Propriedades de controle como `$mensagem` e `$sucesso` foram declaradas como `private` na classe pai, limitando o escopo de herança esperado pelas classes filhas.

---

## 🚀 Plano de Modernização Proposto

Caso este sistema passasse por um processo de refatoração para implantação em nuvem moderna, o roadmap técnico seria:

*   **Camada de Infraestrutura**: Atualização da imagem Docker para PHP 8.x e MySQL 8.0.
*   **Camada de Abstração de Dados**: Substituição integral da classe `Conexao` pelo driver **PDO**, centralizando a segurança de queries.
*   **Refatoração de Escopo**: Correção da visibilidade de propriedades de `private` para `protected`.
*   **Segurança de Login**: Implementação de criptografia nativa com `password_verify()` para proteção de identidades.
