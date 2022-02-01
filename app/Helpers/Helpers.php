<?php 


    function messageErrors( $codeOfError )
    {
        $arrayOfErrors  = [
            '200'       => [ 'type' => 'success', 'message' => 'با موفقیت انجام شد' ],
            '201'       => [ 'type' => 'success', 'message' => 'با موفقیت خارج شدید' ],


            '401'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی کافی نمی باشد' ],
            '402'       => [ 'type' => 'danger', 'message' => 'درج اطلاعات با خطا مواجه شد' ],
            '403'       => [ 'type' => 'danger', 'message' => 'اطلاعات ورودی اشتباه است' ],
            '404'       => [ 'type' => 'danger', 'message' => 'نیم سال تحصیلی فعالی وجود ندارد' ],
            '405'       => [ 'type' => 'danger', 'message' => 'شما دسترسی لازم را ندارید' ],
            '406'       => [ 'type' => 'danger', 'message' => 'فایل ارسالی مجاز نمی باشد' ],
            '407'       => [ 'type' => 'danger', 'message' => 'امکان حذف ترم فعال وجود ندارد' ],
            '408'       => [ 'type' => 'danger', 'message' => 'کاربر مورد نظر یافت نشد' ],
            '409'       => [ 'type' => 'danger', 'message' => 'در این تاریخ برای این درس امتحان دیگری وجود دارد' ],
            '410'       => [ 'type' => 'danger', 'message' => 'تاریخ آزمون به درستی انتخاب نشده است' ],
            '411'       => [ 'type' => 'danger', 'message' => 'آزمون شناخته نشد' ],
            '412'       => [ 'type' => 'danger', 'message' => 'خطا در ثبت آزمون' ],
            '413'       => [ 'type' => 'danger', 'message' => 'قبلا در آزمون شرکت کرده اید' ],
            '414'       => [ 'type' => 'danger', 'message' => 'زمان آزمون به پایان رسیده است' ],
            '415'       => [ 'type' => 'danger', 'message' => 'امکان ثبت نمره فقط برای آزمون های شامل سوال تشریحی میباشد' ],
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


    function questionTypes()
    {
        $array  = [
            'multiOption' => 'چهار گزینه ای',
            'trueFalse'   => 'صحیح/غلط',
            'description' => 'تشریحی',
        ];

        return $array;
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


    function extractAnswersOptionsFromArray( $array )
    {
        $i      = 0;
        $result = [];
        foreach ($array as $key => $value) 
            if ( preg_match('/answer/',$key) ) 
                $result[$i][$key] = $value;

        return $result;
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
        
        $data = ( count($data) == 1 ) ? reset($data) : $data;

        echo '<pre>';
            var_dump($data);
        echo '</pre>';
        die;
    }

    function datepickerToTimestamp($datePickerValue)
    {
        $jalaliString   = toEngNumbers( $datePickerValue );
        return \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d', $jalaliString, 'UTC' )->getTimestamp();
    }   
    
    
    function timestampTHours($timestamp)
    {
        return date("H:i",$timestamp);   
    }


    function timepickerToTimestamp($timepickerValue)
    {
        $jalaliString   = toEngNumbers( $timepickerValue );
        return strtotime( $jalaliString ) % 86400;
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

    function trueFalseTitle($input)
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

    function getFreeStorageAsGigabyte( $dir = '/' )
    {
        return round( ( disk_free_space($dir) ) / 1024 / 1024 / 1024, 2 );
    } 
    
    function getFullStorageAsGigabyte( $dir = '/' )
    {
        return round( ( disk_total_space($dir) ) / 1024 / 1024 / 1024, 2 );
    }





    


