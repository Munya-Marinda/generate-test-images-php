/**
 * Generate Test Images JavaScript Script
 *
 * This script controls the UI and makes calls the '/api' page to get generated images.
 *
 * Author: Munya M. Dev
 * Version: 1.0.0
 * Date: 30/06/2023
 *
 * */

function GenerateImages(action) {
  const messageElement = document.getElementById("p_id_1");
  const val_image_backgroundColor_colorPicker_id = document.getElementById(
    "image_backgroundColor_colorPicker_id"
  ).value;
  const arr_rgb_val_image_backgroundColor_colorPicker_id = hexToRgb(
    val_image_backgroundColor_colorPicker_id
  );
  const val_text_backgroundColor_colorPicker_id = document.getElementById(
    "text_backgroundColor_colorPicker_id"
  ).value;
  const arr_rgb_val_text_backgroundColor_colorPicker_id = hexToRgb(
    val_text_backgroundColor_colorPicker_id
  );
  const val_number_of_images_id = document.getElementById(
    "number_of_images_id"
  ).value;
  const val_image_size_w_id = document.getElementById("image_size_w_id").value;
  const val_image_size_h_id = document.getElementById("image_size_h_id").value;
  const val_text_font_size_id =
    document.getElementById("text_font_size_id").value;

  const imageParametersForm = new FormData();
  imageParametersForm.append("generate_test_images_1", 1);
  imageParametersForm.append("number_of_images", val_number_of_images_id);
  imageParametersForm.append("image_size_w", val_image_size_w_id);
  imageParametersForm.append("image_size_h", val_image_size_h_id);
  imageParametersForm.append(
    "image_backgroundColor_r",
    arr_rgb_val_image_backgroundColor_colorPicker_id[0] === 0
      ? 1
      : arr_rgb_val_image_backgroundColor_colorPicker_id[0]
  );
  imageParametersForm.append(
    "image_backgroundColor_g",
    arr_rgb_val_image_backgroundColor_colorPicker_id[1] === 0
      ? 1
      : arr_rgb_val_image_backgroundColor_colorPicker_id[1]
  );
  imageParametersForm.append(
    "image_backgroundColor_b",
    arr_rgb_val_image_backgroundColor_colorPicker_id[2] === 0
      ? 1
      : arr_rgb_val_image_backgroundColor_colorPicker_id[2]
  );
  imageParametersForm.append("text_font_size", val_text_font_size_id);
  imageParametersForm.append(
    "text_color_r",
    arr_rgb_val_text_backgroundColor_colorPicker_id[0] === 0
      ? 1
      : arr_rgb_val_text_backgroundColor_colorPicker_id[0]
  );
  imageParametersForm.append(
    "text_color_g",
    arr_rgb_val_text_backgroundColor_colorPicker_id[1] === 0
      ? 1
      : arr_rgb_val_text_backgroundColor_colorPicker_id[1]
  );
  imageParametersForm.append(
    "text_color_b",
    arr_rgb_val_text_backgroundColor_colorPicker_id[2] === 0
      ? 1
      : arr_rgb_val_text_backgroundColor_colorPicker_id[2]
  );

  messageElement.innerHTML = "";

  var requestOptions = {
    method: "POST",
    body: imageParametersForm,
    redirect: "follow",
  };

  if (action === 1) {
    fetch("/api?", requestOptions)
      .then((response) => response.json())
      .then((result) => {
        if (result.result !== false) {
          const arrayImageData = result.images_generated_data;
          const imageDivParent = document.getElementById("img_parent_group_id");
          imageDivParent.innerHTML = "";

          arrayImageData.forEach((imageDataBase64) => {
            const imgElement = document.createElement("img");
            imgElement.src = "data:image/png;base64, " + imageDataBase64;
            imgElement.style.width = "100px";
            imgElement.style.margin = "10px";
            imgElement.style.boxShadow = "0px 0px 10px rgba(0, 0, 0, 0.3)";
            imageDivParent.appendChild(imgElement);
          });
          messageElement.innerHTML = result.message;
        }
      })
      .catch((error) => console.log("error", error));
  } else if (action === 2 || action === 3) {
    var url =
      action === 2
        ? "/api?download_zip_file=1"
        : "/api?store_images_on_server=1";

    fetch(url, requestOptions)
      .then((response) => response.json())
      .then((result) => {
        console.log(result);
        messageElement.innerHTML = result.message;
      })
      .catch((error) => console.log("error", error));
  }
}

function hexToRgb(hex) {
  hex = hex.replace("#", "");
  const r = parseInt(hex.substring(0, 2), 16);
  const g = parseInt(hex.substring(2, 4), 16);
  const b = parseInt(hex.substring(4, 6), 16);
  return [r, g, b];
}

window.addEventListener("load", function () {
  GenerateImages(1);

  const inputs = document.querySelectorAll("input");
  inputs.forEach((input) => {
    if (input.type === "number") {
      input.onkeyup = _GenerateImages_from_input_slow;
    }
    if (input.type === "color") {
      input.ondrag = _GenerateImages_from_input_slow;
    }
    input.onchange = _GenerateImages_from_input;
  });
});

function _GenerateImages_from_input_slow() {
  setTimeout(() => {
    GenerateImages(1);
  }, 500);
}

function _GenerateImages_from_input(event) {
  GenerateImages(1);
}
