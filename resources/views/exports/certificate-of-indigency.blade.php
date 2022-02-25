<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <main>
        <header style="text-align: center">
            <p>Republic of the Philippines</p>
            <p><b>Barangay Lingga</b></p>
            <p>Calamba City</p>
        </header>

        <h2 style="text-align: center; margin-bottom: 20px;">CERTIFICATE OF INDIGENCY</h5>
        <p>
            <p style="margin-left: 5rem; margin-top: 2rem;"><strong>TO WHOM IT MAY CONCERN:</strong></p>
            <p style="margin-left: 5rem;">
                This is to certify that <i>{{ $resident->name }}</i> with residence at {{ $resident->details->address }},
                Calamba City, belongs to one of the many indigent families of Barangay Lingga, Calamba City. The income of
                his/her family is barely enough to meet their day to day needs.
            </p>

            <p style="margin-left: 5rem; margin-top: 2rem; text-align:center">
                This certification is issued for whatever legal purpose may this serve.
            </p>

            <p style="margin-left: 5rem; margin-top: 2rem;">
                Issued this {{ \Carbon\Carbon::now()->format('d') }} day of {{ \Carbon\Carbon::now()->format('M') }}, {{ \Carbon\Carbon::now()->format('Y') }} at Barangay Lingga, Calamba City Laguna.
            </p>

            <p style="margin-top: 5rem; margin-left: 5rem;">
                <strong>Darwin C. Retusto</strong>
            </p>
            <p style="font-size: 0.9rem; margin-left: 5rem;">
                Punong Barangay
            </p>
        </p>
    </main>
</body>
</html>