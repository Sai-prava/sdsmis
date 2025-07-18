@extends('crp.layout.index')

@section('title')
    Add New Respondent Master
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Add New Monthly Progress Report</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('crp.pg_monthly_progress_report.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="pg_id">Producer Group</label>
                                <select name="pg_id" class="form-control" required>
                                    <option value="">Select PG</option>
                                    @foreach ($pgs as $pg)
                                        <option value="{{ $pg->id }}">{{ $pg->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Select Month and Year</label>
                                <div class="d-flex gap-2">
                                    <select name="month" id="monthDropdown" class="form-control" required>
                                        <option value="">Month</option>
                                    </select>

                                    <select name="year" id="yearDropdown" class="form-control" required>
                                        <option value="">Year</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meeting held in the Month</label><br>
                                <label><input type="radio" name="meeting_held" value="yes" required
                                        onchange="togglePresenceField()"> Yes</label>
                                <label><input type="radio" name="meeting_held" value="no" required
                                        onchange="togglePresenceField()"> No</label>
                            </div>

                            <div class="form-group col-md-4" id="presenceField" style="display: none;">
                                <label>% of Members Present in Meeting</label>
                                <input name="member_presence_percent" type="number" step="0.01" class="form-control"
                                    placeholder="Enter %">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Amount of Input Sale in the Month (Rs) (A)</label>
                                <input name="input_sale_amount" type="number" step="0.01" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Amount of Output Sale in the Month (Rs) (B)</label>
                                <input name="output_sale_amount" type="number" step="0.01" class="form-control"
                                    required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Total Loan Taken from CLF in this Month (Rs.)</label>
                                <input name="loan_taken" type="number" step="0.01" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Total Loan Returned this Month (Rs.)</label>
                                <input name="loan_returned" type="number" step="0.01" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Total Interest Paid this Month (Rs.)</label>
                                <input name="interest_paid" type="number" step="0.01" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Create <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /basic layout -->

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const monthDropdown = document.getElementById("monthDropdown");
            const yearDropdown = document.getElementById("yearDropdown");

            const months = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            months.forEach(month => {
                const option = document.createElement("option");
                option.value = month;
                option.text = month;
                monthDropdown.appendChild(option);
            });

            const currentYear = new Date().getFullYear();
            for (let year = currentYear - 10; year <= currentYear + 10; year++) {
                const option = document.createElement("option");
                option.value = year;
                option.text = year;
                yearDropdown.appendChild(option);
            }
        });
    </script>

    <script>
        function togglePresenceField() {
            const isMeetingHeld = document.querySelector('input[name="meeting_held"]:checked').value;
            const presenceField = document.getElementById('presenceField');

            if (isMeetingHeld === 'yes') {
                presenceField.style.display = 'block';
                presenceField.querySelector('input').required = true;
            } else {
                presenceField.style.display = 'none';
                presenceField.querySelector('input').required = false;
                presenceField.querySelector('input').value = ''; // Optional: clear value if hidden
            }
        }
    </script>
@endsection
