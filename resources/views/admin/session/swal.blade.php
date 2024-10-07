<div>
    {{--  student  --}}
    <script>
        function error() {
            let timerInterval;
            Swal.fire({
                title: "Error!",
                text: "This is a success message.",
                icon: "error",
                html: "ID does not exist",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function outStudent() {
            let timerInterval;
            Swal.fire({
                title: "Warning!",
                text: "Cannot time in within 20 seconds of time out",
                icon: "warning",
                html: "Cannot time in within 20 seconds of time out",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function studentTimein() {
            let timerInterval;
            Swal.fire({
                title: "Success!",
                text: "Student time in recorded successfully.",
                icon: "success",
                html: "Student time in recorded successfully.",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function inStudent() {
            let timerInterval;
            Swal.fire({
                title: "WAIT!",
                text: "Cannot time out within 20 seconds of time in",
                icon: "warning",
                html: "Cannot time out within 20 seconds of time in",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function studentTimeout() {
            let timerInterval;
            Swal.fire({
                title: "Timeout",
                text: "Student time out recorded successfully.",
                icon: "info",
                html: "Student time out recorded successfully.",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }
    </script>

    {{--  faculty  --}}
    <script>
        function error() {
            let timerInterval;
            Swal.fire({
                title: "Error!",
                text: "This is a success message.",
                icon: "error",
                html: "ID does not exist",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('faculty_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function outFaculty() {
            let timerInterval;
            Swal.fire({
                title: "Warning!",
                text: "Cannot time in within 20 seconds of time out",
                icon: "warning",
                html: "Cannot time in within 20 seconds of time out",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('faculty_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function facultyTimein() {
            let timerInterval;
            Swal.fire({
                title: "Success!",
                text: "faculty time in recorded successfully.",
                icon: "success",
                html: "faculty time in recorded successfully.",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('faculty_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function inFaculty() {
            let timerInterval;
            Swal.fire({
                title: "WAIT!",
                text: "Cannot time out within 20 seconds of time in",
                icon: "warning",
                html: "Cannot time out within 20 seconds of time in",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('faculty_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }

        function facultyTimeout() {
            let timerInterval;
            Swal.fire({
                title: "Timeout",
                text: "faculty time out recorded successfully.",
                icon: "info",
                html: "faculty time out recorded successfully.",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('faculty_id').focus();
                    }, 50); // Adjust the timeout if necessary
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {}
            });
        }
    </script>
</div>
