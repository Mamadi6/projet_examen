-- Création de la base de données
CREATE DATABASE IF NOT EXISTS ecommerce_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ecommerce_db;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(25) NOT NULL,
    prenom VARCHAR(20),
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    adresse TEXT,
    telephone VARCHAR(20),
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB;

-- Table des catégories d'articles
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
)ENGINE=InnoDB;

-- Table des produits
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    category_id INT,
    image_url VARCHAR(255),
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
)ENGINE=InnoDB;

-- Table des commandes
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en attente', 'en cours', 'livrée', 'annulée') DEFAULT 'en attente',
    total_montant DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB;

-- Table des articles dans une commande
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
)ENGINE=InnoDB;

-- Table du panier temporaire
CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
)ENGINE=InnoDB;

-- Table des factures
CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    date_facture DATETIME DEFAULT CURRENT_TIMESTAMP,
    file_url VARCHAR(255),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
)ENGINE=InnoDB;