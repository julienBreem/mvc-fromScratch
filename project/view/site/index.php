<div>
    Modèle présent physiquement:
    <br>
    <?php
    foreach($this->models['physic']->getAttributes() as $id => $value)echo $id." => ".$value."<br>";
    ?>
</div>

<div>
    Modèle présent physiquement, complété par les données de sa source:
    <br>
    <?php
    foreach($this->models['physicAutoCompleted']->getAttributes() as $id => $value)echo $id." => ".$value."<br>";
    ?>
</div>

<div>
    Modèle non présent physiquement ( pas de fichiers de classe correspondant dans le repertoire modèle du projet ):
    <br>
    <?php
    foreach($this->models['generated']->getAttributes() as $id => $value)echo $id." => ".$value."<br>";
    ?>
</div>