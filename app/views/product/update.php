<?php require APP_ROOT . '/views/inc/header.php'; ?>
<?php require APP_ROOT . '/views/inc/aside.php'; ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <?php flash('user_message'); ?>

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="card-title">Thêm sản phẩm mới</h3>
                    </div>
                    <form action="<?php echo URL_ROOT; ?>/admin/update_product/<?php echo $data['id'];?>" method="post">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm: <sup>*</sup></label>
                                    <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="price">Giá gốc: <sup>*</sup></label>
                                    <input type="text" name="price" class="form-control form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="price_sale">Giá khuyến mại: <sup>*</sup></label>
                                    <input type="text" name="price_sale" class="form-control form-control <?php echo (!empty($data['price_sale_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price_sale']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['price_sale_err']; ?></span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="soluong">Số lượng:</label>
                                    <input type="text" name="soluong" class="form-control form-control"  value="<?php echo $data['soluong']; ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="body">Mô tả sản phẩm:</label>
                                    <input type="text" name="body" class="form-control form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"  value="<?php echo $data['body']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Save" class="btn btn-danger" />
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php require APP_ROOT . '/views/inc/footer.php'; ?>