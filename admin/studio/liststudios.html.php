<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson List of Studios</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <!--Hunter Glisson-->
        <table>
          <tr>
              <th>Studio Name</th>
              <th>Contact<br>Person</th>
              <th>Phone<br>Number</th>
              <th colspan="2">Action</th>
          </tr>    
		  <?php foreach ($studios as $studio): ?>
     	  <form action="?deletestudio" method="post">
			<tr>
               <td> <?php echo htmlspecialchars($studio['name'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($studio['contact'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($studio['phone'], ENT_QUOTES, 'UTF-8'); ?></td>         
                <input type="hidden" name="studioid" value="<?php echo $studio['studioid']; ?>">
               <td> <input type="submit" value="Delete"></td>
               <td> <?php $qstring="?studioid=".$studio['studioid'];
                    echo "<a href=".$qstring.">Edit</a>";?>
               </td>
          </tr>
       </form>
       <?php endforeach; ?>
     </table> 
        <p><a href="?addstudio">Add your own Studio</a></p><a href="../index.html">Return</a>
  </body>
</html>
