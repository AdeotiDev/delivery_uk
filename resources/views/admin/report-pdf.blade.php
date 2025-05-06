<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h3 {
            margin-bottom: 0;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    
    
    <center>
        <img src="{{ public_path('storage/' . $settings->app_logo) }}" style="height:80px; border-radius:8px;">
    </center>
    
    <h3 class="mb-4">{{ $settings->app_name ?? '-' }}</h3>
    <p>Delivery Report</p>

    @php
        $isIndividual = $reportData->pluck('user_id')->unique()->count() === 1;
        $totalHours = $reportData->filter(fn($r) => $r->hours_worked !== null)->sum('hours_worked');
    @endphp

    @if($isIndividual)
        {{-- <p><strong>Driver ID:</strong> {{ $reportData->first()->user->id ?? 'N/A' }}</p> --}}
        <p><strong>Driver Name:</strong> {{ $reportData->first()->user->name ?? 'N/A' }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>S/N</th>
                @if(!$isIndividual)
                    {{-- <th>Driver ID</th> --}}
                    <th>Driver Name</th>
                @endif
                <th>Date</th>
                <th>Vehicle No</th>
                <th>Time In</th>
                <th>Take off time</th>
                <th>Time Out</th>
                <th>Hours Worked</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    @if(!$isIndividual)
                        {{-- <td>{{ $item->user->id ?? '-' }}</td> --}}
                        <td>{{ $item->user->name ?? '-' }}</td>
                    @endif

                    <td>{{ \Carbon\Carbon::parse($item->time_in)->format('Y-m-d') }}</td>
                    <td>{{ $item->vehicle->plate_number ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->time_in)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->take_off_time)->format('H:i') }}</td>
                    
                    <td>
                        @if($item->time_out)
                            {{ \Carbon\Carbon::parse($item->time_out)->format('H:i') }}
                        @else
                            Not completed
                        @endif
                    </td>

                    <td>
                        {{ $item->hours_worked ?? 'Pending' }}
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="{{ $isIndividual ? 6 : 7 }}" class="text-right"><strong>Total Hours:</strong></td>
                <td><strong>{{ $totalHours }} hours</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
