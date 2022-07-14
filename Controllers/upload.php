<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class upload extends Controller
{
    public function upload( Request $request){
            if(DB::table('posts')->where('name', $request['name'])->exists()){
                return redirect(route('user.upload'))->withErrors([
                    'name' => 'Такое имя уже существует!'
                ]);
            }
            if($request['youtube'] == ''){
                return redirect(route('user.upload'))->withErrors([
                    'youtube' => 'Поле не должно быть пустым!',
                ]);
            }
            if($request['onedrive'] == ''){
                return redirect(route('user.upload'))->withErrors([
                    'onedrive' => 'Поле не должно быть пустым!',
                ]);
            }
            if($request['value'] == ''){
                return redirect(route('user.upload'))->withErrors([
                    'value' => 'Поле не должно быть пустым!',
                ]);
            }
            $validateFields = $request->validate([
                'youtube' => 'url',
                'onedrive' => 'url',
                'value' => 'numeric'
            ]);
            $name = $request->input('name');
            $youtube = $request->input('youtube');
            $onedrive = $request->input('onedrive');
            $value = $request->input('value');
            $valueOf = 0;

            $data=array('name'=>$name,"video"=>$youtube,"document"=>$onedrive,"value"=>$value,"valueOf"=>$valueOf,"created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),);
            DB::table('posts')->insert($data);
            return redirect(route('user.private'))->with('message', 'Успешно!');
        return redirect(route('user.login'));
    }
}
