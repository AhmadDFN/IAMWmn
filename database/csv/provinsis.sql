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

-- membuang struktur untuk table iamwmdn.perusahaans
DROP TABLE IF EXISTS `perusahaans`;
CREATE TABLE IF NOT EXISTS `perusahaans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `perusahaan_nm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_notelp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_cp_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perusahaan_cp_notelp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel iamwmdn.perusahaans: ~51 rows (lebih kurang)
DELETE FROM `perusahaans`;
INSERT INTO `perusahaans` (`id`, `perusahaan_nm`, `perusahaan_alamat`, `perusahaan_kota`, `perusahaan_notelp`, `perusahaan_email`, `perusahaan_website`, `perusahaan_cp_nama`, `perusahaan_cp_notelp`, `created_at`, `updated_at`) VALUES
	(1, 'PT Terpadu Japan', 'Ki. Urip Sumoharjo No. 737, Pekalongan 45554, Jateng', 'KOTA JAMBI', '(+62) 535 1025 1145', 'kezia01@kurniawan.ac.id', 'PTTerpadu.com', 'Juli Rahmi Uyainah M.Kom.', '+434329584605', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(2, 'PT Barokah Group', 'Kpg. Baranang Siang No. 381, Kupang 78935, Riau', 'KOTA LUBUKLINGGAU', '0653 3448 7416', 'qwinarno@situmorang.web.id', 'PTBarokah.com', 'Tantri Sudiati', '+25377829490', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(3, 'PT Terpadu Mitsubishi', 'Gg. Basudewo No. 603, Prabumulih 19333, Sumut', 'KOTA BATAM', '0539 1052 747', 'fathonah19@maulana.net', 'PTTerpadu.com', 'Ani Zulaika S.Sos', '+96553822916', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(4, 'CV Terdepan Mitsubishi', 'Psr. Muwardi No. 583, Administrasi Jakarta Pusat 38239, Aceh', 'KOTA PEKANBARU', '0713 8116 732', 'kamaria.riyanti@safitri.co.id', 'CVTerdepan.com', 'Gawati Nasyidah', '+22896203917', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(5, 'PT Pernaugan Group', 'Dk. Baranang Siang Indah No. 781, Sawahlunto 71866, Kaltim', 'KOTA TEBING TINGGI', '025 5215 573', 'nadia.prasetya@aryani.my.id', 'PTPernaugan.com', 'Pandu Megantara', '+6806672942', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(6, 'CV Persatuan Persero', 'Jln. Bahagia No. 158, Palangka Raya 47058, Kalbar', 'KOTA BINJAI', '(+62) 641 6417 2391', 'qsaefullah@hassanah.ac.id', 'CVPersatuan.com', 'Jatmiko Edi Simbolon', '+35693850188', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(7, 'PT Terpadu Pergerakan', 'Ki. Fajar No. 69, Semarang 13525, Sulbar', 'KOTA KOTAMOBAGU', '(+62) 373 1303 3286', 'rina.mayasari@setiawan.co.id', 'PTTerpadu.com', 'Amalia Permata', '+9778858560662', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(8, 'CV Terpadu Mitsubishi', 'Gg. Basudewo No. 884, Sabang 53444, DIY', 'KOTA PAYAKUMBUH', '0940 3475 789', 'rahimah.tania@ardianto.sch.id', 'CVTerpadu.com', 'Darimin Haryanto', '+423888054126', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(9, 'CV Barokah Persero', 'Jln. Raden Saleh No. 77, Tangerang 54978, Lampung', 'KOTA TIDORE KEPULAUAN', '(+62) 862 4981 906', 'uli.hassanah@prastuti.my.id', 'CVBarokah.com', 'Yuliana Yuliana Melani S.E.I', '+852524813462', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(10, 'CV Persatuan Persero', 'Jln. Samanhudi No. 323, Probolinggo 57739, Jatim', 'KOTA TIDORE KEPULAUAN', '0708 5397 6155', 'tantri.prabowo@astuti.my.id', 'CVPersatuan.com', 'Zahra Jamalia Hasanah', '+979518508580', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(11, 'PT Persatuan Group', 'Psr. Yosodipuro No. 793, Blitar 78114, Sulut', 'KOTA TANJUNG PINANG', '0338 9357 6276', 'septi.hardiansyah@prasetyo.ac.id', 'PTPersatuan.com', 'Mutia Novitasari', '+23689735467', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(12, 'PT Pernaugan Japan', 'Dk. Basudewo No. 918, Kediri 15618, Banten', 'KOTA PEKANBARU', '(+62) 358 4125 382', 'napitupulu.danuja@safitri.biz', 'PTPernaugan.com', 'Cinta Nasyiah S.I.Kom', '+355005485490', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(13, 'CV Pernaugan Group', 'Dk. Basoka Raya No. 241, Tangerang 42144, Bali', 'KOTA TARAKAN', '(+62) 340 2493 255', 'halimah.elvin@halimah.ac.id', 'CVPernaugan.com', 'Bakiono Mansur', '+261659632353', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(14, 'PT Terdepan Mitsubishi', 'Ki. Bah Jaya No. 657, Pariaman 15477, Maluku', 'KOTA MALANG', '(+62) 728 7341 952', 'nadia.setiawan@hutagalung.my.id', 'PTTerdepan.com', 'Rahayu Usada', '+819147243772', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(15, 'PT Terpadu Japan', 'Jr. Uluwatu No. 421, Madiun 22881, Papua', 'KOTA SOLOK', '0551 5338 6097', 'slamet06@prayoga.biz', 'PTTerpadu.com', 'Dewi Suryatmi', '+423891672719', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(16, 'CV Persatuan Japan', 'Ds. Basudewo No. 649, Bukittinggi 29072, Jatim', 'KOTA PONTIANAK', '(+62) 488 3890 3951', 'praba.simanjuntak@pratama.ac.id', 'CVPersatuan.com', 'Gandewa Hidayanto', '+6772378178', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(17, 'PT Terpadu Persero', 'Ds. Bass No. 865, Surakarta 32305, DIY', 'KOTA BATU', '(+62) 414 1416 0096', 'fwidiastuti@pratiwi.or.id', 'PTTerpadu.com', 'Ratih Laksmiwati', '+37097611551', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(18, 'CV Pernaugan Pergerakan', 'Jr. Sutami No. 658, Langsa 57738, Maluku', 'KOTA ADMINISTRASI JAKARTA UTARA', '(+62) 633 7125 2243', 'salimah33@novitasari.co', 'CVPernaugan.com', 'Amalia Halimah S.Pt', '+387602957783', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(19, 'CV Terpadu Mitsubishi', 'Kpg. Ki Hajar Dewantara No. 254, Malang 28748, Jabar', 'KOTA TIDORE KEPULAUAN', '(+62) 862 0214 9208', 'padma11@tarihoran.or.id', 'CVTerpadu.com', 'Rusman Manullang', '+436168678197', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(20, 'PT Terdepan Pergerakan', 'Psr. Bagonwoto  No. 687, Banjar 28657, Bali', 'KOTA SUBULUSSALAM', '0389 8113 881', 'anastasia15@sudiati.go.id', 'PTTerdepan.com', 'Ulva Tania Halimah', '+6853816422509', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(21, 'PT Pernaugan Persero', 'Jr. Adisucipto No. 712, Semarang 65014, NTT', 'KOTA SUNGAI PENUH', '0642 0743 053', 'bagiya51@winarno.or.id', 'PTPernaugan.com', 'Lidya Maryati', '+11731983152', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(22, 'PT Terdepan Group', 'Psr. Yoga No. 607, Gorontalo 54904, Aceh', 'KOTA BATU', '0969 0834 075', 'bkuswoyo@prasetya.biz', 'PTTerdepan.com', 'Prasetyo Ardianto S.H.', '+59990422565', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(23, 'PT Terpadu Pergerakan', 'Gg. Orang No. 504, Depok 55749, Jatim', 'KOTA ADMINISTRASI JAKARTA PUSAT', '0879 3458 7164', 'eka.januar@utama.name', 'PTTerpadu.com', 'Cemeti Megantara', '+843692715184', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(24, 'CV Persatuan Pergerakan', 'Gg. Otto No. 219, Banda Aceh 32665, DIY', 'KOTA PADANGSIDEMPUAN', '(+62) 554 0791 8054', 'purwanti.rudi@nainggolan.ac.id', 'CVPersatuan.com', 'Dirja Saputra', '+440200073099', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(25, 'PT Pernaugan Mitsubishi', 'Jln. Jambu No. 944, Yogyakarta 37723, Kaltara', 'KOTA SURABAYA', '0876 3736 6771', 'laswi97@prasetya.asia', 'PTPernaugan.com', 'Ridwan Karman Napitupulu M.M.', '+6902039246', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(26, 'CV Barokah Persero', 'Ki. Pattimura No. 906, Bukittinggi 50984, Gorontalo', 'KOTA MATARAM', '0353 3773 574', 'utami.emas@prasasta.org', 'CVBarokah.com', 'Hartana Cakrabuana Narpati', '+93482484722', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(27, 'PT Barokah Pergerakan', 'Jln. Jend. Sudirman No. 812, Ternate 89866, Papua', 'KOTA KEDIRI', '(+62) 999 0645 9433', 'shania96@sirait.sch.id', 'PTBarokah.com', 'Dirja Gaduh Kuswoyo S.Pt', '+6775814184', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(28, 'PT Persatuan Mitsubishi', 'Jln. Gardujati No. 478, Balikpapan 43298, Jatim', 'KOTA PALEMBANG', '(+62) 306 9264 3858', 'rizki60@dabukke.biz', 'PTPersatuan.com', 'Tirta Waluyo', '+256148847910', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(29, 'CV Terpadu Persero', 'Ds. Sutoyo No. 646, Bekasi 49237, Jateng', 'KOTA MOJOKERTO', '0870 3336 4968', 'umay74@wulandari.mil.id', 'CVTerpadu.com', 'Paramita Safitri', '+6910634987', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(30, 'CV Terdepan Japan', 'Gg. Urip Sumoharjo No. 76, Kediri 12164, Papua', 'KOTA TUAL', '(+62) 398 4670 877', 'rachel44@gunarto.id', 'CVTerdepan.com', 'Dalima Hartati M.Kom.', '+22915540229', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(31, 'CV Terdepan Group', 'Ds. Basuki Rahmat  No. 500, Tegal 96913, Banten', 'KOTA BAU-BAU', '0658 2114 612', 'fmarbun@sudiati.name', 'CVTerdepan.com', 'Galih Kamal Prakasa', '+6908058424', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(32, 'CV Persatuan Pergerakan', 'Ki. Laswi No. 162, Mataram 35707, Kaltim', 'KOTA TANJUNGBALAI', '(+62) 990 8986 860', 'muni11@wijaya.or.id', 'CVPersatuan.com', 'Taufik Tampubolon', '+6741720688', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(33, 'CV Terdepan Persero', 'Psr. Wora Wari No. 656, Kotamobagu 10331, Kalsel', 'KOTA PALANGKA RAYA', '(+62) 447 9191 612', 'kariman62@mahendra.my.id', 'CVTerdepan.com', 'Prasetya Pranowo', '+570818770494', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(34, 'CV Persatuan Group', 'Gg. Gedebage Selatan No. 40, Batam 22630, Sumsel', 'KOTA METRO', '0274 6062 1942', 'tri09@winarsih.my.id', 'CVPersatuan.com', 'Raden Rajata', '+5010461715', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(35, 'PT Persatuan Pergerakan', 'Ki. Asia Afrika No. 16, Lhokseumawe 53344, Bengkulu', 'KOTA BLITAR', '(+62) 838 458 408', 'balamantri.usamah@anggriawan.co.id', 'PTPersatuan.com', 'Cakrawala Prasasta S.Psi', '+590247345202', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(36, 'PT Persatuan Group', 'Kpg. Yos No. 469, Lhokseumawe 42124, NTT', 'KOTA GUNUNGSITOLI', '0778 4700 878', 'prabowo.najam@siregar.org', 'PTPersatuan.com', 'Hana Nuraini', '+249349352972', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(37, 'PT Barokah Japan', 'Kpg. Kebangkitan Nasional No. 739, Medan 51476, Aceh', 'KOTA TOMOHON', '0832 582 339', 'knatsir@riyanti.my.id', 'PTBarokah.com', 'Oni Rini Rahayu', '+376541536736', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(38, 'CV Terdepan Japan', 'Ds. Diponegoro No. 298, Palopo 27178, Kaltim', 'KOTA MAKASSAR', '(+62) 982 0638 945', 'tari.haryanti@rajasa.web.id', 'CVTerdepan.com', 'Farhunnisa Yuniar', '+881853454991', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(39, 'PT Pernaugan Pergerakan', 'Dk. Ciumbuleuit No. 427, Blitar 40699, Maluku', 'KOTA DUMAI', '0697 9891 7623', 'damar61@wulandari.biz', 'PTPernaugan.com', 'Mustofa Banawi Prabowo M.Pd', '+26670669766', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(40, 'PT Pernaugan Group', 'Dk. Rajawali Timur No. 464, Batam 23384, DKI', 'KOTA AMBON', '0347 6649 3764', 'dono.novitasari@widodo.ac.id', 'PTPernaugan.com', 'Suci Amalia Kuswandari S.Psi', '+6784964252', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(41, 'PT Barokah Persero', 'Gg. Uluwatu No. 580, Denpasar 40400, Bengkulu', 'KOTA SUBULUSSALAM', '0778 1991 028', 'gamblang.ardianto@budiman.sch.id', 'PTBarokah.com', 'Winda Violet Haryanti', '+575332129156', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(42, 'CV Persatuan Pergerakan', 'Jr. Baing No. 76, Batu 60232, Kepri', 'KOTA ADMINISTRASI JAKARTA PUSAT', '0858 851 461', 'tpertiwi@anggraini.or.id', 'CVPersatuan.com', 'Ina Melinda Rahimah', '+22205075922', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(43, 'CV Terdepan Pergerakan', 'Ds. Jamika No. 933, Tomohon 27282, Jateng', 'KOTA SOLOK', '0518 2348 4682', 'sudiati.asirwanda@widodo.biz', 'CVTerdepan.com', 'Gawati Nurdiyanti', '+3585899416183', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(44, 'CV Pernaugan Pergerakan', 'Ki. Jambu No. 567, Semarang 19004, Papua', 'KOTA TANJUNG PINANG', '0649 0833 914', 'zdongoran@hasanah.name', 'CVPernaugan.com', 'Irfan Galur Simanjuntak', '+626055431982', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(45, 'CV Terpadu Mitsubishi', 'Psr. Orang No. 227, Pariaman 39373, Jateng', 'KOTA MEDAN', '(+62) 989 3323 179', 'usamah.rahmi@nasyidah.my.id', 'CVTerpadu.com', 'Paramita Titin Mulyani', '+88836236554177', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(46, 'CV Persatuan Group', 'Jln. Suprapto No. 458, Sawahlunto 76123, DIY', 'KOTA PARIAMAN', '0863 330 532', 'cinta.wibowo@wahyudin.in', 'CVPersatuan.com', 'Waluyo Pranowo', '+37100231047', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(47, 'CV Terpadu Pergerakan', 'Ds. Krakatau No. 931, Balikpapan 45116, Sulsel', 'KOTA SIBOLGA', '(+62) 22 5111 777', 'umi22@permata.in', 'CVTerpadu.com', 'Victoria Patricia Laksita', '+97391007224', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(48, 'CV Barokah Group', 'Jln. Setiabudhi No. 275, Surabaya 70609, Bali', 'KOTA TANJUNGBALAI', '(+62) 390 3517 373', 'prasetya40@hakim.web.id', 'CVBarokah.com', 'Tami Vanesa Puspasari', '+996863571132', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(49, 'CV Terpadu Group', 'Jr. Cemara No. 171, Administrasi Jakarta Selatan 98398, Sumut', 'KOTA MAKASSAR', '0868 560 854', 'ina79@padmasari.my.id', 'CVTerpadu.com', 'Tiara Tantri Susanti', '+594912028373', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(50, 'CV Barokah Persero', 'Ki. Panjaitan No. 233, Tanjung Pinang 92038, Jabar', 'KOTA BANDA ACEH', '(+62) 734 2540 244', 'yolanda.tari@puspasari.net', 'CVBarokah.com', 'Prayitna Situmorang S.IP', '+96500393601', '2023-06-13 02:28:01', '2023-06-13 02:28:01'),
	(51, 'PT_Cikarang', 'JL. Perumnas roro lor No 18 Perkutut', 'KOTA Cikarang', '0351 757315', 'pt_cikarang@gmail.com', 'Cikarangable.com', 'Mr. Yukanto', '0810548464684', '2023-06-13 02:30:07', '2023-06-13 02:30:07');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
