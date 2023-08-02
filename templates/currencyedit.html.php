<div class="smalltable">
<h1><?=$header?></h1>
<form action="" method="post" class="forall">
	<input type="hidden" name="currency[id]" value="<?=$currency->id ?? ''?>">  

    <label for="currencyname">Name</label>
    <input id="currencyname" name="currency[name]" value="<?=$currency->name ??""?>">    

    <input type="submit" name="submit" value="Save">
</form>
</div>
