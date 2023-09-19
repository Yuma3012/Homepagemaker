// 送信ボタンを押したときにファイル選択、送信ボタンを非表示にし、やり直しボタンを表示する
const Uploadform = document.getElementById('load-button')
Uploadform.addEventListener('submit', function () {
    document.querySelector('.form-container').style.display = 'none';
    document.querySelector('.result').style.display = 'block';
});

// やり直しボタンをクリックしたときにファイル選択と送信ボタンを表示する
document.getElementById('reset-button').addEventListener('click', function () {
    document.querySelector('.result').style.display = 'none';
    document.querySelector('.form-container').style.display = 'block';
});


function insertTemplate() {
    // テキスト「こんにちは」を取得
    var templateText = "・ドラマ\n「リオレウス桜」New!\nテレビ東京 10月13日（金）深夜24時52分スタート!\n日曜劇場「VALORANT」\n2023年7月16日(日)スタート\n2023年 大河ドラマ「どうもしません家康」\n2023年1月8日(日)スタート";
    
    // 自由記入欄の要素を取得
    var freeTextElement = document.getElementById("free-text");
    
    // 自由記入欄にテンプレートテキストを挿入
    freeTextElement.value = templateText;
}

const backStr = document.querySelector(".backStr");
    for (let i = 0; i < 100; i++) {
      backStr.innerHTML += romeText ;
    }
