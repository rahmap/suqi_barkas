-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Agu 2021 pada 08.48
-- Versi server: 8.0.25
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suqi_barkas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Superadmin', 'superadmin@gmail.com', '$2y$10$3FCtM40vmgm3uVE0XLedEeHWU9eze9eg3msDYdOEMJ.R4nzIKYtbG', 'superadmin'),
(2, 'Admin Baru', 'admin@gmail.com', '$2y$10$3FCtM40vmgm3uVE0XLedEeHWU9eze9eg3msDYdOEMJ.R4nzIKYtbG', 'admin'),
(3, 'Halu Ya', 'halu@gmail.com', '$2y$10$cmdsRRIzsS5SQFv7ya8Nse1Ip/IPdMTWTBPP19X2DVmaZRzLbHmzq', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `slug`, `is_active`) VALUES
(1, 'Meja', 'meja', 1),
(2, 'Paketan', 'paketan', 1),
(4, 'Kursi', 'kursi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` int UNSIGNED NOT NULL,
  `diskon` tinyint UNSIGNED NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint UNSIGNED NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_tambahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_location` text COLLATE utf8mb4_unicode_ci,
  `kategori_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `admin_id` int UNSIGNED DEFAULT NULL,
  `is_active` tinyint DEFAULT '2',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `diskon`, `nama`, `slug`, `harga`, `keterangan`, `gambar`, `gambar_tambahan`, `produk_location`, `kategori_id`, `user_id`, `admin_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'Meja Belajar', 'meja-belajar-0Tr2', 100000, '<p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Meja adalah sebuah mebel atau perabotan yang memiliki permukaan datar dan kaki-kaki sebagai penyangga, yang bentuk dan fungsinya bermacam-macam. </span></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Meja digunakan untuk menaruh barang atau makanan. Meja umumnya dipasangkan dengan kursi atau bangku.</span><br></p>', 'W2qrgLWTqVUnqnxUMobYuT3gqXLZfAQy5g0uZSnj.jpg', 'm6kbYDTB2vzYzt4YzVPV6mPP4JrcNDcvYXXvIrKb.png', NULL, 1, 2, 1, 1, '2021-07-27 07:30:58', '2021-08-04 10:31:49', '2021-08-04 10:31:49'),
(2, 0, 'Paket Kamar Kost Kecil', 'paket-kamar-kost-kecil-NAKy', 300000, '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'P6tDtzXRMLghAi8PC7PFiCpczcgbfcFGHggWelbm.jpg', 'Sdk7HMRczJQIgA6tcCahqxRPJXhX0eWc76O7IlMb.jpg', NULL, 2, 2, 1, 1, '2021-07-27 08:59:10', '2021-08-04 10:45:28', NULL),
(3, 0, 'Kursi Goyang', 'kursi-goyang-QHMI', 50000, '<pre class=\"lang-php s-code-block\" style=\"margin-bottom: 0px; padding: 12px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 1.30769; font-family: var(--ff-mono); font-size: 13px; vertical-align: baseline; box-sizing: inherit; width: auto; max-height: 600px; background-color: var(--highlight-bg); border-radius: 5px; color: var(--highlight-color); overflow-wrap: normal;\"><code class=\"hljs language-php\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; font-size: 13px; vertical-align: baseline; box-sizing: inherit; background-color: transparent; white-space: inherit;\"><span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">foreach</span>(<span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$mentors</span> <span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">as</span> <span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$mentor</span>)\r\n    @<span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">if</span>(<span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$mentor</span>-&gt;intern-&gt;count() &gt; <span class=\"hljs-number\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-namespace);\">0</span>)\r\n    @<span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">foreach</span>(<span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$mentor</span>-&gt;intern <span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">as</span> <span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$intern</span>)\r\n        &lt;tr <span class=\"hljs-class\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit;\"><span class=\"hljs-keyword\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-keyword);\">class</span>=\"<span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">table</span>-<span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">row</span>-<span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">link</span>\" <span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">data</span>-<span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">href</span>=\"/<span class=\"hljs-title\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-literal);\">werknemer</span>/</span>{!! <span class=\"hljs-variable\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">$intern</span>-&gt;employee-&gt;EmployeeId !!}<span class=\"hljs-string\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-variable);\">\"&gt;\r\n            &lt;td&gt;{{ <span class=\"hljs-subst\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-color);\">$intern</span>-&gt;employee-&gt;FirstName }}&lt;/td&gt;\r\n            &lt;td&gt;{{  <span class=\"hljs-subst\" style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: inherit; color: var(--highlight-color);\">$intern</span>-&gt;employee-&gt;LastName }}&lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    @endforeach\r\n    @else\r\n        Mentor don\'t have any intern\r\n    @endif\r\n@endforeach</span></code></pre>', 'oggYuUVL30MaE2JNYxiRqwQsI6liXV3vm5C6vKI4.jpg', 'KJouB6t1isN2NFOJLhWAQsIpmX6yoXUNKZPmyp5F.jpg', NULL, NULL, 2, 1, 1, '2021-07-27 09:25:43', '2021-07-28 08:21:02', NULL),
(4, 6, 'Set Kursi Gayming', 'set-kursi-gayming-qHhx', 700000, '<p><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.15008px; text-align: center;\">We create applications usable in over 100 languages. We are currently building 5 new apps which are useful tools for your every day work. If you would like to use our services or have an idea to build and have us put it on our website, reach out at the link below.</span></p><h3 class=\"MuiTypography-root jss172 MuiTypography-h3\" style=\"box-sizing: inherit; margin-right: 0px; margin-left: 0px; color: rgb(57, 73, 171); font-size: 32px; font-family: Roboto, Helvetica, Arial, sans-serif; line-height: 1.167; letter-spacing: 0em; text-align: center;\">About Us</h3><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1rem; font-family: Roboto, Helvetica, Arial, sans-serif; line-height: 1.5; letter-spacing: 0.00938em; color: rgba(0, 0, 0, 0.87); text-align: center;\">We believe that anyone should be able to use technological necessities. Our way of making that happen is by building simple applications which can be used in a variety of languages. Although our main focus is language based applications, we are in the process of building tools for everyday use cases. Have an idea for an application that might be useful in many other languages other than english? Feel free to reach out to us, we would love to hear from you!</p><p><br></p>', 'SX0BdNVzobe9Y9EZGvDowRH5U2CzXxCtwIjvEt0h.png', 'v3r0tfwAEQhG5TUg1gqHXk18J4icpGvzICf2SPv4.jpg', NULL, 2, 3, 1, 1, '2021-07-28 08:18:57', '2021-07-28 08:21:32', NULL),
(5, 0, 'Kursi Untuk Manjat Pagar', 'kursi-untuk-manjat-pagar-W8y4', 90000, '<h1 id=\"cc61\" class=\"ij ik dk bn il im in hk io ip iq ho ir is it iu iv iw ix iy iz ja jb jc jd je eh\" data-selectable-paragraph=\"\" style=\"box-sizing: inherit; margin: 1.95em 0px -0.28em; font-family: sohne, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(41, 41, 41); line-height: 36px; font-size: 30px;\">Model Binding (Explicit)</h1><p id=\"840b\" class=\"hf hg dk hh b hi jf hk hl hm jg ho hp hq jh hs ht hu ji hw hx hy jj ia ib ic dc eh\" data-selectable-paragraph=\"\" style=\"box-sizing: inherit; margin: 0.86em 0px -0.46em; word-break: break-word; color: rgb(41, 41, 41); line-height: 32px; letter-spacing: -0.003em; font-family: charter, Georgia, Cambria, &quot;Times New Roman&quot;, Times, serif; font-size: 21px;\">Jika pada contoh di atas menggunakan implicit binding, contoh berikutnya adalah explicit binding. Cara ini sedikit lebih merepotkan dibanding dengan implicit binding. Karena kita harus mendaftarkannya pada berkas&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">app\\Providers\\RouteServiceProvider.php</code>.</p>', 'cS7EcMEquGDBOBBXeDcF3JRI4GDYitrLZGDsf4wj.jpg', 'pJKqIaAgfx99M5VDM5bV9YwzG1AIfBIeXTOkSRQ3.jpg', NULL, NULL, 1, NULL, 1, '2021-07-29 08:37:49', '2021-07-29 08:37:49', NULL),
(6, 8, 'Meja Raja King Kong', 'meja-raja-king-kong-Khc0', 80000, '<p id=\"b9bf\" class=\"hf hg dk hh b hi hj hk hl hm hn ho hp hq hr hs ht hu hv hw hx hy hz ia ib ic dc eh\" data-selectable-paragraph=\"\" style=\"box-sizing: inherit; margin: 2em 0px -0.46em; word-break: break-word; color: rgb(41, 41, 41); line-height: 32px; letter-spacing: -0.003em; font-family: charter, Georgia, Cambria, &quot;Times New Roman&quot;, Times, serif; font-size: 21px;\">Perhatikan pada&nbsp;<a href=\"http://php.net/manual/en/functions.anonymous.php\" class=\"bt id\" rel=\"noopener nofollow\" style=\"box-sizing: inherit; color: inherit; text-decoration-line: underline; -webkit-tap-highlight-color: transparent;\">anonymous function</a>&nbsp;di atas. Saya menambahkan dependecy injection berupa model user, alih-alih menggunakan parameter&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">id</code>.</p><p id=\"a2f5\" class=\"hf hg dk hh b hi hj hk hl hm hn ho hp hq hr hs ht hu hv hw hx hy hz ia ib ic dc eh\" data-selectable-paragraph=\"\" style=\"box-sizing: inherit; margin: 2em 0px -0.46em; word-break: break-word; color: rgb(41, 41, 41); line-height: 32px; letter-spacing: -0.003em; font-family: charter, Georgia, Cambria, &quot;Times New Roman&quot;, Times, serif; font-size: 21px;\">Di belakang layar, Laravel otomatis melakukan pencarian ke tabel user berdasarkan parameter&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">id</code>&nbsp;yang tertera pada URI.</p><p id=\"c8d2\" class=\"hf hg dk hh b hi hj hk hl hm hn ho hp hq hr hs ht hu hv hw hx hy hz ia ib ic dc eh\" data-selectable-paragraph=\"\" style=\"box-sizing: inherit; margin: 2em 0px -0.46em; word-break: break-word; color: rgb(41, 41, 41); line-height: 32px; letter-spacing: -0.003em; font-family: charter, Georgia, Cambria, &quot;Times New Roman&quot;, Times, serif; font-size: 21px;\">Bagaimana jika saya ingin menggunakan parameter&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">username</code>&nbsp;dibandingkan dengan parameter&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">id</code>? Semisal, URI-nya berbentuk&nbsp;<code class=\"ie if ig ih ii b\" style=\"box-sizing: inherit; background-color: rgb(242, 242, 242); padding: 2px 4px; font-size: 15.75px; font-family: Menlo, Monaco, &quot;Courier New&quot;, Courier, monospace;\">user/profile/laravel</code>.</p>', 'aPUmTFzptKnt52s9QhdDjNfonALWQXW3bU00wtxI.jpg', 'q81UeFu0bVVboMgKNBLwL5AcGbcnFXN2MCBr3Ya9.jpg', NULL, NULL, 1, NULL, 1, '2021-07-29 08:40:44', '2021-07-29 08:40:44', NULL),
(7, 0, 'Xiaomi Mi 10 Pro', 'xiaomi-mi-10-pro-5o8w', 100000, '<p>halo adhasklhdkla sdaskld hnasklhd kalshd</p>', 'ZdrktDrDQwT4G8hOQp2XLRfN2EVWmKNuZ7GPAOVr.jpg', 'TF3tqMr85jQK7AJRbmODiKM39LmWR8HRAwSFWLAe.jpg', NULL, 1, 2, 1, 1, '2021-08-04 10:40:55', '2021-08-04 10:41:38', NULL),
(8, 0, 'Test Lokasi', 'test-lokasi-LMQ9', 60000, '<p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Real-time trade and investing ideas on ChemoCentryx, Inc. CCXI from the largest community of traders and investors.&nbsp;</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Real-time trade and investing ideas on ChemoCentryx, Inc. CCXI from the largest community of traders and investors.</span><br></p>', 'A348a6nnP3SCUYywERUJZPL3x1NsD6lQzqv1R31n.jpg', 'ecxh9sfE616w3PwFO6ZqCxnfMevrxdYI6hbuFIRf.jpg', 'Jineman, Turi', 4, 5, 1, 1, '2021-08-08 01:20:08', '2021-08-08 01:43:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `phone`, `provinsi`, `kabupaten`, `location`, `is_active`, `created_at`) VALUES
(1, 'Rahma Andita Purnama', 'test@gmail.com', '$2y$10$/gFHdTxUPVcsSXvqtw4hf.UzZsr07rNH3d9MOPwXbpTnUGX55JV1m', '6289669413260', 'DI Yogyakarta', 'Sleman', NULL, 1, '2021-07-25 10:13:23'),
(2, 'Suqi Barkas', 'suqi@gmail.com', '$2y$10$aAYMcDdS2wBv42BrKghkEOxULg1G.CqUWHZ2e9TzQBz4mNEcn0YDO', '628982002040', 'DI Yogyakarta', 'Sleman', NULL, 1, '2021-07-26 08:43:20'),
(3, 'Allia', 'suqi12@gmail.com', '$2y$10$aAYMcDdS2wBv42BrKghkEOxULg1G.CqUWHZ2e9TzQBz4mNEcn0YDO', '628982002045', 'DI Yogyakarta', 'Bantul', NULL, 1, '2021-07-26 08:43:20'),
(4, 'Test Bug', 'bug@gmail.com', '$2y$10$nRxhQ1X4xHIz8mK6cxuboeNif6Nk.DaQXGNWQlWyZvuVDo3tuA4jy', '62982002045', 'DKI Jakarta', 'Jakarta Barat', NULL, 1, '2021-08-04 10:05:49'),
(5, 'Rahmap', 'superadmin@gmail.com', '$2y$10$QxOpFDD1VcTCmazzECvQEucHGLlHNs5MoaUJMFfrIYgHtPJVMGVQO', '62898432834', 'Maluku', 'Buru', 'Jineman RT/RW 004/006, Girikerto, Turi Jaya', 1, '2021-08-07 23:31:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produks_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
