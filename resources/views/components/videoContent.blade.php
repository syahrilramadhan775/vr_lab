@push('after_styles')
  <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
<link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">

@endpush

@push('after_scripts')

<div id="content-detail" class="modal fade" role="dialog">
<div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <video id="my-video" controls class="video-js vjs-theme-forest mb-3" preload="auto"
                    data-setup='{ "fluid" : true}' oncontextmenu="disableRightClick(event)">
                    
                    <source
                        src=""
                        type='video/mp4'>

                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>

                </video>

                <span class="px-2 py-1 bg-success rounded" id="detail-level">Medium</span>

                <h5 class="mt-3" id="detail-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, maxime expedita</h5>
                <div class="mt-3" id="detail-description">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore officia modi neque iure odit explicabo omnis assumenda ducimus quia suscipit! Iure officiis molestias illum possimus? Libero praesentium error qui nulla?

                </div>
                
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
    (() => {
        // get Instance VideoJs
        var app = videojs('my-video');


        // Firing Event 
        $('#content-detail').on('hidden.bs.modal', function (e) {
            app.pause();
        });

        // $('#my-video').on('contextmenu', disableRightClick);

    })();

</script>
@endpush
