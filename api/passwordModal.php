<div class="modal fade" id="setPasswordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center" id="passwordModalLabel">Set Your Password</h3>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="setPassword.php" method="POST">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password goes here" required>
                            <label for="password" class="form-label">New Password</label>
                            <input type="text" class="form-control" id="email" name="email" readonly value="<?php if (isset($user['email'])) echo $user['email'] ?>" hidden>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="confirm_password" id="confirmpassword" autocomplete="off" placeholder="Confirmed password goes here" required>
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                        </div>
                    </div>
                    <hr style="color: red; border: thick double red;">
                    <div class="col-12">
                        <div class="d-grid my-3">
                            <button type="submit" class="btn btn-danger" name="savePassword">Save Password</button>
                        </div>
                        <div class="d-grid my-3">
                            <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>