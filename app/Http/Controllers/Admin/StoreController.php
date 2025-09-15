<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserBusiness;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Store;

class StoreController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $query = Store::latest()->latest();
        if (($request->type == 1 || $request->type == 2) && $request->type != null) {
            $query->where('is_active', $request->type == 2 ? 0 : 1);
        }
         if ($request->business != '') {
            $reqbusiness = $request->business;
            
            $query->WhereHas('bussiness', function ($q) use ($reqbusiness) {
                    $q->where('id', 'like', '%' . $reqbusiness . '%');
            });
        }
        if ($search = $request->search) {
            $query->where('name', 'like', "%{$search}%")
            ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('bussiness', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('full_address', $search);
        }
        $details = $query->paginate(10);
        $business = UserBusiness::all();
        return view('admin.store.index', compact('details','business'));
    }
  
}
