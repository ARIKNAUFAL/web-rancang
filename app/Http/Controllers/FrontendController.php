<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CourseSuggestion;
use App\Models\Feedback;
use App\Models\Lesson;
use App\Models\MyLearning;
use App\Models\ProfileStudent;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get(['id', 'name']);
        $category = $categories->first();
        $defaultCategoryId = $category?->id;

        $data = [
            // Avoid ORDER BY RANDOM() full-scan on production DB.
            'recommendation' => Lesson::query()
                ->orderByDesc('id')
                ->limit(12)
                ->get(['id', 'name', 'thumbnail']),
            'categories' => $categories,
            'lessons' => $defaultCategoryId
                ? Lesson::query()
                    ->where('category_id', $defaultCategoryId)
                    ->orderByDesc('id')
                    ->limit(24)
                    ->get(['id', 'category_id', 'name', 'thumbnail'])
                : collect(),
            'category' => $category
        ];

        if (Session::get('student_log')) {
            $data['student'] = Student::where('id', Session::get('student_id'))->first();
            $data['student_profile'] = ProfileStudent::where('student_id', Session::get('student_id'))->first();
        }

        $view = view('frontend.index', $data);
        if (!Session::get('student_log')) {
            return response($view)->header('Cache-Control', 'public, s-maxage=120, stale-while-revalidate=600');
        }

        return $view;
    }

    public function category(Category $category)
    {
        $categories = Category::orderBy('name', 'asc')->get(['id', 'name']);
        $data = [
            'category' => $category,
            'recommendation' => Lesson::query()
                ->orderByDesc('id')
                ->limit(12)
                ->get(['id', 'name', 'thumbnail']),
            'categories' => $categories,
            'lessons' => Lesson::query()
                ->where('category_id', $category->id)
                ->orderByDesc('id')
                ->limit(24)
                ->get(['id', 'category_id', 'name', 'thumbnail'])
        ];

        if (Session::get('student_log')) {
            $data['student'] = Student::where('id', Session::get('student_id'))->first();
            $data['student_profile'] = ProfileStudent::where('student_id', Session::get('student_id'))->first();
        }

        $view = view('frontend.index', $data);
        if (!Session::get('student_log')) {
            return response($view)->header('Cache-Control', 'public, s-maxage=120, stale-while-revalidate=600');
        }

        return $view;
    }

    public function lesson(Lesson $lesson)
    {
        $data = [
            'lessons' => Lesson::query()
                ->where('id', '!=', $lesson->id)
                ->orderByDesc('id')
                ->limit(16)
                ->get(['id', 'name', 'thumbnail']),
            'feedback' => Feedback::where('lesson_id', $lesson->id)->get(),
            'lesson' => $lesson,
            'enrolled' => MyLearning::where('student_id', Session::get('student_id'))->where('lesson_id', $lesson->id)->count() > 0
        ];

        if (Session::get('student_log')) {
            $data['student'] = Student::where('id', Session::get('student_id'))->first();
            $data['student_profile'] = ProfileStudent::where('student_id', Session::get('student_id'))->first();
        }

        return view('frontend.lesson', $data);
    }

    public function storeFeedback(Request $request, Lesson $lesson)
    {
        $feedback = new Feedback();
        $feedback->lesson_id = $lesson->id;
        $feedback->student_id = Session::get('student_id');
        $feedback->comment = $request->comment;
        $feedback->date_comment = Carbon::now();
        $feedback->save();

        return redirect()->route('lesson.show', $lesson->id);
    }

    public function storeRequest(Request $request)
    {
        $data = new CourseSuggestion();
        $data->student_id = Session::get('student_id');
        $data->topic = $request->topic;
        $data->message = $request->reason;
        $data->date = Carbon::now();
        $data->save();

        return redirect()->route('index');
    }

    public function requestStatus(Request $request)
    {
        $data = [
            'request' => CourseSuggestion::where('student_id', Session::get('student_id'))->orderBy('date', 'desc')->get()
        ];

        return view('frontend.request-status', $data);
    }

    public function profile()
    {
        $data = [
            'student' => Student::where('id', Session::get('student_id'))->first(),
            'student_profile' => ProfileStudent::where('student_id', Session::get('student_id'))->first()
        ];

        return view('frontend.profile', $data);
    }

    public function editProfile()
    {
        $data = [
            'student' => Student::where('id', Session::get('student_id'))->first(),
            'student_profile' => ProfileStudent::where('student_id', Session::get('student_id'))->first()
        ];

        return view('frontend.edit-profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:15',
            'last_name' => 'required|string|max:15',
            'address' => 'required|string|max:30',
            'phone_number' => 'required|string|max:13',
            'gender' => 'required|in:Male,Female',
            'photo_profile' => 'nullable|image|mimes:jpg,png,jpeg',
            'email' => 'required|email|unique:student,email,'.Session::get('student_id')
        ]);

        $profile = ProfileStudent::findOrFail(Session::get('student_id'));
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->address = $request->address;
        $profile->phone_number = $request->phone_number;
        $profile->gender = $request->gender;

        if ($request->has('photo_profile')) {
            $filename = $request->photo_profile->hashName();
            $profile->photo_profile = $request->photo_profile->move('images/profiles/', $filename);
        }

        $profile->save();

        $student = Student::findOrFail(Session::get('student_id'));
        $student->email = $request->email;
        $student->save();

        return redirect()->route('profile');
    }

    public function destroyProfile()
    {
        $student = Student::findOrFail(Session::get('student_id'));
        $student->forceDelete();

        Session()->forget('student_id');
        Session()->forget('student_log');

        return redirect()->route('index');
    }

    public function addLesson(Lesson $lesson)
    {
        $student_id = Session::get('student_id');
        $count = MyLearning::where('student_id', $student_id)->where('lesson_id', $lesson->id)->count();

        if ($count<=0) {
            $class = new MyLearning();
            $class->student_id = $student_id;
            $class->lesson_id = $lesson->id;
            $class->enroll_date = Carbon::now();
            $class->save();
        }

        return redirect()->route('lesson.show', $lesson->id);
    }

    public function myLearning(Request $request)
    {

        if ($request->has('category_id')) {
            $query = MyLearning::whereHas('lesson', function ($query) use ($request) {
                return $query->where('category_id', '=', $request->category_id);
            });
        } else {
            $query = MyLearning::with('lesson')->where('student_id', Session::get('student_id'));
        }

        $data = [
            'categories' => Category::all(),
            'lessons' => $query->get()
        ];

        return view('frontend.my-learning', $data);
    }

    public function notifications()
    {
        $data = [
            'request' => CourseSuggestion::where('student_id', Session::get('student_id'))->where('status', 'Responded')->get()
        ];
        return view('frontend.notifications', $data);
    }
}
