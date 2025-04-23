@php
    $isIndividual = $reportData->pluck('user_id')->unique()->count() === 1;
    // $totalHours = $reportData->sum('hours_worked');
    $totalHours = $reportData->filter(fn($r) => $r->hours_worked !== null)->sum('hours_worked');

@endphp

<div class="card">
    <div class="card-body">
        @if($isIndividual)
            <h5 class="mb-3">Individual Driver Report</h5>
            <p><strong>Driver ID:</strong> {{ $reportData->first()->user->id ?? 'N/A' }}</p>
            <p><strong>Driver Name:</strong> {{ $reportData->first()->user->name ?? 'N/A' }}</p>
        @else
            <h5 class="mb-3">General Driver Report</h5>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>S/N</th>
                        @if(!$isIndividual)
                            <th>Driver ID</th>
                            <th>Driver Name</th>
                        @endif
                        <th>Date</th>
                        <th>Vehicle No</th>
                        <th>Vehicle Temprature</th>
                        <th>Product Temprature</th>
                        <th>Delivery Temprature</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Hours Worked</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @if(!$isIndividual)
                                <td>{{ $item->user->id ?? '-' }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($item->time_in)->format('M d, Y') }}</td>
                            <td>{{ $item->vehicle->plate_number ?? '-' }}</td>
                            <td>{{ $item->vehicle_temprature ?? '-' }}</td>
                            <td>{{ $item->product_temprature ?? '-' }}</td>
                            <td>{{ $item->delivery_temprature ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->time_in)->format('H:i') }}</td>
                            <td>
                                @if($item->time_out)
                                    {{ \Carbon\Carbon::parse($item->time_out)->format('H:i') }}
                                @else
                                    <span class="text-danger">Not completed</span>
                                @endif
                            </td>
                            
                            <td>
                                @if($item->hours_worked)
                                    <b style="color:green;">{{ $item->hours_worked }}</b> hours
                                @else
                                    <span class="text-muted">Pending</span>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="{{ $isIndividual ? 6 : 7 }}" class="text-end">Total Hours</td>
                        <td>{{ $totalHours }} <span style="font-weight: 200;">hours</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
