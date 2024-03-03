<?php
if(isset($_GET['id_identification']))
{
    $id_identification = $_GET['id_identification'];

?>
    <?php   $position = position($id_identification);
            $count = $position->rowCount();
            if($count==0)
            {
    ?>
    <select class="form-control selectpicker" name="id_position" id="id_position" data-live-search="true"  required>
    <option value="" selected>--Aucune position correspondante--</option>
    </select>
    <?php
            }else
            {
    ?>
    <select class="form-control selectpicker" name="id_position" id="id_position" data-live-search="true"  required>
     <option value="" selected>--Choisir la position--</option>
   <?php
            while($donnne = $position->fetch())
            {
    ?>
            <option value="<?=$donnne['id_position']?>"><?=$donnne['lib_position']?></option>
    <?php
            }
        ?>
            </select>
            <?php
            }

}else
{
?>
<select class="form-control selectpicker" name="id_position" id="id_position" data-live-search="true"  required>
     <option value="" selected>--Aucune identification choisi--</option>
</select>
<?php
}
    ?>
<script type="text/javascript">            
            $('.selectpicker').selectpicker();
</script>