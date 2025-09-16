<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cms;
use App\Models\Unit;
use App\Models\Hod;
use App\Models\Menu;
use App\Models\Team;
use App\Models\Media;
use App\Models\Document;
use App\Models\Setting;
use App\Models\Aipr;
use App\Models\Section;
use App\Models\AiprMaster;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\Templete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PageController extends Controller
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
            })->where('is_active', 1)->whereRaw("FIND_IN_SET(0, menu_type)")->orderBy('position','ASC')->get();
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

    public function show(...$segments)
    {
        $segments = array_values(array_filter($segments, function($v) { return $v !== null && $v !== ''; }));
        if (isset($segments[2]) && strpos($segments[2], '/') !== false) {
            $parts = explode('/', $segments[2], 2);
            unset($segments[2]);
            array_splice($segments, 2, 0, $parts);
        }

        if (count($segments) < 3) {
            abort(404);
        }

        $lang = $segments[0] ?? 0;
        $unit = $segments[1] ?? 0;
        $slug1 = $segments[2] ?? 0;
        $slug2 = $segments[3] ?? null;
        $all_sub_menu = [];

        if($slug1 != null && $slug2 != null){
            $parent_menu = Menu::where('slug', $slug1)->whereHas('unit',function($query) use($unit){
                $query->where('slug', $unit);
            })->where('is_active',1)->first();

            $child_menu = Menu::where('parent_id', $parent_menu->id)->where('slug', $slug2)->whereHas('unit',function($query) use($unit){
                $query->where('slug', $unit);
            })->where('is_active',1)->first();
            $mainmenuslug = $parent_menu->slug ?? '';
            $all_sub_menu = Menu::where('parent_id', $parent_menu?->id)->orderBy('position','ASC')->whereHas('unit', function ($query) use ($unit) {
                    $query->where('slug', $unit);
                })->where('is_active', 1)->whereRaw("FIND_IN_SET(0, menu_type)")->get();

            $slug = $slug2;
            $menu = $child_menu;
            $main_menu = $parent_menu;
        }elseif($slug1 != null && $slug2 == null){
            $slug = $slug1;
            $menu = Menu::where('slug', $slug)->whereHas('unit',function($query) use($unit){
                $query->where('slug', $unit);
            })->where('is_active',1)->first();
            $mainmenuslug = $menu->slug ?? '';
            $main_menu = $menu;

        }else{
             abort(404);
        }
        $unit_id = Unit::where('is_active',1)->where('slug', $unit)->first()->id;
        $page = '';
        if (!$menu) {
            abort(404);
        }
         $page = '';
        if($menu->extend_to != null){
            $Extendedmenu = Templete::where('id', $menu->extend_to)->first();
            $page = $Extendedmenu->file_name ?? '';
        }

        if (!$menu) {
            abort(404);
        }


        $functionName = str_replace('-', '_', $page);

        if(!method_exists($this,$functionName)){
            $response = $this->blank($unit_id,$menu->id);
        }else{
            $response = $this->{$functionName}($unit_id,$menu->id);
        }
        $response['mainmenuslug'] = $mainmenuslug;
        $response['main_menu'] = $main_menu;
        $response['menu'] = $menu;
        $response['all_sub_menu'] = $all_sub_menu;
        $title = $lang === 'en'? ($menu->title_en ?? '') : ($menu->title_hi ?? $menu->title_en ?? '');
        $title = $title.' | '.($unit_id == 1 ? 'Directorate of Ordnance (Coordination and Services)' : $menu->unit->title_en);
        $response['title'] = $title;
        return $response;
    }

    public function sitemap($unit_id,$menu_id){
        $sitemap_menus =  Menu::whereNull('parent_id')->where('unit_id', $unit_id)->where('is_active', 1)->orderBy('position','ASC')->get();
        return view('frontend.sitemap',compact('sitemap_menus'));
    }

    public function home($unit_id,$menu_id){
        $today = date('Y-m-d');
        $banners = Banner::where('publish_date','<=',$today)->where('unit_id',$unit_id)->where(function($query) use($today){
            $query->where('expire_date','>=',$today)->orwhere('expire_date',null);
        })->where('is_active',1)->orderBy('possition','ASC')->get();

        $about_ministry = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','about-ministry');
        })->where('is_active',1)->latest()->first();

        $pm_modi_at_mann_ki_baat = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','pm-modi-at-mann-ki-baat');
        })->where('is_active',1)->latest()->first();

        $our_history = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','our-history');
        })->where('is_active',1)->latest()->first();

         $our_unit = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
         $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','our-unit');
        })->where('is_active',1)->latest()->first();

         $join_us = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
         $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','join-us');
        })->where('is_active',1)->latest()->first();

        $whats_new = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','whats-new');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->take(4)->get();


        $recent_documents = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('position','ASC')->latest()->take(4)->get();

        $explore_user_personas = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','explore-user-personas');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->take(4)->get();

        $important_links = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','important-links');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->take(10)->get();

        $advertisements = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','advertisement');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->take(10)->get();

        $testimonials = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','testimonial');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->get();

        $announcements = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','announcements');
        })->orderBy('position','ASC')->where('is_active',1)->latest()->get();

        $hod_details = Hod::where('unit_id',$unit_id)->where('is_active',1)->where('from_date','<=',date('Y-m-d'))->where(function($q){
            $q->whereNull('to_date')->orWhere('to_date','>=',date('Y-m-d'));
        })
        ->latest()->first();

        $schemes_and_services = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->whereHas('menu',function($q){
           $q->where('id',13);
        })->where('unit_id',$unit_id)->where('is_active',1)->orderBy('id','asc')->latest()->orderBy('position','ASC')->take(4)->get();

        $tenders = Document::where('is_archived',0)->whereHas('menu',function($q){
           $q->where('id',14);
        })->where('unit_id',$unit_id)->where('is_active',1)->orderBy('position','ASC')->orderBy('position','ASC')->latest()->take(4)->get();

        $vacancies = Document::where('is_archived',0)->whereHas('menu',function($q){
           $q->where('id',15);
        })->where('unit_id',$unit_id)->orderBy('position','ASC')->where('is_active',1)->orderBy('position','ASC')->latest()->take(4)->get();

        //==================== Home Page content =========================================
        return view("frontend.home", compact('announcements','testimonials','advertisements','important_links','explore_user_personas','recent_documents','whats_new','pm_modi_at_mann_ki_baat','about_ministry','banners','hod_details','our_history','join_us','our_unit','schemes_and_services','tenders','vacancies','unit_id'));
    }

    public function about_us($unit_id,$menu_id){
        $today = date('Y-m-d');
        $data['vision_statement'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','ministry-vision-statement');
        })->where('is_active',1)->latest()->first();

        $data['about_the_directorate_of_ordnance'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','about-the-directorate-of-ordnance-and-mission-and-objectives');
        })->where('is_active',1)->orderBy('position','ASC')->latest()->first();

        $data['objectives_list'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','ministry-objectives');
        })->where('view_type','0')->orderBy('position','ASC')->where('is_active',1)->latest()->get();

        $data['functions_of_ddo_description'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','ministry-functions-of-ddo');
        })->where('view_type','1')->where('is_active',1)->orderBy('position','ASC')->latest()->first();

        $data['functions_of_ddo_list'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','ministry-functions-of-ddo');
        })->where('view_type','2')->where('is_active',1)->orderBy('position','ASC')->latest()->get();

        return view('frontend.about-us',compact('data'));
    }
    public function our_history($unit_id,$menu_id)
    {
        $today = date('Y-m-d');
        $data['the_beginning_growthofindianordnance_factories_main_event_description'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','the-beginning-growth-of-indian-ordnance-factories-main-event-description');
        })->where('view_type','1')->where('is_active',1)->orderBy('position','ASC')->latest()->first();

        $data['main_event_list'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','main-events');
        })->where('view_type','0')->orderBy('position','ASC')->where('is_active',1)->latest()->get();

        $data['creation_of_description_first'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','creation-of-7-dpsus-and-directorate-of-ordnance');
        })->where('view_type','1')->where('is_active',1)->orderBy('position','ASC')->first();

        $data['creation_of_description_second'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','creation-of-7-dpsus-and-directorate-of-ordnance');
        })->where('view_type','1')->where('is_active',1)->orderBy('position','ASC')->first();

        $data['creation_of_list'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','creation-of-7-dpsus-and-directorate-of-ordnance');
        })->where('view_type','0')->orderBy('position','ASC')->where('is_active',1)->latest()->get();

        return view('frontend.our-history',compact('data'));
    }

    public function our_team($unit_id,$menu_id)
    {
        $today = date('Y-m-d');

        $data['our_team_header'] = Team::where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('show',0)->where('is_active',1)->orderBy('id','asc')->get();

        $data['our_team_list'] = Team::where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('show',1)->where('is_active',1)
            ->orderBy('designation_id','asc')
            ->orderBy('position','ASC')
            ->get()
            ->groupBy(function($item){
                return $item->designation_id;
        });

        return view('frontend.our-team',compact('data'));
    }
    public function our_directory($unit_id,$menu_id)
    {
        $today = date('Y-m-d');

        $data['our_directory_list'] = Team::where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('show',1)->where('is_active',1)
            ->orderBy('designation_id','asc')
            ->orderBy('position','ASC')
            ->get()
            ->groupBy(function($item){
                 return $item->designation_id;
        });

        return view('frontend.our-team',compact('data'));
    }

    public function our_organization($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $sort_by = request()->query('sort_by');
        $category_id = request()->query('category_id');
        $per_page = request()->query('per_page') ?? 10;
        $lang = app()->getLocale() ?? 'en';

        $today = date('Y-m-d');

        if($lang == 'en'){
        $data['our_organization'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->where(function($q) use($search,$sort_by,$per_page){
                if($search){
                    $q->where('title_en','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_en','asc');
                            break;
                        case '2':
                            $q->orderBy('title_en','desc');
                            break;

                    }
                }
            })->orderBy('position','ASC')->paginate($per_page);
        }else{
        $data['our_organization'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->where(function($q) use($search,$sort_by,$per_page){
                if($search){
                    $q->where('title_hi','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_hi','asc');
                            break;
                        case '2':
                            $q->orderBy('title_hi','desc');
                            break;

                    }
                }
            })->orderBy('position','ASC')->paginate($per_page);
        }
        return view('frontend.our-organization',compact('data'));
    }

    public function whats_new($unit_id,$menu_id)
    {
        $today = date('Y-m-d');
        $data['whats_new'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
            $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('position','ASC')->get();
        return view('frontend.whats-new',compact('data'));
    }
    public function schemes_and_services($unit_id,$menu_id)
    {
        $today = date('Y-m-d');
        $data['schemes_and_services'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
            $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->where('publish_date','<=',$today)->whereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('position','ASC')->get();
        return view('frontend.schemes-and-services',compact('data'));
    }
    public function tenders($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $sort_by = request()->query('sort_by');
        $category_id = request()->query('category_id');
        $per_page = request()->query('per_page') ?? 10;
        $lang = app()->getLocale() ?? 'en';

        $today = date('Y-m-d');

        if($lang == 'en'){
           $data['tenders'] = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$category_id,$per_page){
                if($search){
                    $q->where('title_en','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_en','asc');
                            break;
                        case '2':
                            $q->orderBy('title_en','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;
                        case '5':
                            $q->orderBy('expiry_date','asc');
                            break;
                        case '6':
                            $q->orderBy('expiry_date','desc');
                            break;
                    }
                }
                if($category_id){
                    $q->where('category_id',$category_id);
                }
            })->paginate($per_page);
        }else{
           $data['tenders'] = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$category_id,$per_page){
                if($search){
                    $q->where('title_hi','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_hi','asc');
                            break;
                        case '2':
                            $q->orderBy('title_hi','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;
                        case '5':
                            $q->orderBy('expiry_date','asc');
                            break;
                        case '6':
                            $q->orderBy('expiry_date','desc');
                            break;
                    }
                }
                if($category_id){
                    $q->where('category_id',$category_id);
                }
            })->paginate($per_page);
        }


        $categories = Category::get();
        return view('frontend.tenders',compact('data','categories'));
    }
    public function vacancies($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $sort_by = request()->query('sort_by');
        $category_id = request()->query('category_id');
        $per_page = request()->query('per_page') ?? 10;
        $lang = app()->getLocale() ?? 'en';

        $today = date('Y-m-d');

        if($lang == 'en'){
            $data['vacancies'] = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$category_id,$per_page){
                if($search){
                    $q->where('title_en','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_en','asc');
                            break;
                        case '2':
                            $q->orderBy('title_en','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;
                        case '5':
                            $q->orderBy('expiry_date','asc');
                            break;
                        case '6':
                            $q->orderBy('expiry_date','desc');
                            break;
                    }
                }
                if($category_id){
                    $q->where('category_id',$category_id);
                }
            })->paginate($per_page);
        }else{
            $data['vacancies'] = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$category_id,$per_page){
                if($search){
                    $q->where('title_hi','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_hi','asc');
                            break;
                        case '2':
                            $q->orderBy('title_hi','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;
                        case '5':
                            $q->orderBy('expiry_date','asc');
                            break;
                        case '6':
                            $q->orderBy('expiry_date','desc');
                            break;
                    }
                }
                if($category_id){
                    $q->where('category_id',$category_id);
                }
            })->paginate($per_page);
        }


        $categories = Category::get();
        return view('frontend.vacancies',compact('data','categories'));
    }


    public function contact_us($unit_id,$menu_id)
    {
        $today = date('Y-m-d');
        $contact = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
             $q->where('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('position','ASC')->first();

        return view('frontend.contact-us',compact('contact'));
    }
    public function rti($unit_id,$menu_id)
    {
        $today = date('Y-m-d');
       $data['right_to_information'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','right-to-information-act-2005');
        })->where('view_type',1)->where('is_active',1)->orderBy('position','ASC')->first();

        $data['right_to_information_list'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','right-to-information-act-2005');
        })->where('view_type',2)->where('is_active',1)->orderBy('position','ASC')->get();

        $data['rti_act'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','rti-act');
        })->where('is_active',1)->orderBy('position','ASC')->first();

        $data['download_rti_act'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','download-rti-act');
        })->where('is_active',1)->orderBy('position','ASC')->first();

        $data['for_filing_online_rti_application_or_appeal'] = Cms::where('approve_status','1')->where('is_archived',0)->where('review_status','1')->where(function($q) use($today){
        $q->orwhere('publish_date','<=',$today)->orwhere('expire_date','>=',$today)->orwhereNull('expire_date'); })->where('menu_id',$menu_id)->where('unit_id',$unit_id)->whereHas('section',function($query){
            $query->where('slug','for-filing-online-rti-application-or-appeal');
        })->where('is_active',1)->orderBy('position','ASC')->first();

        return view('frontend.rti',compact('data'));
    }

    public function image($unit_id,$menu_id)
    {
        $media_images = Media::with('images')->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('id','asc')->get();
       return view('frontend.image', compact('media_images'));
    }

    public function mediaShow($lang = null,$unit = null,$uuid = null)
    {

        $media_image = Media::with('images')->where('uuid', $uuid)->where('is_active', 1)->first();
        $mainmenuslug = $media_image?->menu?->parent?->slug ?? '';
        $main_menu = $media_image?->menu ?? '';
        $menu = $media_image?->menu ?? '';
        return view('frontend.media-show', compact('media_image','mainmenuslug','main_menu','menu'));
    }

    public function video($unit_id,$menu_id)
    {
        $media_video = Media::where('menu_id',$menu_id)->where('unit_id',$unit_id)->where('is_active',1)->orderBy('id','asc')->get();
       return view('frontend.video', compact('media_video'));
    }

    public function report($unit_id,$menu_id)
    {
         $search = request()->query('search');
        $sort_by = request()->query('sort_by');
        $per_page = request()->query('per_page') ?? 10;
        $lang = app()->getLocale() ?? 'en';

        $today = date('Y-m-d');

        if($lang == 'en'){
           $reportDatas = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$per_page){
                if($search){
                    $q->orwhere('title_en','like',"%$search%")->orwhere('file_language','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_en','asc');
                            break;
                        case '2':
                            $q->orderBy('title_en','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;

                    }
                }

            })->paginate($per_page);
        }else{
           $reportDatas = Document::where('is_archived',0)->where('menu_id',$menu_id)->where('unit_id',$unit_id)->where(function($q) use($today){
            $q->orwhere('public_date','<=',$today)->orwhere('expiry_date','>=',$today)->orwhereNull('expiry_date'); })->where('is_active',1)->orderBy('position','ASC')->where(function($q) use($search,$sort_by,$per_page){
                if($search){
                    $q->orwhere('title_hi','like',"%$search%")->orwhere('file_language','like',"%$search%");
                }
                if($sort_by){
                    switch($sort_by){
                        case '1':
                            $q->orderBy('title_hi','asc');
                            break;
                        case '2':
                            $q->orderBy('title_hi','desc');
                            break;
                        case '3':
                            $q->orderBy('public_date','asc');
                            break;
                        case '4':
                            $q->orderBy('public_date','desc');
                            break;
                    }
                }

            })->paginate($per_page);
        }
        return view('frontend.report', compact('reportDatas'));
    }

    public function iofs_officers_list($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $grade = request()->query('grade');
        $unit = request()->query('unit');
        $per_page = request()->query('per_page') ?? 10;

        $iofs_officers = Aipr::where('unit_id', $unit_id)->where('menu_id', $menu_id)
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')->orwhere('unit', 'like', '%' . $search . '%')->orwhere('grade', 'like', '%' . $search . '%')->orwhere('doj_iofs', 'like', '%' . $search . '%');
        })
        ->when($grade, function ($query, $grade) {
            $query->where('grade', $grade);
        })
        ->when($unit, function ($query, $unit) {
            $query->where('unit', $unit);
        })
        ->where('is_active', 1)->paginate($per_page);
        $grades = Aipr::where('unit_id', $unit_id)->where('menu_id', $menu_id)->where('is_active', 1)->pluck('grade')->unique();
        $units = Aipr::where('unit_id', $unit_id)->where('menu_id', $menu_id)->where('is_active', 1)->pluck('unit')->unique();
       return view('frontend.iofs-officers-list', compact('iofs_officers','grades','units'));
    }
    public function aipr($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $grade = request()->query('grade');
        // dd( $grade);
        $unit = request()->query('unit');
        $per_page = request()->query('per_page') ?? 10;
        $aiprs = AiprMaster::where('unit_id', $unit_id)->where('menu_id', $menu_id)
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')->orwhere('pno', 'like', '%' . $search . '%')->orwhere('grade', 'like', '%' . $search . '%');
        })
        ->when($grade, function ($query, $grade) {
            $query->where('grade', $grade);
        })->where('is_approved', 1)
        ->where('is_active', 1)->paginate($per_page);
        $grades = AiprMaster::where('unit_id', $unit_id)->where('menu_id', $menu_id)->where('is_active', 1)->pluck('grade')->unique();
       return view('frontend.aipr',compact('aiprs','grades'));
    }
    public function retired_iofs_officers_list($unit_id,$menu_id)
    {
        $search = request()->query('search');
        $grade = request()->query('grade');
        $per_page = request()->query('per_page') ?? 10;

        $retired_iofs_officers = Aipr::where('unit_id', $unit_id)->where('menu_id', $menu_id)
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')->orwhere('pno', 'like', '%' . $search . '%')->orwhere('dpsu', 'like', '%' . $search . '%')->orwhere('grade', 'like', '%' . $search . '%')->orwhere('dor', 'like', '%' . $search . '%')->orwhere('doj_iofs', 'like', '%' . $search . '%');
        })
        ->when($grade, function ($query, $grade) {
            $query->where('grade', $grade);
        })
        ->where('is_active', 1)->paginate($per_page);
        $grades = Aipr::where('unit_id', $unit_id)->where('menu_id', $menu_id)->where('is_active', 1)->pluck('grade')->unique();
       return view('frontend.retired-iofs-officers-list', compact('retired_iofs_officers','grades'));
    }

    public function blank(){
        return view('frontend.blank');
    }

    public function ourUnit(){
        $mainmenuslug = 'home';
        $our_units = Unit::whereNot('slug', 'main')->where('is_active',1)->get();
        return view('frontend.our-unit', compact('our_units','mainmenuslug'));
    }
    public function details($lang,$unit,$uuid){
        $cms = Cms::where('uuid',$uuid)->where('is_active',1)->first();
        if(!$cms){
            abort(404);
        }
        $menu = Menu::where('id',$cms->menu_id)->where('is_active',1)->first();
        $parent_menu = '';
        $mainmenuslug = $menu->slug;
        if($menu->parent_id != null){
            $parent_menu = Menu::where('id',$menu->parent_id)->where('is_active',1)->first();
            $mainmenuslug = $parent_menu->slug;
        }
        if($menu->slug == 'home'){
            $menu = '';
        }
        $title = __('messages.details').' | '.($cms->unit_id == 1 ? 'Directorate of Ordnance (Coordination and Services)' : $cms->unit->title_en);
        return view('frontend.details',compact('cms','menu','parent_menu','mainmenuslug','title'));
    }

    public function search(Request $request){
        $mainmenuslug = '';
        $today = date('Y-m-d');
        $unit = session('unit', 'main');
        $lang = app()->getLocale();
        $unit_id = Unit::where('slug', $unit)->first()->id;
        $cms_search_result = '';
        $document_result = '';
        $teams_result = '';
        $search = '';
        if($request->search){
            $search = $request->search;


            $cms = Cms::where('is_active',1)
                ->where(function($query) use($search){
                    $query->where('title_en','LIKE',"%{$search}%")->orWhere('title_hi','LIKE',"%{$search}%")
                    ->orWhere('description_en','LIKE',"%{$search}%")->orWhere('description_hi','LIKE',"%{$search}%");
                })->where('approve_status','1')->where('is_archived',0)->where('review_status','1')
                ->where(function($q) use($today){
                    $q->where(function($query) use($today){
                        $query->where('publish_date','<=',$today)->where('expire_date','>=',$today);
                    })->orWhere(function($query) use($today){
                        $query->where('publish_date','<=',$today)->whereNull('expire_date');
                    });
                })->where('unit_id',$unit_id)->orderBy('position','ASC')->latest()->get();

        if( !empty($cms) && count($cms) > 0){
            $cms_search_result .= '<div class="row">';
            foreach($cms as $item) {

                $route = $item->menu->slug;
                $href = localized_route('page.show', [$route]);
                if ($item->menu->children->count() > 0) {
                    $route = $item->menu->children->first()->slug;
                    $href = localized_route('page.subpage.show', [
                        $item->menu->slug,
                        $route,
                    ]);
                }

                if($lang == 'hi'){
                    $title = $item->title_hi;
                    $description = $item->description_hi;
                    $menu = $item->menu?->title_hi;
                }else{
                    $title = $item->title_en;
                    $description = $item->description_en;
                    $menu = $item->menu?->title_en;
                }
                $cms_search_result .= '<div class="col-lg-6 col-md-6 col-12">';
                $cms_search_result .= '<h5 class="search-heading">'.$menu.'</h5>';
                $cms_search_result .= '<div class="our-organization-row-item">';
                $cms_search_result .= '<div class="d-flex">';
                $cms_search_result .= '<div>';
                $cms_search_result .= '<h4>' . $title . '</h4>';
                $description = Str::limit($description, 100);
                if (Str::length($description) < Str::length($item->description_en)) {
                    $description .= ' ...';
                }
                $cms_search_result .= '<p>' . $description . '</p>';
                $cms_search_result .= '</div>';
                $cms_search_result .= '<div class="text-right">';
                $cms_search_result .= '<a href="'.$href.'">';
                $cms_search_result .= '<img style="height: 25px;" src="' . asset('frontend') . '/assets/images/key-offering-icon.png" alt="...">';
                $cms_search_result .= '</a>';
                $cms_search_result .= '</div>';
                $cms_search_result .= '</div>';
                $cms_search_result .= '</div>';
                $cms_search_result .= '</div>';
            }
            $cms_search_result .= '</div>';
        }

        $document = Document::where('is_archived',0)->where('is_active',1)
        ->where(function($query) use($search){
            $query->where('title_en','LIKE',"%{$search}%")->orWhere('title_hi','LIKE',"%{$search}%");
        })->where(function($q) use($today){
            $q->where(function($query) use($today){
                $query->where('public_date','<=',$today)->where('expiry_date','>=',$today);
            })->orWhere(function($query) use($today){
                $query->where('public_date','<=',$today)->whereNull('expiry_date');
            });
        })->where('unit_id',$unit_id)->orderBy('position','ASC')->latest()->get();


        if( !empty($document) && count($document) > 0){
            $document_result .= '<div class="out-team-table">';
            $document_result .= '<div class="out-team-table-table">';
            $document_result .= '<div class="row out-team-table-tr table-heading">';
            $document_result .= '<div class="col-5 p-0">';
            $document_result .= '<p class="out-team-table-th">';
            $document_result .= 'Title';
            $document_result .= '</p>';
            $document_result .= '</div>';
            $document_result .= '<div class="col-3 p-0">';
            $document_result .= '<p class="out-team-table-th">';
            $document_result .= 'Published Date & End Date';
            $document_result .= '</p>';
            $document_result .= '</div>';
            $document_result .= '<div class="col-2 p-0">';
            $document_result .= '<p class="out-team-table-th">';
            $document_result .= 'Type/Size';
            $document_result .= '</p>';
            $document_result .= '</div>';
            $document_result .= '<div class="col-2 p-0"></div>';
            $document_result .= '</div>';
            foreach ($document as $item) {
                $route = $item->menu->slug;
                $href = localized_route('page.show', [$route]);
                if ($item->menu->children->count() > 0) {
                    $route = $item->menu->children->first()->slug;
                    $href = localized_route('page.subpage.show', [
                        $item->menu->slug,
                        $route,
                    ]);
                }

                if($lang == 'hi'){
                    $title = $item->title_hi;
                    $description = $item->description_hi;
                    $menu = $item->menu?->title_hi;
                }else{
                    $title = $item->title_en;
                    $description = $item->description_en;
                    $menu = $item->menu?->title_en;
                }
                $document_result .= '<div class="row out-team-table-tr">';
                        $document_result .= '<div class="out-team-table-heading">';
            $document_result .= '<h4>'. $menu.'</h4>';
            $document_result .= '</div>';
                $document_result .= '<div class="col-5 out-team-table-td">';
                $document_result .= '<p>';
                $document_result .= $title;
                $document_result .= '</p>';
                $document_result .= '</div>';
                $document_result .= '<div class="col-3 out-team-table-td">';
                $document_result .= '<p>';
                $document_result .= date('d/m/Y', strtotime($item->public_date)).' to '.date('d/m/Y', strtotime($item->expiry_date));
                $document_result .= '</p>';
                $document_result .= '</div>';
                $document_result .= '<div class="col-2 out-team-table-td">';
                $document_result .= '<p>';
                $document_result .= '<img src="'.asset('frontend').'/assets/images/pdf.png" alt="...">';
                $document_result .= '('.$item->file_size.')';
                $document_result .= '</p>';
                $document_result .= '</div>';
                $document_result .= '<div class="col-2 out-team-table-td">';
                $document_result .= '<a class="out-team-table-td-btn" targer="_blank" href="'.$item->image_path.'">';
                $document_result .= '<img src="'.asset('frontend').'/assets/images/eye.png" alt="">';
                $document_result .= 'View';
                $document_result .= '</a>';
                $document_result .= '</div>';
                $document_result .= '</div>';
            }
            $document_result .= '</div>';
            $document_result .= '</div>';
        }

        }

        session()->put('search', $search);

        return view('frontend.search',compact('mainmenuslug','cms_search_result','search','document_result'));
    }
    public function feedback($unit_id,$menu_id){
        $menu_details = Menu::where('is_active',1)->where('id', $menu_id)->first();
        $mainmenuslug = $menu_details->parent_id != null ? $menu_details->parent->slug : $menu_details->slug;
        return view('frontend.feedback', compact('mainmenuslug','unit_id'));
    }

    public function feedbackstore(Request $request){
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->mobile = $request->mobile;
        $feedback->feedback = $request->feedback;
        $feedback->unit_id = $request->unit_id;
        if( $request->feedback_type == 'Other Issue'){
            $feedback->feedback_type = $request->other_issue;
        }else{
            $feedback->feedback_type = $request->feedback_type;
        }
        $feedback->save();
        return response()->json([
        'status' => true,
        'message' => 'Feedback saved successfully.',
        'data' => '',
        'url' => "{{ localized_route('page.show', ['feedback']) }}",
    ]);
    }


}


