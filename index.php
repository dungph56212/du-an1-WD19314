<?php 
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/productlistController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';
require_once './models/comment.php';
require_once './models/danhmucmodels.php';
require_once './models/productlistModel.php';
// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();
// if( $_GET['act']) {
//     $act = $_GET['act'];

// }else{
//     $act = '/';
// }

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    //route
    '/'                 => (new HomeController())->home(),
    'trangchu'           =>(new HomeController())->trangchu(),
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'them-gio-hang'     =>(new HomeController())->addGioHang(),
    'gio-hang'         =>(new HomeController())->gioHang(),
    'thanh-toan'         =>(new HomeController())->thanhToan(),
    'xu-ly-thanh-toan'         =>(new HomeController())->postThanhToan(),
    'lich-su-mua-hang'         =>(new HomeController())->lichSuMuaHang(),
    'chi-tiet-mua-hang'         =>(new HomeController())->chiTietMuaHang(),
    'huy-don-hang'         =>(new HomeController())->huyDonHang(),
    //auth    
    'login'  => (new HomeController())->formLogin(),
    'check-login'  => (new HomeController())->postLogin(),
    'register'  => (new HomeController())-> registers(),
    'logout'  => (new HomeController())-> logout(),
    'add_comment'  => (new HomeController())-> add_comment(),
    'productlist' => (new ProductController())->index(),


};