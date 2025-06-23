@extends('project.layout.index')
@section('title')
    Farmer Card - {{ $farmerdetailview->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="farmerTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="farmer-card-tab" data-bs-toggle="tab" data-bs-target="#farmer-card"
                        type="button" role="tab" aria-controls="farmer-card" aria-selected="true">
                        <i class="fas fa-id-card me-2"></i>Farmer Card
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="monthly-report-tab" data-bs-toggle="tab" data-bs-target="#monthly-report"
                        type="button" role="tab" aria-controls="monthly-report" aria-selected="true">
                        <i class="fas fa-chart-line me-2"></i>Monthly Farming Report
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="farmerTabsContent">
                <!-- Farmer Card Tab -->
                <div class="tab-pane fade show active" id="farmer-card" role="tabpanel" aria-labelledby="farmer-card-tab">
                    <!-- Farmer Card -->
                    <div class="card shadow" style="border: 2px solid #2c3e50; border-radius: 10px;">
                        <!-- Card Header -->
                        <div class="card-header text-center py-3"
                            style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); color: white; border-radius: 8px 8px 0 0;">
                            <h4 class="mb-1">
                                <i class="fas fa-id-card me-2"></i>
                                FARMER CARD
                            </h4>
                            <small>Government of India</small>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4">
                            <div class="row">
                                <!-- Photo Section -->
                                <div class="col-md-4 text-center mb-3">
                                    <div class="position-relative d-inline-block">
                                        @if ($farmerdetailview->image)
                                            <img src="{{ asset($farmerdetailview->image) }}" alt="Farmer Photo"
                                                class="img-fluid rounded"
                                                style="width: 120px; height: 150px; object-fit: cover; border: 3px solid #2c3e50;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 120px; height: 150px; border: 3px solid #2c3e50;">
                                                <i class="fas fa-user fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <!-- Verification Badge -->
                                        <div class="position-absolute top-0 end-0">
                                            <div class="bg-success rounded-circle p-1" style="width: 25px; height: 25px;">
                                                <i class="fas fa-check text-white" style="font-size: 12px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details Section -->
                                <div class="col-md-8">
                                    <!-- Name and ID -->
                                    <div class="mb-3">
                                        <h5 class="text-primary mb-1">{{ $farmerdetailview->name }}</h5>
                                        <p class="text-muted mb-0"><strong>Farmer ID:</strong>
                                            {{ $farmerdetailview->farmer_id }}
                                        </p>
                                    </div>

                                    <!-- Personal Details -->
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <small class="text-muted">Age</small><br>
                                            <strong>{{ $farmerdetailview->age }} years</strong>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <small class="text-muted">Gender</small><br>
                                            <strong>{{ $farmerdetailview->gender }}</strong>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <small class="text-muted">Education</small><br>
                                            <strong>{{ $farmerdetailview->education }}</strong>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <small class="text-muted">Family Members</small><br>
                                            <strong>{{ $farmerdetailview->number_family_member }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-2">

                            <!-- Address Section -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h6 class="text-primary"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h6>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">District</small><br>
                                    <strong>{{ $farmerdetailview->district->name }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Block</small><br>
                                    <strong>{{ $farmerdetailview->block->name }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Gram Panchayat</small><br>
                                    <strong>{{ $farmerdetailview->gram_panchyat->name }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Village</small><br>
                                    <strong>{{ $farmerdetailview->village->name }}</strong>
                                </div>
                            </div>


                            <!-- Additional Details -->
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Caste</small><br>
                                    <strong>{{ $farmerdetailview->caste }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Religion</small><br>
                                    <strong>{{ $farmerdetailview->religion }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer text-center py-2"
                            style="background-color: #ecf0f1; border-radius: 0 0 8px 8px;">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Issued on: {{ date('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Monthly Farming Report Tab -->
                <div class="tab-pane fade" id="monthly-report" role="tabpanel" aria-labelledby="monthly-report-tab">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-line me-2"></i>
                                Monthly Farming Report - {{ $farmerdetailview->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($monthly_farming_reports->count() > 0)
                                <!-- Filter Section -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label for="month" class="form-label">Select Month</label>
                                        <select class="form-select" id="month">
                                            <option value="">All Months</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="year" class="form-label">Select Year</label>
                                        <select class="form-select" id="year">
                                            <option value="">All Years</option>
                                            @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="button" class="btn btn-primary" onclick="filterReports()">
                                            <i class="fas fa-filter me-2"></i>Filter
                                        </button>
                                        <button type="button" class="btn btn-secondary ms-2" onclick="clearFilter()">
                                            <i class="fas fa-times me-2"></i>Clear
                                        </button>
                                    </div>
                                </div>

                                <!-- Reports Table -->
                                <table class="table table-striped w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Month/Year</th>
                                            <th>Fish Quantity</th>
                                            <th>Fish Amount (₹)</th>
                                            <th>Fry Amount (₹)</th>
                                            <th>Feed Amount (₹)</th>
                                            <th>Total Expenditure (₹)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthly_farming_reports as $report)
                                            <tr data-report-id="{{ $report->id }}">
                                                <td>{{ \Carbon\Carbon::parse($report->date_of_update)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($report->date_of_update)->format('F Y') }}</td>
                                                <td>{{ $report->fish_quantity ?? '0' }}</td>
                                                <td>₹{{ number_format($report->fish_amount ?? 0) }}</td>
                                                <td>₹{{ number_format($report->fry_amount ?? 0) }}</td>
                                                <td>₹{{ number_format(($report->mash_feed_amount ?? 0) + ($report->commerical_feed_amount ?? 0)) }}</td>
                                                <td>₹{{ number_format(
                                                    ($report->fish_amount ?? 0) +
                                                    ($report->fry_amount ?? 0) +
                                                    ($report->mash_feed_amount ?? 0) +
                                                    ($report->commerical_feed_amount ?? 0) +
                                                    ($report->mineral_amount ?? 0) +
                                                    ($report->lime_amount ?? 0) +
                                                    ($report->netting_expenditure ?? 0)
                                                ) }}</td>
                                                <td>
                                                    @if ($report->fish_quantity > 0)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">In Progress</span>
                                                    @endif
                                                </td>
                                                <td>
                                                   <a href="{{ route('project.report.farmering_card', $report->id) }}" class="btn btn-primary btn-sm">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                

                                <!-- Summary Cards -->
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="card bg-primary text-white">
                                            <div class="card-body text-center">
                                                <h6>Total Reports</h6>
                                                <h4>{{ $monthly_farming_reports->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-success text-white">
                                            <div class="card-body text-center">
                                                <h6>Total Fish Amount</h6>
                                                <h4>₹{{ number_format($monthly_farming_reports->sum('fish_amount')) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-info text-white">
                                            <div class="card-body text-center">
                                                <h6>Total Fry Amount</h6>
                                                <h4>₹{{ number_format($monthly_farming_reports->sum('fry_amount')) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-warning text-white">
                                            <div class="card-body text-center">
                                                <h6>Total Feed Amount</h6>
                                                <h4>₹{{ number_format($monthly_farming_reports->sum('mash_feed_amount') + $monthly_farming_reports->sum('commerical_feed_amount')) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                {{-- <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel">Farmer Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" id="modalContent">
                                                <!-- Dynamic content goes here -->
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                                <!-- Detailed Report Modals -->
                                {{-- @foreach ($monthly_farming_reports as $report)
                                    <div class="modal fade" id="reportDetailModal{{ $report->id }}" tabindex="-1" aria-labelledby="reportDetailModalLabel{{ $report->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportDetailModalLabel{{ $report->id }}">
                                                        Monthly Farming Report - {{ \Carbon\Carbon::parse($report->date_of_update)->format('F Y') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Basic Information -->
                                                        <div class="col-md-6">
                                                            <h6 class="text-primary mb-3">Basic Information</h6>
                                                            <div class="mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($report->date_of_update)->format('d/m/Y') }}</div>
                                                            <div class="mb-2"><strong>Month/Year:</strong> {{ \Carbon\Carbon::parse($report->date_of_update)->format('F Y') }}</div>
                                                            <div class="mb-2"><strong>Location:</strong> {{ $report->location ?? 'N/A' }}</div>
                                                            <div class="mb-2"><strong>Stocking:</strong> {{ $report->is_stocking ? 'Yes' : 'No' }}</div>
                                                            <div class="mb-2"><strong>Providing Feed:</strong> {{ $report->is_providing_feed ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        
                                                        <!-- Financial Summary -->
                                                        <div class="col-md-6">
                                                            <h6 class="text-primary mb-3">Financial Summary</h6>
                                                            <div class="mb-2"><strong>Fish Quantity:</strong> {{ $report->fish_quantity ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Fish Amount:</strong> ₹{{ number_format($report->fish_amount ?? 0) }}</div>
                                                            <div class="mb-2"><strong>Fry Amount:</strong> ₹{{ number_format($report->fry_amount ?? 0) }}</div>
                                                            <div class="mb-2"><strong>Feed Amount:</strong> ₹{{ number_format(($report->mash_feed_amount ?? 0) + ($report->commerical_feed_amount ?? 0)) }}</div>
                                                            <div class="mb-2"><strong>Total Expenditure:</strong> ₹{{ number_format(($report->fish_amount ?? 0) + ($report->fry_amount ?? 0) + ($report->mash_feed_amount ?? 0) + ($report->commerical_feed_amount ?? 0) + ($report->mineral_amount ?? 0) + ($report->lime_amount ?? 0) + ($report->netting_expenditure ?? 0)) }}</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row mt-3">
                                                        <!-- Fry Details -->
                                                        <div class="col-md-6">
                                                            <h6 class="text-primary mb-3">Fry Details</h6>
                                                            <div class="mb-2"><strong>Total Fry Quantity:</strong> {{ $report->fry_quantity ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Catia Fry:</strong> {{ $report->catia_fry ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Rahu Fry:</strong> {{ $report->rahu_fry ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Mirgal Fry:</strong> {{ $report->mirgal_fry ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Common Carp Fry:</strong> {{ $report->common_carp_fry ?? '0' }}</div>
                                                        </div>
                                                        
                                                        <!-- Feed Details -->
                                                        <div class="col-md-6">
                                                            <h6 class="text-primary mb-3">Feed Details</h6>
                                                            <div class="mb-2"><strong>Number of Feeds:</strong> {{ $report->number_of_feed ?? '0' }}</div>
                                                            <div class="mb-2"><strong>Mash Feed Amount:</strong> ₹{{ number_format($report->mash_feed_amount ?? 0) }}</div>
                                                            <div class="mb-2"><strong>Commercial Feed Amount:</strong> ₹{{ number_format($report->commerical_feed_amount ?? 0) }}</div>
                                                            <div class="mb-2"><strong>Mineral Amount:</strong> ₹{{ number_format($report->mineral_amount ?? 0) }}</div>
                                                            <div class="mb-2"><strong>Lime Amount:</strong> ₹{{ number_format($report->lime_amount ?? 0) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Monthly Farming Reports Found</h5>
                                    <p class="text-muted">This farmer doesn't have any monthly farming reports yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary me-2">
                    <i class="fas fa-print me-2"></i>Print Card
                </button>
                <a href="{{ route('project.report.farmer-card') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {

            .btn,
            .text-center:last-child,
            .nav-tabs {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 2px solid #2c3e50 !important;
            }

            body {
                background: white !important;
            }

            .tab-pane {
                display: block !important;
            }
        }

        .card {
            transition: transform 0.2s ease;
        }

        .text-muted {
            font-size: 115% !important;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .text-primary {
            color: #2c3e50 !important;
        }

        .bg-success {
            background-color: #5ccc8c !important;
        }

        hr {
            border-color: #bdc3c7;
        }

        .nav-tabs .nav-link {
            color: #2c3e50;
            border: none;
            border-bottom: 2px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #2c3e50;
            background-color: transparent;
            border-bottom: 2px solid #2c3e50;
            font-weight: bold;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent;
            border-bottom: 2px solid #bdc3c7;
        }

        /* Modal vibration fix */
        .modal {
            overflow-y: auto !important;
        }

        .modal-dialog {
            margin: 1.75rem auto;
            max-width: 90%;
        }

        .modal-content {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Fix modal blinking */
        .modal.fade .modal-dialog {
            transition: transform 0.15s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden !important;
            padding-right: 0 !important;
        }

        /* Ensure modal backdrop is stable */
        .modal-backdrop {
            opacity: 0.5 !important;
        }

        .modal-backdrop.show {
            opacity: 0.5 !important;
        }

        /* Fix modal animation */
        .modal.fade {
            transition: opacity 0.15s linear;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.15s ease-out;
        }

        /* Prevent multiple backdrops */
        .modal-backdrop+.modal-backdrop {
            display: none !important;
        }

        /* Ensure modal stays on top */
        .modal {
            z-index: 1055 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterReports() {
            var selectedMonth = document.getElementById('month').value;
            var selectedYear = document.getElementById('year').value;
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function(row) {
                var monthYear = row.children[1].innerText.trim(); // e.g., "March 2024"
                var [monthName, year] = monthYear.split(' ');
                var monthNum = (new Date(Date.parse(monthName + " 1, 2000"))).getMonth() + 1;
                monthNum = monthNum < 10 ? '0' + monthNum : '' + monthNum;
                var show = true;
                if (selectedMonth && monthNum !== selectedMonth) show = false;
                if (selectedYear && year !== selectedYear) show = false;
                row.style.display = show ? '' : 'none';
            });
        }

        function clearFilter() {
            document.getElementById('month').value = '';
            document.getElementById('year').value = '';
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function(row) {
                row.style.display = '';
            });
        }
    </script>
@endsection
