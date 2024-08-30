-- DB for École des Beaux-arts de Montréal (EBAMA)
--DB revisé à partir du diagram faite dans Workbench



USE e2396650;

CREATE TABLE cours (
    cid INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    duration INT,
    level VARCHAR(50)
);


INSERT INTO cours (title, description, duration, level) VALUES
('Rococo 201', 'Introduction to rococo art, including the origins of Rococo art .', 40, 'Beginner'),
('The renaissance 101', 'An overview of the art of the renaissance.', 60, 'Intermediate'),
('Art comtempory 101', 'An introduction to the art of the 20th century.', 50, 'Beginner');


CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    address VARCHAR(40),
    phone VARCHAR(20),
    zip_code VARCHAR(10),
    email VARCHAR(40),
    cours_suivi VARCHAR(45)
);


INSERT INTO etudiant (name, address, phone, zip_code, email, cours_suivi) VALUES
('John Doe', '123 Main St', '123-456-7890', '12345', 'john@example.com', 'Art comtempory 101'),
('Jane Smith', '456 Elm St', '987-654-3210', '67890', 'jane@example.com', 'Rococo 201'),
('Alice Johnson', '789 Oak St', '555-123-4567', '54321', 'alice@example.com', 'The renaissance 101');


CREATE TABLE groupe (
    gid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
);

INSERT INTO groupe (name, description) VALUES
('582-31B-MA', 'Groupe etudiant les oeuvres de la renaissance'),
('582-32B-MA', 'Groupe etudiant les oeuvres contemp');


CREATE TABLE prof (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    department VARCHAR(40),
    email VARCHAR(40),
    phone VARCHAR(20)
);


INSERT INTO prof (name, department, email, phone) VALUES
('John Watson', 'Art', 'john.watson@example.com', '123-456-7890'),
('Emma Brown', 'Art', 'emma.brown@example.com', '987-654-3210'),
('Olivia Wilson', 'Art', 'olivia.wilson@example.com', '555-123-4567');


CREATE TABLE groupe_has_cours (
    groupe_gid INT,
    cours_cid INT,
    prof_pid INT,
    PRIMARY KEY (groupe_gid, cours_cid),
    FOREIGN KEY (groupe_gid) REFERENCES groupe(gid),
    FOREIGN KEY (cours_cid) REFERENCES cours(cid),
    FOREIGN KEY (prof_pid) REFERENCES prof(pid)
);

INSERT INTO groupe_has_cours (groupe_gid, cours_cid, prof_pid) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 3, 3);


CREATE TABLE etudiant_has_groupe_has_cours (
    etudiant_id INT,
    groupe_has_cours_groupe_gid INT,
    groupe_has_cours_cid INT,
    PRIMARY KEY (etudiant_id, groupe_has_cours_groupe_gid, groupe_has_cours_cid),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
    FOREIGN KEY (groupe_has_cours_groupe_gid, groupe_has_cours_cid) 
        REFERENCES groupe_has_cours(groupe_gid, cours_cid)
);


CREATE TABLE privilege (
    id INT AUTO_INCREMENT PRIMARY KEY,
    privilege VARCHAR(50) NOT NULL
);

INSERT INTO privilege (privilege) VALUES ('Teacher');
INSERT INTO privilege (privilege) VALUES ('Student');
INSERT INTO privilege (privilege) VALUES('Admin');


CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    privilege_id INT NOT NULL,
    image VARCHAR(15),
    CONSTRAINT fk_privilege_id FOREIGN KEY (privilege_id) REFERENCES privilege(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

