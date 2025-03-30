-- Membuat Database
CREATE DATABASE nintendo;
USE nintendo;

-- Membuat Tabel games
CREATE TABLE games (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price INT(11) NOT NULL,
    img VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- Mengisi Data Awal ke Tabel Users
INSERT INTO games (name, description, price, img) VALUES
('Zelda Breath Of The Wild', 'The Legend of Zelda: Breath of the Wild adalah game petualangan yang dikembangkan dan diterbitkan oleh Nintendo untuk konsol Nintendo Switch.
Game ini adalah game terbaru dalam seri The Legend of Zelda dan dirilis pada tanggal 3 Maret 2017.
Game ini diakui sebagai salah satu game terbaik sepanjang masa dan memenangkan banyak penghargaan, termasuk "Game of the Year" di The Game Awards 2017.',
999000, 'https://www.tendoku.com/wp-content/uploads/2023/02/The-Legend-of-Zelda-Breath-of-the-Wild-switch-nsp-xci-768x432.jpg'),
('Pokemon Legend Arceus', 'Pokémon Legends: Arceus adalah game RPG yang dikembangkan dan diterbitkan oleh The Pokémon Company untuk konsol Nintendo Switch.
Game ini dijadwalkan rilis pada tanggal 28 Januari 2022 dan merupakan game Pokémon generasi ke-8.
Dalam game ini, para pemain akan memulai petualangan mereka sebagai pelatih Pokémon dan menjelajahi wilayah Hisui, sebuah wilayah baru yang terinspirasi oleh wilayah Jepang Kuno.',
699000, 'https://www.tendoku.com/wp-content/uploads/2023/03/Pokemon-Legends-Arceus-switch-nsp-xci-768x432.jpg');