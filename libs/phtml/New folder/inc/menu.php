<ul class="nav">
      <li><a href="home.html">Home</a></li>
      <li><a href="about-us.html">About Us</a></li>
      <li><a href="products.html">Products</a></li>
      <li><a href="gallery.html">Gallery</a></li>
      <li><a href="users.html">User list</a></li>
      <li><a href="downloads.html">Downloads</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><?php 
	  	if(checklogin()){
			echo '<a href="logout.html">Logout</a>';
		}else{
			echo '<a href="login.html">Login</a>';
		}
	  
	  ?></li>
</ul>