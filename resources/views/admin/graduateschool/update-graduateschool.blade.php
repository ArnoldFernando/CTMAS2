@php
    $courses = [
        [
            'label' => 'Academic Programs',
            'options' => [
                [
                    'value' => 'PHD-EM',
                    'text' => 'Doctor of Philosophy in Education Major in Educational Management - PHD-EM',
                    'class' => 'course-phd-em',
                ],
                [
                    'value' => 'MAENG',
                    'text' => 'Master of Arts in Education Major in English - MAENG',
                    'class' => 'course-maeng',
                ],
                [
                    'value' => 'MAED-EM',
                    'text' => 'Master of Arts Major in Educational Management - MAED-EM',
                    'class' => 'course-maed-em',
                ],
                [
                    'value' => 'MSIT',
                    'text' => 'Master of Science in Information Technology - MSIT',
                    'class' => 'course-msit',
                ],
                [
                    'value' => 'MST-MATH',
                    'text' => 'Master of Science in Teaching Major in Mathematics - MST-MATH',
                    'class' => 'course-mst-math',
                ],
            ],
            'class' => 'academic-programs',
        ],
    ];
@endphp


<x-app-layout>


    @section('content_header')
        <h1>update</h1>
    @stop
    <style>
        /* Define custom background colors for academic programs */
        .academic-programs {
            background-color: #5bc0de;
            color: #fff;
        }

        /* Define custom background colors for courses */
        .course-phd-em {
            background-color: #5cb85c;
            color: #fff;
        }

        .course-maeng {
            background-color: #f0ad4e;
            color: #fff;
        }

        .course-maed-em {
            background-color: #d9534f;
            color: #fff;
        }

        .course-msit {
            background-color: #337ab7;
            color: #fff;
        }

        .course-mst-math {
            background-color: #5bc0de;
            color: #fff;
        }
    </style>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('update.gradschool') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" placeholder="input graduate school I.D"
                            value="{{ $GradSchool_list['id'] }}" class="form-control">

                        <div class="mb-3">
                            <label for="graduateschool_id" class="form-label">Student I.D</label>
                            <input type="text" name="graduateschool_id" placeholder="input graduate school I.D"
                                value="{{ $GradSchool_list['graduateschool_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" name="name" placeholder="input student name"
                                value="{{ $GradSchool_list['name'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label">Graduate School Course</label>
                            <select required name="course" id="course" class="form-control">
                                < value="{{ $GradSchool_list['course'] }}">
                                    </option>
                                    @foreach ($courses as $college)
                                        <optgroup label="{{ $college['label'] }}" class="{{ $college['class'] }}">
                                            @foreach ($college['options'] as $course)
                                                <option value="{{ $course['value'] }}" class="{{ $course['class'] }}">
                                                    {{ $course['text'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Student Image</label>
                            <input type="file" name="image" placeholder="input student image"
                                value="{{ $GradSchool_list['image'] }}" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div id="success-message" class="alert alert-success mt-3">
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
