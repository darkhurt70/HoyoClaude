-- Base de données pour l'application Mihoyo Collection
-- Auteur : Projet TP Base de données
-- Date : 2025

-- Crée la base de données
CREATE DATABASE IF NOT EXISTS mihoyo_collection CHARACTER SET utf8 COLLATE utf8_general_ci;

USE mihoyo_collection;

-- Table ELEMENT
CREATE TABLE IF NOT EXISTS ELEMENT (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table ORIGIN
CREATE TABLE IF NOT EXISTS ORIGIN (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table UNITCLASS
CREATE TABLE IF NOT EXISTS UNITCLASS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table PERSONNAGE
CREATE TABLE IF NOT EXISTS PERSONNAGE (
    id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    element INT NOT NULL,
    unitclass INT NOT NULL,
    origin INT,
    rarity INT NOT NULL,
    url_img VARCHAR(500) NOT NULL,
    FOREIGN KEY (element) REFERENCES ELEMENT(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (unitclass) REFERENCES UNITCLASS(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (origin) REFERENCES ORIGIN(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table USERS
CREATE TABLE IF NOT EXISTS USERS (
    id VARCHAR(50) PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    hash_pwd VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertion de données de test pour ELEMENT (Genshin Impact)
INSERT INTO ELEMENT (name, url_img) VALUES
('Pyro', 'https://static.wikia.nocookie.net/gensin-impact/images/2/2c/Element_Pyro.svg'),
('Hydro', 'https://static.wikia.nocookie.net/gensin-impact/images/8/80/Element_Hydro.svg'),
('Anemo', 'https://static.wikia.nocookie.net/gensin-impact/images/1/10/Element_Anemo.svg'),
('Electro', 'https://static.wikia.nocookie.net/gensin-impact/images/f/ff/Element_Electro.svg'),
('Cryo', 'https://static.wikia.nocookie.net/gensin-impact/images/7/72/Element_Cryo.svg'),
('Geo', 'https://static.wikia.nocookie.net/gensin-impact/images/9/9b/Element_Geo.svg'),
('Dendro', 'https://static.wikia.nocookie.net/gensin-impact/images/7/73/Element_Dendro.svg');

-- Insertion de données de test pour ORIGIN (Genshin Impact)
INSERT INTO ORIGIN (name, url_img) VALUES
('Mondstadt', 'https://static.wikia.nocookie.net/gensin-impact/images/a/a4/Mondstadt_Icon.png'),
('Liyue', 'https://static.wikia.nocookie.net/gensin-impact/images/5/5a/Liyue_Icon.png'),
('Inazuma', 'https://static.wikia.nocookie.net/gensin-impact/images/b/b7/Inazuma_Icon.png'),
('Sumeru', 'https://static.wikia.nocookie.net/gensin-impact/images/c/cf/Sumeru_Icon.png'),
('Fontaine', 'https://static.wikia.nocookie.net/gensin-impact/images/3/31/Fontaine_Icon.png'),
('Natlan', 'https://static.wikia.nocookie.net/gensin-impact/images/e/e5/Natlan_Icon.png'),
('Snezhnaya', 'https://static.wikia.nocookie.net/gensin-impact/images/7/72/Snezhnaya_Icon.png');

-- Insertion de données de test pour UNITCLASS (Genshin Impact)
INSERT INTO UNITCLASS (name, url_img) VALUES
('Sword', 'https://static.wikia.nocookie.net/gensin-impact/images/9/95/Weapon-class-sword-icon.png'),
('Claymore', 'https://static.wikia.nocookie.net/gensin-impact/images/5/51/Weapon-class-claymore-icon.png'),
('Polearm', 'https://static.wikia.nocookie.net/gensin-impact/images/9/91/Weapon-class-polearm-icon.png'),
('Bow', 'https://static.wikia.nocookie.net/gensin-impact/images/9/97/Weapon-class-bow-icon.png'),
('Catalyst', 'https://static.wikia.nocookie.net/gensin-impact/images/0/02/Weapon-class-catalyst-icon.png');

-- Insertion d'utilisateurs de test
-- Mot de passe pour 'admin' : admin
-- Mot de passe pour 'test' : test
INSERT INTO USERS (id, username, hash_pwd) VALUES
('user001', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('user002', 'test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insertion de personnages de test
INSERT INTO PERSONNAGE (id, name, element, unitclass, rarity, origin, url_img) VALUES
('perso001', 'Diluc', 1, 2, 5, 1, 'https://static.wikia.nocookie.net/gensin-impact/images/3/30/Character_Diluc_Card.jpg'),
('perso002', 'Hu Tao', 1, 3, 5, 2, 'https://static.wikia.nocookie.net/gensin-impact/images/c/c6/Character_Hu_Tao_Card.jpg'),
('perso003', 'Raiden Shogun', 4, 3, 5, 3, 'https://static.wikia.nocookie.net/gensin-impact/images/8/8b/Character_Raiden_Shogun_Card.jpg'),
('perso004', 'Nahida', 7, 5, 5, 4, 'https://static.wikia.nocookie.net/gensin-impact/images/4/42/Character_Nahida_Card.jpg'),
('perso005', 'Furina', 2, 1, 5, 5, 'https://static.wikia.nocookie.net/gensin-impact/images/1/1c/Character_Furina_Card.jpg');
