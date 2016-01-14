<?php

use Illuminate\Database\Seeder;

class ProsystemWordsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_words')->delete();
        
		\DB::table('prosystem_words')->insert(array (
			0 => 
			array (
				'id' => 1,
				'url_path' => 'login',
				'word_data' => '{"login_password":"\\u015eifreniz","loginTop":"Panel Giri\\u015f Formu","login_warning":"Herhangi bir kullan\\u0131c\\u0131 ad\\u0131 yada \\u015fifre girmediniz","ccode":"Kullan\\u0131c\\u0131 Kodunuz"}',
				'lang' => 1,
				'updated_at' => 1450861289,
			),
			1 => 
			array (
				'id' => 2,
				'url_path' => 'default',
				'word_data' => '{"username":"Kullan\\u0131c\\u0131 Ad\\u0131","login":"Giri\\u015f","remember":"Beni Hat\\u0131rla","not":"De\\u011filim?","approximately":"Yakla\\u015f\\u0131k","second":"Saniye","before":"\\u00d6nce","minute":"Dakika","hour":"Saat","day":"G\\u00fcn","month":"Ay","year":"Y\\u0131l","mainsearch":"Bir data aray\\u0131n","dashboard":"","dashboard_info":"","lockscreen":"Kilit Ekran\\u0131","logout":"\\u00c7\\u0131k\\u0131\\u015f Yap","tasks":"G\\u00f6revlerim","Profile":"Profilim","save_changes":"De\\u011fi\\u015fiklikleri Kaydet","validation_warning":"Bu alan\\u0131 bo\\u015f b\\u0131rakamazs\\u0131n\\u0131z","warning":"Uyar\\u0131.","error":"Hata Kayd\\u0131","empty_warning":"Se\\u00e7ene\\u011fini Bo\\u015f G\\u00f6nderemezsiniz.L\\u00fctfen \\u0130lgili Alan\\u0131 Doldurunuz","minchar_warning":"Se\\u00e7ene\\u011fi \\u0130\\u00e7in En Az 8 Karakter Bekleniyor","summary":"\\u00d6zet Bilgi","active":"Aktif","passive":"Pasif","log_false":"Config dosyas\\u0131nda log tutma kapat\\u0131lm\\u0131\\u015f.L\\u00fctfen sistem geli\\u015ftiricisine ba\\u015fvurunuz.","user_capter_menu":"Kullan\\u0131c\\u0131lar B\\u00f6l\\u00fcm\\u00fc","developer":"Geli\\u015ftirici","manager":"Y\\u00f6netici","normal":"Normal","user_status":"Kullan\\u0131c\\u0131 Stat\\u00fcs\\u00fc","never_login_time":"Bu Kullan\\u0131c\\u0131 Hi\\u00e7 Login Olmad\\u0131","online_statu":"Online Durumu","system_auth":"Sistem Yetkisi","profil":"Profil","email":"Email","hash":"Oturum \\u015eifresi","fullname":"Ger\\u00e7ek \\u0130smi","user_where":"Kullan\\u0131c\\u0131n\\u0131n Son Bulundu\\u011fu Yer","browser_family":"Taray\\u0131c\\u0131","hash_you":"Oturum Sahibi Sizsiniz"}',
				'lang' => 1,
				'updated_at' => 1452773254,
			),
			2 => 
			array (
				'id' => 3,
				'url_path' => 'lockScreen',
				'word_data' => '{"info":"Hesap Kilitli","not":"De\\u011fil misin?"}',
				'lang' => 1,
				'updated_at' => 1447765078,
			),
			3 => 
			array (
				'id' => 4,
				'url_path' => 'home',
				'word_data' => '{"mainsearch":"Bir data aray\\u0131n","dashboard":"Anasayfa - Genel \\u0130statistikler","dashboard_info":"Sisteminizdeki genel istatistiklerin bulundu\\u011fu b\\u00f6l\\u00fcmdesiniz..."}',
				'lang' => 1,
				'updated_at' => 1447683519,
			),
			4 => 
			array (
				'id' => 7,
				'url_path' => 'test',
				'word_data' => '{"dashboard":"Test Sayfas\\u0131","dashboard_info":"Test Sayfas\\u0131 Olu\\u015fturuldu"}',
				'lang' => 1,
				'updated_at' => 1448369582,
			),
			5 => 
			array (
				'id' => 8,
				'url_path' => 'foo',
				'word_data' => '{"dashboard":"Test Sayfas\\u0131","dashboard_info":"Test Sayfas\\u0131 Olu\\u015fturuldu"}',
				'lang' => 1,
				'updated_at' => 1448371080,
			),
			6 => 
			array (
				'id' => 9,
				'url_path' => 'profile',
			'word_data' => '{"dashboard":"Profil Sayfas\\u0131","dashboard_info":"Profil Sayfas\\u0131 (Ki\\u015fisel Ayarlar Merkezi)","profile_tab1":"Profil Bilgisi","profile_tab2":"Hesab\\u0131m","profile_tab3":"Yetkiler","profile_tab4":"G\\u00f6revler","personal_info":"Ki\\u015fisel Bilgiler","profil_picture":"Profil Resmi","change_password":"\\u015eifre De\\u011fi\\u015ftir","private_settings":"\\u00d6zel Ayarlar","username":"Ad\\u0131n\\u0131z Soyad\\u0131n\\u0131z","company_code":"Sistem Kodu","notchange":"De\\u011fi\\u015ftirilemez","mobilphone":"Telefon Numaras\\u0131","login_name":"Kullan\\u0131c\\u0131 Ad\\u0131","address":"\\u0130kamet Adresi","occupation":"Meslek","about":"Hakk\\u0131nda","website":"Website","username_info":"Bu alan login giri\\u015fi i\\u00e7in kullan\\u0131lacak kullan\\u0131c\\u0131 ismidir.","new_password":"Yeni \\u015eifreniz.","renew_password":"Yeni \\u015eifrenizi Tekrar Yaz\\u0131n\\u0131z.","profil_field_top_info":"Bu alanda profil fotonuzu g\\u00f6rebilir ve yenisini ekleyebilirsiniz.Profil fotonuz sistemdeki tek fotonuzdur","pick_picture":"Bir resim se\\u00e7in.","warning_profil_picture_size":"L\\u00fctfen b\\u00fcy\\u00fck resimler y\\u00fcklemeye \\u00f6zen g\\u00f6steriniz.","change_password_msg_success":"\\u015eifreniz Ba\\u015far\\u0131 \\u0130le De\\u011fi\\u015ftirildi","change_password_title_success":"\\u015eifre De\\u011fi\\u015fikli\\u011fi","change_password_not_same_warning_msg":"Girilen \\u015eifreler Uyumlu G\\u00f6r\\u00fcnm\\u00fcyor.L\\u00fctfen Ayn\\u0131 \\u015eifre Yaz\\u0131n\\u0131z","change_password_not_same_warning_title":"\\u015eifre Hatas\\u0131","update_profile_msg_success":"Profil bilgilerinizi ba\\u015far\\u0131 ile de\\u011fi\\u015ftirdiniz.","update_profile_title_success":"Profil Bilgi De\\u011fi\\u015fikli\\u011fi","update_profile_msg_warning":"G\\u00fcncelleme i\\u00e7in herhangi bir de\\u011fi\\u015fiklik alg\\u0131layamad\\u0131k","update_profile_title_warning":"G\\u00fcncelleme Hatas\\u0131","file_upload_msg_success":"Profil resminizi ba\\u015far\\u0131 ile de\\u011fi\\u015ftirdiniz.","file_upload_title_success":"Profil Resim De\\u011fi\\u015fikli\\u011fi","file_upload_msg_warning":"Profil resminizi de\\u011fi\\u015ftiremedik l\\u00fctfen tekrar deneyiniz.","file_upload_title_warning":"Profil Resim De\\u011fi\\u015fikli\\u011fi Hatas\\u0131","file_upload_false_msg_warning":"Profil resminizi de\\u011fi\\u015ftiremedik l\\u00fctfen tekrar deneyiniz.Dosya y\\u00fcklenmedi,izinlerinizi kontrol ediniz","file_upload_false_title_warning":"Profil Resim De\\u011fi\\u015fikli\\u011fi Hatas\\u0131","online_statu":"Online Durumu","last_login":"Son Login","member_date":"\\u00dcyelik Tarihi","user_where":"Bulundu\\u011fu Yer","last_ip":"Son Ip","admin_last_actions":"Son Hareketler","mail":"Mail Adresiniz"}',
				'lang' => 1,
				'updated_at' => 1452169751,
			),
			7 => 
			array (
				'id' => 10,
				'url_path' => 'users',
				'word_data' => '{"dashboard":"Kullan\\u0131c\\u0131 Listeleri","dashboard_info":"Kullan\\u0131c\\u0131 Listeleri sayfas\\u0131nda,kendi alan\\u0131n\\u0131za ait t\\u00fcm kullan\\u0131c\\u0131lar\\u0131 g\\u00f6rebilir ve bunlar\\u0131 y\\u00f6netebilirsiniz.","defined_all_users":"Alan\\u0131n\\u0131zdaki T\\u00fcm Kullan\\u0131c\\u0131lar\\u0131n Listesi","user_general_infos":"Kullan\\u0131c\\u0131 Genel Bilgileri","user_roles":"Kullan\\u0131c\\u0131 Yetkileri","create_new_user":"Yeni Kullan\\u0131c\\u0131n\\u0131z\\u0131 Olu\\u015fturmaya Ba\\u015flay\\u0131n","form_new_user":"Yeni Kullan\\u0131c\\u0131 Formu","attention_while_new_user_create":"Kullan\\u0131c\\u0131 Olu\\u015ftururken Dikkat Etmeniz Gerekenler","new_user_create_rules":"Yeni kullan\\u0131c\\u0131n\\u0131z\\u0131 olu\\u015ftururken ccode diye tabir edilen sistem kodunu mutlaka\\n        belirtmelisiniz,kullan\\u0131c\\u0131n\\u0131z\\u0131n login name,password ve tam ismi bo\\u015f ge\\u00e7ilemeyecek zorunlu aland\\u0131r,yetkilendirmede varsay\\u0131lan olarak normal kullan\\u0131c\\u0131 ozellikleri gelir,\\n        siz kullan\\u0131c\\u0131n\\u0131z\\u0131 kendi insiyatifinizde stat\\u00fclendirebilirsiniz.","new_user_ccode":"Kullan\\u0131c\\u0131 Sistem Kodu","new_user_login_name":"Kullan\\u0131c\\u0131 Login \\u0130smi","new_user_login_password":"Kullan\\u0131c\\u0131 Login \\u015eifresi","new_user_email":"Kullan\\u0131c\\u0131 Email Adresi","new_user_fullname":"Kullan\\u0131c\\u0131 Ger\\u00e7ek \\u0130smi","new_user_phone_number":"Kullan\\u0131c\\u0131 Telefonu","new_user_status":"Kullan\\u0131c\\u0131 Stat\\u00fcs\\u00fc","new_user_post_true":"Yeni Kullan\\u0131c\\u0131 Ba\\u015far\\u0131 \\u0130le Olu\\u015fturuldu","new_user_post_header":"Yeni Kullan\\u0131c\\u0131 Olu\\u015fturma Bilgisi","new_user_post_false":"Yeni Kullan\\u0131c\\u0131 Olu\\u015fturulamad\\u0131.Sistemlerimizde Bir Hata Meydana Geldi.L\\u00fctfen Daha Sonra Tekrar Deneyiniz","user_roles_capter":"Kullan\\u0131c\\u0131 Yetkileri B\\u00f6l\\u00fcm\\u00fc","user_page_role_define":"Sayfa Rol Tan\\u0131m\\u0131","user_page_role_explain":"Rol A\\u00e7\\u0131klamas\\u0131","user_page_role_layer":"Rol Katman\\u0131","user_page_role_assign":"Atama","last_login_ip":"Son Giri\\u015f \\u0130p","users_created_date":"Kullan\\u0131c\\u0131 Olu\\u015fturulma Tarihi","user_lang":"Kullan\\u0131c\\u0131 Dili","user_phone":"Kullan\\u0131c\\u0131 Telefonu","last_login_time":"Son Giri\\u015f Zaman\\u0131","last_logout_time":"Son \\u00c7\\u0131k\\u0131\\u015f Zaman\\u0131","created_by":"Olu\\u015fturan Ki\\u015fi","device":"Ayg\\u0131t","user_where_time":"Son Sayfa Zaman\\u0131","user_hash_terminated":"Kullan\\u0131c\\u0131n\\u0131n Oturumu Sonland\\u0131r\\u0131ld\\u0131","all_admin_clickeds":"T\\u00fcm T\\u0131klamalar","hash_admin_clickeds":"Oturum T\\u0131klamalar\\u0131","all_admin_operations":"T\\u00fcm \\u0130\\u015flemler","success_admin_operations":"Ba\\u015far\\u0131l\\u0131 \\u0130\\u015flemler","fail_admin_operations":"Ba\\u015far\\u0131s\\u0131z \\u0130\\u015flemler","noauth_area_operations":"Yetkisiz \\u0130\\u015flemler"}',
				'lang' => 1,
				'updated_at' => 1452773254,
			),
		));
	}

}
