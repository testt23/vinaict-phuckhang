
function trim(str){
    var start = 0;
    var end = str.length;
    while (start < str.length && str.charAt(start) == ' ') start++;
    while (end > 0 && str.charAt(end-1) == ' ') end--;
    return str.substr(start, end-start);
}
function KiemTra_So(id){
    var i;
    var text = document.getElementById(id).value;
    text = trim(text);
    for(i = 0; i < text.length; i++){
        if (text.charCodeAt(i) < 48 || text.charCodeAt(i) > 57){
            return false;       
        }
    }
    return true;
    
}

function KiemTra_Null(id){
    var text = document.getElementById(id).value;
    text = trim(text);
    if (text == ""){
        return false;
    }else{
        return true;
    }
}
function KiemTra_Email(value) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(value)) {
        return false;
    }
    return true;
}
function KiemTra_UrlWebsite(strUrl)
{
        
    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/; 
    if(RegExp.test(strUrl)){ 
        return true; 
    }else{ 
        return false; 
    } 
}





