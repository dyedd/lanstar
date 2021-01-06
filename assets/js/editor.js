function insertAtCursor(myField, myValue) {
    var textTop = myField.scrollTop;
    var documentTop = document.documentElement.scrollTop;

    //IE 浏览器
    if (document.selection) {
        myField.focus();
        var sel = document.selection.createRange();
        sel.text = myValue;
        sel.select();
    }

    //FireFox、Chrome等
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
        myField.focus();
        myField.selectionStart = startPos + myValue.length;
        myField.selectionEnd = startPos + myValue.length;
    } else {
        myField.value += myValue;
        myField.focus();
    }

    myField.scrollTop = textTop;
    document.documentElement.scrollTop = documentTop;
}
$(function() {
    if($('#wmd-button-row').length>0){
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-yincang"></use>' +
            '</svg>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-bili-button" style="" title="插入B站视频"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-bilibili"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-video-button" style="" title="插入其它视频"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-shipin"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-tiaozhuan"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-tip-button" style="" title="Tip提示"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-info"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-collapse-button" style="" title="展开隐藏"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-zhankai1"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-tabs-button" style="" title="tabs标签"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-tabs"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-photo-button" style="" title="相册集"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-xiangce"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO"></span></li>');
        new OwO({
            logo: '<svg class="icon" aria-hidden="true">' +
                '<use xlink:href="#icon-biaoqing"></use>' +
                '</svg>',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: owoPath,
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
        $(document).on('click','#wmd-hide-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[hide]\n\n[/hide]\n');
        });
        $(document).on('click','#wmd-bili-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[bilibili bv="" p="1"]\n');
        });
        $(document).on('click', '#wmd-video-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[video src=""]\n');
        });
        $(document).on('click', '#wmd-cid-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[cid=""]\n');
        });
        $(document).on('click', '#wmd-tip-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[tip type="info"]\n\n[/tip]\n');
        });
        $(document).on('click', '#wmd-collapse-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[collapse]\n[collapse-item label="标题"]\n\n[/collapse-item]\n[/collapse]\n');
        });
        $(document).on('click', '#wmd-tabs-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[tabs]\n[tab-pane label="标题"]\n\n[/tab-pane]\n[/tabs]\n');
        });
        $(document).on('click', '#wmd-photo-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[photo]\n\n[/photo]\n');
        });
    }
});
