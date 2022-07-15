<form method="<?= $data["config"]["method"]??"POST" ?>"  action="<?= $data["config"]["action"]??"" ?>" <?= isset($data['inputs']['picture'])?'enctype="multipart/form-data"':'' ?>>

    <?php foreach ($data["inputs"] as $name=>$input) :?>

    <!-- <label for="$name">$name</label> -->
    <?php if(isset($input['label'])){ ?>

        <label for="<?= $input['label'];?>"><?= $input['label'];?> :</label>

    <?php };?>

    <?php 
        if(isset($input['type'])){
            if($input['type'] == 'file'){ 
                echo '<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />';
            }
        }
    ?>

    <?php
        if(isset($input['type']) && $input['type'] == 'file' && isset($data["images"])){
            foreach ($data["images"] as $img_name=>$img) {
                if ($img["input"] == $name) {
                    echo '<img src="' . $img["from"] . $img["value"] . '"><br>';
                }
            }

        } 

        if(isset($input["type"]) && $input["type"] == "textarea"){ ?>

            <textarea
                name="<?= $name?>"
                placeholder="<?= $input["placeholder"]??"" ?>"
                id="<?= $input["id"]??"" ?>"
                class="<?= $input["class"]??"" ?>"
                <?= empty($input["required"])?"":'required="required"' ?>
            ><?= $input["value"]??"" ?></textarea><br>

        <?php } else if(!isset($input['radiolist'])){ ?>
   
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
