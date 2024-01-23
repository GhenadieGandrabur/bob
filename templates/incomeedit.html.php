<div style="width:60%; margin:auto;">
    <h1>Incomes</h1>
    
    <form action="/income/edit" method="post" class="forall">

        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
        <div style="padding-bottom:10px"><input type="date" id='date' name="income[created]" value="<?= $income->created ?? "" ?>" placeholder="date"></div>
       
               
        
        <?php foreach($facevalues as $facevalue):?>
        <div class="facevalue">
            <select class="currency" name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                        <?= $currency['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input class="rate" type="text"  name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate" size="5">
            <input class="facevalue" type="text"  name="income[facevalue][]" value="<?= $facevalue->facevalue ?? "" ?>" placeholder="facevalue" size="5">
            <input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity" size="5" oninput="calculateSumm(this)">
            <input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount" size="5">
            <input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ" size="10">
            <a href="#" class="deleterow" >❌</a>
        </div>
        <?php endforeach;?>
        <div class="facevalue">
            <select class="currency" name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" >
                        <?= $currency['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input class="rate" type="text"  name="income[rate][]"  placeholder="rate" size="5">
            <input class="facevalue" type="text"  name="income[facevalue][]"  placeholder="facevalue" size="5">
            <input class="quantity" type="text" name="income[quantity][]"  placeholder="quantity" size="5" oninput="calculateSumm(this)">
            <input class="amount" type="text" name="income[amount][]"  placeholder="amount" size="5">
            <input class="summ" type="text" name="income[summ][]"  placeholder="summ" size="10">
        </div>
        <div style="margin-top: 20px;">
            <input type="submit" name="submit" value="Save">
        </div>
    </form>
</div>

<script>
    
    function calculateSumm(el) {
    
        let quantity = parseFloat(el.value) || 0;
        let facevalue = parseFloat(el.parentNode.querySelector('.facevalue').value) || 0;
        let amount = quantity * facevalue;
        el.parentNode.querySelector('.amount').value = amount;
        let rate = parseFloat(el.parentNode.querySelector('.rate').value) || 0;
        // amount = parseFloat(el.parentNode.querySelector('.amount').value) || 0;
      
        //let summ = rate * amount;     
        el.parentNode.querySelector('.summ').value = rate*amount;        
    }

    document.querySelectorAll('.currency').forEach(currency=>{
        currency.addEventListener('change', e=>{
            const currency_id = e.target.value
            const currency_name = e.target.querySelector(`option[value="${currency_id}"]`).innerText.trim()
            console.log(currency_name)
            fetch('/rate/last').then(res=>res.json()).then(json=>e.target.parentNode.querySelector('.rate').value=json[currency_name])
        })
    })

    document.querySelectorAll('.deleterow').forEach(btn=>{
        btn.addEventListener("click", e=>{
            e.preventDefault()
            e.target.parentNode.remove()
        })
    })
</script>