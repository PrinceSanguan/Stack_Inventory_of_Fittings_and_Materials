@include('admin.layout.header')
@include('admin.layout.aside')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

<!----------------------------------------Start Content here------------------------------------------>

<style>
    /* Hide action column during print */
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

                <div class="col-sm-6 col-lg-12">
                    <h1 class="m-0">Purchase History</h1>

                    <!-- Print Button -->
                    <button id="printTable" class="btn btn-primary mb-3">Print Table</button>

                    <!-- Filter Buttons -->
                    <div class="btn-group mb-3" role="group" aria-label="Filter options">
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="day">Day</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="week">Week</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="month">Month</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="all">All</button>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped data-table" id="inventoryTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Date</th> <!-- Added Date column -->
                                    <th>Category</th>
                                    <th>Item Description</th>
                                    <th>Issuance</th>
                                    <th>Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $index => $purchase)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($purchase->created_at)->format('F d, Y') }}</td>
                                    <td>{{$purchase->category}}</td>
                                    <td>{{$purchase->description}}</td>
                                    <td>{{$purchase->issuance}}</td>
                                    <td>₱{{$purchase->unit_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
<!------------------------------End Content here------------------------------------------------------------->
            </div>
        </div>
    </div>
</div>

@include('admin.layout.footer')

<script>
  $(document).ready(function() {
      // Initialize DataTable
      var table = $('#inventoryTable').DataTable();

      // Filter buttons
      $('.filter-btn').on('click', function() {
          var filter = $(this).data('filter');
          var startDate, endDate;
          var today = new Date();

          if (filter === 'day') {
              startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());
              endDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);
          } else if (filter === 'week') {
              var firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
              startDate = new Date(firstDayOfWeek.getFullYear(), firstDayOfWeek.getMonth(), firstDayOfWeek.getDate());
              endDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + 7);
          } else if (filter === 'month') {
              startDate = new Date(today.getFullYear(), today.getMonth(), 1);
              endDate = new Date(today.getFullYear(), today.getMonth() + 1, 1);
          } else {
              // Show all data
              table.search('').columns().search('').draw();
              return;
          }

          // Format dates to match the format in the table (assuming 'YYYY-MM-DD')
          var formatDate = function(date) {
              var year = date.getFullYear();
              var month = ('0' + (date.getMonth() + 1)).slice(-2);
              var day = ('0' + date.getDate()).slice(-2);
              return year + '-' + month + '-' + day;
          };

          startDate = formatDate(startDate);
          endDate = formatDate(endDate);

          // Custom filtering function which will search data in column 0 (Date column)
          $.fn.dataTable.ext.search.push(
              function(settings, data, dataIndex) {
                  var date = data[0]; // Use data for the date column
                  if (date >= startDate && date < endDate) {
                      return true;
                  }
                  return false;
              }
          );

          table.draw();

          // Remove the custom filtering function after drawing
          $.fn.dataTable.ext.search.pop();
      });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      @if (session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          confirmButtonText: 'OK'
        });
      @endif
  
      @if (session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '{{ session('error') }}',
          confirmButtonText: 'Try Again'
        });
      @endif
  });
</script>

<script>
    document.getElementById('printTable').addEventListener('click', function() {
        var title = document.querySelector('h1').outerHTML; // Get the H1 title
        var table = document.getElementById('inventoryTable').outerHTML; // Get the table HTML
        var printContents = title + table; // Combine the title and table
  
        var originalContents = document.body.innerHTML;
    
        // Replace the body content with the title and table for printing
        document.body.innerHTML = printContents;
    
        window.print();
    
        // Restore original body content
        document.body.innerHTML = originalContents;
        window.location.reload(); // Optional: Reload the page to restore the state
    });
  </script>

</body>
</html>