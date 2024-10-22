@include('admin.layout.header')
@include('admin.layout.aside')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 col-lg-12">
          
          <!-- Main Card UI -->
          <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4 text-primary">Create Purchase Order</h1>

            <form action="{{route('admin.add-purchase')}}" method="post" class="purchase-order-form">
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="category">Order Category</label>
                    <select name="category" id="category" class="form-control" required>
                      <option value="" disabled selected>Select Category</option>
                      <option value="connection">Service Connection</option>
                      <option value="repair">Repair and Maintenance</option>
                      <option value="subsidy">30M NG Subsidy Project</option>
                      <option value="donation">Donation</option>
                      <option value="maintenance">Gen. Set</option>
                      <option value="mswd">MSWD Inventory</option>
                      <option value="accountable">Accountable Forms</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description">Item Description</label>
                    <select name="description" id="description" class="form-control" required>
                      <option value="" disabled selected>Select Description</option>
                      <!-- Options will be populated dynamically -->
                    </select>
                  </div>
                  
                  <div class="form-group">
                      <label for="quantity">Quantity</label>
                      <input type="number" id="quantity" name="quantity" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label for="inventory_no">Inventory Number</label>
                    <input type="number" id="inventory_no" name="inventory_no" class="form-control" readonly>
                </div>
                  
                  <div class="form-group">
                      <label for="unit">Unit</label>
                      <input type="text" id="unit" name="unit" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" id="unit_price" name="unit_price" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label for="issuance">Issuance</label>
                    <input type="number" name="issuance" class="form-control" placeholder="Enter Issuance" required min="1">
                  </div>

                </div>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg">
                  <i class="fas fa-paper-plane"></i> Submit Purchase Order
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.layout.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<script>
  // Wait for document to be ready
  $(document).ready(function() {
      // Handle category change
      $('#category').change(function() {
          const category = $(this).val();
          
          // Reset description dropdown and form fields
          $('#description').html('<option value="" disabled selected>Select Description</option>');
          resetFormFields();
          
          // Fetch descriptions for selected category
          $.ajax({
              url: '/admin/purchase/get-descriptions',  // You'll need to define this route
              method: 'POST',
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  category: category
              },
              success: function(response) {
                  let descriptionSelect = $('#description');
                  
                  response.forEach(function(item) {
                      descriptionSelect.append(
                          $('<option>', {
                              value: item.description,
                              text: item.description
                          })
                      );
                  });
              },
              error: function(xhr) {
                  console.error('Error fetching descriptions:', xhr);
                  alert('Error fetching item descriptions. Please try again.');
              }
          });
      });

      // Handle description change
      $('#description').change(function() {
          const description = $(this).val();
          const category = $('#category').val();
          
          // Fetch item details
          $.ajax({
              url: '/admin/purchase/get-item-details',  // You'll need to define this route
              method: 'POST',
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  category: category,
                  description: description
              },
              success: function(response) {
                  // Populate form fields
                  $('#quantity').val(response.quantity);
                  $('#inventory_no').val(response.inventory_no);
                  $('#unit').val(response.unit);
                  $('#unit_price').val(response.unit_price);
                  
                  // Enable quantity input
                  $('input[name="quantity"]').prop('disabled', false);
              },
              error: function(xhr) {
                  console.error('Error fetching item details:', xhr);
                  alert('Error fetching item details. Please try again.');
                  resetFormFields();
              }
          });
      });

      // Helper function to reset form fields
      function resetFormFields() {
          $('#stock').val('');
          $('#inventory_no').val('');
          $('#unit').val('');
          $('#unit_price').val('');
          $('input[name="quantity"]').val('').prop('disabled', true);
      }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


</body>
</html>

