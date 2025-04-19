@extends('project.layout.index')
@section('title')
    Manage Respondent Master Form
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Respondent Master Form</h5>
            <a href="{{ route('project.report.export', request()->query()) }}" class="btn btn-danger">Export</a>
        </div>
        <div class="card-body">
            <form id="filterForm">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district">District</label>
                            <select name="district_id" id="district" class="form-control">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="block">Block</label>
                            <select name="block_id" id="block" class="form-control">
                                <option value="">Select Block</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}"
                                        {{ request('block_id') == $block->id ? 'selected' : '' }}>
                                        {{ $block->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gram_panchyat">Gram Panchyat</label>
                            <select name="gram_panchyat_id" id="gram_panchyat" class="form-control">
                                <option value="">Select Gram Panchyat</option>
                                @foreach ($gramPanchyats as $gramPanchyat)
                                    <option value="{{ $gramPanchyat->id }}"
                                        {{ request('gram_panchyat_id') == $gramPanchyat->id ? 'selected' : '' }}>
                                        {{ $gramPanchyat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="village">Village</label>
                            <select name="village_id" id="village" class="form-control">
                                <option value="">Select Village</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}"
                                        {{ request('village_id') == $village->id ? 'selected' : '' }}>
                                        {{ $village->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table mt-3" id="respondentTable">
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // --- Load DataTable Function ---
            function loadRespondentTable() {
                $('#respondentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "{{ route('project.report.respondent_master') }}",
                        data: function(d) {
                            d.district_id = $('#district').val();
                            d.block_id = $('#block').val();
                            d.gram_panchyat_id = $('#gram_panchyat').val();
                            d.village_id = $('#village').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'farmer_id',
                            name: 'farmer_id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'district',
                            name: 'district'
                        },
                        {
                            data: 'block',
                            name: 'block'
                        },
                        {
                            data: 'gram_panchyat',
                            name: 'gram_panchyat'
                        },
                        {
                            data: 'village',
                            name: 'village'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }

            loadRespondentTable(); // Initial load

            // --- Cascading Dropdowns ---
            $('#district').change(function() {
                let district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_blocks', '') }}/" + district_id,
                        method: "GET",
                        success: function(blocks) {
                            $('#block').html('<option value="">Select Block</option>');
                            $.each(blocks, function(key, block) {
                                $('#block').append('<option value="' + block.id + '">' +
                                    block.name + '</option>');
                            });
                        }
                    });
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                } else {
                    $('#block').html('<option value="">Select Block</option>');
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                }

                $('#respondentTable').DataTable().ajax.reload();
            });

            $('#block').change(function() {
                let block_id = $(this).val();
                if (block_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_gram_panchyats', '') }}/" + block_id,
                        method: "GET",
                        success: function(gramPanchyats) {
                            $('#gram_panchyat').html(
                                '<option value="">Select Gram Panchyat</option>');
                            $.each(gramPanchyats, function(key, gramPanchyat) {
                                $('#gram_panchyat').append('<option value="' +
                                    gramPanchyat.id + '">' + gramPanchyat.name +
                                    '</option>');
                            });
                        }
                    });
                    $('#village').html('<option value="">Select Village</option>');
                } else {
                    $('#gram_panchyat').html('<option value="">Select Gram Panchyat</option>');
                    $('#village').html('<option value="">Select Village</option>');
                }

                $('#respondentTable').DataTable().ajax.reload();
            });

            $('#gram_panchyat').change(function() {
                let gram_panchyat_id = $(this).val();
                if (gram_panchyat_id) {
                    $.ajax({
                        url: "{{ route('project.report.get_villages', '') }}/" + gram_panchyat_id,
                        method: "GET",
                        success: function(villages) {
                            $('#village').html('<option value="">Select Village</option>');
                            $.each(villages, function(key, village) {
                                $('#village').append('<option value="' + village.id +
                                    '">' + village.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#village').html('<option value="">Select Village</option>');
                }

                $('#respondentTable').DataTable().ajax.reload();
            });

            $('#village').change(function() {
                $('#respondentTable').DataTable().ajax.reload();
            });

        });
    </script>
@endsection
