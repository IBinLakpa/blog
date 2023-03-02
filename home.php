<?php
   @include 'config.php';
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home Page</title>
      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
   <?php
      @include 'bar.php';
   ?>
      <div class="container">
         <div class="content">
            <?php
               $sql = "SELECT blog_title, blog_content, user_id, timestamp FROM blog ORDER BY id DESC";
               // Execute the query and get the result
               $result = $conn->query($sql);
               // Check if there are any rows returned
               if ($result->num_rows > 0) {
                  // Loop through each row in the result set
                  while ($row = $result->fetch_assoc()) {
                        // Access the data from the current row
                        $topic = $row["blog_title"];
                        $content = $row["blog_content"];
                        $user_id = $row["user_id"];
                        $timestamp = $row["timestamp"];
                        $select = "SELECT username FROM users WHERE id = $user_id";
                        $result2 = mysqli_query($conn, $select);
                        if (mysqli_num_rows($result2) > 0) {
                           $row2 = mysqli_fetch_assoc($result2);
                           $by = $row2['username'];
                        } else {
                           $by = "Unknown";
                        }
                        $maxWidth = 600;
                        // Wrap the content to the maximum width and replace line breaks with <br> tags
                        $content = str_replace("\n", "<br>", wordwrap($content, $maxWidth, "\n"));
                        // Do something with the data, such as print it out to the screen
                        echo "<section>
                           <h3>$topic</h3>
                           <span>-By $by</span>
                           <div class='blog-content'>$content</div>
                           <span>$timestamp</span>
                        </section>";
                  }
               } else {
                  echo "0 results";
               }
            ?>
         </div>
      </div>
   </body>
</html>