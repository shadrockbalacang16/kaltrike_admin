@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Add Firebase SDK script to HTML head tag -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>

    <script>
        // Initialize Firebase
        var firebaseConfig = {
            apiKey: "",
            authDomain: "",
            databaseURL: "",
            projectId: "",
            storageBucket: "",
            messagingSenderId: "",
            appId: ""
        };

        firebase.initializeApp(firebaseConfig);

        // Initialize Firebase Analytics
        firebase.analytics();

        // Log an event
        firebase.analytics().logEvent('page_view');

        // Get a reference to the database
        var database = firebase.database();

        // Create a table and add the header row
        var table = '<table class="table"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Plate Number</th><th>Permit Number</th><th>Earnings</th><th>Ratings</th></tr></thead><tbody>';

        // Get the driver data from the database
        var driversRef = database.ref('drivers');
        driversRef.once('value').then(function(snapshot) {
        snapshot.forEach(function(childSnapshot) {
        // Get the driver data
        var driverData = childSnapshot.val();

        // Add a new row to the table with the driver data
        table += '<tr><td>' + driverData.name + '</td><td>' + driverData.email + '</td><td>' + driverData.phone + '</td><td>' + driverData.vechicle_details.plate_number + '</td><td>'+ driverData.vechicle_details.vehicle_permit + '</td><td>' + driverData.earnings + '</td><td>' + driverData.ratings + '</td></tr>';
        });

        // Close the table
        table += '</tbody></table>';

        // Add the table to the page
        $('#driverTable').html(table);

        // Add export button
        $('#exportButton').click(function() {
        // Convert the table to a worksheet object
        var worksheet = XLSX.utils.table_to_sheet($('#driverTable')[0]);

        // Convert the worksheet object to a workbook object
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Driver Information');

        // Save the workbook as an Excel file
        var date = new Date().toISOString().slice(0, 10);
        var filename = 'Driver Information (' + date + ').xlsx';
        XLSX.writeFile(workbook, filename);
        });
        });
    </script>
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Registered Drivers</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>

                    <!-- Start Show To Modal -->
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <div class="card-body">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Middle Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Permit Number</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <span class="block-email">{{ $user->middlename }}</span>
                                        </td>
                                        <td>
                                            <span class="block-email">{{ $user->lastname }}</span>
                                        </td>
                                        <td>
                                            <span class="block-email">{{ $user->email }}</span>
                                        </td>
                                        <td>
                                            <span class="block-email">{{ $user->permitnumber }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-primary view-user" data-user-id="{{ $user->id }}"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="user-modal-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="user-modal-label"><b>Driver Details</b></h3>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> <span id="user-name"></span></p>
                                            <p><strong>Middle Name:</strong> <span id="user-middlename"></span></p>
                                            <p><strong>Last Name:</strong> <span id="user-lastname"></span></p>
                                            <p><strong>Permit Number:</strong> <span id="user-permitnumber"></span></p>
                                            <p><strong>Email:</strong> <span id="user-email"></span></p>
                                            <img id="permit-image" class="img-fluid" src="" alt="permit"/>
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- end Show To Modal -->
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                    <h2 class="mb-0">Total Users</h2>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                    <canvas id="chart-orders" class="chart-canvas"></canvas>
                </div>
                </div>
            </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

<!-- Script start -->
<!-- Required dependencies for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('.view-user').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('user-id');
            $.ajax({

                url: '{{ route("dashboard.getuser", ":id") }}'.replace(':id', userId),
                method: 'GET',
                success: function(response) {
                    var user = response.user;
                    $('#user-modal .modal-body #user-name').text(user.name);
                    $('#user-modal .modal-body #user-middlename').text(user.middlename);
                    $('#user-modal .modal-body #user-lastname').text(user.lastname);
                    $('#user-modal .modal-body #user-permitnumber').text(user.permitnumber);
                    $('#user-modal .modal-body #user-email').text(user.email);
                    $('#user-modal .modal-body #permit-image').attr('src', "{{ asset('storage/permits/') }}/" + user.permit);
                    $('#user-modal').modal('show');
                },
                error: function(xhr) {
                    alert('Error loading user data.');
                }
            });
        });
    });
</script>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush