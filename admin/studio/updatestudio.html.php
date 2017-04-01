<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson Update Video</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">  </head>
  <body>
  <!--Hunter Glisson-->
    <form action="?" method="post">
        <h4>Edit your studio here:</h4>
        <?php foreach ($studios as $studio): ?>
      <div>
        <label for="studioid">Studio ID:</label>
        <input type="text" id="studioid" class="greyed" name="updatedstudioid" maxlength="3" size="3" value="<?php echo $studio['studioid']; ?>" readonly>
      </div>
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="updatedname" value="<?php echo $studio['name']; ?>" maxlength="30" size="30" required>     
      </div>
      <div>
        <label for="contact">Contact Person:</label>
        <input type="text" id="contact" name="updatedcontact" value="<?php echo $studio['contact']; ?>" maxlength="25" size="25" required>  
        </select>    
      </div>
      <div>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="updatedphone" value="<?php echo $studio['phone']; ?>" maxlength="12" size="12" required>
      </div>
	  
        <?php endforeach; ?>
      	<div id="btns">
        	<input type="submit" value="Update"><a href="index.php">Return</a>
        </div>
    </form>

  </body>
</html>
