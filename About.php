<?php
$funtionsFile = "inc/funtion.php";
// if the funtion not exist
if(!file_exists($funtionsFile))
{
    die("missing funtions file !!!") ;
}

// include the funtions file 
require($funtionsFile);

// display head html
displayHTMLhead();
?>
<div class="about-section">
    <h1>About Us Page</h1>
    <p>Dymbel Gym is a Website the can help you to change your lifstyle and leave a better and healthy lifestyle.</p>
    <p>Also you can check our clothing product supplement and fitness material.</p>
  </div>
  
  <h2 style="text-align:center">Our Team</h2>
  <div class="row">
    <div class="column">
      <div class="card-about">
        <img src="img/Duc.png" alt="Duc">
        <div class="container">
          <h2>Duc Nguyen</h2>
          <p class="title">Designer / Programmer</p>
          <p>7921@roc-teraa.nl</p>
        </div>
      </div>
    </div>
  
    <div class="column">
      <div class="card-about">
        <img src="img/mouaz.png" alt="Mouaz">
        <div class="container">
          <h2>Mouaz Mabda</h2>
          <p class="title">Project Manager / Programmer</p>
          <p>81871@roc-teraa.nl</p>
        </div>
      </div>
    </div>
  
    <div class="column">
      <div class="card-about">
        <img src="img/ahmad.png" alt="Ahmad">
        <div class="container">
          <h2>Ahmad Kasem</h2>
          <p class="title">Database Specialist / Programmer</p>
          <p>82450@roc-teraa.nl</p>
        </div>
      </div>
    </div>
      <div class="column">
      <div class="card-about">
        <img src="img/vartan.png" alt="Ibrahim">
        <div class="container">
          <h2>Ibrahim Vartan</h2>
          <p class="title">Training Plan Creator / Programmer </p>
          <p>81953@roc-teraa.nl</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php displayHTMLFooter();?>