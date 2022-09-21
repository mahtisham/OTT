@extends('layouts.admin')
@section('title',__('Media Manager'))
@section('content')
<div class="admin-form-main-block mrg-t-40">
  <h4 class="admin-form-text">{{__('Media Manager')}}</h4>
    <div class="content-block box-body">
        <div class="admin-form-block z-depth-1">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">

                        <li class="nav-item active" role="presentation">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#moviethumbnail" role="tab" aria-controls="moviethumbnail" aria-selected="true"><i class="feather icon-folder"></i> {{ __('Movies Thumbnails') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#movieposter" role="tab" aria-controls="movieposter" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movies Poster") }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseriesthumbnail" role="tab" aria-controls="tvseriesthumbnail" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Tvseries Thumbnails") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseries_posters" role="tab" aria-controls="tvseries_posters" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Tvseries Posters") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#seasons_thumbnail" role="tab" aria-controls="seasons_thumbnail" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Seasons Thumbnails") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#episode_thumbnail" role="tab" aria-controls="episode_thumbnail" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Episodes Thumbnails") }}</a>
                        </li>
        
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#movie_upload" role="tab" aria-controls="blog_files" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movie uploads") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#movie_url_360" role="tab" aria-controls="movie_url_360" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movies 360 Video upload") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#movie_url_480" role="tab" aria-controls="movie_url_480" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movies 480 Video upload") }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#movie_url_720" role="tab" aria-controls="movie_url_720" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movies 720 Video upload") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#movie_url_1080" role="tab" aria-controls="movie_url_1080" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Movies 1080 Video upload") }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseries_url_360" role="tab" aria-controls="tvseries_url_360" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Episode 360 Video upload") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseries_url_480" role="tab" aria-controls="tvseries_url_480" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Episode 480 Video upload") }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseries_url_720" role="tab" aria-controls="tvseries_url_720" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Episode 720 Video upload") }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tvseries_url_1080" role="tab" aria-controls="tvseries_url_1080" aria-selected="false"><i class="feather icon-folder"></i> {{ __("Episode 1080 Video upload") }}</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade in active" id="moviethumbnail" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div data-midia-can_choose="false" id="media1"></div>
                        </div>
                        <div class="tab-pane fade" id="movieposter" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div data-midia-can_choose="false" id="media2"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseriesthumbnail" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media3"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseries_posters" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media4"></div>
                        </div>
                        <div class="tab-pane fade" id="seasons_thumbnail" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media5"></div>
                        </div>
                        <div class="tab-pane fade" id="episode_thumbnail" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media6"></div>
                        </div>
                        <div class="tab-pane fade" id="movie_upload" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media7"></div>
                        </div>
                        <div class="tab-pane fade" id="movie_url_360" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media8"></div>
                        </div>
                        <div class="tab-pane fade" id="movie_url_480" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media9"></div>
                        </div>
                        <div class="tab-pane fade" id="movie_url_720" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media10"></div>
                        </div>
                        <div class="tab-pane fade" id="movie_url_1080" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media11"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseries_url_360" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media12"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseries_url_480" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media13"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseries_url_720" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media14"></div>
                        </div>
                        <div class="tab-pane fade" id="tvseries_url_1080" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div data-midia-can_choose="false" id="media15"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection
@section('custom-script')
    <script>
        $("#media1").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Movie thumbnail Media Manager',
            directory_name : 'movies_thumbnails'
        });

        $("#media2").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Movie Poster Media Manager',
            directory_name : 'movies_posters'
        });

        $("#media3").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Tvseries thumbnail Media Manager',
            directory_name : 'tvseries_thumbnails'
        });

        $("#media4").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Tvseries Posters Media Manager',
            directory_name : 'tvseries_posters'
        });

        $("#media5").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Seasons thumbnail Media Manager',
            directory_name : 'tvseries_thumbnails'
        });

        $("#media6").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.jpg,.png,.jpeg,.gif,.webm',
            },
            title : 'Episodes thumbnail Media Manager',
            directory_name : 'episode_thumbnails'
        });

        $("#media7").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Movies upload Media Manager',
            directory_name : 'movies_upload'
        });

        $("#media8").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Movie url 360 upload',
            directory_name : 'movie_url_360'
        });

        $("#media9").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Movie url 480 upload',
            directory_name : 'movie_url_480'
        });
        $("#media10").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Movie url 720 upload',
            directory_name : 'movie_url_720'
        });

        $("#media11").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Movie url 1080 upload',
            directory_name : 'movie_url_1080'
        });
        $("#media12").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Tvseries url 360 upload',
            directory_name : 'tvseries_url_360'
        });

        $("#media13").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Tvseries url 480 upload',
            directory_name : 'tvseries_url_480'
        });
        $("#media14").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Tvseries url 720 upload',
            directory_name : 'tvseries_url_720'
        });

        $("#media15").midia({
            inline: true,
            base_url: '{{url('')}}',
            dropzone : {
                acceptedFiles: '.mp4,.m3u8'
            },
            title : 'Tvseries url 1080 upload',
            directory_name : 'tvseries_url_1080'
        });
    </script> 
  @endsection