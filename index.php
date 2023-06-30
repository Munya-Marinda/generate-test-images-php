 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel='stylesheet' href="./style/style.css" />
     <title>Generate Test Images</title>
 </head>

 <body>

     <main>
         <div class="header_div_style_1">
             <h1 class="header_style_1">
                 GENERATE TESTS IMAGES
             </h1>
             <div class="form_parent_div_1">
                 <div class="input_parent">
                     <!--  -->
                     <div class="input_parent_group">
                         <div class="div_style_1"></div>
                         <label class="lable_style_1" for="image_size_w">Images</label>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">Background Color: </span>
                             <input type="color" value="#8f8f8f" placeholder="red value" name="image_backgroundColor_colorPicker" id="image_backgroundColor_colorPicker_id">
                         </div>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">width: </span>
                             <input type="number" value="250" placeholder="width value" name="image_size_w" id="image_size_w_id">
                         </div>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">height: </span>
                             <input type="number" value="250" placeholder="height value" name="image_size_h" id="image_size_h_id">
                         </div>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">Number of Images: </span>
                             <input type="number" value="10" placeholder="width value" name="number_of_images" id="number_of_images_id">
                         </div>
                     </div>
                     <!--  -->
                     <div class="input_parent_group">
                         <div class="div_style_1"></div>
                         <label class="lable_style_1" for="text_color_r">Font</label>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">Font Color: </span>
                             <input type="color" value="#000000" placeholder="red value" name="text_backgroundColor_colorPicker" id="text_backgroundColor_colorPicker_id">
                         </div>
                         <!--  -->
                         <div class="input_inner_parent_group">
                             <span class="value_descr_1">Font Size: </span>
                             <input type="number" value="60" placeholder="font size" name="text_font_size" id="text_font_size_id">
                         </div>
                     </div>
                     <!--  -->
                 </div>
             </div>
             <div class="submit_button_group_1">
                 <button class="button_style_1" onclick="GenerateImages(2)">
                     <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-zip-fill" viewBox="0 0 16 16">
                         <path d="M5.5 9.438V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z" />
                         <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-4-.5V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3h1zm0 4.5h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V8.5a1 1 0 0 1 1-1z" />
                     </svg>
                     <br>
                     <br>
                     CREATE ZIP FILE
                 </button>
                 <button class="button_style_1" onclick="GenerateImages(3)"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                         <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                         <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                     </svg>
                     <br>
                     <br>
                     STORE IMAGES
                 </button>
             </div>
             <p class="p_style_1" id="p_id_1">
             </p>
         </div>
         <div class="img_parent_group" id="img_parent_group_id">
         </div>
         <div>
         </div>
     </main>

     <script src="./scripts/main.js"></script>

 </body>

 </html>