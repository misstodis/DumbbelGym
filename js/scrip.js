//  cursus video display
function toggle(){
    var VideoCursus= document.querySelector(".VideoCursus")
    VideoCursus.classList.toggle("DiplayVideo")
    var Video= document.querySelector("video")
    Video.pause();
    Video.currentTime = 0;
  }
  function playVideo(file)
  {
    var myVideo = document.getElementById("myVideo")
    myVideo.src = file;
  }
