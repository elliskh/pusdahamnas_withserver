<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MX_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }

	public function comingSoon()
	{
		comingSoon();
	}

	public function phpinfo()
	{
		echo "Akses ditolak";
	}

	public function loadMenu()
	{
		method('get');
		auth();
		$this->load->model('menu/Menu_model', 'menu');

		$role_id = decrypt(session('role_id'));

		if (session('sidebar') === 'vertical') {
			$this->db->order_by('urutan', 'asc');
			$ref_menu_group = $this->db->get('ref_menu_group')->result();

			foreach ($ref_menu_group as $group) {
				$ref_menu_group_id = $group->id;

				$parent = $this->menu->getMainMenu($ref_menu_group_id, $role_id);

				foreach ($parent as $item) {
					$item->child = $this->menu->getSubMenu($item->id, $role_id);
					foreach ($item->child as $row) {
						$row->id = encrypt($row->id);
					}
					$item->id = encrypt($item->id);
					// $item->query = $this->db->last_query();
				}
				$group->menus = $parent;
			}

			response([
				'data' => $ref_menu_group,
				'status' => true,
			]);
		} elseif (session('sidebar') === 'horizontal') {
			$parent = $this->menu->getMainMenu(null, $role_id);

			foreach ($parent as $item) {
				$item->child = $this->menu->getSubMenu($item->id, $role_id);
				foreach ($item->child as $row) {
					$row->id = encrypt($row->id);
				}
				$item->id = encrypt($item->id);
				// $item->query = $this->db->last_query();
			}

			response([
				'data' => $parent,
				'status' => true,
			]);
		}
	}

	public function tambahan6()
	{
		$this->db->query("UPDATE tb_lembaga SET prop_lembaga='43' WHERE id_lembaga='68'");
	}

	public function tambahan5()
	{
		$this->db->query("DROP TABLE IF EXISTS `tb_lembaga`");
$this->db->query("CREATE TABLE `tb_lembaga`  (
  `id_lembaga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `singkatan_lembaga` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prop_lembaga` int(11) NULL DEFAULT NULL,
  `kategori_lembaga` int(11) NULL DEFAULT NULL,
  `fokus_lembaga` int(11) NULL DEFAULT NULL,
  `badan_hukum` int(11) NULL DEFAULT NULL,
  `expand_lembaga` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url_lembaga` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `youtube_lembaga` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `instagram_lembaga` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat_lembaga` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `lat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `visi` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `misi` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;");
		$this->db->query("INSERT INTO `tb_lembaga` VALUES (1, 'Legal Resource Center untuk Keadilan Jender dan Hak Asasi Manusia (LRC-KJHAM)', 'Jawa Tengah', 33, NULL, NULL, NULL, 'lrc_kjham2004@yahoo.com', '(024) 6715520', 'Semarang', NULL, 'Jl. Kauman Raya No.61, Palebon, Kec. Pedurungan, Kota Semarang, Jawa Tengah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (2, 'Southeast Asia Freedom of Expression Network (SAFEnet)', 'Bali', 61, NULL, NULL, NULL, 'info@safenet.or.id', '628119223375', 'Denpasar', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (3, 'Aliansi Masyarakat Adat Nusantara (AMAN)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'rumahaman@cbn.net.id', '(021) 8297957', 'Jakarta Selatan', NULL, 'Jl. Tebet Timur Dalam Raya No.11 A, RT.8/RW.4, Tebet Tim., Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12820', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (4, 'Asia Justice and Rights (AJAR)', 'DKI Jakarta', 31, NULL, NULL, NULL, '', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (5, 'Jaringan Advokasi Tambang (JATAM)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'jatam@jatam.org', '(021) 7945301', 'Jakarta Selatan', NULL, 'Graha Krama Yudha Lantai 4 Unit B No. 43, RT.2/RW.2, Duren Tiga, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12760', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (6, 'Komisi untuk Orang Hilang dan Korban Tindak Kekerasan (KontraS)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'kontras_98@kontras.org', '(021) 3919097', 'Jakarta Pusat', NULL, 'No., Jl. Kramat II No.7, RT.2/RW.9, Kwitang, Kec. Senen, DKI Jakarta, Daerah Khusus Ibukota Jakarta 10420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (7, 'Pusat Studi Hukum dan Kebijakan Indonesia (PSHK)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'pshukum@pshk.or.id', '(021) 83701809', 'Jakarta Selatan', NULL, 'Puri Imperium Office Plaza Blok UG No. 11-12, Jl. Kuningan Madya Kav 5-6, Kuningan, RW.6, Guntur, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (8, 'Lembaga Studi dan Advokasi Masyarakat (ELSAM)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'office@elsam.or.id', '(021) 7972662', 'Jakarta Selatan', NULL, 'Jl. Siaga II No.31, RT.2/RW.5, Pejaten Bar., Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (9, 'Perhimpunan Bantuan Hukum dan Hak Asasi Manusia (PBHI)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'seknas@pbhi.or.id', '', 'Jakarta Barat', NULL, 'SX - TX, Jl. Hayam Wuruk No.4, RT.9/RW.5, Kb. Klp., Kec. Taman Sari, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 10120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (10, 'Yayasan Lingkar Pemberdayaan Perempuan dan Anak Maluku (LAPPAN Maluku)', 'Maluku', 71, NULL, NULL, NULL, 'lappan.maluku@gmail.com', '', 'Ambon', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (11, 'Yayasan Pusat Pendidikan untuk Perempuan dan Anak (PUPA)', 'Bengkulu', 22, NULL, NULL, NULL, 'yayasanpupa.bkl@gmail.com', '(0736) 23344', 'Bengkulu', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (12, 'Lembaga Bantuan Hukum APIK NTB', 'Nusa Tenggara Barat', 62, NULL, NULL, NULL, '', '(0370) 63411', 'Mataram', NULL, 'Jalan Angklung Raya No 2, Karang Bedil, Mataram Lombok, Nusa Tenggara Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (13, 'YLBHI-LBH Samarinda', 'Kalimantan Timur', 44, NULL, NULL, NULL, '', '', 'Samarinda', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (14, 'Yayasan Pulih', 'DKI Jakarta', 31, NULL, NULL, NULL, 'pulihfoundation@gmail.com', '(021) 78842580', 'Jakarta Selatan', NULL, 'Jl. Teluk Peleng 63 A, Komplek AL-Rawa Bambu, Pasar Minggu, Jakarta Selatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (15, 'Perkumpulan Keluarga Berencana Indonesia (PKBI) Daerah Kepulauan Riau', 'Kepulauan Riau', 25, NULL, NULL, NULL, 'pkbikepri@pkbi.orr.id', '082388149914', 'Tanjungpinang', NULL, 'Jl. Kaka Tua II Kampung Simpangan Batu 16 Desa Toapaya Selatan Kecamatan Toapaya Kabupaten Bintan Propinsi Kepulauan Riau', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (16, 'Lembaga Bantuan Hukum (LBH) Jakarta', 'DKI Jakarta', 31, NULL, NULL, NULL, 'lbhjakarta@bantuanhukum.or.id', '0213145518', 'Jakarta Pusat', NULL, 'Jalan Pangeran Diponegoro No.74, Pegangsaan, Menteng, Kota Jakarta Pusat, DKI Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (17, 'Yayasan Lembaga Bantuan Hukum Indonesia (YLBHI)', 'DKI Jakarta', 31, NULL, NULL, NULL, 'info@ylbhi.or.id', '0213929840', 'Jakarta Pusat', NULL, 'Jl. Diponegoro No. 74, Menteng, Jakarta Pusat 10320', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (18, 'Wahana Lingkungan Hidup Indonesia (WALHI) Papua', 'Papua', 73, NULL, NULL, NULL, 'info@walhipapua.org', '', 'Jayapura', NULL, 'Kotaraja Grand Jalur B No 90, Kelurahan Whaimorock , Distrik Abepura, Kota Jayapura - Papua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (19, 'Woman Crisis Center (WCC) Dian Mutiara', 'Jawa Timur', 35, NULL, NULL, NULL, 'wccdianmutiara@gmail.com', '081805876970', 'Surabaya', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (20, 'Wahana Lingkungan Hidup Indonesia (WALHI) Jatim', 'Jawa Timur', 35, NULL, NULL, NULL, '', '', 'Surabaya', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (21, 'Tiki Jaringan Kerja HAM Perempuan Papua', 'Papua', 73, NULL, NULL, NULL, 'tiki.papua2014@gmail.com', '', 'Jayapura', NULL, 'Jl. Bosnik No.B-15 Kamkey Kelurahan Awiyo. Distrik Abepura. Kota Jayapura-Papua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (22, 'YLBH LBH Pos Malang', 'Jawa Timur', 35, NULL, NULL, NULL, 'lbhposmalang19@gmail.com', '', 'Surabaya', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (23, 'KOPPATARA ( komunitas pelindungan perempuan dan Anak Nusantara)', 'Jawa Timur', 35, NULL, NULL, NULL, '', '', 'Malang', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (24, 'LP3A-Papua', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (25, 'LBH APIK Jayapura', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (26, 'LBH Papua', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (27, 'LBH Banda Aceh', 'Aceh', 11, NULL, NULL, NULL, '', '', 'Banda Aceh', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (28, 'SKPKC Fransiskan Papua', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (29, 'Komisi untuk Orang Hilang dan Korban Tindak Kekerasan (KontraS) Surabaya', 'Jawa Timur', 35, NULL, NULL, NULL, 'officekontras@gmail.com', '(031) 99540400', 'Surabaya', NULL, 'Jl. Hamzah Fansyuri No. 41, Darmo, Wonokromo, Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (30, 'Alinasi Jurnalis Independent (AJI) Papua', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (31, 'Keadilan, Perdamaian, Keutuhan dan Ciptaan (KPKC) Sinode GKI Papua', 'Papua', 73, NULL, NULL, NULL, '', '', 'Jayapura', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (32, 'lembaga Batuan Hukum (LBH) Yogyakarta', 'D.I. Yogyakarta', 34, NULL, NULL, NULL, '', '(0274) 4351490', 'Yogyakarta', NULL, 'Jl. Benowo No.309, Winong, RT 12/RW 03, Prenggan, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55172', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (33, 'Perempuan AMAN Samarinda', 'Kalimantan Timur', 44, NULL, NULL, NULL, 'phd.samarinda@gmail.com', '0853 9330 3440', 'Samarinda', NULL, 'Jl.Mayjend Panjaitan Gg. Perawat/2 N0.62 RT.01 Tenggarong, Kalimantan Timur, Indonesia 75514.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (34, 'Forum Peduli Penyandang dan Atlet Disabilitas (FOPPADIS) Kaltim', 'Kalimantan Timur', 44, NULL, NULL, NULL, '', '', 'Samarinda', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (35, 'Yayasan Bumi', 'Kalimantan Timur', 44, NULL, NULL, NULL, '', '', 'Samarinda', NULL, 'Jl. A. Wahab Syahranie Jl. Ratindo IV No.Komplek, Air Hitam, Kec. Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (36, 'Prakarsa Borneo', 'Kalimantan Timur', 44, NULL, NULL, NULL, '', '', 'Samarinda', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (37, 'Savy Amira Wamoen\'s Crisis Centre', 'Jawa Timur', 35, NULL, NULL, NULL, 'savyamira1997@gmail.com', '081330984480', 'Surabaya', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (38, 'Lembaga Bantuan Hukum (LBH) Surabaya', 'Jawa Timur', 35, NULL, NULL, NULL, '', '', 'Surabaya', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (39, 'POKJA 30', 'Kalimantan Timur', 44, NULL, NULL, NULL, 'fhpokja30@gmail.com', '', 'Samarinda', NULL, 'Jl. Gitar. No. 30A. RT.33. Kelurahan Dadi Mulya. Kecamatan Samarinda Ulu. Kota Samarinda. Kalimantan Timur 75123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (40, 'LBH apik Kaltim', 'Kalimantan Timur', 44, NULL, NULL, NULL, 'ylbhapikkaltim@gmail.com', '08125822715', 'Samarinda', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (41, 'Lembaga Bantuan Hukum Medan', 'Sumatera Utara', 12, NULL, NULL, NULL, '', '', 'Medan', NULL, 'Jl. Hindu No.12, Kesawan, Kec. Medan Bar., Kota Medan, Sumatera Utara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (42, 'Wahana Lingkungan Hidup Indonesia (Walhi) Sumatera Utara', 'Sumatera Utara', 12, NULL, NULL, NULL, '', '(061) 42082099', 'Medan', NULL, 'Gg. Wijaya XV No.10, Padang Bulan Selayang II, Kec. Medan Selayang, Kota Medan, Sumatera Utara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (43, 'Wahana Lingkungan Hidup Indonesia (Walhi) Bangka Belitung', 'Bangka Belitung', 24, NULL, NULL, NULL, '', '', 'Pangkal Pinang', NULL, 'Air Salemba, Kec. Gabek, Kota Pangkal Pinang, Kepulauan Bangka Belitung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (44, 'Lembaga Bantuan Hukum (LBH) Apik Banten', 'Banten', 36, NULL, NULL, NULL, '', '', 'Serang', NULL, 'Jln. Raya Pandeglang Km. 3 Komp. Tembong Indah, Sempu, Kota Serang – Banten', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (45, 'Wahana Lingkungan Hidup Indonesia (Walhi) Bengkulu', 'Bengkulu', 22, NULL, NULL, NULL, '', '', 'bengkulu', NULL, 'Jl. Serayu No.03, RT.08/RW.03, Kelurahan Padang Harapan, Kec. Ratu Agung, Kota Bengkulu, Bengkulu 38223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (46, 'Wahana Lingkungan Hidup Indonesia (Walhi) Yogyakarta', 'D.I. Yogyakarta', 34, NULL, NULL, NULL, 'diy@walhi.or.id', '', 'Yogyakarta', NULL, 'Jl. Nyi Pembayun No.14 A, Prenggan, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55172', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (47, 'Sentra Advokasi Perempuan, Difabel dan Anak', 'D.I. Yogyakarta', 34, NULL, NULL, NULL, '', '(0274) 2841999', 'Yogyakarta', NULL, 'Perumahan Pilahan Permai Blok C-39 KG1/649 RT.36, Rejowinangun, Kotagede, Yogyakarta City, Special Region of Yogyakarta 55171', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (48, 'Lembaga Bantuan Hukum (LBH) Apik Yogyakarta', 'D.I. Yogyakarta', 34, NULL, NULL, NULL, '', '0813 9176 5155', 'Sleman', NULL, 'Jl. Kenanga 5, Dero, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (49, 'Woman Crisis Center (WCC) Nurani Perempuan', 'Sumatera Barat', 13, NULL, NULL, NULL, 'nuraniperempuan@yahoo.com', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (50, 'Wahana Lingkungan Hidup Indonesia (Walhi) Sumatera Barat', 'Sumatera Barat', 13, NULL, NULL, NULL, 'sumbar@walhi.or.id', '(02751) 7054673', 'Padang', NULL, 'Jl. Beringin III.A No. 9 Lolong Belanti, Padang Utara Kota Padang - Sumatera Barat Kodepos - 25136', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (51, 'Lembaga Bantuan Hidup (LBH) Padang', 'Sumatera Barat', 13, NULL, NULL, NULL, '', '', 'Padang', NULL, 'Jl. Pekanbaru No.11a, Ulak Karang Sel., Kec. Padang Utara, Kota Padang, Sumatera Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (52, 'Wahana Lingkungan Hidup Indonesia (Walhi) Riau', 'Riau', 14, NULL, NULL, NULL, 'riau@walhi.or.id', '(0761) 8522769', 'Pekanbaru', NULL, 'Gg. Anggur II Jl. Belimbing No.4, Wonorejo, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (53, 'Lembaga Bantuan Hidup (LBH) Pekanbaru', 'Riau', 14, NULL, NULL, NULL, 'info@lbhpekanbaru.or.id', '(0761) 45832', 'Pekanbaru', NULL, 'Jl. Sapta Taruna No.51, Tengkerang Utara, Kec. Bukit Raya, Kota Pekanbaru, Riau 28289', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (54, 'Wahana Lingkungan Hidup Indonesia (Walhi) Jambi', 'Jambi', 15, NULL, NULL, NULL, 'jambi@walhi.or.id', '(0741) 3075233', 'Jambi', NULL, 'Jl. Wijaya Kusuma Jalan Jambi - Muara Bulian No.5, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (55, 'Lembaga Bantuan Hidup (LBH) Palembang', 'Sumatera Selatan', 21, NULL, NULL, NULL, 'lbhplg@yahoo.com', '081369300442', 'Palembang', NULL, 'Jl. HBR Motik No.12a, Karya Baru, Kec. Alang-Alang Lebar, Kota Palembang, Sumatera Selatan 30961', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (56, 'Lembaga Bantuan Hidup (LBH) Apik Sumatera Selatan', 'Sumatera Selatan', 21, NULL, NULL, NULL, '', '085366178051', 'Palembang', NULL, 'Jl. Bendung Dalam No.9, RT.035/RW.009, 8 Ilir, Ilir Timur III, Kota Palembang, Sumatera Selatan 30114', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (57, 'Lembaga Bantuan Hidup (LBH) Bandar Lampung', 'Lampung', 23, NULL, NULL, NULL, 'bantuanhukumlampung@gmail.com', '(0721) 5600425', '', NULL, 'Gg. Mawar 1, Gedong Air, Kec. Tj. Karang Bar., Kota Bandar Lampung, Lampung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (58, 'Lembaga Advokasi Perempuan Damar', 'Lampung', 23, NULL, NULL, NULL, 'damarperempuan2000@gmail.com', '(0721) 264550', '', NULL, 'Jl. M. Husni Thamrin No.14, Gotong Royong, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35132', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (59, 'Wahana Lingkungan Hidup Indonesia (Walhi) Lampung', 'Lampung', 23, NULL, NULL, NULL, 'lampung@walhi.or.id', '(0721) 783061', '', NULL, 'Jl. ZA Pagaralam Gg. Erra No.3, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35132', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (60, 'Lembaga Bantuan Hukum (LBH) Bandung', 'Jawa Barat', 32, NULL, NULL, NULL, '', '', 'Bandung', NULL, 'Jl. Terusan Jakarta No.82, Antapani Tengah, Kec. Antapani, Kota Bandung, Jawa Barat 40291', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (61, 'Wahana Lingkungan Hidup Indonesia (Walhi) Jawa Barat', 'Jawa Barat', 32, NULL, NULL, NULL, 'walhijabar@gmail.com', '', 'Bandung', NULL, 'Jl. Pecah Kopi No 14 Bandung 40123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (62, 'Wahana Lingkungan Hidup Indonesia (Walhi) Nusa Tenggara Timur', 'Nusa tenggara Timur', 63, NULL, NULL, NULL, '', '', 'Kupang', NULL, 'Jl. Bung Tomo III No.8, Klp. Lima, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Timur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (63, 'Lembaga Bantuan Hukum (LBH) APIK Nusa Tenggara Timur', 'Nusa tenggara Timur', 63, NULL, NULL, NULL, '', '(0361) 7268000', 'Kupang', NULL, 'Jl. Sam Ratulangi II, Klp. Lima, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim. 85228', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (64, 'Lembaga Bantuan Hukum (LBH) Pontianak', 'Kalimantan Barat', 41, NULL, NULL, NULL, '', '0878 5141 3121', 'Pontianak', NULL, 'Jln A. Yani, Jl. Sepakat II Blk. Naisyah No.03, Bansir Darat, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat 78124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (65, 'Wahana Lingkungan Hidup Indonesia (Walhi) Kalimantan Barat', 'Kalimantan Barat', 41, NULL, NULL, NULL, 'walhikalbar1@walhi.or.id', '', 'Pontianak', NULL, 'Komplek Untan, Jl. MH. Thamrin No.P.41, Bansir Laut, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat 78124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (66, 'Lembaga Bantuan Hukum (LBH) APIK Pontianak', 'Kalimantan Barat', 41, NULL, NULL, NULL, '', '(0561) 766439', 'Pontianak', NULL, 'Jl. Alianyang No.12 A, Sungai Bangkong, Kec. Pontianak Kota, Kota Pontianak, Kalimantan Barat 78116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (67, 'Wahana Lingkungan Hidup Indonesia (Walhi) Kalimantan Tengah', 'Kalimantan Tengah', 42, NULL, NULL, NULL, '', '081346009070', 'Palangka Raya', NULL, 'Jl. Yogyakarta No.Blok A4, Menteng, Kec. Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 74874', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (68, 'Wahana Lingkungan Hidup Indonesia (Walhi) Kalimantan Selatan', 'Kalimantan Selatan', 21, NULL, NULL, NULL, '', '', 'Banjar Baru', NULL, 'Jl. Dahlina Raya, Loktabat Sel., Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan 70714', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (69, 'Lembaga Bantuan Hukum (LBH) Manado', 'Sulawesi Utara', 51, NULL, NULL, NULL, 'ylbhi.lbhmanado@gmail.com', '', 'Manado', NULL, 'Wanea, Kec. Wanea, Kota Manado, Sulawesi Utara 95115', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (70, 'Lembaga Bantuan Hukum (LBH) APIK Sulawesi Utara', 'Sulawesi Utara', 51, NULL, NULL, NULL, '', '', 'Manado', NULL, 'JL. Bethesda 6, No. 77, Ranotana Ling 3, Manado, North Sulawesi, Sario, Manado City, North Sulawesi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (71, 'Lembaga Bantuan Hukum (LBH) APIK Sulawesi Tengah', 'Sulawesi Tengah', 52, NULL, NULL, NULL, '', '081145401616', 'Sigi', NULL, 'Kalukubula, Kec. Sigi Biromaru, Kabupaten Sigi, Sulawesi Tengah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (72, 'Lembaga Bantuan Hukum (LBH) Makassar', 'Sulawesi Selatan', 53, NULL, NULL, NULL, '', '', 'Makassar', NULL, 'Blok A 22, Jl. Nikel I No.18, Balla Parang, Kec. Rappocini, Kota Makassar, Sulawesi Selatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (73, 'Wahana Lingkungan Hidup Indonesia (Walhi) Sulawesi Selatan', 'Sumatera Selatan', 21, NULL, NULL, NULL, '', '089634010067', 'Makassar', NULL, 'Kompleks, Jl. Aroepala Komp. Jl. Permata Hijau Lestari No.8, Kassi-Kassi, Rappocini, Makassar, Sulawesi Selatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (74, 'Lembaga Bantuan Hukum (LBH) APIK Makassar', 'Sumatera Selatan', 21, NULL, NULL, NULL, '', '', 'Makassar', NULL, 'Blok M.18, Bukit Katulistiwa No.18, Paccerakkang, Biringkanaya, Makassar, Sulawesi Selatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (75, 'Wahana Lingkungan Hidup Indonesia (Walhi) Sulawesi Tenggara', 'Sulawesi Tenggara', 54, NULL, NULL, NULL, 'sultra@walhi.or.id', '0401-3126738', 'Kendari', NULL, 'Blok B No. 25. Jalan Tamburaka, Bende, Kec. Kadia, Kota Kendari, Sulawesi Tenggara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (76, 'Lembaga Bantuan Hukum (LBH) Gorontalo', 'Gorontalo', 55, NULL, NULL, NULL, '', '', 'Gorontalo', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (77, 'Wahana Lingkungan Hidup Indonesia (Walhi) Sulawesi Barat', 'Sulawesi Barat', 56, NULL, NULL, NULL, 'sulbar@walhi.or.id', '', 'Majene', NULL, 'Labuang, Kec. Banggae Tim., Kabupaten Majene, Sulawesi Barat 91412', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (78, 'Wahana Lingkungan Hidup Indonesia (Walhi) Maluku Utara', 'Maluku Utara', 72, NULL, NULL, NULL, '', '', 'Ternate', NULL, 'Jl. Falajawa Dua Gang Alkhairat, Bastiong Karance, Kec. Ternate Sel., Kota Ternate, Maluku Utara 97716', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (79, 'Lembaga Bantuan Hukum (LBH) Papua Pos Sorong', 'Papua Barat', 74, NULL, NULL, NULL, '', '', 'Sorong', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (80, 'Kantor Perwakilan Komnas HAM Provinsi Aceh', 'Aceh', 11, NULL, NULL, NULL, 'perwakilan_aceh@komnasham.go.id', '(0651) 8086030', 'Banda Aceh', NULL, 'Jl. Krueng Arakundo No. 01, Gampong Geuceu Komplek, Kecamatan Banda Raya, Kota Banda Aceh, Provinsi Aceh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (81, 'Kantor Perwakilan Komnas HAM Provinsi Sumatera Barat', 'Sumatera Barat', 13, NULL, NULL, NULL, 'perwakilan_sumbar@komnasham.go.id', '(0751) 7050320', 'Padang', NULL, 'Jl Rasuna Said No 74, Padang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (82, 'Kantor Perwakilan Komnas HAM Provinsi Kalimantan Barat', 'Kalimantan Barat', 41, NULL, NULL, NULL, 'perwakilan_kalbar@komnasham.go.id', '(0561) 736112', 'Pontianak', NULL, 'Jl Daeng Abdul Hadi, No 146, (Belakang PLN) Pontianak, Kalimantan Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (83, 'Kantor Perwakilan Komnas HAM Provinsi Sulawesi Tengah', 'Sulawesi Tengah', 52, NULL, NULL, NULL, 'perwakilan_sulteng@komnasham.go.id', '(0451) 4214255', 'Palu', NULL, 'Jl Letjen Soeprapto No 48. Palu, Sulawesi Tengah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (84, 'Kantor Perwakilan Komnas HAM Provinsi Maluku', 'Maluku', 71, NULL, NULL, NULL, 'perwakilan_maluku@komnasham.go.id', '(0911) 351463', 'Ambon', NULL, 'Jl Dr Malaiholo No. 57 Airsalobar Kec Nusaniwe, Ambon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
$this->db->query("INSERT INTO `tb_lembaga` VALUES (85, 'Kantor Perwakilan Komnas HAM Provinsi Papua', 'Papua', 73, NULL, NULL, NULL, 'perwakilan_papua@komnasham.go.id', '(0967) 521592', 'Jayapura', NULL, 'Jl Soasio, Dok V Bawah Jayapura, Papua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");

var_dump($this->db->get('tb_lembaga')->result_array());
	}

	public function update()
	{
		$this->db->where('id_hak','4')->update('ref_hak_dokumen',array('is_active'=>'0'));
	}

	public function glossari2()
	{
		$this->db->query("INSERT INTO `tb_glossari` VALUES (4, 'Berkumpul Secara Damai', 'Hak yang diakui untuk tidak dibatasi kecuali yang ditentukan sesuai dengan hukum, dan yang diperlukan untuk kepentingan keamanan nasional dan keselamatan publik, atau ketertiban umum, perlindungan terhadap kesehatan atau moral umum, atau perlindungan atas hak-hak dan kebebasan-kebebasan orang lain.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (5, 'Damai', 'Damai adalah ketika kesetaraan, keragaman, partisipasi serta Hak Asasi Manusia telah bersinergi dengan baik dan dijadikan sebagai landasan dalam berkehidupan menjadi sesuatu yang dimungkinkan dan didambakan.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (6, 'Diskriminasi', 'Destingsi, eksklusi, restriksi atau preferensi terhadap ras, suku, golongan, warna kulit, jenis kelamin, bahasa, pendapat politik, agama atau keyakinan tertentu yang memiliki tujuan penghapusan atau pelemahan terhadap pengakuan, penikmatan atau penggunaan hak asasi manusia.<br>Diskriminasi mempunyai nuansa yang serupa dengan pengurangan, penyimpangan, pengecualian, pembedaan, pembatasan dan pengucilan yang dapat dikategorikan menjadi satu rumpun.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (7, 'Exhausted of Domestic Legal Remedies', 'Istilah \"exhaustion of domestic remedies\" mengacu pada persyaratan umum bahwa para korban pelanggaran HAM pertama kali menggunakan prosedur pengaduan peradilan atau administrasi yang tersedia berdasarkan hukum nasionalnya sebelum membawa kasusnya ke tingkat internasional.<br><br>Persyaratan ini memberi negara yang diduga bertanggung jawab atas pelanggaran HAM kesempatan untuk memberikan reparasi mandiri. Merupakan prasyarat untuk mengajukan pengaduan ke sebagian besar badan hak asasi manusia supranasional, yang dimana badan-badan itu akan menolak pengaduan jika pengadu tidak dapat menunjukkan bahwa ia telah mengupayakan pemulihan domestik hingga putusan akhir.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (8, 'Genosida', 'Perbuatan yang dilakukan Perbuatan yang dilakukan dengan maksud untuk menghancurkan atau memusnahkan seluruh atau sebagian kelompok bangsa, ras, kelompok etnis, kelompok agama, dengan cara:<ol type=\"a\"><li>membunuh anggota kelompok</li><li>mengakibatkan penderitaan fisik atau mental yang berat terhadap anggota-anggota kelompok</li><li>menciptakan kondisi kehidupan kelompok yang akan mengakibatkan kemusnahan secara fisik baik seluruh atau sebagiannya</li><li>memaksakan tindakan-tindakan yang bertujuan mencegah kelahiran di dalam kelompok atau</li><li>memindahkan secara paksa anak-anak dari kelompok tertentu ke kelompok lain</li></ol>', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (9, 'Hak Korban', 'Seperangkat hak yang berkaitan dengan pemulihan korban atas suatu tindakan kejahatan yang mengakibatkan kerugian bagi korban.Hak korban adalah tindakan yang wajib dilakukan oleh negara dalam bentuk restitusi, reparasi, rehabilitasi, dalam beberapa konteks hak korban semakin berkembang seperti kebutuhan korban akan akses untuk memperoleh informasi. Menjamin hak-hak korban selama proses persidangan, melibatkan korban untuk berpartisipasi, dan sebagainya.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (10, 'Hak-Hak yang Dapat Dibatasi/Dikurangi (Derogable Rights)', 'Seperangkat hak-hak yang boleh dibatasi atau dikurangi pemenuhannya oleh negara-negara Pihak secara sementara dalam konteks adanya kondisi \'keadaan darurat\', yang penerapannya mewajibkan negara pihak untuk melapor ke Komite terkait \'keadaan darurat\' yang dimaksud.7Di Indonesia, pengurangan atau pembatasan HAM hanya boleh ditetapkan oleh Undang-Undang dengan maksud semata untuk menjamin pengakuan serta penghormatan atas hak dan kebebasan orang lain dan untuk memenuhi tuntutan yang adil sesuai dengan pertimbangan moral, nilai-nilai agama, keamanan, dan ketertiban umum dalam suatu masyarakat demokratis.Penggunaan frasa/ kata kerja dari Hak yang dapat Dikurangi/Dibatasi dapat diterapkan menurut kondisi dan situasi, diantaranya:<br>Hak atas privasi dapat dibatasi dalam konteks penyadapan, namun pengaturan mengenai penyadapan harus ditetapkan dalam Undang-Undang agar dapat diakui. Misal suatu instansi/pemerintah/negara melakukan penyadapan kepada individu hanya berdasarkan peraturan perundang-undangan dibawah Undang-Undang, contoh Peraturan Pemerintah maka penyadapan tersebut melanggar HAM.', '1', NULL);");
		$this->db->query("INSERT INTO `tb_glossari` VALUES (11, 'Hukum Kemanusiaan Internasional (Humanitarian Law)', 'Seperangkat hukum, yang umumnya berdasarkan Konvensi Jenewa, yang bertujuan melindungi orang-orang tertentu dalam konflik bersenjata, membantu korban, dan membatasi metode pertempuran untuk meminimalisir kerusakan, kehilangan nyawa, dan penderitaan manusia yang tidak perlu.', '1', NULL);");

var_dump($this->db->get('tb_glossari')->result_array());
	}

	public function testglo()
	{
		var_dump($this->db->get('tb_glossari')->result_array());
	}

	public function loadIcon()
	{
		$icons = icons();

		response([
			'data' => $icons
		]);
	}

	public function changeTahun()
	{
		method('get');
		auth();

		if (!get('tahun')) show_404();
		session('tahun', get("tahun"));
		response([
			'status' => true,
			'message' => 'Berhasil mengubah periode tahun',
			'tahun' => session('tahun')
		]);
	}

	public function darkMode()
	{
		method('get');
		auth();

		session('mode', 'dark');
		response([
			'status' => true,
			'message' => 'Berhasil mengubah mode',
		]);
	}

	public function lightMode()
	{
		method('get');
		auth();

		session('mode', 'light');
		response([
			'status' => true,
			'message' => 'Berhasil mengubah mode',
		]);
	}

	public function changeSidebar()
	{
		method('get');
		auth();

		if (!get('sidebar')) show_404();
		session('sidebar', get("sidebar"));
		response([
			'status' => true,
			'message' => 'Berhasil mengubah sidebar',
			'sidebar' => session('sidebar')
		]);
	}

	public function logs()
	{
		auth();
		$logViewer = new CILogViewer\CILogViewer();
		echo $logViewer->showLogs();
		return;
	}

	public function editProfil()
	{
		method('post', true);

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_data(post());
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');
		$this->form_validation->set_message('matches', '%s tidak sama dengan %s');
		$this->form_validation->set_message('min_length', '%s minimal %s karakter');
		$this->form_validation->set_rules('nama', 'Nama lengkap', 'required|trim');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|min_length[6]');
		$this->form_validation->set_rules('password_confirmation', 'Konfirmasi kata sandi', 'trim|min_length[6]|matches[password]');

		if (!$this->form_validation->run())
			response([
				'status' => false,
				'message' => 'Mohon periksa kembali inputan anda!',
				'errors' => $this->form_validation->error_array(),
			], 422); 

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$this->load->model('users/User_model', 'user');
		$id = decrypt(post('id'));//$this->user->check();	// Cek data
        //chmod('./uploads/gambar_slide', 0777);
        ///chmod(('assets/photo'), 0777);
            $config = array( 
                             'upload_path' => ('./assets/photo'),//'./uploads/gambar_slide',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
        
        $file_name = '';       
        if($this->upload->do_upload('gambar')){
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');

			$update =  [
				'uuid' => uuid(),
				'nama' => post('nama'),
				'photo'=> $file_name,//post('photo'),
			];

    		if (post('password')) $update['password'] = generatePassword(post('password'));
    
    		$where = [
    			'id' => $id
    		];
    
    		$this->db->update('users', $update, $where);

			$this->db->where('id', $id);

			$querys= $this->db->get('users');

			if ($querys->num_rows() > 0) {
				$result = $querys->row();

				// Retrieve the 'nama' value
				$password_lama = $result->password;

				$datalogs = array(
					'user_id' => decrypt($this->session->id),
					'activity' => $this->session->nama . ' Merubah Password',
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'contents' => 'PWL : ' . $password_lama . ' - PWB : ' . generatePassword(post('password'))
				);
		
				$this->db->insert('logs', $datalogs);
			}
    
    		session('nama', post('nama'));
            session('photo', $file_name);
    		response([
    			'status' => true,
    			'message' => 'Update data berhasil',
    			//"query" => $this->db->last_query(),
    		]);
        }else{
    		$update =  [
    			'uuid' => uuid(),
    			'nama' => post('nama'),
    			///'email' => post('email'),
    			///'photo'=> $file_name,//post('photo'),
    		];
    		if (post('password')) $update['password'] = generatePassword(post('password'));
    
    		$where = [
    			'id' => $id
    		];

    
    		$this->db->update('users', $update, $where);

			$this->db->where('id', $id);

			$querys= $this->db->get('users');

			if ($querys->num_rows() > 0) {
				$result = $querys->row();

				// Retrieve the 'nama' value
				$password_lama = $result->password;

				$datalogs = array(
					'user_id' => decrypt($this->session->id),
					'activity' => $this->session->nama . ' Merubah Password',
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'contents' => 'PWL : ' . $password_lama . ' - PWB : ' . generatePassword(post('password'))
				);
		
				$this->db->insert('logs', $datalogs);
			}
    
    		session('nama', post('nama'));
            ///session('email', post('email'));
            ///session('photo', $file_name);
            
    		response([
    			'status' => 'sukses',
    			'message' => 'Update data profile berhasil',
    			//"query" => $this->db->last_query(),
    		]);            
        }    
		//=========================================================//
		if (!$this->db->trans_status()) {   // Check transaction status
			$this->db->trans_rollback();    // Rollback transaction
			/*response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
				'errors' => $this->db->error(),
			], 500);*/
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
			//	'errors' => $this->db->error(),
			]);
		}

		$this->db->trans_commit();  // Commit transaction
        
		response([
			//'status' => true,
            'status' => 'sukses',
			'message' => 'Data berhasil disimpan',
			//"query" => $this->db->last_query(),
		]);
        
	}

	public function privacypolicy()
	{
		$this->load->view('front/privacy-policy');
	}

	public function editProfilBiasa()
	{
		method('post', true);

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_data(post());
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');
		$this->form_validation->set_message('matches', '%s tidak sama dengan %s');
		$this->form_validation->set_message('min_length', '%s minimal %s karakter');
		$this->form_validation->set_rules('nama', 'Nama lengkap', 'required|trim');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|min_length[6]');
		$this->form_validation->set_rules('password_confirmation', 'Konfirmasi kata sandi', 'trim|min_length[6]|matches[password]');

		if (!$this->form_validation->run())
			response([
				'status' => false,
				'message' => 'Mohon periksa kembali inputan anda!',
				'errors' => $this->form_validation->error_array(),
			]);
        
		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$this->load->model('users/User_model', 'user');
		$id = decrypt(post('id'));//$this->user->check();	// Cek data
        //chmod('./uploads/gambar_slide', 0777);
        ///chmod(('assets/photo'), 0777);
       
            $config = array( 
                             'upload_path' => ('assets/photo'),//'./uploads/gambar_slide',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
                
        $file_name = '';       
        if($this->upload->do_upload('gambar')){ 
        ///$this->upload->do_upload('gambar');
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');

		$update =  [
			'uuid' => uuid(),
			'nama' => post('nama'),
			'photo'=> $file_name,//post('photo'),
		];

		if (post('password')) $update['password'] = generatePassword(post('password'));

		$where = [
			'id' => $id,
			///'tipe_daftar' => '1'
		];

		$this->db->update('users', $update, $where);

		$this->db->where('id', $id);

		$querys= $this->db->get('users');

		if ($querys->num_rows() > 0) {
			$result = $querys->row();

			// Retrieve the 'nama' value
			$password_lama = $result->password;

			$datalogs = array(
				'user_id' => decrypt($this->session->id),
				'activity' => $this->session->nama . ' Merubah Password',
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'contents' => 'PWL : ' . $password_lama . ' - PWB : ' . generatePassword(post('password'))
			);
	
			$this->db->insert('logs', $datalogs);
		}

		session('nama', post('nama'));
        session('photo', $file_name);
       }else{
    		$update =  [
    			'uuid' => uuid(),
    			'nama' => post('nama'),
    			///'photo'=> $file_name,//post('photo'),
    		];
    
    		if (post('password')) $update['password'] = generatePassword(post('password'));
    
    		$where = [
    			'id' => $id,
    			///'tipe_daftar' => '1'
    		];
    
    		$this->db->update('users', $update, $where);

			$this->db->where('id', $id);

			$querys= $this->db->get('users');

			if ($querys->num_rows() > 0) {
				$result = $querys->row();
    
				// Retrieve the 'nama' value
				$password_lama = $result->password;

				$datalogs = array(
					'user_id' => decrypt($this->session->id),
					'activity' => $this->session->nama . ' Merubah Password',
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'contents' => 'PWL : ' . $password_lama . ' - PWB : ' . generatePassword(post('password'))
				);
		
				$this->db->insert('logs', $datalogs);
			}
    
    
    		session('nama', post('nama'));
            ///session('photo', $file_name);
       }
		//=========================================================//
		if (!$this->db->trans_status()) {   // Check transaction status
			$this->db->trans_rollback();    // Rollback transaction
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
			//	'errors' => $this->db->error(),
			]);
		}

		$this->db->trans_commit();  // Commit transaction

		response([
			'status' => 'sukses',
			'message' => 'Update Data berhasil disimpan',
			// "query" => $this->db->last_query(),
		]);
	}

	public function session()
	{
		auth();
		header('Content-Type: application/json');
		echo json_encode($_SESSION);
	}

	public function cookie()
	{
		auth();
		header('Content-Type: application/json');
		echo json_encode($_COOKIE);
	}
}
