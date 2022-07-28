<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\subscription;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function store(Request $request)
    {

        $request -> validate([
            'type'=>'required|string',
            'amount'=>'required|string',
            'name'=>'required|string',
            'title'=>'string',
            'contact_number'=>'required|string',
            'email'=> 'required|string',
            'address'=> 'string',
            'area'=> 'string',
            'district'=> 'string',
            //'remark'=> 'string',
            'receipt'=> 'required|boolean',
            'interested'=> 'required|boolean',
            'payment_method'=> 'required|string',

        ]);
        $formData = new subscription;
        $formData->type= $request->type;
        $formData->amount= $request->amount;
        $formData->name= $request->name;
        $formData->title= $request->title;
        $formData->contact_number= $request->contact_number;
        $formData->email= $request->email;
        $formData->address= $request->address;
        $formData->area= $request->area;
        $formData->district= $request->district;
        //$formData->remark= $request->remark;
        $formData->receipt= $request->receipt;
        $formData->interested= $request->interested;
        $formData->payment_method= $request->payment_method;
        $formData->save();



        //return response([ 'success' => true, 'message' => 'Add form Success!' ], 200);
        return response(subscription::All());

    }
}
