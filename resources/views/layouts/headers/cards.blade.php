    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        // Initialize Firebase
        var firebaseConfig = {
        apiKey: "AIzaSyDmgAoptjontRRpcmsDqhSXKPB8EjGCUf0",
        authDomain: "kaltrike-booking-app.firebaseapp.com",
        databaseURL: "https://kaltrike-booking-app-default-rtdb.firebaseio.com",
        projectId: "kaltrike-booking-app",
        storageBucket: "kaltrike-booking-app.appspot.com",
        messagingSenderId: "86830654065",
        appId: "1:86830654065:web:7a03b2f2e1f1d8a47e31d0"
        };

        firebase.initializeApp(firebaseConfig);

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

        // Get the driver data from the database
        var driversRef = database.ref('drivers');
        driversRef.once('value').then(function(snapshot) {
            // Get the total number of drivers
            var totalDrivers = snapshot.numChildren();

            // Set the text of the element with ID "totalDrivers" to the total number of drivers
            document.getElementById("totalDrivers").textContent = totalDrivers;
        });

        var usersRef = database.ref('users');
        usersRef.once('value').then(function(snapshot) {
            // Get the total number of users
            var totalUsers = snapshot.numChildren();

            // Set the text of the element with ID "totalUsers" to the total number of users
            document.getElementById("totalUsers").textContent = totalUsers;
        });

        var historyRef = database.ref('All Ride Requests');
        historyRef.once('value').then(function(snapshot) {
            // Get the total number of historyRef
            var historyRef = snapshot.numChildren();

            // Set the text of the element with ID "historyRef" to the total number of users
            document.getElementById("historyRef").textContent = historyRef;
        });

        });
    </script>
    
    
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Registered Driver (Mobile)</h5>
                                    <span class="h2 font-weight-bold mb-0" id="totalDrivers"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">New Users (Mobile)</h5>
                                    <span class="h2 font-weight-bold mb-0" id="totalUsers"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Registered Log</h5>
                                    <span class="h2 font-weight-bold mb-0" id="historyRef"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                <span class="text-nowrap">Since yesterday</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Registered Driver</h5>
                                    <span class="h2 font-weight-bold mb-0"> <a href="#">{{ $totalUsers }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>