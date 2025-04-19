@extends('project.layout.index')

@section('title')
    Manage Monthly Farming Report
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">
                <h5 class="card-title m-0">Manage Monthly Farming Report</h5>

                <!-- Filter Form -->
                <form id="filter-form" class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
                    <select name="month" id="filter-month" class="form-control" style="min-width: 150px;">
                        <option value="">All Months</option>
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endforeach
                    </select>

                    <select name="year" id="filter-year" class="form-control" style="min-width: 120px;">
                        <option value="">All Years</option>
                        @for ($y = date('Y'); $y >= 2000; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>
                </form>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-bordered" id="farming-report-table">
                <thead>
                    <tr>
                        <th>SL.No</th>
                        <th>Month</th>
                        <th>Farmer Name</th>
                        <th>Date Of Update</th>
                        <th>Time Of Update</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            let table = $('#farming-report-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('project.report.monthly-framing') }}",
                    data: function(d) {
                        d.month = $('#filter-month').val();
                        d.year = $('#filter-year').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'month',
                        name: 'month'
                    },
                    {
                        data: 'farmer_name',
                        name: 'farmer_name'
                    },
                    {
                        data: 'date_of_update',
                        name: 'date_of_update'
                    },
                    {
                        data: 'time_of_update',
                        name: 'time_of_update'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });
        });
    </script>
@endsection
