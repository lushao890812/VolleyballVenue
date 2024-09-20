<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
class VenueController extends Controller
{
    //
    public function getVenue(){
        $venue=new Venue;
        return $venue->getVenue();
    }
    public function addVenue(Request $request){
        $venue=new Venue;
        $data=[
            'name'=>'',
            'address'=>'',
            'lat'=>null,
            'lng'=>null,
            'url'=>''
        ];
        if (isset($request->name) && !empty($request->name) &&
            isset($request->address) && !empty($request->address) &&
            isset($request->lat) && !empty($request->lat) &&
            isset($request->lng) && !empty($request->lng) 
        ){
            $data['name']=$request->name;
            $data['address']=$request->address;
            $data['lat']=$request->lat;
            $data['lng']=$request->lng;
            $data['url']=$request->url;
            $venue->addVenue($data);
     
        } else {
            // 返回错误消息，提示缺少字段
            return response()->json(['error' => 'All fields are required.'], 400);
        }
    }
    public function updateVenue(Request $request){
        $venue=new Venue;
        $data=[
            'id'=>'',
            'name'=>'',
            'address'=>'',
            'lat'=>null,
            'lng'=>null,
            'url'=>''
        ];
        if (isset($request->id) && !empty($request->id) &&
            isset($request->name) && !empty($request->name) &&
            isset($request->address) && !empty($request->address) &&
            isset($request->lat) && !empty($request->lat) &&
            isset($request->lng) && !empty($request->lng) 
        ){
            $data['id']=$request->id;
            $data['name']=$request->name;
            $data['address']=$request->address;
            $data['lat']=$request->lat;
            $data['lng']=$request->lng;
            $data['url']=$request->url;
            $venue->updateVenue($data);
     
        } else {
            // 返回错误消息，提示缺少字段
            return response()->json(['error' => 'All fields are required.'], 400);
        }
    }
    public function deleteVenue(Request $request){
        $venue=new Venue;
        if(isset($request->id) && !empty($request->id)){
            $id=$request->id;
            $venue->deleteVenue($id);
        }
    }
}
