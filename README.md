# Libreria in php

```bash
.
├── README.md
├── add_author.php
├── add_book.php
├── authors.php
├── books.php
├── config <- Configurazione db
│ ├── database_credentials.php
│ ├── database_schema.sql
│ └── database_seed.sql
├── controller <- Gestione delle richieste
│ ├── AddAuthorController.php
│ ├── AddBookController.php
│ ├── AuthorController.php
│ ├── BooksController.php
│ ├── DatabaseController.php
│ ├── LoansController.php
│ ├── LoginController.php
│ ├── ProfileController.php
│ └── RegistrationController.php
├── index.php
├── loans.php
├── model <- Interazioni con il DB
│ ├── AuthorModel.php
│ ├── BooksModel.php
│ ├── LoansModel.php
│ ├── RolesModel.php
│ └── UserModel.php
├── profile.php
├── register.php
└── views <- HTML
    ├── admin
    ├── components
    ├── library
    └── user_management

```