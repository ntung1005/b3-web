<?php require APP_ROOT . '/views/inc/header.php'; ?>


<?php require APP_ROOT . '/views/inc/aside.php'; ?>


<div class="page-wrapper">


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Thống kê</h4>
                                <h5 class="card-subtitle"></h5>
                            </div>
                            <div class="ml-auto d-flex no-block align-items-center">
                                <ul class="list-inline font-12 dl m-r-15 m-b-0">
                                    <li class="list-inline-item text-info"><i class="fa fa-circle"></i> Users
                                    </li>
                                    <li class="list-inline-item text-primary"><i class="fa fa-circle"></i> Products
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="campaign ct-charts"></div>
                            </div>
                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Feeds</h4>
                        <div class="feed-widget">
                            <ul class="list-style-none feed-body m-0 p-b-20">
                                <li class="feed-item">
                                    <div class="feed-icon bg-info"><i class="far fa-bell"></i></div> You have 4
                                    pending tasks. <span class="ml-auto font-12 text-muted">Just Now</span>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-success"><i class="ti-server"></i></div> Server #1
                                    overloaded.<span class="ml-auto font-12 text-muted">2 Hours ago</span>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-warning"><i class="ti-shopping-cart"></i></div> New
                                    order received.<span class="ml-auto font-12 text-muted">31 May</span>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-danger"><i class="ti-user"></i></div> New user
                                    registered.<span class="ml-auto font-12 text-muted">30 May</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Sản phẩm đang có</h4>
                            </div>
                            <div class="ml-auto">
                                <div class="dl">
                                    <select class="custom-select">
                                        <option value="0" selected>Monthly</option>
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">Tên sản phẩm</th>
                                    <th class="border-top-0">Số lần sử dụng</th>
                                    <th class="border-top-0">Số lượng</th>
                                    <th class="border-top-0">Mô tả</th>
                                    <th class="border-top-0">Gía gốc</th>
                                    <th class="border-top-0">Giá khuyến mại</th>
                                    <th class="border-top-0">Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['products'] as $value) { ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16"><?php echo $value->name; ?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $value->count; ?></td>
                                    <td><?php echo $value->soluong; ?></td>
                                    <td>
                                        <?php echo $value->body; ?>
                                    </td>
                                    <td><?php echo $value->price; ?></td>
                                    <td><?php echo $value->price_sale; ?></td>
                                    <td>
                                        <?php echo $value->created_at; ?>
                                    </td>
                                </tr>
                            <?php }?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
        
    </div>


    <?php require APP_ROOT . '/views/inc/footer.php'; ?>