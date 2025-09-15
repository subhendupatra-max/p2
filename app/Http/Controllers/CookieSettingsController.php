<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Section;


class CookieSettingsController extends Controller
{
     public function __construct()
    {
        view()->composer('*', function (View $view) {
            $unit = session('unit');
            $website_setting = Setting::whereHas('unit', function ($query) use ($unit) {
                $query->where('slug', $unit);
            })->first();
            $website_menus = Menu::whereNull('parent_id')->whereHas('unit', function ($query) use ($unit) {
                $query->where('slug', $unit);
            })->orderBy('position','ASC')->where('is_active', 1)->whereRaw("FIND_IN_SET(0, menu_type)")->get();
            $footer_menus = Menu::whereNull('parent_id')->whereHas('unit', function ($query) use ($unit) {
                $query->where('slug', $unit);
            })->orderBy('position','ASC')->where('is_active', 1)->whereRaw("FIND_IN_SET(1, menu_type)")->get();
            $UnitWiseSectionPermission = Section::select('slug')->whereHas('unit', function($q) use($unit) {
                $q->where('slug', $unit);
            })->where('is_active',1)->get()->pluck('slug')->toArray();

            $view->with('UnitWiseSectionPermission', $UnitWiseSectionPermission);
            $view->with('website_setting', $website_setting);
            $view->with('website_menus', $website_menus);
            $view->with('footerMenus', $footer_menus);
        });
        // session()->forget('search');

    }
    public function index()
    {
        $mainmenuslug = '';
        return view('frontend.cookie-settings', compact('mainmenuslug'));
    }


public function save(Request $request)
{
// dd($request->all());
    // Validate the input
    $validator = Validator::make($request->all(), [
        'optional_cookies' => 'nullable|in:1,on,true,false,0',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid cookie preference.',
        ], 400);
    }

    // Determine cookie value
    if (is_null($request->input('optional_cookies'))) {
         $optionalCookies = false;
        Cookie::queue(Cookie::forget('optional_cookies'));
    } else {
        $optionalCookies = $request->input('optional_cookies') === '1' || $request->input('optional_cookies') === 'on' || $request->input('optional_cookies') === true;

        // Set encrypted and secure cookie
        Cookie::queue(Cookie::make(
            'optional_cookies',
            $optionalCookies ? '1' : '0',
            60 * 24 * 30, // 30 days
            '/',
            null,
            true,  // Secure
            true,  // HttpOnly
            false, // Raw
            'Strict' // SameSite
        ));
    }

    // Store in session
    session(['optional_cookies' => $optionalCookies]);

    // Optional: Log for auditing
    Log::info('Cookie preference saved', [
        'user_id' => auth()->id() ?? null,
        'ip' => $request->ip(),
        'consent_given' => $optionalCookies,
        'timestamp' => now()->toDateTimeString()
    ]);

    // Success response
    return response()->json([
        'status' => true,
        'message' => 'Preferences saved successfully.',
        'data' => '',
    ]);
}




}
