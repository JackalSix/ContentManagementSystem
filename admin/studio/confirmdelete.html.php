<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson Delete</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <!--Hunter Glisson-->
        <table>
          <tr>
              <th>Studio Name</th>
              <th>Contact<br>Person</th>
              <th>Phone<br>Number</th>
          </tr>    
		  <?php foreach ($studios as $studio): ?>
     	  <form action="?deletevideo" method="post">
			<tr>
               <td> <?php echo htmlspecialchars($studio['name'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($studio['contact'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($studio['phone'], ENT_QUOTES, 'UTF-8'); ?></td>         
                <input type="hidden" name="studioid" value="<?php echo $studio['studioid']; ?>">
          </tr>

       </form>		  
       <?php endforeach; ?>
     </table> 
	 <p>Are you sure you wish to delete this record?</p>
	 <a href="?confirmdelete=<?php echo $studio['studioid']?>">yes</a>
	 <a href="?">no</a>
  </body>
</html>
