<!-- Backdrop -->
<div class="modal-backdrop fade" 
     x-show="isOpen" 
     x-cloak
     :class="{ 'show': isOpen }"
     x-transition:enter="transition duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-50"
     x-transition:leave="transition duration-200"
     x-transition:leave-start="opacity-50"
     x-transition:leave-end="opacity-0"></div>

<!-- Edit Modal -->
<div class="modal fade" tabindex="-1" x-show="isOpen" x-cloak
     :class="{ 'show d-block': isOpen }"
     x-transition:enter="transition duration-300"
     x-transition:enter-start="opacity-0 translateY(10px)"
     x-transition:enter-end="opacity-100 translateY(0)"
     x-transition:leave="transition duration-200"
     x-transition:leave-start="opacity-100 translateY(0)"
     x-transition:leave-end="opacity-0 translateY(10px)">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form :action="action" method="POST">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Edit <?= htmlspecialchars($entity) ?></h5>
          <button type="button" class="btn-close" @click="isOpen = false"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <template x-for="field in <?= json_encode(array_filter($fields, fn($f) => $f[2] === 'hidden')) ?>">
            <input type="hidden" :name="field[0]" :value="row[field[0]]">
          </template>

          <!-- Visible fields -->
          <div class="row g-3">
            <?php foreach ($fields as $field): 
              $name = $field[0];
              $label = $field[1];
              $type = $field[2];
              $options = $field[3] ?? [];
              if ($type === 'hidden') continue; 
            ?>
              <div class="col-md-6">
                <label class="form-label"><?= esc($label) ?></label>
                <?php if ($type === 'select'): ?>
                  <select class="form-select" name="<?= $name ?>" x-model="row.<?= $name ?>">
                    <?php foreach ($options as $value => $text): ?>
                      <option value="<?= $value ?>"><?= esc($text) ?></option>
                    <?php endforeach; ?>
                  </select>
                <?php else: ?>
                  <input type="<?= $type ?>" class="form-control" 
                         name="<?= $name ?>" x-model="row.<?= $name ?>">
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="isOpen = false">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
