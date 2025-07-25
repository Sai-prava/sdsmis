@extends('project.layout.index')

@section('title')
    Manage SHG
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Add New SHG</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('project.shg.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>District</label>
                                <select id="district_id" name="district_id" class="form-control" required>
                                    <option value="">Select District</option>
                                    @foreach (App\Models\District::all() as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Block</label>
                                <select id="block_id" name="block_id" class="form-control" required>
                                    <option value="">Select Block</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gram Panchyat</label>
                                <select id="gram_panchyat_id" name="gram_panchyat_id" class="form-control" required>
                                    <option value="">Select Gram Panchyat</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Village</label>
                                <select name="village_id" id="village_id" class="form-control" required>
                                    <option value="">Select Village</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>SHG Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Enter SHG Name"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>SHG Code</label>
                                <input name="code" type="number" class="form-control" placeholder="Enter SHG Code"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>SHG Date of Formation</label>
                                <input name="date_of_formation" type="date" class="form-control"
                                    placeholder="Enter SHG Date" required>
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
                    <th>SHG Name</th>
                    <th>SHG Code</th>
                    <th>SHG Date of Formation</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shgs as $key => $shg)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $shg->name }}</td>
                        <td>{{ $shg->code }}</td>
                        <td>{{ \Carbon\Carbon::parse($shg->date_of_formation)->format('d M, Y') }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#edit_modal" class="edit-btn btn btn-primary"
                                data-id="{{ $shg->id }}" data-name="{{ $shg->name }}"
                                data-code="{{ $shg->code }}" data-date_of_formation="{{ $shg->date_of_formation }}"
                                data-district_id="{{ $shg->district_id }}" data-block_id="{{ $shg->block_id }}"
                                data-gram_panchyat_id="{{ $shg->gram_panchyat_id }}"
                                data-village_id="{{ $shg->village_id }}">
                                Edit
                            </button>

                        </td>
                        <td>
                            <form action="{{ route('project.shg.destroy', $shg->id) }}" method="POST">
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
        <div class="modal-dialog">
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Update SHG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label>District</label>
                            <select name="district_id" id="edit_district" class="form-control" disabled>
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Block -->
                        <div class="form-group">
                            <label>Block</label>
                            <select name="block_id" id="edit_block" class="form-control" required disabled>
                                <option value="">Select Block</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gram Panchayat -->
                        <div class="form-group">
                            <label>Gram Panchayat</label>
                            <select name="gram_panchyat_id" id="edit_panchayat" class="form-control" required disabled>
                                <option value="">Select Panchayat</option>
                                @foreach ($panchayats as $panchayat)
                                    <option value="{{ $panchayat->id }}">{{ $panchayat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Village -->
                        <div class="form-group">
                            <label>Village</label>
                            <select name="village_id" id="edit_village" class="form-control" required disabled>
                                <option value="">Select Village</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="name">SHG Name</label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Enter SHG Name" required>
                        </div>

                        <div class="form-group">
                            <label for="code">SHG Code</label>
                            <input class="form-control" type="number" id="code" name="code"
                                placeholder="Enter SHG Code" required>
                        </div>

                        <div class="form-group">
                            <label for="date_of_formation">SHG Date of Formation</label>
                            <input class="form-control" type="date" id="date_of_formation" name="date_of_formation"
                                placeholder="Enter SHG Date" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            // ---------- CREATE FORM ----------
            $('#district_id').on('change', function() {
                let district_id = $(this).val();
                $('#block_id').html('<option value="">Loading...</option>');
                $('#gram_panchyat_id').html('<option value="">Select Gram Panchayat</option>');
                $('#village_id').html('<option value="">Select Village</option>');
                if (district_id) {
                    $.ajax({
                        url: 'shg-get-blocks/' + district_id,
                        type: 'GET',
                        success: function(data) {
                            $('#block_id').html('<option value="">Select Block</option>');
                            $.each(data, function(key, value) {
                                $('#block_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#block_id').on('change', function() {
                let block_id = $(this).val();
                $('#gram_panchyat_id').html('<option value="">Loading...</option>');
                $('#village_id').html('<option value="">Select Village</option>');
                if (block_id) {
                    $.ajax({
                        url: 'shg-get-panchayats/' + block_id,
                        type: 'GET',
                        success: function(data) {
                            $('#gram_panchyat_id').html(
                                '<option value="">Select Gram Panchayat</option>');
                            $.each(data, function(key, value) {
                                $('#gram_panchyat_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#gram_panchyat_id').on('change', function() {
                let panchayat_id = $(this).val();
                $('#village_id').html('<option value="">Loading...</option>');
                if (panchayat_id) {
                    $.ajax({
                        url: 'shg-get-villages/' + panchayat_id,
                        type: 'GET',
                        success: function(data) {
                            $('#village_id').html('<option value="">Select Village</option>');
                            $.each(data, function(key, value) {
                                $('#village_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });


            // ---------- EDIT FORM (Modal) ----------
            $('.edit-btn').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const code = $(this).data('code');
                const date_of_formation = $(this).data('date_of_formation');
                const district_id = $(this).data('district_id');
                const block_id = $(this).data('block_id');
                const gram_panchyat_id = $(this).data('gram_panchyat_id');
                const village_id = $(this).data('village_id');

                $('#id').val(id);
                $('#name').val(name);
                $('#code').val(code);
                $('#date_of_formation').val(date_of_formation);

                // Set form action dynamically
                let action = '{{ route('project.shg.update', ':id') }}'.replace(':id', id);
                $('#updateForm').attr('action', action);

                // Set dropdowns
                $('#edit_district').val(district_id);
                $('#edit_block').val(block_id);
                $('#edit_panchayat').val(gram_panchyat_id);
                $('#edit_village').val(village_id);

                $('#edit_modal').modal('show');
            });

        });
    </script>
@endsection
