<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>

    @page { 
        size: 6.7cm 9.9cm landscape; 
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.8rem;
    }

    section {
        float: left;
    }

    .card-img-top {
        margin-left: -2rem;
        border-radius: 0.5rem;
    }

    .section-one {
        margin-right: 1rem;
    }

    .label {
        font-size: 0.5rem;
        font-weight: 400;
    }
    
    .barcode-img {
        position: absolute;
        bottom: -15%;
        left: -9rem;
    }

    small {
        font-size: 0.55rem;
        font-weight: bold;
    }

    .name {
        font-weight: bold;
    }

    .header {
        margin-top: -2rem;
        margin-bottom: 1.25rem;
    }

    .header p {
        background-color: lightblue;
        width: 100%;
        font-size: 0.7rem;
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="header">
                <p style="text-align: center;">BARANGAY RESIDENTS CARD</p>
            </div>
            <section class="section-one">
                <img 
                    class="card-img-top" 
                    src="./storage/{{ $resident->details->avatar_path }}" 
                    height="132" 
                    width="132" 
                    alt="{{ $resident->name }}"
                >
            </section>
            <section class="section-two">
                <p class="info">
                    <strong class="label">First, Middle, Last</strong> <br>
                    <span class="name">{{ $resident->name }}</span>
                </p>
                <p class="info">
                    <strong class="label">DATE OF BIRTH</strong>
                    <strong class="label">Gender</strong>
                    <strong class="label">Civil Status </strong><br>
                    <small>{{ $resident->details->birthed_at }}</small>
                    <small style="margin-left: 1.12rem;">{{ $resident->details->gender }}</small>
                    <small style="margin-left: 0.6rem;">{{ $resident->details->civil_status }}</small>
                </p>
                <p class="info">
                    <strong class="label">Address </strong> <br>
                    <small>{{ $resident->details->address }}</small>
                </p>
            </section>
            <section class="barcode">
                <img 
                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG($resident->details->barcode,'C128') }}" 
                    height="40" 
                    width="80"
                    class="barcode-img"
                />
            </section>
        </div>
    </div>
</body>
</html>