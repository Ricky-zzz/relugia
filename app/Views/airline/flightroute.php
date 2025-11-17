<?= $this->extend('layouts/airline') ?>
<?= $this->section('content') ?>

<?php
$routeFields = [
    ['oapid', 'Origin Airport', 'select', array_column($airports, 'airport_name', 'id')],
    ['dapid', 'Destination Airport', 'select', array_column($airports, 'airport_name', 'id')],
    ['acid', 'Aircraft', 'select', array_column($aircrafts, 'model', 'id')],
    ['round_trip', 'Round Trip?', 'select', ['0' => 'No', '1' => 'Yes']]
];
?>

<div class="d-flex flex-grow-1 w-100 overflow-hidden">
    <!-- Sidebar Filter -->

    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';

                renderFilterSidebar('/admin/flightroute', [
                    [
                        'name' => 'oapid',
                        'label' => 'Origin Airport',
                        'type' => 'select',
                        'options' => array_column($airports, 'airport_name', 'id'),
                    ],
                    [
                        'name' => 'dapid',
                        'label' => 'Destination Airport',
                        'type' => 'select',
                        'options' => array_column($airports, 'airport_name', 'id'),
                    ],
                    [
                        'name' => 'acid',
                        'label' => 'Aircraft',
                        'type' => 'select',
                        'options' => array_column($aircrafts, 'model', 'id'),
                    ],
                    [
                        'name' => 'round_trip',
                        'label' => 'Round Trip?',
                        'type' => 'select',
                        'options' => ['0' => 'No', '1' => 'Yes'],
                    ],
                ]);
                ?>

            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-3 w-100 d-flex flex-column " style="min-width:0;">
        <div x-data="{ isOpen: false, row: {}, action: '' }">
            <?php include __DIR__ . '/../partials/flash.php'; ?>

            <div class="content-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="bi bi-map me-1"></i>Flight Routes</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRouteModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Route
                </button>
            </div>

            <!-- Table -->
            <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column ">
                <div class="card-body p-0  d-flex flex-column">

                    <?php
                    $tableHeaders = ['Origin', 'Destination', 'Airline', 'Aircraft', 'Round Trip'];
                    $fields = ['origin_airport', 'destination_airport', 'airline_name', 'aircraft_model', 'round_trip'];
                    $entity = 'Flight Route';
                    $deleteAction = "/admin/flightroute/delete";
                    $editRoute = "/admin/flightroute";
                    $rows = $routes;
                    $role = 'airline';

                    include __DIR__ . '/../partials/table.php';
                    ?>

                    <?php
                    $fields = $routeFields;
                    $entity = 'Flight route';
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

<!-- Add Route Modal -->
<?php
$modalId = "addRouteModal";
$title = "Add Flight Route";
$action = "/admin/flightroute/store";
$fields = $routeFields;
$values = [];
include __DIR__ . '/../partials/modal_form.php';
?>

<?= $this->endSection() ?>