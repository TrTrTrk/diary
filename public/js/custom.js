function showLoading() {
    // Spinnerを表示するためのHTMLを生成
    var spinnerHtml = '<div class="spinner-border text-primary" role="status"><span class="sr-only"></span></div>';

    // 背景にオーバーレイを追加
    var overlay = $('<div class="overlay"></div>');
    $('body').append(overlay);

    // Spinnerを画面に追加
    var spinner = $('<div class="spinner"></div>').html(spinnerHtml);
    $('body').append(spinner);
}