
<p><?=$totalcurrencises?> Currencises </p>
<table>
  <tr>
<th>Currency</th><th>Edit</th><th>Delete</th>
  </tr>

<?php foreach($currencises as $currency): ?><tr>  
  <td><?=$currency['name']?></td>    
  <td><a href="/currency/edit?id=<?=$currency['id']?>">Edit</a></td>
  <td><form action="/currency/delete" method="post">
    <input type="hidden" name="id" value="<?=$currency['id']?>">
    <input type="submit" value="❌">
  </form>
  </td>
</tr>  
<?php endforeach; ?>
</table>