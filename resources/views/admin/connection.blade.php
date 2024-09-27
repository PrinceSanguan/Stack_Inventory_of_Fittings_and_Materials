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
                <h1 class="m-0">Inventory List of Fitting Materials (For Service Connection)</h1>

                <!-- Print Button -->
                <button id="printTable" class="btn btn-primary mb-3">Print Table</button>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped data-table" id="inventoryTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Reorder Point</th>
                                <th>Inventory No.</th>
                                <th>Item Description</th>
                                <th>Unit</th>
                                <th>Beginning Balance</th>
                                <th>Issuances</th>
                                <th>Unit Price</th>
                                <th>Quantity Stock</th>
                                <th>Inventory Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventorys as $index => $inventory)
                            <tr>
                                <td>{{$inventory->reorder}}</td>
                                <td>{{$inventory->inventory}}</td>
                                <td>{{$inventory->description}}</td>
                                <td>{{$inventory->unit}}</td>
                                <td>{{$inventory->balance}}</td>
                                <td>{{$inventory->issuance}}</td>
                                <td>{{$inventory->price}}</td>
                                <td>{{$inventory->stock}}</td>
                                <td>{{$inventory->value}}</td>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">TOTAL</th>
                                <th>{{$totalBalance}}</th>
                                <th>{{$totalIssuance}}</th>
                                <th>{{$totalPrice}}</th>
                                <th>{{$totalStock}}</th>
                                <td>{{$totalValue}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
<!------------------------------Start Content here------------------------------------------------------------->
            </div>
        </div>
    </div>
</div>


@include('admin.layout.footer')

<script>
  $(document).ready(function() {
      // Initialize DataTable
      $('.data-table').DataTable();
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
      var printContents = document.getElementById('inventoryTable').outerHTML;
      var originalContents = document.body.innerHTML;
  
      // Replace the body content with the table for printing
      document.body.innerHTML = printContents;
  
      window.print();
  
      // Restore original body content
      document.body.innerHTML = originalContents;
      window.location.reload(); // Optional: Reload the page to restore the state
  });
</script>

</body>
</html>
