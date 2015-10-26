-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2015 at 12:17 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vms_regas`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_admin`
--

CREATE TABLE IF NOT EXISTS `ms_admin` (
  `id` bigint(20) NOT NULL,
  `id_role` int(5) DEFAULT NULL COMMENT 'FK for id in tb_role',
  `id_sbu` int(5) DEFAULT NULL COMMENT 'FK for id in tb_sbu',
  `name` varchar(60) DEFAULT NULL COMMENT 'nama admin',
  `password` varchar(45) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_admin`
--

INSERT INTO `ms_admin` (`id`, `id_role`, `id_sbu`, `name`, `password`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(12, 1, 1, 'admin', 'admin', '2015-09-14 12:36:30', '2015-10-22 13:21:52', 0),
(13, 2, NULL, 'hse', 'hse', '2015-09-22 01:39:40', '2015-10-05 09:40:58', 1),
(14, 3, NULL, 'proc', 'PROC', '2015-09-23 06:16:54', '2015-10-09 06:39:41', 0),
(15, 4, NULL, 'kontrak', 'kontrak', '2015-09-24 16:45:17', NULL, 0),
(16, 3, NULL, 'peng', 'peng', '2015-09-25 01:09:16', NULL, 0),
(17, 1, NULL, 'muarif', 'lol', '2015-10-05 07:37:39', NULL, 1),
(18, 2, NULL, 'test', 'test', '2015-10-05 07:38:14', NULL, 1),
(19, 6, NULL, 'auction', 'auction', '2015-10-05 08:37:05', NULL, 0),
(20, 2, NULL, 'hse', 'hse', '2015-10-05 10:03:44', NULL, 0),
(21, 5, NULL, 'muarifgay', 'muarifgay', '2015-10-07 04:07:34', '2015-10-07 04:08:04', 1),
(22, 4, NULL, 'admindd', 'admindd', '2015-10-13 06:44:24', NULL, 0),
(23, 3, NULL, 'admindwqwdas', 'admindasdasdas', '2015-10-13 06:45:30', NULL, 1),
(24, 2, NULL, 'admindsadasdas', 'adminasdas', '2015-10-13 06:45:41', NULL, 1),
(25, 9, NULL, 'assessment', 'assessment', '2015-10-14 10:57:48', NULL, 0),
(26, 1, NULL, 'hapus coy', 'hapus coy', '2015-10-22 13:22:04', NULL, 1),
(27, 2, NULL, 'admin HSE', 'coba', '2015-10-23 03:48:27', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_agen`
--

CREATE TABLE IF NOT EXISTS `ms_agen` (
  `id` int(11) NOT NULL,
  `no` varchar(50) DEFAULT NULL,
  `issue_date` varchar(10) DEFAULT NULL,
  `principal` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `expire_date` varchar(10) DEFAULT NULL,
  `agen_file` varchar(40) DEFAULT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `data_status` int(3) DEFAULT '0',
  `data_last_check` timestamp NULL DEFAULT NULL,
  `data_checker_id` bigint(20) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_agen`
--

INSERT INTO `ms_agen` (`id`, `no`, `issue_date`, `principal`, `type`, `expire_date`, `agen_file`, `id_vendor`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, '0', '2007-10-23', 'Sony', 'Agen Tunggal', '2015-07-23', 'agen_file_231015_024013_686.pdf', 4, '2015-10-23 07:40:13', NULL, 2, '2015-10-23 08:12:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_agen_bsb`
--

CREATE TABLE IF NOT EXISTS `ms_agen_bsb` (
  `id` bigint(20) NOT NULL,
  `id_agen` bigint(20) DEFAULT NULL,
  `id_bsb` bigint(20) DEFAULT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `data_status` int(3) DEFAULT '0',
  `data_last_check` timestamp NULL DEFAULT NULL,
  `data_checker_id` bigint(20) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_agen_produk`
--

CREATE TABLE IF NOT EXISTS `ms_agen_produk` (
  `id` bigint(20) NOT NULL,
  `id_agen` bigint(20) DEFAULT NULL,
  `produk` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foreign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_akta`
--

CREATE TABLE IF NOT EXISTS `ms_akta` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `type` varchar(20) DEFAULT NULL COMMENT 'type akta, pendirian atau perubahan',
  `no` varchar(100) DEFAULT NULL COMMENT 'Nomor akta',
  `notaris` varchar(150) DEFAULT NULL COMMENT 'nama notaris',
  `issue_date` date DEFAULT NULL COMMENT 'tanggal akta',
  `akta_file` varchar(40) DEFAULT NULL COMMENT 'server path akta attachment',
  `authorize_by` varchar(200) DEFAULT NULL COMMENT 'lembaga pengesah akta',
  `authorize_no` varchar(150) DEFAULT NULL COMMENT 'nomor pengesahan akta',
  `authorize_file` varchar(40) DEFAULT NULL COMMENT 'server path pengesahan akta attachement',
  `authorize_date` timestamp NULL DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foreign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_akta`
--

INSERT INTO `ms_akta` (`id`, `id_vendor`, `type`, `no`, `notaris`, `issue_date`, `akta_file`, `authorize_by`, `authorize_no`, `authorize_file`, `authorize_date`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 5, 'pendirian', '23', 'Zarkasyi Nurdin, SH', '2008-10-23', 'akta_file_231015_104658_776.pdf', 'Departemen Hukum dan Ham', '115', 'authorize_file_231015_104658_985.pdf', '2009-12-22 17:00:00', '2015-10-23 03:46:58', '2015-10-23 03:46:58', 0, NULL, NULL, 0),
(2, 5, 'direksi', '112', 'Zarkasyi Nurdin, SH', '2010-01-03', 'akta_file_231015_104924_914.pdf', 'Departemen Hukum dan Ham', '114', 'authorize_file_231015_104924_565.pdf', '2009-03-04 17:00:00', '2015-10-23 03:49:24', '2015-10-23 03:49:24', 0, NULL, NULL, 0),
(3, 5, 'saham', '12', 'Zarkasyi Nurdin, SH', '2010-06-07', 'akta_file_231015_105155_481.pdf', 'Departemen Hukum dan Ham', '10', 'authorize_file_231015_105155_106.pdf', '2015-10-22 17:00:00', '2015-10-23 03:51:55', '2015-10-23 03:51:55', 0, NULL, NULL, 0),
(4, 4, 'pendirian', '123421180914', 'Si Doel', '1963-10-06', 'akta_file_231015_110244_524.jpg', 'menkumham', '88', 'authorize_file_231015_110244_399.jpg', '2015-10-22 17:00:00', '2015-10-23 04:02:44', '2015-10-23 04:02:44', 2, '2015-10-23 08:07:57', 1, 0),
(5, 6, 'pendirian', '123', 'amy', '2015-10-23', 'akta_file_231015_110418_557.pdf', 'dep hukum', '123', 'authorize_file_231015_110418_102.pdf', '2015-10-22 17:00:00', '2015-10-23 04:04:18', '2015-10-23 04:14:09', 0, NULL, NULL, 1),
(6, 3, 'pendirian', '1', 'a', '2015-10-23', 'akta_file_231015_111623_777.pdf', 'd', '2', 'authorize_file_231015_111623_702.pdf', '2015-10-22 17:00:00', '2015-10-23 04:16:23', '2015-10-23 04:16:23', 2, '2015-10-23 08:19:32', 1, 0),
(7, 3, 'perubahan', '3', 'f', '2015-10-31', 'akta_file_231015_111719_739.pdf', 'g', '5', 'authorize_file_231015_111719_734.pdf', '2015-10-30 17:00:00', '2015-10-23 04:17:19', '2015-10-23 04:17:19', 2, '2015-10-23 08:31:07', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_answer_hse`
--

CREATE TABLE IF NOT EXISTS `ms_answer_hse` (
  `id` int(11) NOT NULL,
  `id_question` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `value` text,
  `label` text,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_answer_hse`
--

INSERT INTO `ms_answer_hse` (`id`, `id_question`, `type`, `value`, `label`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 'text', 'Bagaimana para senior manager terlibat secara pribadi dalam manajemen K3 ?', NULL, '2015-10-14 17:43:18', '2015-10-14 17:21:40', 0),
(2, 2, 'text', 'Memberikan bukti komitment pada semua tingkat organisasi ?', NULL, '2015-10-14 17:49:18', '0000-00-00 00:00:00', 0),
(3, 3, 'text', 'Bagaimana Anda mempromosikan budaya yang positif terhadap masalah-masalah K3 ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(4, 4, 'checkbox', 'Apakah perusahaan mempunyai dokumen Kebijakan K3 ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(5, 4, 'file', 'Jika Ya, lampirkan.', 'kebijakan_k3', '2015-10-22 06:35:09', '2015-10-22 06:35:05', 0),
(6, 5, 'text', 'Siapa yang memikul tanggung jawab keseluruhan dan tanggung jawab akhir dari K3 dalam organisasi Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(7, 6, 'text', 'Jelaskan secara rinci metoda-metoda yang Anda gunakan sebagai sumber pernyataan kebijakan  kepada semua karyawan Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(8, 7, 'text', ' Pengaturan apa yang Anda punyai untuk memberitahu karyawan mengenai perubahan-perubahan kebijakan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(9, 8, 'text', 'Bagaimana keterlibatan manajemen dalam aktivitas-aktivitas K3, penetapan tujuan dan pemantauan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(10, 9, 'checkbox', 'Apakah Anda mempunyai organisasi keselamatan?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(11, 9, 'file', 'Kalau ada, tunjukkan bagan organisasi dan uraian tanggung jawab', 'bagan_organisasi_k3', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(12, 10, 'text', 'Bagaimana struktur perusahaan Anda dibuat untuk mengelola dan mengkomunikasikan K3 secara efektif ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(13, 11, 'text', 'Ketentuan apa yang dibuat perusahaan Anda untuk rapat-rapat komunikasi K3 ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(14, 12, 'checkbox', 'Apakah para manager dan pengawas di semua tingkat yang akan merencanakan, memantau, memperkirakan dan melaksanakan pekerjaan sudah menerima pelatihan formal K3 sesuai tanggung jawab mereka dalam kaitannya dengan pelaksanaan pekerjaan sesuai dengan persyaratan-persyaratan K3 ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(15, 12, 'text', 'Jika sudah, berikan rincian. Jika pelatihan diberikan in-house, jelaskan materi dan lamanya kursus.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(16, 13, 'text', 'Pengaturan apa yang telah dibuat perusahaan Anda untuk memastikan bahwa karyawan mempunyai pengetahuan tentang K3 dasar dalam industri, dan untuk menjaga agar pengetahuan tersebut selalu up to date ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(17, 14, 'text', 'Pengaturan apa yang telah dibuat perusahaan Anda untuk memastikan bahwa karyawan termasuk subkontraktor, juga memahami kebijakan dan tata cara K3 Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(18, 15, 'text', 'Pengaturan apa yang telah dibuat perusahaan anda untuk memastikan bahwa karyawan dan karyawan subkontraktor yang baru telah diberi instruksi dan menerima informasi mengenai bahaya spesifik yang timbul dari sifat pekerjaan ? Pelatihan apa yang telah Anda berikan untuk memastikan bahwa semua karyawan mengetahui semua persyaratan-persyaratan perusahaan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(19, 16, 'text', 'Pengaturan apa yang telah dibuat perusahaan Anda untuk memastikan bahwa pengetahuan K3 karyawan yang sekarang selalu up to date ? Jika pelatihan dilakukan in-house berika rincian materi pelatihan.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(20, 17, 'text', 'Bagaimana Anda telah mengidentifikasi lokasi di dalam operasi Anda di mana pelatihan khusus diperlukan untuk menghadapi bahaya yang mungkin terjadi ? Berikan daftar dan rincian dari pelatihan yang diberikan.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(21, 18, 'text', 'Jika suatu pekerjaan khusus melibatkan radioaktif, pembuangan asbes, bahan kimia atau bahaya kesehatan kerja lainnya, bagaimana bahaya tersebut diidentifikasi, dinilai dan diatasi ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(22, 19, 'checkbox', 'Apakah perusahaan Anda mempekerjakan staf yang memiliki qualifikasi K3 yang ditujukan untuk memberikan pelatihan yang lebih dari sekedar persyaratan dasar ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(23, 20, 'text', 'Bagaimana anda menilai : </p><p>Kemampuan K3', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(24, 20, 'text', '<br>Catatan K3 subkontraktor dan perusahaan-perusahaan yang Anda kontrak ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(25, 21, 'text', 'Dimana Anda menjelaskan standar yang anda tuntut agar dipenuhi oleh kontraktor Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(26, 22, 'text', 'Bagaimana Anda memastikan standar-standar di bawah ini telah dipenuhi dan diperiksa<ul><li>Pelatihan keselamatan bagi karyawan yang bekerja.</li><li>Proses penerimaan karyawan yang akan bekerja untuk proyek Anda.</li><li>Karyawan memahami komitmen, kebijakan, tujuan dan standar perusahaan.</li><li>Rencana berhubungan dengan subkontraktor ? Kalau ada ?</li></ul>', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(27, 23, 'text', 'Tolong disediakan nama-nama subkontraktor utama, pada saat ini, kalau diketahui.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(28, 24, 'text', 'Di mana Anda menjelaskan standar yang Anda tuntut agar dipenuhi ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(29, 25, 'text', 'Bagaiman caranya Anda memastikan standar ini dipenuhi dan diperiksa ? ', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(30, 26, 'text', 'Bagaimana Anda mengenali standar-standar industri dan aturan baru yang mungkin berlaku bagi aktivitas Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(31, 27, 'text', 'Adakah struktur menyeluruh untuk membuat, memperbarui dan menyebarkan standar ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(32, 28, 'file', 'Buatlah daftar buku panduan K3 Anda. Kirimkan copy yang terbaru', 'panduan_k3', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(33, 29, 'text', 'Teknik apa yang Anda gunakan dalam perusahaan Anda untuk mengindentifikasi, menilai, mengawasi dan mengurangi bahaya dan dampak ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(34, 30, 'text', 'Sistem apa yang ada untuk memantau paparan pekerja Anda terhadap bahan kimia atau unsur-unsur fisik ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(35, 31, 'text', 'Bagaimana pekerja Anda diberitahu mengenai bahaya yang mungkin timbul seperti bahan kimia, kebisingan, radiasi dan sebagainya dalam pekerjaan mereka ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(36, 32, 'text', 'Pengaturan apa yang dipunyai perusahaan Anda untuk pengadaan dan pemberian protective equipment dan pakaian kerja, baik yang standar maupun yang diperlukan untuk kegiatan-kegiatan khusus ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(37, 33, 'text', 'Apakah Anda menyediakan personnel protective equipment (PPE) yang sesuai untuk karyawan Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(38, 32, 'file', ' Berikan daftar PPE untuk lingkup kerja ini.', 'daftar_PPE', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(39, 34, 'text', 'Apakah Anda memberikan pelatihan mengenai cara menggunakan PPE ? Jelaskan materi pelatihan dan setiap tindak lanjutnya.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(40, 35, 'text', 'Apakah Anda mempunyai program untuk memastikan bahwa PPE digunakan dan dijaga ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(41, 36, 'text', 'Sistem apa yang ada untuk identifikasi, klarifikasi, pengurangan dan penanganan limbah ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(42, 37, 'text', 'Berikan jumlah kecelakaan yang menyebabkan kerusakan lingkungan dalam jumlah yang melebihi $50,000 untuk 24 bulan terakhir.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(55, 37, 'file', ' Lampirkan copy laporan yang dikirim ke pemerintah.', 'laporan_kecelakaan', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(56, 38, 'checkbox', 'Apakah Anda mempunyai prosedur untuk pembuangan limbah ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(57, 39, 'checkbox', 'Apakah Anda mempunyai prosedur untuk melaporkan tumpahan minyak ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(58, 40, 'checkbox', 'Apakah Anda mempunyai prosedur untuk pembersihan tumpahan ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(59, 41, 'text', 'Berikan rincian mengenai peralatan Anda yang berkaitan dengan masalah lingkungan.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(60, 42, 'text', 'Siapa orang yang berwenang untuk mengkoordinasikan masalah lingkungan dan bagaimana dengan pengalamannya ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(61, 43, 'checkbox', 'Apakah Anda mempunyai program industri ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(62, 43, 'text', 'Kalau ada, apa saja yang termasuk di dalamnya ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(63, 44, 'text', 'Apakah Anda mempunyai penilaian resiko, atau usaha serupa, untuk mengindentifikasi bahaya di tempat kerja ? Jelaskan proses ini.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(64, 45, 'text', 'Jika Anda mendatangkan bahan/zat berbahaya ke tempat kerja, jelaskan proses yang akan Anda gunakan untuk mendokumentasikan dan mengawasinya.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(65, 46, 'text', 'Apakah Anda mempunyai kebijakan mengenai obat-obatan dan minuman keras dalam organisasi Anda ? ', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(66, 47, 'text', 'Apakah Anda mempunyai buku panduan K3 perusahaan atau buku panduan Operasi yang sesuai dengan aturan-aturan K3 yang dijelaskan secara rinci dalam cara kerja K3 dan aturan keselamatan yang disahkan oleh perusahaan seperti yang menyangkut perancah (scaffolding) alat pengangkat, alat-alat berat, bejana tekan atau penggalian ? ', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(67, 48, 'checkbox', 'Bagaimana Anda memastikan bahwa cara kerja dan prosedur yang digunakan oleh karyawan di lapangan kosisten dengan tujuan dan pengetahuan kebijakan K3 Anda ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(68, 48, 'file', 'Jika jawabannya Ya, lampirkan copy dari dokumen pendukung.', 'panduan_pendukung', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(69, 49, 'text', 'Bagaimana Anda memastikan bahwa plant dan peralatan yang digunakan di wilayah kerja Anda, lokasi, atau pada lokasi lain oleh karyawan Anda, didaftarkan, disertifikasi sesuai tuntutan peraturan, diinspeksi, diawasi dan dirawat dengan benar dan dalam kondisi kerja yang baik ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(70, 50, 'text', 'Pengaturan apa yang dipunyai perusahaan Anda untuk mencegah kecelakaan kendaraan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(71, 51, 'text', '	Pengaturan apa yang dipunyai perusahaan Anda untuk pengawasan dan pemantauan kinerja K3 ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(72, 52, 'text', 'Kriteria kinerja apa yang digunakan dalam perusahaan Anda ; berikan contoh', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(73, 53, 'text', 'Pengaturan apa yang dipunayai perusahaan Anda untuk menyampaikan setiap hasil dan temuan dari pengawasan dan pemantauannya kepada : <ul><li>Base management Anda ?</li><li>Karyawan lapangan ?</li></ul>', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(74, 54, 'checkbox', 'Pernahkah perusahaan Anda menerima penghargaan untuk prestasi kinerja K3 ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(75, 55, 'checkbox', 'Apakah Anda menyelenggarakan safety meeting di tempat Anda sendiri ? ', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(76, 55, 'text', 'Jelaskan frekuensi, peserta dan topiknya.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(77, 56, 'checkbox', 'Apakah Anda mengorganisasikan kampanye untuk menstimulasi cara kerja yang aman ? ', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(78, 56, 'text', 'Kalau ia, berikan rincian.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(79, 57, 'checkbox', 'Pernahkah perusahaan Anda mengalami keharusan perbaikan atau pemberitahuan larangan dalam hal insiden/kejadian berbahaya yang bersifat hukum oleh badan nasional yang relevan, badan yang berwenang dalam K3, atau otoritas penegak hukum lainnya atau diperkarakan di bawah undang-undang K3 selama lima tahun terakhir ini ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(80, 57, 'text', 'Jika jawaban Anda Pernah, berikan rinciannya.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(81, 58, 'checkbox', 'Apakah Anda menyimpan catatan mengenai insiden dan kinerja K3 Anda untuk lima tahun terakhir ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(82, 58, 'file', 'Jika Ya, berikan yang berikut ini : <ul><li>Jumlah Korban</li><li> Lost Time Injuries</li><li> Kasus Kehilangan Hari Kerja</li><li>Kasus Tindakan Medis</li><li>Restricted Work Day Cases</li><li>Fatal Accident Rate</li><li>Lost Time Injury Frequency</li><li>Total Recordable Incident rate for each year</li></ul>.<br> Sertakan defenisi perusahaan Anda mengenai istilah-istilah di atas dalam lembaran terpisah.          ', 'kinerja_k3', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(83, 59, 'text', 'Bagaimana kenierja kesehatan didokumentasikan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(84, 60, 'checkbox', 'Apakah Anda prosedur untuk investigasi, pelaporan, dan tindak lanjut insiden, kejadian berbahaya atau penyakit di tempat kerja ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(85, 60, 'file', 'Kalau Ya lampirkan.', 'prosedur', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(86, 61, 'text', 'Bagaiman temuan setelah investigasi, atau insiden yang relevan yang terjadi di tempat lain, dikomunikasikan kepada karyawan Anda ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(87, 62, 'checkbox', 'Apakah pelajaran keselamatan dari near miss dilaporkan ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(88, 63, 'file', 'Sediakan copy dari laporan investigasi untuk 12 bulan terakhir.', 'laporan_investigasi', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(89, 64, 'checkbox', 'Apakah Anda mempunyai kebijakan tertulis mengenai audit K3 ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(90, 65, 'text', 'Bagaimana kebijakan tersebut menjelaskan standar audit, termasuk audit mengenai tindakan yang tidak aman dan kualifikasi untuk auditor ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(91, 66, 'checkbox', 'Apakah rencana K3 perusahaan Anda menyertakan jadwal audit ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(92, 67, 'text', 'Bagaimana efektifitas auditing diperiksa dan bagaimana manajemen melaporkan dana menindaklanjuti hasil audit ? ', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(93, 68, 'checkbox', 'Apakah Anda mempunyai rencana tanggap darurat ?', 'Ya|Tidak', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(94, 68, 'text', 'Jelaskan bagaimana kesiapan darurat dijaga dan bagaimana struktur komando dalam keadaan darurat.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(95, 68, 'file', 'Berikan daftar prosedurnya ', 'prosedur_darurat', '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(96, 69, 'text', 'Jelaskan sifat dan sejauh mana partisipasi perusahaan Anda dalam organisasi yang relevan dengan industri, perdagangan, dan pemerintahan.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(97, 70, 'text', 'Apakah perusahaan Anda mempunyai ciri atau aturan K3 lain yang tidak dicantumkan di dalam tanggapan Anda terhadap kuesioner.', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0),
(98, 71, 'text', 'Bagaimana kinerja lingkungan didokumentasikan ?', NULL, '2015-10-14 17:20:50', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_ass`
--

CREATE TABLE IF NOT EXISTS `ms_ass` (
  `id` int(11) NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `value` text,
  `point` int(11) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_ass`
--

INSERT INTO `ms_ass` (`id`, `id_group`, `id_role`, `value`, `point`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 3, 'Mendaftar dalam kegiatan pengadaan barang / jasa dan dinyatakan lulus prakualifikasi', 1, '2015-10-14 11:23:56', '2015-10-14 11:37:24', 0),
(2, 1, 3, 'Mengajukan penawaran secara lengkap dan dinyatakan lulus evaluasi administrasi', 1, NULL, '2015-10-14 12:41:28', 0),
(3, 1, 3, 'Mengajukan penawaran secara lengkap (termasuk HSE Plan untuk pekerjaan jasa konstruksi, jika disyaratkan dalam Dokumen Pengadaan) dan dinyatakan lulus', 1, NULL, '2015-10-14 11:52:26', 0),
(4, 1, 9, 'Mengajukan penawaran secara lengkap dan dinyatakan lulus evaluasi harga', 1, '2015-10-12 10:28:45', '2015-10-14 11:53:26', 0),
(5, 1, 3, 'Ditunjuk sebagai pemenang dalam kegiatan pengadaan barang/jasa dan menandatangani Kontrak/Perjanjian', 5, '2015-10-12 11:28:04', '2015-10-14 11:56:06', 0),
(6, 1, 9, 'Spesifikasi dan delivery time barang/jasa sesuai yang dipersyaratkan per Goods Receipt (GR) / "finished" Service Acceptance (SA)', 5, '2015-10-12 11:28:19', '2015-10-14 11:57:39', 0),
(7, 1, 2, '<div>Implementasi Contractor Safety Management System (CSMS) terdiri dari:</div><div><ol><li>Kontraktor memasukkan program HSE dalam waktu pelaksanaan dan mengimplementasikannya<br></li><li>Membuat dan melaksanakan Job Safety Analysis (JSA) terhadap bahaya yang mungkin muncul saat pelaksanaan pekerjaan.<br></li><li>Kontraktor melaksanakan mitigasi / rekomendasi JSA terhadap bahaya yang mungkin muncul saat pelaksanaan pekerjaan.<br></li><li>Kontraktor menerapkan prosedur ijin kerja yang aman, termasuk melaksanakan rekomendasinya.<br></li><li>Kontraktor melakukan audit / inspeksi HSE (melibatkan pimpinan tertinggi kontraktor &amp; pengawas kontraktor) selama pekerjaan dilaksanakan.<br></li><li>Kontraktor menindaklanjuti semua temuan aspek HSE selama pekerjaan dilaksanakan.<br></li><li>Kontraktor membuat laporan insiden / accident, melakukan investigasi dan menindaklanjuti rekomendasi investigasi.<br></li><li>Kontraktor mengkomunikasikan bahay dan mitigasi pekerjaan, mempromosikan aspek HSE terhadap seluruh pekerja melalui : training / sosialisasi / &nbsp;induciton / safety briefing / safety sign / HSE Meeting, mengkomunikasikan MSDS(Material Safety Data Sheet).<br></li><li>Menyediakan dan menggunakan Alat Pelindung Diri (APD) dan first aid(P3K) kepada seluruh pekerja yang membutuhkan saat pelaksanaan pekerjaan.<br></li><li>Melakukan pembinaan aspek HSE terhadap Subcontractor-nya (bila ada).<br></li><li>Melakukan pengelolaan material / peralatan / perlengkapan kerja secara aman.<br></li><li>Pekerja kontraktor pernah mengikuti sosialisasi emergency procedure Pertamina dan melaksanakannya (bila terjadi kondisi darurat).<br></li></ol></div>Berdasarkan hasil final evaluation CSMS, apabila implementasi CSMS &gt;= 90%', 10, '2015-10-14 12:24:46', '2015-10-15 07:15:06', 0),
(17, 2, 3, 'Mendaftar sebagai peserta dan / atau mengambil dokumen pengadaan tetapi tidak mengajukan penawaran dengan memberikan keterangan tertulis (<i>no quote</i>), atau terlambat memasukkan dokumen penawaran.<p></p>', -5, '2015-10-14 12:48:08', NULL, 0),
(18, 2, 3, 'Mendaftar sebagai peserta dan/atau mengambil dokumen pengadaan tetapi tidak mengajukan penawaran tanpa memberikan keterangan tertulis (<i>no response</i>)<p></p>', -10, '2015-10-14 12:49:02', NULL, 0),
(19, 2, 3, 'Tidak hadir / tidak memberikan tanggapan secara tertulis pada waktu klarifikasi administrasi dan teknis tanpa penjelasan<p></p>', -10, '2015-10-14 12:49:53', NULL, 0),
(20, 2, 3, 'Terlambat menghadiri proses negosiasi(<i>manual </i>dan <i>bidding room e-auction)</i>&nbsp;dan /atau terlambat menyampaikan dokumen penegasan rincian penawaran setelah negosiasi sesuai jadwal yang disepakati, sehingga mengakibatkan keterlambatan pelaksanaan pekerjaan.<p></p>', -10, '2015-10-14 12:51:29', NULL, 0),
(21, 2, 3, 'Terlambat menandatangani Kontrak / Perjanjian yang isinya telah disepakati bersama dalam jangka waktu yang ditetapkan dalam pemberitahuan tertulis tanpa alasan yang dapat diterima<p></p>', -15, '2015-10-14 12:56:33', NULL, 0),
(22, 2, 9, 'Terlambat menyelesaikan pekerjaan / menyerahkan barang sesuai dengan yang diperjanjikan, namun belum mencapai denda maksimum<p></p>', -15, '2015-10-14 14:57:05', NULL, 0),
(23, 2, 9, 'Terlambat menyelesaikan pekerjaan / menyerahkan barang sesuai dengan yang diperjanjikan hingga mencapai denda maksimum<p></p>', -30, '2015-10-14 14:58:25', NULL, 0),
(24, 2, 9, 'Melaksanakan pengiriman barang/jasa yang performance-nya tidak sesuai, namun masih bisa diterima dalam kondisi yang ditolerir dalam Kontrak/Perjanjian<p></p>', -30, '2015-10-14 14:59:21', NULL, 0),
(25, 2, 9, 'Tidak menyelesaikan pekerjaan/memasok barang seluruhnya, sesuai dengan Surat Perjanjian/ Surat Pesanan. Tidak dibuat SA/GR.<p></p>', -60, '2015-10-14 15:00:13', NULL, 0),
(26, 2, 3, 'Penyedia barang/jasa mengajukakn sanggahan yang terbukti tidak benar yang dinyatakan oleh pejabat berwenang sesuai proses pengadaan.<p></p>', -30, '2015-10-14 15:01:09', NULL, 0),
(27, 2, 3, 'Membatalkan penawaran yang telah diajukan sebelum ditunjuk sebagai pemenang<p></p>', -30, '2015-10-14 15:01:47', NULL, 0),
(28, 2, 3, 'Membatalkan penawaran yang telah diajukan setelah ditunjuk sebagai pemenang<p></p>', -60, '2015-10-14 15:02:22', NULL, 0),
(29, 2, 3, 'Tidak bersedia menyerahkan jaminan pelaksanaan / perpanjangan jaminan pelaksanaan (untuk pekerjaan yang mewajibkan menyerahkan jaminan pelaksanaan)<p></p>', -30, '2015-10-14 15:03:09', NULL, 0),
(30, 2, 2, 'Berdasarkan hasil <i>final evaluation</i>&nbsp;CSMS, tidak memenuhi syarat dalam penerapan aspek HSE selama melakukan pekerjaan, dengan penilaian evaluasi akhir kinerja HSE Kontraktor &lt; 90% (lebih kecil dari 90%) dari standar (mengacu pada Jenis Prestasi butir 7)<p></p>', -45, '2015-10-14 15:04:34', '2015-10-15 07:15:13', 0),
(31, 2, 9, 'Terbukti melalui hasil investigasi menyebabkan terjadinya insiden pencemaran lingkungan / kebakaran/ kecelakaan kerja yang <b>bukan </b><i>fatality </i>dirawat &lt;=2 x 24 jam)<p></p>', -60, '2015-10-14 15:05:56', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_ass_group`
--

CREATE TABLE IF NOT EXISTS `ms_ass_group` (
  `id` int(11) NOT NULL,
  `name` text,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_ass_group`
--

INSERT INTO `ms_ass_group` (`id`, `name`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 'Tabel Penghargaan', NULL, '2015-10-14 10:52:50', 0),
(2, 'Tabel Sanksi', '2015-10-13 09:32:19', '2015-10-14 10:53:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_contract`
--

CREATE TABLE IF NOT EXISTS `ms_contract` (
  `id` bigint(20) NOT NULL,
  `id_procurement` bigint(20) DEFAULT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `no_sppbj` varchar(100) DEFAULT NULL,
  `sppbj_date` date DEFAULT NULL,
  `no_spmk` varchar(100) DEFAULT NULL,
  `spmk_date` date DEFAULT NULL,
  `start_work` date DEFAULT NULL,
  `end_work` date DEFAULT NULL,
  `no_contract` varchar(100) DEFAULT NULL,
  `po_file` varchar(60) DEFAULT NULL,
  `contract_price` decimal(15,2) DEFAULT NULL,
  `contract_price_kurs` decimal(15,2) DEFAULT NULL,
  `contract_kurs` int(2) DEFAULT NULL,
  `start_contract` date DEFAULT NULL,
  `end_contract` date DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_contract`
--

INSERT INTO `ms_contract` (`id`, `id_procurement`, `id_vendor`, `no_sppbj`, `sppbj_date`, `no_spmk`, `spmk_date`, `start_work`, `end_work`, `no_contract`, `po_file`, `contract_price`, `contract_price_kurs`, `contract_kurs`, `start_contract`, `end_contract`, `del`, `entry_stamp`, `edit_stamp`) VALUES
(1, 2, 3, '7777', '2015-10-23', '8888', '2015-10-23', '2015-10-23', '2015-10-23', '55555', 'po_file_231015_042617_878.pdf', '4500000.00', '4.50', 3, '2015-10-23', '2016-10-23', 0, '2015-10-23 09:26:17', NULL),
(2, 1, 4, '123241', '2015-10-23', '879864', '2015-10-23', '2015-10-23', '2015-10-23', '543274646', 'po_file_231015_042630_691.pdf', '802000000.00', '8880.00', 3, '2015-10-23', '2015-11-19', 0, '2015-10-23 09:26:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_csms`
--

CREATE TABLE IF NOT EXISTS `ms_csms` (
  `id` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `no` varchar(45) DEFAULT NULL,
  `csms_file` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_evaluasi_data`
--

CREATE TABLE IF NOT EXISTS `ms_evaluasi_data` (
  `id` bigint(20) NOT NULL,
  `id_quest` varchar(45) DEFAULT NULL,
  `data` text,
  `file_name` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_hse`
--

CREATE TABLE IF NOT EXISTS `ms_hse` (
  `id_hse` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `hse_file` varchar(50) DEFAULT NULL,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_ijin_usaha`
--

CREATE TABLE IF NOT EXISTS `ms_ijin_usaha` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `id_dpt_type` bigint(6) DEFAULT NULL COMMENT 'foriegn key from id on tb_dpt_type',
  `type` varchar(50) DEFAULT NULL COMMENT 'tipe surat ijin usaha : SIUP, Surat Ijin Usaha Lainnya, Sertifikat Asosiasi / Lainnya, SBU, SIUJK',
  `no` varchar(100) DEFAULT NULL COMMENT 'nomor surat ijin usaha',
  `grade` varchar(5) DEFAULT NULL,
  `issue_date` varchar(45) DEFAULT NULL COMMENT 'tanggal diterbitkannya surat ijin usaha',
  `qualification` varchar(10) DEFAULT NULL COMMENT 'kualifikasi ijin usaha : besar atau kecil',
  `authorize_by` varchar(200) DEFAULT NULL COMMENT 'lembaga penerbit surat ijin usaha',
  `izin_file` varchar(40) DEFAULT NULL COMMENT 'server path surat ijin attachement',
  `expire_date` varchar(11) DEFAULT NULL COMMENT 'expiry date of document. it can be lifetime',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foraeign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_ijin_usaha`
--

INSERT INTO `ms_ijin_usaha` (`id`, `id_vendor`, `id_dpt_type`, `type`, `no`, `grade`, `issue_date`, `qualification`, `authorize_by`, `izin_file`, `expire_date`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 6, 4, 'siujk', '123', 'a', '2015-10-23', 'besar', '', 'izin_file_231015_014631_495.pdf', '2015-10-23', '2015-10-23 06:46:31', NULL, 2, '2015-10-23 08:01:59', 1, 0),
(2, 3, 1, 'siup', '78888', NULL, '2015-10-23', 'kecil', '', 'izin_file_231015_024511_152.pdf', '2018-10-23', '2015-10-23 07:45:11', NULL, 2, '2015-10-23 08:18:27', 1, 0),
(3, 4, 2, 'siup', '7', NULL, '2015-10-23', 'besar', '', 'izin_file_231015_024845_214.pdf', '2016-10-23', '2015-10-23 07:48:45', NULL, 2, '2015-10-23 08:11:54', 1, 0),
(4, 7, 1, 'siup', '1998827', NULL, '2015-10-24', 'kecil', '', 'izin_file_241015_101740_596.png', '2015-10-24', '2015-10-24 15:17:40', NULL, 1, '2015-10-24 15:27:53', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_iu_bsb`
--

CREATE TABLE IF NOT EXISTS `ms_iu_bsb` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `id_ijin_usaha` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_ijin_usaha',
  `id_bidang` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_bidang',
  `id_sub_bidang` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_sub_bidang',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data entry timestamp',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_iu_bsb`
--

INSERT INTO `ms_iu_bsb` (`id`, `id_vendor`, `id_ijin_usaha`, `id_bidang`, `id_sub_bidang`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 3, 2, 29, 388, '2015-10-23 07:45:42', '0000-00-00 00:00:00', 0, NULL, NULL, 0),
(2, 4, 3, 33, 456, '2015-10-23 07:56:29', '0000-00-00 00:00:00', 0, NULL, NULL, 0),
(3, 6, 1, 44, 492, '2015-10-23 07:58:33', '0000-00-00 00:00:00', 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_login`
--

CREATE TABLE IF NOT EXISTS `ms_login` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL COMMENT 'FK for id in ms_vendor if type = user, if type = admin then FK for ms_admin',
  `type` varchar(6) DEFAULT NULL COMMENT 'type of user, admin or user',
  `username` varchar(60) DEFAULT NULL COMMENT 'username for login',
  `password` varchar(60) DEFAULT NULL COMMENT 'password for login',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_login`
--

INSERT INTO `ms_login` (`id`, `id_user`, `type`, `username`, `password`, `entry_stamp`, `edit_stamp`) VALUES
(5, 12, 'admin', 'admin', 'admin', '2015-09-14 12:36:30', NULL),
(6, 1, 'user', 'muarifgusasdasdtiar@gmail.com', '123', '2015-09-14 12:36:30', '2015-09-14 14:34:28'),
(7, 3, 'user', 'ayu@nusantararegas.com', 'IRuvAMo0ZR', '2015-09-17 02:50:42', '2015-10-23 04:03:23'),
(11, 20, 'user', 't@i.com', 'Fgkm0uhfq', '2015-09-18 08:34:16', NULL),
(13, 22, 'user', 'w@f.c', '123', '2015-09-18 13:50:08', NULL),
(14, 23, 'user', 'kamvak@gmail.com', '123', '2015-09-18 15:25:50', NULL),
(25, 34, 'user', 'info@dekodr-indonesia.co.ids', 'DbXLv1Z7x1', '2015-09-21 01:50:40', '2015-09-21 02:05:34'),
(26, 35, 'user', 'muar@f.com', 'VaHbAiJvss', '2015-09-21 09:03:42', NULL),
(27, 36, 'user', 'mu@rif.com', 'QTgq9uGE3D', '2015-09-21 09:07:12', NULL),
(28, 37, 'user', 'info@dekodr-indonesia.co.id', 'qF7P34tvO7', '2015-09-21 09:11:58', NULL),
(29, 38, 'user', 'info@dekodr-indonesia.co.id', 'LIgel98LR0', '2015-09-21 09:12:14', NULL),
(30, 39, 'user', 'info@dekodr-indonesia.co.id', 'fBZhuLfKYV', '2015-09-21 09:12:29', NULL),
(31, 40, 'user', 'info@dekodr-indonesia.co.id', 'dQIkYqtjtw', '2015-09-21 09:13:06', NULL),
(38, 47, 'user', '123fasdf@adf.com', 'AnER9buCO3', '2015-09-21 13:24:37', NULL),
(40, 50, 'user', 'muarifgustiar@gmail.com', 'd2OWnUKbRM', '2015-09-21 14:25:57', NULL),
(41, 51, 'user', 'muarif@gm.com', 'vzODaXQ3fh', '2015-09-21 14:39:57', NULL),
(42, 52, 'user', 'muarifigustiar@gmail.com', 'qaiHqvCNgb', '2015-09-21 23:33:21', NULL),
(43, 53, 'user', 'abelino@gmail.com', 'zCgCspSyEE', '2015-09-21 23:34:43', '2015-09-21 23:53:39'),
(44, 13, 'admin', 'admin', 'admin', '2015-09-22 01:39:40', NULL),
(45, 14, 'admin', 'proc', 'proc', '2015-09-23 06:16:54', NULL),
(46, 15, 'admin', 'kontrak', 'kontrak', '2015-09-24 16:45:17', NULL),
(47, 16, 'admin', 'peng', 'peng', '2015-09-25 01:09:16', NULL),
(48, 54, 'user', 'jhjh@as.asd', 'uukzkn3FWp', '2015-10-01 16:12:25', NULL),
(49, 55, 'user', 'y@g.com', 'NoW5RNUNjr', '2015-10-02 08:07:21', '2015-10-02 08:09:22'),
(50, 17, 'admin', 'muarif', 'lol', '2015-10-05 07:37:39', NULL),
(51, 18, 'admin', 'test', 'test', '2015-10-05 07:38:14', NULL),
(52, 19, 'admin', 'auction', 'auction', '2015-10-05 08:37:05', NULL),
(53, 20, 'admin', 'hse', 'hse', '2015-10-05 10:03:44', NULL),
(54, 21, 'admin', 'muarifgay', 'muarifgay', '2015-10-07 04:07:34', NULL),
(55, 58, 'user', 'm@gmail.com', 'WPE1ukOEsJ', '2015-10-08 23:31:57', '2015-10-08 23:31:57'),
(56, 59, 'user', 'test@ggg.com', '1NVWPEAcLC', '2015-10-08 23:42:02', '2015-10-08 23:42:02'),
(57, 62, 'user', 'test@ggg.com', '9XVlnDrQw1', '2015-10-08 23:48:23', '2015-10-08 23:48:23'),
(58, 63, 'user', 'mail@dekodr.com', 'IdRX3jo6Sf', '2015-10-12 14:03:45', NULL),
(59, 64, 'user', 'elnusa@elnusa.co.id', '2xzRa5789g', '2015-10-12 14:05:46', NULL),
(60, 65, 'user', 'elnusa@elnusa.co.ids', 'UAPC281UzZ', '2015-10-12 14:06:19', NULL),
(61, 66, 'user', 'kamvak@elnusa.co.id', '123', '2015-10-12 14:07:13', NULL),
(62, 67, 'user', 'tcid@tcid.com', 'GkJC0b04u1', '2015-10-12 14:07:40', NULL),
(63, 68, 'user', 'alexandro.putra@gmail.com', 'lU2Svrggue', '2015-10-12 23:52:04', NULL),
(64, 22, 'admin', 'admindd', '123', '2015-10-13 06:44:24', NULL),
(65, 23, 'admin', 'admindwqwdas', 'admindasdasdas', '2015-10-13 06:45:30', NULL),
(66, 24, 'admin', 'admindsadasdas', 'adminasdas', '2015-10-13 06:45:41', NULL),
(67, 25, 'admin', 'assessment', 'assessment', '2015-10-14 10:57:48', NULL),
(68, 69, 'user', 'test@gmail.co', 'LpMKoLaWMs', '2015-10-15 08:40:12', NULL),
(69, 70, 'user', 'muarif871238712376@gmail.com', 'WHJwfRJCLh', '2015-10-16 09:26:17', NULL),
(70, 71, 'user', 'test@kan.com', 'fZkCn9DLWb', '2015-10-16 09:35:03', NULL),
(71, 72, 'user', 'regas@email.com', '2S5dMUXuX', '2015-10-21 03:43:03', NULL),
(72, 73, 'user', '', 'I9u8Gqm9Tn', '2015-10-22 06:49:05', NULL),
(73, 74, 'user', '', NULL, '2015-10-22 06:54:57', NULL),
(74, 75, 'user', '', NULL, '2015-10-22 07:00:09', NULL),
(75, 76, 'user', '', NULL, '2015-10-22 07:02:50', NULL),
(76, 77, 'user', '', NULL, '2015-10-22 07:06:56', NULL),
(77, 78, 'user', '', NULL, '2015-10-22 07:07:57', NULL),
(78, 79, 'user', '', NULL, '2015-10-22 07:08:12', NULL),
(79, 80, 'user', '', NULL, '2015-10-22 07:11:46', NULL),
(80, 81, 'user', '', NULL, '2015-10-22 07:12:29', NULL),
(81, 84, 'user', 'uat@gmail.com', '1234', '2015-10-22 12:15:27', '2015-10-22 12:21:04'),
(82, 85, 'user', 'trump@gmail.com', '123', '2015-10-22 12:22:34', '2015-10-22 12:27:05'),
(83, 26, 'admin', 'hapus coy', 'hapus coy', '2015-10-22 13:22:04', NULL),
(84, 86, 'user', '11@1.c', 'sOtfj511Q', '2015-10-22 14:06:43', '2015-10-22 14:13:01'),
(85, 2, 'user', 'abc@gmail.com', 'R6PCaOric9', '2015-10-23 03:10:25', NULL),
(86, 3, 'user', 'ayu@nusantararegas.com', '86mo0hokaB', '2015-10-23 03:13:34', '2015-10-23 04:03:23'),
(87, 4, 'user', 'pradito@nusantararegas.com', 'L05Ju15Y9z', '2015-10-23 03:14:47', '2015-10-23 03:53:17'),
(88, 5, 'user', 'zulfahmi@nusantararegas.com', 'xV4ivLpVkr', '2015-10-23 03:15:42', '2015-10-23 03:44:14'),
(89, 6, 'user', 'amathul@nusantararegas.com', '11nov2011', '2015-10-23 03:16:57', '2015-10-23 03:48:33'),
(90, 27, 'admin', 'admin HSE', 'coba', '2015-10-23 03:48:27', NULL),
(91, 7, 'user', 'muarifgustiar@gmail.com', '123', '2015-10-24 15:11:46', '2015-10-24 15:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `ms_material`
--

CREATE TABLE IF NOT EXISTS `ms_material` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `images` text NOT NULL,
  `remark` text,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL,
  `del` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_material`
--

INSERT INTO `ms_material` (`id`, `id_barang`, `nama`, `images`, `remark`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(3, 6, 'Test', '', NULL, NULL, NULL, 0),
(4, 6, 'Test', '', NULL, NULL, NULL, 0),
(5, 6, 'Test', '', NULL, NULL, NULL, 0),
(6, 6, 'Test', '', NULL, NULL, NULL, 0),
(7, 6, 'Test', '', NULL, NULL, NULL, 0),
(8, 6, 'Test', '', NULL, NULL, NULL, 0),
(9, 6, 'Test', '', NULL, NULL, NULL, 0),
(10, 6, 'Test', '', NULL, NULL, NULL, 0),
(11, 6, 'Test', '', NULL, NULL, NULL, 0),
(12, 6, 'Test', '', NULL, NULL, NULL, 0),
(13, 7, 'Barang', '', NULL, '2015-10-25 14:14:03', NULL, 0),
(14, 7, 'Barang', '', NULL, '2015-10-25 14:14:14', NULL, 0),
(15, 8, 'barangmu', '', NULL, '2015-10-25 14:18:50', NULL, 0),
(16, 8, 'barangmu', '', NULL, '2015-10-25 14:18:50', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_pemilik`
--

CREATE TABLE IF NOT EXISTS `ms_pemilik` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `id_akta` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'nama pemilik',
  `position` varchar(60) DEFAULT NULL COMMENT 'posisi pemegang saham dalam perusahaan. can be null',
  `percentage` decimal(5,2) DEFAULT NULL COMMENT 'persentase kepemilikan saham',
  `shares` int(11) NOT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foraeign key from id at ms_admin',
  `del` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pemilik`
--

INSERT INTO `ms_pemilik` (`id`, `id_vendor`, `id_akta`, `name`, `position`, `percentage`, `shares`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 4, 3, 'Pandu', NULL, '50.10', 501, '2015-10-23 07:27:59', NULL, 2, '2015-10-23 08:11:41', 1, 0),
(2, 3, 3, 'aaaaaaaaaaaaaa', NULL, '16.00', 234, '2015-10-23 07:35:13', NULL, 2, '2015-10-23 08:18:17', 1, 0),
(3, 3, 3, 'gggg', NULL, '10.00', 66, '2015-10-23 07:43:51', NULL, 2, '2015-10-23 08:18:17', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_penawaran`
--

CREATE TABLE IF NOT EXISTS `ms_penawaran` (
  `id` bigint(20) NOT NULL,
  `id_procurement` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nilai` bigint(15) NOT NULL,
  `down_percent` decimal(5,2) NOT NULL,
  `id_kurs` int(5) NOT NULL,
  `in_rate` bigint(15) NOT NULL,
  `entry_stamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_penawaran`
--

INSERT INTO `ms_penawaran` (`id`, `id_procurement`, `id_vendor`, `id_barang`, `nilai`, `down_percent`, `id_kurs`, `in_rate`, `entry_stamp`) VALUES
(1, 5, 7, 2, 40000, '0.00', 3, 520000000, '2015-10-25 10:29:35'),
(2, 5, 7, 2, 40000, '0.00', 3, 520000000, '2015-10-25 10:30:42'),
(3, 6, 7, 3, 5000, '0.00', 3, 61500000, '2015-10-25 10:44:05'),
(4, 6, 7, 3, 5000, '0.00', 3, 61500000, '2015-10-25 10:44:09'),
(5, 6, 7, 3, 3000, '40.00', 3, 36900000, '2015-10-25 10:44:47'),
(6, 6, 7, 3, 2900, '3.30', 3, 35670000, '2015-10-25 10:45:20'),
(7, 7, 7, 4, 20000, '0.00', 3, 400000000, '2015-10-25 11:24:58'),
(8, 7, 7, 4, 20000, '0.00', 3, 400000000, '2015-10-25 11:24:59'),
(9, 7, 7, 4, 10000, '50.00', 3, 200000000, '2015-10-25 11:25:59'),
(10, 7, 7, 4, 1000, '90.00', 3, 20000000, '2015-10-25 11:26:13'),
(11, 8, 7, 5, 4000, '0.00', 3, 56000000, '2015-10-25 12:30:47'),
(12, 8, 7, 5, 3000, '25.00', 3, 42000000, '2015-10-25 12:31:50'),
(13, 8, 7, 5, 1000, '66.70', 3, 14000000, '2015-10-25 12:31:59'),
(14, 8, 7, 5, 900, '10.00', 3, 12600000, '2015-10-25 12:32:43'),
(15, 17, 7, 6, 5400, '0.00', 3, 73440000, '2015-10-25 13:27:58'),
(16, 17, 7, 6, 5400, '0.00', 3, 73440000, '2015-10-25 13:28:36'),
(17, 17, 7, 6, 4900, '9.30', 3, 66640000, '2015-10-25 13:29:57'),
(18, 17, 7, 6, 4500, '8.20', 3, 61200000, '2015-10-25 13:30:13'),
(19, 18, 7, 7, 50000, '0.00', 3, 680000000, '2015-10-25 14:09:14'),
(20, 18, 7, 7, 42500, '15.00', 3, 578000000, '2015-10-25 14:11:40'),
(21, 19, 7, 8, 35000, '0.00', 3, 476000000, '2015-10-25 14:16:29'),
(22, 19, 7, 8, 20000, '42.90', 3, 272000000, '2015-10-25 14:17:19'),
(23, 19, 7, 8, 15000, '25.00', 3, 204000000, '2015-10-25 14:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pengalaman`
--

CREATE TABLE IF NOT EXISTS `ms_pengalaman` (
  `id` bigint(20) NOT NULL,
  `id_iu_bsb` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_iu_bsb',
  `id_ijin_usaha` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_ijin_usaha',
  `id_sbu` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_sbu',
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `job_name` varchar(300) DEFAULT NULL COMMENT 'nama pekerjan',
  `job_location` varchar(300) DEFAULT NULL COMMENT 'lokasi pekerjaan',
  `job_giver` varchar(150) DEFAULT NULL COMMENT 'instansi pemberi kerja',
  `phone_no` varchar(20) DEFAULT NULL COMMENT 'nomor telpon pemberi tugas',
  `contract_no` varchar(150) DEFAULT NULL COMMENT 'nomor kontrak',
  `contract_start` date DEFAULT NULL COMMENT 'tanggal mulai kontrak',
  `contract_end` date DEFAULT NULL COMMENT 'tanggal akhir kontrak',
  `bast_date` date DEFAULT NULL COMMENT 'tanggal BAST',
  `price_idr` decimal(15,2) DEFAULT NULL COMMENT 'harga dalam rupiah',
  `price_foreign` decimal(15,2) DEFAULT NULL COMMENT 'harga dalam mata uang asing',
  `currency` varchar(3) DEFAULT NULL,
  `contract_file` varchar(40) DEFAULT NULL COMMENT 'server path lampiran kontrak',
  `bast_file` varchar(40) DEFAULT NULL COMMENT 'server path lampiran BAST',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foreign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pengalaman`
--

INSERT INTO `ms_pengalaman` (`id`, `id_iu_bsb`, `id_ijin_usaha`, `id_sbu`, `id_vendor`, `job_name`, `job_location`, `job_giver`, `phone_no`, `contract_no`, `contract_start`, `contract_end`, `bast_date`, `price_idr`, `price_foreign`, `currency`, `contract_file`, `bast_file`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 2, 3, NULL, 4, 'Pekerjaan perahu kertas', 'jakarta coret', 'NR', '02131588765', '1233/NR/K000/XI/2015', '2015-06-23', '2015-12-23', '2015-10-23', '998887765.00', '0.00', 'USD', 'contract_file_231015_030410_195.pdf', 'bast_file_231015_030410_308.pdf', '2015-10-23 08:04:10', NULL, 2, '2015-10-23 08:15:15', 1, 0),
(2, 1, 2, NULL, 3, 'bor', 'jakarta', 'imu', '3153', '12', '2014-10-23', '2015-10-23', '2015-10-23', '60000.00', '65.00', 'USD', 'contract_file_231015_030650_185.pdf', 'bast_file_231015_030650_996.pdf', '2015-10-23 08:06:50', NULL, 2, '2015-10-23 08:18:41', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_pengurus`
--

CREATE TABLE IF NOT EXISTS `ms_pengurus` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `id_akta` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_akta',
  `no` varchar(60) DEFAULT NULL COMMENT 'Nomor ID (KTP/Passport/KITAS)	',
  `name` varchar(100) DEFAULT NULL COMMENT 'nama pengurus',
  `position` varchar(60) DEFAULT NULL COMMENT 'jabatan',
  `position_expire` date DEFAULT NULL COMMENT 'masa berlaku jabatan',
  `pengurus_file` varchar(45) DEFAULT NULL COMMENT 'server path pengurus attachement',
  `expire_date` varchar(11) DEFAULT NULL COMMENT 'expiry date of document. it can be lifetime',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foraeign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pengurus`
--

INSERT INTO `ms_pengurus` (`id`, `id_vendor`, `id_akta`, `no`, `name`, `position`, `position_expire`, `pengurus_file`, `expire_date`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 3, 1, '2222', 'aaa', 'Direktur Utama', NULL, 'pengurus_file_231015_023350_422.pdf', '2016-10-23', '2015-10-23 07:33:50', NULL, 2, '2015-10-23 08:18:08', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement`
--

CREATE TABLE IF NOT EXISTS `ms_procurement` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `budget_holder` bigint(20) DEFAULT NULL,
  `budget_spender` bigint(20) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `budget_source` varchar(20) DEFAULT NULL,
  `no_bahp` varchar(150) DEFAULT NULL,
  `bahp_date` date DEFAULT NULL,
  `id_pejabat_pengadaan` varchar(45) DEFAULT NULL,
  `budget_year` varchar(5) DEFAULT NULL,
  `id_mekanisme` bigint(20) DEFAULT NULL,
  `price_auction` decimal(15,2) DEFAULT NULL,
  `price_auction_kurs` decimal(15,2) DEFAULT NULL,
  `auction_kurs` int(2) DEFAULT NULL,
  `price_nego` decimal(15,2) DEFAULT NULL,
  `price_nego_kurs` decimal(15,2) DEFAULT NULL,
  `nego_kurs` int(2) DEFAULT NULL,
  `status_procurement` tinyint(1) DEFAULT '0',
  `proc_date` timestamp NULL DEFAULT NULL,
  `contract_date` timestamp NULL DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  `auction_type` varchar(20) DEFAULT NULL,
  `work_area` varchar(20) DEFAULT NULL,
  `room` varchar(45) DEFAULT NULL,
  `auction_date` date DEFAULT NULL,
  `auction_duration` int(4) DEFAULT '0',
  `is_started` tinyint(1) DEFAULT '0',
  `is_finished` tinyint(1) DEFAULT '0',
  `is_suspended` tinyint(1) DEFAULT '0',
  `is_fail_auction` tinyint(1) DEFAULT '0',
  `id_sbu` tinyint(1) DEFAULT '0',
  `start_time` datetime NOT NULL,
  `time_limit` datetime NOT NULL,
  `end_hour` time DEFAULT NULL,
  `evaluation_method` varchar(45) DEFAULT NULL,
  `idr_value` int(11) DEFAULT NULL,
  `id_kurs` int(11) DEFAULT NULL,
  `kurs_value` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement`
--

INSERT INTO `ms_procurement` (`id`, `name`, `budget_holder`, `budget_spender`, `entry_stamp`, `edit_stamp`, `budget_source`, `no_bahp`, `bahp_date`, `id_pejabat_pengadaan`, `budget_year`, `id_mekanisme`, `price_auction`, `price_auction_kurs`, `auction_kurs`, `price_nego`, `price_nego_kurs`, `nego_kurs`, `status_procurement`, `proc_date`, `contract_date`, `del`, `auction_type`, `work_area`, `room`, `auction_date`, `auction_duration`, `is_started`, `is_finished`, `is_suspended`, `is_fail_auction`, `id_sbu`, `start_time`, `time_limit`, `end_hour`, `evaluation_method`, `idr_value`, `id_kurs`, `kurs_value`) VALUES
(1, 'Pengadaan pesawat kertas', 5, 12, '2015-10-23 08:25:03', '2015-10-23 08:25:28', 'perusahaan', NULL, NULL, '2', '2015', 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'scoring', 800000000, 3, '0.00'),
(2, 'kalender', 6, 6, '2015-10-23 08:26:40', '2015-10-23 08:32:42', 'perusahaan', NULL, NULL, '2', '2015', 3, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'non_scoring', 5000000, 3, '0.00'),
(3, 'Pengadaan Mobil Dinas', 2, 18, '2015-10-23 08:41:53', NULL, 'perusahaan', NULL, NULL, '2', '2015', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'non_scoring', 50000000, 3, '0.00'),
(9, NULL, 1, 1, '2015-10-25 06:17:11', NULL, 'perusahaan', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'Kantor Pusat', NULL, '2015-10-25', 100, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL),
(10, NULL, 1, 1, '2015-10-25 06:18:29', NULL, 'perusahaan', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'Kantor Pusat', NULL, '2015-10-25', 100, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL),
(17, 'Test', 1, 1, '2015-10-25 06:25:45', NULL, 'perusahaan', NULL, NULL, '1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'Kantor Pusat', 'test', '2015-10-25', 2, 1, 1, 0, 0, 0, '2015-10-25 13:29:19', '2015-10-25 13:41:58', '13:41:58', NULL, NULL, NULL, NULL),
(18, 'Test - 2', 1, 1, '2015-10-25 06:44:45', NULL, 'perusahaan', NULL, NULL, '1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'Kantor Pusat', 'test', '2015-10-25', 2, 1, 1, 0, 0, 0, '2015-10-25 14:11:09', '2015-10-25 14:14:14', '14:14:14', NULL, NULL, NULL, NULL),
(19, 'Test - 2 - 2', 1, 1, '2015-10-25 07:15:28', NULL, 'perusahaan', NULL, NULL, '1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'Kantor Pusat', 'test', '2015-10-25', 2, 1, 1, 0, 0, 0, '2015-10-25 14:16:50', '2015-10-25 14:18:50', '14:18:50', NULL, NULL, NULL, NULL),
(20, 'Test - 2 - 2 - 2', 1, 1, '2015-10-25 07:30:17', NULL, 'perusahaan', NULL, NULL, '1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'reverse_auction', 'kantor_pusat', 'test', '2015-10-25', 2, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_barang`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_barang` (
  `id` int(11) NOT NULL,
  `id_procurement` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `nilai_hps` bigint(15) NOT NULL,
  `id_kurs` int(11) NOT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL,
  `volume` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement_barang`
--

INSERT INTO `ms_procurement_barang` (`id`, `id_procurement`, `id_material`, `nama_barang`, `nilai_hps`, `id_kurs`, `entry_stamp`, `edit_stamp`, `del`, `volume`) VALUES
(1, 4, 0, 'test', 200000, 3, '2015-10-24 15:48:43', '0000-00-00 00:00:00', 0, 0),
(2, 5, 0, 'test', 20000, 3, '2015-10-25 03:26:32', '0000-00-00 00:00:00', 0, 0),
(3, 6, 0, 'test 1', 4000, 3, '2015-10-25 03:43:28', '0000-00-00 00:00:00', 0, 0),
(4, 7, 0, 'test 2', 2000, 3, '2015-10-25 04:23:29', '0000-00-00 00:00:00', 0, 0),
(5, 8, 0, 'test 3', 20000, 3, '2015-10-25 05:25:35', '0000-00-00 00:00:00', 0, 0),
(6, 17, 0, 'Test', 5000, 3, '2015-10-25 06:26:45', '0000-00-00 00:00:00', 0, 0),
(7, 18, 0, 'Barang', 50000, 3, '2015-10-25 07:07:59', '0000-00-00 00:00:00', 0, 0),
(8, 19, 0, 'barangmu', 20000, 3, '2015-10-25 07:15:56', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_bsb`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_bsb` (
  `id` bigint(20) NOT NULL,
  `id_proc` bigint(20) NOT NULL,
  `id_bidang` bigint(20) NOT NULL,
  `id_sub_bidang` bigint(20) NOT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_procurement_bsb`
--

INSERT INTO `ms_procurement_bsb` (`id`, `id_proc`, `id_bidang`, `id_sub_bidang`, `entry_stamp`, `del`) VALUES
(1, 1, 43, 491, '2015-10-23 08:26:48', 0),
(2, 2, 29, 388, '2015-10-23 08:29:14', 0),
(3, 2, 44, 492, '2015-10-23 08:33:38', 0),
(4, 1, 33, 456, '2015-10-23 08:34:29', 0),
(5, 3, 40, 481, '2015-10-23 08:42:34', 0),
(6, 3, 33, 456, '2015-10-23 08:43:10', 0),
(7, 2, 43, 491, '2015-10-23 08:55:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_kurs`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_kurs` (
  `id` int(11) NOT NULL,
  `id_procurement` int(11) NOT NULL,
  `id_kurs` int(11) NOT NULL,
  `rate` int(5) NOT NULL,
  `entry_stamp` datetime NOT NULL,
  `edit_stamp` datetime NOT NULL,
  `del` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement_kurs`
--

INSERT INTO `ms_procurement_kurs` (`id`, `id_procurement`, `id_kurs`, `rate`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 4, 3, 0, '2015-10-24 22:40:38', '0000-00-00 00:00:00', 0),
(2, 5, 3, 13000, '2015-10-25 10:26:17', '0000-00-00 00:00:00', 0),
(3, 6, 3, 12300, '2015-10-25 10:43:10', '0000-00-00 00:00:00', 0),
(4, 7, 3, 20000, '2015-10-25 11:23:12', '0000-00-00 00:00:00', 0),
(5, 8, 3, 14000, '2015-10-25 12:25:15', '0000-00-00 00:00:00', 0),
(6, 14, 3, 13000, '2015-10-25 13:23:52', '0000-00-00 00:00:00', 0),
(7, 15, 3, 13000, '2015-10-25 13:23:52', '0000-00-00 00:00:00', 0),
(8, 16, 3, 13000, '2015-10-25 13:24:38', '0000-00-00 00:00:00', 0),
(9, 17, 3, 13600, '2015-10-25 13:26:26', '0000-00-00 00:00:00', 0),
(10, 18, 3, 13600, '2015-10-25 13:44:46', '0000-00-00 00:00:00', 0),
(11, 19, 3, 13600, '2015-10-25 14:15:29', '0000-00-00 00:00:00', 0),
(12, 20, 3, 13600, '2015-10-25 14:25:38', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_persyaratan`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_persyaratan` (
  `id` int(11) NOT NULL,
  `id_proc` int(11) NOT NULL,
  `description` text NOT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement_persyaratan`
--

INSERT INTO `ms_procurement_persyaratan` (`id`, `id_proc`, `description`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 4, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 0 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-24 14:56:57', '0000-00-00 00:00:00', 0),
(2, 5, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 100 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 03:25:49', '0000-00-00 00:00:00', 0),
(3, 6, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 5 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 03:42:18', '0000-00-00 00:00:00', 0),
(4, 7, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 04:22:52', '0000-00-00 00:00:00', 0),
(5, 8, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 05:24:46', '0000-00-00 00:00:00', 0),
(6, 13, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 100 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:23:41', '0000-00-00 00:00:00', 0),
(7, 14, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 100 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:23:52', '0000-00-00 00:00:00', 0),
(8, 15, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 100 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:23:52', '0000-00-00 00:00:00', 0),
(9, 16, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 100 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:24:38', '0000-00-00 00:00:00', 0),
(10, 17, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:26:02', '0000-00-00 00:00:00', 0),
(11, 18, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 06:44:46', '0000-00-00 00:00:00', 0),
(12, 19, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 07:15:29', '0000-00-00 00:00:00', 0),
(13, 20, '\r\n			<ol>\r\n				<li>Harga penawaran sudah termasuk pajak-pajak.</li>\r\n				<li>Durasi auction selama 2 menit, tanpa ada penambahan waktu.</li>\r\n				<li>Metode auction menggunakan metode posisi/rangking, dimana para peserta e-auction hanya\r\n					mengetahui posisi/rangking dari penawaran harga yang telah dimasukkan dibandingkan dengan\r\n					penawaran harga peserta e-auction lainnya.</li>\r\n				<li>Tidak ada batas harga penawaran minimum yang dapat dimasukkan.</li>\r\n				<li>Harga penawaran yang dimasukkan tidak boleh sama atau lebih tinggi dari harga penawaran yang telah dimasukkan sebelumnya.</li>\r\n				<li>Apabila terdapat penawaran harga yang sama, maka posisi/rangking yang lebih tinggi akan diberikan kepada penawar harga terendah yang masuk terlebih dahulu</li>\r\n				<li>Selama auction berlangsung, peserta tidak diperkenankan menggunakan tombol Back (backspace) dan Refresh (F5). </li>\r\n				<li>Selama auction berlangsung, para peserta dilarang saling berkomunikasi dan dilarang menggunakan alat komunikasi apapun.</li>\r\n				<li>Seluruh peserta auction wajib menjaga ketertiban.</li>\r\n			</ol>', '2015-10-25 07:25:38', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_peserta`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_peserta` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `id_proc` bigint(20) DEFAULT NULL,
  `surat` varchar(10) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `is_winner` int(1) DEFAULT '0',
  `is_final_winner` int(1) DEFAULT NULL,
  `id_surat` bigint(20) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  `id_kurs` int(11) DEFAULT NULL,
  `idr_value` bigint(20) DEFAULT NULL,
  `kurs_value` decimal(20,2) DEFAULT NULL,
  `nilai_evaluasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement_peserta`
--

INSERT INTO `ms_procurement_peserta` (`id`, `id_vendor`, `id_proc`, `surat`, `entry_stamp`, `edit_stamp`, `is_winner`, `is_final_winner`, `id_surat`, `del`, `id_kurs`, `idr_value`, `kurs_value`, `nilai_evaluasi`) VALUES
(1, 6, 2, 'siujk', '2015-10-23 08:34:05', NULL, 1, NULL, 1, 0, 3, 4500000, '0.00', 'Bagus'),
(2, 3, 2, 'siup', '2015-10-23 08:35:14', NULL, 0, NULL, 2, 0, NULL, NULL, NULL, '0'),
(3, 4, 1, 'siup', '2015-10-23 08:35:52', NULL, 1, NULL, 3, 0, 3, 801000000, '0.00', '80'),
(4, 4, 3, 'siup', '2015-10-23 08:43:19', NULL, 1, NULL, 3, 1, 3, 50000000, '0.00', 'Memenuhi syarat'),
(5, 7, 4, NULL, '2015-10-24 15:39:56', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 7, 5, NULL, '2015-10-25 03:26:02', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(7, 7, 6, NULL, '2015-10-25 03:42:27', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(8, 7, 7, NULL, '2015-10-25 04:23:00', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(9, 7, 8, NULL, '2015-10-25 05:24:58', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(10, 7, 14, NULL, '2015-10-25 06:23:52', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(11, 7, 15, NULL, '2015-10-25 06:23:52', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(12, 7, 16, NULL, '2015-10-25 06:24:38', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(13, 7, 17, NULL, '2015-10-25 06:26:13', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(14, 7, 18, NULL, '2015-10-25 06:44:46', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(15, 7, 19, NULL, '2015-10-25 07:15:29', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(16, 7, 20, NULL, '2015-10-25 07:25:38', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_procurement_tatacara`
--

CREATE TABLE IF NOT EXISTS `ms_procurement_tatacara` (
  `id` int(11) NOT NULL,
  `id_procurement` int(11) NOT NULL,
  `metode_auction` varchar(255) NOT NULL,
  `metode_penawaran` varchar(255) NOT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL,
  `hps` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_procurement_tatacara`
--

INSERT INTO `ms_procurement_tatacara` (`id`, `id_procurement`, `metode_auction`, `metode_penawaran`, `entry_stamp`, `edit_stamp`, `del`, `hps`) VALUES
(1, 4, 'posisi', 'lump_sum', '2015-10-24 14:56:57', '0000-00-00 00:00:00', 0, 0),
(2, 5, 'posisi', 'lump_sum', '2015-10-25 03:25:49', '0000-00-00 00:00:00', 0, 0),
(3, 6, 'posisi', 'lump_sum', '2015-10-25 03:42:18', '0000-00-00 00:00:00', 0, 0),
(4, 7, 'posisi', 'lump_sum', '2015-10-25 04:22:51', '0000-00-00 00:00:00', 0, 0),
(5, 8, 'posisi', 'lump_sum', '2015-10-25 05:24:46', '0000-00-00 00:00:00', 0, 0),
(6, 9, 'posisi', 'lump_sum', '2015-10-25 06:17:11', '0000-00-00 00:00:00', 0, 0),
(7, 10, 'posisi', 'lump_sum', '2015-10-25 06:18:29', '0000-00-00 00:00:00', 0, 0),
(8, 11, 'posisi', 'lump_sum', '2015-10-25 06:22:49', '0000-00-00 00:00:00', 0, 0),
(9, 12, 'posisi', 'lump_sum', '2015-10-25 06:23:18', '0000-00-00 00:00:00', 0, 0),
(10, 13, 'posisi', 'lump_sum', '2015-10-25 06:23:40', '0000-00-00 00:00:00', 0, 0),
(11, 14, 'posisi', 'lump_sum', '2015-10-25 06:23:52', '0000-00-00 00:00:00', 0, 0),
(12, 15, 'posisi', 'lump_sum', '2015-10-25 06:23:52', '0000-00-00 00:00:00', 0, 0),
(13, 16, 'posisi', 'lump_sum', '2015-10-25 06:24:37', '0000-00-00 00:00:00', 0, 0),
(14, 17, 'posisi', 'lump_sum', '2015-10-25 06:26:02', '0000-00-00 00:00:00', 0, 0),
(15, 18, 'posisi', 'lump_sum', '2015-10-25 06:44:45', '0000-00-00 00:00:00', 0, 0),
(16, 19, 'posisi', 'lump_sum', '2015-10-25 07:15:29', '0000-00-00 00:00:00', 0, 0),
(17, 20, 'posisi', 'lump_sum', '2015-10-25 07:25:38', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_score_k3`
--

CREATE TABLE IF NOT EXISTS `ms_score_k3` (
  `id` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `score` decimal(4,2) DEFAULT NULL,
  `data_status` tinyint(1) DEFAULT NULL,
  `entry_stamp` date DEFAULT NULL,
  `edit_stamp` date DEFAULT NULL,
  `data_last_check` timestamp NULL DEFAULT NULL,
  `data_checker_id` bigint(20) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  `id_csms_limit` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_score_k3`
--

INSERT INTO `ms_score_k3` (`id`, `id_vendor`, `score`, `data_status`, `entry_stamp`, `edit_stamp`, `data_last_check`, `data_checker_id`, `del`, `id_csms_limit`) VALUES
(1, 6, '61.99', 1, '2015-10-23', '2015-10-23', '2015-10-23 08:05:22', 1, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ms_situ`
--

CREATE TABLE IF NOT EXISTS `ms_situ` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `type` varchar(100) DEFAULT NULL COMMENT 'tipe situ : Surat Keterangan Domisili Perusahaan (SKDP), Surat Ijin Tempat Usaha (SITU), Herregisterasi SKDP',
  `no` varchar(100) DEFAULT NULL COMMENT 'nomor SITU',
  `issue_date` date DEFAULT NULL COMMENT 'tanggal keluarnya SITU',
  `issue_by` varchar(45) NOT NULL,
  `address` text COMMENT 'alamat sesuai SITU',
  `situ_file` varchar(35) DEFAULT NULL COMMENT 'server path situ attachement',
  `file_photo` varchar(35) DEFAULT NULL COMMENT 'server path foto lokasi attachement',
  `file_extension_situ` text NOT NULL,
  `expire_date` varchar(11) DEFAULT NULL COMMENT 'expiry date of document. it can be lifetime',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foraeign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_situ`
--

INSERT INTO `ms_situ` (`id`, `id_vendor`, `type`, `no`, `issue_date`, `issue_by`, `address`, `situ_file`, `file_photo`, `file_extension_situ`, `expire_date`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 5, 'Surat Izin Tempat Usaha (SITU)', '0052015', '2009-11-22', 'Kecamatan Kelapa Dua', 'Wisma Nusantara Jl. MH Thamrin No. 20', 'situ_file_231015_105940_578.pdf', NULL, 'file_extension_situ_231015_105940_027.pdf', '2010-11-22', '2015-10-23 03:59:40', '2015-10-23 03:59:40', 0, NULL, NULL, 0),
(2, 6, 'Surat Keterangan Domisili Perusahaan (SKDP)', '123', '2015-10-23', 'kelurahan', 'cawang', 'situ_file_231015_112042_854.pdf', NULL, 'file_extension_situ_231015_112042_754.pdf', '2018-10-23', '2015-10-23 04:20:42', '2015-10-23 04:20:42', 0, NULL, NULL, 1),
(3, 3, 'Surat Keterangan Domisili Perusahaan (SKDP)', '22', '2015-10-23', 'ddd', 'www', 'situ_file_231015_112105_749.pdf', NULL, 'file_extension_situ_231015_112105_538.pdf', '2016-10-23', '2015-10-23 04:21:05', '2015-10-23 04:21:05', 0, NULL, NULL, 1),
(4, 3, 'Surat Keterangan Domisili Perusahaan (SKDP)', '22', '2015-10-23', 'ddd', 'www', 'situ_file_231015_112107_575.pdf', NULL, 'file_extension_situ_231015_112107_573.pdf', '2016-10-23', '2015-10-23 04:21:07', '2015-10-23 04:21:07', 0, NULL, NULL, 1),
(5, 6, 'Surat Keterangan Domisili Perusahaan (SKDP)', '123', '2015-10-23', 'kelurahan', 'cawang', 'situ_file_231015_112152_013.pdf', NULL, 'file_extension_situ_231015_112152_325.pdf', '2018-10-23', '2015-10-23 04:21:52', '2015-10-23 04:23:56', 0, NULL, NULL, 1),
(6, 3, 'Surat Keterangan Domisili Perusahaan (SKDP)', '22', '2015-10-23', 'ff', 'ddd', 'situ_file_231015_112834_487.pdf', NULL, 'file_extension_situ_231015_112834_332.pdf', '2016-10-23', '2015-10-23 04:28:34', '2015-10-23 04:28:34', 2, '2015-10-23 08:17:39', 1, 0),
(7, 6, 'Surat Keterangan Domisili Perusahaan (SKDP)', '123', '2015-10-23', 'kelurahan', 'cawang', 'situ_file_231015_112856_159.pdf', NULL, 'file_extension_situ_231015_112856_877.pdf', '2018-10-23', '2015-10-23 04:28:56', '2015-10-23 04:28:56', 2, '2015-10-23 08:00:59', 1, 0),
(8, 4, 'Surat Keterangan Domisili Perusahaan (SKDP)', '124124', '2015-10-23', 'kantor pos', 'Jl. terus aja tanpa liat', 'situ_file_231015_021516_192.pdf', NULL, 'file_extension_situ_231015_021516_193.pdf', 'lifetime', '2015-10-23 07:15:16', '2015-10-23 07:15:16', 2, '2015-10-23 08:08:46', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_tdp`
--

CREATE TABLE IF NOT EXISTS `ms_tdp` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `no` varchar(45) DEFAULT NULL,
  `issue_date` date DEFAULT NULL COMMENT 'tanggal keluarnya TDP',
  `expiry_date` varchar(11) DEFAULT NULL COMMENT 'expiry date of document. it can be lifetime',
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `tdp_file` varchar(40) DEFAULT NULL COMMENT 'server path tdp attachement',
  `authorize_by` varchar(200) DEFAULT NULL,
  `extension_file` varchar(40) DEFAULT NULL,
  `data_status` int(3) DEFAULT '0' COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foraeign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0',
  `ms_tdpcol` varchar(45) DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_tdp`
--

INSERT INTO `ms_tdp` (`id`, `id_vendor`, `no`, `issue_date`, `expiry_date`, `entry_stamp`, `tdp_file`, `authorize_by`, `extension_file`, `data_status`, `data_last_check`, `data_checker_id`, `del`, `ms_tdpcol`, `edit_stamp`) VALUES
(1, 5, '006', '2009-11-23', 'lifetime', '2015-10-23 04:05:32', 'tdp_file_231015_110532_186.pdf', 'Pemda DKI', 'extension_file_231015_110532_101.pdf', 0, NULL, NULL, 0, NULL, NULL),
(2, 3, '44', '2015-10-23', '2015-10-28', '2015-10-23 04:23:34', 'tdp_file_231015_112334_642.pdf', 'hh', 'extension_file_231015_112334_441.pdf', 2, '2015-10-23 08:17:56', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_vendor`
--

CREATE TABLE IF NOT EXISTS `ms_vendor` (
  `id` bigint(20) NOT NULL,
  `id_sbu` int(5) DEFAULT NULL COMMENT 'foriegn key from id on ms_sbu',
  `vendor_status` tinyint(1) DEFAULT '0' COMMENT '0 - Entry Baru\n1 - Daftar Tunggu\n2 - DPT aktif\n3 - DPTS',
  `npwp_code` varchar(20) DEFAULT NULL COMMENT 'nomor NPWP vendor',
  `vendor_code` varchar(50) DEFAULT NULL COMMENT 'kode vendor readable (integrasi ke oracle)',
  `name` varchar(150) DEFAULT NULL COMMENT 'nama vendor',
  `is_active` tinyint(1) DEFAULT '1' COMMENT 'indicating is vendor is active or not',
  `ever_blacklisted` tinyint(1) DEFAULT '0' COMMENT '0 - vendor never blacklisted before\n1 - vendor ever blacklisted at least 1x',
  `dpt_first_date` datetime DEFAULT NULL,
  `is_vms` tinyint(1) DEFAULT '1',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_vendor`
--

INSERT INTO `ms_vendor` (`id`, `id_sbu`, `vendor_status`, `npwp_code`, `vendor_code`, `name`, `is_active`, `ever_blacklisted`, `dpt_first_date`, `is_vms`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 0, '  .   .   . -   .   ', NULL, 'kjnkjnk', 1, 0, NULL, 0, '2015-10-23 03:02:38', NULL, 0),
(2, 1, 0, '84.092.340.9-239.272', NULL, 'zulfahmi', 1, 0, NULL, 1, '2015-10-23 03:10:25', NULL, 0),
(3, 1, 2, '83.983.989.8-989.899', NULL, 'ayu', 1, 0, NULL, 1, '2015-10-23 03:13:34', '2015-10-23 07:45:11', 0),
(4, 1, 2, '89.328.398.2-983.929', NULL, 'pandu pradito', 1, 0, NULL, 1, '2015-10-23 03:14:47', '2015-10-23 07:48:46', 0),
(5, 1, 0, '79.997.879.8-798.798', NULL, 'zulfahmi', 1, 0, NULL, 1, '2015-10-23 03:15:42', '2015-10-23 03:44:14', 0),
(6, 1, 2, '87.264.762.8-746.877', NULL, 'amathul baasyith', 1, 0, NULL, 1, '2015-10-23 03:16:57', '2015-10-23 06:46:31', 0),
(7, 1, 2, '88.235.709.9-934.582', NULL, 'Dekodr Solusi Digital', 1, 0, NULL, 1, '2015-10-24 15:11:46', '2015-10-24 15:17:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_vendor_admistrasi`
--

CREATE TABLE IF NOT EXISTS `ms_vendor_admistrasi` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'foriegn key from id on ms_vendor',
  `id_legal` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_legal',
  `npwp_code` varchar(20) DEFAULT NULL COMMENT 'nomor NPWP vendor',
  `npwp_date` date DEFAULT NULL COMMENT 'tanggal pengukuhan NPWP',
  `npwp_file` varchar(40) DEFAULT NULL COMMENT 'server path lampiran NPWP',
  `nppkp_code` varchar(45) DEFAULT NULL COMMENT 'nomor NPPKP vendor',
  `nppkp_date` date DEFAULT NULL COMMENT 'tanggal pengukuhan NPPKP vendor',
  `nppkp_file` varchar(30) DEFAULT NULL COMMENT 'server path lampiran NPPKP vendor',
  `vendor_office_status` varchar(7) NOT NULL COMMENT 'status kantor vendor (pusat/cabang)',
  `vendor_address` text COMMENT 'alamat vendor',
  `vendor_country` varchar(50) DEFAULT NULL COMMENT 'foriegn key from id on tb_city',
  `vendor_province` varchar(50) DEFAULT NULL COMMENT 'foriegn key from id on tb_province',
  `vendor_city` varchar(50) DEFAULT NULL COMMENT 'foriegn key from id on tb_city',
  `vendor_phone` varchar(25) DEFAULT NULL COMMENT 'no. telp vendor',
  `vendor_fax` varchar(15) DEFAULT NULL COMMENT 'no fax vendor',
  `vendor_email` varchar(50) DEFAULT NULL COMMENT 'email vendor',
  `vendor_postal` varchar(10) DEFAULT NULL,
  `vendor_website` varchar(60) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last edit timestamp',
  `data_status` int(3) DEFAULT NULL COMMENT 'data validation status :\n0 - not checked\n1 - ok, mandatory\n2 - ok, not mandatory\n3 - not ok, mandatory\n4 - not ok, not mandatory',
  `data_last_check` timestamp NULL DEFAULT NULL COMMENT 'data validation date',
  `data_checker_id` bigint(20) DEFAULT NULL COMMENT 'data validator id, foreign key from id at ms_admin',
  `del` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_vendor_admistrasi`
--

INSERT INTO `ms_vendor_admistrasi` (`id`, `id_vendor`, `id_legal`, `npwp_code`, `npwp_date`, `npwp_file`, `nppkp_code`, `nppkp_date`, `nppkp_file`, `vendor_office_status`, `vendor_address`, `vendor_country`, `vendor_province`, `vendor_city`, `vendor_phone`, `vendor_fax`, `vendor_email`, `vendor_postal`, `vendor_website`, `entry_stamp`, `edit_stamp`, `data_status`, `data_last_check`, `data_checker_id`, `del`) VALUES
(1, 2, 1, '84.092.340.9-239.272', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 'abc@gmail.com', NULL, NULL, '2015-10-23 03:10:25', NULL, NULL, NULL, NULL, 0),
(2, 3, 1, '83.983.989.8-989.899', '2015-10-23', NULL, '333333', '2015-10-23', 'nppkp_file_231015_110323_400.p', 'pusat', 'Ged. Wisma Nusantara Lt. 19', 'Indonesia', 'DKI Jakarta', 'Jakarta ', '0213159543', '0213159525', 'ayu@nusantararegas.com', '10350', 'nusantararegas.com', '2015-10-23 03:13:34', NULL, 2, '2015-10-23 08:30:38', 1, 0),
(3, 4, 1, '89.328.398.2-983.929', '2015-10-23', 'npwp_file_231015_105031_886.jpg', '123124', '2015-10-23', 'nppkp_file_231015_105031_951.j', 'pusat', 'JL. terus pantang mundur', 'Indonesia', 'Central Jakarta', 'Jakarta', '+62213159543', '213213126', 'pradito@nusantararegas.com', '10350', 'nusantararegas.com', '2015-10-23 03:14:47', NULL, 2, '2015-10-23 08:06:32', 1, 0),
(4, 5, 6, '79.997.879.8-798.798', '2008-10-23', NULL, 'NP/142/140/2008', '2008-10-23', 'nppkp_file_231015_104357_993.p', 'pusat', 'Wisma Nusantara Lt.-19 Jl. MH Thamrin No. 20', 'Indonesia', 'DKI Jakarta', 'Jakarta', '0218516686', '0218516686', 'zulfahmi@nusantararegas.com', '13120', 'www.nusantararegas.com', '2015-10-23 03:15:42', NULL, NULL, NULL, NULL, 0),
(5, 6, 4, '87.264.762.8-746.877', '2015-10-23', NULL, '975636364597', '2015-10-23', NULL, 'pusat', 'wisma nusantara', 'indonesia', 'jakpus', 'jakarta pusat', '0213159535', '0213154535', 'amathul@nusantararegas.com', '10320', '', '2015-10-23 03:16:57', NULL, 2, '2015-10-23 07:59:13', 1, 0),
(6, 7, 1, '88.235.709.9-934.582', '2015-10-24', 'npwp_file_241015_101656_390.png', '078419724', '2015-10-24', 'nppkp_file_241015_101656_044.p', 'pusat', 'Pabuaran', 'Indonesia', 'Jawa Barat', 'Bogor', '+6285776689423', '122287728', 'muarifgustiar@gmail.com', '16916', 'dekodr-indonesia.co.id', '2015-10-24 15:11:46', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_vendor_pic`
--

CREATE TABLE IF NOT EXISTS `ms_vendor_pic` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `pic_name` varchar(100) DEFAULT NULL,
  `pic_position` varchar(100) DEFAULT NULL,
  `pic_phone` varchar(50) DEFAULT NULL,
  `pic_email` varchar(50) DEFAULT NULL,
  `pic_address` text,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_vendor_pic`
--

INSERT INTO `ms_vendor_pic` (`id`, `id_vendor`, `pic_name`, `pic_position`, `pic_phone`, `pic_email`, `pic_address`, `entry_stamp`, `edit_stamp`) VALUES
(1, 6, 'Amathul Basyith', 'Officer Sistem Pengendalian dan Evaluasi', '08159859785', 'amathul@nusantararegas.com', 'Wisma Nusantara', '2015-10-23 03:24:23', NULL),
(2, 6, 'Amathul Basyith', 'Officer Sistem Pengendalian dan Evaluasi', '08159859785', 'amathul@nusantararegas.com', 'Wisma Nusantara', '2015-10-23 03:25:12', NULL),
(3, 5, 'Zulfahmi', 'Direktur ', '0218516686', 'zulfahmi@nusantararegas.com', 'Wisma Nusantara Jl. MH Thamrin No. 20', '2015-10-23 03:29:29', NULL),
(4, 3, 'Ayudya ', 'Direktur', '0213159543', 'ayu@nusantararegas.com', 'Ged. Wisma Nusantara lt. 19', '2015-10-23 03:29:53', NULL),
(5, 4, 'pandu pradito', 'Direktur', '081233913131', 'pradito@nusantararegas.com', 'Jl. Terus jangan belok', '2015-10-23 03:31:28', NULL),
(6, 7, 'Muarif Gustiar Aliyudin', 'Programmer', '085723256821', 'muarifgustiar@gmail.com', 'Bogor', '2015-10-24 15:12:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE IF NOT EXISTS `tb_bidang` (
  `id` int(5) NOT NULL,
  `id_dpt_type` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_dpt_type',
  `name` varchar(200) DEFAULT NULL COMMENT 'nama bidang',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `del` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`id`, `id_dpt_type`, `name`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 'Konstruksi', NULL, NULL, 1),
(29, 1, 'Pengadaan Barang', NULL, '2013-02-07 01:49:39', 0),
(30, 2, 'Arsitektur', NULL, NULL, 0),
(31, 2, 'Sipil', NULL, NULL, 0),
(32, 2, 'Mekanikal', NULL, NULL, 0),
(33, 2, 'Elektrikal', NULL, NULL, 0),
(34, 2, 'Tata Lingkungan', NULL, NULL, 0),
(35, 3, 'Arsitektural', NULL, NULL, 0),
(36, 3, 'Jasa Inspeksi Tekhnis', NULL, NULL, 0),
(37, 3, 'Sipil', NULL, '2012-10-30 21:16:34', 0),
(38, 3, 'Jasa Manajemen Proyek', NULL, NULL, 0),
(39, 3, 'Mekanikal', NULL, NULL, 0),
(40, 3, 'Elektrikal', NULL, NULL, 0),
(41, 3, 'Tata Lingkungan', NULL, NULL, 0),
(42, 3, 'Jasa Survey', NULL, NULL, 0),
(43, 3, 'Jasa Analisis &amp; Enjiniring Lainnya', NULL, NULL, 0),
(44, 4, 'Jasa Konsultan Bidang Pengembangan Pertanian dan Pedesaan', NULL, NULL, 0),
(45, 4, 'Jasa Konsultan Bidang Telematika', NULL, NULL, 0),
(46, 4, 'Jasa Konsultan Perangkat Keras', NULL, NULL, 0),
(47, 4, 'Jasa Konsultan Konten &amp; Aplikasi', NULL, NULL, 0),
(48, 4, 'Jasa Konsultan Bidang Perindustrian dan Pertambangan', NULL, NULL, 0),
(49, 4, 'Jasa Konsultan Bidang Energi', NULL, NULL, 0),
(50, 4, 'Jasa Konsultan Bidang Keuangan', NULL, NULL, 0),
(51, 4, 'Jasa Konsultan Bidang Pendidikan', NULL, NULL, 0),
(52, 4, 'Jasa Konsultan Bidang Rekayasa Industri', NULL, NULL, 0),
(53, 4, 'Jasa Konsultan Bidang Survey', NULL, NULL, 0),
(54, 4, 'Jasa Konsultan Studi, Penelitian &amp; Bantuan Teknik', NULL, NULL, 0),
(55, 4, 'Jasa Konsultasi Manajemen &amp; Hukum', NULL, NULL, 0),
(56, 4, 'Jasa Konsultan Khusus', NULL, NULL, 0),
(57, 5, 'Jasa Lainnya', NULL, NULL, 0),
(58, 2, 'Industri Proses', '2013-02-13 19:36:21', NULL, 0),
(59, 2, 'Industri Manufaktur', '2013-06-14 09:50:09', NULL, 0),
(60, 2, 'Energi & Infrastruktur Non Sipil', '2013-06-14 10:01:59', NULL, 0),
(61, 2, 'Infrastruktur Non Sipil', '2013-06-14 10:02:41', NULL, 0),
(62, 3, 'Jasa Enjiniring Terpadu', '2013-06-18 03:25:40', NULL, 0),
(66, 2, 'Jasa Pelaksanaan Lainnya', '2014-08-12 04:07:23', NULL, 0),
(67, 2, 'Jasa Pelaksanaan Spesialis', '2014-08-12 04:08:14', NULL, 0),
(68, 2, 'Jasa Pelaksanaan Keterampilan', '2014-08-12 04:08:45', NULL, 0),
(69, 2, 'coba', '2014-09-25 12:16:28', '2015-10-23 04:23:17', 0),
(70, 2, 'Bangunan Sipil', '2014-09-25 12:16:54', NULL, 0),
(71, 2, 'Instalasi Mekanikal&Elektrikal', '2014-09-25 12:17:45', NULL, 0),
(72, 2, 'Jasa Pelaksanaan Lainnya', '2014-09-25 12:18:15', NULL, 0),
(73, 2, 'Jasa Konstruksi Terintegrasi', '2015-01-08 04:35:11', NULL, 0),
(74, 2, 'test123', '2015-10-05 08:36:10', NULL, 1),
(75, 1, 'muarif321', '2015-10-05 08:37:11', NULL, 1),
(76, 2, 'muarif', '2015-10-05 09:42:23', NULL, 1),
(77, 2, 'hapusasd', '2015-10-22 13:28:26', '2015-10-22 13:29:05', 1),
(78, 3, 'mkmk', '2015-10-23 07:41:31', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_blacklist_limit`
--

CREATE TABLE IF NOT EXISTS `tb_blacklist_limit` (
  `id` int(5) NOT NULL,
  `start_score` int(5) DEFAULT NULL,
  `end_score` int(5) DEFAULT NULL,
  `number_range` int(10) DEFAULT NULL,
  `range_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_blacklist_limit`
--

INSERT INTO `tb_blacklist_limit` (`id`, `start_score`, `end_score`, `number_range`, `range_time`) VALUES
(1, -61, -120, 1, 'year'),
(2, -121, 0, 0, 'forever');

-- --------------------------------------------------------

--
-- Table structure for table `tb_budget_holder`
--

CREATE TABLE IF NOT EXISTS `tb_budget_holder` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_budget_holder`
--

INSERT INTO `tb_budget_holder` (`id`, `name`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Divisi operasi', NULL, NULL),
(2, 'Divisi SDM & Umum', NULL, NULL),
(3, 'Divisi Keuangan & Akuntansi', NULL, NULL),
(4, 'Divisi Komersial & pengembangan  bisnis', NULL, NULL),
(5, 'Divisi Engineering & pemeliharaan', NULL, NULL),
(6, 'Sekretaris Perusahaan', NULL, NULL),
(7, 'Departemen Hukum', NULL, NULL),
(8, 'Departemen QHSSE', NULL, NULL),
(9, 'Departemen SPI', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_budget_spender`
--

CREATE TABLE IF NOT EXISTS `tb_budget_spender` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_copy1` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_budget_spender`
--

INSERT INTO `tb_budget_spender` (`id`, `name`, `id_copy1`, `edit_stamp`) VALUES
(1, 'Divisi Operasi', NULL, NULL),
(2, 'Divisi SDM & Umum', NULL, NULL),
(3, 'Divisi Keuangan & Akuntansi', NULL, NULL),
(4, 'Divisi Komersial & pengembangan  bisnis', NULL, NULL),
(5, 'Divisi Engineering & pemeliharaan', NULL, NULL),
(6, 'Sekretaris Perusahaan', NULL, NULL),
(7, 'Departemen Hukum', NULL, NULL),
(8, 'Departemen QHSSE', NULL, NULL),
(9, 'Departemen SPI', NULL, NULL),
(10, 'Departemen Komersial LNG & Gas', NULL, NULL),
(11, 'Departemen Perencanaan & Pengembangan', NULL, NULL),
(12, 'Departemen Pemeliharaan', NULL, NULL),
(13, 'Departemen Engineering', NULL, NULL),
(14, 'Departemen Transportasi LNG & Operasi FSRU', NULL, NULL),
(15, 'Departemen Distribusi Gas dan ORF', NULL, NULL),
(16, 'Departemen Akuntansi', NULL, NULL),
(17, 'Departemen Perbendaharaan', NULL, NULL),
(18, 'Departemen Layanan Umum', NULL, NULL),
(19, 'Departemen SDM', NULL, NULL),
(20, 'Departemen Sistem Informasi', NULL, NULL),
(21, 'Departemen Logistik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_city`
--

CREATE TABLE IF NOT EXISTS `tb_city` (
  `id` int(5) NOT NULL,
  `id_country` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_country',
  `id_province` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_province',
  `name` varchar(15) DEFAULT NULL COMMENT 'nama badan usaha',
  `index` tinyint(2) DEFAULT NULL COMMENT 'data ording index',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_city`
--

INSERT INTO `tb_city` (`id`, `id_country`, `id_province`, `name`, `index`, `entry_stamp`, `edit_stamp`) VALUES
(1, 1, 1, 'Jakarta Selatan', 1, '2015-03-10 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_country`
--

CREATE TABLE IF NOT EXISTS `tb_country` (
  `id` int(5) NOT NULL,
  `name` varchar(15) DEFAULT NULL COMMENT 'nama badan usaha',
  `index` tinyint(2) DEFAULT NULL COMMENT 'data ording index',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_country`
--

INSERT INTO `tb_country` (`id`, `name`, `index`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Indonesia', 1, '2015-03-10 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_csms_limit`
--

CREATE TABLE IF NOT EXISTS `tb_csms_limit` (
  `id` int(11) NOT NULL,
  `start_score` int(11) DEFAULT NULL,
  `end_score` int(11) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `entry_stamp` datetime DEFAULT NULL,
  `end_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_csms_limit`
--

INSERT INTO `tb_csms_limit` (`id`, `start_score`, `end_score`, `value`, `entry_stamp`, `end_stamp`) VALUES
(1, 0, 30, 'hitam', NULL, NULL),
(2, 30, 60, 'merah', NULL, NULL),
(3, 61, 120, 'kuning', NULL, NULL),
(4, 121, NULL, 'hijau', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dpt_type`
--

CREATE TABLE IF NOT EXISTS `tb_dpt_type` (
  `id` int(5) NOT NULL,
  `name` varchar(60) DEFAULT NULL COMMENT 'nama tipe DPT'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dpt_type`
--

INSERT INTO `tb_dpt_type` (`id`, `name`) VALUES
(1, 'Pengadaan Barang'),
(2, 'Jasa Konsultan non-Konstruksi'),
(3, 'Jasa Lainnya'),
(4, 'Jasa Pekerjaan Konstruksi'),
(5, 'Jasa Konsultan Perencana/Pengawas Konstruksi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_evaluasi`
--

CREATE TABLE IF NOT EXISTS `tb_evaluasi` (
  `id` int(5) NOT NULL,
  `id_ms_quest` int(5) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `point_a` int(1) DEFAULT NULL,
  `point_b` int(1) DEFAULT NULL,
  `point_c` int(1) DEFAULT NULL,
  `point_d` int(1) DEFAULT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id`, `id_ms_quest`, `name`, `point_a`, `point_b`, `point_c`, `point_d`, `del`) VALUES
(1, 1, 'ITEM 1', 0, 4, 8, 12, 0),
(2, 2, 'ITEM 2', 0, 4, 8, 12, 0),
(3, 3, 'ITEM 3 (1)', 0, 4, 8, 12, 0),
(4, 3, 'ITEM 3 (2)', 0, 4, 8, 12, 0),
(5, 3, 'ITEM 3 (A) – (D)', 0, 4, 8, 12, 0),
(6, 3, 'ITEM 3 (4) (A) AND (B) AND 3 (5)', 0, 4, 8, 12, 0),
(7, 3, 'ITEM 3 (6) (A) – (C)', 0, 4, 8, 12, 0),
(8, 3, 'ITEM 3 (7) (A) – (C)', 0, 4, 8, 12, 0),
(9, 4, 'ITEM 4 (1)', 0, 4, 8, 12, 0),
(10, 4, 'ITEM 4 (2)', 0, 4, 8, 12, 0),
(11, 4, 'ITEM 4 (3)', 0, 4, 8, 12, 0),
(12, 4, 'ITEM 4 (4)', 0, 4, 8, 12, 0),
(13, 4, 'ITEM 4 (5)', 0, 4, 8, 12, 0),
(14, 4, 'ITEM 4 (6)', 0, 4, 8, 12, 0),
(15, 4, 'ITEM 4 (7)', 0, 4, 8, 12, 0),
(16, 5, 'ITEM 5 (1) (A) AND (B)', 0, 4, 8, 12, 0),
(17, 5, 'ITEM 5 (2)', 0, 4, 8, 12, 0),
(18, 5, 'ITEM 5 (3)', 0, 4, 8, 12, 0),
(19, 6, 'ITEM 6 (1) (A) – (D) ', 0, 4, 8, 12, 0),
(20, 6, 'ITEM 6 (2) (A) – (B)', 0, 4, 8, 12, 0),
(21, 6, 'ITEM 6 (3)', 0, 4, 8, 12, 0),
(22, 6, 'ITEM 6 (4) (A) – (D)', 0, 4, 8, 12, 0),
(23, 6, 'ITEM 6 (5) (A) – (D) ', 0, 4, 8, 12, 0),
(24, 7, 'ITEM 7', 0, 3, 7, 10, 0),
(25, 8, 'ITEM 8', 0, 3, 7, 10, 0),
(26, 9, 'ITEM 9', 0, 2, 5, 8, 0),
(27, NULL, 'test', 1, 2, 3, 4, 0),
(28, 3, 'TEST', 4, 3, 2, 1, 0),
(29, 9, 'kesembilan', 5, 6, 7, 8, 0),
(30, 2, 'sdjksd', -19, -1, 7, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurs`
--

CREATE TABLE IF NOT EXISTS `tb_kurs` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `symbol` varchar(3) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL,
  `session_id` varchar(10) DEFAULT NULL,
  `del` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kurs`
--

INSERT INTO `tb_kurs` (`id`, `name`, `symbol`, `entry_stamp`, `edit_stamp`, `session_id`, `del`) VALUES
(3, 'US Dollar', 'USD', '2012-11-09 01:01:12', '2015-10-08 18:53:12', NULL, 0),
(2, 'Great Britain Pounds', 'GBP', '2012-07-23 04:49:09', NULL, NULL, 0),
(1, 'Indonesia Rupiah', 'IDR', '2015-10-18 09:41:58', NULL, NULL, 0),
(7, 'hapushapus', 'asd', '2015-10-22 13:30:27', '2015-10-22 13:30:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_legal`
--

CREATE TABLE IF NOT EXISTS `tb_legal` (
  `id` int(5) NOT NULL,
  `name` varchar(15) DEFAULT NULL COMMENT 'nama badan usaha',
  `index` tinyint(2) DEFAULT NULL COMMENT 'data ording index',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_legal`
--

INSERT INTO `tb_legal` (`id`, `name`, `index`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 'PT', 1, '2015-11-02 17:00:00', '2015-10-23 04:04:47', 0),
(2, 'CV', 2, '2015-11-02 17:00:00', '2015-10-23 04:17:34', 0),
(3, 'Firma', 3, '2015-11-02 17:00:00', NULL, 0),
(4, 'Yayasan', 4, '2015-11-02 17:00:00', NULL, 0),
(5, 'Badan Lainnya', 8, '2015-11-02 17:00:00', NULL, 0),
(6, 'Lembaga', 5, '2015-11-02 17:00:00', NULL, 0),
(7, 'KAP', 6, '2015-11-02 17:00:00', NULL, 0),
(8, 'KJPP', 7, '2015-11-02 17:00:00', NULL, 0),
(9, 'asda sd', NULL, '2015-10-08 18:34:13', NULL, 1),
(10, 'hapushapus', NULL, '2015-10-22 13:22:22', '2015-10-22 13:22:26', 1),
(11, 'toko', NULL, '2015-10-23 04:05:19', '2015-10-23 04:15:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mekanisme`
--

CREATE TABLE IF NOT EXISTS `tb_mekanisme` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_mekanisme`
--

INSERT INTO `tb_mekanisme` (`id`, `name`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Auction', NULL, NULL),
(2, 'Pemilihan Langsung', '0000-00-00 00:00:00', NULL),
(3, 'Penunjukan Langsung', '0000-00-00 00:00:00', NULL),
(5, 'Pelelangan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ms_quest_k3`
--

CREATE TABLE IF NOT EXISTS `tb_ms_quest_k3` (
  `id` int(5) NOT NULL,
  `question` text,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ms_quest_k3`
--

INSERT INTO `tb_ms_quest_k3` (`id`, `question`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 'KEPEMIMPINAN DAN KOMITMEN', '2015-10-16 08:43:06', '2015-10-16 08:42:28', 0),
(2, 'TUJUAN DAN STRATEGI', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(3, 'ORGANISASI, TANGGUNG JAWAB, SUMBER DAYA, STANDAR DAN DOKUMENTASI', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(4, 'PENANGANAN BAHAYA DAN DAMPAK', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(5, 'PLANNING DAN PROSEDUR', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(6, 'PEMANTAUAN IMPLEMENTASI DAN KINERJA', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(7, 'AUDIT DAN PENINJAUAN', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(8, 'PROSEDUR TANGGAP DARURAT (EMERGENCY RESPONSE PROCEDURE)', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(9, 'MANAJEMEN K3 – CIRI TAMBAHAN', '2015-10-14 10:49:38', '0000-00-00 00:00:00', 0),
(10, 'asdsad ', '2015-10-14 18:05:08', '0000-00-00 00:00:00', 0),
(11, 'a sdsa d', '2015-10-14 18:06:10', '0000-00-00 00:00:00', 0),
(12, 'asdasd', '2015-10-16 09:27:15', '0000-00-00 00:00:00', 1),
(13, NULL, '2015-10-22 08:11:43', '0000-00-00 00:00:00', 1),
(14, NULL, '2015-10-22 08:11:39', '0000-00-00 00:00:00', 1),
(15, NULL, '2015-10-22 06:44:47', '0000-00-00 00:00:00', 1),
(16, 'test', '2015-10-22 12:41:26', '0000-00-00 00:00:00', 1),
(17, 'test ini harusnya 16<p></p>', '2015-10-22 06:44:40', '0000-00-00 00:00:00', 1),
(18, 'nkjnjnjnj<p></p>', '2015-10-23 07:28:11', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pejabat_pengadaan`
--

CREATE TABLE IF NOT EXISTS `tb_pejabat_pengadaan` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pejabat_pengadaan`
--

INSERT INTO `tb_pejabat_pengadaan` (`id`, `name`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Manager Logistik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'GM SDM dan Umum', '0000-00-00 00:00:00', NULL),
(3, 'Direktur Keuangan dan Umum', '0000-00-00 00:00:00', NULL),
(4, 'Direktur Utama', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_progress_pengadaan`
--

CREATE TABLE IF NOT EXISTS `tb_progress_pengadaan` (
  `id` int(11) NOT NULL,
  `value` text,
  `color` varchar(8) DEFAULT NULL,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_progress_pengadaan`
--

INSERT INTO `tb_progress_pengadaan` (`id`, `value`, `color`, `entry_stamp`, `edit_stamp`) VALUES
(1, ' Pengeluaran Dokumen Pengadaan', '#1abc9c', NULL, NULL),
(2, 'Annwijzing', '#2ecc71', NULL, NULL),
(3, 'Pemasukan Penawaran', '#3498db', NULL, NULL),
(4, 'Evaluasi Administrasi', '#9b59b6', NULL, NULL),
(5, 'Evaluasi Teknis', '#f1c40f', NULL, NULL),
(6, 'Klarifikasi & Negosiasi', '#e67e22', NULL, NULL),
(7, 'Laporan Pengadaan', '#e74c3c', NULL, NULL),
(8, 'Pengumuman Pemenang', '#FDE3A7', NULL, NULL),
(9, 'Penunjukkan Pemenang (SPPBJ)', '#D35400', NULL, NULL),
(10, 'SPMK', '#E26A6A', NULL, NULL),
(11, 'Kontrak', '#8E44AD', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_province`
--

CREATE TABLE IF NOT EXISTS `tb_province` (
  `id` int(5) NOT NULL,
  `id_country` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_country',
  `name` varchar(15) DEFAULT NULL COMMENT 'nama badan usaha',
  `index` tinyint(2) DEFAULT NULL COMMENT 'data ording index',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_province`
--

INSERT INTO `tb_province` (`id`, `id_country`, `name`, `index`, `entry_stamp`, `edit_stamp`) VALUES
(1, 1, 'DKI Jakarta', 1, '2015-03-10 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_quest`
--

CREATE TABLE IF NOT EXISTS `tb_quest` (
  `id` int(11) NOT NULL,
  `id_ms_header` int(11) DEFAULT NULL,
  `id_sub_header` int(11) DEFAULT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_evaluasi` int(11) DEFAULT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_quest`
--

INSERT INTO `tb_quest` (`id`, `id_ms_header`, `id_sub_header`, `entry_stamp`, `edit_stamp`, `id_evaluasi`, `del`) VALUES
(1, 1, 1, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 1, 0),
(2, 1, 1, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 1, 0),
(3, 1, 1, '2015-10-22 13:19:06', '2015-10-22 13:19:03', 5, 0),
(4, 2, 2, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 2, 0),
(5, 2, 2, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 2, 0),
(6, 2, 3, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 2, 0),
(7, 2, 3, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 2, 0),
(8, 3, 4, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 3, 0),
(9, 3, 4, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 3, 0),
(10, 3, 4, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 3, 0),
(11, 3, 4, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 3, 0),
(12, 3, 5, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 4, 0),
(13, 3, 6, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 5, 0),
(14, 3, 6, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 5, 0),
(15, 3, 7, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 5, 0),
(16, 3, 7, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 5, 0),
(17, 3, 8, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 6, 0),
(18, 3, 8, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 6, 0),
(19, 3, 9, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 6, 0),
(20, 3, 10, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 7, 0),
(21, 3, 10, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 7, 0),
(22, 3, 10, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 7, 0),
(23, 3, 10, '2015-10-14 17:25:11', '0000-00-00 00:00:00', NULL, 0),
(24, 3, 11, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 8, 0),
(25, 3, 11, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 8, 0),
(26, 3, 11, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 8, 0),
(27, 3, 11, '2015-10-14 17:25:11', '0000-00-00 00:00:00', NULL, 0),
(28, 3, 11, '2015-10-14 17:25:11', '0000-00-00 00:00:00', NULL, 0),
(29, 4, 12, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 9, 0),
(30, 4, 13, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 10, 0),
(31, 4, 14, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 11, 0),
(32, 4, 15, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 12, 0),
(33, 4, 15, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 12, 0),
(34, 4, 15, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 12, 0),
(35, 4, 15, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 12, 0),
(36, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(37, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(38, 4, 16, '2015-10-22 13:16:39', '2015-10-22 13:16:36', 2, 0),
(39, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(40, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(41, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(42, 4, 16, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 13, 0),
(43, 4, 17, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 14, 0),
(44, 4, 17, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 14, 0),
(45, 4, 17, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 14, 0),
(46, 4, 18, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 15, 0),
(47, 5, 19, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 16, 0),
(48, 5, 19, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 16, 0),
(49, 5, 20, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 17, 0),
(50, 5, 21, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 18, 0),
(51, 6, 22, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 19, 0),
(52, 6, 22, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 19, 0),
(53, 6, 22, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 19, 0),
(54, 6, 22, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 19, 0),
(55, 6, 23, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 20, 0),
(56, 6, 23, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 20, 0),
(57, 6, 24, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 21, 0),
(58, 6, 25, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 22, 0),
(59, 6, 25, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 22, 0),
(60, 6, 26, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 23, 0),
(61, 6, 26, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 23, 0),
(62, 6, 26, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 23, 0),
(63, 6, 26, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 23, 0),
(64, 7, 0, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 24, 0),
(65, 7, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 24, 0),
(66, 7, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 24, 0),
(67, 7, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 24, 0),
(68, 8, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 25, 0),
(69, 9, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 26, 0),
(70, 9, NULL, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 26, 0),
(71, 6, 25, '2015-10-14 17:25:11', '0000-00-00 00:00:00', 22, 0),
(73, 1, 1, '2015-10-22 08:59:16', '0000-00-00 00:00:00', NULL, 1),
(75, 3, 11, '2015-10-22 08:59:36', '0000-00-00 00:00:00', NULL, 1),
(77, 1, 1, '2015-10-22 09:22:31', '0000-00-00 00:00:00', 3, 1),
(78, 1, 1, '2015-10-22 09:25:40', '0000-00-00 00:00:00', 3, 1),
(79, 1, 1, '2015-10-22 09:25:38', '0000-00-00 00:00:00', 6, 1),
(80, 2, 2, '2015-10-22 09:28:59', '0000-00-00 00:00:00', 18, 1),
(81, 1, 1, '2015-10-22 09:28:56', '0000-00-00 00:00:00', 6, 1),
(82, 1, 1, '2015-10-22 09:54:17', '0000-00-00 00:00:00', NULL, 1),
(83, 1, 1, '2015-10-22 12:25:35', '0000-00-00 00:00:00', 4, 1),
(84, 1, 1, '2015-10-22 13:17:51', '0000-00-00 00:00:00', NULL, 1),
(85, 1, 1, '2015-10-22 15:11:31', '0000-00-00 00:00:00', 2, 0),
(86, 1, 1, '2015-10-22 15:11:50', '0000-00-00 00:00:00', 2, 0),
(87, 1, 1, '2015-10-22 15:12:19', '0000-00-00 00:00:00', 3, 0),
(88, 1, 1, '2015-10-22 15:12:31', '0000-00-00 00:00:00', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE IF NOT EXISTS `tb_role` (
  `id` int(5) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT 'nama role',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `name`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Super Administrator', NULL, NULL),
(2, 'User HSE', NULL, NULL),
(3, 'User Logistik', NULL, NULL),
(4, 'User Kontrak', NULL, NULL),
(5, 'Public User', NULL, NULL),
(6, 'Admin  eAuction', NULL, NULL),
(7, 'Super Admin e-Auction', NULL, NULL),
(8, 'Supervisor VMS', NULL, NULL),
(9, 'User', NULL, NULL),
(10, 'White-End', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sbu`
--

CREATE TABLE IF NOT EXISTS `tb_sbu` (
  `id` int(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'SBU name',
  `index` tinyint(2) DEFAULT NULL COMMENT 'data ording index',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data last update timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sbu`
--

INSERT INTO `tb_sbu` (`id`, `name`, `index`, `entry_stamp`, `edit_stamp`) VALUES
(1, 'Divisi Logistik Kantor Pusat', 1, '2015-11-02 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_bidang`
--

CREATE TABLE IF NOT EXISTS `tb_sub_bidang` (
  `id` int(5) NOT NULL,
  `id_bidang` int(5) DEFAULT NULL COMMENT 'foriegn key from id on tb_bidang',
  `name` varchar(350) DEFAULT NULL COMMENT 'nama sub bidang',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=586 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_bidang`
--

INSERT INTO `tb_sub_bidang` (`id`, `id_bidang`, `name`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 'Konsultan Konstruksi', NULL, '2015-10-08 17:15:52', 0),
(387, 1, 'Alat/peralatan/suku cadang: mekanikal dan elektrikal/listrik', NULL, '2015-10-08 17:16:38', 0),
(388, 29, 'Alat/peralatan/suku cadang: pemboran dan paking', NULL, NULL, 0),
(389, 29, 'Alat/peralatan/suku cadang: instrumen MR/S', NULL, NULL, 0),
(390, 29, 'Alat/peralatan/suku cadang: instrumen Meter Gas', NULL, NULL, 0),
(391, 29, 'Alat/peralatan/suku cadang: instrumen lainnya (selain MR/S dan Meter Gas)', NULL, NULL, 0),
(392, 29, 'Alat/peralatan/suku cadang: mesin-mesin.', NULL, NULL, 0),
(393, 29, 'Alat/peralatan/suku cadang: alat berat', NULL, NULL, 0),
(394, 29, 'Alat/peralatan/suku cadang: ukur, survei, laboratorium dan timbangan khusus', NULL, NULL, 0),
(395, 29, 'Alat/peralatan/suku cadang: komputer, perangkat keras (networking product, perangkat sistem informasi khusus, komunikasi multimedia)', NULL, NULL, 0),
(396, 29, 'Alat/peralatan/suku cadang: navigasi', NULL, NULL, 0),
(397, 29, 'Alat/peralatan/suku cadang: keselamatan kerja dan pemadam kebakaran', NULL, NULL, 0),
(398, 29, 'Alat/peralatan/suku cadang: kendaraan bermotor dan pengujiannya', NULL, NULL, 0),
(399, 29, 'Alat/peralatan/suku cadang: tulis, kantor dan pergudangan, perlengkapan pegawai', NULL, NULL, 0),
(400, 29, 'Radio, telekomunikasi dan elektronika', NULL, NULL, 0),
(401, 29, 'Teknologi informasi (ternasuk perangkat lunak)', NULL, NULL, 0),
(402, 29, 'Katup baja, sambungan baja, dan paking', NULL, NULL, 0),
(403, 29, 'Katup PE, dan sambungan PE', NULL, NULL, 0),
(404, 29, 'Pipa baja', NULL, NULL, 0),
(405, 29, 'Pipa PE', NULL, NULL, 0),
(406, 29, 'Alat-alat kerja', NULL, NULL, 0),
(407, 29, 'Bahan kimia, cat', NULL, NULL, 0),
(408, 29, 'Bahan bakar, pelumas dan minyak', NULL, NULL, 0),
(409, 29, 'Furniture, kerajinan', NULL, NULL, 0),
(410, 29, 'Tekstil dan produk Tekstil', NULL, NULL, 0),
(411, 29, 'Alat teknik pendidikan, olahraga dan kesenian', NULL, NULL, 0),
(412, 29, 'Buku bacaan, buku pelajaran, dan jurnal berkala', NULL, NULL, 0),
(413, 29, 'Subbidang lainnya', NULL, NULL, 0),
(414, 30, 'Perumahan tunggal dan koppel, termasuk perawatannya', NULL, NULL, 0),
(415, 30, 'Perumahan multi hunian, termasuk perawatannya', NULL, NULL, 0),
(416, 30, 'Bangunan pergudangan dan industri, termasuk perawatannya', NULL, NULL, 0),
(417, 30, 'Bangunan komersial, termasuk perawatannya', NULL, NULL, 0),
(418, 30, 'Bangunan-bangunan non perumahan lainnya, termasuk perawatannya', NULL, NULL, 0),
(419, 30, 'Fasilitas pelatihan sport diluar gedung, fasilitas rekreasi, termasuk perawatannya', NULL, NULL, 0),
(420, 30, 'Pertamanan, termasuk perawatannya', NULL, NULL, 0),
(421, 30, 'Pekerjaan pemasangan instalasi asesori bangunan, termasuk perawatannya', NULL, NULL, 0),
(422, 30, 'Pekerjaan dinding dan jendela kaca, termasuk perawatannya', NULL, NULL, 0),
(423, 30, 'Pekerjaan interior, termasuk perawatannya', NULL, NULL, 0),
(424, 30, 'Perawatan Gedung / Bangunan', NULL, NULL, 0),
(425, 31, 'Jalan raya, jalan lingkungan, termasuk perawatannya', NULL, NULL, 0),
(426, 31, 'Jembatan, termasuk perawatannya', NULL, NULL, 0),
(427, 31, 'Pelabuhan atau dermaga, termasuk perawatannya', NULL, NULL, 0),
(428, 31, 'Irigasi dan Drainase, termasuk perawatannya', NULL, NULL, 0),
(429, 31, 'Pengerukan dan Pengurugan, termasuk perawatannya', NULL, NULL, 0),
(430, 31, 'Pekerjaan penghancuran', NULL, NULL, 0),
(431, 31, 'Pekerjaan penyiapan dan pengupasan lahan', NULL, NULL, 0),
(432, 31, 'Pekerjaan penggalian dan pemindahan tanah', NULL, NULL, 0),
(433, 31, 'Pekerjaan pemancangan', NULL, NULL, 0),
(434, 31, 'Pekerjaan pelaksanaan pondasi, termasuk untuk perbaikannya', NULL, NULL, 0),
(435, 31, 'Pekerjaan kerangka konstruksi atap, termasuk perawatannya', NULL, NULL, 0),
(436, 31, 'Pekerjaan atap dan kedap air, termasuk perawatannya', NULL, NULL, 0),
(437, 31, 'Pekerjaan pembetonan', NULL, NULL, 0),
(438, 31, 'Pekerjaan konstruksi baja, termasuk perawatannya', NULL, NULL, 0),
(439, 31, 'Pekerjaan pemasangan perancah pembetonan', NULL, NULL, 0),
(440, 31, 'Pekerjaan pelaksana khusus lainnya', NULL, NULL, 0),
(441, 31, 'Pekerjaan pengaspalan, termasuk perawatannya', NULL, NULL, 0),
(442, 32, 'Instalasi pemanasan, ventilasi udara dan AC dalam bangunan, termasuk perawatannya', NULL, NULL, 0),
(443, 32, 'Perpipaan air dalam bangunan, termasuk perawatannya', NULL, NULL, 0),
(444, 32, 'Instalasi pipa gas dalam bangunan, termasuk perawatannya', NULL, NULL, 0),
(445, 32, 'Insulasi dalam bangunan, termasuk perawatannya', NULL, NULL, 0),
(446, 32, 'Instalasi lift dan escalator, termasuk perawatannya', NULL, NULL, 0),
(447, 32, 'Pertambangan dan manufaktur, termasuk perawatannya', NULL, NULL, 0),
(448, 32, 'Instalasi thermal, bertekanan, minyak, gas, geothermal (Pekerjaan Rekayasa), termasuk perawatannya', NULL, NULL, 0),
(449, 32, 'Konstruksi alat angkut dan alat angkat (Pekerjaan Rekayasa), termasuk perawatannya', NULL, NULL, 0),
(450, 32, 'Konstruksi perpipaan minyak, gas dan energi (Pekerjaan Rekayasa), termasuk perawatannya', NULL, NULL, 0),
(451, 32, 'Fasilitas produksi, penyimpanan minyak dan gas (Pekerjaan Rekayasa), termasuk perawatannya', NULL, NULL, 0),
(452, 32, 'Jasa penyedia peralatan kerja konstruksi', NULL, NULL, 0),
(453, 33, 'Jaringan transmisi telekomunikasi dan atau telepon, termasuk perawatannya', NULL, NULL, 0),
(454, 33, 'Jaringan distribusi telekomunikasi dan atau telepon, termasuk perawatannya', NULL, NULL, 0),
(455, 33, 'Instalasi kontrol dan instrumentasi, termasuk perawatannya', NULL, NULL, 0),
(456, 33, 'Instalasi listrik gedung dan pabrik, termasuk perawatannya', NULL, NULL, 0),
(457, 33, 'Instalasi listrik lainnya, termasuk perawatannya', NULL, NULL, 0),
(458, 34, 'Perpipaan gas, termasuk perawatannya', NULL, NULL, 0),
(459, 34, 'Instalasi pengolahan limbah, termasuk perawatannya', NULL, NULL, 0),
(460, 34, 'Pekerjaan pengeboran air tanah, termasuk perawatannya', NULL, NULL, 0),
(461, 35, 'Jasa Nasihat/Pra-Disain, Disain dan Administrasi Kontrak Arsitektural', NULL, NULL, 0),
(462, 35, 'Jasa Arsitektural Lansekap', NULL, NULL, 0),
(463, 35, 'Jasa Desain Interior', NULL, NULL, 0),
(464, 35, 'Jasa Penilai Perawatan Bangunan Gedung', NULL, NULL, 0),
(465, 35, 'Jasa Arsitektur Lainnya', NULL, NULL, 0),
(466, 36, 'Jasa Enjiniring Fase Konstruksi dan Instalasi Bangunan', NULL, NULL, 0),
(467, 36, 'Jasa Enjiniring Fase Konstruksi dan Instalasi Pekerjaan Teknik Sipil Keairan', NULL, NULL, 0),
(468, 36, 'Jasa Enjiniring Fase Konstruksi dan Instalasi Pekerjaan Teknik Sipil Lainnya', NULL, NULL, 0),
(469, 36, 'Jasa Enjiniring Fase Konstruksi dan Instalasi Industrial Plant dan Proses', NULL, NULL, 0),
(470, 37, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Bangunan', NULL, NULL, 0),
(471, 37, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Pekerjaan Teknik Sipil Keairan', NULL, NULL, 0),
(472, 37, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Pekerjaan Teknik Sipil Lainnya', NULL, NULL, 0),
(473, 38, 'Jasa Manajemen Proyek Terkait Konstruksi Bangunan', NULL, NULL, 0),
(474, 38, 'Jasa Manajemen Proyek Terkait Konstruksi Pekerjaan Teknik Keairan', NULL, NULL, 0),
(475, 38, 'Jasa Manajemen Proyek Terkait Konstruksi Pekerjaan Teknik Sipil Lainnya', NULL, NULL, 0),
(476, 38, 'Jasa Manajemen Proyek Terkait Konstruksi Industrial Plant dan Proses', NULL, NULL, 0),
(477, 39, 'Jasa Disain Enjiniring Mekanikal', NULL, NULL, 0),
(478, 39, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Industrial Plant dan Proses', NULL, NULL, 0),
(479, 39, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Pekerjaan Mekanikal Lainnya', NULL, NULL, 0),
(480, 39, 'Jasa Enjiniring Terpadu', NULL, NULL, 0),
(481, 40, 'Jasa Disain Enjiniring Elektrikal', NULL, NULL, 0),
(482, 40, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Pekerjaan Elektrikal Lainnya', NULL, NULL, 0),
(483, 41, 'Jasa Konsultansi Lingkungan', NULL, NULL, 0),
(484, 41, 'Jasa Perencanaan Urban', NULL, NULL, 0),
(485, 41, 'Jasa Nasehat/Pra-Disain dan Disain Enjiniring Pekerjaan Tata Lingkungan Lainnya', NULL, NULL, 0),
(486, 42, 'Jasa Survey Permukaan', NULL, NULL, 0),
(487, 42, 'Jasa Pembuatan Peta', NULL, NULL, 0),
(488, 42, 'Jasa Survey Bawah Tanah', NULL, NULL, 0),
(489, 42, 'Jasa Geologi, Geofisik dan Prospek Lainnya', NULL, NULL, 0),
(490, 43, 'Jasa Komposisi, Kemurnian dan Analisis', NULL, NULL, 0),
(491, 43, 'Jasa Enjiniring Lainnya', NULL, NULL, 0),
(492, 44, 'Jasa konsultan konservasi dan penghijauan', NULL, NULL, 0),
(493, 45, 'Jasa konsultan telekomunikasi darat', NULL, NULL, 0),
(494, 45, 'Jasa konsultan telekomunikasi satelit', NULL, NULL, 0),
(495, 46, 'Jasa konsultan perangkat keras (networking product, perangkat sistem informasi khusus, dll)', NULL, NULL, 0),
(496, 47, 'Jasa konsultan konten (program portal, multimedia, dll)', NULL, NULL, 0),
(497, 47, 'Jasa konsultan aplikasi komputer', NULL, NULL, 0),
(498, 47, 'Jasa konsultan aplikasi komunikasi', NULL, NULL, 0),
(499, 47, 'Jasa konsultan aplikasi telemetrik', NULL, NULL, 0),
(500, 47, 'Jasa konsultan aplikasi GIS', NULL, NULL, 0),
(501, 47, 'Jasa konsultan aplikasi GPS', NULL, NULL, 0),
(502, 48, 'Jasa konsultan bidang ekonomi pemasaran dan eksplorasi mineral', NULL, NULL, 0),
(503, 48, 'Jasa konsultan bidang perindustrian', NULL, NULL, 0),
(504, 48, 'Jasa konsultan hasil-hasil industri, pola perdagangan dan pemasaran', NULL, NULL, 0),
(505, 48, 'Jasa konsultan mesin dan perlengkapannya', NULL, NULL, 0),
(506, 48, 'Jasa konsultan mesin listrik, peralatan listrik dan elektronik, dan perlengkapannya', NULL, NULL, 0),
(507, 49, 'Jasa konsultan bidang ekonomi dan konservasi energi', NULL, NULL, 0),
(508, 49, 'Jasa konsultan minyak dan gas', NULL, NULL, 0),
(509, 49, 'Jasa konsultan batubara, lignite dan anthracite', NULL, NULL, 0),
(510, 50, 'Jasa konsultan pasar uang', NULL, NULL, 0),
(511, 50, 'Jasa konsultan manajemen pasar modal dan bursa efek', NULL, NULL, 0),
(512, 50, 'Jasa konsultan manajemen lembaga keuangan non-bank', NULL, NULL, 0),
(513, 50, 'Jasa konsultan manajemen keuangan perusahaan', NULL, NULL, 0),
(514, 50, 'Jasa konsultan manajemen investasi dan portofolio', NULL, NULL, 0),
(515, 50, 'Jasa konsultan pengawasan dan regulasi sektor keuangan', NULL, NULL, 0),
(516, 51, 'Jasa konsultan bidang pendidikan dan pelatihan', NULL, NULL, 0),
(517, 52, 'Jasa konsultan rekayasa industri telekomunikasi', NULL, NULL, 0),
(518, 52, 'Jasa konsultan rekayasa industri teknologi informasi', NULL, NULL, 0),
(519, 52, 'Jasa konsultan rekayasa lainnya', NULL, NULL, 0),
(520, 53, 'Jasa konsultan bidang survey teristis', NULL, NULL, 0),
(521, 53, 'Jasa konsultan bidang survey penginderaan jauh, fotogrametri', NULL, NULL, 0),
(522, 53, 'Jasa konsultan bidang survey hidrografi, batimetri', NULL, NULL, 0),
(523, 53, 'Jasa konsultan bidang survey Sistem Informasi Geografi', NULL, NULL, 0),
(524, 53, 'Jasa konsultan bidang survey registrasi kepemilikan tanah/kadastral', NULL, NULL, 0),
(525, 53, 'Jasa konsultan bidang survey geologi', NULL, NULL, 0),
(526, 54, 'Jasa konsultan studi makro', NULL, NULL, 0),
(527, 54, 'Jasa konsultan studi kelayakan & studi mikro lainnya', NULL, NULL, 0),
(528, 54, 'Jasa konsultan studi perencanaan Umum', NULL, NULL, 0),
(529, 54, 'Jasa konsultan penelitian', NULL, NULL, 0),
(530, 54, 'Jasa konsultan bantuan teknik', NULL, NULL, 0),
(531, 55, 'Jasa konsultan perencanaan sistem akuntansi', NULL, NULL, 0),
(532, 55, 'Jasa konsultan manajemen pengembangan SDM', NULL, NULL, 0),
(533, 55, 'Jasa konsultan manajemen fungsional', NULL, NULL, 0),
(534, 55, 'Jasa konsultan hukum', NULL, NULL, 0),
(535, 56, 'Jasa konsultan teknologi dan Sistem informasi', NULL, NULL, 0),
(536, 56, 'Jasa konsultan penilai /appraisal/valuer', NULL, NULL, 0),
(537, 56, 'Jasa konsultan khusus surveyor independen', NULL, NULL, 0),
(538, 56, 'Jasa konsultan sertifikasi', NULL, NULL, 0),
(539, 56, 'Jasa konsultan inspeksi teknik', NULL, NULL, 0),
(540, 57, 'Jasa penyewaan peralatan kerja dan peralatan produksi', NULL, NULL, 0),
(541, 57, 'Jasa penyewaan alat berat', NULL, NULL, 0),
(542, 57, 'Jasa pemeliharaan alat berat', NULL, NULL, 0),
(543, 57, 'Jasa pembuatan mesin dan peralatan industri, mekanikal dan elektrikal', NULL, NULL, 0),
(544, 57, 'Jasa pemeliharaan dan reparasi mesin dan peralatan industri, mekanikal dan elektrikal', NULL, NULL, 0),
(545, 57, 'Jasa penyelaman / pekerjaan bawah air', NULL, NULL, 0),
(546, 57, 'Jasa perawatan pekerjaan minyak dan gas bawah air', NULL, NULL, 0),
(547, 57, 'Jasa penginderaan jauh (remote sensing)', NULL, NULL, 0),
(548, 57, 'Jasa pengujian dan kalibrasi', NULL, NULL, 0),
(549, 57, 'Jasa inspeksi teknik', NULL, NULL, 0),
(550, 57, 'Jasa penyewaan komputer, perangkat keras (networking product, perangkat sistem informasi khusus, komunikasi multimedia)', NULL, NULL, 0),
(551, 57, 'Jasa pemeliharaan: komputer, perangkat keras (networking product, perangkat sistem informasi khusus, komunikasi multimedia)', NULL, NULL, 0),
(552, 57, 'Jasa penyewaan radio, telekomunikasi, elektronika', NULL, NULL, 0),
(553, 57, 'Jasa pemeliharaan: radio, telekomunikasi dan elektronika', NULL, NULL, 0),
(554, 57, 'Jasa teknologi informasi (termasuk lisensi)', NULL, NULL, 0),
(555, 57, 'Jasa penyedia internet dan jasa jaringan', NULL, NULL, 0),
(556, 57, 'Jasa penyewaan alat angkutan darat (rental/sewa mobil)', NULL, NULL, 0),
(557, 57, 'Jasa penyewaan alat angkutan lainnya (darat/laut/udara)', NULL, NULL, 0),
(558, 57, 'Jasa angkutan (barang (darat/laut/udara/multi moda), bahan bakar (BBM/BBG), dll)', NULL, NULL, 0),
(559, 57, 'Jasa pemeliharaan alat angkutan (darat/laut/udara)', NULL, NULL, 0),
(560, 57, 'Jasa pengepakan, ekspedisi dan pengurusan kepabeanan', NULL, NULL, 0),
(561, 57, 'Jasa bongkar muat barang', NULL, NULL, 0),
(562, 57, 'Jasa pengiriman ekspres', NULL, NULL, 0),
(563, 57, 'Jasa distribusi dan pemasaran bahan bakar (BBM/BBG)', NULL, NULL, 0),
(564, 57, 'Jasa exportir dan importir', NULL, NULL, 0),
(565, 57, 'Jasa pembersih, pest control, termite control, fumigasi', NULL, NULL, 0),
(566, 57, 'Jasa penyewaan peralatan kantor', NULL, NULL, 0),
(567, 57, 'Jasa pemeliharaan sarana dan peralatan kantor', '2013-12-19 04:02:13', NULL, 0),
(568, 57, 'Jasa penulisan dan penerjemahan', NULL, NULL, 0),
(569, 57, 'Jasa percetakan', NULL, NULL, 0),
(570, 57, 'Jasa asuransi dan usaha penunjang', NULL, NULL, 0),
(571, 57, 'Jasa iklan, film dan pemotretan', NULL, NULL, 0),
(572, 57, 'Jasa penyelenggaraan promosi MICE (Meeting, Incentive, Convention and Exhibition)', NULL, NULL, 0),
(573, 57, 'Jasa penyewaan akomodasi, perhotelan, ruang MICE', NULL, NULL, 0),
(574, 57, 'Jasa pengurusan perijinan', NULL, NULL, 0),
(575, 57, 'Jasa penjahit dan konveksi', NULL, NULL, 0),
(576, 57, 'Jasa penyediaan tenaga kerja bidang pengamanan/keamanan', NULL, NULL, 0),
(577, 57, 'Jasa penyediaan tenaga kerja bidang kebersihan (cleaning service)', NULL, NULL, 0),
(578, 57, 'Jasa penyediaan tenaga kerja lainnya', NULL, NULL, 0),
(579, 57, 'Jasa boga/catering', NULL, NULL, 0),
(580, 57, 'Subbidang lainnya', NULL, NULL, 0),
(581, 3, 'asd', '2015-10-08 17:22:52', NULL, 0),
(582, 2, 'asd ', '2015-10-08 17:23:06', NULL, 0),
(583, 4, 'as d', '2015-10-08 17:24:49', NULL, 0),
(584, 1, '00hapushapus', '2015-10-22 13:29:33', '2015-10-22 13:29:47', 1),
(585, 1, 'Coba duluuu', '2015-10-23 04:27:31', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_quest_k3`
--

CREATE TABLE IF NOT EXISTS `tb_sub_quest_k3` (
  `id` int(5) NOT NULL,
  `id_header` int(5) DEFAULT NULL,
  `question` varchar(150) DEFAULT NULL,
  `id_order` int(5) DEFAULT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_quest_k3`
--

INSERT INTO `tb_sub_quest_k3` (`id`, `id_header`, `question`, `id_order`, `entry_stamp`, `edit_stamp`, `del`) VALUES
(1, 1, 'Komitmen K3 melalui kepemimpinan', 1, '2015-10-21 11:13:45', '2015-10-21 11:13:48', 0),
(2, 2, 'Kebijakan dan Dokumen K3', 1, '2015-10-16 09:07:51', '0000-00-00 00:00:00', 0),
(3, 2, 'Tersedianya Pernyataan Kebijakan bagi Karyawan', 2, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(4, 3, 'Organisasi – Komitmen dan Komunikasi', 1, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(5, 3, 'Kemampuan dan Pelatihan Manager/Pengawas/Petugas Senior Lapangan/Penasihat K3', 2, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(6, 3, 'Kemampuan dan Pelatihan K3 Umum', 3, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(7, 3, 'Kemampuan dan Pelatihan K3 Umum (sambungan)', 3, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(8, 3, 'Pelatihan Khusus', 4, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(9, 3, 'Karyawan yang mempunyai Kemampuan K3 – Pelatihan Tambahan', 5, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(10, 3, 'Penilaian mengenai kesesuai subkontraktor / Perusahaan Lain', 6, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(11, 3, 'Standar', 7, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(12, 4, 'Penanganan Bahaya dan Pengaruh', 1, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(13, 4, 'Paparan terhadap Pekerja', 2, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(14, 4, 'Penanganan Bahaya yang Potensial', 3, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(15, 4, 'Personal Protective Equipment', 4, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(16, 4, 'Penanganan Limbah (Waste Management)', 5, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(17, 4, 'Kesehatan Industri (Industrial Hygiene)', 6, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(18, 4, 'Obat-obatan dan Minuman Keras', 7, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(19, 5, 'Buku Panduan K3 dan Operasi', 1, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(20, 5, 'Pengawasan dan Perawatan Peralatan', 2, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(21, 5, 'Penanganan dan Perawatan Keselamatan Transportasi', 3, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(22, 6, 'Manajemen K3 dan Pemantauan Kinerja dalam Aktivitas Kerja', 1, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(23, 6, 'Program Keselamatan', 2, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(24, 6, 'Insiden/Kejadian berbahaya, Tuntutan Perbaikan dan Pemberitahuan Larangan yang bersifat Hukum', 3, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(25, 6, 'Catatan Kenierja K3', 4, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(26, 6, 'Investigasi dan Pelaporan Insiden', 5, '2015-10-14 17:25:52', '0000-00-00 00:00:00', 0),
(27, 1, ' sadasd asd', NULL, '2015-10-16 08:47:29', '0000-00-00 00:00:00', 1),
(28, 1, ' sadasd asd', NULL, '2015-10-16 08:47:36', '0000-00-00 00:00:00', 1),
(29, 1, 'dddasd', NULL, '2015-10-16 08:47:33', '0000-00-00 00:00:00', 1),
(30, 1, 'asdsad', NULL, '2015-10-16 08:47:40', '0000-00-00 00:00:00', 1),
(31, 1, 'asdsadsa', NULL, '2015-10-16 08:47:25', '0000-00-00 00:00:00', 1),
(32, 1, 'asd asd asdasd', NULL, '2015-10-22 06:43:59', '0000-00-00 00:00:00', 1),
(33, 1, '<div style="text-align: justify;"><b><u><strike>asdsadasd sad asd asd asd&nbsp;</strike></u></b></div><p></p>', NULL, '2015-10-16 09:33:12', '0000-00-00 00:00:00', 1),
(34, 9, 'test<p></p>', NULL, '2015-10-22 08:35:57', '0000-00-00 00:00:00', 1),
(35, 1, 'Tese<p></p>', NULL, '2015-10-22 06:48:36', '0000-00-00 00:00:00', 1),
(36, 9, 'asdasd<p></p>', NULL, '2015-10-22 08:38:41', '0000-00-00 00:00:00', 1),
(37, 18, 'bhbhbhbhbhbhbhbh<p></p>', NULL, '2015-10-23 07:28:39', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_answer_hse`
--

CREATE TABLE IF NOT EXISTS `tr_answer_hse` (
  `id` int(11) NOT NULL,
  `id_answer` int(11) DEFAULT NULL,
  `id_vendor` bigint(20) DEFAULT NULL,
  `value` text,
  `entry_stamp` datetime NOT NULL,
  `edit_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_answer_hse`
--

INSERT INTO `tr_answer_hse` (`id`, `id_answer`, `id_vendor`, `value`, `entry_stamp`, `edit_time`) VALUES
(229, 1, 6, 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 2, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 3, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 4, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 6, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 7, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 8, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 9, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 10, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 12, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 13, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 14, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 15, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 16, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 17, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 18, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 19, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 20, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 21, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 22, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 23, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 24, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 25, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 26, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 27, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 28, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 29, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 30, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 31, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 33, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 34, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 35, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 36, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 37, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 39, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 40, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 41, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 42, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 56, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 57, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 58, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(270, 59, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 60, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 61, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 62, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(274, 63, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 64, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 65, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 66, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 67, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 69, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 70, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 71, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 72, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 73, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 74, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 75, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 76, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 77, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 78, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 79, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 80, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 81, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 83, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 98, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 84, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 86, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 87, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, 89, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 90, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 91, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 92, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 93, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 94, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, 96, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, 97, 6, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tr_ass_point`
--

CREATE TABLE IF NOT EXISTS `tr_ass_point` (
  `id` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `id_procurement` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_ass_result`
--

CREATE TABLE IF NOT EXISTS `tr_ass_result` (
  `id` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `id_procurement` varchar(45) DEFAULT NULL,
  `id_ass` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_blacklist`
--

CREATE TABLE IF NOT EXISTS `tr_blacklist` (
  `id` int(11) NOT NULL,
  `entry_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_vendor` bigint(20) NOT NULL,
  `start_date` varchar(40) NOT NULL,
  `end_date` varchar(40) NOT NULL,
  `remark` text NOT NULL,
  `blacklist_file` varchar(50) NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_blacklist_remark`
--

CREATE TABLE IF NOT EXISTS `tr_blacklist_remark` (
  `id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_blacklist_remark`
--

INSERT INTO `tr_blacklist_remark` (`id`, `remark`, `type`, `del`) VALUES
(1, 'Sedang berada dalam sengketa/perselisihan dengan Pertamina di Pengadilan / Badan Penyelesaian Sengketa Lain (Arbitrase / Mediasi).', 'Merah', 0),
(2, 'Pengurus/Pemilik Modal/Pemegang Saham ditetapkan sebagai tersangka dalam suatu tindak pidana berkaitan dengan pelaksanaan pekerjaannya di Pertamina.', 'Merah', 0),
(3, 'Terbukti melalui hasil investigasi menyebabkan terjadinya fatality (dirawat > 2x24 jam) / kebakaran yang berakibat kerugian > US$ 1 juta / pencemaran lingkungan melebihi 15Bbl atau kerugian lain > US$ 1 juta saat pelaksanaan pekerjaan (baik yang berada dalam tanggung jawabnya langsung maupun yang di subcontract-kan). ', 'Hitam', 0),
(4, 'Bedasarkan keputusan Komite Sanksi, secara nyata melakukan kolusi, korupsi, suap dan gratifikasi dalam bentuk dan cara apapun kepada pekerja / pejabat / keluarga / yang terkait dengan pekerjaan di Pertamina.', 'Hitam', 0),
(5, 'Berdasarkan keputusan Komite Sanksi, secara nyata melakukan persengkokolan dengan penyedia barang/jasa lain untuk mengatur harga penawaran di luar prosedur pelaksanaan pengadaan barang/jasa sehingga mengurangi/menghambat/memperkecil dan/atau meniadakan persaingan yang sehat dan/atau merugikan pihak lain.', 'Hitam', 0),
(6, 'Mempekerjakan pekerja Pertamina, kecuali terdapat pengaturan lain sesuai ketentuan yang berlaku di Pertamina.', 'Hitam', 0),
(7, 'Mengalihkan pekerjaan utama kepada pihak lain.', 'Hitam', 0),
(8, 'Membuat dan/atau menyampaikan dokumen dan/atau keterangan lain yang tidak benar untuk memenuhi persyaratan pengadaan barang/jasa yang ditentukan dalam dokumen pengadaan dan/atau memalsukan / mengubah dokumen dan/atau memanipulasi data.', 'Hitam', 0),
(9, 'Pengurus/Pemilik Modal yang telah diputus bersalah melakukan tindak pidana yang telah memiliki kekuatan hukum yang tetap/inkracht yang berkaitan dengan Penyedia Barang/Jasa dan/atau berkaitan dengan pelaksanaan pekerjaan yang merugikan Pertamina.', 'Hitam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_dpt`
--

CREATE TABLE IF NOT EXISTS `tr_dpt` (
  `id` bigint(20) NOT NULL,
  `id_vendor` bigint(20) DEFAULT NULL COMMENT 'FK for id in ms_vendor',
  `id_dpt_type` int(5) DEFAULT NULL COMMENT 'FK for id in tb_dpt_type',
  `start_date` date DEFAULT NULL COMMENT 'tanggal pengangkatan DPT',
  `end_date` date DEFAULT NULL COMMENT 'tanggal berhenti DPT',
  `status` tinyint(1) DEFAULT '0' COMMENT '0 - ready to authenticate by supervisor\n1 - authenticated, active DPT\n2 - inactive DPT',
  `entry_stamp` timestamp NULL DEFAULT NULL COMMENT 'data entry timestamp',
  `edit_stamp` timestamp NULL DEFAULT NULL COMMENT 'data edit timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_email_blast`
--

CREATE TABLE IF NOT EXISTS `tr_email_blast` (
  `id` bigint(20) NOT NULL,
  `id_doc` bigint(20) DEFAULT NULL,
  `doc_type` varchar(30) DEFAULT NULL,
  `distance` int(5) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` longtext,
  `no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_email_blast`
--

INSERT INTO `tr_email_blast` (`id`, `id_doc`, `doc_type`, `distance`, `date`, `message`, `no`) VALUES
(1, 1, 'ms_situ', 30, '2010-10-23', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(2, 1, 'ms_situ', 7, '2010-11-15', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(3, 1, 'ms_situ', 6, '2010-11-16', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(4, 1, 'ms_situ', 5, '2010-11-17', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(5, 1, 'ms_situ', 4, '2010-11-18', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(6, 1, 'ms_situ', 3, '2010-11-19', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(7, 1, 'ms_situ', 2, '2010-11-20', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(8, 1, 'ms_situ', 1, '2010-11-21', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(9, 1, 'ms_situ', 0, '2010-11-22', 'Lampiran file Surat Izin Tempat Usaha (SITU) dengan nomor 0052015 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(10, 2, 'ms_situ', 30, '2018-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(11, 2, 'ms_situ', 7, '2018-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(12, 2, 'ms_situ', 6, '2018-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(13, 2, 'ms_situ', 5, '2018-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(14, 2, 'ms_situ', 4, '2018-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(15, 2, 'ms_situ', 3, '2018-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(16, 2, 'ms_situ', 2, '2018-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(17, 2, 'ms_situ', 1, '2018-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(18, 2, 'ms_situ', 0, '2018-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(19, 3, 'ms_situ', 30, '2016-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(20, 3, 'ms_situ', 7, '2016-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(21, 3, 'ms_situ', 6, '2016-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(22, 3, 'ms_situ', 5, '2016-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(23, 3, 'ms_situ', 4, '2016-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(24, 3, 'ms_situ', 3, '2016-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(25, 3, 'ms_situ', 2, '2016-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(26, 3, 'ms_situ', 1, '2016-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(27, 3, 'ms_situ', 0, '2016-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(28, 4, 'ms_situ', 30, '2016-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(29, 4, 'ms_situ', 7, '2016-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(30, 4, 'ms_situ', 6, '2016-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(31, 4, 'ms_situ', 5, '2016-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(32, 4, 'ms_situ', 4, '2016-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(33, 4, 'ms_situ', 3, '2016-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(34, 4, 'ms_situ', 2, '2016-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(35, 4, 'ms_situ', 1, '2016-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(36, 4, 'ms_situ', 0, '2016-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(37, 5, 'ms_situ', 30, '2018-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(38, 5, 'ms_situ', 7, '2018-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(39, 5, 'ms_situ', 6, '2018-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(40, 5, 'ms_situ', 5, '2018-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(41, 5, 'ms_situ', 4, '2018-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(42, 5, 'ms_situ', 3, '2018-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(43, 5, 'ms_situ', 2, '2018-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(44, 5, 'ms_situ', 1, '2018-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(45, 5, 'ms_situ', 0, '2018-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(46, 2, 'ms_tdp', 30, '2015-09-28', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(47, 2, 'ms_tdp', 7, '2015-10-21', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(48, 2, 'ms_tdp', 6, '2015-10-22', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(49, 2, 'ms_tdp', 5, '2015-10-23', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(50, 2, 'ms_tdp', 4, '2015-10-24', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(51, 2, 'ms_tdp', 3, '2015-10-25', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(52, 2, 'ms_tdp', 2, '2015-10-26', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(53, 2, 'ms_tdp', 1, '2015-10-27', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(54, 2, 'ms_tdp', 0, '2015-10-28', 'Lampiran file Tanda Daftar Perusahaan dengan nomor 44 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(55, 6, 'ms_situ', 30, '2016-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(56, 6, 'ms_situ', 7, '2016-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(57, 6, 'ms_situ', 6, '2016-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(58, 6, 'ms_situ', 5, '2016-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(59, 6, 'ms_situ', 4, '2016-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(60, 6, 'ms_situ', 3, '2016-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(61, 6, 'ms_situ', 2, '2016-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(62, 6, 'ms_situ', 1, '2016-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(63, 6, 'ms_situ', 0, '2016-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 22 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(64, 7, 'ms_situ', 30, '2018-09-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(65, 7, 'ms_situ', 7, '2018-10-16', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(66, 7, 'ms_situ', 6, '2018-10-17', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(67, 7, 'ms_situ', 5, '2018-10-18', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(68, 7, 'ms_situ', 4, '2018-10-19', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(69, 7, 'ms_situ', 3, '2018-10-20', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(70, 7, 'ms_situ', 2, '2018-10-21', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(71, 7, 'ms_situ', 1, '2018-10-22', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(72, 7, 'ms_situ', 0, '2018-10-23', 'Lampiran file Surat Keterangan Domisili Perusahaan (SKDP) dengan nomor 123 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(73, 1, 'ms_ijin_usaha', 30, '2015-09-23', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(74, 1, 'ms_ijin_usaha', 7, '2015-10-16', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(75, 1, 'ms_ijin_usaha', 6, '2015-10-17', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(76, 1, 'ms_ijin_usaha', 5, '2015-10-18', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(77, 1, 'ms_ijin_usaha', 4, '2015-10-19', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(78, 1, 'ms_ijin_usaha', 3, '2015-10-20', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(79, 1, 'ms_ijin_usaha', 2, '2015-10-21', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(80, 1, 'ms_ijin_usaha', 1, '2015-10-22', 'Lampiran file Izin Usaha dengan nomor 123 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(81, 1, 'ms_ijin_usaha', 0, '2015-10-23', 'Lampiran file Izin Usaha dengan nomor 123 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(82, 1, 'ms_csms', 30, '2015-09-23', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(83, 1, 'ms_csms', 7, '2015-10-16', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(84, 1, 'ms_csms', 6, '2015-10-17', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(85, 1, 'ms_csms', 5, '2015-10-18', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(86, 1, 'ms_csms', 4, '2015-10-19', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(87, 1, 'ms_csms', 3, '2015-10-20', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(88, 1, 'ms_csms', 2, '2015-10-21', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(89, 1, 'ms_csms', 1, '2015-10-22', 'Lampiran file Lampiran CSMS dengan nomor  menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(90, 1, 'ms_csms', 0, '2015-10-23', 'Lampiran file Lampiran CSMS dengan nomor  sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(91, 1, 'ms_pengurus', 30, '2016-09-23', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(92, 1, 'ms_pengurus', 7, '2016-10-16', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(93, 1, 'ms_pengurus', 6, '2016-10-17', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(94, 1, 'ms_pengurus', 5, '2016-10-18', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(95, 1, 'ms_pengurus', 4, '2016-10-19', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(96, 1, 'ms_pengurus', 3, '2016-10-20', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(97, 1, 'ms_pengurus', 2, '2016-10-21', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(98, 1, 'ms_pengurus', 1, '2016-10-22', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(99, 1, 'ms_pengurus', 0, '2016-10-23', 'Lampiran file Pengurus Perusahaan dengan nomor 2222 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(100, 1, 'ms_agen', 30, '2015-06-23', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(101, 1, 'ms_agen', 7, '2015-07-16', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(102, 1, 'ms_agen', 6, '2015-07-17', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(103, 1, 'ms_agen', 5, '2015-07-18', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(104, 1, 'ms_agen', 4, '2015-07-19', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(105, 1, 'ms_agen', 3, '2015-07-20', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(106, 1, 'ms_agen', 2, '2015-07-21', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(107, 1, 'ms_agen', 1, '2015-07-22', 'Lampiran file Akta Agen dengan nomor 0 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(108, 1, 'ms_agen', 0, '2015-07-23', 'Lampiran file Akta Agen dengan nomor 0 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(109, 2, 'ms_ijin_usaha', 30, '2018-09-23', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(110, 2, 'ms_ijin_usaha', 7, '2018-10-16', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(111, 2, 'ms_ijin_usaha', 6, '2018-10-17', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(112, 2, 'ms_ijin_usaha', 5, '2018-10-18', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(113, 2, 'ms_ijin_usaha', 4, '2018-10-19', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(114, 2, 'ms_ijin_usaha', 3, '2018-10-20', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(115, 2, 'ms_ijin_usaha', 2, '2018-10-21', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(116, 2, 'ms_ijin_usaha', 1, '2018-10-22', 'Lampiran file Izin Usaha dengan nomor 78888 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(117, 2, 'ms_ijin_usaha', 0, '2018-10-23', 'Lampiran file Izin Usaha dengan nomor 78888 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(118, 3, 'ms_ijin_usaha', 30, '2016-09-23', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(119, 3, 'ms_ijin_usaha', 7, '2016-10-16', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(120, 3, 'ms_ijin_usaha', 6, '2016-10-17', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(121, 3, 'ms_ijin_usaha', 5, '2016-10-18', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(122, 3, 'ms_ijin_usaha', 4, '2016-10-19', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(123, 3, 'ms_ijin_usaha', 3, '2016-10-20', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(124, 3, 'ms_ijin_usaha', 2, '2016-10-21', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(125, 3, 'ms_ijin_usaha', 1, '2016-10-22', 'Lampiran file Izin Usaha dengan nomor 7 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(126, 3, 'ms_ijin_usaha', 0, '2016-10-23', 'Lampiran file Izin Usaha dengan nomor 7 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(127, 4, 'ms_ijin_usaha', 30, '2015-09-24', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 30 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(128, 4, 'ms_ijin_usaha', 7, '2015-10-17', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 7 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(129, 4, 'ms_ijin_usaha', 6, '2015-10-18', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 6 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(130, 4, 'ms_ijin_usaha', 5, '2015-10-19', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 5 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(131, 4, 'ms_ijin_usaha', 4, '2015-10-20', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 4 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(132, 4, 'ms_ijin_usaha', 3, '2015-10-21', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 3 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(133, 4, 'ms_ijin_usaha', 2, '2015-10-22', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 2 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(134, 4, 'ms_ijin_usaha', 1, '2015-10-23', 'Lampiran file Izin Usaha dengan nomor 1998827 menyisakan 1 hari sebelum masa berlakunya habis.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL),
(135, 4, 'ms_ijin_usaha', 0, '2015-10-24', 'Lampiran file Izin Usaha dengan nomor 1998827 sudah habis masa berlakunya.\\n Harap diperbaharui untuk segera kami proses menjadi syarat vendor.\\nTerimakasih.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_evaluasi_poin`
--

CREATE TABLE IF NOT EXISTS `tr_evaluasi_poin` (
  `id` bigint(20) NOT NULL,
  `id_evaluasi` bigint(20) DEFAULT NULL,
  `id_vendor` int(11) NOT NULL,
  `poin` int(1) DEFAULT NULL,
  `entry_stamp` datetime NOT NULL,
  `edit_stamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_evaluasi_poin`
--

INSERT INTO `tr_evaluasi_poin` (`id`, `id_evaluasi`, `id_vendor`, `poin`, `entry_stamp`, `edit_stamp`) VALUES
(53, 1, 6, 4, '2015-10-23 14:45:41', '0000-00-00 00:00:00'),
(54, 2, 6, 4, '2015-10-23 14:45:41', '0000-00-00 00:00:00'),
(55, 9, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(56, 10, 6, 4, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(57, 11, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(58, 12, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(59, 13, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(60, 14, 6, 4, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(61, 15, 6, 4, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(62, 3, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(63, 4, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(64, 5, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(65, 6, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(66, 7, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(67, 8, 6, 4, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(68, 16, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(69, 17, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(70, 18, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(71, 19, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(72, 20, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(73, 21, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(74, 22, 6, 12, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(75, 23, 6, 8, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(76, 24, 6, 7, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(77, 25, 6, 7, '2015-10-23 14:45:42', '0000-00-00 00:00:00'),
(78, 26, 6, 5, '2015-10-23 14:45:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tr_material_price`
--

CREATE TABLE IF NOT EXISTS `tr_material_price` (
  `id` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `id_procurement` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `price` bigint(15) DEFAULT NULL,
  `entry_stamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_material_price`
--

INSERT INTO `tr_material_price` (`id`, `id_material`, `id_procurement`, `id_vendor`, `price`, `entry_stamp`) VALUES
(1, 9, 17, 7, 61, '0000-00-00 00:00:00'),
(2, 10, 17, 7, 61, '0000-00-00 00:00:00'),
(3, 11, 17, 7, 61, '0000-00-00 00:00:00'),
(4, 12, 17, 7, 61, '0000-00-00 00:00:00'),
(5, 15, 19, 7, 204, '2015-10-25 14:18:50'),
(6, 16, 19, 7, 204, '2015-10-25 14:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `tr_note`
--

CREATE TABLE IF NOT EXISTS `tr_note` (
  `id` bigint(20) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `value` text,
  `entry_stamp` datetime DEFAULT NULL,
  `edit_stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_progress_kontrak`
--

CREATE TABLE IF NOT EXISTS `tr_progress_kontrak` (
  `id` int(11) NOT NULL,
  `id_contract` int(11) DEFAULT NULL,
  `step_name` varchar(100) DEFAULT NULL,
  `supposed` int(5) DEFAULT NULL,
  `realization` int(5) DEFAULT NULL,
  `entry_stamp` timestamp NULL DEFAULT NULL,
  `edit_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_progress_pengadaan`
--

CREATE TABLE IF NOT EXISTS `tr_progress_pengadaan` (
  `id` int(15) NOT NULL,
  `id_proc` int(11) DEFAULT NULL,
  `id_progress` int(11) DEFAULT NULL,
  `value` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_progress_pengadaan`
--

INSERT INTO `tr_progress_pengadaan` (`id`, `id_proc`, `id_progress`, `value`) VALUES
(1, 53, 1, 1),
(2, 53, 2, 1),
(3, 53, 3, 1),
(4, 53, 4, 1),
(5, 53, 5, 0),
(6, 53, 6, 0),
(7, 53, 7, 0),
(8, 53, 8, 0),
(9, 53, 9, 0),
(10, 53, 10, 0),
(11, 53, 11, 0),
(12, 55, 1, 1),
(13, 55, 2, 1),
(14, 55, 3, 1),
(15, 55, 4, 1),
(16, 55, 5, 1),
(17, 55, 6, 1),
(18, 55, 7, 1),
(19, 55, 8, 1),
(20, 55, 9, 1),
(21, 55, 10, 1),
(22, 55, 11, 1),
(23, 56, 1, 1),
(24, 56, 2, 1),
(25, 56, 3, 1),
(26, 56, 4, 1),
(27, 56, 5, 1),
(28, 56, 6, 1),
(29, 56, 7, 1),
(30, 56, 8, 0),
(31, 56, 9, 0),
(32, 56, 10, 0),
(33, 56, 11, 0),
(34, 1, 1, 1),
(35, 1, 2, 1),
(36, 1, 3, 1),
(37, 1, 4, 1),
(38, 1, 5, 1),
(39, 1, 6, 1),
(40, 1, 7, 1),
(41, 1, 8, 1),
(42, 1, 9, 1),
(43, 1, 10, 1),
(44, 1, 11, 0),
(45, 2, 1, 1),
(46, 2, 2, 1),
(47, 2, 3, 1),
(48, 2, 4, 1),
(49, 2, 5, 1),
(50, 2, 6, 1),
(51, 2, 7, 1),
(52, 2, 8, 1),
(53, 2, 9, 1),
(54, 2, 10, 1),
(55, 2, 11, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_admin`
--
ALTER TABLE `ms_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_agen`
--
ALTER TABLE `ms_agen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_agen_bsb`
--
ALTER TABLE `ms_agen_bsb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_agen_produk`
--
ALTER TABLE `ms_agen_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_akta`
--
ALTER TABLE `ms_akta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_answer_hse`
--
ALTER TABLE `ms_answer_hse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_ass`
--
ALTER TABLE `ms_ass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_ass_group`
--
ALTER TABLE `ms_ass_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_contract`
--
ALTER TABLE `ms_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_csms`
--
ALTER TABLE `ms_csms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_evaluasi_data`
--
ALTER TABLE `ms_evaluasi_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_hse`
--
ALTER TABLE `ms_hse`
  ADD PRIMARY KEY (`id_hse`);

--
-- Indexes for table `ms_ijin_usaha`
--
ALTER TABLE `ms_ijin_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_iu_bsb`
--
ALTER TABLE `ms_iu_bsb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_login`
--
ALTER TABLE `ms_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_material`
--
ALTER TABLE `ms_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_pemilik`
--
ALTER TABLE `ms_pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_penawaran`
--
ALTER TABLE `ms_penawaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_pengalaman`
--
ALTER TABLE `ms_pengalaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_pengurus`
--
ALTER TABLE `ms_pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement`
--
ALTER TABLE `ms_procurement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement_barang`
--
ALTER TABLE `ms_procurement_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement_bsb`
--
ALTER TABLE `ms_procurement_bsb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement_kurs`
--
ALTER TABLE `ms_procurement_kurs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ms_procurement_persyaratan`
--
ALTER TABLE `ms_procurement_persyaratan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement_peserta`
--
ALTER TABLE `ms_procurement_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_procurement_tatacara`
--
ALTER TABLE `ms_procurement_tatacara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_score_k3`
--
ALTER TABLE `ms_score_k3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_situ`
--
ALTER TABLE `ms_situ`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_tdp`
--
ALTER TABLE `ms_tdp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_vendor`
--
ALTER TABLE `ms_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_vendor_admistrasi`
--
ALTER TABLE `ms_vendor_admistrasi`
  ADD PRIMARY KEY (`id`,`vendor_office_status`);

--
-- Indexes for table `ms_vendor_pic`
--
ALTER TABLE `ms_vendor_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_blacklist_limit`
--
ALTER TABLE `tb_blacklist_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_budget_holder`
--
ALTER TABLE `tb_budget_holder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_budget_spender`
--
ALTER TABLE `tb_budget_spender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_city`
--
ALTER TABLE `tb_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_country`
--
ALTER TABLE `tb_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_csms_limit`
--
ALTER TABLE `tb_csms_limit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dpt_type`
--
ALTER TABLE `tb_dpt_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kurs`
--
ALTER TABLE `tb_kurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_legal`
--
ALTER TABLE `tb_legal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mekanisme`
--
ALTER TABLE `tb_mekanisme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ms_quest_k3`
--
ALTER TABLE `tb_ms_quest_k3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pejabat_pengadaan`
--
ALTER TABLE `tb_pejabat_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_progress_pengadaan`
--
ALTER TABLE `tb_progress_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_province`
--
ALTER TABLE `tb_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_quest`
--
ALTER TABLE `tb_quest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sbu`
--
ALTER TABLE `tb_sbu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_bidang`
--
ALTER TABLE `tb_sub_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_quest_k3`
--
ALTER TABLE `tb_sub_quest_k3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_answer_hse`
--
ALTER TABLE `tr_answer_hse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_ass_point`
--
ALTER TABLE `tr_ass_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_ass_result`
--
ALTER TABLE `tr_ass_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_blacklist`
--
ALTER TABLE `tr_blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_blacklist_remark`
--
ALTER TABLE `tr_blacklist_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_dpt`
--
ALTER TABLE `tr_dpt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_email_blast`
--
ALTER TABLE `tr_email_blast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_evaluasi_poin`
--
ALTER TABLE `tr_evaluasi_poin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_material_price`
--
ALTER TABLE `tr_material_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_note`
--
ALTER TABLE `tr_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_progress_kontrak`
--
ALTER TABLE `tr_progress_kontrak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_progress_pengadaan`
--
ALTER TABLE `tr_progress_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_admin`
--
ALTER TABLE `ms_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ms_agen`
--
ALTER TABLE `ms_agen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ms_agen_bsb`
--
ALTER TABLE `ms_agen_bsb`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_agen_produk`
--
ALTER TABLE `ms_agen_produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_akta`
--
ALTER TABLE `ms_akta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ms_answer_hse`
--
ALTER TABLE `ms_answer_hse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `ms_ass`
--
ALTER TABLE `ms_ass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `ms_ass_group`
--
ALTER TABLE `ms_ass_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_contract`
--
ALTER TABLE `ms_contract`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_csms`
--
ALTER TABLE `ms_csms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_evaluasi_data`
--
ALTER TABLE `ms_evaluasi_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_hse`
--
ALTER TABLE `ms_hse`
  MODIFY `id_hse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_ijin_usaha`
--
ALTER TABLE `ms_ijin_usaha`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ms_iu_bsb`
--
ALTER TABLE `ms_iu_bsb`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ms_login`
--
ALTER TABLE `ms_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `ms_material`
--
ALTER TABLE `ms_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ms_pemilik`
--
ALTER TABLE `ms_pemilik`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ms_penawaran`
--
ALTER TABLE `ms_penawaran`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ms_pengalaman`
--
ALTER TABLE `ms_pengalaman`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_pengurus`
--
ALTER TABLE `ms_pengurus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ms_procurement`
--
ALTER TABLE `ms_procurement`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ms_procurement_barang`
--
ALTER TABLE `ms_procurement_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ms_procurement_bsb`
--
ALTER TABLE `ms_procurement_bsb`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ms_procurement_kurs`
--
ALTER TABLE `ms_procurement_kurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ms_procurement_persyaratan`
--
ALTER TABLE `ms_procurement_persyaratan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ms_procurement_peserta`
--
ALTER TABLE `ms_procurement_peserta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ms_procurement_tatacara`
--
ALTER TABLE `ms_procurement_tatacara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ms_score_k3`
--
ALTER TABLE `ms_score_k3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ms_situ`
--
ALTER TABLE `ms_situ`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ms_tdp`
--
ALTER TABLE `ms_tdp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_vendor`
--
ALTER TABLE `ms_vendor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ms_vendor_admistrasi`
--
ALTER TABLE `ms_vendor_admistrasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ms_vendor_pic`
--
ALTER TABLE `ms_vendor_pic`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `tb_blacklist_limit`
--
ALTER TABLE `tb_blacklist_limit`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_budget_holder`
--
ALTER TABLE `tb_budget_holder`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_budget_spender`
--
ALTER TABLE `tb_budget_spender`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_city`
--
ALTER TABLE `tb_city`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_country`
--
ALTER TABLE `tb_country`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_csms_limit`
--
ALTER TABLE `tb_csms_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_dpt_type`
--
ALTER TABLE `tb_dpt_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_kurs`
--
ALTER TABLE `tb_kurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_legal`
--
ALTER TABLE `tb_legal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_mekanisme`
--
ALTER TABLE `tb_mekanisme`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_ms_quest_k3`
--
ALTER TABLE `tb_ms_quest_k3`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_pejabat_pengadaan`
--
ALTER TABLE `tb_pejabat_pengadaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_progress_pengadaan`
--
ALTER TABLE `tb_progress_pengadaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_province`
--
ALTER TABLE `tb_province`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_quest`
--
ALTER TABLE `tb_quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_sbu`
--
ALTER TABLE `tb_sbu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_sub_bidang`
--
ALTER TABLE `tb_sub_bidang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=586;
--
-- AUTO_INCREMENT for table `tb_sub_quest_k3`
--
ALTER TABLE `tb_sub_quest_k3`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tr_answer_hse`
--
ALTER TABLE `tr_answer_hse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT for table `tr_ass_point`
--
ALTER TABLE `tr_ass_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_ass_result`
--
ALTER TABLE `tr_ass_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_blacklist`
--
ALTER TABLE `tr_blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_blacklist_remark`
--
ALTER TABLE `tr_blacklist_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tr_dpt`
--
ALTER TABLE `tr_dpt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_email_blast`
--
ALTER TABLE `tr_email_blast`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `tr_evaluasi_poin`
--
ALTER TABLE `tr_evaluasi_poin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `tr_material_price`
--
ALTER TABLE `tr_material_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tr_note`
--
ALTER TABLE `tr_note`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_progress_kontrak`
--
ALTER TABLE `tr_progress_kontrak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_progress_pengadaan`
--
ALTER TABLE `tr_progress_pengadaan`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
