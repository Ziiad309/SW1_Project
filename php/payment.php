    <?php
session_start();
require_once ("../inc/db connection.php");

if(isset($_POST['submit'])) {
  $payment_method = $_POST['pay'];

  if($payment_method == 'credit') {
    echo "<form method='post'>
          <label>Credit Card Number:</label>
          <input type='text' name='credit_card_number' required><br><br>
          <label>CVC:</label>
          <input type='text' name='cvc'required><br><br>
          <label>Expiration Date:</label>
          <input type='date' name='expiration_date' required><br><br>
          <label>Password:</label>
          <input type='password' name='password' placeholder = 'e.g. 1234'required><br><br>
          <input type='submit' name='credit_submit' value='Submit Credit Card Details'>
          </form>";
  } else if ($payment_method == 'cash') {
    echo "<form method='post'>
          <label>Amount:</label>
          <input type='text' name='amount' readonly><br><br> 
          <input type='submit' name='cash_submit' value='I Agree'>
          </form>";
  }
}


if(isset($_POST['credit_submit'])) {

  
  $credit_card_number = (string)$_POST['credit_card_number'];
  $cvc = $_POST['cvc']? (string)$_POST['cvc'] : '';
  $date = date('Y-m-d H:i:s');
  $expiration_date = $_POST['expiration_date'];
  $valid_date = strtotime($expiration_date);
  $current_date = time();
  $hashed_password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    if ($current_date > $valid_date){
      echo "the expiration date is not valid" ;
    } else {

    $sql_payment = "INSERT INTO `payment`(`payment_method`, `date`, `amount`, `credit_id`, `cvc`, `valid_date`, `password`, `fee`) VALUES
    ('Credit' , '$date' , null , '$credit_card_number' , '$cvc' , '$expiration_date' , '$hashed_password' , null )";


  if(mysqli_query($connection, $sql_payment)){

    echo "<script>alert('You have paid with credit successfully.')</script>";

      }
   }
}

if(isset($_POST['cash_submit'])) {

  $amount = $_POST['amount'];
  $date = date('Y-m-d H:i:s');

  $sql_payment = "INSERT INTO `payment`(`payment_method`, `date`, `amount`, `credit_id`, `cvc`, `valid_date`, `password`, `fee`) VALUES
  ('Cash' , '$date' , '$amount' , null , null , null , null , '50$' )";

  if(mysqli_query($connection, $sql_payment)){

    echo "<script>alert('You will pay in the clinic.')</script>";
    // we will select amount from db 
    $_SESSION['amount'] ;
  }

}
$connection->close();

?>