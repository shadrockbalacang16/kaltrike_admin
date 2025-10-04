@extends('layouts.app')

@section('content')
    @include('layouts.headers.guest')

  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

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

      // Get a reference to the database
      var database = firebase.database();

      // Create a table and add the header row
      var table = '<table class="table"><thead><tr><th>Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr></thead><tbody>';

      // Get the driver data from the database
      var driversRef = database.ref('users');
      driversRef.once('value').then(function(snapshot) {
      snapshot.forEach(function(childSnapshot) {
        // Get the driver data
        var driverData = childSnapshot.val();

        // Add a new row to the table with the driver data
        table += '<tr><td>' + driverData.name + '</td><td>' + driverData.name + '</td><td>' + driverData.email + '</td><td>' + driverData.phone + '</td></tr>';
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
    
<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
          <div class="d-flex justify-content-between">
              <div class="card-header border-0">
                <h3 class="mb-0">Users</h3>
              </div>
              <button class="btn btn-icon bg-success" style="height: 50px; margin-top: 5px; margin-right: 5px; color: azure;" type="button" id="exportButton">
                <span class="btn-inner--icon"><i class="ni ni-folder-17"></i></span>
                <span class="btn-inner--text">Export to Excel</span>
              </button>
            </div>
            
                <div class="card-body">
                  <div style="overflow-x: auto;-webkit-overflow-scrolling: touch;">
                    <table class="table" id="driverTable" style="font-size: 1rem;padding: 1rem;">
                      <!-- table content here -->
                    </table>
                  </div>
                </div>
                
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush