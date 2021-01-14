@push('after_styles')
  <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
<link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">

{{-- <link rel="stylesheet" href="{{ asset('assets/css/skin-video-forest.css') }}"> --}}
@endpush

@push('after_scripts')

<div id="asset-video" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Video Preview</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <video id="my-video" controls class="video-js vjs-theme-forest" preload="auto"
                    data-setup='{ "fluid" : true}' oncontextmenu="disableRightClick(event)">
                    
                    <source
                        src="{{$path }}"
                        type='video/mp4'>

                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>

                </video>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
{{-- <script src="https://vjs.zencdn.net/7.8.4/video.js"></script> --}}

<script>
    (function(){
        // get Instance VideoJs
        var app = videojs('my-video');


        // Firing Event 
        $('#asset-video').on('hidden.bs.modal', function (e) {
            app.pause();
        });

        // $('#my-video').on('contextmenu', disableRightClick);

    })();

</script>
@endpush
