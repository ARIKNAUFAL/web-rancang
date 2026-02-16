<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\CourseSuggestion;
use App\Models\Lesson;
use App\Models\LessonAudit;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $today = Carbon::today();
        $from = $today->copy()->subDays(11);

        $activityByDate = LessonAudit::query()
            ->selectRaw("date, COUNT(*) AS total")
            ->whereBetween('date', [$from->toDateString(), $today->toDateString()])
            ->groupBy('date')
            ->pluck('total', 'date');

        $requestByDate = CourseSuggestion::query()
            ->selectRaw("date, COUNT(*) AS total")
            ->whereBetween('date', [$from->toDateString(), $today->toDateString()])
            ->groupBy('date')
            ->pluck('total', 'date');

        $trend = [];
        for ($cursor = $from->copy(); $cursor->lte($today); $cursor->addDay()) {
            $key = $cursor->toDateString();
            $trend[] = [
                'label' => $cursor->format('j M'),
                'activity' => (int) ($activityByDate[$key] ?? 0),
                'request' => (int) ($requestByDate[$key] ?? 0),
            ];
        }

        $categoryBreakdown = Category::query()
            ->leftJoin('lesson', 'lesson.category_id', '=', 'category.id')
            ->groupBy('category.id', 'category.name')
            ->orderByRaw('COUNT(lesson.id) DESC')
            ->get([
                'category.id',
                'category.name',
                DB::raw('COUNT(lesson.id) as lessons_total'),
            ]);

        $totalLessons = max(1, Lesson::count());
        $categorySummary = $categoryBreakdown->map(function ($row) use ($totalLessons) {
            return [
                'name' => $row->name,
                'lessons_total' => (int) $row->lessons_total,
                'percent' => (int) round(((int) $row->lessons_total / $totalLessons) * 100),
            ];
        });

        $recentRequests = CourseSuggestion::query()
            ->orderByDesc('id')
            ->limit(6)
            ->get(['id', 'topic', 'status', 'date']);

        $recentActivities = LessonAudit::query()
            ->orderByDesc('id')
            ->limit(6)
            ->get(['id', 'audit_action', 'date']);

        $data = [
            'title' => 'Dashboard',
            'lessons' => Lesson::count(),
            'activities' => LessonAudit::count(),
            'requests' => CourseSuggestion::where('status', 'New')->count(),
            'requests_responded' => CourseSuggestion::where('status', 'Responded')->count(),
            'requests_declined' => CourseSuggestion::where('status', 'Declined')->count(),
            'students' => Student::count(),
            'users' => Admin::count(),
            'users_active' => Admin::where('status', 'Active')->count(),
            'students_active' => Student::where('status', 'Active')->count(),
            'trend' => $trend,
            'categorySummary' => $categorySummary,
            'recentRequests' => $recentRequests,
            'recentActivities' => $recentActivities,
            'periodLabel' => $from->format('d M') . ' - ' . $today->format('d M Y'),
        ];

        return view('dashboard.index', $data);
    }


}
