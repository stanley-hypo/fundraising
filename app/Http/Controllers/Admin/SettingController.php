<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    public function __construct()
    {
    }

    //saving icon
    public function index()
    {
//        $result = Setting::all();

        $setting['icon'] = Setting::where("key", "icon")->first()?->value??'';
        $setting['app_name'] = Setting::where("key", "app_name")->first()?->value??'';

        return response(['setting'=>$setting], 200);
//        $icon_setting = Setting::where("key", "agency_icon")->first();
//        if(empty($icon_setting)){
//            Setting::set("agency_icon", url("images/blank.png"));
//            $icon_setting = Setting::where("key", "agency_icon")->first();
//        }
//        $icon = null;
//        $media = $icon_setting->getMedia('agency_icon'.config("app.name"));
//        $icon_height  = $icon_width = 125;
//        if(!empty($media[0])){
//            $icon = $media[0];
//            if(!empty($icon)){
//                $icon_height = 125;
//                $icon_width = $icon->custom_properties['width']/$icon->custom_properties['height']*$icon_height;
//            }
//        }



//        $school_session_settings = Setting::get("school_session_settings", []);
    }

    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'app_name' => 'required|max:100',
            'icon' => 'file',
        ]);

        if ($validator->fails()) {
            return response([ 'success' => false, 'message' => 'Validate Failed '.$validator->errors() ], 422);
        }

        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            $icon_setting = Setting::where("key", "icon")->first();
            if(empty($icon_setting)){
                Setting::set("icon", url("images/blank.png"));
                $icon_setting = Setting::where("key", "icon")->first();
            }
            $icon_setting->clearMediaCollection('icon');

            $imagedetails = getimagesize($_FILES['icon']['tmp_name']);
            $width = $imagedetails[0];
            $height = $imagedetails[1];

            if($icon_setting->addMediaFromRequest('icon')->usingName('icon')
                ->withCustomProperties(
                    ['uploadedby'=>auth()->user()->username, 'width'=>$width, 'height'=>$height]
                )
                ->toMediaCollection('icon', 'media')){
                $public_path = public_path();
                $url =  str_replace($public_path, "", $icon_setting->getMedia('icon')[0]->getPath());
                Setting::set("icon", $url);
            }
        }

        Setting::set('app_name', $request->get('app_name', ''));

        return response([ 'success' => true, 'message' => 'Update Success!' ], 200);

    }

//    sample
//    public function update_setting(Request $request)
//    {
//        $this->validate($request, [
//            'agency_icon' => 'file',
//            'pre_configured_days' => 'integer',
//        ]);
//
//        if($request->hasFile('agency_icon') && $request->file('agency_icon')->isValid()){
//            $icon_setting = Setting::where("key", "agency_icon")->first();
//            if(empty($icon_setting)){
//                Setting::set("agency_icon", url("images/blank.png"));
//                $icon_setting = Setting::where("key", "agency_icon")->first();
//            }
//            $icon_setting->clearMediaCollection('agency_icon'.config("app.name"));
//
//            $imagedetails = getimagesize($_FILES['agency_icon']['tmp_name']);
//            $width = $imagedetails[0];
//            $height = $imagedetails[1];
//
//            if($icon_setting->addMediaFromRequest('agency_icon')->usingName('agency_icon'.config("app.name"))
//                ->withCustomProperties(
//                    ['uploadedby'=>auth()->user()->e_name, 'width'=>$width, 'height'=>$height]
//                )
//                ->toMediaCollection('agency_icon'.config("app.name"), 'media')){
//                $url = $icon_setting->getMedia('agency_icon'.config("app.name"))[0]->getFullUrl();
//                Setting::set("agency_icon", $url);
//            }
//        }
//
//        Setting::set('pre_configured_days', $request->get("pre_configured_days", ''));
//        Setting::set('link_privacy_policy', $request->get("link_privacy_policy", ''));
//        Setting::set('link_terms', $request->get("link_terms", ''));
//
//        $POST_consent_form = $request->get('consent_form', []);
//        $consent_form = Setting::get("consent_form", []);
//        foreach($consent_form as $k=>$item){
//            if(!empty($POST_consent_form[$k])){
//                $consent_form[$k]['active'] = 1;
//            }else{
//                $consent_form[$k]['active'] = 0;
//            }
//        }
//
//        Setting::set('consent_form', $consent_form);
//
//        $POST_consent_form = $request->get('case_form', []);
//        Setting::set('case_form', $POST_consent_form);
//
//        Setting::set('session', $request->get("session", ''));
//
//        Setting::set('school_session_settings', $request->get("school_session_settings", []));
//
//        Setting::set('working_hour', $request->get("working_hour", ''));
//        return redirect()->route('configuration')
//            ->with('success','Configuration Updated Successfully');
//    }
}
