use PlaneEdu;
CREATE TABLE users (
    id NVARCHAR(50) DEFAULT ('USER-' + CAST(NEWID() AS NVARCHAR(36))) PRIMARY KEY,
    account_name NVARCHAR(50) NOT NULL UNIQUE,
    gmail NVARCHAR(255) NOT NULL UNIQUE,
    password NVARCHAR(255) NOT NULL,
    first_name NVARCHAR(50),
    middle_name NVARCHAR(50),
    last_name NVARCHAR(50)
);


USE PlaneEdu;
INSERT INTO users (account_name, gmail, password, first_name, middle_name, last_name)
VALUES 
('johndoe', 'johndoe@gmail.com', 'password123', 'John', 'Michael', 'Doe'),
('janedoe', 'janedoe@gmail.com', 'password456', 'Jane', NULL, 'Doe'),
('alexsmith', 'alexsmith@gmail.com', 'password789', 'Alex', 'David', 'Smith');

SELECT * 
FROM users;

DROP TABLE users;
