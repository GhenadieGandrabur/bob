<div class="smalltable">
<h1><?=$header?></h1>
<form action="" method="post" class="forall">
	<input type="hidden" name="rate[id]" value="<?=$rate->id ?? ''?>">     
    <label for="date">Date</label>
    <input type="date" id='date' name="rate[date]" value = "<?=$rate->date??""?>" >
    <label for="ratecurrency_id">Currency</label>
    <select name="rate[currency_id]" id="currency_id">
        <?php if ($currencies): ?>
            <?php foreach ($currencies as $currency): ?>
                <option value="<?= $currency->id ?>" <?= ($rate && $rate->currency_id == $currency->id) ? 'selected' : '' ?>>
                    <?= $currency->name ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled>No currencies available</option>
        <?php endif; ?>
    </select>
  
    <label for="raterate">Rate</label>
    <input id="raterate" name="rate[rate]" value="<?=$rate->rate ??""?>">    

    <input type="submit" name="submit" value="Save">
</form>
</div>
