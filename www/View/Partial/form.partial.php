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

        <?php } else if(!isset($input['radiolist']) && !isset($input['optionlist'])){ ?>

   
        <input
                type="<?= $input["type"]??"text" ?>"
                name="<?= $name?>"
                placeholder="<?= $input["placeholder"]??"" ?>"
                id="<?= $input["id"]??"" ?>"
                class="<?= $input["class"]??"" ?>"
                value="<?= $input["value"]??"" ?>"
                <?= empty($input["required"])?"":'required="required"' ?>
        ><br>

    <?php }else if(isset($input['optionlist'])){
            echo '<br>'; ?>
                

            <select name="<?= $name?>" 
                class="<?= $input["class"]??"" ?>" 
                <?= empty($input["required"])?"":'required="required"' ?>
            >
            <?php
            foreach($input['optionlist'] as $select_name =>$option){ 
                var_dump($select_name);?>
    
                <option
                    value="<?= $option??"" ?>"
                    <?= (isset($input['optionSelected']) && $input['optionSelected'] == $option) ? 'selected':''  ?>
                >
                    <?= $select_name; ?>
                </option>  
    <?php
            }; ?>
            </select><br>

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

    <input type="submit" value="<?= $data["config"]["submit"]??"Valider" ?>">
</form>
