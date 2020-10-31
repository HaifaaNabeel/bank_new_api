<?php
    include_once '../config/database.php';
    include_once '../class/account_card.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new account_card($db);

    $item = new account_card($db);
    $name =$_POST['card_name'];
    $num=$_POST['card_num'];
    $pass=$_POST['card_pass'];
    $date=$_POST['Expired_date'];
    //$date=date('y-m-d');
    $url=$_POST['url'];
    $cost=$_POST['cost'];
    $reut=0;
    $id=0;
    //$name ="vas";
    //$num='1245';
    //$pass='www';
    //$date=2021-12-31;
    //$url='';
    //$cost='90000';
    //$reut;
    //$id=0;


    //$co=10000-$cost;
    //$item->updateAcoounts($co,'1');
    

    $x=$item->getAccounts();
    foreach($x as $r) 
    {
        //echo $r->name;
        if($r->card_name == $name && $r->card_num == $num &&$r->card_pass==$pass)
        {
            //echo "yesssssssssss1";
            if($r->Expired_date == $date && $r->Expired_date > date('y-m-d'))
            { echo "date yes ";
                echo "cost yes or no";
            //echo "yesssssssssss2";
              if($r->money_has > $cost)
               {  echo "cost yes";
                 //echo "yesssssssssss3";
                 $x=$r->money_has-$cost;
                 $id=$r->card_id;
                 $item->updateAcoounts($x,$id);
                 $id=4;
                break;
                }
                else
                {
                    echo "cost no";
                    $id=2;
                    break;

                }
            }
            else
            {
            echo "date no ";
            $id=1;
            break;
            }
    
        }
        else
        {
          $id=3; ///////////error in process
           continue;
        }
        //echo '<br><br> Nooooooooooooo';
    }

    header("location:".$url."?id=".$id);
    exit();
    //echo $id;
    //echo $cost;


    ?>