<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{{__('Watch mMvie')}} - {{ $audio->title }}</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1 user-scalable=no" />
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<link rel="stylesheet" type="text/css"  href="{{url('content/global.css')}}"/>
	<?php
	$cpy = App\PlayerSetting::first();
	$text = $cpy->cpy_text;
	$app_url = config('app.url');
	?>
	<style>
		
		.UVPSubtitle
		{
			font-family:Arial !important;
			text-align:center !important;
			color:{{$cpy->subtitle_color}}!important;
			text-shadow: 0px 0px 1px #000000 !important;
			font-size:{{$cpy->subtitle_font_size}}px!important;
			line-height:{{$cpy->subtitle_font_size}}px!important;
		    font-weight:600 !important;
			margin:0px !important;
			padding:0px !important;
			margin-left:20px !important;
			margin-right:20px !important;
			margin-bottom:12px !important;
		}
	</style>
	

	<script type="text/javascript">
		var cpy = "<?= $text ?>";
		var app_url = "<?= $app_url ?>";
	</script>
   
	<script type="text/javascript" src="{{ asset('java/FWDUVPlayer.js') }}"></script>
      <script type="text/javascript">
	 $(document).ready(function(){
	 	var SITEURL = '{{URL::to('')}}';
	 	 setInterval(function(){
	 		
	 		var tt = FWDUVPlayer.instaces_ar.length;
			var audio_id='{{$audio->id}}';
			var user_id='{{Auth::check() ? Auth::user()->id : $user}}'
			 var video;
			

		for(var i=0; i<tt; i++){
			video = FWDUVPlayer.instaces_ar[i];

			
			}

	 		 
	 	},5000);
         
	
  });
</script>

	<!-- Setup video player-->
	<script type="text/javascript">
		FWDUVPUtils.onReady(function(){

			new FWDUVPlayer({		
					//main settings
					instanceName:"player1",
					parentId:"myDiv",
					playlistsId:"playlists",
					mainFolderPath:"{{url('content')}}",
					skinPath:"{{$cpy->skin}}",
					displayType:"fullscreen",
					initializeOnlyWhenVisible:"no",
					useVectorIcons:"no",
					fillEntireVideoScreen:"yes",
					fillEntireposterScreen:"yes",
					goFullScreenOnButtonPlay:"yes",
					playsinline:"yes",
					fillEntireVideoScreen:"no",
					@if(!isset($audio->password) && $audio->password == NULL)
					privateVideoPassword:"428c841430ea18a70f7b06525d4b748a",
					@endif
					useHEXColorsForSkin:"no",
					normalHEXButtonsColor:"#FF0000",
					selectedHEXButtonsColor:"#000000",
					@if(isset($cpy->player_google_analytics_id))
					googleAnalyticsTrackingCode:"{{$cpy->player_google_analytics_id}}",
					@else
					googleAnalyticsTrackingCode:"",
					@endif
					showPreloader:"yes",
					
					useDeepLinking:"no",
					preloaderBackgroundColor:"#000000",
					preloaderFillColor:"#FFFFFF",
					rightClickContextMenu:"developer",
					addKeyboardSupport:"yes",
					autoScale:"yes",
					showButtonsToolTip:"yes", 
					stopVideoWhenPlayComplete:"no",
					playAfterVideoStop:"yes",
					@if($cpy->auto_play ==1)
					autoPlay:"yes",
					@else
					autoPlay:"no",
					@endif
					//Auto Play settings
					
					//loop video settings
					@if($cpy->loop_video ==1)
					loop:"yes",
					@else
					loop:"no",
					@endif
					
					shuffle:"no",
					showErrorInfo:"yes",
					maxWidth:980,
					maxHeight:552,
					buttonsToolTipHideDelay:1.5,
					volume:.8,
					backgroundColor:"#000000",
					videoBackgroundColor:"#000000",
					posterBackgroundColor:"#000000",
					buttonsToolTipFontColor:"#5a5a5a",
					//logo settings
					@if($cpy->logo_enable ==1)
					showLogo:"yes",
					@else
					showLogo:"no",
					@endif
					hideLogoWithController:"yes",
					logoPosition:"topRight",
					logoLink:"{{ config('app.url') }}",
					logoMargins:5,
					//playlists/categories settings
					showPlaylistsSearchInput:"yes",
					usePlaylistsSelectBox:"yes",
					showPlaylistsButtonAndPlaylists:"yes",
					showPlaylistsByDefault:"no",
					thumbnailSelectedType:"opacity",

					buttonsMargins:0,
					thumbnailMaxWidth:350, 
					thumbnailMaxHeight:350,
					horizontalSpaceBetweenThumbnails:40,
					verticalSpaceBetweenThumbnails:40,
					inputBackgroundColor:"#333333",
					inputColor:"#999999",
					//playlist settings
					showPlaylistButtonAndPlaylist:"yes",
					playlistPosition:"right",
					showPlaylistByDefault:"no",
					showPlaylistName:"yes",
					showSearchInput:"no",
					showLoopButton:"yes",
					showShuffleButton:"yes",
					showNextAndPrevButtons:"yes",
					showThumbnail:"yes",
					forceDisableDownloadButtonForFolder:"yes",
					addMouseWheelSupport:"yes", 
					startAtRandomVideo:"no",
					stopAfterLastVideoHasPlayed:"no",
					folderVideoLabel:"VIDEO ",
					playlistRightWidth:310,
					playlistBottomHeight:599,

					maxPlaylistItems:50,
					thumbnailWidth:70,
					thumbnailHeight:70,
					spaceBetweenControllerAndPlaylist:2,
					spaceBetweenThumbnails:2,
					scrollbarOffestWidth:8,
					scollbarSpeedSensitivity:.5,
					playlistBackgroundColor:"#000000",
					playlistNameColor:"#FFFFFF",
					thumbnailNormalBackgroundColor:"#1b1b1b",
					thumbnailHoverBackgroundColor:"#313131",
					thumbnailDisabledBackgroundColor:"#272727",
					searchInputBackgroundColor:"#000000",
					searchInputColor:"#999999",
					youtubeAndFolderVideoTitleColor:"#FFFFFF",
					folderAudioSecondTitleColor:"#999999",
					youtubeOwnerColor:"#888888",
					youtubeDescriptionColor:"#888888",
					mainSelectorBackgroundSelectedColor:"#FFFFFF",
					mainSelectorTextNormalColor:"#FFFFFF",
					mainSelectorTextSelectedColor:"#000000",
					mainButtonBackgroundNormalColor:"#212021",
					mainButtonBackgroundSelectedColor:"#FFFFFF",
					mainButtonTextNormalColor:"#FFFFFF",
					mainButtonTextSelectedColor:"#000000",
					//controller settings
					showController:"yes",
					showControllerWhenVideoIsStopped:"yes",
					showNextAndPrevButtonsInController:"no",
					showRewindButton:"yes",
					showPlaybackRateButton:"yes",
					showVolumeButton:"yes",
					showTime:"yes",
					showQualityButton:"yes",
					showInfoButton:"yes",
					showDownloadButton:"yes",
					showChromecastButton:"yes",
					
					@if($cpy->share_opt ==1)
					showShareButton:"yes",
					@else
					showShareButton:"no",
					@endif
					
					showEmbedButton:"no",
					showFullScreenButton:"yes",
					disableVideoScrubber:"no",
					showMainScrubberToolTipLabel:"yes",
					showDefaultControllerForVimeo:"no",
					repeatBackground:"yes",
					controllerHeight:37,
					controllerHideDelay:3,
					startSpaceBetweenButtons:7,
					spaceBetweenButtons:8,
					scrubbersOffsetWidth:2,
					mainScrubberOffestTop:14,
					timeOffsetLeftWidth:5,
					timeOffsetRightWidth:3,

					volumeScrubberHeight:80,
					volumeScrubberOfsetHeight:12,
					timeColor:"#888888",
					youtubeQualityButtonNormalColor:"#888888",
					youtubeQualityButtonSelectedColor:"#FFFFFF",
					scrubbersToolTipLabelBackgroundColor:"#FFFFFF",
					scrubbersToolTipLabelFontColor:"#5a5a5a",
					//advertisement on pause window
					aopwTitle:"Advertisement",
					aopwWidth:400,
					aopwHeight:240,
					aopwBorderSize:6,
					aopwTitleColor:"#FFFFFF",
					//subtitle
					subtitlesOffLabel:"Subtitle off",
					//popup add windows
					showPopupAdsCloseButton:"yes",
					//embed window and info window
					@if($cpy->info_window ==1)
					embedAndInfoWindowCloseButtonMargins:0,
					borderColor:"#333333",
					mainLabelsColor:"#FFFFFF",
					secondaryLabelsColor:"#a1a1a1",
					shareAndEmbedTextColor:"#5a5a5a",
					inputBackgroundColor:"#000000",
					inputColor:"#FFFFFF",
					
					@endif

					//loggin
					isLoggedIn:"yes",
					playVideoOnlyWhenLoggedIn:"yes",
					loggedInMessage:"Please login to view this video.",
					//audio visualizer
					audioVisualizerLinesColor:"#0099FF",
					audioVisualizerCircleColor:"#FFFFFF",
					//lightbox settings
					lightBoxBackgroundOpacity:.6,
					lightBoxBackgroundColor:"#000000",
					//sticky on scroll
					stickyOnScroll:"no",
					stickyOnScrollShowOpener:"yes",
					stickyOnScrollWidth:"700",
					stickyOnScrollHeight:"394",
					//sticky display settings
					showOpener:"yes",
					showOpenerPlayPauseButton:"yes",
					verticalPosition:"bottom",
					horizontalPosition:"center",
					showPlayerByDefault:"yes",
					animatePlayer:"yes",
					openerAlignment:"right",
					mainBackgroundImagePath:"{{url('content/minimal_skin_dark/main-background.png')}}",
					openerEqulizerOffsetTop:-1,
					openerEqulizerOffsetLeft:3,

					//playback rate / speed
					defaultPlaybackRate:1, //0.25, 0.5, 1, 1.25, 1.2, 2
					//cuepoints
					executeCuepointsOnlyOnce:"no",
					//annotations
					showAnnotationsPositionTool:"no",
					//ads
					openNewPageAtTheEndOfTheAds:"no",
					playAdsOnlyOnce:"no",
					adsButtonsPosition:"left",
					skipToVideoText:"You can skip to video in: ",
					skipToVideoButtonText:"Skip Ad",
					adsTextNormalColor:"#888888",
					adsTextSelectedColor:"#FFFFFF",
					adsBorderNormalColor:"#666666",
					adsBorderSelectedColor:"#FFFFFF",
					//a to b loop
					useAToB:"yes",
					atbTimeBackgroundColor:"transparent",
					atbTimeTextColorNormal:"#888888",
					atbTimeTextColorSelected:"#FFFFFF",
					atbButtonTextNormalColor:"#888888",
					atbButtonTextSelectedColor:"#FFFFFF",
					atbButtonBackgroundNormalColor:"#FFFFFF",
					atbButtonBackgroundSelectedColor:"#000000"
				});	
			});
			
</script>
</head>

<body style="background-color:#999999; padding:0px; margin:0px;">	
	
	<div id="myDiv" style="position:relative; left:1000px; top:5000px;"></div>
	
	<!--  Playlists -->
	<ul id="playlists" style="display:none;">
		
		<li data-source="trailer"
		 data-playlist-name="{{ $audio->title }}" data-thumbnail-path="{{asset('images/audio/thumbnails/'.$audio->thumbnail)}}" >
			<p class="minimalDarkCategoriesTitle"><span class="minimialDarkBold">Title: {{ $audio->title }}</span></p>
			<p class="minimalDarkCategoriesDescription"><span class="minimialDarkBold">Description: </span>{{ $audio->detail }}</p>
		</li>



	</ul>

	<ul id="trailer">
		


   
       

		<li
		
		data-thumb-source="{{asset('images/audio/thumbnails/'.$audio->thumbnail)}}" 
		@if(isset($audio->audiourl) && $audio->audiourl !="")
		
		
		
		data-video-source="{{ ($audio->audiourl) }}"
		@else
		data-video-source="{{ url('audio/'.$audio->upload_audio) }}"
		@endif data-poster-source="{{asset('images/audio/posters/'.$audio->poster)}}"  data-downloadable="no"  @if(isset($pass) && $pass !=NULL) data-is-private="yes" data-private-video-password="{{ $pass }}" @endif> 
		
		

			<div data-video-short-description="">
				<p class="minimalDarkCategoriesTitle"><span class="minimialDarkBold">{{__('Title')}}: </span>{{ $audio->title }}</p>
				<p class="minimalDarkCategoriesDescription"><span class="minimialDarkBold">{{__('Description')}}: </span>{{ $audio->detail }}</p>
			</div>
			<div>
				<p class="classicDarkThumbnailTitle">{{__('title')}}: </span>{{ $audio->title }}</p>
				<p class="minimalDarkThumbnailDesc">{{__('description')}}: </span>{{ $audio->detail }}</p>
			</div>

			@php
				$googleads = App\GoogleAds::get();
			@endphp
			@if($googleads->count()>0)
				@foreach($googleads as $gads)
					<div data-add-popup="">
						<p data-google-ad-client="{{$gads->google_ad_client}}" data-google-ad-slot="{{$gads->google_ad_slot}}" data-google-ad-width="{{$gads->google_ad_width}}" data-google-ad-height="{{$gads->google_ad_height}}" data-time-start="{{$gads->google_ad_starttime}}" data-time-end="{{$gads->google_ad_endtime}}"></p>
					</div>
				@endforeach
			@endif
			
		</li>
	</ul>

</body>
</html>
