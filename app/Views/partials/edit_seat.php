<!-- Backdrop -->
<div class="modal-backdrop fade"
     x-show="isOpen"
     x-cloak
     :class="{ 'show': isOpen }"></div>

<!-- Modal -->
<div class="modal fade" tabindex="-1" x-show="isOpen" x-cloak
     :class="{ 'show d-block': isOpen }">

    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <form :action="action" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Seat</h5>
                    <button type="button" class="btn-close" @click="isOpen = false"></button>
                </div>

                <div class="modal-body">

                    <!-- STATUS -->
                    <label class="form-label fw-bold">Status</label>
                    <select class="form-select mb-3" name="status" x-model="row.status">
                        <option value="available">Available</option>
                        <option value="booked">Booked</option>
                        <option value="blocked">Blocked</option>
                    </select>

                    <!-- PRICE -->
                    <label class="form-label fw-bold">Seat Price</label>
                    <input type="number" class="form-control" name="seat_price"
                        x-model="row.seat_price" min="0" step="1">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="isOpen = false">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>

</div>
