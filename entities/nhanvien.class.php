<?php
require_once("config/db.class.php");

class NhanVien
{
    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;

    public function __construct($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $this->Ma_NV = $ma_nv;
        $this->Ten_NV = $ten_nv;
        $this->Phai = $phai;
        $this->Noi_Sinh = $noi_sinh;
        $this->Ma_Phong = $ma_phong;
        $this->Luong = $luong;
    }

    public static function get_employee_by_id($ma_nv)
    {
        $db = new DB();
        $query = "SELECT * FROM nhanvien WHERE Ma_NV = '$ma_nv'";
        $result = $db->query_execute($query);

        // Kiểm tra xem có kết quả trả về không
        if ($result && $db->num_rows($result) > 0) {
            $employee = $db->get_row($result);
            return $employee;
        } else {
            return false;
        }
    }
    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES
        ('$this->Ma_NV', '$this->Ten_NV', '$this->Phai', '$this->Noi_Sinh', '$this->Ma_Phong', '$this->Luong')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function list_nhanvien()
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public function update()
    {
        $db = new Db();
        $sql = "UPDATE nhanvien SET Ten_NV = '$this->Ten_NV', Phai = '$this->Phai', Noi_Sinh = '$this->Noi_Sinh',
        Ma_Phong = '$this->Ma_Phong', Luong = '$this->Luong' WHERE Ma_NV = '$this->Ma_NV'";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function delete($ma_nv)
    {
        $db = new Db();
        $sql = "DELETE FROM nhanvien WHERE Ma_NV = '$ma_nv'";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function list_nhanvien_page($start, $limit)
    {
        $db = new DB();
        $query = "SELECT * FROM nhanvien LIMIT $start, $limit";
        $result = $db->query_execute($query);

        // Mảng để lưu trữ danh sách nhân viên
        $employee_list = array();

        // Kiểm tra xem có kết quả trả về không
        if ($result && $db->num_rows($result) > 0) {
            // Lặp qua từng dòng kết quả và thêm vào mảng
            while ($employee = $db->get_row($result)) {
                $employee_list[] = $employee;
            }
        }

        return $employee_list;
    }
}