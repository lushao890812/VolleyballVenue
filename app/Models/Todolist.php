<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todolist extends Model
{
    use HasFactory;


    public function addEvent($event){
        if($event!=''){
            DB::insert("insert into todolists set event='".$event."'");
        }
        
    }
    public function updateEvent($number,$event){
        if(isset($number) && $event !=''){
            DB::update("update todolists set event='".$event."'where number='".(int)$number."'");
        }
    }
    public function deleteEvent($number){
        if(isset($number)){
            DB::delete("delete from todolists where number='".(int)$number."'");
        }
    }
    
    public function getEvent(){     
        $data=DB::select("select * from todolists  ORDER BY number");
        return $data;
    }

}