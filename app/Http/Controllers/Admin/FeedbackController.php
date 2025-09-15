<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Auth;

class FeedbackController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
         if(auth()->user()->can('specific-unit')){
            $details = Feedback::with('unit')->where('unit_id',auth()->user()->unit_id)->latest()->get();
        }else{
            $details = Feedback::with('unit')->latest()->get();
        }
        return view('admin.feedback.index', compact('details'));
    }

    public function reply(Request $request)
    {
        if ($request->post()) {
            $rules = [
                'reply_feedback' => 'required',
            ];

            $messages = [
                'reply_feedback.required' => 'Reply is required',
            ];

                $message = "Feedback Reply Successfully";


            $validated = $request->validate($rules,$messages);

            DB::beginTransaction();
            try {
                $feedback = Feedback::where('id', $request->feedback_id)->first();
                $feedback->is_replied = 1;
                $feedback->save();

                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Feedback Reply');

                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.feedback.list')];
            return response($data);
        }

    }
}
