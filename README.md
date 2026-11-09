# NEXLOG — Sistema de Gerenciamento Logístico

## Sobre o projeto

O NEXLOG é um sistema web de gerenciamento logístico desenvolvido como atividade prática da disciplina Fundamentos de Programação para Internet, do curso de Análise e Desenvolvimento de Sistemas.

O objetivo é facilitar o cadastro e o gerenciamento de produtos, transportadores, endereços e operações de frete.

## Tecnologias utilizadas

- PHP
- HTML5
- CSS3
- JavaScript
- Bootstrap
- MySQL
- XAMPP
- Git e GitHub

## Funcionalidades

- Cadastro, consulta, edição e exclusão de produtos.
- Cadastro, consulta, edição e exclusão de transportadores.
- Cadastro, consulta, edição e exclusão de endereços.
- Cadastro e gerenciamento de fretes.
- Associação de vários produtos a um único frete.
- Seleção de transportador, endereço de origem e destino.
- Controle de status dos fretes.
- Geração e download de relatórios de fretes por data.

## Estrutura do projeto

```text
gerenciador_logistico/
├── assets/
│   ├── css/
│   └── js/
├── config/
│   └── conexao.example.php
├── enderecos/
├── fretes/
├── produtos/
├── relatorios/
├── transportadores/
├── .gitignore
├── README.md
└── index.php
```

## Como executar o projeto

1. Instale o XAMPP.
2. Inicie os serviços Apache e MySQL.
3. Coloque a pasta do projeto dentro do diretório `htdocs`.
4. Crie o banco de dados `gerenciador_logistico` no phpMyAdmin.
5. Configure a conexão com o banco de dados no arquivo `config/conexao.php`.
6. Acesse pelo navegador:

```text
http://localhost/gerenciador_logistico/
```

## Desenvolvedor

Projeto acadêmico desenvolvido por Guilherme Kollenberg.

**Curso:** Análise e Desenvolvimento de Sistemas  
**Instituição:** UNIPAR — EAD

---

Projeto desenvolvido para fins acadêmicos.