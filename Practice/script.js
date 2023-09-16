// script.js

document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("imageInput");
    const displayImage = document.getElementById("displayImage");

    imageInput.addEventListener("change", function () {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;

                // 画像をリサイズ
                const maxWidth = 200; // 新しい幅
                const maxHeight = 200; // 新しい高さ
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                let newWidth, newHeight;

                if (img.width > img.height) {
                    newWidth = maxWidth;
                    newHeight = (img.height / img.width) * maxWidth;
                } else {
                    newWidth = (img.width / img.height) * maxHeight;
                    newHeight = maxHeight;
                }

                canvas.width = newWidth;
                canvas.height = newHeight;

                ctx.drawImage(img, 0, 0, newWidth, newHeight);

                // 画像を表示
                displayImage.src = canvas.toDataURL("image/jpeg");
                displayImage.style.display = "block";
            };

            reader.readAsDataURL(file);
        }
    });
});
