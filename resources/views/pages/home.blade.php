<x-layout.template :page-headings="$pageHeadings">




    <div class="relative w-full aspect-video bg-black cursor-pointer text-center overflow-visible" onclick="loadVideo(this)">
        <img id="videoScreen" src="{{asset('images/video-thumbnails/russell-williams-music-video-acdc-night-prowler.jpg')}}" class="video-thumbnail" alt="Thumbnail">
        <div class="absolute w-full h-full top-0 bottom-0 left-0 right-0 flex items-center justify-center">
            <img src="{{asset('images/play-button.png')}}" alt="" class="w-48 opacity-60">
        </div>
    </div>

    <script>

        function loadVideo(container) {
            container.innerHTML = '<iframe src="https://truecrimemetrix.com/night.prowler.mp4" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>';
        }

    </script>



</x-layout.template>


