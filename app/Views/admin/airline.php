<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$airlineFields = [
    ['iata', 'IATA', 'text'],
    ['icao', 'ICAO', 'text'],
    ['airline_name', 'Airline Name', 'text'],
    ['callsign', 'Callsign', 'text'],
    ['region', 'Country/Region', 'text'],
    ['comments', 'Comments', 'text']
];
?>


<div class="d-flex flex-grow-1 w-100 overflow-hidden">
    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';

                renderFilterSidebar('/admin/airlines', [
                    ['name' => 'iata', 'label' => 'IATA', 'placeholder' => 'Enter IATA code'],
                    ['name' => 'icao', 'label' => 'ICAO', 'placeholder' => 'Enter ICAO code'],
                    ['name' => 'airline_name', 'label' => 'Airline', 'placeholder' => 'Enter airline name'],
                    ['name' => 'callsign', 'label' => 'Callsign', 'placeholder' => 'Enter callsign'],
                    ['name' => 'region', 'label' => 'Country/Region', 'placeholder' => 'Enter country/region'],
                ]);
                ?>

            </div>
        </div>
    </aside>

    <main class="flex-grow-1 p-4 w-100 d-flex flex-column overflow-hidden" style="min-width:0;">
        <div x-data="{ isOpen: false, row: {}, action: '' }">
        <?php include __DIR__ . '/../partials/flash.php'; ?>
        <div class="content-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="bi bi-airplane me-1"></i>Airline</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAirlineModal">
                <i class="bi bi-plus-circle me-2"></i>Add Airline
            </button>
        </div>

        <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column overflow-hidden">
            <div class="card-body p-0 overflow-hidden d-flex flex-column">
                <?php
                $tableHeaders = ['IATA', 'ICAO', 'Airline', 'Callsign', 'Country/Region', 'Comments'];
                $fields = ['iata', 'icao', 'airline_name', 'callsign', 'region', 'comments'];
                $entity = 'Airline';
                $deleteAction = "/admin/airline/delete";
                $editRoute = "/admin/airline";

                $rows = $airlines;

                include __DIR__ . '/../partials/table.php';
                ?>

                <?php
                $fields = $airlineFields; 
                $entity = 'Airline';
                include __DIR__ . '/../partials/edit_form.php';
                ?>




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

<!-- Add Airline Modal -->
<?php
$modalId = "addAirlineModal";
$title = "Add Airline";
$action = "/admin/airline/store";
$fields = $airlineFields;
$values = [];
include __DIR__ . '/../partials/modal_form.php';
?>

<?= $this->endSection() ?>