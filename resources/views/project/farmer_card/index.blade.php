@extends('project.layout.index')
@section('title') Manage Farmer Card Details @endsection

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Farmer Card Details</h5>
        <a href="{{ route('project.report.export', request()->query()) }}" class="btn btn-danger">Export</a>
    </div>
    <div class="card-body">
        <form id="filterForm" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label>District</label>
                    <select name="district_id" id="district" class="form-control">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Block</label>
                    <select name="block_id" id="block" class="form-control">
                        <option value="">Select Block</option>
                        @foreach ($blocks as $block)
                            <option value="{{ $block->id }}" {{ request('block_id') == $block->id ? 'selected' : '' }}>
                                {{ $block->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Gram Panchyat</label>
                    <select name="gram_panchyat_id" id="gram_panchyat" class="form-control">
                        <option value="">Select Gram Panchyat</option>
                        @foreach ($gramPanchyats as $gp)
                            <option value="{{ $gp->id }}" {{ request('gram_panchyat_id') == $gp->id ? 'selected' : '' }}>
                                {{ $gp->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Village</label>
                    <select name="village_id" id="village" class="form-control">
                        <option value="">Select Village</option>
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}" {{ request('village_id') == $village->id ? 'selected' : '' }}>
                                {{ $village->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive mt-4">
            <table id="respondents-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Farmer ID</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Block</th>
                        <th>Gram Panchyat</th>
                        <th>Village</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    // Load DataTable
    function loadTable() {
        $('#respondents-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{ route('project.report.farmer-card') }}",
                data: {
                    district_id: $('#district').val(),
                    block_id: $('#block').val(),
                    gram_panchyat_id: $('#gram_panchyat').val(),
                    village_id: $('#village').val()
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'farmer_id', name: 'farmer_id' },
                { data: 'name', name: 'name' },
                { data: 'district', name: 'district.name' },
                { data: 'block', name: 'block.name' },
                { data: 'gram_panchyat', name: 'gram_panchyat.name' },
                { data: 'village', name: 'village.name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    }

    loadTable();

    $('#district, #block, #gram_panchyat, #village').change(function () {
        loadTable();
    });

    // Dependent Dropdowns
    $('#district').change(function () {
        const districtId = $(this).val();
        if (districtId) {
            $.get("{{ route('project.report.get_blocks', '') }}/" + districtId, function (data) {
                $('#block').html('<option value="">Select Block</option>');
                $.each(data, function (i, item) {
                    $('#block').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
                $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                $('#village').html('<option value="">Select Village</option>');
            });
        }
    });

    $('#block').change(function () {
        const blockId = $(this).val();
        if (blockId) {
            $.get("{{ route('project.report.get_gram_panchyats', '') }}/" + blockId, function (data) {
                $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                $.each(data, function (i, item) {
                    $('#gram_panchyat').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
                $('#village').html('<option value="">Select Village</option>');
            });
        }
    });

    $('#gram_panchyat').change(function () {
        const gpId = $(this).val();
        if (gpId) {
            $.get("{{ route('project.report.get_villages', '') }}/" + gpId, function (data) {
                $('#village').html('<option value="">Select Village</option>');
                $.each(data, function (i, item) {
                    $('#village').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            });
        }
    });
});
</script>
@endsection
