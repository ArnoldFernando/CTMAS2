<!DOCTYPE html>
<html>

<head>
    <title>Student Time In/Out</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentIdInput = document.getElementById('student_id');
            const form = document.getElementById('timeForm');

            studentIdInput.addEventListener('input', function() {
                if (studentIdInput.value) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const text = "Cagayan State University Aparri Library";
            const colors = ["#FF8F00", "#ADD8E6"]; // White, Light Blue
            const typingText = document.getElementById('typingText');
            let index = 0;
            let forward = true;

            function type() {
                if (forward) {
                    if (index < text.length) {
                        const span = document.createElement('span');
                        span.textContent = text.charAt(index);
                        span.style.color = colors[index % colors.length]; // Cycle through colors
                        typingText.appendChild(span);
                        index++;
                        setTimeout(type, 100); // Adjust typing speed here
                    } else {
                        setTimeout(() => {
                            forward = false;
                            type();
                        }, 2000); // Delay before starting to erase
                    }
                } else {
                    if (index > 0) {
                        typingText.removeChild(typingText.lastChild);
                        index--;
                        setTimeout(type, 100); // Adjust erasing speed here
                    } else {
                        setTimeout(() => {
                            forward = true;
                            type();
                        }, 1000); // Delay before restarting the typing effect
                    }
                }
            }

            type(); // Start the typing effect
        });
    </script>
</head>

<body>
    <div class="container bg-light text-dark d-flex flex-column min-vh-100 p-3">

        <div class="row">
            <div class="container p-2 text-dark col-6">
                <h1 id="typingText" class="display-1"></h1>
            </div>

            <div class="container p-2 col-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="max-w-lg w-100 bg-white shadow rounded px-5 py-4">
                        <h2 class="h4 font-weight-bold mb-3">Start Session</h2>

                        <form id="timeForm" action="{{ route('student-time') }}" method="POST">
                            @csrf
                            <label for="student_id">Student ID:</label>
                            <input type="text" id="student_id" name="student_id" required autofocus>
                            <button type="submit" style="display: none;">Submit</button>
                        </form>

                    </div>
                </div>

                @if (session('message'))
                    <p>{{ session('message') }}</p>
                @endif

                @if (session('student'))
                    <div>
                        <h2>Student Details</h2>
                        <p><strong>Name:</strong> {{ session('student')->name }}</p>
                        <p><strong>Course:</strong> {{ session('student')->course }}</p>
                        <p><strong>College:</strong> {{ session('student')->college }}</p>
                        @if (session('student')->image)
                            <img src="{{ asset('images/' . session('student')->image) }}" alt="Student Image"
                                style="max-width: 200px;">
                        @endif
                    </div>
                @endif
            </div>
        </div>
</body>
</html>
