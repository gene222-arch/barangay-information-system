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

        <h2 style="text-align: center; margin-bottom: 20px;">Barangay Clearance</h5>
        <p>
            <p style="margin-left: 5rem; margin-top: 2rem;"><strong>TO WHOM IT MAY CONCERN:</strong></p>
            <p style="margin-left: 5rem;">
                This is to certify that <i>{{ $resident->name }}</i> with residence at {{ $resident->details->address }},
                Calamba City has no derogatory record filed in our Barangay Office.
            </p>

            <p style="margin-left: 5rem; margin-top: 2rem;">
                This certification/clearance is hereby issued in connection with the subject's
                application for whatever legal purpose it may serve him or her best, and is valid from the date issued.
            </p>

            <p style="text-align: right; margin-top: 5rem;">
                <strong>Darwin C. Retusto</strong>
            </p>
            <p style="text-align: right; font-size: 0.9rem;">
                Punong Barangay
            </p>
            <p style="margin-left: 5rem; margin-top: 5rem;">Specimen Signature of Applicant</p>
            <p style="margin-left: 5rem;">___________________________</p>

            <p style="margin-left: 5rem; margin-top: 5rem;">Issued at: </p>
            <p style="margin-left: 5rem;">Issued on:</p>
        </p>
    </main>
</body>
</html>