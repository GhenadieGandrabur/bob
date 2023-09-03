<style>
table, td, th {
  border: 1px solid;
}

table {
  width: 50%;
  border-collapse: collapse;
}
</style>

<div style="width:50%; margin:auto ; text-align:center">
<h1>Count your money</h1>
<div style="background-color:red ; width:50%; margin:auto;">
<h1  id="tot" style="font-size:300%; color:white ;"> </h1>
</div>
<table id='data' style="width:80%; margin:auto ; text-align:center">
  <thead></thead>
  <tbody></tbody>
</table>
<br>
  <button id="printButton">Print Table</button>
<br>

<br><br><br>
<form>
 <select name="currency" id="currency">
  <option value="Valuta">Valuta</option>
  <option value="MDL">Leu</option>
  <option value="EURO">EURO</option>
  <option value="USD">USA Dollar</option>
  <option value="UAH">Hrivna</option>
  <option value="RON">RON</option>
</select>
<input id="rate" type="number" value="1" name="rate" step="0.01" min="0.1" max="100" />
 <select name="facevalue" id="facevalue">
  <option value="add a facevalue">add a facevalue</option>
  <option value="5">5</option>
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="50">50</option>
  <option value="100">100</option>
  <option value="200">200</option>
  <option value="500">500</option>
  <option value="1000">1000</option>
</select>
  <input id="quantity" onkeyup="amountmoney()" type="number" name="quantity"  min="1" max="10000" placeholder="quantity"/>
  <input id="amount" type="number" name="amount"  min="1" max="100000"/>
  <input id="summ" type="number" name="summ" min="1" max="1000000"/>
  <button>ADD</button>
</form>
<div style="background-color:blue ; width:50%; margin: auto;
">
<h1  id="four" style="font-size:300%; color:white ;"> </h1>
</div>
</div>

<script>
const af = ['currency','rate', 'facevalue', 'quantity' ,'amount', 'summ']
const of = document.querySelector('form')
const ot = document.querySelector('#data')
const or = document.createElement('tr')
af.forEach(v => {
  const o = document.createElement('th')
  o.textContent = v
  or.insertAdjacentElement('beforeend', o)
})
ot.querySelector('thead').insertAdjacentElement('beforeend', or)
of.addEventListener('submit', e => {
  e.preventDefault()
  const or = document.createElement('tr')
  af.forEach(v => {
    const o = document.createElement('td')
    const ov = of.querySelector('#' + v)
    o.textContent = ov.value
    ov.value = ''
    or.insertAdjacentElement('beforeend', o)
  })
  ot.querySelector('tbody').insertAdjacentElement('beforeend', or)
})
let rate = document.getElementById('rate')
let facevalue = document.getElementById('facevalue')
let quantity = document.getElementById('quantity')
let amount = document.getElementById('amount')
let summ = document.getElementById('summ')

function amountmoney(){
 
    amount.value = facevalue.value*quantity.value;
    summ.value = amount.value*rate.value
}

// ... (previous code)

// Function to calculate the sum of all "summ" values in the table
function calculateSumOfSumm() {
    const tbody = ot.querySelector('tbody');
    const rows = tbody.querySelectorAll('tr');
    let sum = 0;

    rows.forEach(row => {
        const summCell = row.querySelector('td:nth-child(6)'); // 6th column is the "summ" column
        const summValue = parseFloat(summCell.textContent) || 0;
        // ... (previous code)

// Function to calculate the sum of all "summ" values in the table
function calculateSumOfSumm() {
    const tbody = ot.querySelector('tbody');
    const rows = tbody.querySelectorAll('tr');
    let sum = 0;

    rows.forEach(row => {
        const summCell = row.querySelector('td:nth-child(6)'); // 6th column is the "summ" column
        const summValue = parseFloat(summCell.textContent) || 0;
        sum += summValue;
       
    });

    // Display the total sum in the "summ" input field
    summ.value = sum;
    
}


// Add an event listener to the form submission to calculate the total sum
of.addEventListener('submit', e => {
    e.preventDefault();
    calculateSumOfSumm();
});

// ... (previous code)
sum += summValue;
    });

    // Display the total sum in the "summ" input field
    summ.value = sum;
    document.getElementById('tot').innerText = sum.toLocaleString('en-US');
    document.getElementById('four').innerText = (sum/4).toLocaleString('en-US');

}

// Add an event listener to the form submission to calculate the total sum
of.addEventListener('submit', e => {
    e.preventDefault();
    calculateSumOfSumm();
});

const printButton = document.getElementById('printButton');
printButton.addEventListener('click', () => {
    // Create a new window or tab with the printable table
    const printableTable = window.open('printable-table.html', '_blank');
    printableTable.focus();
})


</script>

