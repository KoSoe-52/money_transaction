<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
//use Barryvdh\DomPDF\Facade\Pdf;
//use Dompdf\Dompdf;
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
        $titleDate = date("d F, Y")." ဝယ်ယူသည့်စာရင်း";
        $ledgers = Ledger::where("date",$date)->get();
        return view("ledger.index",compact("ledgers","titleDate","date"));
    }
    
    public function monthReport(Request $request)
    {
         $monthly_report = Ledger::select("ledgers.date",DB::raw("SUM(price) as price"))
                            ->groupBy(["ledgers.date"])
                            ->orderBy("date","DESC")  
                            ->paginate(30);
        return view("ledger.monthly_report",compact("monthly_report"));
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
                        
                        if($request->hasFile('image_url')) {
                            $file = $request->file('image_url')[$key];
                            $fileName = date('d-m-Y').'_'.time().'_'.$file->getClientOriginalName();
                            $filePath = "storage/".$file->storeAs('vouchers', $fileName, 'public');
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
    public function print($date)
    {
        date_default_timezone_set("Asia/Yangon");
        $date = date("Y-m-d",strtotime($date));
        $ledgers = Ledger::where("date",$date)->get();
        $totalPoint = User::find(2);
        $point = $totalPoint->point;
        $reprotDate =  date("d F, Y") ." ကုန်ကျငွေစာရင်း";
       return view("ledger.invoice",compact("ledgers","point","reprotDate"));
       // Create a PDF using Dompdf
        //$pdf = PDF::loadView('ledger.invoice', compact("ledgers","point","reprotDate"));
        // $pdf = PDF::loadView('ledger.print');

        // // Set the paper size and orientation
        // $pdf->setPaper('A4', 'portrait');
        // // Stream the PDF to the browser
        // return $pdf->stream('document.pdf');
        
    }
    /**
     * Display the specified resource.
     */
    public function show($date)
    {
        date_default_timezone_set("Asia/Yangon");
        $date = date("Y-m-d",strtotime($date));
        $titleDate = date("d F, Y",strtotime($date)) ." ဝယ်ယူသည့်စာရင်း";
        $ledgers = Ledger::where("date",$date)->get();
        return view("ledger.index",compact("ledgers","titleDate","date"));
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
