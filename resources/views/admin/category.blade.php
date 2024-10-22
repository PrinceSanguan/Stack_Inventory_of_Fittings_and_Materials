@include('admin.layout.header')
@include('admin.layout.aside')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 col-lg-12">
          <!-- Content Here -->

          <h1 class="m-0">Add Item</h1>

          <!-- Category Form -->
          <form action="{{route('admin.add-item')}}" method="post" class="mt-4">
            @csrf
        
            <div class="row">
                <!-- Left Column (6) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category" class="form-control" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="connection">For Service Connection</option>
                            <option value="repair">For Repair and Maintenance</option>
                            <option value="subsidy">30M NG Subsidy Project</option>
                            <option value="donation">Donation</option>
                            <option value="maintenance">Gen. Set</option>
                            <option value="mswd">MSWD Inventory</option>
                            <option value="accountable">Accountable Forms</option>
                        </select>
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
        
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="number" name="unit_price" class="form-control" placeholder="Enter Unit Price" required min="1">
                    </div>
                </div>
        
                <!-- Right Column (6) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Item Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter description" rows="3"></textarea>
                    </div>
        
                    <div class="form-group">
                        <label>Quantity Stock</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity Stock" required min="1">
                    </div>
                </div>
            </div>
        
            <div class="form-group mt-3">
                <input type="submit" value="Add Item" class="btn btn-primary">
            </div>
        </form>
          <!-- Content Here -->
          
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.layout.footer')

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