<?php

    include_once '../config/database.php';
    include_once '../class/account_movement.php';
    include_once '../class/user_amount.php';
    include_once '../class/account_user_card.php';

    $database = new Database();
    $db = $database->getConnection();

    $item1 = new account_user_card($db);
    $item2 = new user_amount($db);
    $item3 = new account_movement($db);
    //echo $name_cust =$_POST['name'].'<br>';
    //echo $num_cust=$_POST['num'].'<br>';
    //echo $pass_cust=$_POST['pass'].'<br>';
    //echo $date_cust=$_POST['Exp_date'].'<br>';
    //echo $url_web=$_POST['url'].'<br>';



     //$name_cust =$_POST['name'];
     //$num_cust=$_POST['num'];
     //$pass_cust=$_POST['pass'];
     //$date_cust=$_POST['Exp_date'];
     //$url_web=$_POST['url'];
     //$totalcost='60';
     //$id_web_account=2;
     $num_web_card='123456789';
     $pass_web='123456789';
     $result_return=1;

     //////////////////////////////
    //$name =$_POST['card_name'];
    $num_cust=$_POST['card_num'];
    $pass_cust=$_POST['card_pass'];
    $date_cust=$_POST['Expired_date'];
    $url_web=$_POST['url'];
    echo $totalcost=$_POST['cost'];
    $user=$_POST['user_id'];
    $num_web_card=$_POST['web_id'];
    $pass_web=$_POST['web_pass'];

    
    $web=$item1->getUser(); //for check users 
    foreach($web as $w) 
    {//echo $r->card_num;
        if($w->card_num == $num_web_card && $w->card_pass == $pass_web) //if exit user in users
        {     //$result_return=4;
            $web_card_id=$w->card_id;
            $users=$item1->getUser(); //for check users 
              foreach($users as $r) 
            {  //echo $r->card_num;
                 if($r->card_num == $num_cust && $r->card_pass == $pass_cust) //if exit user in users
                {      //$result_return=4; echo ''
                    
                    if($r->card_exp == $date_cust && $r->card_exp > date('y-m-d')) //if date true in users
                    {     //$result_return=4;
                        echo 'dooooone exp date <br>';                             //if date true in users
                        $card_numb=$r->card_num; 
                        $id_card=$r->card_id;
                        $amount_web=$item2->getAmount(); //for check web amount
                         foreach($amount_web as $row1)
                        {  
                            if($row1->card_num == $num_web_card)
                          {      //$result_return=4;
                               $amount_cust=$item2->getAmount(); //for check user amount 
                              foreach($amount_cust as $row2)
                            {         //$result_return=4;
                                 if($row2->card_num == $card_numb)  // for check card num 
                                {        //$result_return=4;
                                    echo "dooooooooone card in amount <br>";
                                    //$result_return=2;
                                     if($row2->account_amount >= $totalcost) // for check amount
                                    {         $result_return=4;
                                               echo "dooooooooone cost in amount <br>";
                                               $amount_new_cust=$row2->account_amount - $totalcost; // take from cust
                                               $amount_new_web=$row1->account_amount + $totalcost; //put in web
                                               $id_amount_cust=$row2->account_id;
                                               $id_amount_web=$row1->account_id;
                                               $result_update_cust=$item2->updateAmount($amount_new_cust,$id_amount_cust);//update amount for user cust
                                             if($result_update_cust == 1)
                                            {        //$result_return=4;

                                                $result_update_web=$item2->updateAmount($amount_new_web,$id_amount_web);//update amount for web 
                                                if($result_update_web == 1)
                                                {     $result_return=4;
                                                    echo 'done web';
                                                     ////////////////////for move tuble 
                                                     $mov_ty_cust=0;
                                                     $mov_amount_cus=$totalcost;
                                                     $mov_date=date('y-m-d');
                                                     $card_id=$r->card_id;
                                                     $mov_amount_web=$totalcost;
                                                     $web_card_id=$w->card_id;
                                                      $mov_ty_web=1;
      
                                                     $item3->insertMove($mov_ty_cust,$mov_amount_cus,$mov_date,$card_id);
                                                     $item3->insertMove($mov_ty_web,$mov_amount_web,$mov_date,$web_card_id);
                                                     echo $result_return=4;
                                                     break;
                                                }
                                                else
                                                {
                                                   //echo 'can not update 2'; process has mistake
                                                   $result_return=0;
                                                   break;
                                                }
                                            }
                                            else
                                            {
                                               //echo 'can not update 1'; process has mistake
                                               $result_return=0;
                                               break;
                                            }
                                    }       //end of check amount bigger then cost 
                                  else
                                    { 
                                        //echo "dooooooooone not cost  in amount <br>";
                                        $result_return=2;
                                         break;
                                    }

                                }              //end if date true in users
                                 else
                                {
                                    //echo 'not dooooooone date <br>';                            //if date false in users
                                    //continue;
                                    $result_return=1;
                                    continue;
                                }
                                  //'user exit <br>';
                                   //$result_return=1;
                                   //break;
                            }                                                     //end foreach user amount 
                           }//end if web amount is exite

                           else
                           {
                               //echo 'web amount not exit';
                               //$result_return=0;
                               continue;
                           }
                           //$result_return=1;
                        }                                                        //end foreach web amount
                    }                                          ///date is   true

                   else
                   {
                     //echo 'user not exit <br>';
                                           ///date is not  true
                     $result_return=3;
                     continue;
                   }


                }
                else
                {
                    //$result_return=1;////////////////////////////////////////////////////
                     continue;
                }



              //echo 'web  exit <br>';
              //$result_return=1;

            }// end foreach user

        }    
        else
        {
            //echo 'web not exit <br>';
            //$result_return=1;
            continue;
            
        }

   }     // end foreach web




   //echo '<meta http-equiv = "refresh" content = "0.5; url ="'.$url_web.'"?id="'.$result_return.'"&user="'.$user.'"&cost="'.$totalcost.'"&card_num="'.$num_cust.'" />';

    //echo $result_return;
    header("location:".$url_web."?id=".$result_return."&user=".$user.'&cost='.$totalcost.'&card_num='.$num_cust);
    exit();

    ?>