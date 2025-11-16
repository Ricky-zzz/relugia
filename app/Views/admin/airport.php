<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$airportFields = [
    ['iata', 'IATA', 'text'],
    ['icao', 'ICAO', 'text'],
    ['airport_name', 'Airport Name', 'text'],
    ['location_serve', 'Location Serve', 'text'],
    ['time', 'Time', 'text'],
    ['dst', 'DST', 'select', ['Y' => 'Yes', 'N' => 'No']],
];
?>

<div class="d-flex flex-grow-1 w-100 overflow-hidden">
    <!-- Sidebar -->
    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';
                renderFilterSidebar('/admin/airport', [
                    ['name' => 'iata', 'label' => 'IATA', 'placeholder' => 'Enter IATA code'],
                    ['name' => 'icao', 'label' => 'ICAO', 'placeholder' => 'Enter ICAO code'],
                    ['name' => 'airport_name', 'label' => 'Airport Name', 'placeholder' => 'Enter airport name'],
                    ['name' => 'location_serve', 'label' => 'Location Serve', 'placeholder' => 'Enter location served'],
                    ['name' => 'time', 'label' => 'Time', 'placeholder' => 'Enter time'],
                    ['name' => 'dst', 'label' => 'DST', 'placeholder' => 'Enter DST'],
                ]);
                ?>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4 w-100 d-flex flex-column overflow-hidden" style="min-width:0;">
        <div x-data="{ isOpen: false, row: {}, action: '' }">
            <?php include __DIR__ . '/../partials/flash.php'; ?>

            <!-- Header -->
            <div class="content-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="bi bi-building me-1"></i>Airports</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAirportModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Airport
                </button>
            </div>

            <!-- Table Card -->
            <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column overflow-hidden">
                <div class="card-body p-0 overflow-hidden d-flex flex-column">
                    <?php
                    $tableHeaders = ['IATA', 'ICAO', 'Airport Name', 'Location Serve', 'Time', 'DST'];
                    $fields = ['iata', 'icao', 'airport_name', 'location_serve', 'time', 'dst'];
                    $entity = 'Airport';
                    $deleteAction = "/admin/airport/delete";
                    $editRoute = "/admin/airport";

                    $rows = $airports; 
                    
                    include __DIR__ . '/../partials/table.php';
                    ?>

                    <!--Edit Modal  -->
                    <?php
                    $fields = $airportFields; 
                    $entity = 'Airport';
                    include __DIR__ . '/../partials/edit_form.php';
                    ?>

                    <!-- Pagination -->
                    <?php if (isset($pages) && $pages > 1): ?>
                        <nav aria-label="Pagination">
                            <ul class="pagination mb-0">
                                <?php for ($p = 1; $p <= $pages; $p++): ?>
                                    <li class="page-item <?= $p === ($page ?? 1) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Add Airport Modal -->
<?php
$modalId = "addAirportModal";
$title = "Add Airport";
$action = "/admin/airport/store";
$fields = $airportFields;
$values = [];
include __DIR__ . '/../partials/modal_form.php';
?>
<?= $this->endSection() ?>