-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2019 at 09:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bi-baru`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idpengguna` varchar(6) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `photo` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idpengguna`, `nama_lengkap`, `alamat`, `no_telp`, `photo`) VALUES
('A00001', 'Rica', 'Bandung', '085697119992', '1509944962.png'),
('A00002', 'administrator', 'Bandung', '08', '1539413245.png'),
('A00003', 'Bara Muttaqin Prabowo', 'Bandung', '087710303318', ''),
('A00004', 'muhamad nuroini', 'bandung', '081328648676', ''),
('A00005', 'Endang abdiyah', 'Bandung', '081224266123', ''),
('A00006', 'Sugiharti', 'Bandung', '081224666811', ''),
('A00007', 'Candra Hidayat', 'Bandung', '08112272090', ''),
('A00008', 'Supandi', 'Bandung', '081321206753', '1539413213.png'),
('A00009', 'Fahri Laode Sadikin', 'Kp. Ciranjang', '08995165153', '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `jumlah_stok` int(5) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `keterangan`, `jumlah_stok`, `stok`) VALUES
('B00001', 'Kursi', 'Kursi Rapat', 30, 30),
('B00002', 'Laptop HP', 'SN-LOG/2016/008', 1, 1),
('B00003', 'Laptop HP', 'SN-LOG/2016/004', 1, 1),
('B00004', 'Laptop HP', 'SN-LOG/2016/011', 1, 0),
('B00005', 'Laptop HP', 'SN-LOG/2016/012', 1, 0),
('B00006', 'Notebook HP ProBook 440s  / SN. 2CE3120FGT', 'SN-LOG/2016/001', 1, 1),
('B00007', 'Laptop HP', 'SN-LOG/2018/002', 1, 0),
('B00008', 'Laptop HP', 'SN-LOG/2018/003', 1, 0),
('B00009', 'Laptop HP', 'SN-LOG/2016/007', 1, 1),
('B00010', 'Laser Pointers', 'SN-LOG/2016/003', 1, 0),
('B00011', 'Laser Pointers', 'SN-LOG/2016/002', 1, 0),
('B00012', 'Tape Recorder', 'SN-LOG/2016/003', 1, 1),
('B00013', 'Tape Recorder', 'SN-LOG/2016/004', 1, 0),
('B00014', 'Tape Recorder', 'SN-LOG/2016/005', 1, 1),
('B00015', 'Infocus Hitachi CP-X2520 / SN. F1DE08449', 'SN-LOG/2017/001', 1, 0),
('B00016', 'Laser Pointers', 'SN-LOG/2016/004', 1, 0),
('B00017', 'Infocus', 'SN-LOG/2017/002', 1, 0),
('B00018', 'Laser Pointers', 'SN-LOG/2016/001', 1, 1),
('B00019', 'Notebook HP Elite Book 440  / SN. CNU4079NF7', 'SN-LOG/2016/0012', 1, 1),
('B00020', 'Notebook HP Elite Book 820  / SN. CNU4279X9V', 'SN-LOG/2016/007', 1, 1),
('B00021', 'Infocus Light Pro / SN. BRNC44300240', 'SN-LOG/2016/003', 1, 1),
('B00022', 'Notebook HP ProBook  / SN. 2CE3120FGR', 'SN-LOG/2016/005', 1, 1),
('B00023', 'Infocus EIKI LC-XBL25 / SN. HO1A6697', 'SN-LOG/2016/005', 1, 0),
('B00024', 'Infocus EIKI LC-XB100A / SN. HO3A235B', 'SN-LOG/2016/002', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eksekutor`
--

CREATE TABLE IF NOT EXISTS `eksekutor` (
  `idpengguna` varchar(6) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `unit` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(35) NOT NULL,
  `photo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eksekutor`
--

INSERT INTO `eksekutor` (`idpengguna`, `nama_lengkap`, `unit`, `alamat`, `no_telp`, `photo`) VALUES
('E00006', 'Denni Sumarwan / Beben S / Kamaludin', ' Bidang House Keeping dan Bangquet', 'Bandung', '081322242523', ''),
('E00010', 'Arif Kusumariyadi / M Nuroini', 'Bidang Elektrikal', 'Bandung', '085221228882', ''),
('E00011', 'Noor Sulaksana / Teddy Johar', 'Bidang Mekanikal', 'Bandung', '085794105656', ''),
('E00014', 'Dodi HIAS / Hera', 'Bidang Landscape', 'Bandung', '085795477995', ''),
('E00015', 'Dedi Munggaran / Iwan Ridwan', 'Bidang Sipil', 'Bandung', '082115569990', ''),
('E00016', 'Administrator', 'Freelance', '-', '08774211191', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `idfeedback` varchar(25) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `feedback` text NOT NULL,
  `wkt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`idfeedback`, `idpengguna`, `feedback`, `wkt`, `baca_admin`) VALUES
('20180521055621', 'P00001', 'Terimakasih Pelayanan Memuaskan .... ', '2018-05-21 05:56:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_request`
--

CREATE TABLE IF NOT EXISTS `kategori_request` (
  `id_kategori` varchar(4) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_request`
--

INSERT INTO `kategori_request` (`id_kategori`, `kategori`) VALUES
('KR01', 'Perbaikan'),
('KR02', 'Permintaan'),
('KR03', 'Penyedia Ruangan');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_request`
--

CREATE TABLE IF NOT EXISTS `klasifikasi_request` (
  `id_klasifikasi` varchar(3) NOT NULL,
  `klasifikasi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasifikasi_request`
--

INSERT INTO `klasifikasi_request` (`id_klasifikasi`, `klasifikasi`) VALUES
('K01', 'Ringan'),
('K02', 'Sedang'),
('K03', 'Berat');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idpengguna` varchar(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idpengguna`, `username`, `password`, `level`) VALUES
('A00001', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
('P00001', 'adikusumah2012@gmail.com', '047aeeb234644b9e2d4138ed3bc7976a', 'pegawai'),
('P00025', 'rachmad_h@bi.go.id', '315035fe92f77c3fa047a80b49b13a35', 'pegawai'),
('A00007', 'candra_h@bi.go.id', '6891d3907ebfad8dbb7a4686492d4130', 'admin'),
('P00026', 'rahmawaty@bi.go.id', '027ab5f683331934984d0dfb451f1bcb', 'pegawai'),
('P00003', '4ndri.4dikusumah@gmail.com', '047aeeb234644b9e2d4138ed3bc7976a', 'pegawai'),
('A00002', 'tokecangabret@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
('A00008', 'supandi@bi.go.id', '577204230523b9047e9cceac4afc7376', 'admin'),
('P00005', 'bara_mp@bi.go.id', 'f77532c080452873f5d91bb045012d76', 'pegawai'),
('A00004', 'mahoni9wood@gmail.com', '07d1d22a7b638156c1369429c9c76b07', 'admin'),
('A00003', 'bara_mp@bi.go.id', '81d91989bb0a331261e394abf66d0515', 'admin'),
('P00006', 'rica_m@bi.go.id', '64b5d079bb4d573a5733965e363cec25', 'pegawai'),
('P00007', 'palestina_s@bi.go.id', '2e81d829f0d81bde3ff54e2d45216bb8', 'pegawai'),
('P00024', 'iwan_ridwan@bi.go.id', 'a6164d17a15188fdef6c42e8bfc1e04c', 'pegawai'),
('E00006', 'housekeepingbijabar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'eksekutor'),
('P00021', 'ambarkusumo@bi.go.id', '9389eb78ba67a9160504d36f32f310ee', 'pegawai'),
('P00022', 'darjana@bi.go.id', '0fbd354e9f82e44498043e471b52669a', 'pegawai'),
('P00023', 'ahmad_ps@bi.go.id', '132db2a893933b3b1ee391e93a1d6560', 'pegawai'),
('E00010', 'mahoni9wood@gmail.com', '2411a142826944edde34a8a659178c51', 'eksekutor'),
('E00011', 'mechanicalbi.jabar@gmail.com', 'c70ed5edb6231536b5ee46e5a67c3808', 'eksekutor'),
('P00027', 'kosotali@bi.go.id', '946639b9c52973a9da11140b1a96aa41', 'pegawai'),
('A00005', 'endang_a@bi.go.id', '938d6eec2f36d2830c3430719552ec68', 'admin'),
('A00006', 'sugiharti@bi.go.id', '915a5ad16b55cdab08015b39c5b490f5', 'admin'),
('E00014', 'lansekapbijabar@gmail.com', 'd82dc77f9c81adb6022db04c8e36493a', 'eksekutor'),
('E00015', 'sipil.bijabar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'eksekutor'),
('P00008', 'teguh_dp@bi.go.id', '574cf1ceeb35b4fd7d425b3159a04019', 'pegawai'),
('P00009', 'tela_at@bi.go.id', '1edfe3c5c3f0e10786f0f18c9b6c811c', 'pegawai'),
('P00010', 'candra_h@bi.go.id', '2a11d32965ea8ca5508e2c2c3aaee070', 'pegawai'),
('P00121', 'cahya_n@bi.go.id', 'fe5d6b0edd3bf1221e2f19ab5a5c5939', 'pegawai'),
('P00013', 'mikael@bi.go.id', '984d18c339db0922798c6abe64896393', 'pegawai'),
('P00014', 'ismet_i@bi.go.id', '9d7b5eb16a6e9fcefd00ce3e73bfb936', 'pegawai'),
('P00015', 'budiawan@bi.go.id', '49b8e7f7ba7b2cc1a84d47f6390d4580', 'pegawai'),
('P00016', 'endang_a@bi.go.id', '9a62d1b3fc7ba41e9d7fada0d2521150', 'pegawai'),
('P00017', 'sugiharti@bi.go.id', '4264b343e9357ff01ad97ef1089ce0bd', 'pegawai'),
('P00018', 'supandi@bi.go.id', 'f035d2f7b5d3667fc03d6cbee3b94ecc', 'pegawai'),
('P00019', 'azhar_ls@bi.go.id', '8513f337148818d3050006ce6c3cbd0a', 'pegawai'),
('P00020', 'wahyu_putri@bi.go.id', '72d3c9a77964225ca3064709e5560af3', 'pegawai'),
('P00028', 'yahyudin@bi.go.id', '25eed7772476a54ba5911cd93649d2c1', 'pegawai'),
('P00029', 'amanda_l@bi.go.id', '11ffde0bf8d9d5b6f1612375d0bce9da', 'pegawai'),
('P00030', 'arwin_j@bi.go.id', 'c1735433acf7a60a94d10ffb02c58828', 'pegawai'),
('P00031', 'wishnu_gj@bi.go.id', 'b5a6c0223cae9ed76aa878c2b1088328', 'pegawai'),
('P00032', 'eka_rs@bi.go.id', '1e25de49ce520fd7e6e07666400d235e', 'pegawai'),
('P00033', 'otong_h@bi.go.id', 'e8403fe79c9a15a116bcc749e608806b', 'pegawai'),
('P00034', 'lela@bi.go.id', '1fbd9561a001b7a71c7e0bd49c3f6417', 'pegawai'),
('P00035', 'sahabat@bi.go.id', '03f62d9bf4279ada563276f30386f843', 'pegawai'),
('P00036', 'suarpika@bi.go.id', 'eae679005108847ef34a1f68e4a43306', 'pegawai'),
('P00037', 'donipjoe@bi.go.id', '39776e5675813bf89c6c92bc27c71946', 'pegawai'),
('P00038', 'pramudyaw@bi.go.id', '39e6a1c19bc85c127a764db423417dbd', 'pegawai'),
('P00039', 'marsal@bi.go.id', 'f9816c5a0628d962f28db562730fd94e', 'pegawai'),
('P00040', 'maya_m@bi.go.id', '1670744f95d94666c0e41b0a5dcd059b', 'pegawai'),
('P00041', 'jeremias_mw@bi.go.id', '8a0d47612ca2fb1db6461b62eb5f6af1', 'pegawai'),
('P00042', 'sudarso@bi.go.id', '35151609c26e17ac1a7b8b2867a2f083', 'pegawai'),
('P00043', 'evi_d@bi.go.id', '68eb4134876aa29126528ae5a4522b76', 'pegawai'),
('P00044', 'h_novianto@bi.go.id', '6f3c120217bff488e2a1e93173d6ff0f', 'pegawai'),
('P00045', 'peri_a@bi.go.id', '9b1a87425a7f0422ccb3907ebca3fbd8', 'pegawai'),
('P00046', 'iman_k@bi.go.id', 'b4809f571bad91a3c4a1651523018601', 'pegawai'),
('P00047', 'topo_s@bi.go.id', '02cb94e8ac218800b40fb228a2d1184a', 'pegawai'),
('P00048', 'sofyan_ca@bi.go.id', 'efe1534ed2544da190159440b9d2722a', 'pegawai'),
('P00049', 'nana_l@bi.go.id', '34fe21ba9ec461dbb7c2c796219797d0', 'pegawai'),
('P00050', 'diana_s@bi.go.id', '1487f1d515c99d1755c84b645a3d9bc9', 'pegawai'),
('P00051', 'dudimd@bi.go.id', '07df39b5c3f72d36ff68b92731893b27', 'pegawai'),
('P00052', 'yanti_a@bi.go.id', '3686a49920e86972457c5caf77e5c09c', 'pegawai'),
('P00053', 's_ami@bi.go.id', 'd5aefcc29b78273fa8aa9e8a23b2e8e6', 'pegawai'),
('P00054', 'retno_p@bi.go.id', '0ea8f8d8bfe373d68c0dc05b0c6d1e2b', 'pegawai'),
('P00055', 'adik_p@bi.go.id', '22ecb231f2634950d7a620c301127c51', 'pegawai'),
('P00056', 'a_hidayat@bi.go.id', '4edbe324a4510c816df1256e8db880b9', 'pegawai'),
('P00057', 'agus_th@bi.go.id', '91a1bfe56f4b80e2b6246c8f67d0372c', 'pegawai'),
('P00058', 'riany_r@bi.go.id', 'e24692674da12f6d7ff368e4409f1fa4', 'pegawai'),
('P00059', 'yistiandi@bi.go.id', 'f543daa17e4508fca4449bffcdc40de9', 'pegawai'),
('P00060', 'renny_lp@bi.go.id', 'ef2bdc947d2f4fee6b8f290a0f833b01', 'pegawai'),
('P00061', 'daharu_a@bi.go.id', '495de33d8d66a4d6d1d6a50415f338f1', 'pegawai'),
('P00062', 'a_dwijaya@bi.go.id', '9bac85e2e983977cac8c8c1b260605dd', 'pegawai'),
('P00063', 'tri_s@bi.go.id', '25d1484ff3bd77ced803dee183937006', 'pegawai'),
('P00064', 'nrudyatna@bi.go.id', '492eb38d109bfd81bc508bbbb12b1226', 'pegawai'),
('P00065', 'danny_a@bi.go.id', '2bb7525801126ac33f6418da7f393005', 'pegawai'),
('P00066', 'rusoli@bi.go.id', 'f3dc0e988cde758fd6d364fff2a0de60', 'pegawai'),
('P00067', 'moch_aac@bi.go.id', 'd4d100ee455babd2f51894c8de761a41', 'pegawai'),
('P00068', 'dwita@bi.go.id', '02303699e57a682ca8e4faae036bb58a', 'pegawai'),
('P00069', 'mediana_a@bi.go.id', '0afc8e83e8b4ff075e82c1281425954a', 'pegawai'),
('P00070', 'poppi_s@bi.go.id', 'ad6ed4bc42b33baca283ddcc6ca8e19b', 'pegawai'),
('P00071', 'rini_ferina@bi.go.id', 'a6e8cd9ab2dc0abbca876559d9de03f0', 'pegawai'),
('P00072', 'trisno_s@bi.go.id', '52e14c380d8b075ec3c2fcb893e73ffd', 'pegawai'),
('P00073', 'wahyu_bk@bi.go.id', '1699839d5c957020603ec2e88abff3ba', 'pegawai'),
('P00074', 'a_ramdan@bi.go.id', 'e7d497956f5bbf7f6409d83c8a3b3b39', 'pegawai'),
('P00076', 'umiri@bi.go.id', '72c90a9588cbb4af92a8ff09dd78dc69', 'pegawai'),
('P00077', 'sri_n@bi.go.id', 'd7eb08d9e5b6f5622005221b28f72d3b', 'pegawai'),
('P00078', 'novita_es@bi.go.id', 'e89b095e8cb3f7290a2d3c4f028362c2', 'pegawai'),
('P00079', 'muhammad_am@bi.go.id', '582f6b14501be03b161dc9003d6307b0', 'pegawai'),
('P00080', 'arief_y@bi.go.id', '709c8eb43108b7995077bb7facb93081', 'pegawai'),
('P00081', 'cahyanti@bi.go.id', 'f71382581f82dcabfb38b6ddb712cedb', 'pegawai'),
('P00082', 'devy_am@bi.go.id', 'c5f8f9e4ef1169585d76cef9682a3f63', 'pegawai'),
('P00083', 'eka_nf@bi.go.id', '380db26c85b317a9fce1d520c37c75ca', 'pegawai'),
('P00084', 'rianti_s@bi.go.id', '02742cd091f70aa9f73a880ec33bd871', 'pegawai'),
('P00085', 'tatang_t@bi.go.id', 'c6e6a933e9e12f6f4b16ed9fe2ac37a9', 'pegawai'),
('P00086', 'yoeke_r@bi.go.id', '1734185a388cb0cf4939a2f29e3ab6a1', 'pegawai'),
('P00087', 'purnama_a@bi.go.id', '635c4a7fb5bd6ea3daac7543a2a3fe6f', 'pegawai'),
('P00088', 'a_sukmadijaya@bi.go.id', 'cf05e9bfaf5bb1f41b848001f9be557d', 'pegawai'),
('P00089', 'jajat_s@bi.go.id', 'a0c11319bfbaf009af834a5a203bbad0', 'pegawai'),
('P00090', 'sandy_a@bi.go.id', 'c2d6b8aa44fc44946450f2c9d5092759', 'pegawai'),
('P00091', 'antasari_y@bi.go.id', '07b8967195f4f6db7ef0c0bf4b832fe2', 'pegawai'),
('P00092', 'aggi_g@bi.go.id', 'ff88c2fda27a09a7baca4075679dc7c9', 'pegawai'),
('P00093', 'anggia_s@bi.go.id', '7247f13fde7ea1c9cfc6658a95579373', 'pegawai'),
('P00094', 'suryadi_a@bi.go.id', 'ca519bde22622a4c5c95cd8511d96d4d', 'pegawai'),
('P00095', 'egi_gb@bi.go.id', 'bec44e2affeaf02aacf3c185a6202119', 'pegawai'),
('P00096', 'ridwan_s@bi.go.id', 'ed794344a5a98671359267e732f591bb', 'pegawai'),
('P00097', 'albertha@bi.go.id', '8daba464bc69540361d540f855830346', 'pegawai'),
('A00009', 'fahrilaodesadikin@gmail.com', '2038afa4353bd4de3dfd449a8348b48c', 'admin'),
('P00099', 'hesti_cs@bi.go.id', '4b03c1f2d8ca38b2a80a5f0b08f94e9e', 'pegawai'),
('E00016', 'tokekcang@gmail.com', 'c70ed5edb6231536b5ee46e5a67c3808', 'eksekutor'),
('P00101', 'imma_ns@bi.go.id', 'db88c7fe26cc642d535543fc26d012b0', 'pegawai'),
('P00102', 'ebrinda_dg@bi.go.id', '4b7019b5f4b875a94d525f872f0b681d', 'pegawai'),
('P00103', 'ilham_w@bi.go.id', '6a72db4954e06c6bd5b33d2d58a0c4d3', 'pegawai'),
('P00104', 'rahma_dp@bi.go.id', '74d89a9babda9e367e4cbbc68cb339e3', 'pegawai'),
('P00105', 'zainuddin_a@bi.go.id', '56307bf593f5984549c720d2ea1ccf41', 'pegawai'),
('P00106', 'firman_b@bi.go.id', 'cf05cd9f9f3b3b95b337cbd66096928c', 'pegawai'),
('P00107', 'nursuciaman@bi.go.id', 'cabbeea2631be3d0c240dbaef087d21c', 'pegawai'),
('P00108', 'alam_wk@bi.go.id', '0c8dc85c569c0a1744520c1a7373e448', 'pegawai'),
('P00109', 'rega_a@bi.go.id', '1579ee2ae3d46577b8dba05d28144b69', 'pegawai'),
('P00110', 'riki_zn@bi.go.id', '7466533b54964c53f071b0ae0f3291d1', 'pegawai'),
('P00111', 'reza_r@bi.go.id', '6d61404ddb8abceb00dbbecd1df1fad5', 'pegawai'),
('P00112', 'rahman_g@bi.go.id', '980f51aec68f31e8c40003db4581bf7b', 'pegawai'),
('P00113', 'm_akbar@bi.go.id', 'c57c598f7607a62727b6eaa557bf620d', 'pegawai'),
('P00114', 'chandra_p@bi.go.id', 'fa5da1078e5a0d02495f14cad439b9c8', 'pegawai'),
('P00115', 'angga_as@bi.go.id', 'a46fba7918f4f793eec01095937ceb88', 'pegawai'),
('P00116', 'alfin_r@bi.go.id', '3a7653f6e7c06083c4c6005b5a5ac112', 'pegawai'),
('P00117', 'novianti_eka.pcpm@bi.go.id', '38f8b46060c623faeaadecbbb455a8b5', 'pegawai'),
('P00118', 'heru_sp@bi.go.id', 'ead49563e9d50fc5cbded8834f70d259', 'pegawai'),
('P00119', 'muthia_r@bi.go.id', '90d147a583d348b2b92bb3e82d3ee8d7', 'pegawai'),
('P00120', 'dian_s@bi.go.id', 'bae62238dfb4f7468208e4a3570d587e', 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `kode_lokasi` varchar(6) NOT NULL,
  `lokasi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kode_lokasi`, `lokasi`) VALUES
('L00001', 'Jl. Ir. H. Juanda No. 146'),
('L00002', 'Jl. Bagusrangin No. 3'),
('L00003', 'Jl. Dr. Otten No. 22'),
('L00004', 'Jl. Dipati Ukur No. 28'),
('L00005', 'Jl. Suryalaya No. 10'),
('L00006', 'Jl. Suryalaya  No. 25 B'),
('L00007', 'Jl. Suryalaya  No. 10 C'),
('L00008', 'Jl. Suryalaya  No. 10 D'),
('L00009', 'Jl. H. Hasan No. 20'),
('L00010', 'Jl. Suryalaya  No. 25 A'),
('L00011', 'Jl. Suryalaya  No. 10 B'),
('L00012', 'Jl. Suryalaya  No. 10 A'),
('L00013', 'Jl. Suryalaya  No. 25 '),
('L00014', 'Jl. Surya Indah No. 20'),
('L00015', 'Jl. Surya Indah No. 22'),
('L00016', 'Jl. Surya Indah No. 31'),
('L00017', 'Jl. Surya Indah No. 33'),
('L00018', 'Jl. Buah Batu No. 294'),
('L00019', 'Jl. Suryalaya No. 15'),
('L00020', 'Jl. Suryalaya No. 17'),
('L00021', 'Jl. Suryalaya No. 19'),
('L00022', 'Jl. Suryalaya No. 23'),
('L00023', 'Jl. Suryalaya No. 21'),
('L00024', 'Jl. Surya Indah No. 18'),
('L00025', 'Jl. Surya Indah No. 30'),
('L00026', 'Jl. Surya Indah No. 32'),
('L00027', 'Jl. Surya Indah No. 34'),
('L00028', 'Jl. Surya Indah No. 36'),
('L00029', 'Jl. Buah Batu No. 292'),
('L00030', 'Jl. Surya Indah No. 27'),
('L00031', 'Jl. Surya Indah No. 29'),
('L00032', 'Jl. Surya Indah No. 38'),
('L00033', 'Jl. Suryalaya No. 134'),
('L00034', 'Jl. Surya Indah No. 10'),
('L00035', 'Jl. Suryalaya No. 140'),
('L00036', 'Jl. Suryalaya No. 138'),
('L00037', 'Jl. Surya Indah No. 12'),
('L00038', 'Jl. Suryalaya No. 135'),
('L00039', 'Jl. Suryalaya No. 137'),
('L00040', 'Jl. Suryalaya No. 139'),
('L00041', 'Jl. Pualam No. 141'),
('L00042', 'Jl. Suryalaya No. 133'),
('L00043', 'Jl. Surya Indah No. 8'),
('L00044', 'Jl. Surya Indah No. 16'),
('L00045', 'Jl. Surya Indah No. 24'),
('L00046', 'Jl. Surya Indah No. 26'),
('L00047', 'Jl. Suryalaya No. 136'),
('L00048', 'Jl. Surya Indah No. 14'),
('L00049', 'Gedung Kantor');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `idpengguna` varchar(6) NOT NULL,
  `nomor_induk` varchar(20) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `photo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpengguna`, `nomor_induk`, `nama_lengkap`, `jabatan`, `jk`, `alamat`, `no_telp`, `photo`) VALUES
('P00001', '012345678', 'Andri Adikusumah', 'Manajer', 'l', 'Jl. Raya Bandung Barat', '085861491913', '1539413283.png'),
('P00003', '', 'Agus Seheri', '', '', 'Jl. Khasasar Bin Sasar', '08776457387465', ''),
('P00005', '15169', 'BARA MUTTAQIN PRABOWO', 'Staf', 'l', 'bandung', '0857345829223', ''),
('P00006', '15360', 'RICA MUBAROKAH', 'Staf', 'p', 'Bandung', '085697119992', ''),
('P00007', '14500', 'PALESTINA SAFITRI W.', 'Staf', 'p', 'Bandung', '087824130828', ''),
('P00008', '09906', 'TEGUH DWI PRASETYO W', 'Manajer', 'l', 'bandung', '0821321556789', ''),
('P00009', '13309', 'TELA ANGGARAYAN TIRTA', 'Staf', 'l', 'bandung', '0812221234546', ''),
('P00010', '15175', 'CANDRA HIDAYAT', 'Staf', 'l', 'bandung', '085861231987', ''),
('P00013', '11381', 'MIKAEL BUDISATRIO', 'Deputi Direktur', 'l', 'bandung', '0867821345', ''),
('P00014', '10846', 'ISMET INONO', 'Direktur', 'l', 'bandung', '085761234875', ''),
('P00015', '11964', 'BUDIAWAN', 'Manajer', 'l', 'bandung', '08572346253', ''),
('P00016', '11962', 'ENDANG A.R. EFFENDI S.', 'Manajer', 'p', 'Bandung', '0821123098765', ''),
('P00017', '13814', 'SUGIHARTI', 'Asisten Manajer', 'p', 'bandung', '085761234675', ''),
('P00018', '11348', 'SUPANDI', 'Staf', 'l', 'bandung', '0897863988', ''),
('P00019', '15543', 'AZHAR LIVALDLY SETYAWIGOE', 'Asisten Manajer', 'l', 'Jl.Surya Indah No.24', '081391684869', ''),
('P00020', '15594', 'WAHYU PUTRI PAMUNGKAS', 'Asisten Manajer', 'p', 'Jl.Suryalaya No.26', '081314173191', ''),
('P00021', '11126', 'R.H. AMBARKUSUMO', 'Manajer', 'l', 'bandung', '1213', ''),
('P00022', '12796', 'DARJANA', 'Asisten Direktur', 'l', 'bandung', '123', ''),
('P00023', '12869', 'ACHMAD P. SUBARKAH', 'Asisten Direktur', 'l', 'bandung', '124', ''),
('P00024', '09995', 'IWAN RIDWAN', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00025', '11062', 'RACHMAD HARNOMO', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00026', '10660', 'RAHMAWATI LUBIS', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00027', '12789', 'ASWIN KOSOTALI', 'Asisten Direktur', 'l', 'bandung ', '1213', ''),
('P00028', '10498', 'MOHAMAD YAHYUDIN', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00029', '14686', 'AMANDA LETHIZYA LESTARI', 'Manajer', 'p', 'bandung', '123', ''),
('P00030', '11473', 'ARWIN JOHARI', 'Asisten Manajer', 'l', 'bandung`', '123', ''),
('P00031', '11482', 'WISHNU GIRI JATMIKO', 'Asisten Manajer', 'l', 'bandung ', '123', ''),
('P00032', '11283', 'EKA RAHMAEDI SUNARYA', 'Manajer', 'l', 'bandung ', '1213', ''),
('P00033', '11491', 'OTONG HIDAYAT', 'Asisten Manajer', 'l', 'bandung', '', ''),
('P00034', '11392', 'SUKARELAWATI PERMANA', 'Direktur', 'p', 'bandung', '123', ''),
('P00035', '12672', 'IMADUDDIN SAHABAT', 'Deputi Direktur', 'l', 'bandung', '123', ''),
('P00036', '11836', 'SUARPIKA BIMANTORO', 'Deputi Direktur', 'l', 'bandung', '123', ''),
('P00037', '11357', 'DONI PRIMANTO JOEWONO', 'Direktur Eksekutif', 'l', 'bandung', '123', ''),
('P00038', '14613', 'PRAMUDYA WICAKSANA', 'Manajer', 'l', 'bandung', '132', ''),
('P00039', '10059', 'MARSAL', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00040', '13679', 'MAYA MULYAWATI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00041', '10326', 'JEREMIAS MELCHIANUS W.', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00042', '12039', 'SUDARSO', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00043', '10796', 'EVI DWIYANTHI', '', 'p', 'bandung', '1234', ''),
('P00044', '11968', 'HERMAWAN NOVIANTO', 'Asisten Direktur', 'l', 'bandung', '123', ''),
('P00045', '132424', 'PERI ARDIANSAH', 'Staf', 'l', 'bandung', '1233', ''),
('P00046', '13235', 'IMAN KURNIAWAN', 'Staf', 'l', 'bandung', '13', ''),
('P00047', '13238', 'TOPO SUHARTONO', 'Staf', 'l', 'bandung', '1231', ''),
('P00048', '13237', 'SOFYAN CATUR APRIANTO', 'Staf', 'l', 'bandung', '1223', ''),
('P00049', '11016', 'NANA LAKSANA', 'Asisten Manajer', 'l', 'bandung', '124', ''),
('P00050', '12250', 'DIANA SETYAWATI', 'Asisten Manajer', 'p', 'bandung', '132', ''),
('P00051', '12811', 'RD.M. DUDI DERMAWAN S.', 'Deputi Direktur', 'l', 'bandung', '13', ''),
('P00052', '11967', 'YANTI AHDYANTI AGUS S.', 'Asisten Manajer', 'p', 'bandung', '1234', ''),
('P00053', '12019', 'SITI AMINAH', 'Manajer', 'p', 'bandug', '1234', ''),
('P00054', '14113', 'RETNO PURWANTIE', 'Staf', 'p', 'bandung', '132', ''),
('P00055', '09869', 'ADIK PERMANA', 'Asisten Manajer', 'l', 'bandung', '124', ''),
('P00056', '11347', 'AGUS HIDAYAT', 'Staf', 'l', 'bandung', '11234', ''),
('P00057', '13065', 'AGUS TRI HARTONO', 'Staf', 'l', 'bandung', '132', ''),
('P00058', '13812', 'RIANY RAMADHIYANI', 'Asisten Manajer', 'p', 'bandung', '125', ''),
('P00059', '10437', 'YAYAN ISTIANDI', 'Manajer', 'l', 'bandung', '142', ''),
('P00060', '10426', 'RENNY LUMINDA POHAN', 'Asisten Manajer', 'p', 'bandung', '124', ''),
('P00061', '12044', 'DAHARU ATMAWATI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00062', '13231', 'ANDRI DWIJAYA', 'Staf', 'l', 'bandung', '123', ''),
('P00063', '13244', 'TRI SEPTIADI', 'Staf', 'l', 'bandung', '123', ''),
('P00064', '12018', 'NANDANG RUDYATNA', 'Manajer', 'l', 'bandung', '123', ''),
('P00065', '13234', 'DANNY ARIAWAN', 'Staf', 'l', 'bandung ', '123', ''),
('P00066', '13243', 'RUSOLI', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00067', '13236', 'MOCH.  ANDRI ANDRIYANA CA', 'Staf', 'l', 'bandung', '123', ''),
('P00068', '14456', 'DWITA APRIANI', 'Staf', 'p', 'bandung', '123', ''),
('P00069', '10427', 'MEDIANA ADRYANTI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00070', '11972', 'POPPI SOFIA', 'Manajer', 'p', 'bandung', '123', ''),
('P00071', '13873', 'RINI FERINA', 'Asisten Manajer', 'p', 'bandung ', '123', ''),
('P00072', '11586', 'TRISNO SUMARYADI', 'Asisten Manajer', 'l', 'bandung', '122', ''),
('P00073', '12167', 'WAHYU BUDIONO KUSUMOJATI', 'Manajer', 'l', 'bandung', '123', ''),
('P00074', '11865', 'ASEP RAMDAN', 'Asisten Direktur', 'l', 'bandung', '123', ''),
('P00076', '11578', 'UMIRI', 'Staf', 'p', 'bandung', '123', ''),
('P00077', '11349', 'SRI NURHAYATI', 'Staf', 'p', 'bandung', '123', ''),
('P00078', '14995', 'NOVITA EVANS SIMAMORA', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00079', '15019', 'MUHAMMAD ABDILLAH M', 'Asisten', 'l', 'bandung', '123', ''),
('P00080', '15159', 'ARIEF YULIANTO', 'Staf', 'l', 'bandung', '123', ''),
('P00081', '15173', 'CAHYANTI', 'Staf', 'p', 'bandung', '123', ''),
('P00082', '15192', 'DEVY ANGGRAENI MULYANI', 'Staf', 'p', 'bandung', '123', ''),
('P00083', '15214', 'EKA NUR FRIHATIN', 'Staf', 'p', 'bandung', '123', ''),
('P00084', '15359', 'RIANTI SETIAWATI', 'Staf', 'p', 'bandung', '123', ''),
('P00085', '15410', 'TATANG TANUWIJAYA', 'Staf', 'l', 'bandung', '123', ''),
('P00086', '15444', 'YOEKE ROSMIANI', 'Staf', 'p', 'bandung', '123', ''),
('P00087', '15650', 'PURNAMA', 'Asisten', 'l', 'bandung', '122', ''),
('P00088', '15651', 'AHMAD SUKMADIJAYA', 'Asisten', 'l', 'bandung', '123', ''),
('P00089', '15652', 'JAJAT SUTISNA', 'Asisten', 'l', 'bandung', '123', ''),
('P00090', '15653', 'SANDY ANDRYANA', 'Asisten', 'l', 'bandung', '123', ''),
('P00091', '15654', 'ANTASARI YANUAR', 'Asisten', 'l', 'bandung', '123', ''),
('P00092', '15655', 'AGGI GUSDIYANA', 'Asisten', 'l', 'bandung', '123', ''),
('P00093', '15656', 'ANGGIA SEPTYANDI', 'Asisten', 'l', 'bandung ', '122', ''),
('P00094', '15657', 'SURYADI', 'Asisten', 'l', 'bandung', '1223', ''),
('P00095', '15659', 'EGI GINANJAR BUDIHARJA', 'Asisten', 'l', 'bandung', '123', ''),
('P00096', '15660', 'RIDWAN SETIAWAN', 'Asisten', 'l', 'bandung', '123', ''),
('P00097', '15591', 'ALBERTHA DITA DEWANDARI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00099', '15535', 'HESTI CANDRA SARI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00101', '15897', 'IMMA NURMA SARI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00102', '16005', 'EBRINDA DAISY GUSTIANI', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00103', '16049', 'ILHAM WINOTO', 'Asisten Manajer', 'l', 'bandung', '123', ''),
('P00104', '16098', 'RAHMA DEWI PANDIANGAN', 'Asisten Manajer', 'p', 'bandung', '123', ''),
('P00105', '15863', 'ZAINUDDIN', 'Asisten', 'l', 'bandung', '123', ''),
('P00106', '15812', 'FIRMAN BADRUDIN', 'Asisten', 'l', 'bandung', '122', ''),
('P00107', '15840', 'NURSUCIAMAN', 'Asisten', 'l', 'bandung', '123', ''),
('P00108', '16171', 'ALAM WIRAWAN KUSUMA', 'Asisten', 'l', 'bandung', '123', ''),
('P00109', '16223', 'REGA ALANDES', 'Asisten', 'l', 'bandung', '1222', ''),
('P00110', '16425', 'RIKI ZAJULI NUGRAHA', 'Staf', 'l', 'bandung', '123', ''),
('P00111', '16421', 'REZA REVIANSYAH', 'Staf', 'l', 'bandung', '123', ''),
('P00112', '16415', 'RAHMAN GUMILAR', 'Staf', 'l', 'bandung', '122', ''),
('P00113', '16383', 'MUHAMAD AKBAR', 'Staf', 'l', 'bandung', '123', ''),
('P00114', '16298', 'CHANDRA PRATAMA', 'Staf', 'l', 'bandung', '123', ''),
('P00115', '16273', 'ANGGA ADITIA SUDIRMAN', 'Staf', 'l', 'bandung', '123', ''),
('P00116', '16267', 'ALFIN RAHADIAN', 'Staf', 'l', 'bandung', '123', ''),
('P00117', '16601', 'NOVIANTI EKASARI', 'Asisten', 'p', 'bandung', '123', ''),
('P00118', '16742', 'HERU SUBIYANDONO PUTRA', 'Staf', 'l', 'bandung', '123', ''),
('P00119', '16790', 'MUTHIA ROSADILA', 'Staf', 'p', 'bandung', '123', ''),
('P00120', '16700', 'DIAN SEPTIANI', 'Staf', 'p', 'Jl. Bunga Bakung I No. 7 Buahbatu, Kota Bandung, Jawa Barat, Indonesia, 40187 ', '123', ''),
('P00121', '13233', 'CAHYA NURDIN', 'Staf', 'l', 'bandung', '122', '');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_request` varchar(25) NOT NULL,
  `id_kategori` varchar(4) NOT NULL,
  `id_klasifikasi` varchar(3) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `lokasi` varchar(250) NOT NULL,
  `request` varchar(200) NOT NULL,
  `deskripsi_request` text NOT NULL,
  `tanggal_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dropby_idadmin` varchar(7) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baca_eksekutor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL,
  `sts_baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `estimasi` varchar(30) NOT NULL,
  `photo` varchar(35) NOT NULL,
  `flag_fwd` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE IF NOT EXISTS `perbaikan` (
  `id_request` varchar(25) NOT NULL,
  `id_klasifikasi` varchar(3) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `kode_lokasi` varchar(6) NOT NULL,
  `request` varchar(200) NOT NULL,
  `deskripsi_request` text NOT NULL,
  `tanggal_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dropby_idadmin` varchar(7) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baca_eksekutor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL,
  `sts_baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `estimasi` varchar(30) NOT NULL,
  `photo` varchar(35) NOT NULL,
  `flag_fwd` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perbaikan`
--

INSERT INTO `perbaikan` (`id_request`, `id_klasifikasi`, `idpengguna`, `ideksekutor`, `kode_lokasi`, `request`, `deskripsi_request`, `tanggal_request`, `dropby_idadmin`, `baca_admin`, `baca_eksekutor`, `sts_baca_admin`, `sts_baca_eksekutor`, `sts_eksekusi`, `estimasi`, `photo`, `flag_fwd`) VALUES
('20180521053709', 'K01', 'P00001', 'E00002', 'L00047', 'Komputer Rusak', 'Deskripsi Komputer Rusak', '2018-05-21 05:37:09', 'A00001', '2018-05-21 05:37:47', '2018-05-21 05:40:39', 1, 1, 1, '05/21/2018 - 05/22/2018', '20180521053709.jpg', 1),
('20180521113021', 'K02', 'P00006', 'E00002', 'L00046', 'atap', 'genteng bocor', '2018-05-21 11:30:21', 'A00001', '2018-05-21 11:32:53', '2018-05-21 02:07:53', 1, 1, 1, '05/22/2018 - 05/24/2018', '20180521113021.jpg', 1),
('20180522105522', 'K01', 'P00006', 'E00011', 'L00042', 'pompa rusak', 'air kosong karena pompa tidak jalan', '2018-05-22 10:55:22', 'A00001', '2018-05-22 10:56:01', '2018-09-20 10:18:39', 1, 1, 2, '05/22/2018 - 05/26/2018', '', 1),
('20180821104937', 'K01', 'P00001', 'E00012', 'L00047', 'Pintu Rusak', 'Segera Perbaiki', '2018-08-21 10:49:37', 'A00002', '2018-08-21 01:59:04', '2018-08-21 02:22:40', 1, 1, 0, '08/21/2018 - 08/23/2018', '20180821104937.jpg', 1),
('20180904113252', 'K02', 'P00007', 'E00009', 'L00049', 'komputer tdk bisa koneksi internet', 'koneksi internet putus', '2018-09-04 11:32:52', 'A00001', '2018-09-04 11:40:50', '2018-09-04 11:46:09', 1, 1, 2, '09/04/2018 - 09/04/2018', '', 1),
('20180919110455', 'K01', 'P00010', 'E00011', 'L00049', 'Penarikan Jaluar air bersih', 'Klinik\nPemasangan wastafel\nJalur buangan', '2018-09-19 11:04:55', 'A00001', '2018-09-19 11:07:06', '2018-10-18 03:08:42', 1, 1, 2, '19/09/2018', '', 1),
('20180920090125', 'K02', 'P00018', 'E00009', 'L00049', 'Permintaan air untuk di ruang klinik', 'dibutuhkan air bersih di klinik', '2018-09-20 09:01:25', 'A00001', '2018-09-20 09:01:39', '2018-09-20 09:25:40', 1, 1, 1, '09/20/2018 - 09/21/2018', '', 1),
('20180920091741', 'K03', 'P00018', 'E00011', 'L00049', 'Dibutuhkan air bersih di Klinik', 'dibutuhkan air bersih di klinik', '2018-09-20 09:17:41', 'A00001', '2018-09-20 09:19:13', '2019-05-10 20:02:37', 1, 1, 2, '09/20/2018 - 09/21/2018', '', 1),
('20180926172333', 'K02', 'P00019', 'E00012', 'L00045', 'Perbaikan kerusakan penutup penampungan air', 'Kondisi penutup penampungan air yang terbuat dari besi sudah sangat keropos, sehingga dikhawatirkan menimbulkan risiko terhadap keselamatan penghuni maupun tamu/pegawai', '2018-09-26 17:23:33', 'A00001', '2018-09-26 05:23:56', '0000-00-00 00:00:00', 1, 0, 0, '09/27/2018 - 10/01/2018', '', 1),
('20180928093333', 'K02', 'P00019', 'E00015', 'L00045', 'Kerusakan Penutup Penampung Air', 'Kondisi penutup penampung air yang terbuka dari besi sudah sangat keropos sehingga dikhawatirkan menimbulkan resiko terhadap keselamatan penghuni maupun tamu/pegawai', '2018-09-28 09:33:33', 'A00001', '2018-09-28 09:34:32', '2018-12-18 08:21:19', 1, 1, 2, '09/28/2018 - 10/03/2018', '', 1),
('20181018114714', 'K02', 'P00006', 'E00010', 'L00049', 'Pemasangan wastafel di klinik', 'Butuh wastafel untuk mencuci tangan', '2018-10-18 11:47:14', 'A00001', '2018-10-18 12:12:33', '2018-10-18 03:15:18', 1, 1, 2, '10/19/2018 - 10/20/2018', '', 1),
('20181018143155', 'K01', 'P00006', 'E00006', 'L00049', 'Toilet lt 1 kontor dan tisu kosong', 'lantai kotor dan tisu rol kosong', '2018-10-18 14:31:55', 'A00001', '2018-10-18 02:35:12', '2018-10-18 03:09:41', 1, 1, 2, '10/18/2018 - 10/18/2018', '', 1),
('20181018143903', 'K03', 'P00006', 'E00011', 'L00049', 'Kran di taman bocor', 'Kran di taman dekat air mancur bocor', '2018-10-18 14:39:03', 'A00001', '2018-10-18 03:19:31', '2019-05-10 19:58:40', 1, 1, 2, '10/18/2018 - 10/18/2018', '20181018143903.jpg', 1),
('20181018144255', 'K02', 'P00006', 'E00014', 'L00049', 'Tanaman di pot meja depan lift lantai 3 layu', 'bunga anggrek layu', '2018-10-18 14:42:55', 'A00001', '2018-10-18 03:18:18', '2018-10-19 08:05:10', 1, 1, 2, '10/18/2018 - 10/19/2018', '20181018144255.jpg', 1),
('20181018144510', 'K02', 'P00006', 'E00010', 'L00049', 'Lampu di bale pasundan mati', 'lampu di sisi kanan panggung mati', '2018-10-18 14:45:10', 'A00001', '2018-10-18 02:46:14', '2018-10-18 03:05:17', 1, 1, 2, '10/19/2018 - 10/19/2018', '20181018144510.jpg', 1),
('20181213083738', 'K01', 'P00001', 'E00016', 'L00034', 'Contoh Perbaikan', 'Perbaiki yang benar', '2018-12-13 08:37:38', 'A00002', '2018-12-13 08:38:11', '2018-12-14 03:05:11', 1, 1, 1, '12/13/2018 - 12/14/2018', '', 1),
('20190212201755', 'K02', 'P00121', 'E00010', 'L00049', 'komputer rusak mati', 'Laptop mati', '2019-02-12 20:17:55', 'A00001', '2019-02-12 08:18:26', '2019-02-12 08:20:22', 1, 1, 2, '02/12/2019 - 02/15/2019', '', 1),
('20190328152418', 'K03', 'P00003', 'E00015', 'L00049', 'Genteng Rusak', 'segera perbaiki', '2019-03-28 15:24:18', 'A00001', '2019-03-28 03:31:07', '2019-03-28 04:07:54', 1, 1, 2, '03/29/2019 - 03/30/2019', '20190328152418.jpg', 1),
('20190404165205', 'K01', 'P00006', 'E00014', 'L00049', 'Kerusakan photo beam', 'kerusakan pada sensor ', '2019-04-04 16:52:05', 'A00001', '2019-05-10 19:54:30', '0000-00-00 00:00:00', 1, 0, 0, '05/12/2019 - 05/17/2019', '20190404165205.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `progres`
--

CREATE TABLE IF NOT EXISTS `progres` (
`id` int(11) NOT NULL,
  `waktu_eksekusi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_request` varchar(25) NOT NULL,
  `id_eksekutor` varchar(6) NOT NULL,
  `foto_lokasi` varchar(35) NOT NULL,
  `foto_progres` varchar(35) NOT NULL,
  `progres` varchar(250) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `biaya` int(20) NOT NULL,
  `id_admin` varchar(6) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `baca_admin` int(1) NOT NULL,
  `baca_pegawai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progres_perbaikan`
--

CREATE TABLE IF NOT EXISTS `progres_perbaikan` (
`id` int(11) NOT NULL,
  `waktu_eksekusi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_request` varchar(25) NOT NULL,
  `id_eksekutor` varchar(6) NOT NULL,
  `foto_lokasi` varchar(35) NOT NULL,
  `foto_progres` varchar(35) NOT NULL,
  `progres` varchar(250) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `biaya` int(20) NOT NULL,
  `id_admin` varchar(6) NOT NULL,
  `id_pegawai` varchar(6) NOT NULL,
  `baca_admin` int(1) NOT NULL,
  `baca_pegawai` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progres_perbaikan`
--

INSERT INTO `progres_perbaikan` (`id`, `waktu_eksekusi`, `id_request`, `id_eksekutor`, `foto_lokasi`, `foto_progres`, `progres`, `sts_eksekusi`, `biaya`, `id_admin`, `id_pegawai`, `baca_admin`, `baca_pegawai`) VALUES
(4, '2018-05-20 22:41:25', '20180521053709', 'E00002', 'l1526856039.jpg', 'p1526856039.jpg', 'Progress Pekerjaan 1', 1, 0, 'A00001', 'P00001', 0, 1),
(5, '2018-05-21 07:10:11', '20180521113021', 'E00002', 'l1526877801.jpg', 'p1526877801.jpg', 'pembelian barang', 1, 0, 'A00001', 'P00006', 1, 1),
(6, '2018-09-14 10:40:49', '20180904113252', 'E00009', '', '', 'wifi belum di aktifkan', 2, 0, 'A00001', 'P00007', 1, 0),
(8, '2018-09-20 02:25:23', '20180920090125', 'E00009', '', '', 'pembelian material', 1, 150000, 'A00001', 'P00018', 0, 0),
(10, '2018-09-20 03:01:28', '20180919110455', 'E00011', '', '', 'sudah dilakukan pemasangan wastafel dan jalur pipa buang (air kotor)', 2, 2500000, 'A00001', 'P00010', 0, 0),
(11, '2018-09-20 03:02:41', '20180522105522', 'E00011', '', '', '1. Kebutuhan Air bersih disuply dari Mobil Tanki dari PBF Bikasoga', 2, 0, 'A00001', 'P00006', 0, 0),
(12, '2018-10-01 06:24:26', '20180928093333', 'E00015', '', '', 'Dalam proses pengerjaan perbaikan', 1, 0, 'A00001', 'P00019', 0, 0),
(13, '2018-10-04 02:29:11', '20180928093333', 'E00015', '', 'p1538620151.jpg', 'Pekerjaan perbaikan penutup graundtank dan alas torn sudah selesai di kerjakan', 2, 0, 'A00001', 'P00019', 0, 0),
(14, '2019-05-11 07:59:32', '20181018114714', 'E00010', '', '', 'tahap pembelian material', 1, 0, 'A00001', 'P00006', 1, 0),
(15, '2019-05-11 07:59:32', '20181018114714', 'E00010', '', '', 'barang sudah datang tinggal pemasangan', 1, 300000, 'A00001', 'P00006', 1, 0),
(16, '2018-10-18 07:44:59', '20181018143155', 'E00006', '', '', 'Proses pengantian Tisue', 2, 0, 'A00001', 'P00006', 1, 0),
(17, '2018-10-18 08:22:24', '20181018144510', 'E00010', '', 'p1539848911.jpg', 'sudah selesai', 2, 0, 'A00001', 'P00006', 1, 1),
(18, '2019-05-11 07:59:32', '20181018114714', 'E00010', 'l1539849032.png', 'p1539849032.png', 'contoh progress', 2, 0, 'A00001', 'P00006', 1, 0),
(19, '2018-10-18 08:20:29', '20181018144255', 'E00014', '', 'p1539850829.jpg', 'Proses pengadaan tanaman hias anggrek sedang dilaksanakan', 1, 0, 'A00001', 'P00006', 0, 0),
(20, '2018-10-18 08:21:58', '20181018144255', 'E00014', '', 'p1539850918.jpg', 'Proses pengadaan tanaman hias anggrek sedang dilaksanakan', 1, 0, 'A00001', 'P00006', 0, 0),
(21, '2018-10-18 08:29:10', '20181018143903', 'E00011', 'l1539851299.jpg', 'p1539851305.jpg', 'sedang dilakukan penggalian tanah untuk mencari kebocoran pipa yang pecah', 1, 0, 'A00001', 'P00006', 1, 0),
(22, '2018-10-19 01:05:10', '20181018144255', 'E00014', '', 'p1539911108.jpg', 'Proses pengadaan tanaman hias anggrek sedang dilaksanakan', 2, 120000, 'A00001', 'P00006', 0, 0),
(23, '2018-12-14 07:39:52', '20181213083738', 'E00016', '', '', 'contoh progress', 2, 30000, 'A00002', 'P00001', 0, 1),
(24, '2018-12-14 08:24:06', '20181213083738', 'E00016', '', '', 'Proggress Hari ini', 1, 40000, 'A00002', 'P00001', 0, 1),
(25, '2019-02-12 13:21:01', '20190212201755', 'E00010', '', '', 'sudah bisa digunkan, kerusakan pada adaptor', 2, 150000, 'A00001', 'P00121', 0, 1),
(26, '2019-03-28 09:08:39', '20190328152418', 'E00015', '', 'p1553764070.jpg', 'sudah selesai', 2, 1000000, 'A00001', 'P00003', 0, 1),
(27, '2019-05-11 07:58:17', '20181018143903', 'E00011', '', '', 'beli kunci', 1, 0, 'A00001', 'P00006', 0, 0),
(28, '2019-05-11 07:58:40', '20181018143903', 'E00011', '', '', 'selesai', 2, 100000, 'A00001', 'P00006', 0, 0),
(29, '2019-05-11 08:03:10', '20180920091741', 'E00011', '', '', 'selesai', 2, 100000, 'A00001', 'P00018', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id_request` varchar(25) NOT NULL,
  `id_kategori` varchar(4) NOT NULL,
  `id_klasifikasi` varchar(3) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `lokasi` varchar(250) NOT NULL,
  `request` varchar(200) NOT NULL,
  `deskripsi_request` text NOT NULL,
  `tanggal_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dropby_idadmin` varchar(7) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baca_eksekutor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL,
  `sts_baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `estimasi` varchar(30) NOT NULL,
  `photo` varchar(35) NOT NULL,
  `flag_fwd` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_barang`
--

CREATE TABLE IF NOT EXISTS `request_barang` (
`id` int(11) NOT NULL,
  `id_request` varchar(25) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `qty` int(5) NOT NULL,
  `tanggal_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `verifikasi` int(1) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_barang`
--

INSERT INTO `request_barang` (`id`, `id_request`, `idpengguna`, `kode_barang`, `qty`, `tanggal_request`, `tanggal_peminjaman`, `tanggal_pengembalian`, `verifikasi`, `keterangan`, `baca_admin`, `sts_baca_admin`) VALUES
(13, '20190404170154', 'P00006', 'B00024', 1, '2019-04-04 17:01:54', '0000-00-00', '0000-00-00', 0, '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_peminjaman`
--

CREATE TABLE IF NOT EXISTS `request_peminjaman` (
`id` int(11) NOT NULL,
  `id_request` varchar(25) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `kode_ruangan` varchar(6) NOT NULL,
  `nama_kegiatan` varchar(200) NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `jam_mulai` varchar(10) NOT NULL,
  `jam_selesai` varchar(10) NOT NULL,
  `dropby_idadmin` varchar(7) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baca_eksekutor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL,
  `sts_baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `flag_fwd` int(1) NOT NULL,
  `status_pakai_ruangan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_ruangan`
--

CREATE TABLE IF NOT EXISTS `request_ruangan` (
`id` int(11) NOT NULL,
  `id_request` varchar(25) NOT NULL,
  `idpengguna` varchar(6) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `kode_ruangan` varchar(6) NOT NULL,
  `nama_kegiatan` varchar(200) NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jam_mulai` varchar(10) NOT NULL,
  `jam_selesai` varchar(10) NOT NULL,
  `dropby_idadmin` varchar(7) NOT NULL,
  `baca_admin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `baca_eksekutor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sts_baca_admin` int(1) NOT NULL,
  `sts_baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `flag_fwd` int(1) NOT NULL,
  `status_pakai_ruangan` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_ruangan`
--

INSERT INTO `request_ruangan` (`id`, `id_request`, `idpengguna`, `ideksekutor`, `kode_ruangan`, `nama_kegiatan`, `deskripsi_kegiatan`, `tanggal_kegiatan`, `tanggal_selesai`, `jam_mulai`, `jam_selesai`, `dropby_idadmin`, `baca_admin`, `baca_eksekutor`, `sts_baca_admin`, `sts_baca_eksekutor`, `sts_eksekusi`, `flag_fwd`, `status_pakai_ruangan`) VALUES
(31, '20190212202717', 'P00121', '', 'R00015', 'Rapat Kas', 'Proyektor', '2019-02-14', '2019-02-14', '08:15 AM', '11:15 AM', '', '2019-02-12 08:27:54', '0000-00-00 00:00:00', 1, 0, 0, 1, 0),
(32, '20190328155924', 'P00003', '', 'R00019', 'Rapat', 'Rapat panitia', '2019-03-29', '2019-03-30', '08:45 AM', '12:45 AM', '', '2019-05-05 02:37:48', '0000-00-00 00:00:00', 1, 0, 0, 0, 0),
(33, '20190404170034', 'P00006', '', 'R00002', 'Rapat Koordinasi', '1.  layout theater\n2. mini garden', '0000-00-00', '0000-00-00', '10:00 AM', '12:45 PM', '', '2019-05-10 19:29:56', '0000-00-00 00:00:00', 1, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_ruangan_forward`
--

CREATE TABLE IF NOT EXISTS `request_ruangan_forward` (
`id` int(11) NOT NULL,
  `id_request` varchar(25) NOT NULL,
  `ideksekutor` varchar(6) NOT NULL,
  `baca_eksekutor` int(1) NOT NULL,
  `sts_eksekusi` int(1) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_ruangan_forward`
--

INSERT INTO `request_ruangan_forward` (`id`, `id_request`, `ideksekutor`, `baca_eksekutor`, `sts_eksekusi`, `foto`) VALUES
(25, '20180521054248', 'E00001', 1, 1, 'RF1526856370.jpg'),
(26, '20180521054248', 'E00002', 1, 1, 'RF1526856324.jpg'),
(27, '20180521054248', 'E00004', 1, 1, 'RF1526856458.jpg'),
(28, '20180521054248', 'E00005', 1, 2, ''),
(29, '20180607213407', 'E00001', 0, 0, ''),
(30, '20180607213407', 'E00002', 1, 1, 'RF1535078898.png'),
(31, '20180607213407', 'E00004', 0, 0, ''),
(32, '20180607213407', 'E00005', 0, 0, ''),
(33, '20180607213407', 'E00006', 1, 0, ''),
(34, '20180607213407', 'E00016', 1, 1, ''),
(35, '20180607213407', 'E00008', 1, 2, ''),
(36, '20180607213407', 'E00009', 0, 0, ''),
(37, '20180607213407', 'E00010', 1, 0, ''),
(38, '20180607213407', 'E00011', 0, 0, ''),
(39, '20180607213407', 'E00012', 0, 0, ''),
(40, '20180904115320', 'E00001', 0, 0, ''),
(41, '20180904115320', 'E00002', 0, 0, ''),
(42, '20180904115320', 'E00004', 0, 0, ''),
(43, '20180904115320', 'E00005', 0, 0, ''),
(44, '20180904115320', 'E00006', 0, 0, ''),
(45, '20180904115320', 'E00007', 0, 0, ''),
(46, '20180904115320', 'E00008', 0, 0, ''),
(47, '20180904115320', 'E00009', 1, 1, ''),
(48, '20180904115320', 'E00010', 0, 0, ''),
(49, '20180904115320', 'E00011', 0, 0, ''),
(50, '20180904115320', 'E00012', 0, 0, ''),
(51, '20180920094325', 'E00001', 0, 0, ''),
(52, '20180920094325', 'E00002', 0, 0, ''),
(53, '20180920094325', 'E00005', 0, 0, ''),
(54, '20180920094325', 'E00006', 1, 1, ''),
(55, '20180920094325', 'E00007', 0, 0, ''),
(56, '20180920094325', 'E00008', 0, 0, ''),
(57, '20180920094325', 'E00009', 1, 0, ''),
(58, '20180920094325', 'E00010', 1, 1, ''),
(59, '20180920094325', 'E00011', 0, 0, ''),
(60, '20180920094325', 'E00012', 0, 0, ''),
(61, '20180920094325', 'E00013', 0, 0, ''),
(62, '20180920094325', 'E00014', 1, 1, ''),
(63, '20180920094325', 'E00015', 1, 1, ''),
(64, '20181018150725', 'E00006', 1, 1, 'RF1539851147.jpg'),
(65, '20181018150725', 'E00010', 1, 1, ''),
(66, '20181018150725', 'E00011', 1, 0, ''),
(67, '20181018150725', 'E00014', 1, 1, ''),
(68, '20181018150725', 'E00015', 1, 1, ''),
(69, '20181018150725', 'E00016', 1, 2, ''),
(70, '20181018145611', 'E00006', 0, 0, ''),
(71, '20181018145611', 'E00010', 0, 0, ''),
(72, '20181018145611', 'E00011', 0, 0, ''),
(73, '20181018145611', 'E00014', 0, 0, ''),
(74, '20181018145611', 'E00015', 0, 0, ''),
(75, '20181018145611', 'E00016', 0, 0, ''),
(76, '20190212202717', 'E00006', 0, 0, ''),
(77, '20190212202717', 'E00010', 1, 1, ''),
(78, '20190212202717', 'E00011', 1, 0, ''),
(79, '20190212202717', 'E00014', 0, 0, ''),
(80, '20190212202717', 'E00015', 0, 0, ''),
(81, '20190212202717', 'E00016', 0, 0, ''),
(82, '20190404170034', 'E00006', 0, 0, ''),
(83, '20190404170034', 'E00010', 0, 0, ''),
(84, '20190404170034', 'E00011', 0, 0, ''),
(85, '20190404170034', 'E00014', 0, 0, ''),
(86, '20190404170034', 'E00015', 0, 0, ''),
(87, '20190404170034', 'E00016', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `kode_ruangan` varchar(6) NOT NULL,
  `nama_ruangan` varchar(150) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`kode_ruangan`, `nama_ruangan`, `keterangan`) VALUES
('R00001', 'Bale Pasundan', 'Lantai 2, Kapasitas 500'),
('R00002', 'Bale Parahyangan', 'Lantai 2, Kapasitas 100'),
('R00003', 'Bale Pangandaran', 'Lantai 2, Kapasitas 50'),
('R00004', 'Bale Papandayan', 'Lantai 2, Kapasitas 20'),
('R00005', 'Bale Pasindangan', 'Lantai 2, Kapasitas 10'),
('R00006', 'Ruang Cimalaka', 'Lantai 3, kapasitas 20'),
('R00007', 'Ruang Cendana', 'Lantai 3, Kapasitas 20'),
('R00008', 'Ruang West Java Corp', 'Lantai 3, Kapasitas 20'),
('R00009', 'Ruang Manggala', 'Lantai 4, Kapasitas 20'),
('R00010', 'Ruang Malabar', 'Lantai 4, Kapasitas 20'),
('R00011', 'Bale Panyawangan', 'Lantai 5, Kapasitas 40'),
('R00012', 'Bale Pasamoan', 'Lantai 5, Kapasitas 100'),
('R00013', 'Bale Pajajaran', 'Lantai 5, Kapasitas 85'),
('R00014', 'Ruang Rapat Kecil PBI', 'Lantai 5, Kapasitas 5'),
('R00015', 'Ruang Kencana', 'Lantai 1, Kapasitas 15'),
('R00016', 'Ruang Humas', 'Lantai 1, Kapasitas 15'),
('R00017', 'Ruang Serbaguna Perpustakaan', 'Lantai 1, Kapasitas 50'),
('R00018', 'Ruang Rapat Perpustakaan', 'Lantai 1, Kapasitas 10'),
('R00019', 'Ruang Memorabilia', 'Gedung Lama, Kapasitas 50');

-- --------------------------------------------------------

--
-- Table structure for table `sts_eksekusi`
--

CREATE TABLE IF NOT EXISTS `sts_eksekusi` (
  `sts_eksekusi` int(1) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sts_eksekusi`
--

INSERT INTO `sts_eksekusi` (`sts_eksekusi`, `keterangan`) VALUES
(0, 'Waiting List'),
(1, 'Sedang Ditangani'),
(2, 'Selesai Dikerjakan'),
(3, 'Batal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `eksekutor`
--
ALTER TABLE `eksekutor`
 ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`idfeedback`);

--
-- Indexes for table `kategori_request`
--
ALTER TABLE `kategori_request`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `klasifikasi_request`
--
ALTER TABLE `klasifikasi_request`
 ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
 ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `perbaikan`
--
ALTER TABLE `perbaikan`
 ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `progres`
--
ALTER TABLE `progres`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progres_perbaikan`
--
ALTER TABLE `progres_perbaikan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
 ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `request_barang`
--
ALTER TABLE `request_barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_peminjaman`
--
ALTER TABLE `request_peminjaman`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_ruangan`
--
ALTER TABLE `request_ruangan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_ruangan_forward`
--
ALTER TABLE `request_ruangan_forward`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
 ADD PRIMARY KEY (`kode_ruangan`);

--
-- Indexes for table `sts_eksekusi`
--
ALTER TABLE `sts_eksekusi`
 ADD PRIMARY KEY (`sts_eksekusi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `progres`
--
ALTER TABLE `progres`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `progres_perbaikan`
--
ALTER TABLE `progres_perbaikan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `request_barang`
--
ALTER TABLE `request_barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `request_peminjaman`
--
ALTER TABLE `request_peminjaman`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_ruangan`
--
ALTER TABLE `request_ruangan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `request_ruangan_forward`
--
ALTER TABLE `request_ruangan_forward`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
