CREATE DATABASE IF NOT EXISTS neurocode_db;
USE neurocode_db;

CREATE TABLE perdoruesit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    fjalekalimi VARCHAR(255) NOT NULL,
    roli ENUM('admin', 'perdorues') DEFAULT 'perdorues',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE klientet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefoni VARCHAR(30),
    kompania VARCHAR(100),
    krijuar_nga INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (krijuar_nga) REFERENCES perdoruesit(id) ON DELETE SET NULL
);

CREATE TABLE projektet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    klienti_id INT NOT NULL,
    titulli VARCHAR(150) NOT NULL,
    pershkrimi TEXT,
    afati DATE,
    statusi ENUM('ne_pritje', 'ne_proces', 'perfunduar') DEFAULT 'ne_pritje',
    prioriteti ENUM('ulet', 'mesem', 'larte') DEFAULT 'mesem',
    buxheti DECIMAL(10,2),
    fajlli VARCHAR(255),
    krijuar_nga INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (klienti_id) REFERENCES klientet(id) ON DELETE CASCADE,
    FOREIGN KEY (krijuar_nga) REFERENCES perdoruesit(id) ON DELETE SET NULL
);

CREATE TABLE mesazhet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    mesazhi TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
