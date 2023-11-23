function closePopupVid(index) {
    var popup = document.getElementById("popupVid" + index);
    popup.style.display = "none";

    var video = document.getElementById("vid" + index);
    video.pause();
    video.currentTime = 0;
}