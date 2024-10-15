<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanRequestController extends Controller
{
    function index()
    {
        return view("landing");
    }
    function loanrequest()
    {   
        $data  = Loan::orderByDesc("id")->get();
        return view("loan.loanRequest",compact('data'));
    }
    function submitLoanRequest(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'LoanAmount'=> 'required|numeric'
            ]);
            $insert = new Loan();
            $insert->name = trim($request->name);
            $insert->amount = trim($request->LoanAmount);
            $insert->save();
           return redirect()->back()->with("success","Loan Request Submitted Successfully.");
        } catch (Exception $e) {
           return redirect()->back()->with("error",$e->getMessage());
        }
    }
    function accessDenied()
    {
        return view("error.403");
    }
}
