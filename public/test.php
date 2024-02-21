<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Календарь на Русском</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>
</head>
<body>
    <input type="text" id="datepicker">

    <script>
    $(function() {
        $("#datepicker").datepicker($.datepicker.regional['ru']);
    });
    </script>
</body>
</html>
