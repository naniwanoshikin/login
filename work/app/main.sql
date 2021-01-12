CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  uname varchar(64),
  email varchar(191) unique,
  pass varchar(191),
  PRIMARY KEY (id)
);

SHOW tables;

DESCRIBE users;

INSERT INTO users (uname, email, pass) VALUES ("aa", "ddd", "dbb");

SELECT * FROM users;