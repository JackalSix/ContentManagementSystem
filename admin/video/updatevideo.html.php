<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson Update Video</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">  </head>
  <body>
  <!--Hunter Glisson-->
    <form action="?" method="post">
        <h4>Edit your video here:</h4>
        <?php foreach ($videos as $video): ?>
      <div>
        <label for="movienum">Movie Number:</label>
        <input type="text" id="movienum" class="greyed" name="updatednewmovienum" maxlength="5" size="5" value="<?php echo $video['movienumber']; ?>" readonly>
      </div>
      <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="updatedtitle" maxlength="25" size="25" value="<?php echo $video['title']; ?>" required>     
      </div>
      <div>
        <label for="studio">Studio:</label>
        <select name="updatedstudio" id="studio">
          <!-- Add code here to handle Studio Select list -->
		  <?php foreach ($studios as $studio): ?>
		  <option value="<?php echo $studio['studioid'];?>"
		  <?php if($studio["studioid"] == $video["studioid"]){echo "selected=selected";}?>>
		  <?php echo $studio['studioname'];?></option>
		  <?php endforeach; ?>
        </select>    
      </div>
      <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="updatedcategory" maxlength="15" size="15"  value="<?php echo $video['category']; ?>" required>
       </div>
      <div>
        <label for="length">Length:</label>
        <input type="text" id="length" name="updatedlength" maxlength="3" size="3"  value="<?php echo $video['length']; ?>" required>     
      </div>
        <?php endforeach; ?>
      	<div id="btns">
        	<input type="submit" value="Update"><a href="index.php">Return</a>
        </div>
    </form>
  </body>
</html>
