<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        return Inertia::render('Courses', [
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return redirect(route('course.index'));
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);


        $fileName = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = (string)Str::ulid() . "." . $file->extension();
            $file->storeAs('courses/', $fileName, 'public');
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'cover_image' => $fileName
        ]);

        return redirect(route('course.index'));
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
