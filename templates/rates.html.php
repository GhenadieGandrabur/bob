<div style="width:600px; margin:auto;">
<h3 style="margin-bottom: 10px;"><?=$totalrates?> Rates <samp style="float:right"><a href="/rate/edit" class="linkbutton">Ad a rate</a></samp></h3>
<table class="customtable">
  <tr>
<th>Id</th><th>Date</th><th>Currency</th><th>Rate</th><th>Edit</th><th>Delete</th>
  </tr>

<?php foreach($rates as $rate): ?><tr>  
  <td><?=$rate['id']?></td>    
  <td><?= date('d.m.Y', strtotime($rate['date'])) ?></td>    
  <td><?=$rate['currency_name']?></td>    
  <td><?=$rate['rate']?></td>    
  <td><a href="/rate/edit?id=<?=$rate['id']?>" class="linkbutton">Edit</a></td>
  <td><form action="/rate/delete" method="post" >
    <input type="hidden" name="id" value="<?=$rate['id']?>">
    <input type="submit" value="Delete" class="button">
  </form>
  </td>
</tr>  
<?php endforeach; ?>
</table>

</div>