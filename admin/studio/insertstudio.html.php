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
            <h4>Add your new studio information here:</h4>
      <div>
        <label for="studioid">Studio ID:</label>
        <input type="text" id="studioid" name="newstudioid" maxlength="3" size="3" required>
      </div>
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="newname" maxlength="30" size="30" required>     
      </div>
      <div>
        <label for="contact">Contact Person:</label>
        <input type="text" id="contact" name="newcontact" maxlength="25" size="25" required>  
        </select>    
      </div>
      <div>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="newphone" maxlength="12" size="12" required>     
      </div>

      <div id="btns">
        <input type="submit" value="Add"><a href="index.php">Return</a>
      </div>
    </form>
  </body>
</html>
