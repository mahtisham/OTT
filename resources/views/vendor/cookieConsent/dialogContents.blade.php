<style>
	
    #cookieWrapper {
        position: fixed;
        bottom: 1px;
        z-index: 100;
     	width:100vw;
        box-shadow: 0px 0px 2px grey;
        background: #48A3C6;
        border:2px solid #48A3C6;
        color:white;
        transition-timing-function: ease-in-out;
       
    }
    
    .agree_btn{
    	background-color: #111;
    	border: 3px solid #48A3C6;
    	color:white;
    }
    .agree_btn:hover{
    	color:white;
    	transform:scale(1.2);
    }
</style>
	<div id="cookieWrapper" class="animated zoomIn text-white text-center cookierbar js-cookie-consent cookie-consent">
	    <span class="cookie-consent__message">
	        {!! trans('cookieConsent::texts.message') !!}&nbsp;&nbsp;
	    </span>
	    <button class="btn btn-sm text-white agree_btn js-cookie-consent-agree cookie-consent__agree">
	        {{ trans('cookieConsent::texts.agree') }}
	    </button>
    </div>

 