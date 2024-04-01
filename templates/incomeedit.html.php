<div style="width: 100%; margin:auto;">
<div class="f fjb">
    <h1 class="f1">Incomes </h1><h1 style=" color:red" id="totalsumm"><?=$totalAmount?></h1><h1 style="background-color:red; color:white" id="four"> <?= number_format($totalAmount / 4, 0, ',', ' ') ?></h1>
</div>
<div>
    <form action="/income/edit" method="post" class="forall">

        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
        <div style="padding-bottom:10px">
            <input type="date" id='date' name="income[created]" value="<?= date('Y-m-d', ($income->created ?? false) ? strtotime($income->created) : time()) ?>" readonly style="padding:8px; border:none;">
        </div>

        <div id="facevaluewrapper">
            <?php foreach ($facevalues as $facevalue) : ?>
                <div class="facevalue f">
                    <div><select class="currency" name="income[currency_id][]">                      
                        <?php foreach ($currencies as $currency) : ?>
                            <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                                <?= $currency['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div><input class="rate" type="text" name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate" readonly></div>
                    <div><input class="facevalue" type="text" name="income[facevalue][]" value="<?= $facevalue->facevalue ?? "" ?>" placeholder="facevalue" oninput="calculateSumm(this)"></div>
                    <div><input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity" oninput="calculateSumm(this)"></div>
                    <div><input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount" readonly></div>
                    <div><input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ" readonly></div>
                    <div class=" p05">
                        <a href="#" class="deleterow">❌</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="f fjb mt1">
            <div class="linkbuttonorange" id="addfacevalue" >
                Add a row
            </div>
            <div class="f fend fc fg1">
                <div style="flex-grow: 1; display: flex; justify-content: flex-end;">
                    <input type="text" id="totalamount" name="income[total_amount]" value="<?= $totalAmount ?? '' ?>" class="nb fs20">
                </div>
                
            </div>
        </div>
        <div class="mt1 tr">
            <input type="submit" name="submit" value=" Save" class="butonsubmit">
        </div>
    </form>
    </div>
</div>

<script>
    function calculateSumm(el) {
        let quantity = parseFloat(el.parentNode.querySelector('.quantity').value) || 0;
        let facevalue = parseFloat(el.parentNode.querySelector('.facevalue').value) || 0;
        let amount = quantity * facevalue;
        el.parentNode.querySelector('.amount').value = amount;
        let rate = parseFloat(el.parentNode.querySelector('.rate').value) || 0;
        console.log(rate, quantity, facevalue, amount, rate * amount)
        el.parentNode.querySelector('.summ').value = rate * amount;
        totalAmountRecalc()
    }

    function totalAmountRecalc() {
        let totalAmount = 0
        let totalsumm = 0
        document.querySelectorAll('.summ').forEach(summ => totalAmount += parseFloat(summ.value) || 0)
        document.getElementById('totalamount').value = totalAmount.toFixed(0)
        document.getElementById('totalsumm').innerText  = totalAmount.toFixed(0)
        let four = (totalAmount / 4).toFixed(0);
        document.getElementById('four').innerText = four;
    }
    document.addEventListener('change', e => {
        if (e.target.classList.contains('currency')) {
            const currency_id = e.target.value
            const currency_name = e.target.querySelector(`option[value="${currency_id}"]`).innerText.trim()
            console.log(currency_name)
            fetch('/rate/last').then(res => res.json()).then(json => {
                e.target.parentNode.querySelector('.rate').value = json[currency_name]
                calculateSumm(e.target)
            })
        }
    })

    document.addEventListener('click', e => {
        if (e.target.classList.contains('deleterow')) {
            e.preventDefault()
            e.target.parentNode.remove()
            totalAmountRecalc()
        }
    })


    const faceValueRow = `               
            <select class="currency" name="income[currency_id][]">                
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" <?= $currency['id'] == 1 ? 'selected' : '' ?>><?= $currency['name'] ?></option>
                <?php endforeach; ?>        
            </select>
            <input class="rate" type="text" name="income[rate][]" placeholder="rate"  readonly="" value="1.00">
            <input class="facevalue" type="text" name="income[facevalue][]" placeholder="facevalue"  oninput="calculateSumm(this)">
            <input class="quantity" type="text" name="income[quantity][]" placeholder="quantity"  oninput="calculateSumm(this)" autocomplete="off">
            <input class="amount" type="text" name="income[amount][]" placeholder="amount"  readonly="">
            <input class="summ" type="text" name="income[summ][]" placeholder="summ" size="10" readonly="">
            <a href="#" class="deleterow" >❌</a>            
        `
    document.getElementById('addfacevalue').addEventListener('click', e => {
        e.preventDefault()
        const wrapper = document.getElementById('facevaluewrapper')
        const div = document.createElement('div')
        div.setAttribute('class', 'facevalue')
        div.innerHTML = faceValueRow
        wrapper.append(div)
        div.querySelector('.facevalue').focus();
    })
</script>