<?php

//This script will read the reccured count of that particular script and remove it from the cron tab if the reccurance is over 
//to be get through params ------------------>>>>>>>>>>> cron_id , URL TO BE EXECUTED

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "cronjob";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

//will get values through params
$cron_id = 43;

// Retrieve the updated count
$result = $conn->query("SELECT cron_url,reccurance,reccured,cron_command FROM cronDetails WHERE cron_id = $cron_id");
$row = $result->fetch_assoc();
$reccured = $row['reccured']; 
$reccurance = $row['reccurance'];
$url = $row['cron_url'];
$command = $row['cron_command'];


//to know the count of script runs and if  it exceeds then that particular cron tab will be removed
    
if ($reccured >= $reccurance) {
    
            $to_remove = $command;
            $jobs = shell_exec("crontab -l"); 
            $removed = str_replace($to_remove,"",$jobs); 
            shell_exec("echo '$removed' | sort | uniq | crontab"); 

} 
else
{

    
    // Prepare the SQL statement to update the database
    $sql = "UPDATE cronDetails SET reccured = reccured + 1 WHERE cron_id = $cron_id;";
    

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {

        echo "\n"."Record updated successfully";
    } else {

        echo "\n"."Error updating record: " . $conn->error;

    }


// URL to send the request to
//    $url = 'https://example.com';

// Initialize a new curl resource
    $ch = curl_init();

// Set the URL to send the request to
    curl_setopt($ch, CURLOPT_URL, $url);

// Return the response as a string instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the curl request
    $response = curl_exec($ch);

// Close the curl resource to free up system resources
    curl_close($ch);

// Print the response
    print_r($response);
    
}

?>
