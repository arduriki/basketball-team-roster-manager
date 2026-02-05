use basketball_roster;

create table if not exists players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    number INT NOT NULL,
    position VARCHAR(100) NOT NULL
);

show COLUMNS from players;

insert into
    players (name, number, position)
values ('Dario Brizuela', 8, 'Guard'),
    ('Miles Norris', 5, 'Forward'),
    (
        'Tornike Shengelia',
        23,
        'Center'
    );

select * from players;

insert into
    players (name, number, position)
VALUES (
        'Tomas Satoransky',
        13,
        'Guard'
    );