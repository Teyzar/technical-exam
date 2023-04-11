<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NotesRequest;
use App\Models\Notes;
use App\Traits\HttpResponses;

class NotesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noteList = Notes::orderBy('created_at', 'desc')->get();

        return $this->success(data: $noteList, message: 'Notes List');
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
    public function store(NotesRequest $request)
    {
        $request->validated($request->all());

        $note = Notes::create([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return $this->success(data: $note, message: 'Note created succesfully');
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

        $note = Notes::find($id);

        if ($note == null) return $this->error(data : $note, message: 'No data found', code: 404); 
        
        if ($note != null) {
            $note->update($request->all());
        }

        return $this->success(data: $note, message: 'Note '. $id . ' updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Notes::findOrFail($id);

        $note->delete();

        return $this->success(data: $note, message: 'Note '. $id . ' deleted succesfully');
    }
}
