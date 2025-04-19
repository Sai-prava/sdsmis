@extends('project.layout.index')
@section('title')
    Manage Farming Profile
@endsection

@section('content')
    <div class="card">

        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Farming Profile</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="farming-profile-table">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Farmer Name</th>
                        <th>SHG Member</th>
                        <th>Total Annual Income</th>
                        <th>Annual Income From Fishery</th>
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
            $('#farming-profile-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('project.framing.profile') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'farmer_name',
                        name: 'farmer_name'
                    },
                    {
                        data: 'shg_member',
                        name: 'shg_member'
                    },
                    {
                        data: 'total_annual_income',
                        name: 'total_annual_income'
                    },
                    {
                        data: 'total_annual_income_from_fishery',
                        name: 'total_annual_income_from_fishery'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
