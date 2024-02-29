<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
   public function delete(Request $request){
       Attachment::where(['id' => $request->id])->delete();

       return response()->json([
           'status' => true,
           'message' => 'Record Delete Successfully'
       ]);
   }
}
