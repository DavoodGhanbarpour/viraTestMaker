<?php 


    function messageErrors( $codeOfError )
    {
        $arrayOfErrors  = [
            '200'       => [ 'type' => 'success', 'message' => 'با موفقیت انجام شد' ],
            '201'       => [ 'type' => 'success', 'message' => 'با موفقیت خارج شدید' ],


            '401'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی کافی نمی باشد' ],
            '402'       => [ 'type' => 'danger', 'message' => 'کاربر مورد نظر یافت نشد' ],
            '403'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی اشتباه است' ],

            '405'       => [ 'type' => 'danger', 'message' => 'شما دسترسی لازم را ندارید' ],
        ];

        return $arrayOfErrors[ $codeOfError ];
    }


    function translatedRole( $role = '' )
    {
        $array  = [
            'ADMIN'       => 'ادمین سیستم',
            'TEACHER'     => 'معلم',
            'STUDENT'     => 'دانشجو / دانش آموز',
        ];

        if( !$role )
            return $array;


        return $array[ $role ];
    }


    function trashed()
    {
        return 1;
    }

    

