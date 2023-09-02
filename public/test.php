<h1>Incomes</h1>
<div style="text-align:center">
  <form action="" method="post" class="forall">
    <!-- ... Other input fields ... -->

    <input type="Rate" id='rate' name="income[rate]" value="<?= 20 ?>" placeholder="rate" size="5" >
    <input type="facevalue" id='facevalue' name="income[facevalue]" value="<?= $income->facevalue ?? "" ?>" placeholder="facevalue" size="5">
    <input id="quantity" name="income[quantity]" value="<?= $income->quantity ?? "" ?>" placeholder="quantity" size="5" oninput="calculateRowAmount(this)">
    <input id="amount" name="income[amount]" value="<?= $income->amount ?? "" ?>" placeholder="amount" size="5">
    <input id="summ" name="income[summ]" value="<?= $income->summ ?? "" ?>" placeholder="summ" size="10">

    <!-- Add a button to add a new row -->
    <button type="button" onclick="addRow()">Add Row</button>

    <!-- Create a table to display the rows -->
    <table id="incomeTable">
      <thead>
        <tr>
          <th>Quantity</th>
          <th>Amount</th>
          <th>Rate</th>
          <th>Summ</th>
        </tr>
      </thead>
      <tbody>
        <!-- Initial row -->
        <tr>
          <td><input type="number" class="quantity" oninput="calculateRowAmount(this)"></td>
          <td><input type="number" class="row-amount"></td>
          <td><input type="number" class="rate" oninput="calculateRowSumm(this)"></td>
          <td><input type="number" class="row-summ"></td>
        </tr>
      </tbody>
    </table>

    <div style="margin-top: 20px;">
      <input type="submit" name="submit" value="Save">
    </div>
  </form>
</div>

<script>
  function calculateRowAmount(input) {
    var row = input.parentElement.parentElement;
    var quantity = parseFloat(row.querySelector('.quantity').value) || 0;
    var facevalue = parseFloat(document.getElementById('facevalue').value) || 0;
    var amount = quantity * facevalue;
    row.querySelector('.row-amount').value = amount;
    calculateSumm();
  }

  function calculateRowSumm(input) {
    var row = input.parentElement.parentElement;
    var rate = parseFloat(row.querySelector('.rate').value) || 0;
    var amount = parseFloat(row.querySelector('.row-amount').value) || 0;
    var summ = rate * amount;
    row.querySelector('.row-summ').value = summ;
    calculateSumm();
  }

  function calculateSumm() {
    var rows = document.querySelectorAll('#incomeTable tbody tr');
    var totalSumm = 0;

    rows.forEach(function(row) {
      var rowSumm = parseFloat(row.querySelector('.row-summ').value) || 0;
      totalSumm += rowSumm;
    });

    document.getElementById('summ').value = totalSumm;
  }

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

    calculateSumm();
  }
</script>