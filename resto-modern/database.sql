CREATE DATABASE restoran_modern;
USE restoran_modern;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
);

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(100),
    deskripsi TEXT,
    harga INT,
    kategori VARCHAR(50),
    gambar VARCHAR(255)
);

INSERT INTO admin (username, password) 
VALUES ('admin', MD5('12345'));