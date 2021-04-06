CREATE DATABASE IF NOT EXISTS `library`;
USE `library`;

CREATE TABLE IF NOT EXISTS roles
(
    name        VARCHAR(20)  NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (name)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS users
(
    id            int                 NOT NULL AUTO_INCREMENT,
    user_name     varchar(64) UNIQUE  NOT NULL,
    first_name    varchar(64),
    last_name     varchar(64),
    password_hash varchar(255)        NOT NULL,
    email         varchar(320) UNIQUE NOT NULL,
    role          VARCHAR(20) default 'USER' check ( role in ('ADMIN', 'USER') ),
    PRIMARY KEY (id),
    FOREIGN KEY (role) references roles (name)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
CREATE TABLE IF NOT EXISTS past_passwords
(
    id            int auto_increment,
    user          int          NOT NULL,
    password_hash varchar(255) NOT NULL,
    date          date default NOW(),
    primary key (id),
    foreign key (user) references users (id) on update cascade on delete cascade
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS user_sessions
(
    id          int         NOT NULL AUTO_INCREMENT,
    user        int         NOT NULL,
    session_id  varchar(64) NOT NULL,
    last_access datetime    NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user) REFERENCES users (id) on update cascade on delete cascade
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS authors
(
    id          int auto_increment,
    first_name  varchar(64),
    middle_name varchar(64),
    last_name   varchar(64),
    description varchar(1000),
    primary key (id)
);


CREATE TABLE IF NOT EXISTS books
(
    id           INT AUTO_INCREMENT,
    title        VARCHAR(255) NOT NULL unique,
    genre        VARCHAR(64),
    description  varchar(1000),
    is_available boolean default TRUE,
    PRIMARY KEY (id)
) ENGINE = InnoDb
  DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS book_authors
(
    book   int,
    author int,
    primary key (book, author),
    foreign key (book) references books (id),
    foreign key (author) references authors (id)
);



CREATE TABLE IF NOT EXISTS loans
(
    id          int auto_increment,
    user        int,
    book        int,
    loan_date   datetime NOT NULL,
    return_date datetime,
    primary key (id),
    foreign key (user) references users (id),
    foreign key (book) references books (id)
) ENGINE = InnoDb
  DEFAULT CHARSET = utf8;