var LastScrollTop = 0;
  navbar = document.getElementById("navbar");
  window.addEventListener("scroll,",function(){
    var scrollTop = window.pageXOffset || document.documentElement.scrollTop;
    if(scrollTop > LastScrollTop)
    {
      navbar.style.top ="-80px";
    }
    else{
      navbar.style.top ="0px";
    }
  })
