<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ToDoRequest;
use App\Models\ToDo;
use App\Traits\HttpResponses;

class ToDoController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todoList = ToDo::orderBy('created_at', 'desc')->get();

        return $this->success(data: $todoList, message: 'Todo List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoRequest $request)
    {
        //
        $request->validated($request->all());

        $todo = ToDo::create([
            'entry' => $request->entry,
        ]);

        return $this->success(data: $todo, message: 'todo created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = ToDo::find($id);

        if ($todo == null) return $this->error(data : $todo, message: 'No data found', code: 404); 

        $data = array();

        $data = [
            'isDone' => $request->isDone
        ];

        if ($todo != null) {
            if(array_key_exists('entry', $request->all())) $data['entry'] = $request->entry;

            $todo->update($data);
        }

        return $this->success(data: $todo, message: 'Todo '. $id . ' updated succesfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = ToDo::findOrFail($id);

        $todo->delete();

        return $this->success(data: $todo, message: 'Todo '. $id . ' deleted succesfully');
    }
}
