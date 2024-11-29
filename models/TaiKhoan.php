<?php
class TaiKhoan
{
  public $conn;
  public function __construct()
  {
    $this->conn = connectDB();
  }
  public function checkLogin($email, $mat_khau)
  {
    try {
      $sql = "SELECT * FROM tai_khoans WHERE email = :email";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['email' => $email]);
      $user = $stmt->fetch();
      // var_dump($user);die;
      if ($user && password_verify($mat_khau, $user['mat_khau'])) {
        if ($user['chuc_vu_id'] == 2) {
          if ($user['trang_thai'] == 1) {
            $_SESSION['user_client'] = [
              'id' => $user['id'],
              'email' => $user['email'],
            ];
            // var_dump($_SESSION['user_client']['id']);die;
            header("location: " . BASE_URL);
            return $user['email'];
          } else {
            return "Tài khoản bị cấm";
          }
        } else {
          return "Tài khoản không có quyền truy cập";
        }
      }  else {
        return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản";
      }
    } catch (\Exception $e) {
      echo "lỗi" . $e->getMessage();
      return false;
    }
  }
  public function getTaiKhoanFromEmail($email)
  {
    try {
      $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        ':email' => $email
      ]);
      return $stmt->fetch();
    } catch (Exception $e) {
      echo "lỗi" . $e->getMessage();
      flush();
    }
  }
}
