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

              <!-- Two-Column Layout for form fields -->
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="po_number">Purchase Order No.</label>
                    <input type="text" name="po_number" class="form-control" placeholder="Enter Purchase Order Number" required>
                  </div>

                  <div class="form-group">
                    <label for="supplier">Supplier Name</label>
                    <input type="text" name="supplier" class="form-control" placeholder="Enter Supplier Name" required>
                  </div>

                  <div class="form-group">
                    <label for="date">Order Date</label>
                    <input type="date" name="date" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="category">Order Category</label>
                    <select name="category" class="form-control" required>
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
                    <label for="delivery_date">Expected Delivery Date</label>
                    <input type="date" name="delivery_date" class="form-control" required>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Item Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter item description" rows="3" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required min="1">
                  </div>

                  <div class="form-group">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" name="unit_price" class="form-control" placeholder="Enter Unit Price" required min="0.01" step="0.01">
                  </div>

                  <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" name="total_price" class="form-control" placeholder="Enter Total Price" required min="0.01" step="0.01">
                  </div>

                  <div class="form-group">
                    <label for="notes">Additional Notes</label>
                    <textarea name="notes" class="form-control" placeholder="Enter any additional notes" rows="3"></textarea>
                  </div>
                </div>
              </div>

              <!-- Submit Button with Icon -->
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

<!-- Confetti and SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Handle Success with Confetti Effect
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
      }).then(() => {
        confetti({
          particleCount: 150,
          spread: 70,
          origin: { y: 0.6 }
        });
      });
    @endif

    // Handle Error
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
