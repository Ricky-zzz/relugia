<!-- Seat Layout Modal -->
<div class="modal-backdrop fade" x-show="showSeats" :class="{ 'show': showSeats }"></div>
<div class="modal fade" tabindex="-1" x-show="showSeats" :class="{ 'show d-block': showSeats }">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="seatRow.model || 'Aircraft Seats'"></h5>
                <button type="button" class="btn-close" @click="showSeats=false"></button>
            </div>

            <div class="modal-body">

                <!-- Legend -->
                <div class="d-flex mb-3 gap-3 align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px; height:20px; background-color:#0d6efd;"></div>
                        <span>First Class</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px; height:20px; background-color:#198754;"></div>
                        <span>Business Class</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-2" style="width:20px; height:20px; background-color:#ffc107;"></div>
                        <span>Economy Class</span>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="border p-3 bg-light overflow-auto" style="max-height:700px;">

                        <!-- Column Header -->
                        <div class="d-flex mb-3 justify-content-center align-items-center">
                            <div style="width:30px;" class="me-2"></div>

                            <template x-for="(size, cIndex) in clusters" :key="cIndex">
                                <div class="d-flex" :class="cIndex!==0?'ms-5':''">
                                    <template x-for="(_, i) in Array(size)" :key="i">
                                        <div class="text-center border-bottom border-dark fw-bold"
                                             style="width:35px; height:35px; margin:3px; font-size:0.8rem;
                                                    display:flex; align-items:center; justify-content:center;"
                                             x-text="String.fromCharCode(65 + clusterLetterOffset(cIndex) + i)">
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <div style="width:30px;" class="ms-2"></div>
                        </div>

                        <!-- Seat Rows -->
                        <template x-for="(row, index) in seats" :key="index">
                            <div>
                                <div class="d-flex mb-1 justify-content-center align-items-center">

                                    <!-- Row number left -->
                                    <div style="width:30px;" class="me-2" x-text="index + 1"></div>

                                    <!-- Seat clusters -->
                                    <template x-for="(cluster, cIndex) in row.rowClusters" :key="cIndex">
                                        <div class="d-flex" :class="cIndex!==0?'ms-5':''">

                                            <template x-for="seat in cluster" :key="seat">
                                                <div class="d-flex align-items-center justify-content-center border rounded"
                                                     :class="'border-' + row.color"
                                                     style="width:35px; height:35px; margin:3px; font-size:0.8rem; cursor:default;"
                                                     x-text="seat"
                                                     @mouseenter="$el.classList.add('bg-dark','text-white'); $el.style.fontWeight='bold';"
                                                     @mouseleave="$el.classList.remove('bg-dark','text-white'); $el.style.fontWeight='';">
                                                </div>
                                            </template>

                                        </div>
                                    </template>

                                    <!-- Row number right -->
                                    <div style="width:30px;" class="ms-2" x-text="index + 1"></div>

                                </div>

                                <!-- Ghost row if class changes -->
                                <template x-if="index < seats.length - 1 && seats[index].color !== seats[index + 1].color">
                                    <div class="d-flex mb-3 justify-content-center align-items-center" style="height:20px;">
                                        <div style="flex:1; border-top:2px dashed #999;"></div>
                                    </div>
                                </template>
                            </div>
                        </template>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" @click="showSeats=false">Close</button>
            </div>
        </div>
    </div>
</div>
