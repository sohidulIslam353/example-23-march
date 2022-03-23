<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all page show method
    public function index()
    {
        $page=DB::table('pages')->latest()->get();
        return view('admin.setting.page.index',compact('page'));
    }

    //page create form
    public function create()
    {
        return view('admin.setting.page.create');
    }

    //page store
    public function store(Request $request)
    {
        $data=array();
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name, '-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;
        DB::table('pages')->insert($data);
        $notification=array('messege' => 'Page Created!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //page delete
    public function destroy($id)
    {
        DB::table('pages')->where('id',$id)->delete();
        $notification=array('messege' => 'Page Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //page edit
    public function edit($id)
    {
        $page=DB::table('pages')->where('id',$id)->first();
        return view('admin.setting.page.edit',compact('page'));
    }


    //page update
    public function update(Request $request,$id)
    {
        $data=array();
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name, '-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;
        DB::table('pages')->where('id',$id)->update($data);
        $notification=array('messege' => 'Page Updated!', 'alert-type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }

}
