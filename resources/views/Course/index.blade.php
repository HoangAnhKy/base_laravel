@extends("Layout.default")

@section("content")
    <div>
        <h1>Course</h1>
    </div>

    <div class="row">
        <div class="col-6">
            <a href="{{ route("courses.create") }}" class="btn-primary btn">Add Course <i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="col-6">
            <form class="row" id="form-search-course">
                <div class="offset-3 col-4">
                    <select class="form-select" name="teacher_search" id="teacher_search">
                        <option value="-1" @if(!isset($_GET["teacher_search"]) ||$_GET["teacher_search"] === "-1" ) disabled selected @endif>select Teacher</option>
                        @if(!empty($teachers))
                            @foreach( $teachers as $teacher)
                                <option value="{{$teacher->id}}"
                                        @if(isset($_GET["teacher_search"]) && (int)$_GET["teacher_search"] === $teacher->id) selected @endif >
                                    {{ $teacher->name_user }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class=" col-4">
                    <input class="form-control" name="key_search" id="search" placeholder="search..."
                           value="{{ old("key_search", $_GET['key_search'] ?? "") }}">
                </div>
                <button class="btn btn-success col-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>

    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name Course</th>
                <th>Teacher</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($courses))
                @foreach($courses as  $key => $course)
                    <tr>
                        <td>{{ $key + 1 + ((($_GET["page"] ?? 1) - 1) * LIMIT) }}</td>
                        <td>{{ $course->name_course }}</td>
                        <td>{{ $course->teacher->name_user }}</td>
                        <td>{{ LIST_STATUS[$course->status ?? ACTIVE] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

@push("js")
    <script>
        $(document).ready(function () {
            function handleSearchForm() {
                $("#form-search-course").submit();
            }

            $("#teacher_search").change(handleSearchForm)
        });
    </script>
@endpush

