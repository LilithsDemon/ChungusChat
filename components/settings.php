<div class="modal" id="settings" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <?php
                    if($_SESSION['admin'] == 1)
                    {
                        ?>
                        <button class="btn btn-primary">Add User</button>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>