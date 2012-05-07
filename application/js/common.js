function openwindow(url)
{
	var options = "scrollbars=yes,resizable=yes,status=yes,toolbar=yes,menubar=yes,location=yes";
	options += ',width=' + screen.availWidth + ',height=' + screen.availHeight;
	options += ',screenX=0,screenY=0,top=0,left=0';

	win = window.open(url, '', options);
	win.focus();
	win.moveTo(0, 0);
}

function supprimer_confirm() {
}

function isValidDate(dateStr, format)
{
   if (format == null){format = "MDY";}
   format = format.toUpperCase();
   if (format.length != 3) {format = "MDY";}
   if ( (format.indexOf("M") == -1) || (format.indexOf("D") == -1) ||
      (format.indexOf("Y") == -1) ) {format = "MDY";}
   if (format.substring(0, 1) == "Y") { // If the year is first
      var reg1 = /^\d{2}(\-|\/)\d{1,2}\1\d{1,2}$/
      var reg2 = /^\d{4}(\-|\/)\d{1,2}\1\d{1,2}$/
   } else if (format.substring(1, 2) == "Y") { // If the year is second
      var reg1 = /^\d{1,2}(\-|\/)\d{2}\1\d{1,2}$/
      var reg2 = /^\d{1,2}(\-|\/)\d{4}\1\d{1,2}$/
   } else { // The year must be third
      // Tan :: Start : if 'd-m-Y' is invalid format (only remove -)
   	  var reg1 = /^\d{1,2}(\/)\d{1,2}\1\d{2}$/
      var reg2 = /^\d{1,2}(\/)\d{1,2}\1\d{4}$/
      // Tan :: End
   }

   // If it doesn't conform to the right format (with either a 2 digit year or 4 digit year), fail
   if ( (reg1.test(dateStr) == false) && (reg2.test(dateStr) == false) ) {return false;}
   var parts = dateStr.split(RegExp.$1); // Split into 3 parts based on what the divider was
   // Check to see if the 3 parts end up making a valid date
   if (format.substring(0, 1) == "M") {var mm = parts[0];} else
      if (format.substring(1, 2) == "M") {var mm = parts[1];} else {var mm = parts[2];}
   if (format.substring(0, 1) == "D") {var dd = parts[0];} else
      if (format.substring(1, 2) == "D") {var dd = parts[1];} else {var dd = parts[2];}
   if (format.substring(0, 1) == "Y") {var yy = parts[0];} else
      if (format.substring(1, 2) == "Y") {var yy = parts[1];} else {var yy = parts[2];}
   if (parseFloat(yy) <= 50) {yy = (parseFloat(yy) + 2000).toString();}
   if (parseFloat(yy) <= 99) {yy = (parseFloat(yy) + 1900).toString();}
   var dt = new Date(parseFloat(yy), parseFloat(mm)-1, parseFloat(dd), 0, 0, 0, 0);
   if (parseFloat(dd) != dt.getDate()) {return false;}
   if (parseFloat(mm)-1 != dt.getMonth()) {return false;}

   return true;
}

//<!-- salimane start edit -->

	// Removes leading whitespaces
	function LTrim( value ){
		var re = /\s*((\S+\s*)*)/;
		return value.replace(re, "$1");
	}
	// Removes ending whitespaces
	function RTrim( value ){
		var re = /((\s*\S+)*)\s*/;
		return value.replace(re, "$1");
	}
	// Removes leading and ending whitespaces
	function trim( value ){
		return LTrim(RTrim(value));
	}
	function textValid(e){
		if (trim(e.value) == "" || e.value.length == 0)
			return false;
		else
			return true;
	}

//<!-- salimane end edit -->

//convert a string into a Date object
/**
 * convert a string into a Date object
 *
 * @param unknown $date
 * @return Date if $date was pass correctly format; false otherwise
 */
function strtodate(date)
{
	try{
		var dateArr = date.split("/");
		if (dateArr.length == 3)
		{
			var ret = new Date();
			ret.setFullYear(dateArr[2], dateArr[1]-1, dateArr[0]);
		}
		else {
			return ret = false;
		}
	}
	catch(err)
	{
		ret = false;
	}
	return ret;
}

function confirmDeletion()
{
	return confirm('Etes vous certain de vouloir supprimer cet objet ?');
}

function redirect(url)
{
	window.location.href = url;
}

function isEmpty(val)
{
	if( /^$/.test(val))
		return true;
	else
		return false
}

//<!--salimane start edit-->
function isEmptyTextBox(control, error_message)
{
	if (trim(control.value) == "" || control.value.length == 0)
	{
		if (error_message != null)
			showErrorBubble(control, error_message);
		return true;
	}

	return false;
}

// Only use for muti-select
function isNoValueSelected(control, error_message) {
	for (var i = 0; i < control.options.length; i++) {
		if (control.options[ i ].selected) {
			return false;
		}
	}

	if (error_message != null)
			showErrorBubble(control, error_message);

	return true;
}

/**
 * Check if the textbox value max length is valided
 *
 * @param object $control
 * @param int $strlength
 * @param string $error_message
 * @return true if $control.value length is not excceed $strlength; false otherwise
 */
function isValidLengthTextBox(control, strlength, error_message)
{
	if (control.value == null || control.value.length > strlength)
	{
		showErrorBubble(control, error_message);
		//control.focus();
		return false;
	}
	return true;
}

/**
 * Check if the textbox value min length is valided
 *
 * @param object $control
 * @param int $strlength
 * @param string $error_message
 * @return true if $control.value length is more $strlength long; false otherwise
 */
function isValidMinLengthTextBox(control, strlength, error_message)
{
	if (control.value == null || control.value.length < strlength)
	{
		showErrorBubble(control, error_message);
		return false;
	}
	return true;
}

function isInvalidDateTextBox(control, error_message)
{
	if( control.value.length > 0 && !isValidDate(trim(control.value), "DMY"))
	{
		showErrorBubble(control, error_message);
		//control.focus();
		return true;
	}

	return false;
}

//<!--salimane end edit-->


function isInvalidIntTextBox(control, error_message)
{
	if(isNaN(control.value))
	{
		showErrorBubble(control, error_message);
		return true;
	}
	return false;
}

function isInvalidFloatTextBox(control, error_message)
{
	if(isNaN(control.value))
	{
		showErrorBubble(control, error_message);
		return true;
	}

	return false;
}

function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);

	cents = num%100;
	num = Math.floor(num/100).toString();

	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num + '.' + cents + ' &#x80');
}

function emailCheck(emailStr) {
	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom=validChars + '+'
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
	var matchArray=emailStr.match(emailPat)
	if (matchArray==null) {
		return false
	}
	var user=matchArray[1]
	var domain=matchArray[2]

	// See if "user" is valid
	if (user.match(userPat)==null) {
	    return false
	}
	var IPArray=domain.match(ipDomainPat)
	if (IPArray!=null) {
	    // this is an IP address
		  for (var i=1;i<=4;i++) {
		    if (IPArray[i]>255) {
			return false
		    }
	    }
	    return true
	}
	var domainArray=domain.match(domainPat)
	if (domainArray==null) {
	    return false
	}

	var atomPat=new RegExp(atom,"g")
	var domArr=domain.match(atomPat)
	var len=domArr.length

	if (domArr[domArr.length-1].length<2 ||
	    domArr[domArr.length-1].length>3) {
	   return false
	}

	// Make sure there's a host name preceding the domain.
	if (len<2) {
	   var errStr="This address is missing a hostname!"
	   return false
	}

	// If we've gotten this far, everything's valid!
	return true;
}

/*
function isValidEmail(str)
{
	apos=str.indexOf("@");
	dotpos=str.lastIndexOf(".");

	if (apos<1||dotpos-apos<2)
  		return false;
	else
		return true;
}
*/

/**
 * Check if the textbox email value is valided. That is the email that has:
 * Domain name rule: - Use only letters, numbers, or hyphen ('-')
 * 					 - Can not begin or end with a hyphen
 * 					 - Must have less than 63 characters, not include extension
 *
 * @param object $control
 * @param string $error_message
 * @return true if $control.value is a valid email; false otherwise
 */
function isValidEmail(control, error_message)
{
	var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	//var reg = /^(.+)[@]((\.)([^-~!@#$%^&*()_+={\[\]}:;"'<,>.?\/\|\\][-a-z0-9]{0,62}[^-~!@#$%^&*()_+={\[\]}:;"'<,>.?\/\|\\]))+?\.([a-z]{2}|com|net|edu|org|gov|mil|int|biz|pro|info|arpa|aero|coop|name|museum)$/;
	var subj = trim(control.value);
	subj = subj.replace(/(\"|\')/gi, "");
	if(!subj.match(reg))
	{
		showErrorBubble(control, error_message);
		//control.focus();
		return false;
	}
	return true;
}


/*
* check whether or not current value is a positive whole integer
*/
function isPositiveWholeInteger(myValue){
	var ValidChars = "0123456789";
	var Char;

	if(isNaN(parseInt(myValue)) || parseInt(myValue) < 0){
		return false;
	}else{
		for (i = 0; i < myValue.length; i++)
		{
			Char = myValue.charAt(i);
			if (ValidChars.indexOf(Char) == -1)
			{
				return false;
			}
		}
	}

	return true;
}


/*
* convert Date object to a string with format of Mysql Date
*/
function convertDateObjectToMysqlDateString(myObjDate){
	var temp_full_date = myObjDate.getFullYear();

	var temp_month = myObjDate.getMonth() + 1;

	var temp_date = myObjDate.getDate();

	if (temp_month < 10)
	{
		temp_month = "0" + temp_month;
	}

	if (temp_date < 10)
	{
		temp_date = "0" + temp_date;
	}

	temp_full_date = temp_full_date + "-" + temp_month + "-" + temp_date;

	return temp_full_date;
}


function isNumeric(sText)
{
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;

	for (i = 0; i < sText.length && IsNumber == true; i++)
	{
		Char = sText.charAt(i);
		if (ValidChars.indexOf(Char) == -1)
		{
			IsNumber = false;
		}
	}

	return IsNumber;
}

/**
 *	Define array method if Not Compatibility Array filter, every method.
 */
 if (!Array.prototype.filter)
	{
	  Array.prototype.filter = function(fun /*, thisp*/)
	  {
		var len = this.length;
		if (typeof fun != "function")
		  throw new TypeError();

		var res = new Array();
		var thisp = arguments[1];
		for (var i = 0; i < len; i++)
		{
		  if (i in this)
		  {
			var val = this[i]; // in case fun mutates this
			if (fun.call(thisp, val, i, this))
			  res.push(val);
		  }
		}

		return res;
	  };
	}

 if (!Array.prototype.every)
	{
	  Array.prototype.every = function(fun /*, thisp*/)
	  {
		var len = this.length;
		if (typeof fun != "function")
		  throw new TypeError();

		var thisp = arguments[1];
		for (var i = 0; i < len; i++)
		{
		  if (i in this &&
			  !fun.call(thisp, this[i], i, this))
			return false;
		}

		return true;
	  };
	}


/**
* Convert text to UTF-8
*/
function text_convert_to_utf8(strValue){
	var moji = strValue;
	var moji_x = "";

	moji_length = moji.length;

	for(var i=0;i<moji_length;i++){
		moji_x = moji_x + "&" + "#" + moji.charCodeAt(i) + ";";
	}

	return moji_x;
}

function dateCompare(d1, d2)
{
	if (d2.getFullYear() > d1.getFullYear()){
		return 1;
	} else if (d2.getFullYear() < d1.getFullYear()){
		return -1;
	}
	
	if (d2.getMonth() > d1.getMonth()){
		return 1;
	} else if (d2.getMonth() < d1.getMonth()){
		return -1;
	}
	
	if (d2.getDate() > d1.getDate()){
		return 1;
	} else if (d2.getDate() < d1.getDate()){
		return -1;
	}
	
	return 0;
}

/** HUY
 * Return the number of days between to date
 * @tparam  Date  start  The first date
 * @tparam  Date  end  The end date
 *
 * @treturn  Integer Number of days
 */ 

function Diff(start,end)
{
	var one_day=1000*60*60*24;
	return Math.round((end.getTime()-start.getTime()) / one_day );
}


/** HUY
 * Return the week number of date 
 */ 
function GetWeek(Year,Month,Day) { 	
	    
	GW_Now=new Date(Year,Month,Day);    // target date   		
  	
  	GW_Now_Y=GW_Now.getYear();                // current year 
  	if (GW_Now_Y < 70)   {GW_Now_Y=GW_Now_Y*1+2000;} 
  	if (GW_Now_Y < 1900) {GW_Now_Y=GW_Now_Y*1+1900;} 
  	GW_Then=new Date(GW_Now_Y, 0, 1);         // Jan 1 of current year 
  	GW_Then_Day=GW_Then.getDay();             // Jan 1 day of the week 
  	GW_Diff=GW_Now*1-GW_Then*1;               // difference in miliseconds 
  	GW_Days=GW_Diff/(1000*60*60*24);          // ...in days 
  	GW_Days=Math.floor(GW_Days+(1/24));       // Daylight Savings Time correction 
  	GW_Week='*** Error'; 
  	
    GW_Work=(GW_Then_Day+2)%7; 
    GW_Week=Math.floor((GW_Days+GW_Work+4)/7); 
    	
	return GW_Week; 
}

/**
 * Beginning of  bubble tooltip JS
 */ 
var MSIE6 = false;

// object which controls timer interval
var obj_running;

function checkMSIE()
{
	if(navigator.userAgent.indexOf('MSIE 6') >= 0 && navigator.userAgent.indexOf('Opera') < 0)
	{
		MSIE6 = true;
	}
}

function showToolTip(object, text, container, content, timer, MSIE6)
{
	var coordidate = getAbsolutePosition(object);
	var obj = document.getElementById(container);
	var obj2 = document.getElementById(content);
	obj2.innerHTML = text;
	obj.style.zIndex = 1000;
	obj.style.display = 'block';
	obj.style.left = coordidate.getX()- obj.offsetWidth + 80 + 'px';
	obj.style.top = coordidate.getY()- obj.offsetHeight + 10 +'px';
	myIfrm(obj);
	object.focus();
	
	// stop current Timer Interval by clear obj_running
	clearInterval(obj_running);
	
	// set new Timer Interval
	obj_running = setInterval('hideToolTip(\'' + container + '\')', 1000*timer);
}

function myIfrm(obj)
{
	if(MSIE6 && obj)
	{
		var ifrm = document.getElementById("myIfrm");
		if(!ifrm)
		{
			obj = null;
		}
	}

	if(MSIE6)
	{
		if(ifrm)
		{
			ifrm.style.zIndex = obj.style.zIndex - 1;
			ifrm.style.left = obj.offsetLeft;
			ifrm.style.top = obj.offsetTop;
			ifrm.style.width = obj.offsetWidth;
			ifrm.style.height = obj.offsetHeight;
			ifrm.style.display = "block";
		}
	}
}

function hideToolTip(container)
{
	document.getElementById(container).style.display = 'none';
	if(document.getElementById("myIfrm"))
	{
		document.getElementById("myIfrm").style.display = 'none';
	}

}
function getAbsolutePosition(element){
    var ret = new Point();
    for(;
        element && element != document.body;
        ret.translate(element.offsetLeft, element.offsetTop), element = element.offsetParent
        );

    return ret;
}

function Point(x,y){
        this.x = x || 0;
        this.y = y || 0;
        this.toString = function(){
            return '('+this.x+', '+this.y+')';
        };
        this.translate = function(dx, dy){
            this.x += dx || 0;
            this.y += dy || 0;
        };
        this.getX = function(){return this.x;}
        this.getY = function(){return this.y;}
        this.equals = function(anotherpoint){
            return anotherpoint.x == this.x && anotherpoint.y == this.y;
        };
}


checkMSIE();
/**
 * End of  bubble tooltip JS
 */
 
 //show tooltip when input data is not valid
 function showErrorBubble(control, error_msg, seconds)
 {
    var delay = seconds || 5000;
    
    $(control).qtip({
        content: error_msg,
        show: {delay: 500, when: false},
        hide: {when: {event: 'unfocus'}, delay: delay},
        style: {name: 'red',
                    tip: true,
                    border: {
                     radius: 5
                    }
              },
        position: {
           corner: {
              target: 'rightMiddle',
              tooltip: 'leftMiddle'
           }
        }
    });
    
    $(control).qtip("hide");
    $(control).qtip("show");
        
    control.focus();
    return false;
 }
 
 function getDatePicker(control, minDate, maxDate)
 {	 
	var control_name = '#' + control;
	$(function() {
            
            if (minDate) {
                minDate = minDate.split('-');
                minDate = new Date(minDate[0], parseInt(minDate[1])-1, parseInt(minDate[2]));
            }
            else
                minDate = null;
            
            if (maxDate) {
                maxDate = maxDate.split('-');
                maxDate = new Date(maxDate[0], parseInt(maxDate[1])-1, parseInt(maxDate[2]));
            }
            else
                maxDate = null;

            $(control_name).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showWeek:true,
                    minDate: minDate,
                    maxDate: maxDate
            }),

            $('*[title]').qtip({
              content: {
                 text: false // Use each elements title attribute
              },
              style: 'dark' // Give it some style
            });
            

	});
 }
 
 function disableDatePicker(control)
 {
	var control_name = '#' + control;
	$(function() {
		$(control_name).datepicker('disable');
	});
 }

function callFunction(func, agrs, rettype, errmsg)
{
    var ret = '';

    rettype = rettype || 'text';
    errmsg = errmsg || '';

    var params = "FUNC="+func+"&VAL_NUM="+agrs.length;
    for(var i=0; i<agrs.length; i++){
        params = params + "&VAL"+i+"="+encodeURIComponent(agrs[i]);
    }

    jQuery.ajax({
        type: "GET",
        url: applicationUrl+'/validator/ajax_callfunction',
        data: params,
        dataType: rettype,
        cache: false,
        async: false,
        success: function(result) {
            ret = result;
        },
        error: function(transport) {
            if (errmsg != '')
                alert(errmsg);
        }
    });

    if (ret == 'ajax_timeout') {
        redirect(applicationUrl+'/login/login/');
        setTimeout(1000);
        return;
    }
    else {
        return ret;
    }
}

/**
 * Check format of control value which is applied multilanguage format.
 *  the function will check the format of string between depend on 
 *  each element of language array(eg. Array('en', 'fr')) 
 *
 * @param str_value string
 * @return boolean 
 */
function isI18nFormat(str_value, language)
{
    language = language || 'en';
    if (language && language != '[a-z]{2}(_[A-Z]{2})*?' && language != 'en') {
        var test_langue = new RegExp('^[a-z]{2}(_[A-Z]{2})*?$').exec(language);
        if(test_langue == null) {
            return false;
        } 
    }
    
    str_value = str_value.replace(/(\r\n|\n|\r)/gm,"");
    var pattern = '<('+language+')>(.*?)</('+language+')>';
    
	var re = new RegExp(pattern);
	var data = re.exec(str_value);

	if(data != null) {
        if ((data.length == 4 && (!data[2] || data[1] != data[3]))
            || (data.length == 6 && (!data[3] || data[1] != data[4]))) {
			return false; 
		}
        str_value = RTrim(LTrim(str_value.replace(data[0],'')));
		if (str_value) {
			return isI18nFormat(str_value, '[a-z]{2}(_[A-Z]{2})*?');
		}
	} 
    else {
		if (str_value) {
			return false;
		}
	}
	
	return true;
}

/**
* Check valid URL
**/
function isValidURL(url){
	if (url == ""|| url == null)
		return false;

	url = trim(url);

	if (url.indexOf(" ")!=-1)
		return false;

	var RegExp = /^http(s)?:\/\/[\w|\-]+(\.[^\.]+)+$/i;

	if(RegExp.test(url)){
		return true;
	}else{
		return false;
	}
}
/**
 * Add slashes
 */
function addslashes(str) {
    return(str+'').replace(/([\\"'])/g,"\\$1").replace(/\0/g,"\\0");
}

/**
 * 
 */
$.fn.editplace = function(args){
    
    var defs = {
        url: null,
        data: {},
        type: 'text',
        width: 100,
        name: 'name',
        value: null,
        format: null,
        message: 'error',
        error: function(value, options){},
        success: function(value, options){},
        validFns: {
            isFLOAT: {fn: function(value){return /^[0-9]+(?:\.[0-9]+)?$/.test(value);}},
            isFLOAT2DEC: {fn: function(value){return /^[0-9]+(?:\.[0-9]{1,2})?$/.test(value);}},
            isFLOAT3DEC: {fn: function(value){return /^[0-9]+(?:\.[0-9]{1,2,3})?$/.test(value);}},
            isNUMBER: {fn: function(value){return isNumeric(value);}},
            isRATENUMBER: {fn: function(value){return (isNumeric(value) && /^[0-9]+(?:\.[0-9]{1,2})?$/.test(value));}},
            isDATE: {fn: function(value){return isValidDate(value, 'DMY');}}
        }
    };
    return this.each(function(){
        var opts = $.extend({}, defs, args);
            opts.data = $.extend({}, defs.data, args.data);
            
        // init variables
        var item = $(this), 
            handle = null, wrap = null, cancel = null, valid = null, input = null, date = null, 
            showFn = function(){
                wrap.show();
                item.hide();handle.hide();
            }, 
            hideFn = function(){
                wrap.hide();
                item.show();handle.show();
            },
            checkboxFn = function(){
                if((opts.value == 1 && !item.attr('checked')) || opts.value == 0 && item.attr('checked')) {
                    wrap.show();
                } else {
                    wrap.hide();
                }
            },
            errorFn = function(input, message){
                showErrorBubble(input, message);
            };
        
        // metadata
        if(item.attr('data')) {
            var meta = eval('(' + item.attr('data') + ')'),
                newopts = $.extend({}, opts, meta);
            if(meta.data) {
                newopts.data = $.extend({}, opts.data, meta.data);
            }
            opts = newopts;
            item.removeAttr('data');
        }
        
        // switch type input 
        switch(opts.type){
            case 'checkbox':
                if(opts.format == 'boolean' && opts.value == 1) {
                    item.attr('checked', true);
                }
                // structure html
                item.wrap('<div />').after(
                    wrap = $('<span />').append(
                        '&nbsp;&nbsp;',
                        valid = $('<a href="javascript:void(0);" />').html('<img src="'+applicationUrl+'/images/done_small.png" style="vertical-align:-2px" />')
                    ).attr({
                        style: 'display:none;'
                    })
                );
                break;
            default: // text
                input = $('<input />').attr({
                    id: 'edit_bid_input_'+opts.data.id,
                    name: opts.name,
                    type: 'text',
                    value: opts.value,
                    style: 'width:'+opts.width+'px'
                });
                
                // structure html
                item.wrap('<div />').after(
                    '&nbsp;&nbsp;&nbsp;',
                    opts.type != 'checkbox' ?
                        handle = $('<a href="javascript:void(0);" />')
                        .attr({
                            id: "edit_bid_"+opts.data.id
                        })
                        .html('<img src="'+applicationUrl+'/images/edit.png" style="vertical-align:-2px" />') : '',
                    wrap = $('<span />').append(
                        input, '&nbsp;&nbsp;',
                        valid = $('<a href="javascript:void(0);" />')
                        .attr({
                            id: "save_bid_"+opts.data.id
                        }).html('<img src="'+applicationUrl+'/images/done_small.png" style="vertical-align:-2px" />'),
                        cancel = $('<a href="javascript:void(0);" />')
                        .attr({
                            id: "cancel_bid_"+opts.data.id
                        })
                        .html('<img src="'+applicationUrl+'/images/delete_small.png" style="vertical-align:-2px" />')
                    ).attr({
                        style: 'display:none;'
                    })
                );
                break
        }
        
        // control buttons
        if(handle != null) {handle.click(showFn);}
        if(cancel != null) {cancel.click(hideFn);}
        if(opts.format == 'date') {input.datepicker({dateFormat: 'dd/mm/yy'});}
        if(opts.type == 'checkbox' && opts.format == 'boolean') {item.click(checkboxFn);}
        if(valid != null) {
            valid.click(function(){
                opts.data[opts.name] = input.val();
                if(opts.format != null) 
                {
                    var func = 'is' + opts.format.toUpperCase();
                    if(input.val().length == 0) {
                        if(typeof opts.message === 'string') {
                            errorFn(input, opts.message);return false;
                        }
                        if(typeof opts.message === 'object') {
                            errorFn(input, opts.message.EMPTY);return false;
                        }
                    } else if(typeof opts.validFns[ func ] == 'object' && !opts.validFns[ func ].fn(input.val())) {
                        if(typeof opts.message === 'string') {
                            errorFn(input, opts.message);return false;
                        }
                        if(typeof opts.message === 'object') {
                            errorFn(input, opts.message[func]);return false;
                        }
                    }
                }
                if(input.val() == opts.value) {hideFn();}
                else if(opts.url != null) {
                    var arg = [];
                    $.each(opts.data, function(i, j){
                        arg.push(j);
                    });
	                var data = callFunction(opts.url,arg,'json');
	                if(data.response) {
	                    hideFn();
                        item.text(data.value);
                        opts.value = data.value;
                        opts.success.call(input, data.value, opts);
                    } else {
                        input.val(opts.value); 
                        errorFn(input, data.message);
                        opts.error.call(input, opts.value, opts);
                    }
                }
            });
        }
    });
}

function addLang(element, lang_arr, req_lang_code) {
    var lang = document.getElementById(element+'_language');
    var code = lang.value;
    if (!code)
    {
        showErrorBubble(lang, err);
        return false;
    }
    document.getElementById(element+'_name_'+code).disabled = false;
    document.getElementById(element+'_div_'+code).style.display = '';        
    displaySelectList(element, code, lang_arr, req_lang_code);
    lang_arr.push(code);
    document.getElementById(element+'_name_'+code).focus();
}

function deleteLang(element, code, lang_arr, req_lang_code) {
    document.getElementById(element+'_name_'+code).value = '';
    document.getElementById(element+'_name_'+code).disabled = true;
    document.getElementById(element+'_div_'+code).style.display = 'none';
    var i = lang_arr.length;
    while (i--) {
        if (lang_arr[i] === code) {
          lang_arr.splice(i, 1);
          break;
        }
    }
    displaySelectList(element, 0, lang_arr, req_lang_code);
    document.getElementById(element+'_language').focus();
}

function displaySelectList(element, code, lang_arr, req_lang_code) {
    var html = '<option value="">'+first_element+'</option>';
    for (var i = 0; i< front_language_arr.length; i++){
        if (code != front_language_arr[i].code && !in_array(front_language_arr[i].code, lang_arr) && front_language_arr[i].code !== req_lang_code) {
            html += '<option value="'+front_language_arr[i].code+'">'+front_language_arr[i].name+'&nbsp;('+front_language_arr[i].code+')</option>';
        }
    }
    document.getElementById(element+'_language').innerHTML = html;
}

function in_array(needle, haystack)
{
    var i = haystack.length;
    while (i--) {
    if (haystack[i] === needle) {
      return true;
    }
  }
  return false;
}
var tagsToReplace = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;'
};
var front_language_arr = [];

function Front_Language(code, name) {
    this.code = code;
    this.name = name;
}
function replaceTag(tag) {
    return tagsToReplace[tag] || tag;
}


function validateLang(element, function_name, args) {
    for (var i = 0; i< front_language_arr.length; i++){
        var code = front_language_arr[i].code;
        var name_langue = document.getElementById(element+'_name_'+code);
        if (document.getElementById(element+'_div_'+code).style.display == "") {
            message = err_1.replace("[LANGUAGE]", '&lt;'+code+'&gt;');
            if(isEmptyTextBox(name_langue, message))
            {
                return false;
            }
            
            if (function_name) {
                var agr = new Array();
                for(var j=0; j< args.length; j++) {
                    agr.push(args[j]);
                }
                agr.push(trim(name_langue.value));
                agr.push(trim(code));
                if(callFunction(function_name,agr) )
                {
                    message = err_2.replace("[LANGUAGE]", '&lt;'+code+'&gt;');
                    showErrorBubble(name_langue, message);
                    return false;
                }
            }
        }
    }
    
    return true;
}

$(document).ready(function() {
   
   $('div.datepicker').each(function(){
       
       if ($(this).attr('mindate')) {
           minDate = 'mindate="'+$(this).attr('minDate')+'"';
           $(this).removeAttr('mindate');
       }
       else
           minDate = "";
       
       if ($(this).attr('maxdate')) {
           maxDate = 'maxdate="'+$(this).attr('maxDate')+'"';
           $(this).removeAttr('maxdate');
       }
       else
           maxDate = "";
       
            $(this).append('<input type="text" class="'+$(this).attr('class')+'" id="'+$(this).attr('id')+'" name="'+$(this).attr('name')+'" '+minDate+' '+maxDate+' value="'+$(this).attr('value')+'" style="float:left;width:100px;" />');
            $(this).append('<a class="btn_no_text btn ui-state-default ui-corner-all tooltip btn_datepicker" style="margin:0 5px;" id="btn_datepicker_'+$(this).attr('id')+'" href="#btn_datepicker_'+$(this).attr('id')+'"><span class="ui-icon ui-icon-calendar"></span></a>');
            $(this).removeAttr('id');
            $(this).removeAttr('name');
            $(this).removeAttr('value');
            $(this).removeAttr('class');
            $(this).attr('style', 'margin-bottom: 10px;');
   });
   
   $('.btn_datepicker').click(function() {
       $('#'+$(this).attr('id').replace('btn_datepicker_', '')).datepicker("show");
   });

   $('input[class=datepicker]').each(function(){
       minDate = $(this).attr('mindate') ? $(this).attr('mindate') : null;
       maxDate = $(this).attr('maxdate') ? $(this).attr('maxdate') : null;
       getDatePicker($(this).attr('id'), minDate, maxDate);
   });
   
   $('input[class=datepicker nopast]').each(function(){
       now = new Date();
       minDate = now.getFullYear() + '-' + (now.getMonth()+1) + '-' + now.getDate();
       maxDate = $(this).attr('maxdate') ? $(this).attr('maxdate') : null;
       getDatePicker($(this).attr('id'), minDate, maxDate);
   });
   
   $('input[class=datepicker nofuture]').each(function(){
       now = new Date();
       minDate = $(this).attr('mindate') ? $(this).attr('mindate') : null;
       maxDate = now.getFullYear() + '-' + (now.getMonth()+1) + '-' + now.getDate();
       getDatePicker($(this).attr('id'), minDate, maxDate);
   });

});

