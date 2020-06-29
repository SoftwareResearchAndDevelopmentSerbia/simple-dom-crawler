var AjaxCart={loadWaiting:false,usepopupnotifications:false,topcartselector:'',topwishlistselector:'',flyoutcartselector:'',init:function(usepopupnotifications,topcartselector,topwishlistselector,flyoutcartselector){this.loadWaiting=false;this.usepopupnotifications=usepopupnotifications;this.topcartselector=topcartselector;this.topwishlistselector=topwishlistselector;this.flyoutcartselector=flyoutcartselector;},setLoadWaiting:function(display){displayAjaxLoading(display);this.loadWaiting=display;},addproducttocart_catalog:function(urladd){if(this.loadWaiting!=false){return;}
this.setLoadWaiting(true);$.ajax({cache:false,url:urladd,type:'post',success:this.success_process,complete:this.resetLoadWaiting,error:this.ajaxFailure});},addproducttocart_details:function(urladd,formselector){if(this.loadWaiting!=false){return;}
this.setLoadWaiting(true);$.ajax({cache:false,url:urladd,data:$(formselector).serialize(),type:'post',success:this.success_process,complete:this.resetLoadWaiting,error:this.ajaxFailure});},addproducttocomparelist:function(urladd){if(this.loadWaiting!=false){return;}
this.setLoadWaiting(true);$.ajax({cache:false,url:urladd,type:'post',success:this.success_process,complete:this.resetLoadWaiting,error:this.ajaxFailure});},success_process:function(response){if(response.updatetopcartsectionhtml){$(AjaxCart.topcartselector).html(response.updatetopcartsectionhtml);}
if(response.updatetopwishlistsectionhtml){$(AjaxCart.topwishlistselector).html(response.updatetopwishlistsectionhtml);}
if(response.updateflyoutcartsectionhtml){$(AjaxCart.flyoutcartselector).replaceWith(response.updateflyoutcartsectionhtml);}
if(response.message){if(response.success==true){if(AjaxCart.usepopupnotifications==true){displayPopupNotification(response.message,'success',true);}
else{displayBarNotification(response.message,'success',3500);}}
else{if(AjaxCart.usepopupnotifications==true){displayPopupNotification(response.message,'error',true);}
else{displayBarNotification(response.message,'error',0);}}
return false;}
if(response.redirect){location.href=response.redirect;return true;}
return false;},resetLoadWaiting:function(){AjaxCart.setLoadWaiting(false);},ajaxFailure:function(){alert('Failed to add the product. Please refresh the page and try one more time.');}};