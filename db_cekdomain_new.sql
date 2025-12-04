/*
 Navicat Premium Data Transfer

 Source Server         : Localhost Rohmad
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_cekdomain_new

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 20/02/2025 10:29:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_domain
-- ----------------------------
DROP TABLE IF EXISTS `tb_domain`;
CREATE TABLE `tb_domain`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_opd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('OPD','Kapanewon','Puskeswan','Puskesmas','BPP','IKM','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 277 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_domain
-- ----------------------------
INSERT INTO `tb_domain` VALUES (24, 'Dinas Perhubungan', 'https://dishub.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (25, 'Badan Penanggulangan Bencana Daerah', 'https://bpbd.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (26, 'Dinas Kelautan dan Perikanan', 'https://dkp.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (27, 'Inspektorat', 'https://inspektorat.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (28, 'Kundha Kabudayan', 'https://kebudayaan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (29, 'Badan Kesatuan Bangsa dan Politik', 'https://kesbangpol.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (30, 'Dinas Kominfo', 'https://kominfo.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (31, 'Dinas Perindustrian Koperasi Usaha Kecil dan Menengah dan Tenaga Kerja', 'https://perindustrian.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (32, 'Dinas Perdagangan', 'https://perdagangan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (33, 'Dinas Lingkungan Hidup', 'https://lh.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (34, 'Dinas Pemberdayaan Masyarakat Dan Kalurahan Pengendalian Penduduk Dan Keluarga Berencana', 'https://pemberdayaan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (35, 'Dinas Pertanian dan Pangan', 'https://pertanian.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (36, 'Dinas Pekerjaan Umum, Perumahan Rakyat dan Kawasan Pemukiman', 'https://puprkp.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (37, 'Satuan Polisi Pamong Praja', 'https://satpolpp.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (38, 'Sekretariat Daerah', 'https://setda.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (39, 'Dinas Sosial Pemberdayaan Perempuan Dan Perlindungan Anak', 'https://sosial.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (40, 'Kundha Niti Mandala sarta Tata Sasana', 'https://tataruang.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (41, 'Sekretariat DPRD', 'https://setwan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (42, 'Dinas Penanaman Modal dan Pelayanan Terpadu', 'https://dpmpt.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (43, 'Dinas Pendidikan', 'https://pendidikan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (44, 'Dinas Peternakan Dan Kesehatan Hewan', 'https://peternakan.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (45, 'Dinas Kepemudaan Dan Olahraga', 'https://dispora.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (46, 'Dinas Kesehatan', 'https://dinkes.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (47, 'Dinas Kependudukan dan Pencatatan Sipil', 'https://dukcapil.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (48, 'Badan Keuangan dan Aset Daerah', 'https://bkad.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (49, 'Badan Perencanaan Pembangunan Daerah', 'https://bappeda.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (50, 'Dinas Pariwisata', 'https://wisata.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (51, 'Dinas Perpustakaan dan Kearsipan', 'https://dpk.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (52, 'Badan Kepegawaian, Pendidikan dan Pelatihan Daerah', 'https://bkppd.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (53, 'Rumah Sakit Umum Daerah Wonosari', 'https://rsudwonosari.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (54, 'Rumah Sakit Umum Daerah Saptosari', 'https://rsudsaptosari.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (55, 'Pejabat Pengelola Informasi dan Dokumentasi', 'https://ppid.gunungkidulkab.go.id', 'OPD');
INSERT INTO `tb_domain` VALUES (57, 'Kapanewon Gedangsari', 'https://gedangsari.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (58, 'Kapanewon Girisubo', 'https://girisubo.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (59, 'Kapanewon Karangmojo', 'https://karangmojo.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (60, 'Kapanewon Ngawen', 'https://ngawen.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (61, 'Kapanewon Nglipar', 'https://nglipar.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (62, 'Kapanewon Paliyan', 'https://paliyan.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (63, 'Kapanewon Panggang', 'https://panggang.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (64, 'Kapanewon Patuk', 'https://patuk.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (65, 'Kapanewon Playen', 'https://playen.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (66, 'Kapanewon Ponjong', 'https://ponjong.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (67, 'Kapanewon Purwosari', 'https://purwosari.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (68, 'Kapanewon Rongkop', 'https://rongkop.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (69, 'Kapanewon Saptosari', 'https://saptosari.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (70, 'Kapanewon Semanu', 'https://semanu.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (71, 'Kapanewon Semin', 'https://semin.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (72, 'Kapanewon Tanjungsari', 'https://tanjungsari.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (73, 'Kapanewon Tepus', 'https://tepus.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (74, 'Kapanewon Wonosari', 'https://wonosari.gunungkidulkab.go.id', 'Kapanewon');
INSERT INTO `tb_domain` VALUES (75, 'Puskesmas Gedangsari 1', 'https://gedangsari1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (76, 'Puskesmas Gedangsari 2', 'https://gedangsari2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (77, 'Puskesmas Girisubo', 'https://girisubo1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (78, 'Puskesmas Karangmojo 1', 'https://karangmojo1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (79, 'Puskesmas Karangmojo 2', 'https://karangmojo2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (80, 'Puskesmas Ngawen 1', 'https://ngawen1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (81, 'Puskesmas Ngawen 2', 'https://ngawen2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (82, 'Puskesmas Nglipar 1', 'https://nglipar1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (83, 'Puskesmas Nglipar 2', 'https://nglipar2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (84, 'Puskesmas Paliyan', 'https://paliyan1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (85, 'Puskesmas Panggang 1', 'https://panggang1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (86, 'Puskesmas Panggang 2', 'https://panggang2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (87, 'Puskesmas Patuk 1', 'https://patuk1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (88, 'Puskesmas Patuk 2', 'https://patuk2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (89, 'Puskesmas Playen 1', 'https://playen1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (90, 'Puskesmas Playen 2', 'https://playen2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (91, 'Puskesmas Ponjong 1', 'https://ponjong1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (92, 'Puskesmas Ponjong 2', 'https://ponjong2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (93, 'Puskesmas Purwosari', 'https://purwosari1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (94, 'Puskesmas Rongkop', 'https://rongkop1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (95, 'Puskesmas Saptosari', 'https://saptosari1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (96, 'Puskesmas Semanu 1', 'https://semanu1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (97, 'Puskesmas Semanu 2', 'https://semanu2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (98, 'Puskesmas Semin 1', 'https://semin1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (99, 'Puskesmas Semin 2', 'https://semin2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (100, 'Puskesmas Tanjungsari', 'https://tanjungsari1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (101, 'Puskesmas Tepus 1', 'https://tepus1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (102, 'Puskesmas Tepus 2', 'https://tepus2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (103, 'Puskesmas Wonosari 1', 'https://wonosari1.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (104, 'Puskesmas Wonosari 2', 'https://wonosari2.puskesmas.gunungkidulkab.go.id', 'Puskesmas');
INSERT INTO `tb_domain` VALUES (105, 'UPT PUSKESWAN WONOSARI', 'https://wonosari.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (106, 'POS KESWAN PATUK', 'https://patuk.poskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (107, 'UPT PUSKESWAN PLAYEN', 'https://playen.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (108, 'UPT PUSKESWAN SEMANU', 'https://semanu.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (109, 'UPT PUSKESWAN NGLIPAR', 'https://nglipar.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (110, 'POS KESWAN SEMIN', 'https://semin.poskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (111, 'UPT PUSKESWAN KARANGMOJO', 'https://karangmojo.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (112, 'POS KESWAN RONGKOP', 'https://rongkop.poskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (113, 'POS KESWAN TEPUS', 'https://tepus.poskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (114, 'POS KESWAN SAPTOSARI', 'https://saptosari.poskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (115, 'UPT PUSKESWAN PANGGANG', 'https://panggang.puskeswan.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (116, 'UPT Lab. PUSKESWAN', 'https://labkeswan.pertanian.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (117, 'UPT BALAI BENIH PERTANIAN', 'https://balaibenih.pertanian.gunungkidulkab.go.id', 'Puskeswan');
INSERT INTO `tb_domain` VALUES (118, 'BPP WONOSARI', 'https://wonosari.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (119, 'BPP SEMANU', 'https://semanu.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (120, 'BPP KARANGMOJO', 'https://karangmojo.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (121, 'BPP NGLIPAR', 'https://nglipar.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (122, 'BPP NGAWEN', 'https://ngawen.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (123, 'BPP SEMIN', 'https://semin.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (124, 'BPP PATUK', 'https://patuk.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (125, 'BPP RONGKOP', 'https://rongkop.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (126, 'BPP GIRISUBO', 'https://girisubo.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (127, 'BPP TEPUS', 'https://tepus.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (128, 'BPP SAPTOSARI', 'https://saptosari.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (129, 'BPP GEDANGSARI', 'https://gedangsari.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (130, 'BPP PALIYAN', 'https://paliyan.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (131, 'BPP PLAYEN', 'https://playen.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (132, 'BPP TANJUNGSARI', 'https://tanjungsari.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (133, 'BPP PURWOSARI', 'https://purwosari.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (134, 'BPP PONJONG', 'https://ponjong.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (135, 'BPP PANGGANG', 'https://panggang.bpp.gunungkidulkab.go.id', 'BPP');
INSERT INTO `tb_domain` VALUES (136, 'Kerajinan Kayu Bobung', 'https://ksrbobung.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (137, 'Kerajinan Kayu Batur', 'https://kerajinankayubatur.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (138, 'Kerajinan Bambu Mandesan', 'https://kerajinanbambumandesan.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (139, 'Akar Wangi Semin', 'https://akarwangisemin.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (140, 'Batu Ornamen Sidorejo', 'https://batuornamensidorejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (141, 'Batu Ornamen Candirejo', 'https://batuornamencandirejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (142, 'Gula Kelapa Sawah Lor', 'https://gulakelapasawahlor.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (143, 'Gula Kelapa Klepu', 'https://gulakelapaklepu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (144, 'Gula Kelapa Pilangrejo', 'https://gulakelapapilangrejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (145, 'Gula Kelapa Gedad', 'https://gulakelapagedad.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (146, 'Rambak Kulit Sodo', 'https://rambakkulitsodo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (147, 'Tahu Sumbermulyo', 'https://tahusumbermulyo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (148, 'Pathilo Banjarejo', 'https://pathilobanjarejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (149, 'Batik Tancep', 'https://batiktancep.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (150, 'Tas Bejiharjo', 'https://tasbejiharjo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (151, 'Tas Sumberwungu', 'https://tassumberwungu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (152, 'Blangkon Bejiharjo', 'https://blangkonbejiharjo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (153, 'Batik Sumberan', 'https://batiksumberan.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (154, 'Batik Tegalrejo', 'https://batiktegalrejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (155, 'Pande Besi Kajar Dua', 'https://pandebesikajardua.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (156, 'Pande Besi Kedung', 'https://pandebesikedung.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (157, 'Perak Pampang', 'https://perakpampang.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (158, 'Perak Tepus', 'https://peraktepus.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (159, 'Perak Sodo', 'https://peraksodo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (160, 'Tembaga Sodo', 'https://tembagasodo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (161, 'Wuwung Seng Sambirejo', 'https://wuwungsengsambirejo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (162, 'Genteng Sambeng', 'https://gentengsambeng.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (163, 'Asta Aulia', 'https://astaaulia.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (164, 'Bayu Batik', 'https://bayubatik.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (165, 'Kerajinan Kayu Gumawang', 'https://kerajinankayugumawang.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (166, 'Sekar Arum', 'https://sekararum.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (167, 'Cendana', 'https://cendana.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (168, 'Batik Nurgini', 'https://batiknurgini.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (169, 'Aleyya Batik', 'https://aleyyabatik.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (170, 'Surya Silver', 'https://suryasilver.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (171, 'Rizquna', 'https://rizquna.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (172, 'Lestari Karya Silver', 'https://lestarikaryasilver.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (173, 'Selo Mandiri', 'https://selomandiri.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (174, 'Alam Jaya', 'https://alamjaya.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (175, 'Batu Sidodadi', 'https://batusidodadi.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (176, 'Cahaya Alam', 'https://cahayaalam.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (177, 'Karya Besi', 'https://karyabesi.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (178, 'Lampu Barokah', 'https://lampubarokah.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (179, 'Tembaga Estu', 'https://tembagaestu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (180, 'Tenun Wening', 'https://tenunwening.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (181, 'Sido Dadi Blangkon', 'https://sidodadiblangkon.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (182, 'Chentaly', 'https://chentaly.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (183, 'Abbiyu', 'https://abbiyu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (184, 'Sonomulyo', 'https://sonomulyo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (185, 'Jepara Mebel', 'https://jeparamebel.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (186, 'Ikan Tuna Buhirto', 'https://ikantunabuhirto.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (187, 'Bakpia 250', 'https://bakpia250.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (188, 'Suwarni', 'https://suwarni.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (189, 'Yutum', 'https://yutum.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (190, 'Purbarasa', 'https://purbarasa.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (191, 'Kub Guyub Rukun', 'https://kubguyubrukun.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (192, 'Murni', 'https://murni.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (193, 'Emping Jagung Puri Genuk', 'https://empingjagungpurigenuk.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (194, 'Rambak Karya Mandiri', 'https://rambakkaryamandiri.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (195, 'Zidane Craft', 'https://zidanecraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (196, 'Ngudi Makmur', 'https://ngudimakmur.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (197, 'Ngudi Boga', 'https://ngudiboga.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (198, 'Okta Kreasindo', 'https://oktakreasindo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (199, 'South Mountain Drum Craft', 'https://southmountaindrumcraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (200, 'Lindha Jaya', 'https://lindhajaya.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (201, 'Bambu Kuncoro', 'https://bambukuncoro.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (202, 'Bambu Nitikan', 'https://bambunitikan.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (203, 'Sedyo Makmur', 'https://sedyomakmur.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (204, 'Meru Caping', 'https://merucaping.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (205, 'Southeast', 'https://southeast.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (206, 'Batik Daru', 'https://batikdaru.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (207, 'Kalimosodo', 'https://kalimosodo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (208, 'Gunungkidul Craft', 'https://gkcraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (209, 'Sawung Joglo', 'https://sawungjoglo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (210, 'Sanggar Brawijaya', 'https://sanggarbrawijaya.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (211, 'Omah Melati', 'https://omahmelati.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (212, 'Nada Batik', 'https://nadabatik.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (213, 'Tas Temuireng', 'https://tastemuireng.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (214, 'Cangkring', 'https://cangkring.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (215, 'Seloseratu', 'https://seloseratu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (216, 'Amarilis', 'https://amarilis.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (217, 'Manggargading', 'https://manggargading.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (218, 'Rabani', 'https://rabani.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (219, 'Konveksi Tawarsari', 'https://konveksitawarsari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (220, 'Besikedung', 'https://besikedung.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (221, 'Nusaindah', 'https://nusaindah.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (222, 'Batik Jelok', 'https://batikjelok.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (223, 'Sablon Tawarsari', 'https://sablontawarsari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (224, 'Sablon Wonosari', 'https://sablonwonosari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (225, 'Konveksi Siraman', 'https://konveksisiraman.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (226, 'Ikan Tuna Buhirto', 'https://ikantunabuhirto.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (227, 'Bakpia 250', 'https://bakpia250.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (228, 'Suwarni', 'https://suwarni.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (229, 'Yutum', 'https://yutum.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (230, 'Purbarasa', 'https://purbarasa.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (231, 'Kub Guyub Rukun', 'https://kubguyubrukun.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (232, 'Murni', 'https://murni.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (233, 'Emping Jagung Puri Genuk', 'https://empingjagungpurigenuk.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (234, 'Rambak Karya Mandiri', 'https://rambakkaryamandiri.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (235, 'Zidane Craft', 'https://zidanecraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (236, 'Ngudi Makmur', 'https://ngudimakmur.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (237, 'Ngudi Boga', 'https://ngudiboga.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (238, 'Okta Kreasindo', 'https://oktakreasindo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (239, 'South Mountain Drum Craft', 'https://southmountaindrumcraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (240, 'Lindha Jaya', 'https://lindhajaya.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (241, 'Bambu Kuncoro', 'https://bambukuncoro.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (242, 'Bambu Nitikan', 'https://bambunitikan.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (243, 'Sedyo Makmur', 'https://sedyomakmur.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (244, 'Meru Caping', 'https://merucaping.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (245, 'Southeast', 'https://southeast.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (246, 'Batik Daru', 'https://batikdaru.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (247, 'Kalimosodo', 'https://kalimosodo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (248, 'Gunungkidul Craft', 'https://gkcraft.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (249, 'Sawung Joglo', 'https://sawungjoglo.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (250, 'Sanggar Brawijaya', 'https://sanggarbrawijaya.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (251, 'Omah Melati', 'https://omahmelati.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (252, 'Nada Batik', 'https://nadabatik.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (253, 'Tas Temuireng', 'https://tastemuireng.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (254, 'Cangkring', 'https://cangkring.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (255, 'Seloseratu', 'https://seloseratu.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (256, 'Amarilis', 'https://amarilis.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (257, 'Manggargading', 'https://manggargading.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (258, 'Rabani', 'https://rabani.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (259, 'Konveksi Tawarsari', 'https://konveksitawarsari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (260, 'Besikedung', 'https://besikedung.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (261, 'Nusaindah', 'https://nusaindah.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (262, 'Batik Jelok', 'https://batikjelok.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (263, 'Sablon Tawarsari', 'https://sablontawarsari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (264, 'Sablon Wonosari', 'https://sablonwonosari.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (265, 'Konveksi Siraman', 'https://konveksisiraman.ikm.gunungkidulkab.go.id/', 'IKM');
INSERT INTO `tb_domain` VALUES (266, 'Dashboard Kominfo', 'https://kominfo-dashboard.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (267, 'Layanan Kominfo', 'https://layanan-kominfo.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (268, 'Dashboard Smartcity', 'https://smartcity.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (269, 'APP Smartcity', 'https://app-smartcity.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (270, 'Perpusdes', 'https://perpusdes.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (271, 'Radio Swara Dhaksinarga', 'https://radio.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (272, 'Terminal Semin', 'https://terminalsemin-dishub.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (273, 'KIM', 'https://kim.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (274, 'SAKIP', 'https://e-gov.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (275, 'SIKAB', 'https://sikab.gunungkidulkab.go.id/', 'Other');
INSERT INTO `tb_domain` VALUES (276, 'CSIRT', 'https://csirt.gunungkidulkab.go.id/', 'Other');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (15, 'User', '$2y$10$CHdoSfBEDjwp2DMkAN6hee3gD4JQsdY0buaNxhs1zplzNeX/UFq2W', 'User');
INSERT INTO `tb_user` VALUES (17, 'Superadmin', '$2y$10$P0ZXH6a/V3xmLUohPrwpx.9KrO1u5ZrVgk0n2sZtx961za1iU45R6', 'Admin');

SET FOREIGN_KEY_CHECKS = 1;
