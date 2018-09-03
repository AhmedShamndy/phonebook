<template>
	<nav class="navbar" role="navigation" style="background:#ef543b;"aria-label="main navigation">
	  <div class="navbar-brand">
	    
	    <a class="navbar-item" href="#" style="color:#FFF; font-size:30px;margin-right:50px;">
	      	Phonebook
	    </a>

	    <div class="navbar-menu is-active">
		    <router-link to="/home" class="navbar-item" style="color:#FFF;">Home</router-link>
		    <router-link to="/about" class="navbar-item" style="color:#FFF;">About</router-link>
	    </div>
	    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
	      <span aria-hidden="true"></span>
	      <span aria-hidden="true"></span>
	      <span aria-hidden="true"></span>
	    </a>
	  </div>
	</nav>
</template>