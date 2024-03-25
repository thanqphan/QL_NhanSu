<?php
require_once("config/db.class.php");

class PhongBan
{
    public $Ma_Phong;
    public $Ten_Phong;

    public function __construct($ma_phong, $ten_phong)
    {
        $this->Ma_Phong = $ma_phong;
        $this->Ten_Phong = $ten_phong;
    }

    public function save()
    {
        $db = new DB();
        $sql = "INSERT INTO phongban (Ma_Phong, Ten_Phong) VALUES ('$this->Ma_Phong', '$this->Ten_Phong')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function list_phongban()
    {
        $db = new Db();
        $sql = "SELECT * FROM phongban";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public function update()
    {
        $db = new DB();
        $sql = "UPDATE phongban SET Ten_Phong = '$this->Ten_Phong' WHERE Ma_Phong = '$this->Ma_Phong'";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function delete($ma_phong)
    {
        $db = new DB();
        $sql = "DELETE FROM phongban WHERE Ma_Phong = '$ma_phong'";
        $result = $db->query_execute($sql);
        return $result;
    }
}