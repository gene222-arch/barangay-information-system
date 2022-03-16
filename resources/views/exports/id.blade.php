<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    body {
        margin: 0;
        line-height: 1.6;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1rem;
    }
    .card {
        border: 1px 1px solid black;
        height: 13rem;
    }
    .card-body {
        margin-top: 1.5rem;
    }
    .card-img-top {
        border-radius: 5%;
    }
    .info {
        font-size: 0.8rem;
    }
</style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img 
                                class="card-img-top" 
                                src="./storage/avatars/{{ $resident->details->avatar_path }}" 
                                height="100" 
                                width="100" 
                                alt="{{ $resident->name }}"
                            >
                        </td>
                        <td>
                            <p class="info" style="margin-left: 5rem;">
                                <strong>First, Middle, Last</strong> <br>
                                <span style="margin-left: 0.5rem;">{{ $resident->name }}</span>
                            </p>
                            <p class="info" style="margin-left: 5rem;">
                                <strong>Gender </strong>
                                <strong>Civil Status </strong><br>
                                <span style="margin-left: 0.5rem;">{{ $resident->details->gender }}</span>
                                <span style="margin-left: 2rem;">{{ $resident->details->civil_status }}</span>
                            </p>
                            <p class="info" style="margin-left: 5rem;">
                                <strong>Address </strong> <br>
                                <span style="margin-left: 0.5rem;">{{ $resident->details->address }}</span>
                            </p>
                        </td>
                        <td>
                            <img 
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($resident->details->barcode,'C128') }}" 
                                height="60" 
                                width="180"
                                style="margin-left: 5rem;"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>