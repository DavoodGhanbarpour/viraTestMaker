<?php 


    function messageErrors( $codeOfError )
    {
        $arrayOfErrors  = [
            '200'       => [ 'type' => 'success', 'message' => 'با موفقیت انجام شد' ],
            '201'       => [ 'type' => 'success', 'message' => 'با موفقیت خارج شدید' ],


            '401'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی کافی نمی باشد' ],
            '402'       => [ 'type' => 'danger', 'message' => 'کاربر مورد نظر یافت نشد' ],
            '403'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی اشتباه است' ],
            '404'       => [ 'type' => 'danger', 'message' => 'نیم سال تحصیلی فعالی وجود ندارد' ],
            '405'       => [ 'type' => 'danger', 'message' => 'شما دسترسی لازم را ندارید' ],
            '406'       => [ 'type' => 'danger', 'message' => 'فایل ارسالی مجاز نمی باشد' ],
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


    function coursesLevelTitle( $level = '' )
    {
        $array  = [
            '1'     => 'اصلی',
            '2'     => 'فرعی',
            '3'     => 'درس',
        ];

        if( !$level )
            return $array;


        return $array[ $level ];
    }



    function toEngNumbers($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [ 0 ,  1 ,  2 ,  3 ,  4 ,  4 ,  5 ,  5 ,  6 ,  6 ,  7 ,  8 ,  9 ];
        return str_replace($persian, $english, $input);
    }


    function varDumper( ...$data )
    {
        $style      = 
        'body {
            padding: 30px;
            background-color: #2d2d2d;
        }
        pre
        {
            color: #f4f4f4;
        }

        ';
        echo "<style>$style</style>";
        
        echo '<pre>';
            var_dump($data);
        echo '</pre>';
        die;
    }

    function datepickerToTimestamp($datePickerValue)
    {
        $jalaliString   = toEngNumbers( $datePickerValue );
        return \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d', $jalaliString )->getTimestamp();
    }


    function timestampToJalali($timestamp)
    {
        return jdate($timestamp)->format('Y/m/d');
    }


    function semesterTypeTitles($input)
    {
        $array  = [
            'SPRING'     => 'نیم سال اول',
            'WINTER'     => 'نیم سال دوم',
            'SUMMER'     => 'تابستان',
        ];

        if( !$input )
            return $array;


        return $array[ $input ];
    }

    function semesterActivationTitle($input)
    {
        $array  = [
            'true'     => 'فعال',
            'false'    => 'غیرفعال',
        ];

        if( !$input )
            return $array;


        return $array[ $input ];
    }


    function timestampToGregorian( $timestamp )
    {
        return date('yy/m/d',$timestamp);
    }





    


