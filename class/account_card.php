<?php
    class account_card{

        // Connection
        private $conn;

        // Table
        private $db_table = "account_card";

        // Columns
      

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAccounts(){
            $sqlQuery = "SELECT * FROM " . $this->db_table ."";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
            //return $stmt;
        }

        // CREATE

        
            // sanitize


        // UPDATE
    
        public function updateAcoounts($money,$card_id){
          try{  $sql = "UPDATE `account_card` SET `money_has`=$money WHERE `card_id`=$card_id";
        
            $stmt = $this->conn->prepare($sql);
        
            //print_r( $stmt);
            $stmt->execute(); 
            echo "Data Update Successfuly in DataBase :)";
            return 1;
        }
        catch(PDOException $e) 
        {
                //echo "Connection failed: " . $e->getMessage();
                return 0;
        }
    }

        function updateEmployee1($re,$id)
        {
            $sqlQuery = "UPDATE
            ". $this->db_table ."
        SET
            money_has = :money_has, ";
            
        ///WHERE 
           // id = :id";
            
            $stmt = $this->conn->prepare($sqlQuery);
            $this->money_has=htmlspecialchars(strip_tags($this->money_has));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":money_has", $this->money_has);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
                echo " yesssssssss5";
               return true;

            }
            return false;
            echo "no 5";

        }



        


        // UPDATE


        // DELETE


        /////////////////////////////////  me me

    

    }
?>

