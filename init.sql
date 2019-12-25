CREATE DATABASE gukwon_ctf DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE gukwon_ctf;

CREATE TABLE user_info(
    id TEXT NOT NULL,
    pwd_hash TEXT NOT NULL,
    nickname VARCHAR(16) NOT NULL,
    stdid INT NOT NULL PRIMARY KEY,
    score TEXT NOT NULL,
    is_manager BOOLEAN NOT NULL,
    is_superuser BOOLEAN NOT NULL,
    last_auth DATETIME
);

CREATE TABLE contest_status(
    is_on_contest BOOLEAN NOT NULL,
    start_datetime DATETIME NOT NULL
);

CREATE TABLE access_token(
    token TEXT NOT NULL,
    stdid INT NOT NULL,
    nickname TEXT NOT NULL,
    expire_datetime DATETIME NOT NULL,
    is_manager BOOLEAN NOT NULL
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
    author VARCHAR(16) NOT NULL,
    upload_datetime DATETIME NOT NULL,
    description TEXT NOT NULL,
    score INT NOT NULL,
    flag TEXT NOT NULL,
    solvers TEXT,
    category TEXT NOT NULL,
    setted BOOLEAN NOT NULL
);

CREATE TABLE hint(
    prob_idx INT NOT NULL PRIMARY KEY,
    description TEXT NOT NULL,
    level BOOLEAN NOT NULL,
    viewers TEXT NOT NULL
);

CREATE TABLE answer_flag(
    prob_idx INT NOT NULL PRIMARY KEY,
    answer TEXT NOT NULL
);

CREATE TABLE notice(
    idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    author VARCHAR(16) NOT NULL,
    upload_datetime DATETIME NOT NULL,
    description TEXT NOT NULL
);