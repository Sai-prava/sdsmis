@extends('crp.layout.index')

@section('title')
    Manage Pg Monthly Progress Report
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Pg Monthly Progress Report Form</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('crp.pg_monthly_progress_report.create') }}" class="btn btn-primary text-right">Add New Monthly Progress Report</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>PG Name</th>
                    <th>Month & Year</th>
                    <th>Meeting held in the Month</th>
                    <th>Member present in the meeting</th>
                    <th>Amout of Input sale in the month</th>
                    <th>Amout of output sale in the month</th>
                    <th>Total Sales in the Month</th>
                    <th>Total Loan Taken from CLF in this month</th>
                    <th>Total Loan amount Return in this Month</th>
                    <th>Total Interest amount Paid in this Month</th>
                    {{-- <th>Action</th>
                    <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pgmonthlyprogress  as $key => $data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{@$data->pg->name}}</td>
                    <td>{{@$data->month }} {{@$data->year }}</td>
                    <td>{{@$data->meeting_held}}</td>
                    <td>{{@$data->member_presence_percent}}</td>
                    <td>{{@$data->input_sale_amount}}</td>
                    <td>{{@$data->output_sale_amount}}</td>
                    <td>{{@$data->total_sales ?? 'N/A' }}</td>
                    <td>{{@$data->loan_taken}}</td>
                    <td>{{@$data->loan_returned}}</td>
                    <td>{{@$data->interest_paid}}</td>
                    
                    {{-- <td>
                        <a href="{{route('crp.respondent_master.edit',$respondent_master->id)}}" class="btn btn-primary btn-sm">{{$respondent_master->is_validate ? 'View' : 'Edit'}}</a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')
@endsection