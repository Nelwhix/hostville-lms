<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        $programs = Program::all();

        return Inertia::render('Program', [
            'programs' => $programs,
            'isAdmin' => $request->user()->hasRole('admin')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return redirect(route('program.index'));
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required'
        ]);

        $startDate = new CarbonImmutable($request->duration[0]);
        $endDate = new CarbonImmutable($request->duration[1]);
        $duration = $endDate->diffInDays($startDate);

        $fileName = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = (string)Str::ulid() . "." . $file->extension();
            $file->storeAs('programs/', $fileName, 'public');
        }

        Program::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $duration,
            'cover_image' => $fileName
        ]);

        return redirect(route('program.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
