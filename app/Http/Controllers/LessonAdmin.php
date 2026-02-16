<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\LessonAudit;
use App\Models\Roadmap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LessonAdmin extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Website / Lesson Manager',
            'lessons' => Lesson::all()
        ];

        return view('admin.lesson.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Website / Lesson Manager / Add Lesson',
            'categories' => Category::all()
        ];

        return view('admin.lesson.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'thumbnail' => 'required|file|mimes:png,jpg,jpeg',
            'description' => 'nullable|string',
            'link' => 'required|string|max:200|unique:lesson,link',
            'category_id' => 'nullable|exists:category,id'
        ]);

        $lesson = new Lesson();
        $lesson->name = $request->name;
        $lesson->admin_id = Session()->get('admin_id');
        if ($request->has('description')) {
            $lesson->description = $request->description;
        }
        $lesson->link = $request->link;
        if ($request->has('category_id')) {
            $lesson->category_id = $request->category_id;
        }
        $hashName = $request->thumbnail->hashName();
        $lesson->thumbnail = $request->thumbnail->move('images/lessons/', $hashName);
        $lesson->save();

        $roadmap = new Roadmap();
        $roadmap->lesson_id = $lesson->id;
        $roadmap->category_id = $lesson->category_id;
        $roadmap->save();

        $lessonAudit = new LessonAudit();
        $lessonAudit->admin_id = Session()->get('admin_id');
        $lessonAudit->audit_action = 'Insert: '.$lesson->name;
        $lessonAudit->date = Carbon::now();
        $lessonAudit->save();

        return redirect()->route('admin.lesson.index');
    }

    public function show(Request $request, Lesson $lesson)
    {
        $data = [
            'title' => 'Website / Lesson Manager / Detail Lesson',
            'lesson' => $lesson
        ];

        return view('admin.lesson.show', $data);
    }

    public function edit(Request $request, Lesson $lesson)
    {
        $data = [
            'title' => 'Website / Detail Lesson / Edit Lesson',
            'lesson' => $lesson,
            'categories' => Category::all()
        ];

        return view('admin.lesson.edit', $data);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'thumbnail' => 'nullable|file|mimes:png,jpg,jpeg',
            'description' => 'nullable|string',
            'link' => 'required|string|max:200|unique:lesson,link,'.$lesson->id,
            'category_id' => 'nullable|exists:category,id'
        ]);

        $lesson->name = $request->name;
        $lesson->admin_id = Session()->get('admin_id');
        if ($request->has('description')) {
            $lesson->description = $request->description;
        }
        $lesson->link = $request->link;
        if ($request->has('category_id')) {
            $lesson->category_id = $request->category_id;

            $roadmap = Roadmap::where('lesson_id', $lesson->id)->first();
            $roadmap->category_id = $lesson->category_id;
            $roadmap->save();
        }
        if ($request->has('thumbnail')) {
            if (file_exists($lesson->thumbnail)) {
                unlink($lesson->thumbnail);
            }

            $hashName = $request->thumbnail->hashName();
            $lesson->thumbnail = $request->thumbnail->move('images/lessons/', $hashName);
        }
        $lesson->save();

        $lessonAudit = new LessonAudit();
        $lessonAudit->admin_id = Session()->get('admin_id');
        $lessonAudit->audit_action = 'Update: '.$lesson->name;
        $lessonAudit->date = Carbon::now();
        $lessonAudit->save();

        return redirect()->route('admin.lesson.index');
    }

    public function removeCategory(Request $request, Lesson $lesson)
    {
        $lesson->category_id = null;
        $lesson->save();

        return redirect()->route('admin.lesson.show', $lesson->id);
    }

    public function destroy(Request $request, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('admin.lesson.index');
    }

    public function roadmap(Category $category = null)
{
    $data = [
        'title' => 'Website / Roadmap',
        'roadmaps' => $category ? Roadmap::where('category_id', $category->id)->get() : []
    ];

    return view('admin.lesson.roadmap', $data);
}

}
