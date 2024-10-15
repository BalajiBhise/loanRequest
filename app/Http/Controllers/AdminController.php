<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        $data = Loan::orderByDesc("id")->get();
        return view("Admin.viewRequest", compact('data'));
    }
    function updateStatus(Request $request)
    {
        try {
            $loan = Loan::find($request->id);
            $loan->status = $request->status;
            $loan->save();
            return response()->json(["success" => "Status Updated Successfully."]);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }
    function deleterequest(Request $request)
    {
        try {
            $loan = Loan::where("id", $request->id)->delete();
            return response()->json(["success" => "Loan Request Deleted Successfully."]);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }
}
