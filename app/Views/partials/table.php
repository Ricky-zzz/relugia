<?php
/**
 * Variables expected:
 * @var array $tableHeaders  // e.g. ['IATA', 'ICAO', 'Airline', 'Callsign', 'Region']
 * @var array $rows          // dataset, each row is an associative array
 * @var array $fields        // fields to display in order, e.g. ['iata','icao','airline_name','callsign','region']
 * @var string $entity       // e.g. "Airline"
 * @var string $deleteAction // e.g. "/admin/airlines/delete"
 */
?>

<table class="table table-hover table-striped align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <?php foreach ($tableHeaders as $header): ?>
                <th><?= esc($header) ?></th>
            <?php endforeach; ?>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($fields as $field): ?>
                        <td><?= esc($row[$field] ?? '') ?></td>
                    <?php endforeach; ?>
                    <td class="text-nowrap">
                        <!-- Edit button -->
                        <button type="button" class="btn btn-sm btn-outline-primary" @click="
                            row = <?= htmlspecialchars(json_encode($row)) ?>;
                            action = `<?= $editRoute ?>/update/${row.id}`;
                            isOpen = true
                        ">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <!-- Custom button -->
                        <?php if (isset($entity) && strtolower($entity) === 'flight route'): ?>
                            <a href="/<?= $role ?>/flightschedule/<?= $row['id'] ?>" class="btn btn-sm btn-outline-success"
                                title="Manage Schedules">
                                <i class="bi bi-airplane"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (isset($entity) && strtolower($entity) === 'flight schedule'): ?>
                            <a href="/<?= $role ?>/seat/<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning" title="Manage Schedules">
                                <i class="bi bi-ticket"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (isset($entity) && strtolower($entity) === 'aircraft'): ?>
                            <button class="btn btn-sm btn-outline-warning" 
                                       @click="openSeatView(<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>)">
                                <i class="bi bi-airplane"></i>
                            </button>

                        <?php endif; ?>

                        <!-- Delete form -->
                        <form action="<?= $deleteAction . '/' . $row['id'] ?>" method="post" class="d-inline">
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Delete this <?= strtolower($entity) ?>?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= count($tableHeaders) + 1 ?>" class="text-center text-muted">
                    No <?= strtolower($entity) ?>s found.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>