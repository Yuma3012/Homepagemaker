document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file-input');
    const convertButton = document.getElementById('convert-button');
    const outputImage = document.getElementById('output-image');
    const outputCanvas = document.getElementById('output-canvas');
    const uploadContainer = document.querySelector('.upload-container'); // div 要素を取得

    convertButton.addEventListener('click', function() {
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                outputImage.src = e.target.result;
                outputImage.style.display = 'block';

                // 画像を白黒に変換
                convertToGrayscale(outputImage, outputCanvas);
                // div 要素を非表示にする
                uploadContainer.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    function convertToGrayscale(image, canvas) {
        const ctx = canvas.getContext('2d');
        canvas.width = image.width;
        canvas.height = image.height;
        ctx.drawImage(image, 0, 0, image.width, image.height);
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        for (let i = 0; i < data.length; i += 4) {
            const grayscale = (data[i] + data[i + 1] + data[i + 2]) / 3;
            data[i] = grayscale;
            data[i + 1] = grayscale;
            data[i + 2] = grayscale;
        }

        ctx.putImageData(imageData, 0, 0);
        image.src = canvas.toDataURL('image/png');
    }
});
