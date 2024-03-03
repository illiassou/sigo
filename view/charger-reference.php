<?php
if(isset($_GET['id_desig']) and !empty($_GET['id_desig']))
{
    $id_desig = $_GET['id_desig'];
    $reference = select($table='designation',$con='id_desig ='.$id_desig);
    $donnees = $reference->fetch();
    $ref_desig = $donnees['ref_desig'];
?>

<input type="hidden" id="ref_desig" name="ref_desig" value="<?=$ref_desig?>" required>
<?php
}else
{
?>
<input type="hidden" id="ref_desig" name="ref_desig" required>
<?php
}
?>