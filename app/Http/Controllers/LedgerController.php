<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        date_default_timezone_set("Asia/Yangon");
        $date = date("Y-m-d");
        $ledgers = Ledger::where("date",$date)->get();
        return view("ledger.index",compact("ledgers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("ledger.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $validate = Validator::make(
            $request->only('date'),
            [
                'date' => ['required'],
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        } else {
            DB::beginTransaction();
            try{
                if(count($request->title)> 0)
                { 
                    foreach($request->title as $key=>$p)
                    {
                        
                        if($request->hasFile('image')) {
                            $file = $request->file('image_url')[$key];
                            $fileName = date('d-m-Y').'_'.time().'_'.$file->getClientOriginalName();
                            $filePath = "/storage/".$file->storeAs('vouchers', $fileName, 'public');
                        }else
                        {
                            $filePath = NULL;
                        }
                        
                        $totalPurchase[] = $request->price[$key];
                        Ledger::create([
                            "title" => $request->title[$key],
                            "price" => $request->price[$key],
                            "date"=> date("Y-m-d"),
                            "time" => date("H:i:s"),
                            "user_id" => Auth::user()->id,
                            "image" => $filePath
                        ]);
                    }
                    $data = User::find(Auth::user()->id);
                    $data->point = $data->point - array_sum($totalPurchase);
                    $data->update();
                }else
                {
                    return response()->json([
                        "status"  => false,
                        "msg"     => "အချက်အလက်ထည့်သွင်းပါ",
                        "data" => []
                    ]);
                }
            }catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    "status"  => false,
                    "msg"     => "မှားနေပါသည်",
                    "data" => []
                ],500);
            }
            DB::commit();
            return response()->json([
                "status"  => true,
                "msg"     => "စာရင်းသွင်းခြင်းအောင်မြင်ပါသည်",
                "data" => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
}
