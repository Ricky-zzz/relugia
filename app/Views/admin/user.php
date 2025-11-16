<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$userFields = [
    ['user', 'Username', 'text'],
    ['pass', 'Password', 'password'],
    ['role', 'Role', 'select', ['admin' => 'Admin', 'user' => 'User']],
];
?>

<div class="d-flex flex-grow-1 w-100 overflow-hidden">

    <!-- Sidebar -->
    <aside class="bg-light border-end ps-2" style="width: 280px; flex-shrink: 0;">
        <div class="card shadow-sm mx-2 my-3">
            <div class="card-body p-3">
                <?php
                include __DIR__ . '/../partials/filter.php';

                renderFilterSidebar('/admin/user', [
                    ['name' => 'user', 'label' => 'Username', 'placeholder' => 'Search username'],
                    ['name' => 'role', 'label' => 'Role', 'type' => 'select','options' => ['Admin' => 'admin', 'User' => 'user'],]
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
                <h2 class="mb-0"><i class="bi bi-people me-1"></i>Users</h2>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-circle me-2"></i>Add User
                </button>
            </div>

            <!-- Table -->
            <div class="card shadow-sm w-100 flex-grow-1 d-flex flex-column overflow-hidden">
                <div class="card-body p-0 overflow-hidden d-flex flex-column">

                    <?php
                    // Table headers
                    $tableHeaders = [ 'Username', 'Role'];
                    $fields = [ 'user', 'role']; 
                    $entity = 'User';

                    $deleteAction = "/admin/user/delete";
                    $editRoute = "/admin/user";

                    $rows = $users;

                    include __DIR__ . '/../partials/table.php';
                    ?>

                    <!-- Edit User Modal -->
                    <?php
                    $fields = $userFields;
                    $entity = 'User';
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

<!-- Add User Modal -->
<?php
$modalId = "addUserModal";
$title = "Add User";
$action = "/admin/user/store";
$fields = $userFields;
$values = [];
include __DIR__ . '/../partials/modal_form.php';
?>

<?= $this->endSection() ?>
