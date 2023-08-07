<h1>Incomes</h1>
<div>
<form action="" method="post">
    <div class="incomesedit">
        <input type="hidden" name="income[id]" value="<?=$income->id ?? ''?>">    
        <input type="date" id='date' name="income[date]" value = "<?=$income->date??""?>" placeholder="date">
        <!-- <select name="income[currency_id]" id="currency_id">
            <?php if ($incomes): ?>
                <?php foreach ($incomes as $income): ?>
                    <option value="<?= $currencies->id ?>" <?= ($income && $income->currency_id == $currencies->id) ? 'selected' : '' ?>>
                        <?= $currencies->name ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="" disabled>No currencies available</option>
            <?php endif; ?>
        </select>     -->
        <input type="Rate" id='rate' name="income[rate]" value = "<?=$income->rate??""?>" placeholder="rate">    
        <input type="facevalue" id='facevalue' name="income[facevalue]" value = "<?=$income->facevalue??""?>" placeholder="facevalue">
        <input id="quantity" name="income[quantity]" value="<?=$income->quantity??""?>" placeholder="quantity">    
        <input id="amount" name="income[amount]" value="<?=$income->amount??""?>" placeholder="amount"> 
        <input id="summ" name="income[summ]" value="<?=$income->summ??""?>" placeholder="summ">
    </div>
<div>
<input type="submit" name="submit" value="Save">
</div>
</form>
</div>
