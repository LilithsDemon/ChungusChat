<div class="modal" id="new_user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <form class="d-flex flex-column gap-2" id="new_user_form">
                    <h4 class="pt-2 pb-2">User Details</h4>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="text" class="form-control" required id="username" 
                            placeholder="Username">
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" required id="first_name" class="form-control" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" required id="last_name" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                    </div>
                    <input type="text" class="form-control" id="role" 
                            placeholder="Role">
                    <input type="text" class="form-control" required id="password" 
                            placeholder="Password">
                    <h4 class="pt-2">User Permissions</h4>
                    <p class="pt-2"><a href="#" data-bs-toggle="tooltip" data-bs-title="1 allows them to be an admin">Admin Privledges</a></p>
                    <label class="visually-hidden" for="admin"></label>
                    <select class="form-select" id="admin" name="admin" aria-label="Default select example">
                        <option selected>0</option>
                        <option>1</option>
                    </select>
                    <p class="pt-2"><a href="#" data-bs-toggle="tooltip" data-bs-title="1 allows user to create up to 10 groups, if they are an admin they get this anyway, with unlimited groups">Creator Privledges</a></p>
                    <label class="visually-hidden" for="creator"></label>
                    <select class="form-select" id="creator" name="creator" aria-label="Default select example">
                        <option selected>0</option>
                        <option>1</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="close_new_user_model" class="btn btn-primary">Create User</button>
            </div>
        </div>
    </div>
</div>