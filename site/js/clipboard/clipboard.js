function copyToClipboard(s) {
    // ie
    if (window.clipboardData && clipboardData.setData) {
        clipboardData.setData('text', s);
    }
    // others
    else {
        var flashcopier = 'flashcopier';
        if(!document.getElementById(flashcopier)) {
            var divholder = document.createElement('div');
            divholder.id = flashcopier;
            document.body.appendChild(divholder);
        }
        document.getElementById(flashcopier).innerHTML = '';
        var divinfo = '<embed src="'+site_url+'js/clipboard/_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(s)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
        document.getElementById(flashcopier).innerHTML = divinfo;
        alert(divinfo);
    }
}