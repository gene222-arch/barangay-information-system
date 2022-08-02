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

        .cell {
            float: left;
        }

        .left {
            width: 20rem;
            margin-left: -5rem;
        }

        .right {
            margin-left: -16rem;
            margin-top: 5rem;
        }
    </style>
</head>
<body>
    <main>
        @include('exports.includes.header')

        <h2 style="text-align: center; margin-bottom: 20px;">CERTIFICATE OF INDIGENCY</h5>
        <p>
            <p style="margin-left: 5rem;">
                This is to certify that <i>{{ $resident->name }}</i>, <strong>{{ \Carbon\Carbon::parse($resident->details->birthed_at)->age }}</strong> years old, a bonafide
                resident of {{ $resident->details->address }} belongs to one of the many indigent families of Barangay Lingga, City of Calamba.
                The income of his/her family is barely enough to meet their day to day needs.
            </p>

            <p style="margin-left: 5rem; margin-top: 2rem; text-align:center">
                This certification is issued for whatever legal purpose may this serve.
            </p>

            <p style="margin-left: 5rem; margin-top: -1rem;">
                Issued this {{ \Carbon\Carbon::now()->format('d') }} day of {{ \Carbon\Carbon::now()->format('M') }}, {{ \Carbon\Carbon::now()->format('Y') }} at Barangay Lingga, Calamba City Laguna.
            </p>
        </p>
    
        <div>
            <div class="cell left">
                @include('exports.includes.kagawads')
            </div>
            <div class="cell right">
                <p>
                    <p>______________________________</p>
                    <p style="text-align: center; margin-top: -1rem;">Signature over printed name</p>
                </p>
                <div style="text-align: right; margin-right: 2rem;">
                    <p style="margin-top: 5rem;">
                        <strong>Darwin C. Retusto</strong>
                    </p>
                    <p style="font-size: 0.9rem; margin-top: -1rem; margin-right: 0.8rem;">
                        Punong Barangay
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>