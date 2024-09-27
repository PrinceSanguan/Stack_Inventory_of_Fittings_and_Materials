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
          <form action="{{route('admin.add-category')}}" method="post" class="mt-4">
            @csrf

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
              <label>Reorder Point</label>
              <input type="text" name="reorder" class="form-control" placeholder="Enter Reorder Point" required>
            </div>

            <div class="form-group">
              <label>Inventory No.</label>
              <input type="number" name="inventory" class="form-control" placeholder="Enter Inventory Number" required min="1">
            </div>

            <div class="form-group">
              <label>Item Description</label>
              <textarea name="description" class="form-control" placeholder="Enter description" rows="3"></textarea>
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
              <label>Beginning Balance</label>
              <input type="number" name="balance" class="form-control" placeholder="Enter Beginning Balance" required min="0">
            </div>

            <div class="form-group">
              <label>Issuances</label>
              <input type="number" name="issuance" class="form-control" placeholder="Enter Issuances" required min="0">
            </div>

            
            <div class="form-group">
              <label>Unit Price</label>
              <input type="number" name="price" class="form-control" placeholder="Enter Unit Price" required min="1">
            </div>

            <div class="form-group">
              <label>Quantity Stock</label>
              <input type="number" name="stock" class="form-control" placeholder="Enter Quantity Stock" required min="0">
            </div>

            <div class="form-group">
              <label>Inventory Value</label>
              <input type="number" name="value" class="form-control" placeholder="Enter Inventory Value" required min="0">
            </div>

            <div class="form-group">
              <input type="submit" value="Add Category" class="btn btn-primary">
            </div>
          </form>
          <!-- Content Here -->
          
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.layout.footer')