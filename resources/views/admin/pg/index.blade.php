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
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>PG Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Enter PG Name"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>PG Code</label>
                                <input name="code" type="number" class="form-control" placeholder="Enter PG Code"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>PG Date of Formation</label>
                                <input name="date_of_formation" type="date" class="form-control"
                                    placeholder="Enter PG Date" required>
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
                            <button data-toggle="modal" data-target="#edit_modal" class="edit-btn btn btn-primary"
                                data-id="{{ $pg->id }}" data-name="{{ $pg->name }}"
                                data-code="{{ $pg->code }}" data-date_of_formation="{{ $pg->date_of_formation }}">
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
        <div class="modal-dialog">
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Update PG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">

                        <div class="form-group">
                            <label for="name">PG Name</label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Enter SHG Name" required>
                        </div>

                        <div class="form-group">
                            <label for="code">PG Code</label>
                            <input class="form-control" type="number" id="code" name="code"
                                placeholder="Enter SHG Code" required>
                        </div>

                        <div class="form-group">
                            <label for="date_of_formation">PG Date of Formation</label>
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
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                // Get data from button
                const id = $(this).data('id');
                const name = $(this).data('name');
                const code = $(this).data('code');
                const date_of_formation = $(this).data('date_of_formation');

                $('#id').val(id);
                $('#name').val(name);
                $('#code').val(code);
                $('#date_of_formation').val(date_of_formation);
                let action = '{{ route('admin.pg.update', ':id') }}';
                action = action.replace(':id', id);
                $('#updateForm').attr('action', action);
            });
        });
    </script>
@endsection
