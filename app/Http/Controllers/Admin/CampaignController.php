<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('campaigns')->orderBy('id','DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                     ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<a href="#"><span class="badge badge-success">Active</span> </a>';
                        }else{
                            return '<a href="#"><span class="badge badge-danger">Inactive</span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>

                        <a href="'.route('campaign.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }

        return view('admin.offer.campaign.index');
    }

    //store campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
           'title' => 'required|unique:campaigns|max:55',
           'start_date' => 'required',
           'image' => 'required',
           'discount' => 'required',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;
        $data['month']=date('F');
        $data['year']=date('Y');
         //working with image
          $photo=$request->image;
          $slug=Str::slug($request->title, '-'); //its only for image name
          $photoname=$slug.'.'.$photo->getClientOriginalExtension();
          Image::make($photo)->resize(468,90)->save('public/files/campaign/'.$photoname);  //image intervention
        $data['image']='public/files/campaign/'.$photoname;   // public/files/brand/plus-point.jpg
        DB::table('campaigns')->insert($data);
        $notification=array('messege' => 'Campaign Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //delete method
    public function destroy($id)
    {
        $data=DB::table('campaigns')->where('id',$id)->first();
        $image=$data->image;
        if (File::exists($image)) {
             unlink($image);
        }
        DB::table('campaigns')->where('id',$id)->delete();
        $notification=array('messege' => 'Campaign Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //campaign edit method
    public function edit($id)
    {
      $data=DB::table('campaigns')->where('id',$id)->first();
      return view('admin.offer.campaign.edit',compact('data'));
    }

    //update campaign
    public function update(Request $request)
    {
        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;

        if ($request->image) {
              if (File::exists($request->old_image)) {
                     unlink($request->old_image);
                }
              $photo=$request->image;
              $photoname=$slug.'.'.$photo->getClientOriginalExtension();
              Image::make($photo)->resize(468,90)->save('public/files/campaign/'.$photoname); 
              $data['image']='public/files/campaign/'.$photoname; 
              DB::table('campaigns')->where('id',$request->id)->update($data); 
              $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
              return redirect()->back()->with($notification);
        }else{
          $data['image']=$request->old_image;   
          DB::table('campaigns')->where('id',$request->id)->update($data); 
          $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
        }
    }


}
