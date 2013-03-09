<ul class="nav" >
	<li class=" active"><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo  base_url( 'main' )?>">Задачи</a></li>
	<li><a class="<?php echo isActive($pageName,"about")?>" href="<?php echo  base_url( 'calendar' )?>">Календарь</a></li>
</ul>
<ul class="nav pull-right">
	<li><a href="<?php echo base_url('login/user_exit'); ?>">Выход</a></li>
</ul>