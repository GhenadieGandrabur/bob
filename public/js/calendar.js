$(function () {

  let start = moment().subtract(1, 'year');
  let end = moment();
  if ($('[name="start"]').val().length > 0) {
    start = moment($('[name="start"]').val());
    end = moment($('[name="finish"]').val());
  }
  let pickerLabel = $('[name="pickerLabel"]').val().length > 0 ? $('[name="pickerLabel"]').val() :'This Month'
  const ranges = {
    'All Time': [moment('1970-01-01'), moment().startOf('day')],
    'Today': [moment().startOf('day'), moment().add(1,'day').endOf('day')],
    'Yesterday': [moment().subtract(1, 'days'), moment()],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    'Last 365 days': [moment().subtract(1, 'year'), moment()],
    'This Year': [moment().startOf('year'), moment().endOf('year')],
  }

  if (ranges[pickerLabel]) {
    start = ranges[pickerLabel][0]
    end = ranges[pickerLabel][1]
  }
  $('[name="start"]').val(start.format('YYYY-MM-DD'))
  $('[name="finish"]').val(end.format('YYYY-MM-DD'))

  $('#daterange span').html(pickerLabel);

  function cb(start, end) {
    $('[name="start"]').val(start.format('YYYY-MM-DD'))
    $('[name="finish"]').val(end.format('YYYY-MM-DD'))
    $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

  }

  $('#daterange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: ranges
  }, cb);

  cb(start, end);

  if (ranges[pickerLabel]) {
    $('#daterange span').html(pickerLabel);
    $('[name="pickerLabel"]').val(pickerLabel)
  }

  $('#daterange').on('apply.daterangepicker', function (ev, picker) {
    if (picker.chosenLabel === 'Custom Range') {
      $('[name="pickerLabel"]').val("Custom Range")
    } else {
      $('#daterange span').html(picker.chosenLabel);
      $('[name="pickerLabel"]').val(picker.chosenLabel)
    }
    document.querySelector('.filterreport').submit()
  });


});
	