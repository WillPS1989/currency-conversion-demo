<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Currency Conversion</title>
  </head>
  <body>
    <h1>Convert away...</h1>
	<form action="/conversion" enctype="multipart/form-data" method="post">
		<label for="value">Value to convert</label> <input type="text" id="value" name="value" class="submitAfterChange" /> <br />
        <label for="from">Currency to convert from:</label>
			<select id="from" name="from" class="submitAfterChange">
                @foreach ($fromCurrencies as $fromCurrency)
				<option val="{{$fromCurrency->from}}">{{$fromCurrency->from}}</option>
                @endforeach
			</select> <br />
        <label for="to">Currency to convert to:</label>
			<select id="to" name="to" class="submitAfterChange">
                @foreach ($toCurrencies as $toCurrency)
                    <option val="{{$toCurrency->to}}">{{$toCurrency->to}}</option>
                @endforeach
			</select> <br />
	</form>
    <section id="ajaxContent" style="display: none">
        <span id="result" class="text-success display-3">
            <span class="fromValue">XX.XX</span> <span class="fromCurrency">YYY</span> = <span class="toValue">XX.XX</span> <span class="toCurrency">YYY</span>
        </span>
        <br />
        <span id="info" class="text-info display-4">
            <span class="fromValue">1.00</span> <span class="fromCurrency">YYY</span> = <span class="toValue">XX.XX</span> <span class="toCurrency">YYY</span>
        </span>

    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.submitAfterChange').on('change', function() {
                let value = $('#value').val();
                let from = $('#from').val();
                let to = $('#to').val();

                $.post(
                    '/conversion',
                    {value: value, from: from, to: to}
                ).done(function (data) {
                    if(data.success==="true"){
                        $('#ajaxContent #result .fromValue').html(data.originalValue);
                        $('#ajaxContent #result .fromCurrency').html(data.originalCurrency);
                        $('#ajaxContent #result .toValue').html(data.convertedValue);
                        $('#ajaxContent #result .toCurrency').html(data.convertedCurrency);
                        $('#ajaxContent #info .fromCurrency').html(data.originalCurrency);
                        $('#ajaxContent #info .toValue').html(data.conversionRate);
                        $('#ajaxContent #info .toCurrency').html(data.convertedCurrency);
                        $('#ajaxContent').show();
                    } else {
                        $('#ajaxContent').hide();
                        alert('Sorry, no rate could be found for this conversion');
                    }
                });
            });
        });
    </script>
  </body>
</html>
