@extends('layouts.app') 

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold"><a href="https://akkcrown.co.uk/cpanel">{{ $settings->app_name ?? 'Delivery Report Generator' }}</a></h2>
            <p class="text-muted mb-0">{{ $settings->app_address ?? '' }}</p>
        </div>
    </div>

    <!-- Report Filter Form -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Generate Delivery Report</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports') }}" method="GET" id="reportForm" class="row g-4">

                <!-- Report Type -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Report Type</label>
                    {{-- <select class="form-select" name="report_type" id="report_type" required>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select> --}}

                    <select class="form-select" name="report_type" id="report_type" required>
                        <option value="weekly" {{ request('report_type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ request('report_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ request('report_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                    
                </div>

                <!-- Scope -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Scope</label>
                    <select class="form-select" name="scope" id="scope" required>
                        <option value="individual" {{ request('scope') == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="general" {{ request('scope') == 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                <!-- Weekly: Single Date -->
                <div class="col-md-3 date-field" id="dateField">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}" id="dateInput">
                </div>

                <!-- Monthly: Date Range -->
                <div class="col-md-3 date-field d-none" id="dateRange">
                    <label class="form-label fw-semibold">Date From</label>
                    <input type="date" class="form-control mb-2" value="{{ request('date_from') }}" name="date_from">
                    <label class="form-label fw-semibold">Date To</label>
                    <input type="date" class="form-control" value="{{ request('date_to') }}" name="date_to">
                </div>

                <!-- Yearly: Month Range -->
                <div class="col-md-3 date-field d-none" id="monthRange">
                    <label class="form-label fw-semibold">Month From</label>
                    <input type="month" class="form-control mb-2" name="month_from" value="{{ request('month_from') }}">
                    <label class="form-label fw-semibold">Month To</label>
                    <input type="month" class="form-control" name="month_to" value="{{ request('month_to') }}">
                </div>

                <!-- Driver Select -->
                <div class="col-md-3" id="driverSelect">
                    <label class="form-label fw-semibold">Driver</label>
                    <select class="form-select" name="driver_id">
                        <option value="">Select Driver</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Generate Report</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Table Display -->
    @if(isset($reportData) && $reportData->count())
        @include('admin.report-table', ['reportData' => $reportData])

        <!-- PDF Download -->
        <form method="POST" action="{{ route('admin.reports.download') }}">
            @csrf
            <input type="hidden" name="data" value="{{ base64_encode(serialize($reportData)) }}">
            <button type="submit" class="btn btn-outline-secondary mt-4">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
            </button>
        </form>
    @elseif(isset($reportData))
        <div class="alert alert-warning">
            <strong>No results found for the selected filters.</strong>
        </div>
    @endif
</div>


<!-- Toggle driver dropdown based on scope -->
<script>
    document.getElementById('scope').addEventListener('change', function () {
        const driverSelect = document.getElementById('driverSelect');
        driverSelect.style.display = this.value === 'general' ? 'none' : 'block';
    });

    // Trigger initial toggle on page load
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('scope').dispatchEvent(new Event('change'));
    });
</script>

<script>
    function toggleFields() {
        const reportType = document.getElementById('report_type').value;

        // Hide all date fields first
        document.getElementById('dateField').classList.add('d-none');
        document.getElementById('dateRange').classList.add('d-none');
        document.getElementById('monthRange').classList.add('d-none');

        // Show appropriate fields
        if (reportType === 'weekly') {
            document.getElementById('dateField').classList.remove('d-none');
        } else if (reportType === 'monthly') {
            document.getElementById('dateRange').classList.remove('d-none');
        } else if (reportType === 'yearly') {
            document.getElementById('monthRange').classList.remove('d-none');
        }
    }

    // Hide driver field when scope is general
    function toggleDriverSelect() {
        const scope = document.getElementById('scope').value;
        document.getElementById('driverSelect').style.display = (scope === 'general') ? 'none' : 'block';
    }

    document.getElementById('report_type').addEventListener('change', toggleFields);
    document.getElementById('scope').addEventListener('change', toggleDriverSelect);

    // Trigger on page load
    window.addEventListener('DOMContentLoaded', function () {
        toggleFields();
        toggleDriverSelect();
    });
</script>

@endsection
