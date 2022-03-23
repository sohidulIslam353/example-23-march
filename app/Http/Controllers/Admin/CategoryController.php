<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all category showing method
    public function index()
    {
    	// $data=DB::table('categories')->get();  //query builder
    	$data=Category::all();	//eloquent ORM
    	return view('admin.category.category.index',compact('data'));
    	
    }

    //store method
    public function store(Request $request)
    {
    	$validated = $request->validate([
           'category_name' => 'required|unique:categories|max:55',
           'icon' => 'required',
       ]);

    	//query builder
    	// $data=array();
    	// $data['category_name']=$request->category_name;
    	// $data['category_slug']=Str::slug($request->category_name, '-');
    	// DB::table('categories')->insert($data);
          $slug=Str::slug($request->category_name, '-');
          $photo=$request->icon;
          $photoname=$slug.'.'.$photo->getClientOriginalExtension();
          Image::make($photo)->resize(32,32)->save('public/files/category/'.$photoname);  //image intervention
        	//Eloquent ORM
        	Category::insert([
        		'category_name'=> $request->category_name,
        		'category_slug'=> $slug,
                'home_page'=> $request->home_page,
                'icon'=> 'public/files/category/'.$photoname,
        	]);

    	$notification=array('messege' => 'Category Inserted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }

    //edit method
    public function edit($id)
    {
    	// $data=DB::table('categories')->where('id',$id)->first();
    	$data=Category::findorfail($id);
        return view('admin.category.category.edit',compact('data'));
    	//return response()->json($data);
    }

    //update method
    public function update(Request $request)
    {
      //Query Builder update
    	// $data=array();
    	// $data['category_name']=$request->category_name;
    	// $data['category_slug']=Str::slug($request->category_name, '-');
    	// DB::table('categories')->where('id',$request->id)->update($data);

     

        $slug=Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=$slug;
        $data['home_page']=$request->home_page;
        if ($request->icon) {
              if (File::exists($request->old_icon)) {
                     unlink($request->old_icon);
                }
              $photo=$request->icon;
              $photoname=$slug.'.'.$photo->getClientOriginalExtension();
              Image::make($photo)->resize(32,32)->save('public/files/category/'.$photoname); 
              $data['icon']='public/files/category/'.$photoname; 
              DB::table('categories')->where('id',$request->id)->update($data); 
              $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
              return redirect()->back()->with($notification);
        }else{
          $data['icon']=$request->old_icon;   
          DB::table('categories')->where('id',$request->id)->update($data); 
          $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
        }
    }


    //delete category method
    public function destroy($id)
    {
    	//query builder
    	   //DB::table('categories')->where('id',$id)->delete();
    	//eleqoent ORM
    	$category=Category::find($id);
    	$category->delete();

    	$notification=array('messege' => 'Category Deleted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }

    //get child category
    public function GetChildCategory($id)  //subcategory_id
    {
        $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }


    
}
