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
  }
  public function index()
  {


    $this->view('admin/index');
  }

  public function users()
  {
    $data['users'] = $this->userModel->getUsers();

    $this->view('users/list', $data);
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
        $this->view('users/add', $data);
      }
    } else {
      // Init data
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Load view
      $this->view('users/add', $data);
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
}
