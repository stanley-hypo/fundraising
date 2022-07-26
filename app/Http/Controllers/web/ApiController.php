<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        return response([ 'success' => true, 'message' => 'Add User Success!' ], 200);
    }
}
