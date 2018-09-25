<!-- PDO file to interact with the database. Used by the MODEL -->

<?php 

/*
* PDO Database Class
* Connect to Database
* Create prepared Statements
* Bind Values
* Return rows and results
*/

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbh; // whenever we prepare a statement we use this.
    private $stmt;
    private $error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true, //to increase performance by checking if database connection is already there
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // elegant way to overthrow errors
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind Values
    public function bind($param, $value, $type = null){
        if(is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute() {
        return $this->stmt->execute();
    }

    // Get the result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Fetch to get single row
    
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get the row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}