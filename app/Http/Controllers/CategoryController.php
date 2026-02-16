<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->LessonAudit = DB::table('lesson_audit');
    }

    public function index()
    {
        $data = [
            'title' => 'Category',
            'category' => Category::all()
        ];
        return view('category.category', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Category',
        ];

        return view('category.category-create', $data);
    }

    public function last_admin_audit()
    {
        $lastAdminAudit = DB::table('lesson_audit')->orderBy('admin_id', 'DESC')->limit(1)->first();

        if ($lastAdminAudit === null) {
            $num = 1;
        } else {
            $num = substr($lastAdminAudit->admin_id, 1, strlen($lastAdminAudit->admin_id));
            $num++;
        }

        if ($num < 10) {
            $category_id = 'A000' . $num;
        } else if ($num > 9 and $num < 100) {
            $category_id = 'A00' . $num;
        } else if ($num > 99 and $num < 1000) {
            $category_id = 'A0' . $num;
        } else {
            $category_id = 'A' . $num;
        }

        return $category_id;
    }

    public function store(Request $request)
    {
        $lastCategory = Category::orderBy('id', 'DESC')->limit(1)->first();

        if ($lastCategory === null) {
            $num = 1;
        } else {
            $num = substr($lastCategory->id, 1, strlen($lastCategory->id));
            $num++;
        }

        if ($num < 10) {
            $category_id = 'C000' . $num;
        } else if ($num > 9 and $num < 100) {
            $category_id = 'C00' . $num;
        } else if ($num > 99 and $num < 1000) {
            $category_id = 'C0' . $num;
        } else {
            $category_id = 'C' . $num;
        }

        $data = [
            'id' => $category_id,
            'name' => $request->name,
            'audit_action' => 'Insert : ' . $request->name . ' category'
        ];

        Category::create($data);

        $this->LessonAudit->insert([
            'admin_id' => session()->get('admin_id'),
            'audit_action' => $data['audit_action'],
            'date' => Carbon::now()->toDateString(),
        ]);

        return redirect()->to('category')->with('success', 'New Category Added!');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Category',
            'category' => Category::find($id)
        ];

        return view('category.category-edit', $data);
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);

        $data = [
            'name' => $request->name,
            'audit_action' => 'Update : from ' . $category->name . ' to ' . $request->name . ' category'
        ];

        $category->update($request->all());

        $this->LessonAudit->insert([
            'admin_id' => session()->get('admin_id'),
            'audit_action' => $data['audit_action'],
            'date' => Carbon::now()->toDateString(),
        ]);

        return redirect()->to('category')->with('success', 'Category Updated!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $auditAction = 'Delete : ' . $category->name . ' category';

            // Delete the category
            $category->delete();

            // Log the action in the audit table
            $this->LessonAudit->insert([
                'admin_id' => session()->get('admin_id'),
                'audit_action' => $auditAction,
                'date' => Carbon::now()->toDateString(),
            ]);

            return redirect()->to('category')->with('success', 'Category Deleted Successfully!');
        }

        return redirect()->to('category')->with('error', 'Category Not Found!');
    }
}
