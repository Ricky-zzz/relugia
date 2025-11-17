<?php

$current = $_SERVER['REQUEST_URI'];

function isActive($current, $path)
{
    return trim($current, '/') === trim($path, '/') ? 'active' : '';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="/admin/dashboard">
            <img src="/assets/imgs/logo.png" alt="Lugia" height="50"> LUGIA
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mx-3">
                    <a class="nav-link <?= isActive($current, '/airline/flightroute') ?>" href="/airline/flightroute">
                        <i class="bi bi-signpost-2 me-1"></i>Flight Routes
                    </a>
                </li>
            </ul>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>Profile
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>My Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="bi bi-upload me-2"></i>Import Data
                        </a></li>
                    <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="/admin/import" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="import_table" class="form-label">Select Table</label>
                            <select class="form-select" id="import_table" name="table" required>
                                <option value="">-- Select Table --</option>
                                <option value="aircraft">Aircraft</option>
                                <option value="airline">Airline</option>
                                <option value="airport">Airport</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="import_csv" class="form-label">CSV File</label>
                            <input type="file" class="form-control" id="import_csv" name="csv_file" accept=".csv"
                                required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>