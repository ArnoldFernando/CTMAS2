<x-app-layout>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-100 max-w-4xl bg-white shadow rounded-lg overflow-auto" style="max-height: 34rem;">

                <a href="{{ route('faculty-records.pdf') }}">export pdf</a>

                <table class="table table-striped table-hover">
                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th>#</th> {{-- New column for sequential number --}}
                            <th>Faculty-ID</th>
                            <th>Name</th>
                            <th>College</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1 @endphp {{-- Initialize counter --}}
                        @foreach ($sessionsByDay as $day => $sessions)
                            <tr>
                                <td colspan="10" class="bg-dark text-white px-3 py-2">{{ $day }}</td>
                            </tr>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $counter++ }}</td> {{-- Increment counter for each row --}}
                                    <td>{{ $session->faculty_id }}</td>
                                    <td>{{ $session->faculty->name }}</td>
                                    <td>{{ $session->faculty->college }}</td>
                                    <td>
                                        <?php
                                        $timeIn = \Carbon\Carbon::parse($session->time_in);
                                        $formattedTimeIn = $timeIn->format('h:i A');
                                        ?>
                                        {{ $formattedTimeIn }}
                                    </td>
                                    <td>
                                        @if ($session->time_out)
                                            <?php
                                            $timeOut = \Carbon\Carbon::parse($session->time_out);
                                            $formattedTimeOut = $timeOut->format('h:i A');
                                            ?>
                                            {{ $formattedTimeOut }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($session->time_out)
                                            <?php
                                            $duration = $timeOut->diff($timeIn)->format('%H:%I:%S');
                                            ?>
                                            {{ $duration }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $session->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
