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
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Graduate School</h5>
    @stop

    @section('content')
        @if (session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                (async () => {
                    await Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully!'
                    })
                })()
            </script>
        @endif

        @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                (async () => {
                    await Toast.fire({
                        icon: 'warning',
                        title: 'Graduate School ID already exists!'
                    })
                })()
            </script>
        @endif

        <div class="py-2 font">
            <div class="container">
                <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                    <div class="p-4 text-dark flex-fill">
                        <form action="{{ route('add.graduateSchool') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="graduateschool_id" class="form-label">Graduate School I.D</label>
                                <input type="text" required name="graduateschool_id" id="graduateschool_id"
                                    placeholder="Input Graduate School I.D" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Graduate School Name</label>
                                <input type="text" required name="name" id="name"
                                    placeholder="Input Graduate School name" class="form-control">
                            </div>

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

                            <div class="mb-3">
                                <label for="course" class="form-label">Graduate School Course</label>
                                <select required name="course" id="course" class="form-control">
                                    <option value="" disabled selected>Select Course</option>
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
                                <label for="image" class="form-label">Graduate School Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary px-5">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-50" src="{{ asset('IMG/csulogo.png') }}" alt="CSU LOGO">
                    </div>
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
