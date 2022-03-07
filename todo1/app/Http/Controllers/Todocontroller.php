<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Requests\TodoRequest;

class Todocontroller extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function index(Request $request){
        $items = DB::table('todo_items')
            ->where('is_deleted',0)
            ->orderby('expiration_date')
            ->orderby('id')
            ->get();

        $data = [
            'today' => date('Y-m-d'),
            'items'=> $items,
        ];
        return view('todo.index',$data);
    }
    /**
     * @param TodoRequest $request FormRequest
     * @return void
     */
    
     public function create(TodoRequest $request){
         $param = [
             'expiration_date' => $request->expiration_date,
             'todo_item' =>$request->todo_item,
             'created_at' => date('Y/m/d H:i:s'),
             'updated_at' => date('Y/m/d H:i:s'),
         ];
         DB::table('todo_items')->insert($param);

         return redirect('/');
     }

     /**
      * @param Request $request
      * @return void
      */
    public function edit(Request $request){

        $item = DB::table('todo_items')->where('id',$request->id)->get();

        return view('todo.update', ['item' => $item[0]]);
    }

    /** 
    * @param TodoRequest $request
    * @return void
    */

    public function update(TodoRequest $request)
    {
        $param = [
            'expiration_date' => $request->expiration_date,
            'todo_item' => $request->todo_item,
            'is_completed' => isset($request->is_completed) ? 1 : 0,
            'is_deleted' => isset($request->is_deleted) ? 1 : 0,
            'updated_at' => date('Y/m/d H:i:s'),
        ];

        DB::table('todo_items')->where('id',$request->id)->update($param);

        return redirect('/');
    }

}
