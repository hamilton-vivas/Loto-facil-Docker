# 🎰 Sistema Lotofácil (Legacy Modernization)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white)

Este projeto consiste na modernização e conteinerização de um sistema legado de estatísticas e geração de apostas para a **Lotofácil**. A aplicação original dependia de ferramentas defasadas (como EasyPHP) e codificações antigas, e foi totalmente reestruturada para rodar de forma isolada, previsível e moderna.

## 🚀 Destaques Arquiteturais (Para Recrutadores)
* **Conteinerização com Docker**: Isolamento completo da aplicação usando uma infraestrutura multicontêiner com `Docker Compose`.
* **Resolução de Débito Técnico**: Migração guiada de um ambiente que utilizava drivers obsoletos para um ecossistema Docker customizado utilizando `Dockerfile` para injeção de extensões legadas necessárias (`mysql`, `mysqli` e `pdo_mysql`).
* **Modernização de Encoding**: Conversão global e padronização do fluxo de dados da aplicação de padrões ocidentais antigos (`Windows-1252`/`latin1`) para o padrão universal moderno `UTF-8`.
* **Automação de Banco de Dados**: Configuração de volumes persistentes e scripts de inicialização automática (`/docker-entrypoint-initdb.d`) para população do banco de dados na primeira execução.

---

## 🛠️ Tecnologias Utilizadas
* **Backend:** PHP 5.6 (com módulo Apache `mod_rewrite` habilitado)
* **Banco de Dados:** MySQL 5.7 (otimizado com collation global utf8)
* **Infraestrutura:** Docker & Docker Compose

---

## 📦 Como Executar o Projeto Localmente

### Pré-requisitos
* Ter o [Docker](https://docker.com) instalado na máquina.
* Ter o Git instalado.

### Passo a Passo

1. **Clonar o repositório:**
   ```bash
   git clone https://github.com
   cd Loto-facil-Docker
   ```

2. **Garantir a base de dados inicial:**
   * Certifique-se de que o seu dump `.sql` gerado está posicionado dentro do diretório `init-db/`.

3. **Subir a infraestrutura:**
   Execute o comando abaixo para compilar o Dockerfile e iniciar os contêineres em segundo plano:
   ```bash
   docker compose up -d --build
   ```

4. **Acessar a aplicação:**
   Abra o seu navegador e acesse: [http://localhost:8080](http://localhost:8080)

---

## 💾 Comandos Úteis de Gerenciamento

* **Parar os serviços (preservando estado):**
  ```bash
  docker compose stop
  ```
* **Iniciar os serviços parados:**
  ```bash
  docker compose start
  ```
* **Remover os contêineres da memória:**
  ```bash
  docker compose down
  ```

---

## 👨‍💻 Desenvolvedor
* **GitHub:** [@hamilton-vivas](https://github.com)
