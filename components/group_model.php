<div class="modal fade" id="groupModel" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="NewGroupModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Group</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="visually-hidden" for="groupName">New Group Name</label>
                <div class="input-group">
                    <input type="text" name="group_name" required class="form-control" id="groupName"
                        placeholder="New Group Name">
                </div>
                <hr>
                <div class="d-flex flex-column align-items-center pb-2 pt-2">
                    <ul id="current_group_users" class="list-group pt-2 pb-2">
                        <?php
                        $group_blocks = new NewGroupBlock($_SESSION['group_users']->GetUsers());
                        $group_blocks->outputBlocks();
                        ?>
                    </ul>
                    <h4 class="pt-2">Add User by Select</h4>
                    <form id="group_add_select" class="group_user_adder d-flex w-100 gap-4 justify-content-center"
                        method="post" action="/php/add_user_by_name.php">
                        <label class="visually-hidden" for="specificSizeSelect">User</label>
                        <select class="form-select" name="username" id="specificSizeSelect">
                            <option selected>Choose user..</option>
                            <?php
                            $SQL = "SELECT `Username` FROM `Users` WHERE `Username` NOT IN (?);";
                            $user_arr = [$_SESSION['username']];
                            $user_arr_str = implode(',', $user_arr);
                            $result = executeCommand($SQL, 's', [$user_arr_str]);
                            if (mysqli_num_rows($result) > 0) {
                                while ($DATA = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $DATA['Username'] . "'>" . $DATA['Username'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>
                    <h4 class="pt-2">Add User by Username</h4>
                    <form id="group_add_username"
                        class="group_user_adder d-flex w-100 justify-content-center gap-4 pt-2 pb-4" method="post"
                        action="/php/add_user_by_name.php">
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" name="username" id="autoSizingInputGroup"
                                placeholder="Username">
                        </div>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="close_new_group_model" class="btn btn-primary">Create Group</button>
                </div>
            </div>
        </div>
    </div>
</div>