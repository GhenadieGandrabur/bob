<div style="width:60%; margin:auto;">
    <h1>Incomes</h1>
    
    <form action="/income/edit" method="post" class="forall" >

        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
        <div style="padding-bottom:10px"><input type="date" id='date' name="income[created]" 
            value="<?=date('Y-m-d', ($income->created ?? false) ? strtotime($income->created) : time())?>" readonly></div>      
               
        <div id="facevaluewrapper">
        <?php foreach($facevalues as $facevalue):?>
            <div class="facevalue">
                <select class="currency" name="income[currency_id][]" >
                    <option value="">Select Currency</option>
                    <?php foreach ($currencies as $currency) : ?>
                        <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                            <?= $currency['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input class="rate" type="text"  name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate" size="5" readonly>
                <input class="facevalue" type="text"  name="income[facevalue][]" value="<?= $facevalue->facevalue ?? "" ?>" placeholder="facevalue" size="5" oninput="calculateSumm(this)">
                <input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity" size="5" oninput="calculateSumm(this)">
                <input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount" size="5" readonly>
                <input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ" size="10" readonly>
                <a href="#" class="deleterow" >❌</a>
            </div>
            <?php endforeach;?>
            
        </div>
        <div class="total" style="margin-left:562px;">           
            <input type="text" id="totalamount" name="income[total_amount]" placeholder="Total amount" value="<?=$totalAmount ?? '' ?>"  style="font-weight:bold; text-align:right;">            
        </div>      
       <div><button id="addfacevalue">Add facevalue</button></div>
        <div style="margin-top: 20px;">
            <input type="submit" name="submit" value=" Save"><div id="four" style="float:right; margin-right:160px; color:red;"><?=$totalAmount/4?></div>           
        </div>       
    </form>
</div>

<script>    
    function calculateSumm(el) {    
        let quantity = parseFloat(el.parentNode.querySelector('.quantity').value) || 0;
        let facevalue = parseFloat(el.parentNode.querySelector('.facevalue').value) || 0;
        let amount = quantity * facevalue;
        el.parentNode.querySelector('.amount').value = amount;
        let rate = parseFloat(el.parentNode.querySelector('.rate').value) || 0; 
        console.log(rate, quantity, facevalue, amount, rate*amount)       
        el.parentNode.querySelector('.summ').value = rate*amount; 
        totalAmountRecalc()
    }
    function totalAmountRecalc()
    {
        let totalAmount = 0         
        document.querySelectorAll('.summ').forEach(summ=> totalAmount+= parseFloat(summ.value) || 0)
        document.getElementById('totalamount').value = totalAmount.toFixed(0)
        let four = (totalAmount / 4).toFixed(0);
        document.getElementById('four').innerText = four;

    }
    document.addEventListener('change', e=>{
        if(e.target.classList.contains('currency'))
        {
            const currency_id = e.target.value
            const currency_name = e.target.querySelector(`option[value="${currency_id}"]`).innerText.trim()
            console.log(currency_name)
            fetch('/rate/last').then(res=>res.json()).then(json=>{
                e.target.parentNode.querySelector('.rate').value=json[currency_name]
                calculateSumm(e.target)
            })
        }
    })
    
    document.addEventListener('click', e=>{
        if(e.target.classList.contains('deleterow')){
            e.preventDefault()
            e.target.parentNode.remove()
            totalAmountRecalc()
        }
    })
   

    const faceValueRow = `
            <select class="currency" name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" ><?= $currency['name'] ?></option>
                <?php endforeach; ?>        
            </select>
            <input class="rate" type="text" name="income[rate][]" placeholder="rate" size="5" readonly="">
            <input class="facevalue" type="text" name="income[facevalue][]" placeholder="facevalue" size="5" oninput="calculateSumm(this)">
            <input class="quantity" type="text" name="income[quantity][]" placeholder="quantity" size="5" oninput="calculateSumm(this)" autocomplete="off">
            <input class="amount" type="text" name="income[amount][]" placeholder="amount" size="5" readonly="">
            <input class="summ" type="text" name="income[summ][]" placeholder="summ" size="10" readonly="">
            <a href="#" class="deleterow" >❌</a>
        `
    document.getElementById('addfacevalue').addEventListener('click', e=>{
        e.preventDefault()
        const wrapper = document.getElementById('facevaluewrapper')
        const div = document.createElement('div')
        div.setAttribute('class', 'facevalue')
        div.innerHTML = faceValueRow
        wrapper.append(div)
    })

</script>