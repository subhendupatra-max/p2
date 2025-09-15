<?php

use App\Models\Role;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if (!function_exists('isSluggable')) {
    function isSluggable($value)
    {
        return Str::slug($value);
    }
}

if (!function_exists('pageLimit')) {
    function pageLimit($limit = NULL)
    {
        if (is_null($limit)) {
            $limitCount = 10;
        } else {
            $limitCount = $limit;
        }
        return $limitCount;
    }
}

if (!function_exists('sidebarOpen')) {
    function sidebarOpen($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }
        return $open ? 'show' : '';
    }
}

if (!function_exists('sidebarActive')) {
    function sidebarActive($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }
        return $open ? 'active' : '';
    }
}

if (!function_exists('get_content')) {
    function get_content($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        ob_start();
        curl_exec($ch);
        curl_close($ch);
        $string = ob_get_contents();
        ob_end_clean();
        return $string;
    }
}

if (!function_exists('isMobileDevice')) {
    function isMobileDevice()
    {
        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
                            |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }
}

if (!function_exists('getStatusName')) {
    function getStatusName($status)
    {
        $returnData = "In Active";
        if ($status == 1) {
            $returnData = "Active";
        } else if ($status == 3) {
            $returnData = "Deleted";
        } else if ($status == 4) {
            $returnData = "Drafted";
        }
        return $returnData;
    }
}

if (!function_exists('getDayNumber')) {
    function getDayNumber($dayName)
    {
        $days = ["sunday" => 1, "monday" => 2, "tuesday" => 3, "wednesday" => 4, "thursday" => 5, "friday" => 6, "saturday" => 7];
        $currentDay = $days[$dayName];
        return $currentDay;
    }
}

if (!function_exists('uuidtoid')) {
    function uuidtoid($uuid, $table)
    {
        $dbDetails = DB::table($table)
            ->select('id')
            ->where('uuid', $uuid)->first();

        if ($dbDetails) {
            return $dbDetails->id;
        } else {
            abort(404);
        }
    }
}
if (!function_exists('idtouuid')) {
    function idtouuid($id, $table)
    {
        $dbDetails = DB::table($table)
            ->select('uuid')
            ->where('id', $id)->first();

        if ($dbDetails) {
            return $dbDetails->uuid;
        } else {
            abort(404);
        }
    }
}

if (!function_exists('safe_b64encode')) {
    function safe_b64encode($string)
    {
        $pretoken = "";
        $posttoken = "";

        $codealphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codealphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codealphabet .= "0123456789";
        $max = strlen($codealphabet); // edited

        for ($i = 0; $i < 3; $i++) {
            $pretoken .= $codealphabet[rand(0, $max - 1)];
        }

        for ($i = 0; $i < 3; $i++) {
            $posttoken .= $codealphabet[rand(0, $max - 1)];
        }

        $string = $pretoken . $string . $posttoken;
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
}

if (!function_exists('safe_b64decode')) {
    function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        $data = base64_decode($data);
        $data = substr($data, 3);
        $data = substr($data, 0, -3);

        return $data;
    }
}

if (!function_exists('human_date')) {
    function human_date($date)
    {
        $now = Carbon::now();
        $date = Carbon::parse($date);
        return $date->diffForHumans($now);
    }
}

if (!function_exists('generateOtp')) {
    function generateOtp($digit = 4)
    {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $digit; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }
}

if (!function_exists('getRoles')) {
    function getRoles()
    {
        $data = Role::where('is_active', 1)->whereNotIn('slug', ['super-admin'])->get();
        return $data;
    }
}

if (!function_exists('countUnReadNotificationSuperAdmin')) {
    function countUnReadNotificationSuperAdmin()
    {
        $allNotificationCount = Notification::where(['is_read' => 0, 'for' => 1])->count();
        if ($allNotificationCount) {
            return $allNotificationCount;
        } else {
            return 0;
        }
    }
}
if (!function_exists('listUnReadNotificationSuperAdmin')) {
    function listUnReadNotificationSuperAdmin()
    {
        $allNotification = Notification::where(['for' => 1, 'is_read' => 0])->latest()->get();
        if ($allNotification) {
            return $allNotification;
        } else {
            return array();
        }
    }
}

if (!function_exists('getCountries')) {
    function getCountries()
    {
        $getCountries = file_get_contents(public_path('assets/json/countries.json'));
        $allCountries = json_decode($getCountries, true);
        return $allCountries['countries'];
    }
}

if (!function_exists('getStates')) {
    function getStates($countryId = null)
    {
        $getStates = file_get_contents(public_path('assets/json/states.json'));
        $allStates = json_decode($getStates, true);
        $states = $allStates['states'];

        if ($countryId !== null) {
            $states = array_filter($states, fn($state) => isset($state['country_id']) && $state['country_id'] == $countryId);
            // Re-index array if needed
            $states = array_values($states);
        }

        return $states;
    }
}

if (!function_exists('getCities')) {
    function getCities($stateId = null)
    {
        $getCities = file_get_contents(public_path('assets/json/cities.json'));
        $allCities = json_decode($getCities, true);
        $cities = $allCities['cities'];

        if ($stateId !== null) {
            $cities = array_filter($cities, fn($city) => isset($city['state_id']) && $city['state_id'] == $stateId);
            // Re-index array if needed
            $cities = array_values($cities);
        }

        return $cities;
    }
}

if (!function_exists('getCurrency')) {
    function getCurrency()
    {
        $getCurrency = file_get_contents(public_path('assets/json/currencies.json'));
        $allCurrency = json_decode($getCurrency, true);
        return $allCurrency;
    }
}

if (!function_exists('getCountryById')) {
    function getCountryById($countryId)
    {
        $countries = getCountries();
        foreach ($countries as $country) {
            if (isset($country['id']) && $country['id'] == $countryId) {
                return $country;
            }
        }
        return null;
    }
}

if (!function_exists('getStateById')) {
    function getStateById($stateId)
    {
        $states = getStates();
        foreach ($states as $state) {
            if (isset($state['id']) && $state['id'] == $stateId) {
                return $state;
            }
        }
        return null;
    }
}

if (!function_exists('getCityById')) {
    function getCityById($cityId)
    {
        $cities = getCities();
        foreach ($cities as $city) {
            if (isset($city['id']) && $city['id'] == $cityId) {
                return $city;
            }
        }
        return null;
    }
}

if (!function_exists('getCurrencyById')) {
    function getCurrencyById($currencyId)
    {
        $currencies = getCurrency();
        if (isset($currencies)) {
            foreach ($currencies as $currency) {
                if (isset($currency['id']) && $currency['id'] == $currencyId) {
                    return $currency;
                }
            }
        }
        return null;
    }
}
