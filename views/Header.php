<!DOCTYPE html>
<html>
<head>
   <link rel='stylesheet' type= "text/css" href=<?php echo base_url('css/styles.css');?>>
</head>
<body>
   <ul class='header'>
      <li><h1><b>FAKEBOOK</b></h1></li>
      <?php if(isset($_SESSION['username']) == TRUE){?>
      <li><a href=<?php echo site_url('/user/view/' . $_SESSION['username']) ?>>Profile</a></li>
      <li><a href=<?php echo site_url('/user/feed/' . $_SESSION['username']) ?>>Feed</a></li>
      <li><a href=<?php echo site_url('/search')?>>Search</a></li>
      <li><a href=<?php echo site_url('/message')?>>New Post</a></li>
      <li><a href=<?php echo site_url('/user/logout')?>>Logout</a></li>
      <li class='logged'><?php echo 'Logged in as:' . $_SESSION['username']?></li>
      <?php } else {?>
      <li><a href=<?php echo site_url('/user/login')?>>Login</a></li>
      <?php } ?>
   </ul>
</body>
</html>