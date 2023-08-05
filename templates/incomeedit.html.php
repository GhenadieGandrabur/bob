<div class="smalltable">
<h1><?=$header?></h1>
<form action="" method="post" class="forall">
	<input type="hidden" name="incame[id]" value="<?=$incame->id ?? ''?>"> 

    <label for="date">Date</label>
    <input type="date" id='date' name="incame[date]" value = "<?=$incame->date??""?>" >

    <label for="curency">Date</label>
    <input type="currency" id='curency' name="incame[date]" value = "<?=$incame->date??""?>" >

    <label for="date">Date</label>
    <input type="date" id='date' name="incame[date]" value = "<?=$incame->date??""?>" >

    <label for="date">Date</label>
    <input type="date" id='date' name="incame[date]" value = "<?=$incame->date??""?>" >

    <label for="incamecurrency_id">Currency</label>
    <select name="incame[currency_id]" id="currency_id">
        <?php if ($currencies): ?>
            <?php foreach ($incames as $incame): ?>
                <option value="<?= $currency->id ?>" <?= ($incame && $incame->currency_id == $currency->id) ? 'selected' : '' ?>>
                    <?= $currency->name ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled>No currencies available</option>
        <?php endif; ?>
    </select>
  
    <label for="incameincame">incame</label>
    <input id="incameincame" name="incame[incame]" value="<?=$incame->incame ??""?>">    

    <input type="submit" name="submit" value="Save">
</form>
</div>
