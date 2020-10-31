<?php
    include_once '../config/database.php';
    include_once '../class/account_card.php';

    $database = new Database();
    $db = $database->getConnection();











    $x=$item->getAccounts();
    foreach($x as $r) {
        //echo $r->name;
        if($r->card_name == $name && $r->card_num == $num &&$r->card_pass==$pass){
            //echo "yesssssssssss1";
        if($r->Expired_date == $date && $r->Expired_date > date('y-m-d'))
        {
            //echo "yesssssssssss2";
            //echo $r->money_has;
            if($r->money_has > $cost)
            {  
                //echo "yesssssssssss3";
                $x=$r->money_has;
                $reut=$x-$cost;
                echo $reut;
                //echo $id=$r->card_id;
                $return= $item->updateAcoounts($reut,$id);
                if( $return == 1 )
                {
                    //echo' your payment is done';$re=1;
                    $id=4;
                }
                else
                {
                    //echo' your payment is not done';
                    $id=3;
                }
            
            }
             else
            {
                $id=2; ///////////error in 
             }
        }
        else
        {
          $id=1; ///error in date of card
        }

    break;
}
        else
        continue;
        //echo '<br><br> Nooooooooooooo';
    }

    //header("location:".$url."?id=".$id);
    //exit();

    ?>