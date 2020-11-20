<?php
    class account_user_card{

        // Connection
        private $conn;

        // Table
        private $db_table = "account_user_card";

        // Columns
      

        // Db connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // GET ALL
        public function getUser()
        {
            $sqlQuery = "SELECT * FROM " . $this->db_table ."";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
            //return $stmt;
        }

        // CREATE
        public function insertMove($mov_ty,$mov_amou,$mov_date,$card_id)
        {
            $final_query="INSERT INTO `account_user_card` (`card_id`, `card_num`, `card_pass`, `card_exp`) VALUES ('$mov_ty','$mov_amou','$mov_date','$card_id')";
            
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
    
        

        


    

    }
?>

