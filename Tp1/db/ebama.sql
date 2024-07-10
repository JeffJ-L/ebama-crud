-- DB for École des Beaux-arts de Montréal (EBAMA)



USE e2396650;

CREATE TABLE cours (
    id INT AUTO_INCREMENT,
    title VARCHAR(40) NOT NULL,
    description TEXT,
    duration INT NOT NULL, -- Duration in hours
    PRIMARY KEY (id)
);

INSERT INTO cours (title, description, duration, level) VALUES
('Rococo 201', 'Introduction to rococo art, including the origins of Rococo art .', 40, 'Beginner'),
('The renaissance 101', 'An overview of the art of the renaissance.', 60, 'Intermediate'),
('Art comtempory 101', 'An introduction to the art of the 20th century.', 50, 'Beginner');


CREATE TABLE etudiant (
    id INT AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    address VARCHAR(40),
    phone VARCHAR(20),
    zip_code VARCHAR(10),
    email VARCHAR(40),
    cours VARCHAR(100),
    PRIMARY KEY (id)
);

INSERT INTO etudiant (name, address, phone, zip_code, email, cours) VALUES
('John Doe', '123 Main St', '123-456-7890', '12345', 'john@example.com', 'Art comtempory 101'),
('Jane Smith', '456 Elm St', '987-654-3210', '67890', 'jane@example.com', 'Rococo 201'),
('Alice Johnson', '789 Oak St', '555-123-4567', '54321', 'alice@example.com', 'The renaissance 101');


CREATE TABLE produits (
    id INT AUTO_INCREMENT ,
    name VARCHAR(40) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    PRIMARY KEY (id)
)

INSERT INTO produits (name, description, price, stock) VALUES
('Pecil', 'Soft and flexible writing pen.', 9.99, 10),
('Sketchbook', 'High-quality drawing and sketching paper.', 29.99, 25),
('Drawing kit', 'Includes a variety of drawing materials.', 199.99, 50);


CREATE TABLE prof (
    id INT AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    department VARCHAR(40),
    email VARCHAR(40) UNIQUE,
    phone VARCHAR(20),
    PRIMARY KEY (id)
);

INSERT INTO prof (name, department, email, phone) VALUES
('John Watson', 'Art comtempory 101', 'john.watson@example.com', '123-456-7890'),
('Emma Brown', 'Rococo 201', 'emma.brown@example.com', '987-654-3210'),
('Olivia Wilson', 'The renaissance 101', 'olivia.wilson@example.com', '555-123-4567');

