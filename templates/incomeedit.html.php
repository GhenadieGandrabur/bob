<div style="width:60%; margin:auto;">
    <h1>Incomes</h1>
    
    <form action="/income/edit" method="post" class="forall" >

        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
        <div style="padding-bottom:10px"><input type="date" id='date' name="income[created]" 
            value="<?=date('Y-m-d', ($income->created ?? false) ? strtotime($income->created) : time())?>" readonly></div>      
               
        <div id="facevaluewrapper">
            <div id="facevalue_table">
                <div class="thead">
                    <div>currency</div>
                    <div>rate</div>
                    <div>facevalue</div>
                    <div>quantity</div>
                    <div>amount</div>
                    <div>summ</div>
                    <div></div>
                </div>
                <div class="tbody">
                    <?php foreach($facevalues as $facevalue):?>
                    <div class="facevalue" >
                        <div>
                            <select class="currency" name="income[currency_id][]" >
                                <option value="">Currency</option>
                                <?php foreach ($currencies as $currency) : ?>
                                    <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                                        <?= $currency['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <input class="rate" type="text"  name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate"  readonly>
                        </div>
                        <div>
                            <input class="facevalue" type="text"  name="income[facevalue][]" value="<?= $facevalue->facevalue ?? "" ?>" placeholder="facevalue"  oninput="calculateSumm(this)">
                        </div>
                        <div>
                            <input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity"  oninput="calculateSumm(this)">
                        </div>
                        <div>
                            <input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount"  readonly>
                        </div>
                        <div>
                            <input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ"  readonly>
                        </div>
                        <div style="border:1px solid; padding:3px;">
                            <a href="#" class="deleterow ml1" >&nbsp; ❌</a>
                        </div>
                    </div>                    
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="total" style="margin-left:513px;">           
            <input type="text" id="totalamount" name="income[total_amount]" placeholder="Total amount" value="<?=$totalAmount ?? '' ?>"  style="font-weight:bold; text-align:right;">            
        </div>      
       <div class="linkbuttonorange" id="addfacevalue">Add facevalue</button></div>
        <div style="margin-top: 20px;">
            <input type="submit" name="submit" value=" Save" class="subgreen"><div id="four" style="float:right; margin-right:160px; color:red;"><?=$totalAmount/4?></div>           
        </div>       
    </form>
</div>

<script>    
    function calculateSumm(el) {    
        let quantity = parseFloat(el.parentNode.parentNode.querySelector('.quantity').value) || 0;
        let facevalue = parseFloat(el.parentNode.parentNode.querySelector('.facevalue').value) || 0;
        let amount = quantity * facevalue;
        el.parentNode.parentNode.querySelector('.amount').value = amount;
        let rate = parseFloat(el.parentNode.parentNode.querySelector('.rate').value) || 0;       
        el.parentNode.parentNode.querySelector('.summ').value = rate*amount; 
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
                e.target.parentNode.parentNode.querySelector('.rate').value=json[currency_name]
                calculateSumm(e.target)
            })
        }
    })
    
    document.addEventListener('click', e=>{
        if(e.target.classList.contains('deleterow')){
            e.preventDefault()
            e.target.parentNode.parentNode.remove()
            totalAmountRecalc()
        }
    })
   

    const faceValueRow = `
            <div>
                <select class="currency" name="income[currency_id][]" >
                    <option value="">Select Currency</option>
                    <?php foreach ($currencies as $currency) : ?>
                        <option value="<?= $currency['id'] ?>" ><?= $currency['name'] ?></option>
                    <?php endforeach; ?>        
                </select>
            </div>
            <div><input class="rate" type="text" name="income[rate][]" placeholder="rate"  readonly=""></div>
            <div><input class="facevalue" type="text" name="income[facevalue][]" placeholder="facevalue"  oninput="calculateSumm(this)"></div>
            <div><input class="quantity" type="text" name="income[quantity][]" placeholder="quantity"  oninput="calculateSumm(this)" autocomplete="off"></div>
            <div><input class="amount" type="text" name="income[amount][]" placeholder="amount"  readonly=""></div>
            <div><input class="summ" type="text" name="income[summ][]" placeholder="summ"  readonly=""></div>
            <div><a href="#" class="deleterow" >❌</a></div>
        `
    document.getElementById('addfacevalue').addEventListener('click', e=>{
        e.preventDefault()
        const wrapper = document.getElementById('facevaluewrapper')
        const div = document.createElement('div')
        div.setAttribute('class', 'facevalue')
        div.innerHTML = faceValueRow
        wrapper.querySelector('.tbody').append(div)
    })

</script>