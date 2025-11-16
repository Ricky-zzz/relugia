<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-grow-1 w-100 overflow-auto">
    <main class="flex-grow-1 p-4 w-100" style="min-width:0;">

        <div x-data="seatViewer()" 
             x-init='initData(
                "<?= $aircraft['col_sizes'] ?>",
                <?= (int)$aircraft['first_class'] ?>,
                <?= (int)$aircraft['business_class'] ?>,
                <?= (int)$aircraft['economy_class'] ?>,
                <?= json_encode($allSeats, JSON_HEX_APOS | JSON_HEX_QUOT) ?>
            )'>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Seats for Flight #<?= htmlspecialchars($schedule['id']) ?></h2>
                <a href="/admin/flightschedule/<?= $schedule['frid'] ?>" class="btn btn-secondary">
                    ← Back to Flight Schedule
                </a>
            </div>

            <p class="fw-bold">
                <?= htmlspecialchars($schedule['origin_airport']) ?> →
                <?= htmlspecialchars($schedule['destination_airport']) ?>
            </p>

            <p>
                Departure: <?= htmlspecialchars($schedule['date_departure']) ?> at <?= htmlspecialchars($schedule['time_departure']) ?>
                ||
                Arrival: <?= htmlspecialchars($schedule['date_arrival']) ?> at <?= htmlspecialchars($schedule['time_arrival']) ?>
            </p>

<!-- View Toggle -->
<div class="mb-3">
    <button class="btn btn-primary"
            @click="view = (view === 'table' ? 'visual' : 'table')">
        <span x-show="view === 'table'">Show Aircraft View</span>
        <span x-show="view === 'visual'">Show Table View</span>
    </button>
</div>


            <!-- TABLE VIEW -->
            <div x-show="view === 'table'">

                <?php if (!empty($seats)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Ticket No.</th>
                                    <th>Seat</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($seats as $seat): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($seat['ticket_no']) ?></td>
                                        <td><?= htmlspecialchars($seat['seat_name']) ?></td>
                                        <td><?= htmlspecialchars($seat['class']) ?></td>
                                        <td><?= htmlspecialchars($seat['status']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($totalPages > 1): ?>
                        <nav class="mt-3">
                            <ul class="pagination">
                                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                    <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>

                <?php else: ?>
                    <p>No seats found.</p>
                <?php endif; ?>

            </div>

            <!-- VISUAL VIEW -->
            <div x-show="view === 'visual'" x-transition>

                <!-- Legend -->
                <div class="d-flex mb-3 gap-3 justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px;height:20px;background-color:#0d6efd"></div>
                        First
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px;height:20px;background-color:#198754"></div>
                        Business
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px;height:20px;background-color:#ffc107"></div>
                        Economy
                    </div>
                </div>

                <!-- Aircraft Layout -->
                <div class="d-flex justify-content-center">
                    <div class="border p-3 bg-light overflow-auto" style="max-height:700px;min-width:300px;">

                        <template x-for="row in layout" :key="row.rowNum">
                            <div class="mb-1">
                                <div class="d-flex justify-content-center align-items-center">

                                    <!-- Row number left -->
                                    <div style="width:30px" class="me-2" x-text="row.rowNum"></div>

                                    <!-- Clusters -->
                                    <template x-for="cluster in row.rowClusters">
                                        <div class="d-flex ms-3">
                                            <template x-for="seat in cluster">
                                                <div class="border rounded text-center"
                                                     :class="'border-' + seat.color"
                                                     style="width:35px;height:35px;margin:3px;display:flex;align-items:center;justify-content:center;">
                                                    <span x-text="seat.name"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    <!-- Row number right -->
                                    <div style="width:30px" class="ms-2" x-text="row.rowNum"></div>

                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<script>
function seatViewer() {
    return {
        view: 'table',

        clusters: [],
        first: 0,
        business: 0,
        economy: 0,
        seatsData: [],
        layout: [],

        initData(colSizes, first, business, economy, seatsData) {
            this.clusters = colSizes.split('-').map(Number);
            this.first = first;
            this.business = business;
            this.economy = economy;
            this.seatsData = seatsData;

            this.layout = this.generate();
        },

        generate() {
            let layout = [];
            let totalCols = this.clusters.reduce((a, b) => a + b, 0);

            let sections = [
                { seats: this.first, color: 'info' },
                { seats: this.business, color: 'success' },
                { seats: this.economy, color: 'warning' },
            ];

            let rowNum = 1;

            sections.forEach(sec => {
                let rows = Math.ceil(sec.seats / totalCols);

                for (let r = 0; r < rows; r++) {
                    let rowClusters = [];
                    let offset = 0;

                    this.clusters.forEach(size => {
                        let letters = [];

                        for (let i = 0; i < size; i++) {
                            letters.push(String.fromCharCode(65 + offset + i));
                        }
                        offset += size;

                        rowClusters.push(
                            letters.map(letter => {
                                let seatName = letter + rowNum;

                                let found = this.seatsData.find(s => s.seat_name === seatName);

                                return {
                                    name: seatName,
                                    status: found ? found.status : 'unknown',
                                    class: found ? found.class : '',
                                    color: sec.color
                                };
                            })
                        );
                    });

                    layout.push({ rowNum, rowClusters });
                    rowNum++;
                }
            });

            return layout;
        }
    };
}
</script>

<?= $this->endSection() ?>
