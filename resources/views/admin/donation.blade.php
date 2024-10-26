@include('admin.layout.header')
@include('admin.layout.aside')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
<!----------------------------------------Start Content here------------------------------------------>

<style>
    /* Print styles */
    @media print {
        .no-print {
            display: none !important;
        }

        .header-container {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            width: 100% !important;
            page-break-inside: avoid !important;
        }

        .header-container h2 {
            display: inline-block !important;
            margin: 0 !important;
            padding-right: 30px !important;
        }

        .header-container img {
            display: inline-block !important;
            height: 50px !important;
            vertical-align: middle !important;
            margin-bottom: 100px !important;
        }

        h1, h3 {
            text-align: center !important;
            margin-bottom: 10px !important;
        }
    }

    /* Normal display styles */
    .header-container {
        display: flex;
        align-items: center; /* Aligns items vertically centered */
    }

    .header-container img {
        display: none; /* Optional: add some space between the text and image */
    }

</style>

            <div class="col-sm-6 col-lg-12">
                <h1>METRO SIARGAO WATER DISTRICT</h1>
                <h3>Dapa, Surigao Del Norte</h3>
                <div class="header-container"><h1 class="m-0">
                    <h2 class="m-0">Inventory List of Fittings Donation</h2>
                    <img src="{{asset('images/sijm.jpg')}}" alt="" style="height: 50px; ">
                </div>
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
                                <td>{{$inventory->inventory_no}}</td>
                                <td>{{$inventory->description}}</td>
                                <td>{{$inventory->unit}}</td>
                                <td>{{$inventory->beginning_balance}}</td>
                                <td>{{$inventory->issuance}}</td>
                                <td>{{$inventory->unit_price}}</td>
                                <td>{{$inventory->quantity}}</td>
                                <td>₱{{ number_format($inventory->quantity * $inventory->unit_price, 2) }}</td>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">TOTAL</th>
                                <th>{{$totalBalance}}</th>
                                <th>{{$totalIssuance}}</th>
                                <th>₱{{$totalPrice}}</th>
                                <th>{{$totalQuantity}}</th>
                                <td>₱{{ number_format($totalInventoryValue, 2) }}</td>
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
        // Create a new window for printing
        var printWindow = window.open('', '_blank');
        
        // Get the content
        var title1 = document.querySelector('h1').outerHTML;
        var content = document.querySelector('h3').outerHTML;
        var headerContainer = document.querySelector('.header-container').outerHTML;
        var table = document.getElementById('inventoryTable').outerHTML;
        
        // Combine all styles
        var styles = `
            <style>
                @media print {
                    .header-container {
                        display: flex !important;
                        flex-direction: row !important;
                        align-items: center !important;
                        width: 100% !important;
                        page-break-inside: avoid !important;
                    }
                    .header-container h2 {
                        display: inline-block !important;
                        margin: 0 !important;
                        padding-right: 20px !important;
                    }
                    .header-container img {
                        display: inline-block !important;
                        height: 50px !important;
                        vertical-align: middle !important;
                        margin-bottom: 10px !important;
                        margin-left: 270px !important;
                    }
                    h1, h3 {
                        text-align: center !important;
                        margin-bottom: 10px !important;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                }
            </style>
        `;
        
        // Combine everything
        var printContent = `
            <!DOCTYPE html>
            <html>
            <head>
                ${styles}
            </head>
            <body>
                ${title1}
                ${content}
                ${headerContainer}
                ${table}
            </body>
            </html>
        `;
        
        // Write to the new window and print
        printWindow.document.write(printContent);
        printWindow.document.close();
        
        // Wait for images to load before printing
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    });
</script>

</body>
</html>

