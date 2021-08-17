<html>
<head>
    <title>View Messages</title>
</head>
<body>
<div class="container">
   <?php  
   //Checks if user is following viewed user
   if (isset($_SESSION['following']) == TRUE && $_SESSION['following'] == FALSE){ unset($_SESSION['following']);?> 
      <form action = <?php echo site_url("user/follow/" . $name) ?> method='POST'><button type='submit'>Follow</button></form>
   <?php } ?>
   <table>
      <!--Print if $results is not empty then print out all rows-->
      <?php if (count($results) > 0){ ?>
         <tr><th>Username</th><th>Text</th><th>Date/Time</th></tr>
         <?php foreach ($results as $row){ ?>
         <tr>
            <td><?php echo $row['user_username'];?></td>
            <td><?php echo $row['text'];?></td>
            <td><?php echo $row['posted_at'];?></td>
         </tr>
      <?php } } else {echo "No posts to show.";} ?>
   </table>
</div>
</body>
</html>