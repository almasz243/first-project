<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class give extends Controller
{
    public function give(Request $request){
        if($request['money'] == ''){
            return redirect(route('user.page'))->withErrors([
                'email' => 'Такой email уже существует!'
            ]);
        }
        $money = $request->input('money');
        $id = $request->input('id');
        $valueOf = DB::table('posts')->where('id', $id)->value('valueOf');
        $intmoney = (int)$money;
        $summary = $intmoney + $valueOf;
        $summaryint = (int)$summary;
        DB::table('posts')->where('id', $id)->update(['valueOf' => $summaryint]);
        return back();
    }
}
