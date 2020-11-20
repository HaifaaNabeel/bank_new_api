<?php
    class account_movement{

        // Connection
        private $conn;

        // Table
        private $db_table = "account_movement";

        // Columns
      

        // Db connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // GET ALL
        public function getAccount()
        {
            $sqlQuery = "SELECT * FROM " . $this->db_table ."";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
            //return $stmt;
        }

        // CREATE
        public function insertMove($mov_ty,$mov_amou,$mov_date,$account_id)
        {
        $sqlQuery="INSERT INTO `account_movement` (`move_type`, `move_amount`, `move_date`, `account_id`) VALUES ('$mov_ty','$mov_amou','$mov_date','$account_id')";
        //"INSERT INTO `account_movement` (`move_id`, `move_type`, `move_amount`, `move_date`, `card_id`) VALUES (NULL, \'1\', \'250\', \'2020-11-30\', \'1\')";
        $stmt = $this->conn->prepare($sqlQuery);
        if( $stmt->execute())
            { //echo 'done hhhhhhhhhhhhhhhhhhhhhhhhh insert  <br>';
                //header('location:home');
              }
         else
               { //echo 'not done mmmmmmmmmmmmmmmmmmmmmmm insert  <br>';
                  //header('location:login');
                }
        }
            // sanitize


        // UPDATE
    
        

        


    

    }
?>

