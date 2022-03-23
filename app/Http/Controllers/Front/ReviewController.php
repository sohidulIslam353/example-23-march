<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //review store
    public function store(Request $request)
    {
        $validated = $request->validate([
           'rating' => 'required',
           'review' => 'required',
       ]);

        $check=DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if ($check) {
           $notification=array('messege' => 'Already you have a review with this product !', 'alert-type' => 'error');
           return redirect()->back()->with($notification); 
        }
        //query builder
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d-m-Y');
        $data['review_month']=date('F');
        $data['review_year']=date('Y');
        DB::table('reviews')->insert($data);

        $notification=array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    //wqrite a review for website
    public function write()
    {
        return view('user.review_write');
    }

    //store website review
    public function StoreWebsiteReview(Request $request)
    {
        $check=DB::table('wbreviews')->where('user_id',Auth::id())->first();
        if ($check) {
           $notification=array('messege' => 'Review already exist !', 'alert-type' => 'success');
           return redirect()->back()->with($notification);
        }

        $data=array();
        $data['user_id']=Auth::id();
        $data['name']=$request->name;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d , F Y');
        $data['status']=0;
        DB::table('wbreviews')->insert($data);
        $notification=array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);


    }

    

}
