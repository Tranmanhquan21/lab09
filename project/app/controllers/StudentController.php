<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/StudentModel.php';

class StudentController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function index() {
        // Render giao diện chính
        $this->view('students/index');
    }

    // API xử lý Ajax
    public function api() {
        header('Content-Type: application/json');
        
        // Lấy action từ GET hoặc POST
        $action = $_REQUEST['action'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            switch ($action) {
                case 'list':
                    $data = $this->model->all();
                    echo json_encode(['success' => true, 'data' => $data]);
                    break;

                case 'create':
                    if ($method === 'POST') {
                        $this->handleSave();
                    }
                    break;

                case 'update':
                    if ($method === 'POST') {
                        $this->handleSave(true);
                    }
                    break;

                case 'delete':
                    if ($method === 'POST') {
                        $id = $_POST['id'] ?? 0;
                        $this->model->delete($id);
                        echo json_encode(['success' => true, 'message' => 'Xóa thành công']);
                    }
                    break;
                
                case 'get_one':
                    $id = $_GET['id'] ?? 0;
                    $student = $this->model->find($id);
                    echo json_encode(['success' => true, 'data' => $student]);
                    break;

                default:
                    echo json_encode(['success' => false, 'message' => 'Action invalid']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function handleSave($isUpdate = false) {
        $id = $_POST['id'] ?? null;
        $code = trim($_POST['code']);
        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $dob = $_POST['dob'] === '' ? null : $_POST['dob'];

        // Validate cơ bản
        $errors = [];
        if (empty($code)) $errors['code'] = 'Mã SV không được để trống';
        if (empty($full_name)) $errors['full_name'] = 'Họ tên không được để trống';
        if (empty($email)) $errors['email'] = 'Email không được để trống';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email không hợp lệ';

        // Check trùng Code/Email
        if (empty($errors)) {
            if ($this->model->checkExists($code, $email, $isUpdate ? $id : null)) {
                $errors['common'] = 'Mã SV hoặc Email đã tồn tại trong hệ thống';
            }
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        $data = [
            'code' => $code,
            'full_name' => $full_name,
            'email' => $email,
            'dob' => $dob
        ];

        if ($isUpdate) {
            $this->model->update($id, $data);
            $msg = 'Cập nhật thành công';
        } else {
            $this->model->create($data);
            $msg = 'Thêm mới thành công';
        }

        echo json_encode(['success' => true, 'message' => $msg]);
    }
}