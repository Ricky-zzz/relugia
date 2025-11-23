<?= $this->extend('layouts/airline') ?>
<?= $this->section('content') ?>

<div x-data="pageData()" class="d-flex flex-grow-1 w-100 overflow-auto">

    <main class="flex-grow-1 p-4 w-100" style="min-width:0;">

        <div x-data="seatViewer()" x-init='initData(
                "<?= $aircraft['col_sizes'] ?>",
                <?= (int) $aircraft['first_class'] ?>,
                <?= (int) $aircraft['business_class'] ?>,
                <?= (int) $aircraft['economy_class'] ?>,
                <?= json_encode($allSeats, JSON_HEX_APOS | JSON_HEX_QUOT) ?>
        )'>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Seats for Flight #<?= htmlspecialchars($schedule['id']) ?></h2>
                <a href="/airline/flightschedule/<?= $schedule['frid'] ?>" class="btn btn-secondary">
                    ← Back to Flight Schedule
                </a>
            </div>

            <p class="fw-bold">
                <?= htmlspecialchars($schedule['origin_airport']) ?> →
                <?= htmlspecialchars($schedule['destination_airport']) ?>
            </p>

            <p>
                Departure: <?= htmlspecialchars($schedule['date_departure']) ?> at
                <?= htmlspecialchars($schedule['time_departure']) ?>
                ||
                Arrival: <?= htmlspecialchars($schedule['date_arrival']) ?> at
                <?= htmlspecialchars($schedule['time_arrival']) ?>
            </p>

            <!-- Toggle -->
            <div class="mb-3">
                <button class="btn btn-primary" @click="view = (view === 'table' ? 'visual' : 'table')">
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
                                    <th>Seat Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($seats as $seat): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($seat['ticket_no']) ?></td>
                                        <td><?= htmlspecialchars($seat['seat_name']) ?></td>
                                        <td><?= htmlspecialchars($seat['class']) ?></td>
                                        <td><?= htmlspecialchars($seat['status']) ?></td>
                                        <td><?= 'P ' . htmlspecialchars($seat['seat_price']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                @click="openEdit(
                                                    <?= htmlspecialchars(json_encode($seat), ENT_QUOTES) ?>,
                                                    '/airline/seat/update/<?= $seat['id'] ?>'
                                                )">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No seats found.</p>
                <?php endif; ?>
            </div>

            <!-- VISUAL VIEW -->
            <div x-show="view === 'visual'" x-transition>
                <h4 class="text-center mb-3">Aircraft Layout</h4>

                <!-- Layout -->
                <div class="d-flex justify-content-center">
                    <div class="border p-3 bg-light overflow-auto" style="min-width:300px;">

                        <template x-for="(row, index) in layout" :key="row.rowNum">
                            <div class="mb-1">
                                <div class="d-flex justify-content-center align-items-center">

                                    <div style="width:30px" class="me-2" x-text="row.rowNum"></div>

                                    <template x-for="cluster in row.rowClusters">
                                        <div class="d-flex ms-3">
                                            <template x-for="seat in cluster">
                                                <div class="border rounded text-center"
                                                    :class="[
                                                        'border-' + seat.color,
                                                        seat.status === 'booked'
                                                        ? 'bg-danger text-white border-danger'
                                                        : ''
                                                    ]"
                                                    style="width:40px;height:40px;margin:4px;display:flex;
                                                           align-items:center;justify-content:center;cursor:pointer"
                                                    @click="openEdit(seat, '/airline/seat/update/' + seat.id)">
                                                    <span x-text="seat.name"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    <div style="width:30px" class="ms-2" x-text="row.rowNum"></div>
                                </div>

                            </div>
                        </template>

                    </div>
                </div>
            </div>

        </div>

        <!-- Reusable Edit Modal -->
        <?= $this->include('partials/edit_seat') ?>

    </main>
</div>

<script>
function pageData() {
    return {
        isOpen: false,
        row: {},
        action: "",

        openEdit(data, url) {
            this.row = structuredClone(data);
            this.action = url;
            this.isOpen = true;
        }
    };
}

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
                                    id: found?.id,
                                    name: seatName,
                                    status: found?.status ?? 'available',
                                    class: found?.class ?? '',
                                    seat_price: found?.seat_price ?? '',
                                    color: sec.color,
                                    ticket_no: found?.ticket_no ?? null,
                                    passenger_name: found?.passenger_name ?? null
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
