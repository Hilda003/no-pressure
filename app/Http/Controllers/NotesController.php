<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $notes;
    public function index()
    {
        //
        $this->notes = new Notes();
    
            
        $notes = $this->notes->all()->toArray();
        return array_reverse($notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $newNotes = new Notes; 
            $newNotes->title = $request->input('title');
            $newNotes->description = $request->input('description');
            $newNotes->save();
    
            return response()->json($newNotes, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create note', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        //
        $notes = $this->notes->find($notes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $note = Notes::find($id);
        
        if($note) {
            $note->title = $request->input('title');
            $note->description = $request->input('description');
            $note->updated_at = Carbon::now();
            $note->save();
            
            return $note;
        }
    
        return response()->json(['message' => 'Note not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $note = Notes::find($id);
    if($note) {
        $note->delete();
        return response()->json(['message' => 'Note successfully deleted'], 200);
    }

    return response()->json(['message' => 'Note not found'], 404);
}
}
