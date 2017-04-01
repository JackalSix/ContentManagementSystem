<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hunter Glisson List of Videos</title>
    <link href="../../includes/yourstylesheet.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <!--Hunter Glisson-->
        <table>
          <tr>
              <th>Video Title</th>
              <th>Movie<br>Category</th>
              <th>Movie<br>Length</th>
              <th colspan="2">Action</th>
          </tr>    
		  <?php foreach ($videos as $video): ?>
     	  <form action="?deletevideo" method="post">
			<tr>
               <td> <?php echo htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($video['category'], ENT_QUOTES, 'UTF-8'); ?></td>
               <td> <?php echo htmlspecialchars($video['length'], ENT_QUOTES, 'UTF-8'); ?></td>         
                <input type="hidden" name="movienumber" value="<?php echo $video['movienumber']; ?>">
               <td> <input type="submit" value="Delete"></td>
               <td> <?php $qstring="?movienumber=".$video['movienumber'];
                    echo "<a href=".$qstring.">Edit</a>";?>
               </td>
          </tr>
       </form>
       <?php endforeach; ?>
     </table> 
        <p><a href="?addvideo">Add your own Video Title</a></p><a href="../index.html">Return</a>
  </body>
</html>
