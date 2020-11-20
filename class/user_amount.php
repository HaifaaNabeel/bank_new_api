<?php
    class user_amount{

        // Connection
        private $conn;

        // Table
        private $db_table = "user_amount";

        // Columns
      

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAmount(){
            $sqlQuery = "SELECT * FROM " . $this->db_table ."";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
            //return $stmt;
        }

        // CREATE
        public function insertMove($mov_ty,$mov_amou,$mov_date,$card_id){
        $final_query="INSERT INTO `account_movement` (`move_type`, `move_amount`, `move_date`, `card_id`) VALUES ('$mov_ty','$mov_amou','$mov_date','$card_id')";
        if( $this->db->executea($final_query))
            { //echo 'done hhhhhhhhhhhhhhhhhhhhhhhhh insert';
                //header('location:home');
              }
         else
               { //echo 'not done mmmmmmmmmmmmmmmmmmmmmmm insert';
                  //header('location:login');
                }
       }
            // sanitize


        // UPDATE
    
        public function updateAmount($money,$card_id)
        {
          try
           {  
              $sql = "UPDATE `user_amount` SET `account_amount`= $money WHERE `user_amount`.`account_id` = $card_id";
              $stmt = $this->conn->prepare($sql);
            //print_r( $stmt);
              $stmt->execute(); 
            //echo "Data Update Successfuly in DataBase :)";
            return 1;
           }
          catch(PDOException $e) 
           {
                //echo "Connection failed: " . $e->getMessage();
                return 0;
           }
       }

        


    

    }
?>

