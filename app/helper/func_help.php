<?php


/***********************************************************************************/
// get every rate
if (!function_exists('every_rate')) {
    function every_rate($rates) {
        $rates = collect($rates);
        $rate_1 = $rates->filter(function ($rate) { return $rate->rate == 1; });
        $rate_2 = $rates->filter(function ($rate) { return $rate->rate == 2; });
        $rate_3 = $rates->filter(function ($rate) { return $rate->rate == 3; });
        $rate_4 = $rates->filter(function ($rate) { return $rate->rate == 4; });
        $rate_5 = $rates->filter(function ($rate) { return $rate->rate == 5; });

        $result = [
            ['level_rate' => '1', 'rate' => $rate_1->count()],
            ['level_rate' => '2', 'rate' => $rate_2->count()],
            ['level_rate' => '3', 'rate' => $rate_3->count()],
            ['level_rate' => '4', 'rate' => $rate_4->count()],
            ['level_rate' => '5', 'rate' => $rate_5->count()]
        ];
        return $result;
    }
}

/***********************************************************************************/
// add Prefix in url admin [control panel]
if (!function_exists('convert_gallery_to_array')) {
    function convert_gallery_to_array($products) {
        if ($products[0] != null) {
            foreach ($products as $product) {
                $gallery = $product->gallery;
                $gallery_arr = [];
                if ($gallery != null) {
                    $gallery = explode(',', $gallery);
                    $i = 1;
                    foreach ($gallery as $image) {
                        $gallery_arr[] = ['id' => $i, 'image' => $image];
                        $i++;
                    }
                } else {
                    $gallery = $gallery_arr;
                }
                $product->gallery = $gallery_arr;
            }
        } else {
            $gallery = $products->gallery;
            $gallery_arr = [];
            if ($gallery != null) {
                $gallery = explode(',', $gallery);
                $i = 1;
                foreach ($gallery as $image) {
                    $gallery_arr[] = ['id' => $i, 'image' => $image];
                    $i++;
                }
            } else {
                $gallery = $gallery_arr;
            }
            $products->gallery = $gallery_arr;
        }
        return $products;
    }
}


/***********************************************************************************/
// add Prefix in url admin [control panel]
if (!function_exists('aurl')) {
    function aurl($url = null) {
        $name = env('CP_PREFIX');
        if ($url !== null) {
            return url($name . '/' . $url);
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
// add class active in links active
if (!function_exists('active_link')) {
    function active_link($uri, $recursive = true, $indexSegment = 1, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment($indexSegment)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === Request::url()) {
                return $class_name;
            }
        }
        return '';
    }
}
/***********************************************************************************/
if (!function_exists('active_link_url')) {
    function active_link_url($url, $class_name = 'active') {
        if ($url === Request::url()) {
            return $class_name;
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
// add class active in links active
if (!function_exists('active_link_cp')) {
    function active_link_cp($uri, $recursive = true, $indexSegment = 2, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment($indexSegment)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (aurl($uri) === Request::url()) {
                return $class_name;
            }
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
if (!function_exists('lang')) {
    function lang() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        $defaultLang = Cookie::get($name_cookies) !== null ? Cookie::get($name_cookies) : 'en';
        if (env('USER_LANG_ALLOW') === true) {
            if (auth()->check()) {
                session()->put($name_cookies, auth()->user()->lang);
            }
        }
        if (session()->has($name_cookies)) {
            $currentLang = session($name_cookies);
        } else {
            session()->put($name_cookies, $defaultLang);
            $currentLang = $defaultLang;
        }
        setcookie($name_cookies, $currentLang, time() + (60 * 24 * 30 * 12), '/'); // expired after 1 year.
        return $currentLang;
    }
}
if (!function_exists('get_lang')) {
    function get_lang() {
        return lang();
    }
}
if (!function_exists('default_lang')) {
    function default_lang() {
        return lang();
    }
}
/***********************************************************************************/
// Ge Direction
if (!function_exists('direction')) {
    function direction() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        if (session()->has($name_cookies)) {
            if (session($name_cookies) == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}
if (!function_exists('dir')) {
    function dir() {
        return direction();
    }
}
if (!function_exists('get_dir')) {
    function get_dir() {
        return direction();
    }
}
if (!function_exists('get_dir_css')) {
    function get_dir_css() {
        return direction() == 'rtl' ? 'right' : 'left';
    }
}
/***********************************************************************************/
