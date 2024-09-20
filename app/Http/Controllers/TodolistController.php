<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;

class TodolistController extends Controller
{
    
    public function getEvent(){
        $todolist=new Todolist;
        $data=$todolist->getEvent();
        return json_encode($data);
    }
    public function deleteEvent(Request $request){
        $todolist=new Todolist;
        if(isset($request->number) && !empty($request->number)){
            $number=$request->number;
            $todolist->deleteEvent($number);
            return $this->getEvent();
        }
    }
    public function updateEvent(Request $request){
        $todolist=new Todolist;
        if(isset($request->number) && !empty($request->number)){
            if(isset($request->event) && !empty($request->event)){
                $event=$request->event;
                $number=$request->number;
                $data=$todolist->updateEvent($number,$event);
                return $this->getEvent();
            }
        }
    }
    public function addEvent(Request $request){
        $todolist=new Todolist;

        if(isset($request->event) && !empty($request->event)){
            $event=$request->event;
            $todolist->addEvent($event);
            return $this->getEvent();
        }
        
    }
}
