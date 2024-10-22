<?php

namespace App\Http\Controllers;

use App\Library\CourseLibrary;
use App\Library\UserLibrary;
use App\Models\Courses;
use App\Http\Requests\StoreCoursesRequest;
use App\Http\Requests\UpdateCoursesRequest;

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

    public function create(){
        $teachers = $this->lib_user->selectTeacher();
        return view("Course.create", compact("teachers"));
    }
    public function store(StoreCoursesRequest $request){
        if ($request->getMethod() === POST && Courses::saveDB($request->validated())){
            return redirect()->route("courses.index")->with("success", "Save Course success");
        }
        return redirect()->route("courses.create")->with("error", "Cannot save Course");
    }

}
