<div style="width:800px; margin:auto;">
  <h2>Incomes <span style="font-size:10px;">(<?=$totalIcomes?>) </span></h2>
  <br>
  <p><a href="/income/edit" class="linkbutton">Add an income</a></p>
  <table>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Amount</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

  <?php foreach($incomes as $income): ?><tr>  
    <td><?=$income['id']?></td>    
    <td><?= date('d.m.Y', strtotime($income['created'])) ?></td>   
    <td><?=$income['total_amount']?></td>   
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