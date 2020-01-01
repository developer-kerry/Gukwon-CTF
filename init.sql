CREATE DATABASE gukwon_ctf DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE gukwon_ctf;

CREATE TABLE user_info(
    id TEXT NOT NULL,
    pwd_hash TEXT NOT NULL,
    name VARCHAR(10) NOT NULL,
    nickname VARCHAR(16) NOT NULL PRIMARY KEY,
    stdid INT NOT NULL,
    score TEXT NOT NULL,
    is_manager BOOLEAN NOT NULL,
    is_superuser BOOLEAN NOT NULL,
    last_auth DATETIME
);

CREATE TABLE contest_status(
    is_on_contest BOOLEAN NOT NULL,
    start_datetime DATETIME NOT NULL,
    is_on_managersigning BOOLEAN NOT NULL,
    is_on_participantsigning BOOLEAN NOT NULL
);

CREATE TABLE access_token(
    token TEXT NOT NULL,
    name VARCHAR(10) NOT NULL,
    nickname VARCHAR(16) NOT NULL,
    stdid INT NOT NULL,
    expire_datetime DATETIME NOT NULL,
    is_manager BOOLEAN NOT NULL,
    is_superuser BOOLEAN NOT NULL
);

CREATE TABLE upload_file(
    idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    orig_name TEXT NOT NULL,
    name_save TEXT NOT NULL
);


CREATE TABLE problem(
    idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    author VARCHAR(16) NOT NULL,
    upload_datetime DATETIME NOT NULL,
    description TEXT NOT NULL,
    score INT NOT NULL,
    flag TEXT NOT NULL,
    category TEXT NOT NULL,
    setted BOOLEAN NOT NULL,
    attached TEXT NOT NULL
);

CREATE TABLE logs(
    prob_idx INT NOT NULL PRIMARY KEY,
    solvers TEXT NOT NULL,
    viewers TEXT NOT NULL
);

CREATE TABLE hint(
    prob_idx INT NOT NULL PRIMARY KEY,
    hint1 TEXT NOT NULL,
    hint2 TEXT NOT NULL
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