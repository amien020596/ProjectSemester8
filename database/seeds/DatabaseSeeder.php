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


      DB::table('users')->insert([
        array('name'=>'admin','email'=>'amienkurniawan01@gmail.com','password'=>bcrypt('amienkurniawan'),'role'=>'admin'),
        array('name'=>'amien','email'=>'surveyor1@ce.undip.ac.id','password'=>bcrypt('surveyor1'),'role'=>'surveyor'),
        array('name'=>'amri l','email'=>'surveyor2@ce.undip.ac.id','password'=>bcrypt('surveyor2'),'role'=>'surveyor'),
        array('name'=>'ayod','email'=>'surveyor3@ce.undip.ac.id','password'=>bcrypt('surveyor3'),'role'=>'surveyor'),
      ]);
      DB::table('user_profiles')->insert([
          array('firstname'=>'admin ','lastname'=>'bidikmisi','address'=>'jalan prof soedarto','user_id'=>1),
          array('firstname'=>'amien ','lastname'=>'kurniawan','address'=>'jalan prof soedarto','user_id'=>2),
          array('firstname'=>'amri ','lastname'=>'lutfi','address'=>'jalan prof soedarto','user_id'=>3),
          array('firstname'=>'ayodya ','lastname'=>'purba','address'=>'jalan prof soedarto','user_id'=>4),
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
              array('fakultas'=>'Ekonomika dan Bisnis'),//1
              array('fakultas'=>'Hukum'),//2
              array('fakultas'=>'Ilmu Budaya'),//3
              array('fakultas'=>'Ilmu Sosial & Ilmu Politik'),//4
              array('fakultas'=>'Kedokteran'),//5
              array('fakultas'=>'Peternakan & Pertanian'),//6
              array('fakultas'=>'Psikologi'),//7
              array('fakultas'=>'Sains dan Matematika'),//8
              array('fakultas'=>'Teknik'),//9
              array('fakultas'=>'Kesehatan Masyarakat'),//10
              array('fakultas'=>'Perikanan dan Ilmu Kelautan'),//11
            ]);
            DB::table('datajurusans')->insert([
                array('id_fakultas'=>'1','jurusan'=>'Akuntansi'),//1
                array('id_fakultas'=>'1','jurusan'=>'Ekonomi Islam'),//2
                array('id_fakultas'=>'1','jurusan'=>'Manajemen'),//3
                array('id_fakultas'=>'1','jurusan'=>'Ilmu Ekonomi & Studi Pembangunan'),//4
                array('id_fakultas'=>'2','jurusan'=>'Ilmu Hukum'),//5
                array('id_fakultas'=>'3','jurusan'=>'Antropologi Sosial'),//6
                array('id_fakultas'=>'3','jurusan'=>'Sastra Indonesia'),//7
                array('id_fakultas'=>'3','jurusan'=>'Sastra Inggris'),//8
                array('id_fakultas'=>'3','jurusan'=>'Bahasa dan Kebudayaan Jepang'),//9
                array('id_fakultas'=>'3','jurusan'=>'Ilmu Perpustakaan'),//10
                array('id_fakultas'=>'3','jurusan'=>'Sejarah'),//11
                array('id_fakultas'=>'4','jurusan'=>'Hubungan Internasional'),//12
                array('id_fakultas'=>'4','jurusan'=>'Administrasi Bisnis'),//13
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Administrasi Publik'),//14
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Komunikasi'),//15
                array('id_fakultas'=>'4','jurusan'=>'Ilmu Pemerintahan'),//16
                array('id_fakultas'=>'5','jurusan'=>'Ilmu Gizi'),//17
                array('id_fakultas'=>'5','jurusan'=>'Keperawatan'),//18
                array('id_fakultas'=>'5','jurusan'=>'Kedokteran'),//19
                array('id_fakultas'=>'5','jurusan'=>'Kedokteran Gigi'),//20
                array('id_fakultas'=>'5','jurusan'=>'Farmasi'),//21
                array('id_fakultas'=>'6','jurusan'=>'Agribisnis'),//22
                array('id_fakultas'=>'6','jurusan'=>'Agroekoteknologi'),//23
                array('id_fakultas'=>'6','jurusan'=>'Peternakan'),//24
                array('id_fakultas'=>'6','jurusan'=>'Teknologi Pangan'),//25
                array('id_fakultas'=>'7','jurusan'=>'Psikologi'),//26
                array('id_fakultas'=>'8','jurusan'=>'Biologi'),//27
                array('id_fakultas'=>'8','jurusan'=>'Fisika'),//28
                array('id_fakultas'=>'8','jurusan'=>'Informatika'),//29
                array('id_fakultas'=>'8','jurusan'=>'Kimia'),//30
                array('id_fakultas'=>'8','jurusan'=>'Matematika'),//31
                array('id_fakultas'=>'8','jurusan'=>'Statistika'),//32
                array('id_fakultas'=>'9','jurusan'=>'Teknik Komputer'),//33
                array('id_fakultas'=>'9','jurusan'=>'Arsitektur'),//34
                array('id_fakultas'=>'9','jurusan'=>'Teknik Elektro'),//35
                array('id_fakultas'=>'9','jurusan'=>'Teknik Geodesi'),//36
                array('id_fakultas'=>'9','jurusan'=>'Teknik Geologi'),//37
                array('id_fakultas'=>'9','jurusan'=>'Teknik Industri'),//38
                array('id_fakultas'=>'9','jurusan'=>'Teknik Kimia'),//39
                array('id_fakultas'=>'9','jurusan'=>'Teknik Lingkungan'),//40
                array('id_fakultas'=>'9','jurusan'=>'Teknik Mesin'),//41
                array('id_fakultas'=>'9','jurusan'=>'Perencanaan Wilayah Kota'),//42
                array('id_fakultas'=>'9','jurusan'=>'Teknik Perkapalan'),//43
                array('id_fakultas'=>'9','jurusan'=>'Teknik Sipil'),//44
                array('id_fakultas'=>'10','jurusan'=>'Kesehatan Masyarakat'),//45
                array('id_fakultas'=>'11','jurusan'=>'Akuakultur'),//46
                array('id_fakultas'=>'11','jurusan'=>'Ilmu Kelautan'),//47
                array('id_fakultas'=>'11','jurusan'=>'Manajemen SD Perairan'),//48
                array('id_fakultas'=>'11','jurusan'=>'Oceanografi'),//49
                array('id_fakultas'=>'11','jurusan'=>'Perikanan Tangkap'),//50
                array('id_fakultas'=>'11','jurusan'=>'Teknologin Hasil Perikanan'),//51
              ]);
              DB::table('datamahasiswas')->insert([

                  array('nim'=>'26050117130051','nama'=>'Azmya Sabiya Nasira Raesha','id_fakultas'=>'11','id_jurusan'=>'49','id_user'=>'2'),
                  array('nim'=>'21070117130123','nama'=>'Almeera Azzahra Alfathunissa','id_fakultas'=>'9','id_jurusan'=>'38','id_user'=>'3'),
                  array('nim'=>'12010117130167','nama'=>'Azka Zaina Ardiningrum','id_fakultas'=>'1','id_jurusan'=>'3','id_user'=>'4'),
                  array('nim'=>'13040217130039','nama'=>'Ashalina Yumnaa Naladhipa','id_fakultas'=>'3','id_jurusan'=>'6','id_user'=>'2'),
                  array('nim'=>'12020117130114','nama'=>'Omar Jannes','id_fakultas'=>'1','id_jurusan'=>'4','id_user'=>'3'),
                  array('nim'=>'21030117130146','nama'=>'Opal Suwardi','id_fakultas'=>'9','id_jurusan'=>'39','id_user'=>'4'),
                  array('nim'=>'15000117130127','nama'=>'Orlando Azel','id_fakultas'=>'7','id_jurusan'=>'26','id_user'=>'2'),
                  array('nim'=>'25000117130168','nama'=>'Osahar Shunnar','id_fakultas'=>'10','id_jurusan'=>'45','id_user'=>'3'),
                  array('nim'=>'14020217130085','nama'=>'Assyfa Putri Aura Zaskia','id_fakultas'=>'4','id_jurusan'=>'13','id_user'=>'4'),
                  array('nim'=>'21030117120065','nama'=>'Aqilla Fariza Mufia ','id_fakultas'=>'9','id_jurusan'=>'39','id_user'=>'2'),
                ]);

                DB::table('nilai_mahasiswas')->insert([
                    //1
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'1','nilai'=>'1250000'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'2','nilai'=>'135000'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'3','nilai'=>'2'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'5','nilai'=>'2'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'6','nilai'=>'4'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'7','nilai'=>'6'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'8','nilai'=>'4'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'9','nilai'=>'100'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'10','nilai'=>'120'),
                    array('nim'=>'26050117130051','id_user'=>'2','id_kriteria'=>'11','nilai'=>'3'),
                    //2
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'1','nilai'=>'2250000'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'2','nilai'=>'200000'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'3','nilai'=>'3'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'5','nilai'=>'4'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'6','nilai'=>'6'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'7','nilai'=>'9'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'8','nilai'=>'3'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'9','nilai'=>'120'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'10','nilai'=>'150'),
                    array('nim'=>'21070117130123','id_user'=>'3','id_kriteria'=>'11','nilai'=>'3'),
                    //3
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'1','nilai'=>'1000000'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'2','nilai'=>'80000'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'3','nilai'=>'1'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'5','nilai'=>'1'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'6','nilai'=>'3'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'7','nilai'=>'6'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'8','nilai'=>'4'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'9','nilai'=>'80'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'10','nilai'=>'100'),
                    array('nim'=>'12010117130167','id_user'=>'4','id_kriteria'=>'11','nilai'=>'2'),
                    //4
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'1','nilai'=>'2000000'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'2','nilai'=>'100000'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'3','nilai'=>'3'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'5','nilai'=>'2'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'6','nilai'=>'3'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'7','nilai'=>'6'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'8','nilai'=>'3'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'9','nilai'=>'100'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'10','nilai'=>'130'),
                    array('nim'=>'13040217130039','id_user'=>'2','id_kriteria'=>'11','nilai'=>'3'),
                    //5
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'1','nilai'=>'1750000'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'2','nilai'=>'75000'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'3','nilai'=>'1'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'5','nilai'=>'1'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'6','nilai'=>'3'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'7','nilai'=>'4'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'8','nilai'=>'4'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'9','nilai'=>'90'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'10','nilai'=>'100'),
                    array('nim'=>'12020117130114','id_user'=>'3','id_kriteria'=>'11','nilai'=>'3'),
                    //6
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'1','nilai'=>'2500000'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'2','nilai'=>'150000'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'3','nilai'=>'2'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'5','nilai'=>'2'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'6','nilai'=>'3'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'7','nilai'=>'7'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'8','nilai'=>'4'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'9','nilai'=>'100'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'10','nilai'=>'120'),
                    array('nim'=>'21030117130146','id_user'=>'4','id_kriteria'=>'11','nilai'=>'3'),
                    //7
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'1','nilai'=>'3000000'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'2','nilai'=>'175000'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'3','nilai'=>'3'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'5','nilai'=>'2'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'6','nilai'=>'5'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'7','nilai'=>'7'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'8','nilai'=>'3'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'9','nilai'=>'120'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'10','nilai'=>'150'),
                    array('nim'=>'15000117130127','id_user'=>'2','id_kriteria'=>'11','nilai'=>'3'),
                    //8
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'1','nilai'=>'2750000'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'2','nilai'=>'150000'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'3','nilai'=>'3'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'4','nilai'=>'0'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'5','nilai'=>'3'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'6','nilai'=>'3'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'7','nilai'=>'6'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'8','nilai'=>'3'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'9','nilai'=>'90'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'10','nilai'=>'120'),
                    array('nim'=>'25000117130168','id_user'=>'3','id_kriteria'=>'11','nilai'=>'3'),
                    //9
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'1','nilai'=>'3250000'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'2','nilai'=>'175000'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'3','nilai'=>'3'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'4','nilai'=>'1'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'5','nilai'=>'4'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'6','nilai'=>'4'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'7','nilai'=>'7'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'8','nilai'=>'3'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'9','nilai'=>'150'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'10','nilai'=>'160'),
                    array('nim'=>'14020217130085','id_user'=>'4','id_kriteria'=>'11','nilai'=>'3'),
                    //10
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'1','nilai'=>'4000000'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'2','nilai'=>'200000'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'3','nilai'=>'4'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'4','nilai'=>'1'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'5','nilai'=>'4'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'6','nilai'=>'5'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'7','nilai'=>'10'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'8','nilai'=>'4'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'9','nilai'=>'150'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'10','nilai'=>'170'),
                    array('nim'=>'21030117120065','id_user'=>'2','id_kriteria'=>'11','nilai'=>'3'),
                  ]);

    }
}
