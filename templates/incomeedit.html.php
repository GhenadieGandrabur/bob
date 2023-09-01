<h1>Incomes</h1>
<div style="text-align:center">
    <form action="" method="post" class="forall">

        <input type="hidden" name="income[id]" value="<?=$income->id ?? ''?>">    
        <input type="date" id='date' name="income[date]" value = "<?=$income->date??""?>" placeholder="date">

        <select id="currency_id" name="income[currency_id]">
            <option value="">Select Currency</option>
            <?php foreach ($currencies as $currency): ?>
            <option value="<?= $currency['id'] ?>"
            <?php if (isset($income) && $income['currency_id'] == $currency['id']): ?>
            selected
            <?php endif; ?>>
            <?= $currency['name'] ?>
            </option>
            <?php endforeach; ?>
        </select>      

        <input type="Rate" id='rate' name="income[rate]" value = "<?=$income->rate??""?>" placeholder="rate" size="5"> 
        <input type="facevalue" id='facevalue' name="income[facevalue]" value = "<?=$income->facevalue??""?>" placeholder="facevalue" size="5">
        <input id="quantity" name="income[quantity]" value="<?=$income->quantity??""?>" placeholder="quantity" size="5">    
        <input id="amount" name="income[amount]" value="<?=$income->amount??""?>" placeholder="amount" size="5"> 
        <input id="summ" name="income[summ]" value="<?=$incomes->summ??""?>" placeholder="summ" size="10">

        <div style="margin-top: 20px;">
            <input type="submit" name="submit" value="Save">
        </div>
    </form>
</div>
