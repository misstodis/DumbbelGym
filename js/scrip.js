
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
  
  //product detail
var productImg = document.getElementById("product-detail-image");
var smallImg = document.getElementsByClassName("small-product-image");
smallImg[0].onclick = function()
{
  productImg.src =smallImg[0].src;
}
smallImg[1].onclick = function()
{
  productImg.src =smallImg[1].src;
}
smallImg[2].onclick = function()
{
  productImg.src =smallImg[2].src;
}
smallImg[3].onclick = function()
{
  productImg.src =smallImg[3].src;
}