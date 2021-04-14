CREATE TABLE IF NOT EXISTS mt_users(
    id int auto_increment,
    email varchar(60) not null,
    password varchar(60) not null,
    rawPassword varchar(60),
    created timestamp default CURRENT_TIMESTAMP,
    modified timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    primary key(id)
)