<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volleyball_session;
class Volleyball_sessionController extends Controller
{
    public function getData(){
        $Volleyball_session=new Volleyball_session;
        $data=$Volleyball_session->getData();
        return $data;
    }
}
