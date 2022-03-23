<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //seo page show method
    public function seo()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }

    //update seo method
    public function seoUpdate(Request $request,$id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;
        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('messege' => 'SEO Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //smtp setting page
    public function smtp()
    {
        // $smtp=DB::table('smtp')->first();
        return view('admin.setting.smtp');
    }

    //smtp update
    public function smtpUpdate(Request $request){
        // $data=array();
        // $data['mailer']=$request->mailer;
        // $data['host']=$request->host;
        // $data['port']=$request->port;
        // $data['user_name']=$request->user_name;
        // $data['password']=$request->password;
        // DB::table('smtp')->where('id',$id)->update($data);
        // $notification=array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);

        foreach($request->types as $key=>$type){
            $this->updateEnvFile($type, $request[$type]);
        }
        $notification=array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function updateEnvFile($type, $val)
    {
        $path=base_path('.env');
        if (file_exists($path)) {
            $val='"'.trim($val).'"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, 
                        str_replace($type.'="'.env($type).'"', $type.'='.$val,
                            file_get_contents($path)
                        )
                    );
            }else{
                file_put_contents($path,file_get_contents($path).$type.'='.$val);
            }
        }
    }




    //website setting
    public function website()
    {
        $setting=DB::table('settings')->first();
        return view('admin.setting.website_setting',compact('setting'));
    }

    //website setting update
    public function WebsiteUpdate(Request $request,$id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        if ($request->logo) {  //jodi new logo die thake
              $logo=$request->logo;
              $logo_name=uniqid().'.'.$logo->getClientOriginalExtension();
              Image::make($logo)->resize(320,120)->save('public/files/setting/'.$logo_name); 
            $data['logo']='public/files/setting/'.$logo_name;  
        }else{   //jodi new logo na dey
            $data['logo']=$request->old_logo;
        }

        if ($request->favicon) {  //jodi new logo die thake
              $favicon=$request->favicon;
              $favicon_name=uniqid().'.'.$favicon->getClientOriginalExtension();
              Image::make($favicon)->resize(32,32)->save('public/files/setting/'.$favicon_name); 
              $data['favicon']='public/files/setting/'.$favicon_name;  
        }else{   //jodi new logo na dey
            $data['favicon']=$request->old_favicon;
        }

        DB::table('settings')->where('id',$id)->update($data);
        $notification=array('messege' => 'Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);


    }

    //__payment gateway
    public function PaymentGateway()
    {
        $aamarpay=DB::table('payment_gateway_bd')->first();
        $surjopay=DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl=DB::table('payment_gateway_bd')->skip(2)->first();
        return view('admin.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }

    //__aamarpay update
    public function AamarpayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__update surjopay
    public function SurjopayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

}
