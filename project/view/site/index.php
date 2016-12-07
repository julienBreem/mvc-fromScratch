<body>
	<?php
	foreach($this->models['model']->getAttributes() as $id => $value)echo $id." => ".$value."<br>";
	?>
</body>