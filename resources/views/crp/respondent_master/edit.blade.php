@extends('crp.layout.index')

@section('title')
    Edit {{ $respondent_master->name }} Respondent Master
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Edit {{ $respondent_master->name }} Respondent Master</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('crp.respondent_master.update', $respondent_master->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input name="name" type="text" value="{{ $respondent_master->name }}"
                                    class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Image @if ($respondent_master->image)
                                        <a href="{{ asset($respondent_master->image) }}" target="_blank"> ( Show Image )</a>
                                    @endif
                                </label>
                                <input name="image" type="file" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label>District</label>
                                <select id="district_id" name="district_id" class="form-control select-search" data-fouc
                                    required disabled>
                                    <option selected disabled>Select District</option>
                                    @foreach (App\Models\District::all() as $district)
                                        <option {{ $respondent_master->district_id == $district->id ? 'selected' : '' }}
                                            value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Block</label>
                                <select id="block_id" name="block_id" class="form-control select-search" data-fouc required
                                    disabled>
                                    <option disabled value="">Select Block</option>
                                    @foreach (App\Models\Block::where('district_id', $respondent_master->district_id)->get() as $block)
                                        <option {{ $respondent_master->block_id == $block->id ? 'selected' : '' }}
                                            value="{{ $block->id }}">{{ $block->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Gram Panchyat</label>
                                <select id="gram_panchyat_id" name="gram_panchyat_id" class="form-control select-search"
                                    data-fouc required disabled>
                                    <option disabled value="">Select Gram Panchyat</option>
                                    @foreach (App\Models\GramPanchyat::where('block_id', $respondent_master->block_id)->get() as $gram_panchyat)
                                        <option
                                            {{ $respondent_master->gram_panchyat_id == $gram_panchyat->id ? 'selected' : '' }}
                                            value="{{ $gram_panchyat->id }}">{{ $gram_panchyat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Village</label>
                                <select id="village_id" name="village_id" class="form-control select-search" data-fouc
                                    required disabled>
                                    <option disabled value="">Select Village</option>
                                    @foreach (App\Models\Village::where('gram_panchyat_id', $respondent_master->gram_panchyat_id)->get() as $village)
                                        <option {{ $respondent_master->village_id == $village->id ? 'selected' : '' }}
                                            value="{{ $village->id }}">{{ $village->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>SHG</label>
                                <select id="shg_id" name="shg_id" class="form-control select-search" data-fouc>
                                    <option value="">Select SHG</option>
                                    @foreach (App\Models\SHG::where('village_id', $respondent_master->village_id)->get() as $shg)
                                        <option value="{{ $shg->id }}"
                                            {{ $respondent_master->shg_id == $shg->id ? 'selected' : '' }}>
                                            {{ $shg->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>PG</label>
                                <select id="pg_id" name="pg_id" class="form-control select-search" data-fouc>
                                    <option value="">Select PG</option>
                                    @foreach (App\Models\PG::where('village_id', $respondent_master->village_id)->get() as $pg)
                                        <option value="{{ $pg->id }}"
                                            {{ $respondent_master->pg_id == $pg->id ? 'selected' : '' }}>
                                            {{ $pg->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Gender</label>
                                <select name="gender" class="form-control select-search" data-fouc required>
                                    <option disabled>Select Gender</option>
                                    <option {{ $respondent_master->gender == 'Male' ? 'selected' : '' }} value="Male">
                                        Male
                                    </option>
                                    <option {{ $respondent_master->gender == 'Female' ? 'selected' : '' }} value="Female">
                                        Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Age</label>
                                <input name="age" type="number" step="0.01" value="{{ $respondent_master->age }}"
                                    class="form-control" placeholder="Enter Age" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Education</label>
                                <select name="education" class="form-control select-search" data-fouc required>
                                    <option disabled>Select Education</option>
                                    <option {{ $respondent_master->education == 'Illiterate' ? 'selected' : '' }}
                                        value="Illiterate">Illiterate</option>
                                    <option {{ $respondent_master->education == 'Primary' ? 'selected' : '' }}
                                        value="Primary">
                                        Primary</option>
                                    <option {{ $respondent_master->education == 'HSLC' ? 'selected' : '' }} value="HSLC">
                                        HSLC
                                    </option>
                                    <option {{ $respondent_master->education == 'Graduate' ? 'selected' : '' }}
                                        value="Graduate">Graduate</option>
                                    <option {{ $respondent_master->education == 'PG' ? 'selected' : '' }} value="PG">PG
                                    </option>
                                    <option {{ $respondent_master->education == 'Technical Education' ? 'selected' : '' }}
                                        value="Technical Education">Technical Education</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Number Family Members</label>
                                <input name="number_family_member" value="{{ $respondent_master->number_family_member }}"
                                    type="number" step="0.01" class="form-control"
                                    placeholder="Enter Number Family Member" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Caste</label>
                                <select name="caste" class="form-control select-search" data-fouc required>
                                    <option disabled>Select Caste</option>
                                    <option {{ $respondent_master->caste == 'ST' ? 'selected' : '' }} value="ST">ST
                                    </option>
                                    <option {{ $respondent_master->caste == 'SC' ? 'selected' : '' }} value="SC">SC
                                    </option>
                                    <option {{ $respondent_master->caste == 'OBC' ? 'selected' : '' }} value="OBC">OBC
                                    </option>
                                    <option {{ $respondent_master->caste == 'General' ? 'selected' : '' }} value="General">
                                        General</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Religion</label>
                                <select name="religion" class="form-control select-search" data-fouc required>
                                    <option disabled>Select Religion</option>
                                    <option {{ $respondent_master->religion == 'Hindu' ? 'selected' : '' }}
                                        value="Hindu">
                                        Hindu</option>
                                    <option {{ $respondent_master->religion == 'Muslim' ? 'selected' : '' }}
                                        value="Muslim">
                                        Muslim</option>
                                    <option {{ $respondent_master->religion == 'Christian' ? 'selected' : '' }}
                                        value="Christian">Christian</option>
                                    <option {{ $respondent_master->religion == 'Buddhist' ? 'selected' : '' }}
                                        value="Buddhist">Buddhist</option>
                                    <option {{ $respondent_master->religion == 'Others' ? 'selected' : '' }}
                                        value="Others">
                                        Others</option>
                                </select>
                            </div>
                        </div>
                        {{-- @if (!$respondent_master->is_validate) --}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Edit <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                        {{-- @endif --}}

                    </form>
                </div>
            </div>
            <!-- /basic layout -->

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // District -> Block
            $('#district_id').change(function() {
                let district_id = $(this).val();
                $.ajax({
                    url: "{{ route('crp.monthly_farming_report.get_blocks') }}",
                    method: 'post',
                    data: {
                        district_id: district_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        let blocks = response.blocks;
                        $('#block_id').empty().append('<option value="">Select Block</option>');
                        $('#gram_panchyat_id').empty().append(
                            '<option value="">Select Gram Panchyat</option>');
                        $('#village_id').empty().append(
                            '<option value="">Select Village</option>');
                        $('#shg_id').empty().append('<option value="">Select SHG</option>');
                        $('#pg_id').empty().append('<option value="">Select PG</option>');
                        for (let i = 0; i < blocks.length; i++) {
                            $('#block_id').append('<option value="' + blocks[i].id + '">' +
                                blocks[i].name + '</option>');
                        }
                    }
                });
            });
            // Block -> Gram Panchyat
            $('#block_id').change(function() {
                let block_id = $(this).val();
                $.ajax({
                    url: "{{ route('crp.monthly_farming_report.get_gram_panchyats') }}",
                    method: 'post',
                    data: {
                        block_id: block_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        let gram_panchyats = response.gram_panchyats;
                        $('#gram_panchyat_id').empty().append(
                            '<option value="">Select Gram Panchyat</option>');
                        $('#village_id').empty().append(
                            '<option value="">Select Village</option>');
                        $('#shg_id').empty().append('<option value="">Select SHG</option>');
                        $('#pg_id').empty().append('<option value="">Select PG</option>');
                        for (let i = 0; i < gram_panchyats.length; i++) {
                            $('#gram_panchyat_id').append('<option value="' + gram_panchyats[i]
                                .id + '">' + gram_panchyats[i].name + '</option>');
                        }
                    }
                });
            });
            // Gram Panchyat -> Village
            $('#gram_panchyat_id').change(function() {
                let gram_panchyat_id = $(this).val();
                $.ajax({
                    url: "{{ route('crp.monthly_farming_report.get_villages') }}",
                    method: 'post',
                    data: {
                        gram_panchyat_id: gram_panchyat_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        let villages = response.villages;
                        $('#village_id').empty().append(
                            '<option value="">Select Village</option>');
                        $('#shg_id').empty().append('<option value="">Select SHG</option>');
                        $('#pg_id').empty().append('<option value="">Select PG</option>');
                        for (let i = 0; i < villages.length; i++) {
                            $('#village_id').append('<option value="' + villages[i].id + '">' +
                                villages[i].name + '</option>');
                        }
                    }
                });
            });
            $('#village_id').change(function() {
                let village_id = $(this).val();

                // SHG AJAX
                $.ajax({
                    url: "{{ route('crp.monthly_farming_report.get_shgs') }}",
                    method: 'post',
                    data: {
                        village_id: village_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#shg_id').empty().append('<option value="">Select SHG</option>');
                        if (response.shgs && Array.isArray(response.shgs)) {
                            response.shgs.forEach(function(shg) {
                                $('#shg_id').append(
                                    '<option value="' + shg.id + '">' + shg.name +
                                    '</option>'
                                );
                            });
                        }
                    }
                });

                // PG AJAX
                $.ajax({
                    url: "{{ route('crp.monthly_farming_report.get_pgs') }}",
                    method: 'post',
                    data: {
                        village_id: village_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#pg_id').empty().append('<option value="">Select PG</option>');
                        if (response.pgs && Array.isArray(response.pgs)) {
                            response.pgs.forEach(function(pg) {
                                $('#pg_id').append(
                                    '<option value="' + pg.id + '">' + pg.name +
                                    '</option>'
                                );
                            });
                        }
                    }
                });
            });

        });
    </script>
@endsection
