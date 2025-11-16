<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$aircraftFields = [
    ['iata', 'IATA', 'text'],
    ['icao', 'ICAO', 'text'],
    ['model', 'Model', 'text'],
    ['first_class', 'First Class Seats', 'number'],
    ['business_class', 'Business Class Seats', 'number'],
    ['economy_class', 'Economy Class Seats', 'number'],
    ['row_nums', 'Rows', 'number'],
    ['col_nums', 'Column Clusters', 'number'],
    ['col_sizes', 'Column Sizes', 'text'],
];
?>
<div class="d-flex flex-grow-1 w-100 overflow-hidden">
    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';

                renderFilterSidebar('/admin/aircraft', [
                    ['name' => 'iata', 'label' => 'IATA', 'placeholder' => 'Enter IATA code'],
                    ['name' => 'icao', 'label' => 'ICAO', 'placeholder' => 'Enter ICAO code'],
                    ['name' => 'model', 'label' => 'Model', 'placeholder' => 'Enter model'],
                ]);
                ?>
            </div>
        </div>
    </aside>

    <main class="flex-grow-1 p-4 w-100 d-flex flex-column overflow-hidden" style="min-width:0;">
        <div x-data="{
                    isOpen: false,
                    row: {},
                    action: '',

                showSeats: false,
                    seatRow: {},
                    seats: [],
                    clusters: [],

                    openSeatView(row) {
                        this.seatRow = row;
                        this.clusters = (row.col_sizes || '').split('-').map(Number);
                        this.seats = this.generateSeats();
                        this.showSeats = true;
                    },

                    clusterLetterOffset(cIndex) {
                        return this.clusters.slice(0, cIndex).reduce((a, b) => a + b, 0);
                    },

                    generateSeats() {
                        if (!this.seatRow.col_sizes) return [];

                        const clusters = this.seatRow.col_sizes.split('-').map(Number);

                        let startChar = 'A'.charCodeAt(0);

                        const seatLetters = clusters.map(size => {
                            let arr = [];
                            for (let i = 0; i < size; i++) arr.push(String.fromCharCode(startChar++));
                            return arr;
                        });

                        const totalCols = clusters.reduce((a, b) => a + b, 0);

                        const sections = [
                            { seats: +this.seatRow.first_class || 0, color: 'info' },
                            { seats: +this.seatRow.business_class || 0, color: 'success' },
                            { seats: +this.seatRow.economy_class || 0, color: 'warning' }
                        ];

                        let allRows = [];
                        let rowNum = 1;

                        sections.forEach(section => {
                            const rows = Math.ceil(section.seats / totalCols);

                            for (let r = 0; r < rows; r++) {
                                let rowClusters = [];

                                seatLetters.forEach(cluster => {
                                    rowClusters.push(cluster.map(letter => letter + rowNum));
                                });

                                allRows.push({
                                    rowClusters,
                                    color: section.color
                                });

                                rowNum++;
                            }
                        });

                        return allRows;
                    }

                }">

            <?php include __DIR__ . '/../partials/flash.php'; ?>
            <div class="content-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="bi bi-airplane me-1"></i>Aircraft</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAircraftModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Aircraft
                </button>
            </div>

            <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column overflow-hidden">
                <div class="card-body p-0 overflow-hidden d-flex flex-column">
                    <?php
                    $tableHeaders = [
                        'IATA',
                        'ICAO',
                        'Model',
                        'First Class',
                        'Business Class',
                        'Economy Class',
                        'Rows',
                        'Columns',
                        'Layout'
                    ];
                    $fields = [
                        'iata',
                        'icao',
                        'model',
                        'first_class',
                        'business_class',
                        'economy_class',
                        'row_nums',
                        'col_nums',
                        'col_sizes'
                    ];
                    $entity = 'Aircraft';
                    $deleteAction = "/admin/aircraft/delete";
                    $editRoute = "/admin/aircraft";
                    $rows = $aircrafts;

                    include __DIR__ . '/../partials/table.php';
                    include __DIR__ . '/../partials/aircraft_partial.php';
                    ?>

                    <?php
                    $fields = $aircraftFields;
                    $entity = 'Aircraft';
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

<!-- Add Aircraft Modal -->
<?php
$modalId = "addAircraftModal";
$title = "Add Aircraft";
$action = "/admin/aircraft/store";
$fields = $aircraftFields;
$values = [];
include __DIR__ . '/../partials/modal_form.php';
?>
<?= $this->endSection() ?>