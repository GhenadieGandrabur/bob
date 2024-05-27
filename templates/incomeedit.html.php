<div style="width: 100%; margin:auto;">
    <div class="f fjb">
        <h1 class="f1">Incomes</h1>
        <h1 style="color:red" id="totalsumm"><?= $totalAmount ?></h1>
        <h1 style="background-color:red; color:white" id="four"><?= number_format($totalAmount / 4, 0, ',', ' ') ?></h1>
    </div>

    <div>
        <form action="/income/edit" method="post" class="forall">
            <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">
            <div style="padding-bottom:10px">
                <input type="date" id='date' name="income[created]" value="<?= date('Y-m-d', ($income->created ?? false) ? strtotime($income->created) : time()) ?>" readonly style="padding:8px; border:none;">
            </div>

            <table style="width:100%; border:1px solid red">
                <thead>
                    <tr>
                        <th>Currency</th>
                        <th>Rate</th>
                        <th>Denomination</th>
                        <th>QTY</th>
                        <th>Currency amount</th>
                        <th>Lei amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="facevaluewrapper">
                    <?php foreach ($facevalues as $facevalue) : ?>
                        <tr class="facevalue ">
                            <td>
                                <select class="currency" name="income[currency_id][]">
                                    <?php foreach ($currencies as $currency) : ?>
                                        <option value="<?= $currency['id'] ?>" <?php if ($facevalue->currency_id == $currency['id']) : ?> selected <?php endif; ?>>
                                            <?= $currency['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input class="rate" type="text" name="income[rate][]" value="<?= $facevalue->rate ?? "" ?>" placeholder="rate" readonly></td>
                            <td>
                                <select class="facevalue" name="income[facevalue][]">
                                    <option value="5" <?= $facevalue->facevalue == 5 ? 'selected' : '' ?>>5</option>
                                    <option value="10" <?= $facevalue->facevalue == 10 ? 'selected' : '' ?>>10</option>
                                    <option value="20" <?= $facevalue->facevalue == 20 ? 'selected' : '' ?>>20</option>
                                    <option value="50" <?= $facevalue->facevalue == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $facevalue->facevalue == 100 ? 'selected' : '' ?>>100</option>
                                    <option value="200" <?= $facevalue->facevalue == 200 ? 'selected' : '' ?>>200</option>
                                    <option value="500" <?= $facevalue->facevalue == 500 ? 'selected' : '' ?>>500</option>
                                    <option value="1000" <?= $facevalue->facevalue == 1000 ? 'selected' : '' ?>>1000</option>
                                </select>
                            </td>
                            <td><input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? "" ?>" placeholder="quantity" oninput="calculateSumm(this)"></td>
                            <td><input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? "" ?>" placeholder="amount" readonly></td>
                            <td><input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? "" ?>" placeholder="summ" readonly></td>
                            <td><a href="#" class="deleterow">❌</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="f fjb mt1">
                <div class="linkbuttonorange" id="addfacevalue">Add a row</div>
                <div class="f fend fc fg1">
                    <div style="flex-grow: 1; display: flex; justify-content: flex-end;">
                        <input type="text" id="totalamount" name="income[total_amount]" value="<?= $totalAmount ?? '' ?>" class="nb fs20">
                    </div>
                </div>
            </div>

            <div class="mt1 tr">
                <input type="submit" name="submit" value=" Save" style="width:10%; background:green; color:white; border:none;">
            </div>
        </form>
    </div>
</div>

<script>
function calculateSumm(el) {
    let row = el.closest('tr');
    let quantity = parseFloat(row.querySelector('.quantity').value) || 0;
    let facevalue = parseFloat(row.querySelector('.facevalue').value) || 0;
    let amount = quantity * facevalue;
    row.querySelector('.amount').value = amount;
    let rate = parseFloat(row.querySelector('.rate').value) || 0;
    row.querySelector('.summ').value = rate * amount;
    totalAmountRecalc();
}

function totalAmountRecalc() {
    let totalAmount = 0;
    document.querySelectorAll('.summ').forEach(summ => totalAmount += parseFloat(summ.value) || 0);
    document.getElementById('totalamount').value = totalAmount.toFixed(0);
    document.getElementById('totalsumm').innerText = totalAmount.toFixed(0);
    document.getElementById('four').innerText = (totalAmount / 4).toFixed(0);
}

document.addEventListener('change', e => {
    if (e.target.classList.contains('currency')) {
        const currency_id = e.target.value;
        const currency_name = e.target.querySelector(`option[value="${currency_id}"]`).innerText.trim();
        fetch('/rate/last').then(res => res.json()).then(json => {
            e.target.closest('tr').querySelector('.rate').value = json[currency_name];
            calculateSumm(e.target);
        });
    }
});

document.addEventListener('click', e => {
    if (e.target.classList.contains('deleterow')) {
        e.preventDefault();
        e.target.closest('tr').remove();
        totalAmountRecalc();
    }
});

const faceValueRow = `
    <tr class="facevalue f">
        <td>
            <select class="currency" name="income[currency_id][]">
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>" <?= $currency['id'] == 1 ? 'selected' : '' ?>><?= $currency['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input class="rate" type="text" name="income[rate][]" placeholder="rate" readonly="" value="1.00"></td>
        <td>
            <select class="facevalue" name="income[facevalue][]">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
        </td>
        <td><input class="quantity" type="text" name="income[quantity][]" placeholder="quantity" oninput="calculateSumm(this)" autocomplete="off"></td>
        <td><input class="amount" type="text" name="income[amount][]" placeholder="amount" readonly=""></td>
        <td><input class="summ" type="text" name="income[summ][]" placeholder="summ" readonly=""></td>
        <td><a href="#" class="deleterow">❌</a></td>
    </tr>
`;

document.getElementById('addfacevalue').addEventListener('click', e => {
    e.preventDefault();
    const wrapper = document.getElementById('facevaluewrapper');
    const row = document.createElement('tr');
    row.innerHTML = faceValueRow;
    wrapper.append(row);
});
</script>

<style>
table, td, th {  
  border: 1px solid #999;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  padding: 10px;
  background-color: #f2f2f2;
  color: #111;
}

input, select {
  width: 100%;
  box-sizing: border-box;
  outline: none;
  border: none;
}
</style>
