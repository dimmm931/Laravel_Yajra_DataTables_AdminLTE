-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 09 2021 г., 19:03
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravelx_abz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abz_employees`
--

CREATE TABLE `abz_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'employee Last/First name',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'empolyee photo',
  `rank_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Rank Id from table {abz_ranks} (ForeignKey)',
  `superior_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Superior Id from this same table itself {abz_employees} (ForeignKey)',
  `salary` decimal(6,2) NOT NULL COMMENT 'Salary',
  `hired_at` date NOT NULL COMMENT 'date when was hired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `abz_employees`
--

INSERT INTO `abz_employees` (`id`, `name`, `email`, `username`, `phone`, `dob`, `image`, `rank_id`, `superior_id`, `salary`, `hired_at`, `created_at`, `updated_at`) VALUES
(1, 'Maia Denesik', 'maryjane19@yahoo.com', 'kkozey', '+1.543.404.0263', '2006-09-20', '7c216495b9a38a3c7291ca7b714371b0.png', 3, 58, '2002.00', '2021-01-10', NULL, NULL),
(2, 'Carolyne Fritsch', 'wvon@macejkovic.org', 'hayley.mertz', '603-613-6799', '2013-02-11', 'cb6492a12b42528e668bd28d6b775afb.png', 3, 42, '2824.00', '2021-01-18', NULL, NULL),
(3, 'Prof. Marian Feeney', 'uswaniawski@hotmail.com', 'goyette.matteo', '446.582.1773', '1994-01-26', '3db90b4584c4eca27f7ea2e452d7cca3.png', 3, 42, '2553.00', '2021-01-08', NULL, NULL),
(4, 'Taya Williamson', 'dmayer@hotmail.com', 'llewellyn.larson', '(589) 696-0896', '1978-09-28', 'a4176b19511a981c8673afc5902f5d80.png', 4, 43, '4063.00', '2021-01-10', NULL, NULL),
(5, 'Novella Rosenbaum', 'burdette11@prosacco.com', 'kfeest', '408.718.1848', '1975-06-05', '287540788d70cf454afe5b05cf1139b9.png', 3, 15, '4264.00', '2021-01-05', NULL, NULL),
(6, 'Eulah Sanford', 'vdenesik@yahoo.com', 'toy.darren', '+1 (902) 476-3092', '2008-01-01', '52e2c289b879b22b4adc7ba352b432e7.png', 3, 51, '2914.00', '2021-01-14', NULL, NULL),
(7, 'Ms. Shea Hermiston IV', 'valerie.rodriguez@spencer.com', 'vicenta.cassin', '+1.637.292.3942', '2019-10-14', '93e9d493090b9f0eb30778db17d394bc.png', 5, 56, '2976.00', '2021-02-02', NULL, NULL),
(8, 'Sally Rice', 'retta39@gmail.com', 'betsy01', '1-339-355-1694', '1990-01-26', '0ce2779fe05153dc749699daef1a901f.png', 4, 55, '2784.00', '2021-01-17', NULL, NULL),
(9, 'Mabelle Reinger', 'alexane.ruecker@prohaska.com', 'bnader', '+1 (265) 849-9345', '2011-06-03', '8af393a5f4d0d735d2474d509db7a5e5.png', 1, 7, '4484.00', '2021-01-27', NULL, NULL),
(10, 'Isabell Schmidt', 'alene99@yahoo.com', 'hand.corrine', '228.258.0758', '2000-09-14', '65455bb12b5b1a129904e37031d5551a.png', 5, 23, '4109.00', '2021-01-28', NULL, NULL),
(11, 'Retta Mueller MD', 'wmcdermott@gmail.com', 'rkoepp', '+17942783863', '1990-01-02', '47f057e8900dbe6df14d63f6219789e7.png', 3, 42, '2095.00', '2021-02-01', NULL, NULL),
(12, 'Gia Cormier', 'pgrady@hotmail.com', 'rocky.baumbach', '414-359-9182', '2009-07-11', 'a11305655d51667cc85332ea766af376.png', 1, 37, '2506.00', '2021-01-14', NULL, NULL),
(13, 'Irma Buckridge', 'parker.reymundo@runolfsdottir.info', 'olson.cletus', '1-320-223-8151', '1986-01-17', 'a7d97def495e85b189d6ca056d9e7ea7.png', 3, 36, '3494.00', '2021-02-04', NULL, NULL),
(14, 'Lola Parker MD', 'bettye.waters@gutmann.com', 'nat.franecki', '1-305-869-8226', '2002-07-01', 'ae7902a3a01b3f7da79dc42b893c56f5.png', 3, 32, '2159.00', '2021-01-14', NULL, NULL),
(15, 'Alexandra Murphy F', 'jalyn80@cremin.net', 'jamaal.labadie', '+380975654300', '1981-12-07', '1612797067_turntable.jpg', 3, 1, '4705.00', '2021-02-03', NULL, '2021-02-08 12:11:07'),
(16, 'Leora Langosh', 'sconnelly@cassin.biz', 'armando04', '480.564.4090', '1992-05-09', '507fa568ed36bca7beceb82eeed670f3.png', 5, 52, '3094.00', '2021-02-01', NULL, NULL),
(17, 'Miss Madaline Fahey', 'eparisian@hoppe.info', 'pwiza', '(960) 876-4230', '2018-11-26', 'f61969f8c22901a014a359c5bbc8670c.png', 5, 1, '3807.00', '2021-01-19', NULL, NULL),
(18, 'Miss Rossie Luettgen V', 'eveline74@schiller.com', 'schroeder.nathen', '639.422.7169', '1992-08-30', 'a04c1b4e031f8d6fb69c33b5a98dc6a7.png', 4, 40, '4205.00', '2021-01-08', NULL, NULL),
(19, 'Christine Boyer V', 'yfranecki@hotmail.com', 'kdamore', '486.446.9391', '2001-09-15', '3fedce2e56ca6db0a3d24338f990b46c.png', 5, 8, '3363.00', '2021-01-14', NULL, NULL),
(20, 'Yoshiko Hessel', 'vskiles@hotmail.com', 'krohan', '+1 (645) 725-9114', '2011-04-19', '8112c0dd68bd11321c5903fe56f4e603.png', 5, 44, '3879.00', '2021-01-05', NULL, NULL),
(21, 'Jacquelyn Franecki', 'bkessler@hotmail.com', 'grayce57', '+1.527.475.2061', '2000-08-05', '1af5ac5435c2f602ea6f7761dc45e46b.png', 4, 16, '4223.00', '2021-01-26', NULL, NULL),
(22, 'Ms. Estelle Barrows DVM', 'cboehm@hotmail.com', 'fconnelly', '+1.764.754.9084', '1978-06-30', '1887926743e2f5455107ceb1f4439d4a.png', 3, 2, '2872.00', '2021-01-13', NULL, NULL),
(23, 'Sophie Bernhard', 'gardner.vandervort@kshlerin.com', 'ilemke', '474.420.4096', '2019-05-23', '10612bd7f8ec7e5b7eaaf838438e524d.png', 1, 40, '3327.00', '2021-01-19', NULL, NULL),
(24, 'Monique Beer', 'harber.della@beier.com', 'flatley.orland', '(919) 646-9347', '2018-06-23', '3d9db89c0060370df8233ad451f7a766.png', 5, 2, '3126.00', '2021-01-25', NULL, NULL),
(25, 'Alba Jast F', 'bwelch@gmail.com', 'kling.dixie', '+380975653340', '1977-01-25', '1612882110_cphhh.jpeg', 3, 1, '3011.00', '2021-01-14', NULL, '2021-02-09 11:48:30'),
(26, 'Maiya Hills', 'erdman.danial@yahoo.com', 'calista.monahan', '+1-914-249-2729', '1995-10-10', 'c373f2c8188f95e0ebf0e20601ff07ea.png', 1, 23, '4308.00', '2021-01-12', NULL, NULL),
(27, 'Ms. Vita Tremblay Sr.', 'ywaelchi@gerlach.com', 'sedrick53', '1-547-918-9481', '1970-04-06', '5422600b823757eb81105f6a6ff359fc.png', 1, 43, '2012.00', '2021-01-21', NULL, NULL),
(28, 'Ocie Sporer', 'cronin.josh@hotmail.com', 'amaya.price', '(345) 410-4761', '2018-06-17', '6ade713d40e5d088c68e36a89deac758.png', 1, 53, '2342.00', '2021-01-15', NULL, NULL),
(29, 'Dr. Marianna Kautzer MD', 'eriberto.johns@gmail.com', 'clubowitz', '(524) 465-8418', '1978-12-04', '87f46977e7b642fafb426ca8e0c00195.png', 4, 46, '4239.00', '2021-01-24', NULL, NULL),
(30, 'Mozelle King', 'vlittle@hotmail.com', 'kfeeney', '507.932.2086', '1978-07-13', 'e3051f91cf78576174fc96d31fca6328.png', 1, 13, '2531.00', '2021-02-04', NULL, NULL),
(31, 'Beryl Brekke', 'maryjane15@watsica.biz', 'alexander70', '703.240.4460', '1976-05-01', '86af0a2ea5e3e7ffd1b3c1e2ed00b20f.png', 1, 47, '2847.00', '2021-01-30', NULL, NULL),
(32, 'Otha Gerlach', 'lwitting@gmail.com', 'jgoodwin', '(621) 768-5183', '1973-09-24', '952c4f34a489609bfd657d23b2522bee.png', 3, 3, '2065.00', '2021-01-28', NULL, NULL),
(33, 'Georgiana Dicki', 'green.hagenes@schmitt.com', 'reggie.crona', '649-938-2565', '2018-04-15', '9d88e2d354a0233c1859411f9a5d7a2d.png', 5, 52, '2304.00', '2021-02-05', NULL, NULL),
(35, 'Dr. Joelle Balistreri DDS', 'mckayla21@johnston.biz', 'gino.stroman', '1-251-880-8113', '1987-05-22', '0b14eb41fe883c66220776070fd8f6d5.png', 4, 57, '2482.00', '2021-01-27', NULL, NULL),
(36, 'Letitia Leuschke', 'doyle.mark@wilderman.com', 'aileen55', '+1-727-301-2125', '1977-11-25', '6423a33f212b5b2fd2da6f8581e2ad31.png', 5, 35, '2615.00', '2021-01-15', NULL, NULL),
(37, 'Paula Considine', 'sauer.merritt@gmail.com', 'gstark', '+17813539191', '2012-06-14', '3b51fa71af3b283e5c3bfe977d5bc6b8.png', 3, 31, '3393.00', '2021-02-04', NULL, NULL),
(38, 'Mayra Stanton Jr.', 'mertz.nakia@nitzsche.com', 'kathleen04', '+1 (928) 366-1458', '2010-07-28', 'f81e08a06c943ea3f97f2458a916b1fc.png', 4, 48, '4103.00', '2021-01-16', NULL, NULL),
(39, 'Gloria Smith', 'diego.hayes@yahoo.com', 'vbruen', '631-934-3835', '2009-03-07', 'e7e83239a58964a61949297a70f9cc62.png', 4, 10, '3699.00', '2021-01-16', NULL, NULL),
(40, 'Alexandria Pacocha', 'newell.harber@hotmail.com', 'billie28', '1-314-246-1401', '2012-03-15', '15b36e609d56ca434e2ad796275c63ea.png', 4, 31, '2239.00', '2021-02-02', NULL, NULL),
(41, 'Maud VonRueden', 'sadye09@fritsch.com', 'darion.kirlin', '474-740-6323', '1978-10-12', '1cc9e0516ebefdc22460683efcf4a6a2.png', 3, 59, '2657.00', '2021-01-24', NULL, NULL),
(42, 'Mrs. Jakayla West', 'huels.deangelo@mohr.com', 'ncartwright', '+1.249.245.5152', '1973-01-08', '1ff6b23038785553867dfc0f897c83f3.png', 3, 57, '2702.00', '2021-02-02', NULL, NULL),
(43, 'Samara Miller', 'mkuhn@gmail.com', 'nkoelpin', '1-968-343-4056', '2007-09-12', '2f31fdf93bdec2a8fd6b9c98f973e561.png', 3, 43, '3818.00', '2021-01-13', NULL, NULL),
(44, 'Eloise Terry', 'dare.cletus@hotmail.com', 'efranecki', '1-382-643-7685', '1976-12-17', 'a7dc1839ac701dae2926397a0b803f45.png', 4, 57, '3317.00', '2021-01-06', NULL, NULL),
(45, 'Willie Goodwin III', 'nathanael96@buckridge.net', 'aleen54', '(597) 372-0895', '2000-05-19', '98aa4c59c36f83560d65fdb5d2755d5f.png', 3, 48, '3801.00', '2021-01-31', NULL, NULL),
(46, 'Raphaelle Howe', 'gia.sawayn@hotmail.com', 'noemy.mayert', '+15205714652', '1991-06-01', 'c333530919eb1bea94363e3be25195ad.png', 3, 50, '2652.00', '2021-01-26', NULL, NULL),
(47, 'Kathryne Murazik', 'reymundo25@bernier.com', 'njaskolski', '(971) 724-9526', '1981-03-24', 'ed6b8072d3aefc526edcfae648ab45cf.png', 5, 6, '2805.00', '2021-01-31', NULL, NULL),
(48, 'Verda Wolff', 'nettie.jacobson@yahoo.com', 'timmy42', '320-795-6647', '1975-07-18', '12c62c85afe6f65a920dabc8b4b22829.png', 5, 27, '4120.00', '2021-01-09', NULL, NULL),
(49, 'Lea Balistreri', 'hintz.macey@yahoo.com', 'fprosacco', '+1-678-490-7061', '2016-06-12', 'd96dcb61bcc0ffb906907e6feccfdf41.png', 3, 54, '4753.00', '2021-01-25', NULL, NULL),
(50, 'Martina Walker', 'franecki.parker@krajcik.com', 'reilly.queen', '(257) 684-3402', '2020-08-09', 'ad3fbcf096f01ec2622a9c70267d8514.png', 3, 48, '2951.00', '2021-01-07', NULL, NULL),
(51, 'Dr. Odessa Prosacco Sr.', 'leonora84@denesik.com', 'hmraz', '686-547-9128', '1996-09-02', '91286e08728ca8e91042cb2430312cda.png', 1, 45, '4369.00', '2021-01-17', NULL, NULL),
(52, 'Naomi Gutmann', 'braun.margarette@gmail.com', 'athiel', '1-878-599-2782', '1975-09-27', 'bd2152beb4e4ca5375160481074abc22.png', 5, 28, '4669.00', '2021-01-10', NULL, NULL),
(53, 'Juliana Hirthe II', 'beier.johan@yahoo.com', 'zola.walter', '656.668.0646', '2008-03-30', 'c4b0e0f2908b58264881175c1aac8126.png', 2, 42, '3174.00', '2021-01-25', NULL, NULL),
(54, 'Asa Ankunding', 'lura41@carter.info', 'iritchie', '+1.324.954.2358', '2002-10-31', '2d3afa30bb95562fe1388bb062b3c403.png', 1, 4, '2705.00', '2021-01-14', NULL, NULL),
(55, 'Dr. Guadalupe Keeling', 'allene.veum@yahoo.com', 'tavares71', '1-642-735-3821', '2017-10-23', '97b0904e86a169c0d6e2a380af349fe8.png', 2, 41, '4661.00', '2021-01-08', NULL, NULL),
(56, 'Prof. Jena Abshire', 'elza57@gmail.com', 'daniel.kaylee', '1-275-752-8105', '2002-07-17', '81f6241932e1abc9c194f4e7c6a85ea3.png', 2, 47, '3719.00', '2021-01-30', NULL, NULL),
(57, 'Miss Annamae Kovacek', 'cstokes@yahoo.com', 'rosa.bernhard', '1-205-473-4306', '1990-06-01', '8dfe49df43d4577cc23cee189f984d1c.png', 2, 60, '4368.00', '2021-02-02', NULL, NULL),
(58, 'Miss Kariane Schmidt Sr.', 'sokon@hotmail.com', 'reta65', '415-318-1678', '1975-03-25', '14993ffef62b8c660a8ebbd03c91973b.png', 1, 23, '4588.00', '2021-01-15', NULL, NULL),
(59, 'Mrs. Alayna Beier', 'chet.auer@gmail.com', 'kcormier', '(795) 722-3921', '2016-07-28', '54dc8175ff602d6c860d36313b59961a.png', 2, 56, '4548.00', '2021-02-04', NULL, NULL),
(60, 'Augusta Jacobi I', 'dbailey@thompson.info', 'graham.khalil', '+17432011705', '1982-06-19', '7ac2ebe104c1aec25647f36da7809333.png', 1, 32, '2944.00', '2021-01-10', NULL, NULL),
(61, 'Dima', 'dimmm9@gmail.com', 'dima', '+380975654344', '1983-08-21', '1612801504_turntable.jpg', 5, 1, '9999.00', '2021-01-21', '2021-02-08 12:43:59', '2021-02-08 13:25:04'),
(62, 'Dima F', 'dimmm9@gmail.com', 'dima', '+380975654344', '1983-05-08', '1612801221_turntable.jpg', 5, 1, '9999.00', '2021-01-21', '2021-02-08 13:20:21', '2021-02-08 13:20:21'),
(63, 'Abigail Flatley Fiv', 'gfunk@koch.info', 'jberge', '+380975654344', '1983-05-08', '1612885057_cphhh.jpeg', 1, 1, '1.00', '2021-01-19', '2021-02-08 13:22:58', '2021-02-09 12:37:37');

-- --------------------------------------------------------

--
-- Структура таблицы `abz_ranks`
--

CREATE TABLE `abz_ranks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'employee rank',
  `rank_descr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'employee rank description',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `abz_ranks`
--

INSERT INTO `abz_ranks` (`id`, `rank_name`, `rank_descr`, `created_at`, `updated_at`) VALUES
(1, 'Rank1', 'Rank 1 ops', NULL, NULL),
(2, 'Rank2', 'Rank 2 ops', NULL, NULL),
(3, 'Rank3', 'Rank 3 ops', NULL, NULL),
(4, 'Rank4', 'Rank 4 ops', NULL, NULL),
(5, 'Rank5', 'Rank 5 ops. Highest', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_08_19_000000_create_failed_jobs_table', 2),
(6, '2021_02_05_135910_create_abz_ranks_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dima', 'dimmm931@gmail.com', NULL, '$2y$10$M1id/1EPWBLQnOWiev7Xa.x1r97ShUw48d4wxeSPIsMb5rDVHa34W', NULL, '2021-01-28 14:20:53', '2021-01-28 14:20:53');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abz_employees`
--
ALTER TABLE `abz_employees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `abz_ranks`
--
ALTER TABLE `abz_ranks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abz_employees`
--
ALTER TABLE `abz_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `abz_ranks`
--
ALTER TABLE `abz_ranks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
