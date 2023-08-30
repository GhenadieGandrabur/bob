<div>
<p><?=$totalIcomes?> Incomes <samp style="float:right"><a href="/income/edit">Ad an income</a></samp></p>
<table>
  <tr>
<th>Id</th>
<th>Date</th>
<th>Currency</th>
<th>Rate</th>
<th>Facevalue</th>
<th>QTY</th>
<th>Amount</th>
<th>Summ</th>
<th>Edit</th>
<th>Delete</th>
  </tr>

<?php foreach($incomes as $income): ?><tr>  
  <td><?=$income['id']?></td>    
  <td><?=$income['date']?></td>    
  <td><?=$income['currency_name']?></td>    
  <td><?=$income['rate']?></td>    
  <td><?=$income['facevalue']?></td>    
  <td><?=$income['quantity']?></td>    
  <td><?=$income['amount']?></td>    
  <td><?=$income['summ']?></td>    
  <td><a href="/income/edit?id=<?=$income['id']?>">Edit</a></td>
  <td><form action="/income/delete" method="post" class="fortableform">
    <input type="hidden" name="id" value="<?=$income['id']?>">
    <input type="submit" value="❌">
  </form>
  </td>
</tr>  
<?php endforeach; ?>
</table>
</div>