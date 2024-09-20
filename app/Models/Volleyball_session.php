<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volleyball_session extends Model
{
    use HasFactory;
    public function getData(){     
        $data = file_get_contents("C:\Users\Jimmy Lu\Desktop\爬蟲\data.json");
        return json_decode($data, true);;
    }
}
