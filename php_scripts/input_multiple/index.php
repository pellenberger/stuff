<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>
    <body>
        
        <?php
        
        /* 
         * Create a new resized image. 
         * The height of the new image will be calculated with the given width, in respect of the source image ratio
         */
        function createResizedImage($srcFile, $destFile, $destWidth)
        {
                // Get size of source image
                list($srcWidth, $srcHeight) = getimagesize($srcFile);
                
                // Choose the width of the resized image     
                $destWidth = 200;
                
                // Height of the resized image calculated with the same ratio of the source image
                $destHeight = $srcHeight / $srcWidth * $destWidth;
                
                // Create a new image
                $imgDest = imagecreatetruecolor($destWidth, $destHeight);
                
                // We use a jpg source image
                $imgSrc = imagecreatefromjpeg($srcFile);
                
                // Resize
                imagecopyresampled($imgDest, $imgSrc, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);
                
                // We generate a jpg image
                imagejpeg($imgDest, $destFile, 100);
                
                // Free memory
                imagedestroy($imgDest);
                imagedestroy($imgSrc);            
        }
        
        if (isset($_POST["submit"]))
        {            
            $fileNames = $_FILES["image"]["name"];
            $fileTmpNames = $_FILES["image"]["tmp_name"];
            for ($i = 0; $i < count($fileNames); $i ++)
            {
                move_uploaded_file($fileTmpNames[$i], "./img-to-resize/" . $fileNames[$i]);
           
                createResizedImage("./img-to-resize/$fileNames[$i]", "./img/$fileNames[$i]", 1024);            

                unlink("./img-to-resize/$fileNames[$i]");
            }
        }
        
        ?>
        
        <form action="index.php" method="post" enctype="multipart/form-data">
            
            
            <input type="file" name="image[]" multiple="multiple" />
            <input type="submit" name="submit" value="envoyer" />
            
        </form>
        
        
    </body>
</html>
