<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__role index
    public function index()
    {
        $data=DB::table('users')->where('is_admin',1)->where('role_admin',1)->get();
        return view('admin.role.index',compact('data'));
    }

    //__create roll
    public function create()
    {
        return view('admin.role.create');
    }

    //__store role__//
    public function store(Request $request)
    {
        $validated = $request->validate([
           'email' => 'required|unique:users',
       ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['category']=$request->category;
        $data['product']=$request->product;
        $data['offer']=$request->offer;
        $data['order']=$request->order;
        $data['blog']=$request->blog;
        $data['pickup']=$request->pickup;
        $data['ticket']=$request->ticket;
        $data['contact']=$request->contact;
        $data['report']=$request->report;
        $data['setting']=$request->setting;
        $data['userrole']=$request->userrole;
        $data['is_admin']=1;
        $data['role_admin']=1;
        DB::table('users')->insert($data);
        $notification=array('messege' => 'Role Created!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__edit method
    public function edit($id)
    {
        $data=DB::table('users')->where('id',$id)->first();
        return view('admin.role.edit',compact('data'));
    }

    //__update method
    public function update(Request $request)
    {
        $id=$request->id;
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['category']=$request->category;
        $data['product']=$request->product;
        $data['offer']=$request->offer;
        $data['order']=$request->order;
        $data['blog']=$request->blog;
        $data['pickup']=$request->pickup;
        $data['ticket']=$request->ticket;
        $data['contact']=$request->contact;
        $data['report']=$request->report;
        $data['setting']=$request->setting;
        $data['userrole']=$request->userrole;
        DB::table('users')->where('id',$id)->update($data);
        $notification=array('messege' => 'Role Updated!', 'alert-type' => 'success');
        return redirect()->route('manage.role')->with($notification);

    }

    //__destroy__
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        $notification=array('messege' => 'Role Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


}
