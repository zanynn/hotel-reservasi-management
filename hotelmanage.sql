-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Apr 2022 pada 05.02
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelmanage`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `image` varchar(200) NOT NULL,
  `video` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `body`, `image`, `video`) VALUES
(1, 'Wisma kami memiliki beberapa kelebihan khususnya dari lokasi yang sangat dekat dengan beberapa lokasi wisata pantai, dive/snorkling spot, lokasi konservasi, pasar ikan segar, dan wahana apung yang ada di dekat wisma.', 'public/images/WzSF0LxdGwgi7kajcQDQ1ec7mvzdlMHMz2poUha0.jpeg', 'https://www.youtube.com/watch?v=uy4fArvRfDA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_food`
--

CREATE TABLE `category_food` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `category_food`
--

INSERT INTO `category_food` (`id`, `name`) VALUES
(1, 'Mains'),
(2, 'Desserts'),
(3, 'Drinks');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_room`
--

CREATE TABLE `category_room` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category_wisma` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `category_room`
--

INSERT INTO `category_room` (`id`, `name`, `image`, `price`, `description`, `category_wisma`) VALUES
(1, 'Standar Room', 'public/images/mrH0gMtjq28KRRmS6SckiJEUntNPk0mZeBSeiK2H.jpeg', '150000', 'Twin Bed', 2),
(2, 'Exclusive Room', 'public/images/OKoGczndJcbLKxQHEA9deFOHeRMdbBBqZDTy4xB4.jpeg', '250000', 'Double Bed', 2),
(3, 'Private Room', 'public/images/IXmtwCgk0lgsaodZxLjkLe7LhgRnCsgMX0izfxbq.jpeg', '120000', 'Double Bed, Full AC, Kamar Mandi Dalam', 1),
(4, 'Standard', 'public/images/EjfmEdWEVmTlw1NZv9PT61BlJ3uG2K9JLMbVvYNv.jpeg', '30000', 'Kamar Barak, Kipas Angin, Loker Barang dengan kapasitas 4 dan 9 orang', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `description`
--

CREATE TABLE `description` (
  `id` int(11) NOT NULL,
  `room` varchar(1000) NOT NULL,
  `photo` varchar(1000) NOT NULL,
  `menu` varchar(1000) NOT NULL,
  `event` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `description`
--

INSERT INTO `description` (`id`, `room`, `photo`, `menu`, `event`) VALUES
(1, 'Wisma ini memiliki beberapa kamar yang luas dan mewah berstandar Hotel. Kamar Standard, dan Exclusive. Dengan staf staf resepsi yang sopan, perhatian dan berpengalaman.', 'Ikuti tur hotel dengan foto-foto super berkilauan yang diambil oleh para tamu yang bersenang-senang tinggal di sini.', 'Wisma kami menyediakan layanan makanan yang bekerja sama dengan usaha masyarakat lokal guna meningkatkan kesejahteraan bersama.', 'Letak kami yang strategis dekat dengan tempat-tempat wisata pantai yang terkenal di Kabupaten Malang, dan dapat anda akses dengan mudah karena pantai – pantai tersebut sudah terhubung oleh Jalur Lintas Selatan (JLS).   Namun tetap kami himbau bagi para wisatawan, bahwa Pulau Sempu bukan tempat wisata! Masuk secara illegal di kawasan Cagar Alam adalah perbuatan yang melanggar hukum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `details_bill`
--

CREATE TABLE `details_bill` (
  `id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `idReservation` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `details_bill`
--

INSERT INTO `details_bill` (`id`, `content`, `price`, `idReservation`, `created_at`, `updated_at`) VALUES
(3, 'Tiền phòng', '360', 16, NULL, NULL),
(4, 'Tiền phòng', '1320', 17, NULL, NULL),
(5, 'Tiền phòng', '810', 19, '2019-10-28', '2019-10-28'),
(6, 'Tiền phòng', '0', 21, '2022-01-13', '2022-01-13'),
(9, 'Tiền phòng', '150000', 23, '2022-02-03', '2022-02-03'),
(10, 'Biaya ruangan', '0', 24, '2022-02-03', '2022-02-03'),
(11, 'Biaya ruangan', '900000', 25, '2022-02-03', '2022-02-03'),
(12, 'Penyewaan Selimut', '25000', 25, '2022-02-03', '2022-02-03'),
(13, 'Biaya ruangan', '120000', 26, '2022-02-04', '2022-02-04'),
(14, 'Penyewaan Selimut', '90000', 26, '2022-02-04', '2022-02-04'),
(15, 'Biaya ruangan', '120000', 27, '2022-02-04', '2022-02-04'),
(16, 'Biaya ruangan', '120000', 28, '2022-02-04', '2022-02-04'),
(17, 'Penyewaan Selimut', '500000', 28, '2022-02-04', '2022-02-04'),
(18, 'Biaya ruangan', '250000', 29, '2022-02-05', '2022-02-04'),
(19, 'Biaya ruangan', '240000', 30, '2022-02-04', '2022-02-04'),
(20, 'Penyewaan Selimut', '20000', 30, '2022-02-04', '2022-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `name`, `body`, `image`, `created_at`) VALUES
(3, 'Wisata Alam', 'Mulai dari Pantai Berpasir Putih hingga Hijaunya Hutan Mangrove. Jelajahi keindahan alam disekitar kami dan kenali kearifan lokal masyarakat setempat. Namun ingat, Cagar Alam Sempu bukan tempat wisata!', 'public/images/hnGy10XZGyla0W3jQNNmmVJWHdtuwtutMp7edKMe.jpeg', '2019-04-02 13:19:04'),
(4, 'Wisata Aktivitas Air', 'Kurang puas menjelajahi daratan?, coba jelajahi keindahan dunia bawah laut disekitar kami. Atau ingin sekedar berkeliling dan menikmati pemandangan dari kapal?', 'public/images/OVLYksP0OUGCBZv2WVlgylqusJmnAJDyHMr90GmM.jpeg', '2019-04-02 13:19:04'),
(5, 'Wisata Kuliner Pesisir', 'Ingin mencoba Ikan Bakar? Cumi Asam Manis? Temukan cita rasa kuliner pesisir terbaik dari kedai – kedai tradisional yang ada disekitar kami.', 'public/images/L0ZJyrJibSyxQ082Tf6PInu4OL3H2Ku8tmOGXAT8.jpeg', '2019-04-02 13:19:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` varchar(200) NOT NULL,
  `idCategory` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `food`
--

INSERT INTO `food` (`id`, `name`, `description`, `price`, `idCategory`) VALUES
(1, 'Nasi Goreng', 'Nasi dengan Topping Sosis dan Telur Mata Sapi', '15000', 1),
(2, 'Nasi Pecel', 'Nasi dengan dilengkapi sayuran dan lauk tahu tempe', '12000', 1),
(3, 'Ikan Bakar', 'Dilengkapi dengan nasi sambal dan lalapan', '150000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slogan` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `information`
--

INSERT INTO `information` (`id`, `name`, `slogan`, `email`, `phone_number`, `address`) VALUES
(0, 'Guest House', 'A Best Place To Stay', 'wismapondokdadap@gmail.com', '+62 82 177 873 584', 'UPT PPP Pondokdadap  Dsn. Sendang Biru, Ds. Tambakrejo, Kec. Sumbermanjing Wetan, Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `DateIn` datetime NOT NULL,
  `DateOut` datetime NOT NULL,
  `Numbers` int(11) NOT NULL,
  `Notes` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `reservation`
--

INSERT INTO `reservation` (`id`, `idRoom`, `name`, `phone`, `email`, `DateIn`, `DateOut`, `Numbers`, `Notes`) VALUES
(28, 18, 'Zanynn Goose', '089666930901', 'oioi@gmail.com', '2022-02-05 00:00:00', '2022-02-06 00:00:00', 1, NULL),
(29, 16, 'Fauzan', '089666930901', 'zanynngoose@gmai.com', '2022-02-04 00:00:00', '2022-02-05 00:00:00', 2, 'Tambahan Selimut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `author` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `body` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id`, `author`, `image`, `body`) VALUES
(1, 'Tấn Duy', 'images/person_1.jpg', 'Khách sạn tuy được xây dựng lâu, tuy nhiên, khá sạch sẽ. Diện tích phòng lớn, giá cả hợp lý.'),
(2, 'Phương Duy', 'images/person_2.jpg', 'Phòng no smoking mà ngập tràn mùi thuốc lá. Khi yêu cầu đổi phòng có cửa sổ thì tính thêm phí 40usd một đêm. Ăn sáng thì đưa cho khách sữa chua đã hết hạn hơn 5 ngày.'),
(3, 'Văn Vinh', 'images/person_3.jpg', 'Địa điểm là tốt. Bên cạnh sự thuận tiện của sông. Phòng lớn. Giá là rất tốt đẹp.'),
(4, 'Thế Vĩ', 'images/person_1.jpg', 'Bữa sáng nghèo nàn so với 1 khách sạn 3 sao trung tâm. Phòng nhỏ, chật chội, nội thất cũ kĩ và không có cửa sổ.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `room`
--

INSERT INTO `room` (`id`, `name`, `idCategory`, `Status`) VALUES
(14, 'Lemadang', 1, 1),
(15, 'Marlin', 1, 1),
(16, 'Cakalang', 2, 1),
(17, 'Tuna', 2, 1),
(18, 'AB Albakor 01', 3, 1),
(19, 'AB Albakor 02', 3, 1),
(20, 'AB Lemuru 01 SD', 4, 1),
(21, 'AB Lemuru 02 SD', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `caption` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `slide`
--

INSERT INTO `slide` (`id`, `link`, `caption`) VALUES
(1, 'public/images/BMSlfTFNYG3ugvJcvJyuOonJooXt8QdEIKGxKy16.jpeg', 'Lemadang 101'),
(2, 'public/images/9PdCo3abuW6dwoHP6lc3juEUApuoNSBbxuIps7YV.jpeg', 'Wisma Madidihang'),
(3, 'public/images/rSoAqkYsWtcoocz8G4uZGUNlipysd38xNXRkY2BS.webp', 'Pondok Dadap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(2, 'admin', '$2y$10$i2ZTIQc.O1U2r0kGcUip0eoh3jLd9v1Mu1JmvaE.95yv34p3kFNzS');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category_food`
--
ALTER TABLE `category_food`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category_room`
--
ALTER TABLE `category_room`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `details_bill`
--
ALTER TABLE `details_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reservation` (`idReservation`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CategoryFood` (`idCategory`);

--
-- Indeks untuk tabel `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Room` (`idRoom`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CategoryRooms` (`idCategory`);

--
-- Indeks untuk tabel `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category_room`
--
ALTER TABLE `category_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `details_bill`
--
ALTER TABLE `details_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `FK_CategoryFood` FOREIGN KEY (`idCategory`) REFERENCES `category_food` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
