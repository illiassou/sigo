<?php
if(isset($_GET['add_position']))
{
    $lib_position = $_GET['lib_position'];
    $id_identification = $_GET['id_identification'];
    $add_position_ = add_position($lib_position,$id_identification);
    var_dump($add_position_);
if($add_position_ == true)
{
    $msg = 1;
?>
<script type="text/javascript">
    $("#lib_position").val('');	
    $("#id_identification").val('');	
</script>
<?php
}else
{
    $msg = 2;
}
}
?>