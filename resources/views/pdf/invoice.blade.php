<!--
    *************************
    ****** IMPORTANTE *******
    *************************

    Esta pagina HTML no se utiliza para tal, es decir, nunca se llamara desde un navegador WEB, por lo tanto no sera RESPONSIVE.

    Porque???
        - Porque su utilidad es diferente. Esta pagina es un pagina PDF, como que PDF? Si, esta se utiliza como
        plantilla para generar un PDF utilizando AJAX, BLADE, PHP (Laravel).

    Cosas que tener en cuenta después de la explicación del porque esta pagina.
        1) No se puede poner Bootstrap, ya que da problemas y no lo reconoce PHP a la hora de generar PDF.

        2) No se puede poner CSS externos, solo internos o inline, ya que el plugin para generar PDF no sabe enlazar, solo coje el HTML principal
        y a partir de este genera el PDF, sin mirar si hay CSS, o JS, y tampoco no reconoce fuentes externas como las de Google.

        3) La pagina se ha hecho a base de table, ya se que es una porqueria, era eso, o hacer div con "floaT:left; float: right;",
        a parte de ser peor eso ya posicionas "a saco" componentes de la pagina innecesariamente, se rompe el flujo de la pagina, y se vuelve mas complicada,
        y lo vi innecesario, ya que su finalidad no es WEB, sino PDF.

        La ida seria hacerlo con FlexBox, y seria mucho mas fácil todo, pero el problema esque el complemento para generar PDF a partir de una vista es algo limitado,
        no reconoce algunos atributos de CSS como por ejemplo display:flex, y sus derivaciones.

    !-->
<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Report</title>
    <style>
        .invoice-box {
            margin: 0;
            padding: 10px 10px 30px 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 10px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            border-radius: 15px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;

        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr:nth-child(2) td:nth-child(2) {
            text-align: right;

        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 3px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }


        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .end {
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.peluqueria-mjm.ga/wp-content/uploads/2020/05/cropped-logo.png"
                                    style="width:270px;">
                            </td>
                            <td class="end">
                                {{ __('pdf.created') }} {{ date('Y-m-d H:i:s') }}
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                <strong>{{ __('pdf.direction') }}</strong><br>
                                887 Myrtle Dr.<br>
                                Bronx, NY 16544
                            </td>
                            <td>
                                <strong>{{ __('pdf.contact_us') }}</strong><br>
                                {{ __('pdf.phone') }} : + 1 800 755 60 20<br>
                                Email : support@peluqueria-mjm.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    {{ __('pdf.services_performed') }}
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="end">
                    {{ __('pdf.cost') }}
                </td>
            </tr>

            @foreach ($services as $service)
            <tr class="details">
                <td>
                    {{ $service["title"] }}
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="end">
                    {{ $service["price"] }} €
                </td>
            </tr>
            @endforeach

            <tr class="heading">
                <td>
                    {{ __('pdf.full_name') }}
                </td>
                <td>
                    {{ __('pdf.reserve_status') }}
                </td>
                <td>
                    {{ __('pdf.service') }}
                </td>
                <td>
                    {{ __('pdf.phone') }}
                </td>
                <td>
                    Email
                </td>
            </tr>
            @foreach ($customers as $customer)
            <tr class="item">
                <td>
                    {{ $customer['full_name'] }}
                </td>
                <td>
                    @if ( $customer['pivot']['status'] == "approved")
                    {{ __('pdf.approved') }}
                    @else
                    {{ __('pdf.cancelled') }}
                    @endif
                </td>
                <td>
                    {{ $customer['service'] }}
                </td>
                <td>
                    {{ $customer['phone'] }}

                </td>
                <td>
                    {{ $customer['email'] }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
