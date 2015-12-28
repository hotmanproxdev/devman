<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class wordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prosystem_words')->insert([
            [   'id'=>1,
                'url_path'=>'login',
                'word_data'=> '{"ccode":"Kullan\u0131c\u0131 Kodunuz","login_password":"\u015eifreniz","loginTop":"Panel Giri\u015f Formu","login_warning":"Herhangi bir kullan\u0131c\u0131 ad\u0131 yada \u015fifre girmediniz"}',
                'lang'=> 1,
                'updated_at'=>time()
            ],
            [   'id'=>2,
                'url_path'=>'default',
                'word_data'=> '{"validation_warning":"Bu alan\u0131 bo\u015f b\u0131rakamazs\u0131n\u0131z","save_changes":"De\u011fi\u015fiklikleri Kaydet","logout":"\u00c7\u0131k\u0131\u015f Yap","tasks":"G\u00f6revlerim","Profile":"Profilim","lockscreen":"Kilit Ekran\u0131","username":"Kullan\u0131c\u0131 Ad\u0131","login":"Giri\u015f","remember":"Hat\u0131rla","not":"De\u011filim?","approximately":"Yakla\u015f\u0131k","second":"Saniye","before":"\u00d6nce","minute":"Dakika","hour":"Saat","day":"G\u00fcn","month":"Ay","year":"Y\u0131l","mainsearch":"Bir data aray\u0131n","dashboard":"","dashboard_info":""}',
                'lang'=> 1,
                'updated_at'=>time()
            ],
            [   'id'=>3,
                'url_path'=>'lockScreen',
                'word_data'=> '{"info":"Hesap Kilitli","not":"De\u011fil misin?"}',
                'lang'=> 1,
                'updated_at'=>time()
            ],
            [   'id'=>4,
                'url_path'=>'home',
                'word_data'=> '{"mainsearch":"Bir data aray\u0131n","dashboard":"Anasayfa - Genel \u0130statistikler","dashboard_info":"Sisteminizdeki genel istatistiklerin bulundu\u011fu b\u00f6l\u00fcmdesiniz..."}',
                'lang'=> 1,
                'updated_at'=>time()
            ],
            [   'id'=>5,
                'url_path'=>'profile',
                'word_data'=> '{"mobilphone":"Telefon Numaras\u0131","login_name":"Kullan\u0131c\u0131 Ad\u0131","address":"\u0130kamet Adresi","occupation":"Meslek",
                "about":"Hakk\u0131nda","website":"Website","notchange":"De\u011fi\u015ftirilemez","company_code":"Sistem Kodu","private_settings":"\u00d6zel Ayarlar","profil_picture":"Profil Resmi","change_password":"\u015eifre De\u011fi\u015ftir","personal_info":"Ki\u015fisel Bilgiler","profile_tab1":"Profil Bilgisi","dashboard":"Profil Sayfas\u0131","dashboard_info":"Profil Sayfas\u0131 (Ki\u015fisel Ayarlar Merkezi)"}',
                'lang'=> 1,
                'updated_at'=>time()
            ]
        ]);
    }

}
