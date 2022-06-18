<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body, html {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .header {
            font-family: 'Brush Script MT', cursive;
        }

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.25rem;
        }

        .container {
            width: 30rem;
        }
    
        .cell {
            float: left;
        }

        table ul {
            list-style-type: none;
        }

        .left {
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .kagawads {
            border: 1px solid lightblue;
            padding: 0.5rem;
            text-align: center;
        }

        .position {
            margin-top: -1.5rem;
            font-size: 0.8rem;
            color: lightblue;
        }

        .kagawad {
            text-transform: uppercase;
            font-weight: bold;
        }

        .thumbmark {
            border: 1px solid lightblue;
            width: 10rem;
            height: 10rem;
            margin-top: 5rem;
            margin-left:auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <main>
        @include('exports.includes.header')
        <hr style="margin-top: -2.25rem; color: blue;">
        <h1 style="text-align: center; margin-top: -3.5rem;text-decoration: underline;">PAGPAPATUNAY</h1>
        <div class="container">
            <div class="cell left">
                <div class="kagawads">
                    <h4>IGG. DARWIN C. RETUSTO</h4>
                    <p style="margin-top: -2rem;">Punong Barangay</p>
                    
                    <p>
                        <strong>Barangay kagawad</strong>
                    </p>
                    <p class="kagawad">igg. cherrielyn p. federico</p>
                    <p class="position">Committee on Health and Sanitation</p>
                    <p class="kagawad">igg. olyimpio dc. paner jr.</p>
                    <p class="position">Committee on Public Works</p>
                    <p class="kagawad">igg. eulogio t. tanala jr. ph.d</p>
                    <p class="position">Committee on Education</p>
                    <p class="kagawad">igg. feliciano a. resurreccion</p>
                    <p class="position">Committee on Environmental Protection</p>
                    <p class="kagawad">igg. melvin m. medalla</p>
                    <p class="position">Committee on Appropriation</p>
                    <p class="kagawad">igg. danilo c. lantacon</p>
                    <p class="position">Committee on Agriculture</p>
                    <p class="kagawad">igg. jerry u. alpajora</p>
                    <p class="position">Committee on Peace and Order</p>
                    <p class="kagawad">igg. jerick r. capunpon</p>
                    <p class="position">Committee On Youth & Sports Development</p>
                </div>

                <div class="thumbmark">

                </div>
            </div>
            <div class="cell right">
                <p>
                    <p><strong>SA MGA KINAUUKULAN:</strong></p>
                    <p>
                        Ito ay pagpapatunay na si <i>{{ $resident->name }}</i> 
                        na may edad na <b>{{ $resident?->age ?? 20 }}</b> taong gulang, ipinanganak noong <b>AGOSTO</b><br>
                        <b>20, 1981</b> <b style="text-decoration: underline;">binata/</b> dalaga / may asawa / balo at ipinanganak sa
                        <b>{{ $resident->details->address }}</b> nakalagda sa ibaba ay
                        naninirahan sa Purok 5 Sampaguita Street, Barangay Lingga,
                        Calamba City, Laguna sapul pa noong <strong style="text-decoration: underline;">1981</strong> at walang kasong
                        nabinbin dito.
                    </p>
        
                    <p>
                        <p style="margin-left: 2.5rem;">Ang pagpapatunay na ito ay ipinagkaloob sa kahilingan ni</p>
                        <p style="margin-top: -1rem;">
                            <strong>{{ $resident->name }}</strong> ayon sa kanyang pagnanais na kumuha ng:
                        </p>
                    </p>

                    <table style="margin-left: -2rem;margin-top: -1rem;">
                        <tr>
                            <td>
                                <ul>
                                    <li>( ) Application for Employment</li>
                                    <li>( ) Overseas travel papers</li>
                                    <li>( ) Transaction with a Bank or Lending Institusyon</li>
                                    <li>( ) Driver`s/Firearm's License</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>( ) School/SSS References</li>
                                    <li>( ) Electrification/Water Connection</li>
                                    <li>(-) Others</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
        
                    <p>Iginawad ngayong ika - <span>18</span> ng Mayo 2022</p>

                    <div style="margin-right: 1rem; text-align: right;">
                        <p>
                            <strong>IGG. Darwin C. Retusto</strong>
                        </p>
                        <p style="margin-top: -1rem; margin-right: 0.5rem;">
                            Punong Barangay
                        </p>
                    </div>
                    <p>___________________________</p>
                    <p style="margin-top: -1.3rem;margin-left: 1rem;">Lagda ng humihiling</p>
                </p>
            </div>
        </div>
    </main>
</body>
</html>