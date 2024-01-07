import videojs from "video.js";
import "../vendor/Youtube.js";

const videoPopupTrigger = $(".video-open-trigger");
const youtubePopupTrigger = $(".youtube-open-trigger");
const videoModalPopup = $(".video-modal");
const playerBox = videoModalPopup.find(".video-box");

videoPopupTrigger.on("click", function () {
    const video_src = $(this).data("video");

    playerBox.html('<video preload="auto" id="videoJsPlayerPopup" class="video-js bg-img" autoplay controls data-setup=\'{"controls": true, "disablePictureInPicture" : true, "controlBar" : {"volumePanel": {"inline" : false, "vertical": true}}}\'><source src="'+video_src+'" type="video/mp4"></video>');
    videojs('videoJsPlayerPopup');
    videoModalPopup.addClass("-open");
    $("body").addClass("-overflow-hidden");
})
youtubePopupTrigger.on("click", function () {
    const video_src = $(this).data("youtube");

    playerBox.html('<video preload="auto" id="videoJsPlayerPopup" class="video-js bg-img" autoplay controls data-setup=\'{"disablePictureInPicture" : true, "controlBar" : {"volumePanel": {"inline" : false, "vertical": true}}, "techOrder": ["youtube"], "sources": [{"type": "video/youtube", "src": "http://www.youtube.com/watch?v=' + video_src + '"}]}\'></video>');
    videojs('videoJsPlayerPopup');
    videoModalPopup.addClass("-open");
    $("body").addClass("-overflow-hidden");
})

$(".video-modal .close-button, .video-modal .modal-overlay").on("click", function (e) {
    const header = $(".site-header");
    const player = videojs('videoJsPlayerPopup');
    const modalPopup = $(this).closest(".video-modal");

    if(player) {
        player.dispose();
        playerBox.html('');
    }

    modalPopup.removeClass("-open");
    $("body").removeClass("-overflow-hidden");
});