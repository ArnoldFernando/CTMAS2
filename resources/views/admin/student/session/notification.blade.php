<div>
    {{--  student  --}}
    @if (session('studentTimein'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Student time in recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('studentTimeout'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast-out',
                },
                showConfirmButton: false,
                timer: 1500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Student TIME OUT recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-in-student'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'Cannot time out within 20 seconds of time in'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-out-student'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'question',
                    title: 'time in after 20 seconds'
                })
            })()
        </script>
    @endif




    {{--  faculty  --}}
    @if (session('facultyTimein'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Faculty time in recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('facultyTimeout'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast-out',
                },
                showConfirmButton: false,
                timer: 1500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Faculty TIME OUT recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-in-faculty'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'Cannot time out within 20 seconds of time in'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-out-faculty'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'question',
                    title: 'time in after 20 seconds'
                })
            })()
        </script>
    @endif

    {{--  graduate school  --}}
    @if (session('gradschoolTimein'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Graduate School time in recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('gradschoolTimeout'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast-out',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Graduate School time out recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-in-gradschool'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'Cannot time out within 20 seconds of time in'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-out-gradschool'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'question',
                    title: 'time in after 20 seconds'
                })
            })()
        </script>
    @endif

    @if (session('idnotexist'))
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
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'ID does not exist'
                })
            })()
        </script>
    @endif
</div>
