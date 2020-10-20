<?php
//немного доработал класс PDO

class DB {

    const DB_HOST = 'localhost:3305';
    const DB_NAME = 'bathhouse';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_CHAR = 'utf8';

    protected static $instance = null;

    private function __construct() {

    }

    private function __clone() {

    }

    /**
     *
     * @return \PDO
     */
    private static function instance() {
        if (self::$instance === null) {
            $opt = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => TRUE,
            );
            $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHAR;
            self::$instance = new \PDO($dsn, self::DB_USER, self::DB_PASS, $opt);
        }
        return self::$instance;
    }


    /**
     *
     * @param string $sql
     * @param array $args
     * @return \PDOStatement
     */
    private static function sql($sql, $args = []) {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return array
     */
    public static function Select($sql, $args = []) {
        return self::sql($sql, $args)->fetchAll();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return array
     */
    public static function getRow($sql, $args = []) {
        return self::sql($sql, $args)->fetch();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer ID
     */
    public static function Insert($sql, $args = []) {
        self::sql($sql, $args);
        return self::instance()->lastInsertId();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer affected rows
     */
    public static function Update($sql, $args = []) {
        $stmt = self::sql($sql, $args);
        return $stmt->rowCount();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer affected rows
     */
    public static function Delete($sql, $args = []) {
        $stmt = self::sql($sql, $args);
        return $stmt->rowCount();
    }

}


