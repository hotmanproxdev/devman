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
                'word_data'=> '{"login_password":"\u015eifreniz","loginTop":"Panel Giri\u015f Formu","login_warning":"Herhangi bir kullan\u0131c\u0131 ad\u0131 yada \u015fifre girmediniz"}',
                'lang'=> 1,
                'updated_at'=>time()
            ],
            [   'id'=>2,
                'url_path'=>'default',
                'word_data'=> '{"username":"Kullan\u0131c\u0131 Ad\u0131","login":"Giri\u015f","remember":"Hat\u0131rla","not":"De\u011filim?","approximately":"Yakla\u015f\u0131k","second":"Saniye","before":"\u00d6nce","minute":"Dakika","hour":"Saat","day":"G\u00fcn","month":"Ay","year":"Y\u0131l","mainsearch":"Bir data aray\u0131n","dashboard":"","dashboard_info":""}',
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
            ]
        ]);
    }

}
