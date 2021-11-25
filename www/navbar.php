<div class="container-fluid" style="position: sticky;top:0;">
<nav class="navbar navbar-expand-lg navbar-dark row">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>">Start</a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/stopnie.php">Stopnie i Gwiazdki</a>
      </li>
	  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sprawności
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/sprawnosci-zuchowe.php">Zuchowe</a>
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/sprawnosci-harcerskie.php">Harcerskie</a>
        </div>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/tropy-zuchowe.php">Tropy zuchowe</a>
      </li>
	  
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Wyzwania i Zadania Indywidualne
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/zadania-zuchowe.php">Zuchowe</a>
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/wyzwania-harcerskie.php">Harcerskie</a>
        </div>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/tropy-harcerskie.php">Tropy harcerskie</a>
      </li>
	  
	  
    </ul>
    
  </div>
</nav>
</div>