<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\donationformdatas;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function store(Request $request)
    {

        $request -> validate([
            'donationType'=>'required|string',
            'donationAmount'=>'required|string',
            'fullname'=>'required|string',
            'title'=>'string',
            'mobileAreacode'=>'required|string',
            'mobile'=>'required|string',
            'email'=> 'required|string',
            'address1'=> 'string',
            'address2'=> 'string',
            'address3'=> 'string',
            'area'=> 'string',
            'district'=> 'string',
            'remark'=> 'string',
            'receipt'=> 'required|boolean',
            'interested'=> 'required|boolean',
            'paymentMethod'=> 'required|string',

        ]);
        $formData = new donationformdatas;
        $formData->donationType= $request->donationType;
        $formData->donationAmount= $request->donationAmount;
        $formData->fullname= $request->fullname;
        $formData->title= $request->title;
        $formData->mobileAreacode= $request->mobileAreacode;
        $formData->mobile= $request->mobile;
        $formData->email= $request->email;
        $formData->address1= $request->address1;
        $formData->address2= $request->address2;
        $formData->address3= $request->address3;
        $formData->area= $request->area;
        $formData->district= $request->district;
        $formData->remark= $request->remark;
        $formData->receipt= $request->receipt;
        $formData->interested= $request->interested;
        $formData->paymentMethod= $request->paymentMethod;
        $formData->save();



        //return response([ 'success' => true, 'message' => 'Add form Success!' ], 200);
        return response(donationformdatas::All());

    }
}
