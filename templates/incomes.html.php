<div>
  <p>Incomes  . <samp ><a href="/income/edit" style="border:1px solid; padding:5px;">Add an income</a></samp><?=$totalIcomes?> </p>
  <table>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

  <?php foreach($incomes as $income): ?><tr>  
    <td><?=$income['id']?></td>    
    <td><?= date('d.m.Y', strtotime($income['created'])) ?></td>   
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