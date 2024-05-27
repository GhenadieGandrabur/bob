<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Context Menu Delete and Double Click Edit Row</title> -->
    <style>
        table {
            width: 100%;
           
        }
        .context-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .context-menu ul {
            list-style: none;
            padding: 5px 0;
            margin: 0;
        }
        .context-menu ul li {
            padding: 8px 12px;
            cursor: pointer;
        }
        .context-menu ul li:hover {
            background-color: #eee;
        }
    </style>
<!-- </head>
<body> -->
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
        <table class="incometable" id="income">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>: 4</th>
              
                </tr>
            </thead>
            <tbody id="incomeWrapper">
                <?php foreach($incomes as $income): ?>
                <tr class="b">  
                    <td><?=$income['id']?></td>    
                    <td><?= date('d.m.Y', strtotime($income['created'])) ?></td>   
                    <td><?=$income['total_amount']?></td>   
                    <td><?=$income['total_amount']/4?></td>   
             
                </tr>  
                <?php endforeach; ?>
                <tr>   
                    <td></td>
                    <td></td>
                    <td><?=number_format($totalAmount, 0, ',', ' ')?> </td>               
                    <td><?=number_format($totalAmount/4, 0, ',', ' ')?></td>
                </tr>
            </tbody>
        </table>
    </div>
   
<div id="contextMenu" class="context-menu" style="display: none; position: absolute; z-index: 1000;">
  <ul>   
    <li id="deleteRow">❌ Delete</li>
  </ul>
</div>
    <script src="/js/calendar.js"></script>
    <script src="/js/contextmenu.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        attachTableInteractions('income', '/income/edit', '/income/delete');
         });
    </script>
<!-- </body>
</html> -->
