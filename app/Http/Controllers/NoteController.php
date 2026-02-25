<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Http\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $data = Note::query()
            ->with([
                'user',
            ])
            ->where('title', 'LIKE', '%' . $request->search . '%')
            ->when(auth()->user()->hasRole('user'), function ($query) {
                return $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('note/Index', [
            'data' => $data,
            'can' => [
                'create_note' => auth()->user()->can('create note'),
                'edit_note' => auth()->user()->can('edit note'),
                'delete_note' => auth()->user()->can('delete note'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Note::class);
        return Inertia::render('note/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        Gate::authorize('create', Note::class);
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        Note::create($data);

        Inertia::flash('message', 'Data created successfully!');

        return to_route('note.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', Note::class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        return Inertia::render('note/Edit', [
            'data' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);

        $data = $request->validated();

        $note->update($data);

        Inertia::flash('message', 'Data updated successfully!');

        return to_route('note.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return Inertia::flash('message', 'Data deleted successfully!')->back();
    }
}
