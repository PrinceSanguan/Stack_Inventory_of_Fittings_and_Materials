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
                <h1 class="m-0">Dashboard</h1>

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
                                <th class="no-print">Action</th>
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
                                <td class="no-print">
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-success btn-sm flex-grow-1 me-2" 
                                                data-id="{{$inventory->id}}"
                                                data-reorder="{{$inventory->reorder}}"
                                                data-inventory="{{$inventory->inventory}}"
                                                data-description="{{$inventory->description}}"
                                                data-unit="{{$inventory->unit}}"
                                                data-balance="{{$inventory->balance}}"
                                                data-issuance="{{$inventory->issuance}}"
                                                data-price="{{$inventory->price}}"
                                                data-stock="{{$inventory->stock}}"
                                                data-value="{{$inventory->value}}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm flex-grow-1 delete-button" data-id="{{$inventory->id}}">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="editForm" method="post" action="{{route('admin.update-category')}}">
                @csrf
                  <input type="hidden" id="inventoryId" name="inventoryId">
                  <div class="mb-3">
                    <label class="form-label">Item Reorder Point</label>
                    <input type="text" class="form-control" id="itemReorder" name="itemReorder" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Inventory No.</label>
                  <input type="number" class="form-control" id="itemInventory" name="itemInventory" required min="0">
              </div>
                  <div class="mb-3">
                      <label class="form-label">Item Description</label>
                      <input type="text" class="form-control" id="itemDescription" name="itemDescription" required>
                  </div>
                  <div class="form-group">
                    <label for="unit">Unit</label>
                    <select name="unit" id="unit" class="form-control" required>
                        <option value="" disabled selected>Select a unit</option>
                        <option value="roll">Roll</option>
                        <option value="pcs">Pcs</option>
                        <option value="each/box">Each/Box</option>
                        <option value="Each">Each</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Beginning Balance</label>
                    <input type="number" class="form-control" id="itemBalance" name="itemBalance" required min="0">
                </div>
                <div class="mb-3">
                  <label class="form-label">Issuance</label>
                  <input type="number" class="form-control" id="itemIssuance" name="itemIssuance" required min="0">
                </div>
                <div class="mb-3">
                  <label class="form-label">Unit Price</label>
                  <input type="number" class="form-control" id="itemPrice" name="itemPrice" required min="0">
                </div>
                <div class="mb-3">
                  <label class="form-label">Quantity Stock</label>
                  <input type="number" class="form-control" id="itemStock" name="itemStock" required min="0">
                </div>
                <div class="mb-3">
                  <label class="form-label">Quantity Stock</label>
                  <input type="number" class="form-control" id="itemValue" name="itemValue" required min="0">
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" form="editForm">Save changes</button>
          </div>
      </div>
   </div>
</div>


@include('admin.layout.footer')

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('.data-table').DataTable();

    // Event listener for edit button clicks
    $(document).on('click', '.btn-success', function() {
        var inventoryId = $(this).data('id');
        var itemReorder = $(this).data('reorder');
        var itemInventory = $(this).data('inventory');
        var itemDescription = $(this).data('description');
        var itemBalance = $(this).data('balance');
        var itemIssuance = $(this).data('issuance');
        var itemPrice = $(this).data('price');
        var itemStock = $(this).data('stock');
        var itemValue = $(this).data('value');
        // Set values in the modal form
        $('#inventoryId').val(inventoryId);
        $('#itemReorder').val(itemReorder);
        $('#itemInventory').val(itemInventory);
        $('#itemDescription').val(itemDescription);
        $('#itemBalance').val(itemBalance);
        $('#itemIssuance').val(itemIssuance); 
        $('#itemPrice').val(itemPrice);
        $('#itemStock').val(itemStock);
        $('#itemValue').val(itemValue);
  
        
        // Show the modal (using Bootstrap 4 syntax)
        $('#editModal').modal('show');
    });
});
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
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

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $(document).on('click', '.delete-button', function() {
            var id = $(this).data('id'); // Get the inventory ID
    
            // SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/dashboard/delete/' + id, // Your delete route
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your item has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to see the changes
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr); // Log the error for debugging
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while trying to delete the item: ' + xhr.responseText,
                            });
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>
