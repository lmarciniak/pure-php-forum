<?php
namespace Forum\Utilities;

use \PDO;

class Database extends \PDO 
{
    public function __construct() 
    {
        try {
            parent::__construct('mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ));
        } catch (\PDOException $e) {
            echo "Cannot connect to the database! Try later! ". $e->getMessage();
        }
    }

    /**
     * @param string $sql A query
     * @param array $array Parameters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return array 
     */
    public function select(string $query, $array = [], $fetchMode = PDO::FETCH_ASSOC): ?array
    {
        try {
            $stmt = $this->prepare($query);
            foreach ($array as $key => $value) {
                $stmt->bindValue(":$key", htmlspecialchars($value), PDO::PARAM_STR);
            }
            $stmt->execute();
        } catch (\PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        return $stmt->fetchAll($fetchMode);
    }

    /**
     * @param string $table Table, where the data will be inserted
     * @param array $array Parameters to bind
     * @return bool
     */
    public function insert(string $table, $array = []): bool 
    {
        try {
            $query = "INSERT INTO $table VALUES(null";
            foreach ($array as $key => $value) {
                $query .= ", :$key";
            }
            $query .= ")";
            $stmt = $this->prepare($query);
            foreach ($array as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
        return true;
    }

    /**
     * @param string $table The name of the table where data will be deleted
     * @param string $cond Condition for delete
     * @return int
     */
    public function delete(string $table, string $cond): int
    {
        try {
            $query = "DELETE FROM $table WHERE $cond";
            return $this->exec($query);
        } catch (Exception $e) {
            //echo $e->getMessage();
            return 0;
        }
    }

    /**
     * @param string $table The name of table where data will be updated
     * @param string $column The name of column where data will be updated
     * @param string $value Value
     * @param string $where Condition
     * @return bool
     */
    public function update(string $table, string $column, string $value, string $where): bool
    {
        try {
            $query = "UPDATE $table SET $column='$value' WHERE $where";
            $stmt = $this->prepare($query);
            $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}