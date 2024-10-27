<div class="modal fade" id="existingRecordsModal" tabindex="-1" aria-labelledby="existingRecordsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existingRecordsModalLabel">Existing Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
                @if ($records && $records->isNotEmpty())
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let existingRecords = @json($records);
                            let message = "The following records already exist:<br><br>";
                            existingRecords.forEach(record => {
                                message +=
                                    `<strong>${record.type.charAt(0).toUpperCase() + record.type.slice(1)} ID:</strong> ${record.id} exists in <strong>${record.table}</strong><br>`;
                            });
                            document.getElementById('modal-body-content').innerHTML = message;
                            new bootstrap.Modal(document.getElementById('existingRecordsModal')).show();
                        });
                    </script>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
