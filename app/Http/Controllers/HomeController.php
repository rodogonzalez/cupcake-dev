<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Store;
use App\Models\UserCupCake;

use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function claim_cup_cake(Request $request){
        
        // only registered users can claim cup cakes
        if (\Auth::guest()){
            dd("You must be autenticated");

        }

        //validations  date_claim , store
        $this->validate($request, [
            'store_id' => ['required'],
            'date_claim' => ['required'],
        ]);


        $user = \Auth::user();
        $store= Store::find($request->input('store_id'));
        
        
        // check if there is already a cupcake for this user
        $cup_cake = $user->CupCakes()->where('store_id',$request->input('store_id'))->first();
        if ( is_null($cup_cake) ) {

            $cup_cake = $user->CupCakes()->create([
                                                    'store_id'=>$request->input('store_id'),
                                                    'programmed_date_to_pick'=>$request->input('date_claim'),
                                                    'was_retired'=>false,
                                                ] );

            $result_text="Your cup cake is reserved to be picked at " . $request->input('date_claim');

        } else{

            $result_text="Already claimed a cup cake for this Store";

            
        }

        return view('cup-cake-request-result',compact('result_text'));
        

    }
    public function user_cup_cakes(){


        // only registered users can claim cup cakes
        if (\Auth::guest()){
            
            return abort(403, 'You must be autenticated.');

        }
        $user_stores= \Auth::user()->CupCakes()->get();
        //dd($user_stores);

        //return "Vista de lista";
        return view('profile-cakes', compact('user_stores'));
        
    }

    /* this function returns the list of all stores availables */
    public   function get_stores(){

        $answer_back=[];

        $stores= Store::where('is_eligible',true)->get();

        foreach($stores as $store){           
            
            // get used cupcakes
            $total_used= UserCupCake::where('store_id',$store->id)->count();
            $user_claim_this_store=0;
            
            if (!\Auth::guest()){
                $user_claim_this_store=UserCupCake::where('user_id',\Auth::user()->id)->count();
    
            }           

            $total_available=  $store->stock_available-$total_used;

            if ($total_available>0&&$user_claim_this_store==0){

                array_push($answer_back, [
                    'id'=>$store->id, 
                    'name'=>$store->name, 
                    'g_lat'=>$store->address_lat, 
                    'g_lng'=>$store->address_lng, 
                    'limit_stock'=>$total_available, 

                 ]);

            }

        }
        
        return response()->json($answer_back);

    }

}
