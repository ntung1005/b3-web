<?php require APP_ROOT . '/views/inc/header.php'; ?>
<?php require APP_ROOT . '/views/inc/aside.php'; ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <?php flash('user_message'); ?>

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="card-title">Thêm user mới</h3>
                    </div>
                    <form action="<?php echo URL_ROOT; ?>/admin/update_user/<?php echo $data['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name: <sup>*</sup></label>
                            <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Email: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Role: <sup>*</sup></label>
                            <select name="role" class="form-control form-control" value="<?php echo $data['role']; ?>">
                                <option value="admin" >Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <input type="submit" value="Save" class="btn btn-danger" />
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php require APP_ROOT . '/views/inc/footer.php'; ?>