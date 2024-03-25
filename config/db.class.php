<?php // IDEA:
class Db
{
    protected static $connection;
    public function connect()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);
        }
        if (self::$connection == false) {
            return false;
        }
        return self::$connection;
    }
    public function query_execute($queryString)
    {
        $connection = $this->connect();
        $result = $connection->query($queryString);
        return $result;
    }
    public function escapeString($string)
    {
        $connection = $this->connect();
        return $connection->real_escape_string($string);
    }
    public function select_to_array($queryString)
    {
        $rows = array();
        $result = $this->query_execute($queryString);
        if ($result == false)
            return false;
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }
    public function num_rows($result)
    {
        if ($result === false) {
            return 0;
        }
        return $result->num_rows;
    }
    public function get_row($result)
    {
        if ($result === false || $result->num_rows == 0) {
            return null;
        }
        return $result->fetch_assoc();
    }
}