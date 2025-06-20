$(document).ready(function () {
    $('#timeForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        $.ajax({
            url: $(this).attr('action'), // The form action URL
            type: $(this).attr('method'), // The form method (POST)
            data: $(this).serialize(), // Serialize the form data
            success: function (response) {
                // Handle student success
                if (response.studentTimein) {
                    studentTimein(response.studentTimein);
                    displayStudentInfo_in(response.studentData);
                }
                if (response.studentTimeout) {
                    studentTimeout(response.studentTimeout);
                    displayStudentInfo_out(response.studentData);
                }

                // Handle faculty success
                if (response.facultyTimein) {
                    facultyTimein(response.facultyTimein);
                    displayFacultyInfo_in(response.facultyData);
                }
                if (response.facultyTimeout) {
                    facultyTimeout(response.facultyTimeout);
                    displayFacultyInfo_out(response.facultyData);
                }

                // Optionally reset the form
                $('#timeForm')[0].reset();
            },
            error: function (xhr) {
                // Handle error
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.idnotexist) {
                        error(xhr.responseJSON.idnotexist);
                    }

                    //handle student error
                    if (xhr.responseJSON.inStudent) {
                        inStudent(xhr.responseJSON.inStudent);
                    }
                    if (xhr.responseJSON.outStudent) {
                        outStudent(xhr.responseJSON.outStudent);
                    }
                    // handle faculty error
                    if (xhr.responseJSON.inFaculty) {
                        inFaculty(xhr.responseJSON.inFaculty);
                    }
                    if (xhr.responseJSON.outFaculty) {
                        outFaculty(xhr.responseJSON.outFaculty);
                    }
                } else {
                    alert('An unexpected error occurred: ' + xhr.responseText);
                }

                $('#timeForm')[0].reset();
            }
        });
    });
});



function clearDisplayedData() {
    $('#studentName').text('');
    $('#studentCourse').text('');
    $('#studentDepartment').text('');
    $('#currentTime').text('');
    $('.student-image').attr('src', '/IMG/default.jpg'); // Path to the default image
    $('#type').text('');
}

function displayStudentInfo_in(studentData) {
    $('#studentName').text(studentData.first_name + ' ' + studentData.middle_initial + ' ' + studentData.last_name);
    $('#studentCourse').text(studentData.course_id);
    $('#studentDepartment').text(studentData.college_id);
    $('#currentTime').text(studentData.currentTime);
    $('.student-image').attr('src', studentData.image);
    $('#type').text('Student');
    studentTimein(studentData);

    // Clear data after 10 seconds
    setTimeout(clearDisplayedData, 10000);
}

function displayStudentInfo_out(studentData) {
    $('#studentName').text(studentData.first_name + ' ' + studentData.middle_initial + ' ' + studentData.last_name);
    $('#studentCourse').text(studentData.course_id);
    $('#studentDepartment').text(studentData.college_id);
    $('#currentTime').text(studentData.currentTime);
    $('.student-image').attr('src', studentData.image);
    $('#type').text('Student');
    studentTimeout(studentData);

    // Clear data after 10 seconds
    setTimeout(clearDisplayedData, 10000);
}

function displayFacultyInfo_in(facultyData) {
    $('#studentName').text(facultyData.first_name + ' ' + facultyData.middle_initial + ' ' + facultyData.last_name);
    $('#studentCourse').text(facultyData.course_id);
    $('#studentDepartment').text(facultyData.college_id);
    $('#currentTime').text(facultyData.currentTime);
    $('.student-image').attr('src', facultyData.image);
    $('#type').text('Faculty');
    facultyTimein(facultyData);

    // Clear data after 10 seconds
    setTimeout(clearDisplayedData, 10000);
}

function displayFacultyInfo_out(facultyData) {
    $('#studentName').text(facultyData.first_name + ' ' + facultyData.middle_initial + ' ' + facultyData.last_name);
    $('#studentCourse').text(facultyData.course_id);
    $('#studentDepartment').text(facultyData.college_id);
    $('#currentTime').text(facultyData.currentTime);
    $('.student-image').attr('src', facultyData.image);
    $('#type').text('Faculty');
    facultyTimeout(facultyData);

    // Clear data after 10 seconds
    setTimeout(clearDisplayedData, 10000);
}
