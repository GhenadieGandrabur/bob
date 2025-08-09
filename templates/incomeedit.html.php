<div style="width: 80%; margin:auto; ">
    <div class="f fjb">
        <h1 class="f1">Incomes</h1>
        <h1 style="color:red" id="totalsumm"><?= number_format((float)($totalAmount ?? 0), 0, ',', ' ') ?></h1>
        <h1 style="background-color:red; color:white; padding:0 15px;" id="four"><?= number_format((float)($totalAmount ?? 0) / 4, 0, ',', ' ') ?></h1>
    </div>

    <form action="/income/edit" method="post" class="forall">
        <input type="hidden" name="income[id]" value="<?= $income->id ?? '' ?>">

        <div style="padding-bottom:10px">
            <input type="date" id="date" name="income[created]" value="<?= date('Y-m-d', ($income->created ?? false) ? strtotime($income->created) : time()) ?>" readonly style="padding:8px; border:none;">
        </div>

        <table  class="main-table">
            <thead>
                <tr>
                    <th>Currency</th>
                    <th>Rate</th>
                    <th>Denomination</th>
                    <th>QTY</th>
                    <th>Currency amount</th>
                    <th>Lei amount</th>
                </tr>
                        </thead>
                        <tbody id="facevaluewrapper">
                <?php if (empty($facevalues)): ?>
                    <tr class="facevalue">
                        <td>
                <select class="currency" name="income[currency_id][]">
                    <?php
                    foreach ($currencies as $currency) {
                        $selected = $currency['id'] == 1 ? 'selected' : '';
                        echo "<option value=\"{$currency['id']}\" $selected>{$currency['name']}</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input class="rate" type="text" name="income[rate][]" value="1" readonly></td>
            <td>
                <select class="facevalue" name="income[facevalue][]">
                    <?php foreach ([5,10,20,50,100,200,500,1000] as $v): ?>
                        <option value="<?= $v ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input class="quantity" type="text" name="income[quantity][]" oninput="calculateSumm(this)"></td>
            <td><input class="amount" type="text" name="income[amount][]" readonly></td>
            <td><input class="summ" type="text" name="income[summ][]" readonly></td>
        </tr>
    <?php else: ?>
        <?php foreach ($facevalues as $facevalue): ?>
            <tr class="facevalue">
                <td>
                    <select class="currency" name="income[currency_id][]">
                        <?php
                        foreach ($currencies as $currency) {
                            $selected = $currency['id'] == $facevalue->currency_id ? 'selected' : '';
                            echo "<option value=\"{$currency['id']}\" $selected>{$currency['name']}</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input class="rate" type="text" name="income[rate][]" value="<?= $facevalue->rate ?? 0 ?>" readonly></td>
                <td>
                    <select class="facevalue" name="income[facevalue][]">
                        <?php foreach ([5,10,20,50,100,200,500,1000] as $v): ?>
                            <option value="<?= $v ?>" <?= $facevalue->facevalue == $v ? 'selected' : '' ?>><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input class="quantity" type="text" name="income[quantity][]" value="<?= $facevalue->quantity ?? 0 ?>" oninput="calculateSumm(this)"></td>
                <td><input class="amount" type="text" name="income[amount][]" value="<?= $facevalue->amount ?? 0 ?>" readonly></td>
                <td><input class="summ" type="text" name="income[summ][]" value="<?= $facevalue->summ ?? 0 ?>" readonly></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            
            <tr class="totals-row" id="total-row">
            <td colspan="6" style="text-align:right">
                <input type="text" id="totalamount" name="income[total_amount]"
                    value="<?= $income->total_amount ?? 0 ?>" class="nb fs20">
            </td>
            </tr>

        </tbody>
                </table>
        <br>
        <div class="f fjb mt ">
            <div>
                <button  id="addfacevalue">Add a row</button>
                <?php if (!empty($income->id)): ?>
                        <a href="/income/print?id=<?= $income->id ?>" target="_blank" class="print-button">🖨️ Print</a>
                    <?php endif; ?>
            </div>
            <div >
                <input type="submit" name="submit" value="Save" class="submit-button">
                <a class="closenosave" href="/income/list" class="cancel-button">❌</a>
    </div>
        </div>
    </form>
</div>

<script>
function calculateSumm(el) {
    let row = el.closest('tr');
    let qty = parseFloat(row.querySelector('.quantity').value) || 0;
    let faceval = parseFloat(row.querySelector('.facevalue').value) || 0;
    let amount = qty * faceval;
    row.querySelector('.amount').value = amount;

    let rate = parseFloat(row.querySelector('.rate').value) || 0;
    row.querySelector('.summ').value = (rate * amount).toFixed(2);

    totalAmountRecalc();
}

function totalAmountRecalc() {
    let total = 0;
    document.querySelectorAll('.summ').forEach(el => {
        total += parseFloat(el.value) || 0;
    });
    document.getElementById('totalamount').value = total.toFixed(2);
    document.getElementById('totalsumm').innerText = numberWithSpaces(total.toFixed(0));
    document.getElementById('four').innerText = numberWithSpaces((total / 4).toFixed(0));
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

document.addEventListener('change', e => {
    if (e.target.classList.contains('currency')) {
        const currencyName = e.target.options[e.target.selectedIndex].text;
        fetch('/rate/last')
            .then(res => res.json())
            .then(json => {
                e.target.closest('tr').querySelector('.rate').value = json[currencyName] ?? 1;
                calculateSumm(e.target);
            });
    }
        // 💰 Denomination schimbat → dacă qty e deja completat, recalculează
        if (e.target.classList.contains('facevalue')) {
        const row = e.target.closest('tr');
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        if (qty > 0) {
            calculateSumm(e.target);
        }
    }
});

document.getElementById('addfacevalue').addEventListener('click', e => {
    e.preventDefault();
    const wrapper = document.getElementById('facevaluewrapper');
    const row = document.createElement('tr');
    row.classList.add('facevalue');
    row.innerHTML = `
    <td>
        <select class="currency" name="income[currency_id][]">
            <?php
            foreach ($currencies as $currency) {
                $selected = $currency['id'] == 1 ? 'selected' : '';
                echo "<option value=\"{$currency['id']}\" $selected>{$currency['name']}</option>";
            }
            ?>
        </select>
    </td>
    <td><input class="rate" type="text" name="income[rate][]" value="1" readonly></td>
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
    <td><input class="quantity" type="text" name="income[quantity][]" oninput="calculateSumm(this)"></td>
    <td><input class="amount" type="text" name="income[amount][]" readonly></td>
    <td><input class="summ" type="text" name="income[summ][]" readonly></td>
`;

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('change-currency-btn')) {
        const td = e.target.closest('td');
        const label = td.querySelector('.currency-label');
        const select = td.querySelector('select.currency');

        label.style.display = 'none';
        select.style.display = 'inline-block';
    }
});


const totalRow = document.getElementById('total-row');
wrapper.insertBefore(row, totalRow);

});


document.addEventListener('click', function(e) {
	const row = e.target.closest('tr.facevalue');
	if (row && row.parentElement.id === 'facevaluewrapper') {
		// deselectăm alte rânduri (doar unul poate fi selectat)
		document.querySelectorAll('tr.facevalue').forEach(r => r.classList.remove('selected'));
		row.classList.add('selected');
	}
});
document.addEventListener('keydown', function(e) {
	if (e.key === 'Delete') {
		const selectedRow = document.querySelector('tr.facevalue.selected');
		if (selectedRow) {
			selectedRow.remove();
			totalAmountRecalc(); // recalculează suma
		}
	}
});

document.addEventListener('keydown', function(e) {
    // Dacă suntem într-un input text sau select și apăsăm Enter
    const tag = e.target.tagName.toLowerCase();
    if (e.key === 'Enter' && (tag === 'input' || tag === 'select')) {
        e.preventDefault(); // prevenim trimiterea formularului

        document.getElementById('addfacevalue').click(); // simulăm click pe Add
    }
});





</script>
