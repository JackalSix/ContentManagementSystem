<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson Add Video</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!--Hunter Glisson-->
    <form action="?" method="post">
            <h4>Add your new video information here:</h4>
      <div>
        <label for="movienum">Movie Number:</label>
        <input type="text" id="movienum" name="newnewmovienum" maxlength="5" size="5" required>
      </div>
      <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="newtitle" maxlength="25" size="25" required>     
      </div>
      <div>
        <label for="studio">Studio:</label>
        <select name="newstudio" id="studio">
		
         <!-- Add code here to handle Studio Select list -->
		 <?php foreach ($studios as $studio): ?>
		 <option value="<?php echo $studio['studioid']; ?>"><?php echo $studio['studioname'];?></option>

		 <?php endforeach; ?>
		 
        </select>    
      </div>
      <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="newcategory" maxlength="15" size="15" required>     
      </div>
      <div>
        <label for="length">Length:</label>
        <input type="text" id="length" name="newlength" maxlength="3" size="3" required>     
      </div>
      <div id="btns">
        <input type="submit" value="Add"><a href="index.php">Return</a>
      </div>
    </form>
  </body>
</html>
