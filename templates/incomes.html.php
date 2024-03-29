<div style="width: 80%; margin:auto;">
  <h2>Incomes <span style="font-size:14px;">(<?=number_format($totalAmount, 0, ',', ' ')?> ) </span><span style="font-size:14px;margin-left:20px;">  
  <?=number_format($totalAmount, 0, ',', ' ')?> </span><span style="font-size:14px;margin-left:20px;">: 4 = </span> <span style="font-size:14px;margin-left:20px;"><?=number_format($totalAmount/4, 0, ',', ' ')?> </span> </h2>
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
            <p><a href="/income/edit" class="linkbuttongreen">Add an income</a></p>
    </div>
  <table class="incometable " >
    <thead>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Amount</th>
      <th>: 4</th>
      <th class="tc">Edit</th>
      <th style="width:20px;" class="tc">Delete</th>
    </tr>
    </thead>
   <tbody calss='b'>
  <?php foreach($incomes as $income): ?>
  <tr class="b">  
    <td><?=$income['id']?></td>    
    <td><?= date('d.m.Y', strtotime($income['created'])) ?></td>   
    <td><?=$income['total_amount']?></td>   
    <td><?=$income['total_amount']/4?></td>   
    <td><a href="/income/edit?id=<?=$income['id']?>" class="linkbutton">Edit</a></td>
    <td ><form action="/income/delete" method="post" class="fortableform">
      <input type="hidden" name="id" value="<?=$income['id']?>">
      <input type="submit" value="❌" class="smalldeletebuton" >
    </form>
    </td>
  </tr>  
  <?php endforeach; ?>
   
  <tr>   
    <td colspan="2"></td>
    <td><?=number_format($totalAmount, 0, ',', ' ')?> </td>
    <td><?=number_format($totalAmount/4, 0, ',', ' ')?></td>    
    <td colspan="2"></td>
  </tr>
  </table>

</div>
<script src="/js/calendar.js"></script>