<?php require APP_ROOT . '/views/inc/header.php'; ?>
<?php require APP_ROOT . '/views/inc/aside.php'; ?>
<div class="page-wrapper">
  <div class="container-fluid">
  <?php flash('user_message'); ?>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body d-flex justify-content-between">
            <h3 class="card-title">Danh sách user</h3>
            <a class="btn btn-success" href="<?php echo URL_ROOT.'/admin/add_user'; ?>">Thêm user mới</a>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['users'] as $user) { ?>
                  <tr>
                    <th scope="row"><?php echo $user->id; ?></th>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td>
                      <form action="<?php echo URL_ROOT; ?>/admin/delete_user/<?php echo $user->id; ?>" method="post">
                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                      </form>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php require APP_ROOT . '/views/inc/footer.php'; ?>