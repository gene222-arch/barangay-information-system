<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		html,
		body {
			padding: 0;
			margin: 0;
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
		}

		table {
			width: 100%;
			margin-top: 2rem;
		}

		th, td {
			padding-top: 0.5rem;
			padding-bottom: 0.5rem;
		}

		th {
			background-color: #121212;
			color: #F5F5F5;
		}

		td {
			text-align: center;
			font-weight: 400;
			font-size: 0.875rem;
		}

		.header {
			margin-top: 2rem;
			margin-left: 1rem;
		}
	</style>
</head>
<body>
	<h2 class="header">Court Reservations</h2>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Time</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($schedules as $sched)
				<tr>
					<td>{{ $sched->user->name }}</td>
					<td>{{ \Carbon\Carbon::parse($sched->start)->format('h:i a') }} - {{ \Carbon\Carbon::parse($sched->end)->format('h:i a') }}</td>
					<td>{{ \Carbon\Carbon::parse($sched->start)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($sched->end)->format('M d, Y') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>