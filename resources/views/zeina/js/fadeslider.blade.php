<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- optional touchswipe file to enable swipping to navigate slideshow -->
<script type="text/javascript" src="/js/jquery.touchSwipe.min.js"></script>

    <style>

    #fadeshow4 .gallerylayer img{ /* make all images inside fadeshow4 scale to 100% of slideshow width */
    width: 100%;
    height: auto;
    }

    </style>

    <script type="text/javascript" src="/js/fadeslideshow.js">

    /***********************************************
    * Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
    * This notice MUST stay intact for legal use
    * Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
    ***********************************************/

    </script>

    <script type="text/javascript">

        var mygallery = new fadeSlideShow({
        wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
                //dimensions: [600, 600], //width/height of gallery in pixels. Should reflect dimensions of largest image
                dimensions: [525, 460], //width/height of gallery in pixels. Should reflect dimensions of largest image
                imagearray: [
                        ["/images/slideshow/about/dz.png"],
                        ["/images/slideshow/about/sonic.png"] //<--no trailing comma after very last image element!
                ],
                displaymode: {type:'auto', pause:3500, cycles:0, wraparound:false},
                persist: false, //remember last viewed slide and recall within same session?
                fadeduration: 500, //transition duration (milliseconds)
                descreveal: "always",
                togglerid: ""
                })
    </script>