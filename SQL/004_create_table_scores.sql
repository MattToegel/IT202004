CREATE TABLE mt_scores(
    id int auto_increment,
    user_id int,
    score int,
    created timestamp default current_timestamp,
    primary key (id),
    foreign key (user_id) references mt_users (id)
)