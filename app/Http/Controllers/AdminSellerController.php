<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
class AdminSellerController extends Controller
{

    public function index()
    {

        $sellers = User::where('role', 'seller')->latest()->get();


        return view('admin.sellers.index', compact('sellers'));
    }


    public function toggleStatus($id)
    {

        $seller = User::find($id);

        if($seller){

            if($seller->status == 'active'){
                $seller->status = 'inactive';
                $message = 'Seller has been Banned successfully!';
            }

            else {
                $seller->status = 'active';
                $message = 'Seller has been Activated successfully!';
            }


            $seller->save();

            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('error', 'Seller not found!');
    }
}
