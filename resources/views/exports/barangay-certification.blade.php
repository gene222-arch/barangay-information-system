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
        @include('exports.includes.header')

        <h2 style="text-align: center; margin-bottom: 2.5rem;">CERTIFICATION</h5>
        <p>
            <p style="margin-left: 3rem; margin-top: 2rem;"><strong>TO WHOM IT MAY CONCERN:</strong></p>
            <p style="margin-left: 3rem;">
                This is to certify that <strong>{{ $resident->name }}</strong>, legal age is a bonafide resident of {{ $resident->details->address }} since 2002.
            </p>

            <p style="margin-left: 3rem; margin-top: 2rem;">
                This certification is being issued upon the request of <i>{{ $resident->name }}</i> for whatever legal 
                prupose of this may serve.
            </p>

            <p style="margin-left: 3rem; margin-top: 2rem;">
                Issued this {{ \Carbon\Carbon::now()->format('d') }} day of {{ \Carbon\Carbon::now()->format('M') }}, {{ \Carbon\Carbon::now()->format('Y') }} at Barangay Lingga, Calamba City Laguna.
            </p>

            <div style="text-align: right;">
                <p style="margin-top: 5rem; margin-left: 5rem; text-aling: right;">
                    <strong>Darwin C. Retusto</strong>
                </p>
                <p style="font-size: 0.9rem; margin-left: 5rem; margin-top: -1.25rem; text-aling: right;">
                    Punong Barangay
                </p>
            </div>
        </p>
    </main>
</body>
</html>