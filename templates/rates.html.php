<div>
<p><?=$totalrates?> Rates <samp style="float:right"><a href="/rate/edit">Ad a rate</a></samp></p>
<table>
  <tr>
<th>Id</th><th>Date</th><th>Currency</th><th>Rate</th><th>Edit</th><th>Delete</th>
  </tr>

<?php foreach($rates as $rate): ?><tr>  
  <td><?=$rate->id?></td>    
  <td><?=$rate->date?></td>    
  <td><?=$rate->currency_id?></td>    
  <td><?=$rate->rate?></td>    
  <td><a href="/rate/edit?id=<?=$rate->id?>">Edit</a></td>
  <td><form action="/rate/delete" method="post" class="fortableform">
    <input type="hidden" name="id" value="<?=$rate->id?>">
    <input type="submit" value="❌">
  </form>
  </td>
</tr>  
<?php endforeach; ?>
</table>
</div>