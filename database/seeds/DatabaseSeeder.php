<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for($i = 0; $i < 10; $i++) {

      DB::table('users')->insert([
        array('name'=>'admin','email'=>'amienkurniawan01@gmail.com','password'=>bcrypt('password'),'role'=>'admin'),
        array('name'=>'amien','email'=>'akurniawan@ce.undip.ac.id','password'=>bcrypt('password'),'role'=>'surveyor'),
        array('name'=>'amri l','email'=>'amril@ce.undip.ac.id','password'=>bcrypt('password'),'role'=>'surveyor'),
        array('name'=>'ayod','email'=>'ayod@ce.undip.ac.id','password'=>bcrypt('password'),'role'=>'surveyor'),
      ]);
      DB::table('user_profiles')->insert([
          array('firstname'=>'admin ','lastname'=>'bidikmisi','no_hp'=>'085727747959','address'=>'jalan prof soedarto','user_id'=>1),
          array('firstname'=>'amien ','lastname'=>'kurniawan','no_hp'=>'085727747959','address'=>'jalan prof soedarto','user_id'=>2),
          array('firstname'=>'amri ','lastname'=>'lutfi','no_hp'=>'085727747959','address'=>'jalan prof soedarto','user_id'=>3),
          array('firstname'=>'ayodya ','lastname'=>'purba','no_hp'=>'085727747959','address'=>'jalan prof soedarto','user_id'=>4),
        ]);
        DB::table('kriterias')->insert([
            array('kriteria'=>'Penghasilan Orang tua','jenis'=>'cost','bobot'=>'5'),
            array('kriteria'=>'Biaya Listrik','jenis'=>'cost','bobot'=>'3'),
            array('kriteria'=>'Jumlah Sepeda Motor','jenis'=>'cost','bobot'=>'3'),
            array('kriteria'=>'Jumlah Mobil','jenis'=>'cost','bobot'=>'5'),
            array('kriteria'=>'Jumlah Laptop/PC','jenis'=>'cost','bobot'=>'3'),
            array('kriteria'=>'Jumlah Hp','jenis'=>'cost','bobot'=>'3'),
            array('kriteria'=>'Jumlah Ruangan Rumah','jenis'=>'cost','bobot'=>'4'),
            array('kriteria'=>'HM Rumah','jenis'=>'cost','bobot'=>'4'),
            array('kriteria'=>'Luas Bangunan','jenis'=>'cost','bobot'=>'4'),
            array('kriteria'=>'Luas Tanah','jenis'=>'cost','bobot'=>'4'),
            array('kriteria'=>'Dinding','jenis'=>'cost','bobot'=>'5')
          ]);
          DB::table('datafakultas')->insert([
              array('fakultas'=>'Ekonomika dan Bisnis'),
              array('fakultas'=>'Hukum'),
              array('fakultas'=>'Ilmu Budaya'),
              array('fakultas'=>'Ilmu Sosial & Ilmu Politik'),
              array('fakultas'=>'Kedokteran'),
              array('fakultas'=>'Peternakan & Pertanian'),
              array('fakultas'=>'Psikologi'),
              array('fakultas'=>'Sains dan Matematika'),
              array('fakultas'=>'Teknik'),
              array('fakultas'=>'Kesehatan Masyarakat'),
              array('fakultas'=>'Perikanan dan Ilmu Kelautan'),
            ]);
            DB::table('datajurusans')->insert([
                array('id_fakultas'=>'1','jurusan'=>'Akuntansi'),
                array('id_fakultas'=>'1','jurusan'=>'Ekonomi Islam'),
                array('id_fakultas'=>'1','jurusan'=>'Manajemen'),
                array('id_fakultas'=>'1','jurusan'=>'Ilmu Ekonomi & Studi Pembangunan'),
                array('id_fakultas'=>'2','jurusan'=>'Ilmu Hukum'),
                array('id_fakultas'=>'3','jurusan'=>'Antropologi Sosial'),
                array('id_fakultas'=>'3','jurusan'=>'Sastra Indonesia'),
                array('id_fakultas'=>'3','jurusan'=>'Sastra Inggris'),
                array('id_fakultas'=>'3','jurusan'=>'Bahasa dan Kebudayaan Jepang'),
                array('id_fakultas'=>'3','jurusan'=>'Ilmu Perpustakaan'),
                array('id_fakultas'=>'3','jurusan'=>'Sejarah'),
                array('id_fakultas'=>'4','jurusan'=>'Hubungan Internasional'),
                array('id_fakultas'=>'4','jurusan'=>'Administrasi Bisnis'),
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Administrasi Publik'),
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Komunikasi'),
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Pemerintahan'),
                array('id_fakultas'=>'5','jurusan'=>'Ilmu Gizi'),
                array('id_fakultas'=>'5','jurusan'=>'Keperawatan'),
                array('id_fakultas'=>'5','jurusan'=>'Kedokteran'),
                array('id_fakultas'=>'5','jurusan'=>'Kedokteran Gigi'),
                array('id_fakultas'=>'5','jurusan'=>'Farmasi'),
                array('id_fakultas'=>'6','jurusan'=>'Agribisnis'),
                array('id_fakultas'=>'6','jurusan'=>'Agroekoteknologi'),
                array('id_fakultas'=>'6','jurusan'=>'Peternakan'),
                array('id_fakultas'=>'6','jurusan'=>'Teknologi Pangan'),
                array('id_fakultas'=>'7','jurusan'=>'Psikologi'),
                array('id_fakultas'=>'8','jurusan'=>'Biologi'),
                array('id_fakultas'=>'8','jurusan'=>'Fisika'),
                array('id_fakultas'=>'8','jurusan'=>'Informatika'),
                array('id_fakultas'=>'8','jurusan'=>'Kimia'),
                array('id_fakultas'=>'8','jurusan'=>'Matematika'),
                array('id_fakultas'=>'8','jurusan'=>'Statistika'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Komputer'),
                array('id_fakultas'=>'9','jurusan'=>'Arsitektur'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Elektro'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Geodesi'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Geologi'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Industri'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Kimia'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Lingkungan'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Mesin'),
                array('id_fakultas'=>'9','jurusan'=>'Perencanaan Wilayah Kota'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Perkapalan'),
                array('id_fakultas'=>'9','jurusan'=>'Teknik Sipil'),
                array('id_fakultas'=>'10','jurusan'=>'Kesehatan Masyarakat'),
                array('id_fakultas'=>'11','jurusan'=>'Akuakultur'),
                array('id_fakultas'=>'11','jurusan'=>'Ilmu Kelautan'),
                array('id_fakultas'=>'11','jurusan'=>'Manajemen SD Perairan'),
                array('id_fakultas'=>'11','jurusan'=>'Oceanografi'),
                array('id_fakultas'=>'11','jurusan'=>'Perikanan Tangkap'),
                array('id_fakultas'=>'11','jurusan'=>'Teknologin Hasil Perikanan'),
              ]);
              DB::table('datamahasiswas')->insert([
                  array('nim'=>'26050117130051','nama'=>'Azmya Sabiya Nasira Raesha','id_fakultas'=>'11','id_jurusan'=>'49'),
                  array('nim'=>'14020217130085','nama'=>'Assyfa Putri Aura Zaskia','id_fakultas'=>'4','id_jurusan'=>'13'),
                  array('nim'=>'12010117130167','nama'=>'Azka Zaina Ardiningrum','id_fakultas'=>'1','id_jurusan'=>'3'),
                  array('nim'=>'13040217130039','nama'=>'Ashalina Yumnaa Naladhipa','id_fakultas'=>'3','id_jurusan'=>'6'),
                  array('nim'=>'12020117130114','nama'=>'Omar Jannes','id_fakultas'=>'1','id_jurusan'=>'4'),
                  array('nim'=>'21030117130146','nama'=>'Opal Suwardi','id_fakultas'=>'9','id_jurusan'=>'39'),
                  array('nim'=>'21070117130123','nama'=>'Almeera Azzahra Alfathunissa','id_fakultas'=>'9','id_jurusan'=>'38'),
                  array('nim'=>'15000117130127','nama'=>'Orlando Azel','id_fakultas'=>'7','id_jurusan'=>'26'),
                  array('nim'=>'25000117130168','nama'=>'Osahar Shunnar','id_fakultas'=>'10','id_jurusan'=>'45'),
                  array('nim'=>'21030117120065','nama'=>'Aqilla Fariza Mufia','id_fakultas'=>'9','id_jurusan'=>'39'),
                  array('nim'=>'25000117130182','nama'=>'Osaze Alejandro','id_fakultas'=>'10','id_jurusan'=>'45'),
                ]);
      }
    }
}
