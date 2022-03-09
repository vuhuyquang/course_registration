-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 09, 2022 lúc 04:28 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qldt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemsos`
--

CREATE TABLE `diemsos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mon_hoc_id` int(11) NOT NULL,
  `sinh_vien_id` int(11) NOT NULL,
  `giang_vien_id` int(11) NOT NULL,
  `danh_gia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chuyen_can` double NOT NULL,
  `giua_ky` double NOT NULL,
  `cuoi_ky` double NOT NULL,
  `diem_tong_ket` double NOT NULL,
  `diem_chu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangviens`
--

CREATE TABLE `giangviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_giang_vien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trinh_do` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `mat_khau` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `que_quan` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangviens`
--

INSERT INTO `giangviens` (`id`, `ma_giang_vien`, `ho_ten`, `trinh_do`, `khoa_id`, `mat_khau`, `ngay_sinh`, `gioi_tinh`, `que_quan`, `email`, `so_dien_thoai`, `quyen`, `created_at`, `updated_at`) VALUES
(1, 'LECTHT0001', 'Phạm Đức Anh', 'Thạc sĩ', 4, '25d55ad283aa400af464c76d713c07ad', '1989-04-19', 'Nam', 'Thanh Xuân, Hà Nội', 'anhpd@utt.edu.vn', '0987654321', 'teacher', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hockys`
--

CREATE TABLE `hockys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_hoc_ky` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Đóng đăng ký',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hockys`
--

INSERT INTO `hockys` (`id`, `ma_hoc_ky`, `mo_ta`, `trang_thai`, `created_at`, `updated_at`) VALUES
(3, '2021_2022_1', 'Học kỳ 1 năm học 2021 - 2022', 'Đóng đăng ký', '2022-03-08 20:22:32', '2022-03-08 20:22:32'),
(4, '2021_2022_2', 'Học kỳ 2 năm học 2021 - 2022', 'Đóng đăng ký', '2022-03-08 20:22:54', '2022-03-09 05:26:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahocs`
--

CREATE TABLE `khoahocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_khoa_hoc` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoahocs`
--

INSERT INTO `khoahocs` (`id`, `ma_khoa_hoc`, `mo_ta`, `created_at`, `updated_at`) VALUES
(1, 'K69DHCQ', 'Khóa 69 hệ đại học', '2022-03-09 05:22:56', '2022-03-09 05:22:56'),
(2, 'K70DHCQ', 'Khóa 70 hệ đại học', '2022-03-09 05:23:12', '2022-03-09 05:23:12'),
(3, 'K71DHCQ', 'Khóa 71 hệ đại học', '2022-03-09 05:23:27', '2022-03-09 05:24:03'),
(4, 'K72DHCQ', 'Khóa 72 hệ đại học', '2022-03-09 05:23:51', '2022-03-09 05:23:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoas`
--

CREATE TABLE `khoas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_khoa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_khoa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoas`
--

INSERT INTO `khoas` (`id`, `ma_khoa`, `ten_khoa`, `created_at`, `updated_at`) VALUES
(4, 'CNTT', 'Công nghệ thông tin', '2022-03-09 05:21:30', '2022-03-09 05:21:30'),
(5, 'KT', 'Kinh tế', '2022-03-09 05:21:36', '2022-03-09 05:21:36'),
(6, 'CT', 'Công trình', '2022-03-09 05:21:45', '2022-03-09 05:21:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophocs`
--

CREATE TABLE `lophocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_lop` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `khoa_hoc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lophocs`
--

INSERT INTO `lophocs` (`id`, `ma_lop`, `khoa_id`, `khoa_hoc_id`, `created_at`, `updated_at`) VALUES
(1, '69DCTT23', 4, 1, '2022-03-09 05:24:36', '2022-03-09 05:24:36'),
(2, '69DCTT22', 4, 1, '2022-03-09 05:24:56', '2022-03-09 05:24:56'),
(3, '69DCTT21', 4, 1, '2022-03-09 05:25:10', '2022-03-09 05:25:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2019_08_19_000000_create_failed_jobs_table', 1),
(32, '2022_03_04_022341_create_diemsos_table', 1),
(33, '2022_03_04_022433_create_giangviens_table', 1),
(34, '2022_03_04_022523_create_hockys_table', 1),
(35, '2022_03_04_022657_create_khoas_table', 1),
(36, '2022_03_04_022718_create_khoahocs_table', 1),
(37, '2022_03_04_022736_create_lophocs_table', 1),
(38, '2022_03_04_022835_create_monhocs_table', 1),
(39, '2022_03_04_022932_create_quantriviens_table', 1),
(40, '2022_03_04_023008_create_sinhviens_table', 1),
(41, '2022_03_04_023029_create_svdks_table', 1),
(42, '2022_03_04_023107_create_tintucs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhocs`
--

CREATE TABLE `monhocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_mon_hoc` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `ten_mon_hoc` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_tin_chi` int(11) NOT NULL,
  `hoc_phi` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhocs`
--

INSERT INTO `monhocs` (`id`, `ma_mon_hoc`, `khoa_id`, `ten_mon_hoc`, `so_tin_chi`, `hoc_phi`, `created_at`, `updated_at`) VALUES
(1, 'DC2HT20', 4, 'Ngôn ngữ lập trình C', 3, 1170000, NULL, NULL),
(2, 'DC2HT21', 4, 'Nhập môn cơ sở dữ liệu', 3, 1170000, NULL, '2022-03-09 07:28:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantriviens`
--

CREATE TABLE `quantriviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_quan_tri_vien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trinh_do` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `don_vi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `que_quan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhviens`
--

CREATE TABLE `sinhviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_sinh_vien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_hoc_id` int(11) NOT NULL,
  `lop_hoc_id` int(11) NOT NULL,
  `mat_khau` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `que_quan` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `svdks`
--

CREATE TABLE `svdks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mon_hoc_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sinh_vien_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giang_vien_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lich_hoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_diem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thoi_gian_dk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintucs`
--

CREATE TABLE `tintucs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung_ngan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hình_anh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duong_dan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_dang` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `diemsos`
--
ALTER TABLE `diemsos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `giangviens`
--
ALTER TABLE `giangviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giangviens_ma_giang_vien_unique` (`ma_giang_vien`),
  ADD UNIQUE KEY `giangviens_email_unique` (`email`),
  ADD UNIQUE KEY `giangviens_so_dien_thoai_unique` (`so_dien_thoai`);

--
-- Chỉ mục cho bảng `hockys`
--
ALTER TABLE `hockys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hockys_ma_hoc_ky_unique` (`ma_hoc_ky`);

--
-- Chỉ mục cho bảng `khoahocs`
--
ALTER TABLE `khoahocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khoahocs_ma_khoa_hoc_unique` (`ma_khoa_hoc`);

--
-- Chỉ mục cho bảng `khoas`
--
ALTER TABLE `khoas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khoas_ma_khoa_unique` (`ma_khoa`);

--
-- Chỉ mục cho bảng `lophocs`
--
ALTER TABLE `lophocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lophocs_ma_lop_unique` (`ma_lop`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `monhocs`
--
ALTER TABLE `monhocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monhocs_ma_mon_hoc_unique` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `quantriviens`
--
ALTER TABLE `quantriviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quantriviens_ma_quan_tri_vien_unique` (`ma_quan_tri_vien`),
  ADD UNIQUE KEY `quantriviens_email_unique` (`email`),
  ADD UNIQUE KEY `quantriviens_so_dien_thoai_unique` (`so_dien_thoai`);

--
-- Chỉ mục cho bảng `sinhviens`
--
ALTER TABLE `sinhviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sinhviens_ma_sinh_vien_unique` (`ma_sinh_vien`),
  ADD UNIQUE KEY `sinhviens_email_unique` (`email`);

--
-- Chỉ mục cho bảng `svdks`
--
ALTER TABLE `svdks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tintucs`
--
ALTER TABLE `tintucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `diemsos`
--
ALTER TABLE `diemsos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giangviens`
--
ALTER TABLE `giangviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hockys`
--
ALTER TABLE `hockys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `khoahocs`
--
ALTER TABLE `khoahocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khoas`
--
ALTER TABLE `khoas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `lophocs`
--
ALTER TABLE `lophocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `monhocs`
--
ALTER TABLE `monhocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `quantriviens`
--
ALTER TABLE `quantriviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sinhviens`
--
ALTER TABLE `sinhviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `svdks`
--
ALTER TABLE `svdks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tintucs`
--
ALTER TABLE `tintucs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
