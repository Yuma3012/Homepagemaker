// 送信ボタンを押したときにファイル選択、送信ボタンを非表示にし、やり直しボタンを表示する
const Uploadform = document.getElementById('upload-form')
Uploadform.addEventListener('submit', function () {
    document.querySelector('.form-container').style.display = 'none';
    document.querySelector('.result').style.display = 'block';
});

// やり直しボタンをクリックしたときにファイル選択と送信ボタンを表示する
document.getElementById('reset-button').addEventListener('click', function () {
    document.querySelector('.result').style.display = 'none';
    document.querySelector('.form-container').style.display = 'block';
});
