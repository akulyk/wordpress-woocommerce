

jQuery(function(){
 is_mobile = wp_is_mobile();
 var popup = new Popup({
        modal: '.modal-box',
        overlay: '.overlay'
    });
 
 jQuery('button.contact-us-button').on('click',function(){
	 popup.open();
 });
	
});

jQuery(window).on('resize',function(){
	
	var is_now_mobile = wp_is_mobile();
	
	if(is_now_mobile !== is_mobile){
		
	location.reload();
	}
	
});

function getPageWidth(){
	var width = jQuery(window).width();
	return width;
}

/*
* Popup class
*/
function Popup(options){
    this.modal = jQuery(options.modal);
    this.overlay = jQuery(options.overlay);
    
    var popup = this;
    
    this.open = function(content){
		if(content){
        popup.modal.html(content);
		}
        popup.overlay.addClass('open');
        popup.modal.addClass('open');
		jQuery('body').addClass('modal-open');
		popup.centerModal();
    }
	
	this.centerModal = function(){
		var height = popup.modal.height(),
			width = popup.modal.width();
			popup.modal.css({marginTop:height/2*-1,marginLeft:width/2*-1});
			
		
	}
    
    this.close = function(){
        popup.overlay.removeClass('open');
        popup.modal.removeClass('open');
		jQuery('body').removeClass('modal-open');
    }
  
    this.overlay.on('click',popup.close);
	  jQuery('a.js-modal-close').on('click',function(e){
		  e.preventDefault();
		  popup.close();
		  });
}

/*
* this function check if user use mobile device 
* the same as wordpress core function on PHP wp_is_mobile()
* @return bool 
*/
function wp_is_mobile(){
	    /* Detect mobile browser */
		var isMobile = false;
    if( navigator.userAgent.match(/Mobile/i)
        || navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/Silk/i)
        || navigator.userAgent.match(/Kindle/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Opera Mini/i)
        || navigator.userAgent.match(/Opera Mobi/i) ){
        jQuery("body").removeClass("wp-is-not-mobile").addClass("wp-is-mobile");
		isMobile = true;
    }
    else {
        jQuery("body").removeClass("wp-is-mobile").addClass("wp-is-not-mobile");
	
    }
	return isMobile
}/**/