CREATE DATABASE gukwon_ctf DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE gukwon_ctf;

CREATE TABLE user_info(
    id TEXT NOT NULL,
    pwd_hash TEXT NOT NULL,
    nickname VARCHAR(16) PRIMARY KEY NOT NULL,
    stdid INT NOT NULL,
    score TEXT NOT NULL,
    is_manager BOOLEAN NOT NULL,
    is_superuser BOOLEAN NOT NULL,
    is_on_contest BOOLEAN NOT NULL,
    last_auth DATETIME
);

CREATE TABLE access_token(
    token TEXT NOT NULL,
    nickname TEXT NOT NULL,
    expire_datetime DATETIME NOT NULL,
    is_manager BOOLEAN NOT NULL,
    is_on_contest BOOLEAN NOT NULL
);

CREATE TABLE auth_code(
    stdid INT,
    code VARCHAR(7) NOT NULL PRIMARY KEY,
    is_manager BOOLEAN NOT NULL,
    is_superuser BOOLEAN NOT NULL
);

CREATE TABLE problem(
    idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    author TEXT NOT NULL,
    upload_datetime DATETIME NOT NULL,
    description TEXT NOT NULL,
    score INT NOT NULL,
    flag TEXT NOT NULL,
    solvers TEXT
);

CREATE TABLE notice(
    idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    author TEXT NOT NULL,
    upload_datetime DATETIME NOT NULL,
    description TEXT NOT NULL
);