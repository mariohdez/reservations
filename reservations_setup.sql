DROP DATABASE IF EXISTS reservations;
CREATE DATABASE reservations;
USE reservations
CREATE TABLE jetskis (
    jetski_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE users (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128),
    password VARCHAR(255)
);

CREATE TABLE users_jetskis (
    user_id INT references users (user_id),
    jetski_id INT references jetskis (jetski_id) ,
    reservation_date DATE

);


INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);
INSERT INTO jetskis VALUES (NULL);

INSERT INTO users VALUES (NULL, 'coolkid420', 'password');
SELECT @user := LAST_INSERT_ID();
INSERT INTO users_jetskis VALUES (@user, 1, now());
INSERT INTO users VALUES (NULL, 'ladiesman', 'password');
SELECT @user := LAST_INSERT_ID();
INSERT INTO users_jetskis VALUES (@user, 2, now());

