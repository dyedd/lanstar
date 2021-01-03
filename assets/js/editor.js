$(function() {
    if($('#wmd-button-row').length>0){
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-yincang"></use>' +
            '</svg>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-bili-button" style="" title="插入B站视频"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-bilibili"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-video-button" style="" title="插入其它视频"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-shipin"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转"><svg class="icon" aria-hidden="true">' +
            '    <use xlink:href="#icon-tiaozhuan"></use>' +
            '</svg></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO"></span></li>');
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
        $(document).on('click','#wmd-video-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[video src=""]\n');
        });
        $(document).on('click','#wmd-cid-button',function() {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[cid=""]\n');
        });
    }
});
