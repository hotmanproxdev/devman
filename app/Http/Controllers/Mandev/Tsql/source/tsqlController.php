<?php

namespace App\Http\Controllers\Mandev\Tsql\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class tsqlController extends Controller
{
    public function getPackList()
    {
        return app("\Tsql")
                           /* query is here..orm condition */
                           ->query(\DB::table("prosystem_administrator_process_logs")->orderBy("id","desc")->take(10)->get())

                           /* (optional) wanted fields */
                           ->fields(
                                    [
                                        'id'=>'Id',
                                        'ccode'=>'Sistem Kodu',
                                        'userid'=>'Kullanıcı',
                                        'userip'=>'İp',
                                        'isMobile'=>'Mobil',
                                        'manipulation'=>'Manipulation',
                                        'isTablet'=>'Tablet',
                                        'isDesktop'=>'Masaustu'
                                    ]
                                    )

                           /* (optional) field css */
                           ->fieldCss(
                                      [
                                          'all'=>'xtext'
                                      ]
                                      )

                           /* (optional) wanted fields */
                           ->contentIn(
                                    [
                                       'matching'=>
                                       [
                                           'status'=>
                                                     [
                                                         '1'=>'Aktif',
                                                         '0'=>'Pasif'
                                                     ]
                                       ]

                                    ]
                                    )

                           /* (optional) content css */
                           ->contentCss(
                                        [
                                            'id'=>'xtext2'
                                        ]
                           )

                           /* command run */
                           ->run();
    }
}
