<h1>Incomes</h1>
<div>
<form action="" method="post">
    <div>
        <input type="hidden" name="income[id]" value="<?=$income->id ?? ''?>">    
        <input type="date" id='date' name="income[date]" value = "<?=$income['date']??""?>" placeholder="date">
         
        <input type="Rate" id='rate' name="income[rate]" value = "<?=$income['rate']??""?>" placeholder="rate" size="5">    
<select id="currency_id" name="income[currency_id]">
<?php foreach ($currencies as $currency): ?>
<option value="<?= $currency['id'] ?>" <?= ($income['currency_id'] == $currency['id']) ? 'selected' : '' ?>>
<?= $currency['name'] ?>
</option>
<?php endforeach; ?>
</select>
      
        
       
        <input type="facevalue" id='facevalue' name="income[facevalue]" value = "<?=$income->facevalue??""?>" placeholder="facevalue" size="5">
        <input id="quantity" name="income[quantity]" value="<?=$income->quantity??""?>" placeholder="quantity" size="5">    
        <input id="amount" name="income[amount]" value="<?=$income->amount??""?>" placeholder="amount" size="5"> 
        <input id="summ" name="income[summ]" value="<?=$income->summ??""?>" placeholder="summ" size="5">
    </div>
    
<div style="margin-top: 20px;">
<input type="submit" name="submit" value="Save">
</div>
</form>
</div>
