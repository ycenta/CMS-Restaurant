<form method="<?= $data["config"]["method"]??"POST" ?>"  action="<?= $data["config"]["action"]??"" ?>">

    <?php foreach ($data["inputs"] as $name=>$input) :?>

    <!-- <label for="$name">$name</label> -->
    <?php if(isset($input['label'])){ ?>

        <label for="<?= $input['label'];?>"><?= $input['label'];?> :</label>

    <?php };?>

    <?php if(!isset($input['radiolist'])){ ?>

        <input
                type="<?= $input["type"]??"text" ?>"
                name="<?= $name?>"
                placeholder="<?= $input["placeholder"]??"" ?>"
                id="<?= $input["id"]??"" ?>"
                class="<?= $input["class"]??"" ?>"
                value="<?= $input["value"]??"" ?>"
                <?= empty($input["required"])?"":'required="required"' ?>
        >        <?php echo $input["type"]=='hidden' ? '' :'<br>' ;?>


    <?php }else{  
            echo '<br>';
            foreach($input['radiolist'] as $nameradio =>$radio){ 
                
                ?>
    
                <label for="<?= $name;?>"><?= $nameradio;?></label>
                <input
                type="<?= $input["type"]??"text" ?>"
                name="<?= $name?>"
                class="<?= $input["class"]??"" ?>"
                value="<?= $radio??"" ?>"
                <?= empty($input["required"])?"":'required="required"' ?>
                <?= (isset($input['radioChecked']) && $input['radioChecked'] == $radio) ? 'checked':''  ?>
                ><br>   
                
    <?php 
            };
        }; ?>     
    <?php endforeach;?>

    <input <?= (isset($data["config"]["buttonClass"]) ? 'class="'.$data["config"]["buttonClass"].'"' :''); ?> type="submit" value="<?= $data["config"]["submit"]??"Valider" ?>">
</form>
