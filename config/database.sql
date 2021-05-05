CREATE DATABASE IF NOT EXISTS project_login;
USE project_login;

CREATE TABLE users(
id          int auto_increment not null,
name        varchar(100) not null,
surname     varchar(100) not null,
nick        varchar(100) not null,
email       varchar(200) not null,
password    varchar(200) not null,
created_at  datetime default CURRENT_TIMESTAMP(),
update_at   datetime default CURRENT_TIMESTAMP(),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=Innodb DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE images(
    id              int auto_increment not null,
    user_id         int not null,
    path            text not null,
    description     varchar(255) not null,
    created_at      datetime default CURRENT_TIMESTAMP(),
    update_at       datetime default CURRENT_TIMESTAMP(),
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(id) REFERENCES users(id)
)ENGINE=Innodb DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
