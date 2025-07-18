@extends('admin.layout.index')

@section('title')
    Manage PG
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Add New PG</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pg.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>District</label>
                                <select name="district_id" id="district" class="form-control" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Block</label>
                                <select name="block_id" id="block" class="form-control" required>
                                    <option value="">Select Block</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Panchayat</label>
                                <select name="gram_panchyat_id" id="panchayat" class="form-control" required>
                                    <option value="">Select Panchayat</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Village</label>
                                <select name="village_id" id="village" class="form-control" required>
                                    <option value="">Select Village</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>CSP Name</label>
                                <input name="csp_name" type="text" class="form-control" placeholder="Enter csp name"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Name of producer group</label>
                                <input name="name" type="text" class="form-control" placeholder="Enter PG Name"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>PG Date of Formation</label>
                                <input name="date_of_formation" type="date" class="form-control"
                                    placeholder="Enter PG Date" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Bank Account Number</label>
                                <input name="bank_account" type="number" class="form-control"
                                    placeholder="Enter bank account number" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>IFSC Code</label>
                                <input name="code" type="number" class="form-control" placeholder="Enter ifsc Code"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Branch</label>
                                <input name="branch" type="text" class="form-control" placeholder="Enter branch name"
                                    required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Create <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">

        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>PG Name</th>
                    <th>PG Code</th>
                    <th>PG Date of Formation</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pgs as $key => $pg)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pg->name }}</td>
                        <td>{{ $pg->code }}</td>
                        <td>{{ \Carbon\Carbon::parse($pg->date_of_formation)->format('d M, Y') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                data-target="#edit_modal" data-id="{{ $pg->id }}" data-name="{{ $pg->name }}"
                                data-code="{{ $pg->code }}" data-date_of_formation="{{ $pg->date_of_formation }}"
                                data-district_id="{{ $pg->district_id }}" data-block_id="{{ $pg->block_id }}"
                                data-gram_panchyat_id="{{ $pg->gram_panchyat_id }}"
                                data-village_id="{{ $pg->village_id }}" data-csp_name="{{ $pg->csp_name }}"
                                data-bank_account="{{ $pg->bank_account }}" data-branch="{{ $pg->branch }}">
                                Edit
                            </button>
                        </td>

                        <td>
                            <form action="{{ route('admin.pg.destroy', $pg->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="edit_modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Update PG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body row">
                        <input type="hidden" id="id" name="id">

                        <div class="form-group col-md-3">
                            <label>District</label>
                            <select name="district_id" id="edit_district" class="form-control" disabled>
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Block -->
                        <div class="form-group col-md-3">
                            <label>Block</label>
                            <select name="block_id" id="edit_block" class="form-control" required disabled>
                                <option value="">Select Block</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gram Panchayat -->
                        <div class="form-group col-md-3">
                            <label>Gram Panchayat</label>
                            <select name="gram_panchyat_id" id="edit_panchayat" class="form-control" required disabled>
                                <option value="">Select Panchayat</option>
                                @foreach ($panchayats as $panchayat)
                                    <option value="{{ $panchayat->id }}">{{ $panchayat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Village -->
                        <div class="form-group col-md-3">
                            <label>Village</label>
                            <select name="village_id" id="edit_village" class="form-control" required disabled>
                                <option value="">Select Village</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>CSP Name</label>
                            <input class="form-control" type="text" id="edit_csp_name" name="csp_name"
                                placeholder="Enter CSP Name" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="name">PG Name</label>
                            <input class="form-control" type="text" id="edit_name" name="name"
                                placeholder="Enter PG Name" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="code">IFSC Code</label>
                            <input class="form-control" type="text" id="edit_code" name="code"
                                placeholder="Enter PG Code" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="date_of_formation">PG Date of Formation</label>
                            <input class="form-control" type="date" id="edit_date_of_formation"
                                name="date_of_formation" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Bank Account Number</label>
                            <input class="form-control" type="text" id="edit_bank_account" name="bank_account"
                                placeholder="Enter bank account number" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Branch</label>
                            <input class="form-control" type="text" id="edit_branch" name="branch"
                                placeholder="Enter branch name" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                // Get data from button attributes
                const id = $(this).data('id');
                const name = $(this).data('name');
                const code = $(this).data('code');
                const date_of_formation = $(this).data('date_of_formation');
                const district_id = $(this).data('district_id');
                const block_id = $(this).data('block_id');
                const panchayat_id = $(this).data('gram_panchyat_id');
                const village_id = $(this).data('village_id');
                const csp_name = $(this).data('csp_name');
                const bank_account = $(this).data('bank_account');
                const branch = $(this).data('branch');

                // Fill static fields
                $('#id').val(id);
                $('#edit_name').val(name);
                $('#edit_code').val(code);
                $('#edit_date_of_formation').val(date_of_formation);
                $('#edit_csp_name').val(csp_name);
                $('#edit_bank_account').val(bank_account);
                $('#edit_branch').val(branch);

                // Set form action
                let action = '{{ route('admin.pg.update', ':id') }}';
                action = action.replace(':id', id);
                $('#updateForm').attr('action', action);

                // Set district and fetch blocks
                $('#edit_district').val(district_id).trigger('change');
                $('#edit_block').val(block_id);
                $('#edit_panchayat').val(panchayat_id);
                $('#edit_village').val(village_id);

                // Show modal
                $('#edit_modal').modal('show');
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#district').on('change', function() {
                let district_id = $(this).val();
                $('#block').html('<option value="">Loading...</option>');
                $.ajax({
                    url: 'pg-get-blocks/' + district_id,
                    type: 'GET',
                    success: function(data) {
                        $('#block').html('<option value="">Select Block</option>');
                        $.each(data, function(key, value) {
                            $('#block').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });

            $('#block').on('change', function() {
                let block_id = $(this).val();
                console.log(block_id);
                $('#panchayat').html('<option value="">Loading...</option>');
                $.ajax({
                    url: 'pg-get-panchayats/' + block_id,
                    type: 'GET',
                    success: function(data) {
                        $('#panchayat').html('<option value="">Select Panchayat</option>');
                        $.each(data, function(key, value) {
                            $('#panchayat').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });

            $('#panchayat').on('change', function() {
                let gram_panchyat_id = $(this).val();
                console.log(gram_panchyat_id);
                $('#village').html('<option value="">Loading...</option>');
                $.ajax({
                    url: 'pg-get-villages/' + gram_panchyat_id,
                    type: 'GET',
                    success: function(data) {
                        $('#village').html('<option value="">Select Village</option>');
                        $.each(data, function(key, value) {
                            $('#village').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
