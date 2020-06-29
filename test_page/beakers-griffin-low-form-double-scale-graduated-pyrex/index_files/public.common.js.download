function OpenWindow(query,w,h,scroll){var l=(screen.width-w)/2;var t=(screen.height-h)/2;winprops='resizable=0, height='+h+',width='+w+',top='+t+',left='+l+'w';if(scroll)winprops+=',scrollbars=1';var f=window.open(query,"_blank",winprops);}
function setLocation(url){window.location.href=url;}
function displayAjaxLoading(display){if(display){$('.ajax-loading-block-window').show();}
else{$('.ajax-loading-block-window').hide('slow');}}
function displayPopupNotification(message,messagetype,modal){var container;if(messagetype=='success'){container=$('#dialog-notifications-success');}
else if(messagetype=='error'){container=$('#dialog-notifications-error');}
else{container=$('#dialog-notifications-success');}
var htmlcode='';if((typeof message)=='string'){htmlcode='<p>'+message+'</p>';}else{for(var i=0;i<message.length;i++){htmlcode=htmlcode+'<p>'+message[i]+'</p>';}}
container.html(htmlcode);var isModal=(modal?true:false);container.dialog({modal:isModal});}
var barNotificationTimeout;function displayBarNotification(message,messagetype,timeout){clearTimeout(barNotificationTimeout);var cssclass='success';if(messagetype=='success'){cssclass='success';}
else if(messagetype=='error'){cssclass='error';}
$('#bar-notification').removeClass('success').removeClass('error');$('#bar-notification .content').remove();var htmlcode='';if((typeof message)=='string'){htmlcode='<p class="content">'+message+'</p>';}else{for(var i=0;i<message.length;i++){htmlcode=htmlcode+'<p class="content">'+message[i]+'</p>';}}
$('#bar-notification').append(htmlcode).addClass(cssclass).fadeIn('slow').mouseenter(function()
{clearTimeout(barNotificationTimeout);});$('#bar-notification .close').unbind('click').click(function(){$('#bar-notification').fadeOut('slow');});if(timeout>0){barNotificationTimeout=setTimeout(function(){$('#bar-notification').fadeOut('slow');},timeout);}}
function htmlEncode(value){return $('<div/>').text(value).html();}
function htmlDecode(value){return $('<div/>').html(value).text();}
function addAntiForgeryToken(data){if(!data){data={};}
var tokenInput=$('input[name=__RequestVerificationToken]');if(tokenInput.length){data.__RequestVerificationToken=tokenInput.val();}
return data;};