<?php
namespace Moonsat\Clique\Models;

use Slim\Http\Request;

class general
{

    public static function hash($data)
    {

        return self::hashPass(PASSHASH, $data, PASSKEY);
    }

    public static function appHash($data)
    {

        return self::hashPass(PASSHASH, $data, APPKEY);
    }
    public static function getAuth(Request $request){
        return $request->getAttribute('decoded_token_data');
    }
    
    public static function hashPass($algo, $data, $salt)
    {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return str_replace(["/", '@', '&', '=', '?'], "", hash_final($context));
    }

    public static function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 0)
    {
        // Obtain image from given source file.
        $ext = pathinfo($sourceImage, PATHINFO_EXTENSION);

        if ($ext == 'jpg') {
            if (!$image = @imagecreatefromjpeg($sourceImage)) {
                return false;
            }
        } else if ($ext == 'jpeg') {
            if (!$image = @imagecreatefromjpeg($sourceImage)) {
                return false;
            }
        } else if ($ext == 'png') {
            if (!$image = @imagecreatefrompng($sourceImage)) {
                return false;
            }
        } else if ($ext == 'gif') {
            if (!$image = @imagecreatefromgif($sourceImage)) {
                return false;
            }
        } else if ($ext == 'webp') {
            if (!$image = @imagecreatefromwebp($sourceImage)) {
                return false;
            }
        } else {
            return false;
        }

        // Get dimensions of source image.
        list($origWidth, $origHeight) = getimagesize($sourceImage);

        if ($maxWidth == 0) {
            $maxWidth = $origWidth;
        }

        if ($maxHeight == 0) {
            $maxHeight = $origHeight;
        }

        // Calculate ratio of desired maximum sizes and original sizes.
        $widthRatio = $maxWidth / $origWidth;
        $heightRatio = $maxHeight / $origHeight;

        // Ratio used for calculating new image dimensions.
        $ratio = min($widthRatio, $heightRatio);
        // Calculate new image dimensions.
        $newWidth = (int) $origWidth * $ratio;
        $newHeight = (int) $origHeight * $ratio;

        // Create final image with new dimensions.
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
        imagepng($newImage, $targetImage, $quality);

        // Free up the memory.
        imagedestroy($image);
        imagedestroy($newImage);

        return true;
    }
}
