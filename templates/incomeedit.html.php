<h1>Incomes</h1>
<div style="text-align:center">
    <form action="" method="post" class="forall">

        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
        <input type="date" id='date' name="income[created]" value="<?= $income->date ?? "" ?>" placeholder="date">
        <?php foreach($facevalues as $facevalue):?>
        <div class="facevalue">
            <select id="currency_id" name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                        <?= $currency['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text"  name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate" size="5">
            <input type="text"  name="income[facevalue][]" value="<?= $facevalue->facevalue ?? "" ?>" placeholder="facevalue" size="5">
            <input type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity" size="5" oninput="calculateSumm()">
            <input type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount" size="5">
            <input type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ" size="10">
        </div>
        <?php endforeach;?>
        <div class="facevalue">
            <select id="currency_id" name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" >
                        <?= $currency['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text"  name="income[rate][]"  placeholder="rate" size="5">
            <input type="text"  name="income[facevalue][]"  placeholder="facevalue" size="5">
            <input type="text" name="income[quantity][]"  placeholder="quantity" size="5" oninput="calculateSumm()">
            <input type="text" name="income[amount][]"  placeholder="amount" size="5">
            <input type="text" name="income[summ][]"  placeholder="summ" size="10">
        </div>
        <div style="margin-top: 20px;">
            <input type="submit" name="submit" value="Save">
        </div>
    </form>
</div>

<script>
    
        function calculateSumm() {
    
        var quantity = parseFloat(document.getElementById('quantity').value) || 0;
        var facevalue = parseFloat(document.getElementById('facevalue').value) || 0;

        var amount = quantity * facevalue;

        document.getElementById('amount').value = amount;
      
        var rate = parseFloat(document.getElementById('rate').value) || 0;
        var amount = parseFloat(document.getElementById('amount').value) || 0;
      
        var summ = rate * amount;
     
        document.getElementById('summ').value = summ;

        function addRow() {
            var tableBody = document.querySelector('#incomeTable tbody');
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = '<input type="number" class="quantity" oninput="calculateRowAmount(this)">';
            cell2.innerHTML = '<input type="number" class="row-amount">';
            cell3.innerHTML = '<input type="number" class="rate" oninput="calculateRowSumm(this)">';
            cell4.innerHTML = '<input type="number" class="row-summ">';           
        }
    }

    document.getElementById('currency_id').addEventListener('change', e=>{
        const currency_id = e.target.value
        const currency_name = e.target.querySelector(`option[value="${currency_id}"]`).innerText.trim()
        console.log(currency_name)
        fetch('/rate/last').then(res=>res.json()).then(json=>document.getElementById('rate').value=json[currency_name])
    })
</script>