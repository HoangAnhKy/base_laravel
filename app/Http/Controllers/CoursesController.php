<?php

namespace App\Http\Controllers;

use App\Library\CourseLibrary;
use App\Library\UserLibrary;
use App\Models\Courses;
use App\Http\Requests\StoreCoursesRequest;
use App\Http\Requests\UpdateCoursesRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CoursesController extends Controller
{
    private $lib_course;
    private $lib_user;

    public function __construct()
    {
        $this->lib_course = new CourseLibrary();

        $this->lib_user = new UserLibrary();
    }

    public function index()
    {
        $list_filter = $this->lib_course->getFilter();
        $list_search = $this->lib_course->getSearch();
        $condition = [];
        $contain = ["teacher"];

        $teachers = $this->lib_user->selectTeacher();

        $courses = Courses::paginateForPage($condition, $list_filter, $list_search, $contain);
        return view("Course.index", compact("courses", "teachers"));
    }

    public function create()
    {
        $teachers = $this->lib_user->selectTeacher();
        return view("Course.create", compact("teachers"));
    }

    public function store(StoreCoursesRequest $request)
    {
        if ($request->getMethod() === POST && Courses::saveDB($request->validated())) {
            return redirect()->route("courses.index")->with("success", "Save Course success");
        }
        return redirect()->route("courses.create")->with("error", "Cannot save Course");
    }

    public function edit($course = null)
    {

        if (isset($course) && is_numeric($course)) {
            $teachers = $this->lib_user->selectTeacher();
            $course = Courses::selectOne([["id", $course]]);
            return view("Course.edit", compact("teachers", "course"));
        }
        return redirect()->route("courses.index")->with("error", "Cannot find Course");
    }

    public function update(UpdateCoursesRequest $request, $course = null)
    {
        if (isset($course) && is_numeric($course) && $request->getMethod() === PUT && Courses::updateDB(["id" => $course], $request->validated())) {
            return redirect()->route("courses.index")->with("success", "Update Course success");
        }
        return redirect()->route("users.index")->with("error", "Cannot find this user");
    }

    public function delete(Request $request, $course = null)
    {
        if ($this->lib_course->delete($request, $course)) {
            return redirect()->route("courses.index")->with("success", "Delete Course success");
        }
        return redirect()->route("courses.index")->with("error", "Cannot find Course");
    }

}
