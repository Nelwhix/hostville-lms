<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return Inertia::render('Lessons', [
            'lessons' => $lessons
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return redirect(route('lesson.index'));
        }

        $request->validate([
            'type' => 'required',
            'lesson_content' => 'required',
            'description' => 'required',
        ]);


        $coverImage = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $coverImage = (string)Str::ulid() . "." . $file->extension();
            $file->storeAs('lessons/', $coverImage, 'public');
        }

        $video = null;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $video = (string)Str::ulid() . "." . $file->extension();
            $file->storeAs('lessons/', $video, 'public');
        }

        Lesson::create([
            'type' => $request->type,
            'short_description' => $request->description,
            'content' => $request->lesson_content,
            'cover_image' => $coverImage,
            'video_url' => $video
        ]);

        return redirect(route('lesson.index'));
    }
}
