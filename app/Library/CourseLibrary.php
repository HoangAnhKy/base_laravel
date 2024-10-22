<?php

namespace App\Library;

use App\Models\Users;
use Illuminate\Validation\Rule;

class CourseLibrary
{
    public function getFilter()
    {
        $filter = [];

        if (isset($_GET["teacher_search"]) && $_GET["teacher_search"] !== "-1") {
            $filter["CONTAIN"]["teacher"] = ["id", $_GET["teacher_search"]];
        }

        return $filter;
    }

    public function getSearch(){
        $search = [];
        if (!empty($_GET["key_search"])){
            $key_search = $_GET["key_search"];
            $search["AND"] = [
            ];
            $search["OR"] = [
                ["courses.name_course", "like", "%$key_search%"]
            ];
        }
        return $search;
    }

}
