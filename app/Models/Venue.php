<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // 添加这行
class Venue extends Model
{
    use HasFactory;
    public function addVenue($data){
        if($data!=null){
            DB::insert("insert into Venue (name,address,lat,lng,url,created_at,updated_at)
                Values(?,?,?,?,?,?,?)",
                [
                    $data['name'],
                    $data['address'],
                    $data['lat'],
                    $data['lng'],
                    $data['url'],
                    now(),
                    now()
                ]
            );
        }
    }
    public function getVenue(){
        $data= DB::select("select * from Venue");
        return $data;
    }
 
    public function updateVenue($data) {
        if ($data != null) {
            DB::update("UPDATE venue SET name = ?, address = ?, lat = ?, lng = ?, url = ? WHERE id = ?", [
                $data['name'],
                $data['address'],
                $data['lat'],
                $data['lng'],
                $data['url'],
                $data['id']
            ]);
        }
    }
    public function deleteVenue($id){
        if(isset($id)){
            DB::delete("delete from venue where id=?",[
                $id
            ]);
        }
    }
    
}
