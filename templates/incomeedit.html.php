<h1>Incomes</h1>
    <form id="multiRowForm" method="post" action="" class="forall">
        <div id="formRows">
            <!-- This is where the rows will be added -->
        </div>

        <button type="button" onclick="addRow()">Add Row</button>
        <button type="button" onclick="removeRow()">Remove Row</button>

        <br><br>

        <input type="submit" value="Submit">
    </form>

   <script>
    function addRow() {
        const formRows = document.getElementById("formRows");
        const newRow = document.createElement("div");
        newRow.className = "form-row";

        newRow.innerHTML = `
            <input type="hidden" name="income[id]" value="">
            <input type="date" value="" name="income[date]" placeholder="date">
            <select name="income[currency_id][]">
                <option value="">Select Currency</option>
                <?php foreach ($currencies as $currency) : ?>
                    <option value="<?= $currency['id'] ?>">
                        <?= $currency['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="Rate" name="income[rate][]" placeholder="rate" size="5">
            <input type="facevalue" name="income[facevalue][]" placeholder="facevalue" size="5">
            <input class="quantity" name="income[quantity][]" placeholder="quantity" size="5" oninput="calculateSumm(this)">
            <input class="amount" name="income[amount][]" placeholder="amount" size="5">
            <input class="summ" name="income[summ][]" placeholder="summ" size="10">
        `;

        formRows.appendChild(newRow);
    }

    function removeRow() {
        const formRows = document.getElementById("formRows");
        const rows = formRows.getElementsByClassName("form-row");

        if (rows.length > 1) {
            formRows.removeChild(rows[rows.length - 1]);
        }
    }

    // Initialize by adding one row
    addRow();

    function calculateSumm(input) {
        // Get the parent row of the input element
        const parentRow = input.closest(".form-row");

        // Get the values of quantity and facevalue within the same row
        const quantity = parseFloat(parentRow.querySelector(".quantity").value) || 0;
        const facevalue = parseFloat(parentRow.querySelector(".facevalue").value) || 0;

        // Calculate the amount
        const amount = quantity * facevalue;

        // Update the amount input field within the same row
        parentRow.querySelector(".amount").value = amount;

        // Get the values of rate and amount within the same row
        const rate = parseFloat(parentRow.querySelector(".rate").value) || 0;
        const updatedAmount = parseFloat(parentRow.querySelector(".amount").value) || 0;

        // Calculate the summ
        const summ = rate * updatedAmount;

        // Update the summ input field within the same row
        parentRow.querySelector(".summ").value = summ;
    }
</script>

    <script>
    
        function calculateSumm() {
        // Get the values of quantity and facevalue
        var quantity = parseFloat(document.getElementById('quantity').value) || 0;
        var facevalue = parseFloat(document.getElementById('facevalue').value) || 0;

        // Calculate the amount
        var amount = quantity * facevalue;

        // Update the amount input field
        document.getElementById('amount').value = amount;
    

        // Get the values of rate and amount
        var rate = parseFloat(document.getElementById('rate').value) || 0;
        var amount = parseFloat(document.getElementById('amount').value) || 0;

        // Calculate the summ
        var summ = rate * amount;

        // Update the summ input field
        document.getElementById('summ').value = summ;
    }
</script>