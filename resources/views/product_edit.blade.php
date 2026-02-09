<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./css/adminlte.css" />
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Products</a></li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary">
        <div class="sidebar-brand">
          <a href="./index3test.blade.php" class="brand-link">
            <img
              src="./assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">AdminLTE 3</span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="./index3test.blade.php" class="nav-link">
                  <i class="nav-icon bi bi-speedometer2"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Products
                    <i class="end bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./products_table.blade.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Product List</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

      <!--begin::App Content-->
      <div class="app-content">
        <div class="container-fluid">
          <!-- Success Message -->
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <!-- Error Message -->
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <div class="row">
            <div class="col-lg-12">
              <!-- Edit Product Form -->
              <div class="card mb-4">
                <div class="card-header border-0">
                  <h3 class="card-title">Edit Product</h3>
                  <div class="card-tools">
                    <a href="{{ route('products.index') }}" class="btn btn-tool btn-sm">
                      <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <form action="{{ route('products.update', (string)$product->_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Row 1 -->
                    <div class="form-row">
                      <div class="col-md-3 mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
                          <option value="">Select Category</option>
                          <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                          <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU</option>
                          <option value="RAM" {{ $product->category == 'RAM' ? 'selected' : '' }}>RAM</option>
                        </select>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="price" class="form-label">Price (USD)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="stock" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ $product->stock ?? 0 }}" required>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="image" class="form-label">Image Path</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{ $product->image ?? '' }}" placeholder="./img/your-image.jpg">
                      </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="mt-4">
                      <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Update Product
                      </button>
                      <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                      </a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/adminlte.min.js"></script>
  </body>
</html>
