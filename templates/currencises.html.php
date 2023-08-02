<div>
<p><?=$totalcurrencises?> Currencises <samp style="float:right"><a href="/currency/edit">Ad a currency</a></samp></p>
<table>
  <tr>
<th>Currency</th><th>Edit</th><th>Delete</th>
  </tr>

<?php foreach($currencises as $currency): ?><tr>  
  <td><?=$currency->name?></td>    
  <td><a href="/currency/edit?id=<?=$currency->id?>">Edit</a></td>
  <td><form action="/currency/delete" method="post" class="fortableform">
    <input type="hidden" name="id" value="<?=$currency->id?>">
    <input type="submit" value="❌">
  </form>
  </td>
</tr>  
<?php endforeach; ?>
</table>
</div>