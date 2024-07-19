@php
    $courses = [
        [
            'label' => 'College of Business, Entrepreneurship and Accountancy - CBEA',
            'options' => [
                ['value' => 'BSAIS', 'text' => 'BS Accounting and Information System', 'class' => 'course-bsais'],
            ],
            'class' => 'college-cbea',
        ],
        [
            'label' => 'College of Criminal Justice Education - CCJE',
            'options' => [['value' => 'BSCrim', 'text' => 'BS Criminology', 'class' => 'course-bscrim']],
            'class' => 'college-ccje',
        ],
        [
            'label' => 'College of Hospitality Management – CHM',
            'options' => [['value' => 'BSHM', 'text' => 'BS Hospitality Management', 'class' => 'course-bshm']],
            'class' => 'college-chm',
        ],
        [
            'label' => 'College of Fisheries and Aquatic Science – CFAS',
            'options' => [
                ['value' => 'BSFAS', 'text' => 'BS Fisheries and Aquatic Science', 'class' => 'course-bsfas'],
            ],
            'class' => 'college-cfas',
        ],
        [
            'label' => 'College of Industrial Technology – CIT',
            'options' => [
                [
                    'value' => 'BSIndTech-Elecx',
                    'text' => 'BS Industrial Technology - Elecx',
                    'class' => 'course-bsindtech',
                ],
                [
                    'value' => 'BSIndTech-Elec',
                    'text' => 'BS Industrial Technology - Elec',
                    'class' => 'course-bsindtech',
                ],
                [
                    'value' => 'BSIndTech-Auto',
                    'text' => 'BS Industrial Technology - Auto',
                    'class' => 'course-bsindtech',
                ],
            ],
            'class' => 'college-cit',
        ],
        [
            'label' => 'College of Information and Computing Sciences - CICS',
            'options' => [['value' => 'BSIT', 'text' => 'BS Information Technology', 'class' => 'course-bsit']],
            'class' => 'college-cics',
        ],
        [
            'label' => 'College of Teacher Education - CTED',
            'options' => [
                ['value' => 'BEED', 'text' => 'Bachelor in Elementary Education', 'class' => 'course-cted'],
                ['value' => 'BSed-Eng', 'text' => 'BS Secondary Education - English', 'class' => 'course-cted'],
                ['value' => 'BSed-Scie', 'text' => 'BS Secondary Education - Science', 'class' => 'course-cted'],
                ['value' => 'BSed-Math', 'text' => 'BS Secondary Education - Math', 'class' => 'course-cted'],
            ],
            'class' => 'college-cted',
        ],
    ];
@endphp
<style>
    /* Define custom background colors for colleges */
    .college-cbea {
        background-color: #f0ad4e;
        color: #fff;
    }

    .college-ccje {
        background-color: #d9534f;
        color: #fff;
    }

    .college-chm {
        background-color: #5bc0de;
        color: #fff;
    }

    .college-cfas {
        background-color: #5bc0de;
        color: #fff;
    }

    .college-cit {
        background-color: #337ab7;
        color: #fff;
    }

    .college-cics {
        background-color: #5cb85c;
        color: #fff;
    }

    .college-cted {
        background-color: #d9534f;
        color: #fff;
    }

    /* Define custom background colors for courses */
    .course-bsais {
        background-color: #f0ad4e;
        color: #fff;
    }

    .course-bscrim {
        background-color: #d9534f;
        color: #fff;
    }

    .course-bshm {
        background-color: #5bc0de;
        color: #fff;
    }

    .course-bsfas {
        background-color: #5bc0de;
        color: #fff;
    }

    .course-bsindtech {
        background-color: #337ab7;
        color: #fff;
    }

    .course-bsit {
        background-color: #5cb85c;
        color: #fff;
    }

    .course-cted {
        background-color: #d9534f;
        color: #fff;
    }
</style>
<x-app-layout>


    @section('content_header')
        <h1>update</h1>
    @stop

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('update.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" placeholder="input student I.D"
                            value="{{ $Student_list['id'] }}" class="form-control">

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student I.D</label>
                            <input type="text" name="student_id" placeholder="input student I.D"
                                value="{{ $Student_list['student_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" name="name" placeholder="input student name"
                                value="{{ $Student_list['name'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label">Student Course</label>
                            <select required name="course" id="course" class="form-control" value="">
                                <option value="">{{ $Student_list['course'] }}</option>
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

                        <div class="mb-3 position-relative">
                            <label for="college" class="form-label">Faculty College</label>
                            <select required name="college" id="college" class="form-select">
                                <option>{{ $Student_list['college'] }}</option>

                                <option value="CBEA" class="college-cbea">College of Business, Entrepreneurship and
                                    Accountancy - CBEA</option>
                                <option value="CCJE" class="college-ccje">College of Criminal Justice Education - CCJE
                                </option>
                                <option value="CHM" class="college-chm">College of Hospitality Management – CHM
                                </option>
                                <option value="CFAS" class="college-cfas">College of Fisheries and Aquatic Science –
                                    CFAS</option>
                                <option value="CIT" class="college-cit">College of Industrial Technology – CIT
                                </option>
                                <option value="CICS" class="college-cics">College of Information and Computing
                                    Sciences - CICS</option>
                                <option value="CTED" class="college-cted">College of Teacher Education - CTED</option>

                                <!-- Add more options as needed -->
                            </select>
                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Student Image</label>
                            <input type="file" name="image" placeholder="input student image"
                                value="{{ $Student_list['image'] }}" class="form-control">
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
