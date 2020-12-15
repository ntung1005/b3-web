<?php require APP_ROOT . '/views/inc/header.php'; ?>
<?php require APP_ROOT . '/views/inc/aside.php'; ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <?php flash('user_message'); ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                        <a class="btn btn-success" href="<?php echo URL_ROOT . '/admin/add_product'; ?>">Thêm sản phẩm mới</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá gốc</th>
                                    <th scope="col">Giá khuyến mại</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Người tạo tạo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['products'] as $product) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $product->product_id; ?></th>
                                        <td><img style="width: 50px; height: 50px" src="<?php echo $product->image ? URL_ROOT . '../public/uploads/' . $product->image : "https://screenshotlayer.com/images/assets/placeholder.png" ?>" /></td>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $product->body; ?></td>
                                        <td><?php echo $product->soluong ? $product->soluong : 0; ?></td>
                                        <td><?php echo $product->price ? $product->price : "Chưa cập nhật..."; ?></td>
                                        <td><?php echo $product->price_sale ? $product->price_sale : "Chưa cập nhật..."; ?></td>
                                        <td><?php echo $product->created_at; ?></td>
                                        <td><?php echo $product->user_name; ?></td>
                                        <td class="center">
                                            <div class="d-flex">
                                                <form class="mr-2" action="<?php echo URL_ROOT; ?>/admin/update_product/<?php echo $product->product_id; ?>" method="get">
                                                    <input type="submit" value="Update" class="btn btn-warning btn-sm">
                                                </form>
                                                <form action="<?php echo URL_ROOT; ?>/admin/delete_product/<?php echo $product->product_id; ?>" method="post">
                                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                                </form>
                                            </div>
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