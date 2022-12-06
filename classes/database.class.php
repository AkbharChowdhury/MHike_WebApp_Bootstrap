<?php

/**
 * @author Akbhar Chowdhury
 * @description Akbhar Chowdhury StudentPlanner website
 */
final class Database
{

    private $con;
    private $lastID;
    private $data = [];
    private static $instance = null;
    private $errorMessage;
    private $isUniDays = true;

    // search functionality
    private const RECORDS_PER_PAGE = 6;
    private $start, $pageNumber;
    private $productQuery;
    private $courseworkCount;
    private $moduleID;
    private $courseworkTitleSearch;
    private $studentID;
    private $relatedCoursework = [];

    public static function getInstance()
    {
        return self::$instance === null ? self::$instance = new Database : self::$instance;
    }

    public function addData(string $key, $val)
    {
        $this->data[$key] = $val;
        return $this;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }


    public function getData(string $key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        throw new Exception($key . ' does not exists');
    }

    public function resetData()
    {
        $this->data = [];
    }


    private function __construct()
    {
    }

    private function getConnection()
    {
        try {
            $config = [
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'databaseName' => 'MHike',
                'charset' => 'charset=utf8'
            ];
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['databaseName'] . ';' . $config['charset'];
            $this->con = new PDO($dsn, $config['username'], $config['password']);
            $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->con;
        } catch (PDOException $e) {

            echo $this->showErrorMessage('There was an error connecting to the database <br> ' . $e->getMessage());
        }
    }


    public function databaseContainsUser()
    {
        $sql = "SELECT COUNT(*) AS `found` FROM `User` WHERE `email` = :email AND `password` = :password";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        $row = $stmt->fetch();
        $this->errorMessage = !$row['found'] > 0 ? 'incorrect email and password combination' : '';
        return $row['found'] > 0 ? true : false;
    }

    public function getUserID($email)
    {
        $sql = "SELECT `user_id` FROM `User` WHERE `email` = :email LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getLastID()
    {
        return $this->lastID;
    }


    public function addUser()
    {

        $sql = "INSERT INTO `User`
                 SET `firstname` = :firstname, 
                    `lastname` = :lastname, 
                    `email` = :email, 
                    `password` = SHA(:password)";
        $this->getConnection()->prepare($sql)->execute($this->data);


        $this->lastID = $this->con->lastInsertId();
        return true;
    }


    public function getUserHikeDetails() {

        $sql = 'SELECT * FROM Hike  WHERE user_id = :user_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetchAll();
    }




    public function addHike($date, $hike_name, $location, $des, $distance, $duration, $parking_id, $elevation_gain, $high, $difficulty_id)
    {

        $sql = 'INSERT INTO Hike (`user_id`, `hike_date`, `hike_name`, `location`, `description`, `distance`, `duration`, `parking_id`, `elevation_gain`,  `high`,`difficulty_id`)
    VALUES (:user_id, :hike_date, :hike_name,:location, :description, :distance, :duration,:parking_id,:elevation_gain,:high,:difficulty_id)';
        return $this->getConnection()->prepare($sql)->execute([
            'user_id' => $_SESSION['user_id'],
            'hike_date' => $date,
            'hike_name' =>$hike_name,
            'location' =>$location,

            'description' => $des,
            'distance'=> $distance,
            'duration' =>$duration,
           'parking_id' =>$parking_id,
            'elevation_gain'=>$elevation_gain,
            'high'=>$high,

            'difficulty_id'=>$difficulty_id
        ]);


        return true;
    }

    public function userEmailExists($email)
    {
        $sql = 'SELECT COUNT(*) AS `email_found` FROM `User` WHERE `email` = :email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['email_found'] > 0 ? true : false;
    }

    public function getParking()
    {
        return $this->getConnection()->query('SELECT * FROM `Parking` ORDER BY parking_id ASC')->fetchAll();
    }

    public function getDifficultyIDByName($type)
    {
        $sql = "SELECT `difficulty_id` FROM `Difficulty` WHERE `type` = :difficulty_id LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':difficulty_id', $type);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}
