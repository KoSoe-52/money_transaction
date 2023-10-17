<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaction;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where("role_id",2)->paginate();
        return view("users.index",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->only('name','username','password'),
            [
                'name' => ['required'],
                'username' => ['required','min:5','max:16'],
                'password' => ['required','min:5','max:10']           
            ]
        );
        if ($validate->fails()) {
            return redirect()->route('users.create')->withErrors($validate)->withInput();
        } else {
            User::create([
                "name" => $request->get("name"),
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "role_id" => 2
            ]);
            return redirect()->route('users.create')->with("status","Successfully created account");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        
    }
    public function profile($id)
    {
        $transactions = Transaction::where("user_id",$id)->orderBy("id","DESC")->get();
        $user = User::find($id);
        return view("users.profile",compact("user","transactions"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function addMoney(Request $request)
    {
        $validate = Validator::make($request->only('amount','user_id','description'), [
            'amount' => 'required',
            'user_id' => 'required',
            'description' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        } else {
            DB::beginTransaction();
            $user = User::find($request->user_id);
            try{
                $user->point = (int) ($user->point + $request->amount);
                $user->update();
                //save to transactions table
                date_default_timezone_set("Asia/Yangon");
                $transaction = Transaction::create([
                    "user_id"     => $request->user_id,
                    "amount"      => $request->amount,
                    "date"        => date("Y-m-d H:i:s"),
                    "description" => $request->description
                ]);
            }catch(ValidationException $e)
            {
                DB::rollback();
                return response()->json([
                    "status"  => false,
                    "msg"     => "Error occurred!",
                    "data" => []
                ]);
            } catch(\Exception $e)
            {
                DB::rollback();
                return response()->json([
                    "status"  => false,
                    "msg"     => "INTERNAL SERVER ERROR!",
                    "data" => []
                ]);
            } 
            //commit data
            DB::commit();   
            return response()->json([
                "status"  => true,
                "msg"     => "ငွေသွင်းခြင်းအောင်မြင်ပါသည်",
                "data" => []
            ]);
        }
    }
}
