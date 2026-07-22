SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE users (
  id int NOT NULL,
  name varchar(50) NOT NULL,
  surname varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  phone int NOT NULL,
  age int NOT NULL,
  email varchar(250) NOT NULL,
  password varchar(250) NOT NULL,
  create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

ALTER TABLE users
  MODIFY id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO users (name, surname, username, phone, age, email, password) 
VALUES ('John', 'Doe', 'johndoe', 987654321, 18, 'johndoe@email.com', 'johndoe123');

COMMIT;