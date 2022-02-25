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

        <h2 style="text-align: center; margin-bottom: 20px;">CERTIFICATE OF REGISTRATION</h5>
        <p>
            <p>
                <span style="margin-left: 5rem;">Name of Owner: ___________<span style="text-decoration: underline; margin-left:">{{ $resident->name }}</span>______________________________</span>
                <br>
                <span style="margin-left: 5rem;">Address: ___________<span style="text-decoration: underline; margin-left:">{{ $resident->details->address }}</span>_________________________________________</span>
                <br>
                <span style="margin-left: 5rem;">Name of Driver: ___________<span style="text-decoration: underline; margin-left:">{{ $resident->name }}</span>______________________________</span>
                <br>
                <span style="margin-left: 5rem;">License No.: ___________<span style="text-decoration: underline; margin-left:">9318-412</span>________________________________________</span>
                <br>
                <span style="margin-left: 5rem;">Copy of Special Authority Permit: <span style="margin-left:">___________________________________________</span></span>
            </p>

            <p style="margin-left: 5rem;">
                This certification is given to <strong>{{ $resident->name }}</strong>
                Given this <span style="text-decoration: underline;">{{ \Carbon\Carbon::now()->format('D') }}</span> day of {{ \Carbon\Carbon::now()->format('M') }} <span style="text-decoration: underline;">{{ \Carbon\Carbon::now()->format('Y') }}</span> 
            </p>

            <p style="margin-left: 7rem;">
                Paid under O.R No. : ___________<span style="text-decoration: underline;">75684</span>___________
                <br>
                Issued at: ___<span style="text-decoration: underline;">Barangay Lingga, Calamba City, Laguna</span>____
                <br>
                Issued on: ___<span style="text-decoration: underline;">{{ \Carbon\Carbon::now()->format('M d, Y') }}</span>____
                <br>
                Amount: ___<span style="text-decoration: underline;">P75.00</span>____
                <br>
                Residence Cert No. : ___<span style="text-decoration: underline;">88754587</span>____
                <br>
                Issued at: ___<span style="text-decoration: underline;">Barangay Lingga, Calamba City, Laguna</span>____
                <br>
                Issued on: ___<span style="text-decoration: underline;">{{ \Carbon\Carbon::now()->format('M d, Y') }}</span>____
            </p>

            <p style="text-align: right; margin-top: 5rem;">
                ______________________________
            </p>
            <p style="text-align: right; font-size: 0.9rem; margin-right: 5rem;">
                Signature of Owner
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