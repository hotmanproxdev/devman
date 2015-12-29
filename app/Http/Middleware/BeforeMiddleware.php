<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

class BeforeMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $request;
    protected $app;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->app->insertLang(["url_path"=>"default","word_data"=>['lockscreen'=>'Kilit Ekranı'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['logout'=>'Çıkış Yap'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['tasks'=>'Görevlerim'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['Profile'=>'Profilim'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['dashboard'=>'Profil Sayfası'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['dashboard_info'=>'Profil Sayfası (Kişisel Ayarlar Merkezi)'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab1'=>'Profil Bilgisi'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab2'=>'Hesabım'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab3'=>'Yetkiler'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab4'=>'Görevler'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['personal_info'=>'Kişisel Bilgiler'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profil_picture'=>'Profil Resmi'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['change_password'=>'Şifre Değiştir'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['private_settings'=>'Özel Ayarlar'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['username'=>'Adınız Soyadınız'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['company_code'=>'Sistem Kodu'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['notchange'=>'Değiştirilemez'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['mobilphone'=>'Telefon Numarası'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['login_name'=>'Kullanıcı Adı'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['address'=>'İkamet Adresi'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['occupation'=>'Meslek'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['about'=>'Hakkında'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['website'=>'Website'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['save_changes'=>'Değişiklikleri Kaydet'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['validation_warning'=>'Bu alanı boş bırakamazsınız'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['username_info'=>'Bu alan login girişi için kullanılacak kullanıcı ismidir.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['new_password'=>'Yeni Şifreniz.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['renew_password'=>'Yeni Şifrenizi Tekrar Yazınız.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profil_field_top_info'=>'Bu alanda profil fotonuzu görebilir ve yenisini ekleyebilirsiniz.Profil fotonuz sistemdeki tek fotonuzdur'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['pick_picture'=>'Bir resim seçin.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"default","word_data"=>['warning'=>'Uyarı.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['warning_profil_picture_size'=>'Lütfen büyük resimler yüklemeye özen gösteriniz.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['change_password_msg_success'=>'Şifreniz Başarı İle Değiştirildi'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['change_password_title_success'=>'Şifre Değişikliği'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['change_password_not_same_warning_msg'=>'Girilen Şifreler Uyumlu Görünmüyor.Lütfen Aynı Şifre Yazınız'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['change_password_not_same_warning_title'=>'Şifre Hatası'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['update_profile_msg_success'=>'Profil bilgilerinizi başarı ile değiştirdiniz.'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['update_profile_title_success'=>'Profil Bilgi Değişikliği'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['update_profile_msg_warning'=>'Güncelleme için herhangi bir değişiklik algılayamadık'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['update_profile_title_warning'=>'Güncelleme Hatası'],"lang"=>1]);

        return $next($request);
    }
}
