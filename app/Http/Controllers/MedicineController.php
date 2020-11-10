<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Medicine;
use Psy\Exception\ErrorException;

class MedicineController extends Controller
{
    public function indexUser()
    {
        $medicine = Medicine::orderBy('name', 'asc')->get();
        $data = [
            'medicine' => $medicine
        ];

        return view('SearchObat')->with('data', $data);
    }

    public function showMedicine($id)
    {
        $medicine = Medicine::find($id);

        return view('viewMedicine')->with('medicine',$medicine);
    }

    public function searchMedicine(Request $request)
    {
        $medicine = Medicine::where('name','LIKE','%'.$request->nama.'%')->orderBy('name','asc')->paginate(5);
        $data = [
            'medicine' => $medicine
        ];

        return view('listMedicine')->with('data',$data);
    }

    public function viewMedicine($id)
    {
        $medicine = Medicine::find($id);
        $data = [
            'medicine' => $medicine
        ];
        return view ('viewMedicine')->with('data',$data);
    }
}
