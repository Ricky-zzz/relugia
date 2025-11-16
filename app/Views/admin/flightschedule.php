<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
// Schedule fields for Add/Edit forms
$scheduleFields = [
    ['frid', '', 'hidden'],
    ['auid', 'Schedule Created By', 'select', array_column($airlineUsers ?? [], 'user', 'id')],
    ['date_departure', 'Departure Date', 'date'],
    ['time_departure', 'Departure Time', 'time'],
    ['date_arrival', 'Arrival Date', 'date'],
    ['time_arrival', 'Arrival Time', 'time'],
    [
        'status',
        'Status',
        'select',
        [
            'scheduled' => 'Scheduled',
            'delayed' => 'Delayed',
            'cancelled' => 'Cancelled',
            'arrived' => 'Arrived'
        ]
    ],
    ['first_price', 'First Class Price', 'number'],
    ['business_price', 'Business Price', 'number'],
    ['economy_price', 'Economy Price', 'number'],
];
?>

<div class="d-flex flex-grow-1 w-100 overflow-hidden">
    <!-- Sidebar Filter -->
    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';
                renderFilterSidebar('/admin/flightschedule', [
                    [
                        'name' => 'status',
                        'label' => 'Status',
                        'type' => 'select',
                        'options' => [
                            'scheduled' => 'Scheduled',
                            'delayed' => 'Delayed',
                            'cancelled' => 'Cancelled',
                            'arrived' => 'Arrived'
                        ],
                    ],
                    ['name' => 'date_departure_from', 'label' => 'Departure From', 'type' => 'date'],
                    ['name' => 'date_departure_to', 'label' => 'Departure To', 'type' => 'date'],
                    ['name' => 'date_arrival_from', 'label' => 'Arrival From', 'type' => 'date'],
                    ['name' => 'date_arrival_to', 'label' => 'Arrival To', 'type' => 'date'],
                ]);
                ?>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4 w-100 d-flex flex-column overflow-hidden" style="min-width:0;">
        <div x-data="{ isOpen: false, row: {}, action: '' }">
            <?php include __DIR__ . '/../partials/flash.php'; ?>

            <div class="content-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="bi bi-clock-history me-1"></i>Flight Schedules</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Schedule
                </button>
            </div>

            <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column overflow-hidden">
                <div class="card-body p-0 overflow-hidden d-flex flex-column">

                    <?php if (!empty($selectedRoute)): ?>
                        <div class="shadow-sm">
                            <div class="p-3 bg-light border-bottom">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-0"><strong>Airline:</strong> <?= esc($selectedRoute['airline_name']) ?>
                                        </p>
                                        <p class="mb-0"><strong>Aircraft:</strong>
                                            <?= esc($selectedRoute['aircraft_model']) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-0"><strong>Origin:</strong>
                                            <?= esc($selectedRoute['origin_airport']) ?></p>
                                        <p class="mb-0"><strong>Destination:</strong>
                                            <?= esc($selectedRoute['destination_airport']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    $tableHeaders = [
                        'Departure Date',
                        'Departure Time',
                        'Arrival Date',
                        'Arrival Time',
                        'Status',
                        'First Class',
                        'Business',
                        'Economy'
                    ];

                    $rows = array_map(function ($r) {
                        return [
                            'id' => $r['id'],
                            'date_departure' => $r['date_departure'],
                            'time_departure' => $r['time_departure'],
                            'date_arrival' => $r['date_arrival'],
                            'time_arrival' => $r['time_arrival'],
                            'status' => ucfirst($r['status']),
                            'first_price' => $r['first_price'],
                            'business_price' => $r['business_price'],
                            'economy_price' => $r['economy_price'],
                            'first_price_display' => '₱' . number_format($r['first_price'], 2),
                            'business_price_display' => '₱' . number_format($r['business_price'], 2),
                            'economy_price_display' => '₱' . number_format($r['economy_price'], 2),

                            'frid' => $r['frid'],
                            'auid' => $r['auid']
                        ];
                    }, $schedules ?? []);

                    $fields = [
                        'date_departure',
                        'time_departure',
                        'date_arrival',
                        'time_arrival',
                        'status',
                        'first_price_display',
                        'business_price_display',
                        'economy_price_display'
                    ];

                    $entity = 'Flight Schedule';
                    $deleteAction = "/admin/flightschedule/delete";
                    $editRoute = "/admin/flightschedule";

                    include __DIR__ . '/../partials/table.php';

                    $fields = array_filter($scheduleFields, fn($f) => $f[0] !== 'frid');
                    $entity = 'Flight Schedule';
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

<!-- Add Schedule Modal -->
<?php
$modalId = "addScheduleModal";
$title = "Add Flight Schedule";
$action = "/admin/flightschedule/store";
$fields = $scheduleFields;
$values = ['frid' => $selectedRoute['id'] ?? null];
include __DIR__ . '/../partials/modal_form.php';
?>

<?= $this->endSection() ?>