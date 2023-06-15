-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.24-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table indonesia.provinsis
CREATE TABLE IF NOT EXISTS `provinsis` (
  `id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel indonesia.provinsis: ~34 rows (lebih kurang)
DELETE FROM `provinsis`;
INSERT INTO `provinsis` (`id`, `name`) VALUES
	('11', 'ACEH'),
	('12', 'SUMATERA UTARA'),
	('13', 'SUMATERA BARAT'),
	('14', 'RIAU'),
	('15', 'JAMBI'),
	('16', 'SUMATERA SELATAN'),
	('17', 'BENGKULU'),
	('18', 'LAMPUNG'),
	('19', 'KEPULAUAN BANGKA BELITUNG'),
	('21', 'KEPULAUAN RIAU'),
	('31', 'DKI JAKARTA'),
	('32', 'JAWA BARAT'),
	('33', 'JAWA TENGAH'),
	('34', 'DI YOGYAKARTA'),
	('35', 'JAWA TIMUR'),
	('36', 'BANTEN'),
	('51', 'BALI'),
	('52', 'NUSA TENGGARA BARAT'),
	('53', 'NUSA TENGGARA TIMUR'),
	('61', 'KALIMANTAN BARAT'),
	('62', 'KALIMANTAN TENGAH'),
	('63', 'KALIMANTAN SELATAN'),
	('64', 'KALIMANTAN TIMUR'),
	('65', 'KALIMANTAN UTARA'),
	('71', 'SULAWESI UTARA'),
	('72', 'SULAWESI TENGAH'),
	('73', 'SULAWESI SELATAN'),
	('74', 'SULAWESI TENGGARA'),
	('75', 'GORONTALO'),
	('76', 'SULAWESI BARAT'),
	('81', 'MALUKU'),
	('82', 'MALUKU UTARA'),
	('91', 'PAPUA BARAT'),
	('94', 'PAPUA');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
