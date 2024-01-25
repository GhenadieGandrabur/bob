<div style="width:800px; margin:auto;">
  <h2>Incomes <span style="font-size:14px;">(<?=$totalIcomes?>) </span><span style="font-size:14px;margin-left:20px;">  
  <?=$totalAmount?></span><span style="font-size:14px;margin-left:20px;">: 4 = </span> <span style="font-size:14px;margin-left:20px;"><?=$totalAmount/4?></span> </h2>
    <div style="display:flex; align-items: center; justify-content: space-between;">
      <form action="/income/list" class="filterreport" method="GET" style="padding: 5px 20px; background:orange;">
                <input type="hidden" name="start" value="<?=$_GET['start']??""?>">
                <input type="hidden" name="finish" value="<?=$_GET['finish']??""?>">
                <input type="hidden" name="pickerLabel" value="<?=$_GET['pickerLabel']??""?>">
                <span id="daterange">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </span>      
            </form>
            <p><a href="/income/edit" class="linkbutton">Add an income</a></p>
    </div>
  <table class="incometable">
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Amount</th>
      <th>: 4</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

  <?php foreach($incomes as $income): ?><tr>  
    <td><?=$income['id']?></td>    
    <td><?= date('d.m.Y', strtotime($income['created'])) ?></td>   
    <td><?=$income['total_amount']?></td>   
    <td><?=$income['total_amount']/4?></td>   
    <td><a href="/income/edit?id=<?=$income['id']?>" class="linkbutton">Edit</a></td>
    <td><form action="/income/delete" method="post" class="fortableform">
      <input type="hidden" name="id" value="<?=$income['id']?>">
      <input type="submit" value="Delete" class="button">
    </form>
    </td>
  </tr>  
  <?php endforeach; ?>
  <tr>   
    <td colspan="2"></td>
    <td><?=$totalAmount?></td>
    <td><?=$totalAmount/4?></td>    
    <td colspan="2"></td>
  </tr>
  </table>
  <h4 style="text-align:right"><?=$totalAmount/4?></h4>
</div>
<script src="/js/calendar.js"></script>