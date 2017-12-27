
<?php



require_once('../SQLFunctions.php');
session_start();


    //Store variables
    //Use filter_var to remove special characters from the inputs 
    $AcceptOption = filter_var($_POST['AcceptOption'], FILTER_SANITIZE_STRING);
    $PassedUsername = filter_var($_POST['PASS'], FILTER_SANITIZE_STRING);
    
    try
    {
        

        $link = connectDB();




        if($AcceptOption == 'acceptOne'){
            // Prepare the sql insert statement
            $sql = "UPDATE Player SET RequestStatus = 'accepted' WHERE LoginID = '".$PassedUsername."'";
            if (mysqli_query($link, $sql)) {
                $message = 'Bottom row player has been accepted.';
            } else { 
                echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
        
        else if($AcceptOption == 'declineOne'){
            // Prepare the sql insert statement
            $sql = "UPDATE Player SET RequestStatus = 'declined' WHERE LoginID = '".$PassedUsername."'";
            if (mysqli_query($link, $sql)) {
                $message = 'Bottom row player has been declined.';
            } else { 
                echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
        
        else if($AcceptOption == 'acceptAll'){
            // Prepare the sql insert statement
            $sql = "UPDATE Player SET RequestStatus = 'accepted' WHERE RequestStatus = 'Pending'";
            if (mysqli_query($link, $sql)) {
                $message = 'All players accounts have been accepted.';
            } else { 
                echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
        
        else if($AcceptOption == 'declineAll'){
            // Prepare the sql insert statement
            $sql = "UPDATE Player SET RequestStatus = 'declined' WHERE RequestStatus = 'Pending'";
            if (mysqli_query($link, $sql)) {
                $message = 'All player accounts have been declined';
            } else { 
                echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
        
        else {
            // Prepare the sql insert statement
                echo  "No changes have been made.";
        }
        
    }

    catch(Exception $e)
    {
        $message = 'Unable to process request';
    }



?>

<html>
  <head>
    <title>Players Request Submit</title>
  </head>
  <body>
    <!-- Message is a variable that was populated previously based on the php above  -->    
    <p><?php echo $message; ?>
  </body>
  <form action="playerRequests.php" method="post">
     <input type="submit" value="Return"/>
  </form>
</html>
