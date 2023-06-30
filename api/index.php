 <?php
    /**
     * Generate Test Images PHP Script
     *
     * This script generates images based on user-defined parameters and optionally stores them on the server or creates a ZIP archive of the generated images.
     *
     * Author: Munya M. Dev
     * Version: 1.0.0
     * Date: 30/06/2023
     *
     * Instructions:
     * - Ensure the GD library is enabled in your PHP configuration:
     *   - Locate your php.ini file. This file is typically found in the PHP installation directory.
     *   - Open php.ini in a text editor.
     *   - Search for the following line: ;extension=gd. It may be commented out with a semicolon at the beginning.
     *   - Remove the semicolon to uncomment the line. It should now look like: extension=gd.
     *   - Save the changes to php.ini.
     *   - Restart your web server to apply the changes.
     * - If you want to enable the ZipArchive library for creating ZIP archives, uncomment the line 'extension=zip' in your php.ini file and restart your server.
     *
     * Usage:
     * - Send a POST request to this script with the following parameters:
     *   - number_of_images: Number of images to generate.
     *   - image_size_w: Width of the images.
     *   - image_size_h: Height of the images.
     *   - image_backgroundColor_r: Red component of the background color.
     *   - image_backgroundColor_g: Green component of the background color.
     *   - image_backgroundColor_b: Blue component of the background color.
     *   - text_font_size: Font size of the text.
     *   - text_color_r: Red component of the text color.
     *   - text_color_g: Green component of the text color.
     *   - text_color_b: Blue component of the text color.
     *
     * Notes:
     * - The script assumes a font file named 'arial.ttf' is available in the same directory as this script.
     * - Generated images are stored in the 'images/' folder by default.
     *
     */






    //
    if (isset($_POST['generate_test_images_1']) && !empty($_POST['generate_test_images_1'])) {
        // Checking if required POST parameters are set and not empty 
        if (
            isset($_POST['number_of_images']) && !empty($_POST['number_of_images']) &&
            isset($_POST['image_size_w']) && !empty($_POST['image_size_w']) &&
            isset($_POST['image_size_h']) && !empty($_POST['image_size_h']) &&
            isset($_POST['image_backgroundColor_r']) && !empty($_POST['image_backgroundColor_r']) &&
            isset($_POST['image_backgroundColor_g']) && !empty($_POST['image_backgroundColor_g']) &&
            isset($_POST['image_backgroundColor_b']) && !empty($_POST['image_backgroundColor_b']) &&
            isset($_POST['text_font_size']) && !empty($_POST['text_font_size']) &&
            isset($_POST['text_color_r']) && !empty($_POST['text_color_r']) &&
            isset($_POST['text_color_g']) && !empty($_POST['text_color_g']) &&
            isset($_POST['text_color_b']) && !empty($_POST['text_color_b'])
        ) {
            $fontFile = '../style/arial.ttf';
            $imageFolder = '../data/images/';
            $images_generated_count = 0;
            $images_generated_data = [];

            // Generating images
            for ($i = 1; $i <= 1001; $i++) {
                for ($n = 0; $n <= 5; $n++) {
                    if ($images_generated_count < (int)$_POST['number_of_images']) {
                        $images_generated_count++;

                        // Creating a new image with specified dimensions
                        $image = imagecreate(intval($_POST['image_size_w']), intval($_POST['image_size_h']));

                        // Setting image background color and text color
                        $background = imagecolorallocate($image, intval($_POST['image_backgroundColor_r']), intval($_POST['image_backgroundColor_g']), intval($_POST['image_backgroundColor_b']));
                        $textColor = imagecolorallocate($image, intval($_POST['text_color_r']), intval($_POST['text_color_g']), intval($_POST['text_color_b']));

                        // Filling the image with the background color
                        imagefill($image, 0, 0, $background);

                        // Calculating text width and positioning it in the image
                        $textWidth = imagettfbbox((int)$_POST['text_font_size'], 0, $fontFile, (string)$i);
                        $textWidth = $textWidth[2] - $textWidth[0];
                        $x = round(((int)$_POST['image_size_w'] - $textWidth) / 3);
                        $y = round(((int)$_POST['image_size_w'] + (int)$_POST['text_font_size']) / 2);

                        // Adding text to the image
                        imagettftext($image, (int)$_POST['text_font_size'], 0, $x, $y, $textColor, $fontFile, (string)$i . "." . (string)$n);

                        // Encoding the image as PNG and storing the data
                        ob_start();
                        imagepng($image);
                        $image_data = ob_get_clean();
                        $encoded_image_data = base64_encode($image_data);
                        array_push($images_generated_data, $encoded_image_data);

                        // Storing the image on the server if requested
                        if (isset($_GET['store_images_on_server']) && !empty($_GET['store_images_on_server'])) {
                            $filename = $imageFolder . 'image_' . $i . '_' . $n . '.png';
                            imagepng($image, $filename);
                        }

                        // Destroying the image resource
                        imagedestroy($image);
                    }
                }
            }

            // Creating a ZIP file if requested
            if (isset($_GET['download_zip_file']) && !empty($_GET['download_zip_file'])) {
                CreateZIPfile($images_generated_data);
                die();
            }

            if (isset($_GET['store_images_on_server']) && !empty($_GET['store_images_on_server'])) {
                // Returning JSON response with generated image data
                echo json_encode([
                    "result" => true,
                    "message" => $images_generated_count . " images generated and saved to " . substr(__DIR__, 0, strlen(__DIR__) - 3) . 'data\images', "images_generated_data" => $images_generated_data
                ]);
            } else {
                // Returning JSON response with generated image data
                echo json_encode([
                    "result" => true,
                    "message" => $images_generated_count . " images were generated.", "images_generated_data" => $images_generated_data
                ]);
            }
        } else {
            // Returning JSON response indicating missing or empty values
            echo json_encode([
                "result" => false,
                "message" => "Some values were not set.",
                "data" =>
                [
                    "post_object" => $_POST
                ]
            ]);
        }
    }









    /**
     * Creates a ZIP file from an array of image data.
     *
     * @param array $images_array An array containing the base64-encoded image data.
     *
     * @return void
     */
    function CreateZIPfile($images_array)
    {
        $zip = new ZipArchive();
        $date = getdate()['mday'] . '_' . getdate()['wday'] . '_' . getdate()['mon'] . '_' . getdate()['year'];
        $zipFileName = 'images_' . $date . '__' . time() . '.zip';
        $zipFilePath = "../data/zip/" . $zipFileName;
        $debug = [];

        // Opening the ZIP archive
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($images_array as $index => $image_data) {
                $image_data = base64_decode($image_data);
                array_push($debug, $zip->addFromString('image_' . ($index + 1) . '.png', $image_data));
            }
            $zip->close();

            // Returning JSON response with the ZIP file information
            echo json_encode([
                "result" => true,
                "file_name" => $zipFileName,
                "message" => $zipFileName . ' was created and saved in ' . substr(__DIR__, 0, strlen(__DIR__) - 3) . 'data\zip',
                "path" => $_SERVER['HTTP_ORIGIN'] . '/data/zip/' . $zipFileName,
            ]);
        } else {

            // Returning JSON response with the ZIP file information
            echo json_encode([
                "result" => false,
                "message" => 'Failed to create the zip archive.'
            ]);
        }
    }
