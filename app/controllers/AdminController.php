<?php


class AdminController extends Controller
{

  public function __construct()
  {

    if (!isLoggedIn()) {
      redirect('auth/login');
    }
    if (isLoggedIn() && $_SESSION['role'] !== 'admin') {
      redirect('');
    }

    $this->userModel = $this->model('User');
    $this->productModel = $this->model('Product');
  }
  public function index()
  {


    $this->view('admin/index');
  }

  public function users()
  {
    $data['users'] = $this->userModel->getUsers();

    $this->view('user/list', $data);
  }

  public function add_user()
  {
    //Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST Data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Process form
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'role' => trim($_POST['role']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please inform the email user';
      } else {
        // Check email
        if ($this->userModel->getUserByEmail($data['email'])) {
          $data['email_err'] = 'This email already exists in the database.';
        }
      }

      // Validate Name
      if (empty($data['name'])) {
        $data['name_err'] = 'Please inform the name of user';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please inform the password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please inform the password';
      } else if ($data['password'] != $data['confirm_password']) {
        $data['confirm_password_err'] = 'Password does not match!';
      }

      //Make sure errors are empty
      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->userModel->addUser($data)) {
          flash('user_message', 'User created with success!');
          redirect('admin/users');
        } else {
          die('Something wrong');
        }
      } else {
        // Load view with errors
        $this->view('user/add', $data);
      }
    } else {
      // Init data
      $data = [
        'name' => '',
        'email' => '',
        'role' => 'admin',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Load view
      $this->view('user/add', $data);
    }
  }

  public function update_user($id)
  {
    $user = $this->userModel->getUserById($id);

    //Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST Data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Process form
      $data = [
        'id' => (int)$id,
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'permission' => trim($_POST['role']),
        'name_err' => '',
        'email_err' => '',

      ];

      // Validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please inform the email user';
      }
      // Validate Name
      if (empty($data['name'])) {
        $data['name_err'] = 'Please inform the name of user';
      }

      //Make sure errors are empty
      if (empty($data['name_err']) && empty($data['email_err'])) {

        if ($this->userModel->updateUser($data)) {
          flash('user_message', 'User updated with success!');
          redirect('admin/users');
        } else {
          die('Something wrong');
        }
      } else {
        // Load view with errors
        $this->view('user/add', $data);
      }
    } else {
      // Init data
      $data = [
        'id' => (int)$id,
        'name' => $user->name,
        'email' => $user->email,
        'permission' => $user->permission,
        'name_err' => '',
        'email_err' => '',

      ];

      // Load view
      $this->view('user/update', $data);
    }
  }

  public function delete_user($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Get existing post from model
      $user = $this->userModel->getUserById($id);

      //Check if the user is logged
      if ($user->id == $_SESSION['user_id']) {
        flash('user_message', 'You cannot delete your own user!');
        redirect('admin/users');
      }

      //Check if the user has posts
      // $row = $this->postModel->getPostByUserId($id);
      // if ($row->total > 0) {
      //   flash('user_message', 'You cannot delete a user with published posts!');
      //   redirect('admin/users');
      // }

      if ($this->userModel->deleteUser($id)) {
        flash('user_message', 'The user was removed with success!');
        redirect('admin/users');
      } else {
        flash('user_message', 'An erro ocurred when delete user');
        redirect('admin/users');
      }
    } else {
      redirect('admin/users');
    }
  }

  public function products()
  {

    
    $data['products'] = $this->productModel->getProducts();

    $this->view('product/list', $data);
  }

  public function add_product()
  {
    // dd(dirname(dirname(__DIR__)));
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST Data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $target_dir    = dirname(dirname(__DIR__)).'\public\uploads\\';
      $target_file   = $target_dir . basename($_FILES["file"]["name"]);
      $allowUpload   = true;
      $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      $maxfilesize   = 800000;
      $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
      
      // Process form
      $data = [
        'user_id' => (int)$_SESSION['user_id'],
        'name' => trim($_POST['name']),
        'price' => (int)$_POST['price'],
        'price_sale' => (int)$_POST['price_sale'],
        'image' => '',
        'soluong' => (int)$_POST['soluong'],
        'body' => trim($_POST['body']),
        'name_err' => '',
        'price_err' => '',
        'price_sale_err' => '',
        'body_err' => '',
        'file_err' => ''
      ];

      // Validate name
      if (empty($data['name'])) {
        $data['name_err'] = 'Nhập tên sản phẩm';
      }
      // Validate Price
      if (empty($data['price'])) {
        $data['price_err'] = 'Nhập giá gốc sản phẩm';
      }

      // Validate Price sale
      if (empty($data['price_sale'])) {
        $data['price_sale_err'] = 'Nhập giá khuyến mại';
      }

      if (empty($data['body'])) {
        $data['body_err'] = 'Nhập mô tả sản phẩm';
      }
      if (file_exists($target_file)) {
        $data['file_err'] = 'File khoong ton tai';
        $allowUpload = false;
      }
      if ($_FILES["file"]["size"] > $maxfilesize) {
        $data['file_err'] = 'File quá lớn';
        $allowUpload = false;
      }
      if (!in_array($imageFileType, $allowtypes)) {
        $data['file_err'] = "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
        $allowUpload = false;
      }

      if ($allowUpload) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
          $data['image'] = $_FILES["file"]['name'];
        } else {
          $data['file_err'] = "Không thể upload được hình ảnh";
        }
      } else {
        $data['file_err'] = "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
      }


      if (empty($data['name_err']) && empty($data['price_err']) && empty($data['price_sale_err']) && empty($data['body_err']) && empty($data['file_err'])) {

        if ($this->productModel->addProduct($data)) {
          flash('user_message', 'Product created with success!');
          redirect('admin/products');
        } else {
          die('Something wrong');
        }
      } else {
        // Load view with errors
        $this->view('product/add', $data);
      }
    } else {
      // Init data
      $data = [
        'name' => '',
        'price' => '',
        'price_sale' => '',
        'soluong' => '',
        'image' => '',
        'body' => '',
        'name_err' => '',
        'price_err' => '',
        'price_sale_err' => '',
        'body_err' => '',
        'file_err' => ''
      ];

      // Load view
      $this->view('product/add', $data);
    }
  }

  public function update_product($id)
  {
    $product = $this->productModel->getProductById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST Data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Process form
      $data = [
        'id' => (int)$id,
        'name' => trim($_POST['name']),
        'price' => (int)$_POST['price'],
        'price_sale' => (int)$_POST['price_sale'],
        'soluong' => (int)$_POST['soluong'],
        'body' => trim($_POST['body']),
        'name_err' => '',
        'price_err' => '',
        'price_sale_err' => '',
        'body_err' => ''
      ];

      // Validate name
      if (empty($data['name'])) {
        $data['name_err'] = 'Nhập tên sản phẩm';
      }
      // Validate Price
      if (empty($data['price'])) {
        $data['price_err'] = 'Nhập giá gốc sản phẩm';
      }

      // Validate Price sale
      if (empty($data['price_sale'])) {
        $data['price_sale_err'] = 'Nhập giá khuyến mại';
      }

      if (empty($data['body'])) {
        $data['body_err'] = 'Nhập mô tả sản phẩm';
      }

      if (empty($data['name_err']) && empty($data['price_err']) && empty($data['price_sale_err']) && empty($data['body_err'])) {

        if ($this->productModel->updateProduct($data)) {
          flash('user_message', 'Product updated with success!');
          redirect('admin/products');
        } else {
          die('Something wrong');
        }
      } else {
        // Load view with errors
        $this->view('product/update', $data);
      }
    } else {

      $data = [
        'id' => (int)$id,
        'name' => $product->name,
        'price' => $product->price,
        'price_sale' => $product->price_sale,
        'soluong' => $product->soluong,
        'body' => $product->body,
      ];

      // Load view
      $this->view('product/update', $data);
    }
  }

  public function delete_product($id)
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if ($_SESSION['role'] !== 'admin') {
        flash('user_message', 'You can not delete product!');
        redirect('admin/products');
      }

      if ($this->productModel->deleteProduct($id)) {
        flash('user_message', 'The product was removed with success!');
        redirect('admin/products');
      } else {
        flash('user_message', 'An error ocurred when delete product');
        redirect('admin/products');
      }
    } else {
      redirect('admin/products');
    }
  }
}
