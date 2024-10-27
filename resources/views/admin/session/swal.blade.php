<div>
    {{--  student  --}}
    <script>
        function error() {
            let timerInterval;
            Swal.fire({
                title: "Error!",
                text: "This is a success message.",
                icon: "error",
                html: "Please Register your LIBRARY CARD FIRST",
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

        function studentTimein(data) {
            let timerInterval;
            let imageUrl = data.image ? data.image : 'IMG/default.jpg'; // Replace with actual default image path

            Swal.fire({
                title: "Time in Successfully",
                text: "Student time in recorded successfully.",
                imageUrl: imageUrl,
                imageHeight: 200, // Adjust the image height to 300px
                imageAlt: "Student image",
                timer: 2000, // Set the timer duration (in milliseconds)
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timerElement = Swal.getHtmlContainer().querySelector('b');
                    if (timerElement) {
                        timerInterval = setInterval(() => {
                            timerElement.textContent = Swal.getTimerLeft();
                        }, 100);
                    }

                    // Force the image to be round
                    const swalImage = Swal.getHtmlContainer().querySelector('.swal2-image');
                    if (swalImage) {
                        swalImage.style.borderRadius = '50% !important';
                        swalImage.style.width = '200px !important';
                        swalImage.style.height = '200px !important';
                        swalImage.style.objectFit = 'cover !important';
                        swalImage.style.overflow = 'hidden !important';

                    }
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                },
                html: '<b></b>' // Adding a timer display element
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Handle what happens when the timer ends, if needed
                }
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

        function studentTimeout(data) {
            let timerInterval;
            let imageUrl = data.image ? data.image : 'IMG/default.jpg';

            Swal.fire({
                title: "Time Out successfully.",
                text: "Student time Out recorded successfully.",
                imageUrl: imageUrl,
                imageHeight: 200,
                imageAlt: "Student image",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timerElement = Swal.getHtmlContainer().querySelector('b');
                    if (timerElement) {
                        timerInterval = setInterval(() => {
                            timerElement.textContent = Swal.getTimerLeft();
                        }, 100);
                    }
                    const swalImage = Swal.getHtmlContainer().querySelector('.swal2-image');
                    if (swalImage) {
                        swalImage.style.borderRadius = '50% !important';
                        swalImage.style.width = '200px !important';
                        swalImage.style.height = '200px !important';
                        swalImage.style.objectFit = 'cover !important';
                        swalImage.style.overflow = 'hidden !important';

                    }
                },
                willClose: () => {
                    clearInterval(timerInterval);
                    // Focus on the input field after the alert closes
                    setTimeout(() => {
                        document.getElementById('student_id').focus();
                    }, 50); // Adjust the timeout if necessary
                },
                html: '<b></b>' // Adding a timer display element
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Handle what happens when the timer ends, if needed
                }
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
