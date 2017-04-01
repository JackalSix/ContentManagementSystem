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
              <th>Video Title</th>
              <th>Movie<br>Category</th>
              <th>Movie<br>Length</th>
          </tr>    
		  <?php foreach ($videos as $video): ?>
     	  <form action="?deletevideo" method="post">
			<tr>
               <td> <?php echo htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($video['category'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($video['length'], ENT_QUOTES, 'UTF-8'); ?></td>         
                <input type="hidden" name="movienumber" value="<?php echo $video['movienumber']; ?>">
          </tr>

       </form>		  
       <?php endforeach; ?>
     </table> 
	 <p>Are you sure you wish to delete this record?</p>
	 <a href="?confirmdelete=<?php echo $video['movienumber']?>">yes</a>
	 <a href="?">no</a>
  </body>
</html>
