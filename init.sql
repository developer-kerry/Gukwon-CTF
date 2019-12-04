CREATE DATABASE gukwon_ctf DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE gukwon_ctf;

CREATE TABLE user_info(
    id TEXT NOT NULL,
    pwd_hash TEXT NOT NULL,
    nickname TEXT NOT NULL,
    stdid INT NOT NULL,
    score TEXT NOT NULL,
    root BOOLEAN NOT NULL
);

CREATE TABLE access_token(
    token TEXT NOT NULL,
    nickname TEXT NOT NULL,
    expire_datetime DATETIME NOT NULL
);

CREATE TABLE auth_code(
    stdid INT NOT NULL PRIMARY KEY,
    code VARCHAR(7) NOT NULL,
    root BOOLEAN NOT NULL
);

CREATE TABLE problem(
    idx INT NOT NULL,
    title TEXT NOT NULL,
    author INT NOT NULL,
    description TEXT NOT NULL,
    score INT NOT NULL,
    flag TEXT NOT NULL
);

CREATE TABLE notice(
    idx INT NOT NULL,
    title TEXT NOT NULL,
    author INT NOT NULL,
    description TEXT NOT NULL
)